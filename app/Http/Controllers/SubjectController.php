<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use Validator;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller {

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
        $subjects = Subject::paginate(10);
        return view('subjects/list', ['subjects' => $subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('subjects/form', ['title' => 'Create Subjects', 'button' => 'save', 'subjects' => []]);
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
        $subjects = Subject::findOrFail($id);
        return view('subjects/form', ['subjects' => $subjects, 'title' => 'Update Subjects', 'button' => 'Update']);
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
        $subjects = Subject::findOrFail($id);
        $subjects->delete();
        return redirect('subjects')->with('success', 'Subjects is successfully Deleted');
    }

}
