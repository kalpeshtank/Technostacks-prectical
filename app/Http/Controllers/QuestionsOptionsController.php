<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuestionsOptions;
use App\Questions;
use Illuminate\Support\Facades\Auth;
use Validator;

class QuestionsOptionsController extends Controller {

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
        $questionsOptions = QuestionsOptions::paginate(10);
        return view('options/list', ['questionsOptions' => $questionsOptions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('options/form', ['title' => 'Create Options', 'button' => 'save', 'options' => []]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'option' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'massage' => $validator->errors()->first(), 'data' => []], $this->errorStatus);
        } else {
            $QuestionsOptions = QuestionsOptions::findOrFail($request->id);
            $QuestionsOptions->update(['option' => $request->option, 'correct' => $request->correct]);
            return response()->json(['status' => 'success', 'massage' => 'Subjects Updated successfully.', 'data' => []], $this->successStatus);
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
        $QuestionsOptions = QuestionsOptions::findOrFail($id);
        $Questions = Questions::all();
        return view('options/form', ['options_details' => $QuestionsOptions, 'questions' => $Questions, 'title' => 'Update Options', 'button' => 'Update']);
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
        $Options = QuestionsOptions::findOrFail($id);
        $Options->delete();
        return redirect('questions-options')->with('success', 'Options is successfully Updated');
    }

}
