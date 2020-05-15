<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use Auth;
use App\Questions;
use App\TestAnswers;

class ResultsController extends Controller {

    /**
     * Display a listing of Result.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $results = Test::all()->load('user');
        if (auth()->user()->user_type != "Admin") {
            $results = $results->where('user_id', '=', Auth::id());
        }
        return view('results/list', ['results' => $results, 'count' => Questions::get()->count()]);
    }

    /**
     * Display Result.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $test = Test::find($id)->load('user');
        if ($test) {
            $results = TestAnswers::where('test_id', $id)
                    ->with('question')
                    ->with('question.options')
                    ->get();
        }
        $count = Questions::get()->count();
        return view('results/show', compact('test', 'results', 'count'));
    }

}
