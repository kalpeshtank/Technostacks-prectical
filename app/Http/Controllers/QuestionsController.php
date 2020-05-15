<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use App\QuestionsOptions;
use App\Subject;
use Illuminate\Support\Facades\Auth;
use Validator;

class QuestionsController extends Controller {

    public function __construct() {
        $this->middleware('Admin');
    }

    public $successStatus = 200;
    public $errorStatus = 422;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $questions = Questions::paginate(10);
        return view('questions/list', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('questions/form', ['title' => 'Create Question', 'button' => 'save', 'questions' => [], 'subject' => Subject::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'subject' => 'required',
                    'question_text' => 'required',
                    'option1' => 'required',
                    'option2' => 'required',
                    'option3' => 'required',
                    'option4' => 'required',
                    'correct' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'massage' => $validator->errors()->first(), 'data' => []], $this->errorStatus);
        } else {
            $question = Questions::create(['subject_id' => $request->subject, 'question_text' => $request->question_text, 'code_snippet' => $request->code_snippet, 'answer_explanation' => $request->answer_explanation]);
            foreach ($request->input() as $key => $value) {
                if (strpos($key, 'option') !== false && $value != '') {
                    $status = $request->input('correct') == $key ? 1 : 0;
                    QuestionsOptions::create([
                        'question_id' => $question->id,
                        'option' => $value,
                        'correct' => $status
                    ]);
                }
            }
            $massge = $request->id ? 'Subjects Updated successfully.' : 'Subjects Added successfully.';
            return response()->json(['status' => 'success', 'massage' => $massge, 'data' => []], $this->successStatus);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $questions = Questions::findOrFail($id);
        return view('questions/form', ['questions' => $questions, 'subject' => Subject::all(), 'title' => 'Update Question', 'button' => 'Update']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
                    'subject' => 'required',
                    'question_text' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'massage' => $validator->errors()->first(), 'data' => []], $this->errorStatus);
        } else {
            $question = Questions::findOrFail($id);
            $question->update(['subject_id' => $request->subject, 'question_text' => $request->question_text, 'code_snippet' => $request->code_snippet, 'answer_explanation' => $request->answer_explanation]);
            return response()->json(['status' => 'success', 'massage' => 'Subjects Updated successfully.', 'data' => []], $this->successStatus);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $questions = Questions::findOrFail($id);
        $options = QuestionsOptions::where(['question_id' => $questions->id])->get();
        foreach ($options as $opt) {
            $opt->delete();
        }
        $questions->delete();
        return redirect('questions')->with('success', 'Question is successfully Deleted');
    }

}
