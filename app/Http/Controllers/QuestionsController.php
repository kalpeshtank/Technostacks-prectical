<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use App\QuestionsOptions;
use App\Subject;
use Validator;

class QuestionsController extends Controller {

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
        return view('questions/form', ['title' => 'Create Question', 'button' => 'save', 'questions' => []]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'massage' => $validator->errors()->first(), 'data' => []], $this->errorStatus);
        } else {
            $subject_data = array('title' => $request->title);
            Subject::updateOrCreate(['id' => $request->id], $subject_data);
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
        return view('questions/form', ['questions' => $questions, 'title' => 'Update Question', 'button' => 'Update']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $topic = Questions::findOrFail($id);
        $topic->delete();
        return redirect('subjects')->with('success', 'Question is successfully Deleted');
    }

}
