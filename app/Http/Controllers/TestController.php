<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Questions;
use App\QuestionsOptions;
use App\Test;
use App\TestAnswers;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller {

    public $successStatus = 200;
    public $errorStatus = 422;

    /**
     * Display a new test.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $questions = Questions::inRandomOrder()->get();
        foreach ($questions as &$question) {
            $question->options = QuestionsOptions::where('question_id', $question->id)->inRandomOrder()->get();
        }
        return view('tests/form', ['questions' => $questions]);
    }

    /**
     * Store a newly solved Test in storage with results.
     *
     * @param  \App\Http\Requests\StoreResultsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $result = 0;
        $test = Test::create([
                    'user_id' => Auth::id(),
                    'result' => $result,
        ]);
        foreach ($request->input('questions', []) as $key => $question) {
            $status = 0;
            if ($request->input('answers.' . $question) != null && QuestionsOptions::find($request->input('answers.' . $question))->correct) {
                $status = 1;
                $result++;
            }
            TestAnswers::create([
                'user_id' => Auth::id(),
                'test_id' => $test->id,
                'question_id' => $question,
                'option_id' => $request->input('answers.' . $question),
                'correct' => $status,
            ]);
        }
        $test->update(['result' => $result]);
        return response()->json(['status' => 'success', 'massage' => 'success', 'data' => ['id' => $test->id]], $this->successStatus);
//        return redirect()->route('results.show', [$test->id]);
    }

}
