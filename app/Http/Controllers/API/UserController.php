<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Questions;
use App\QuestionsOptions;

class UserController extends Controller {

    use AuthenticatesUsers;

    public $successStatus = 200;
    public $errorStatus = 401;

    /**
     * 
     * @return type
     */
    public function login() {
        if (Auth::attempt(['email' => request('username'), 'password' => request('password')])) {
            $user = Auth::user();
            $user['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['status' => 'success', 'massage' => 'Login successfully', 'data' => $user], $this->successStatus);
        } else {
            return response()->json(['status' => 'error', 'massage' => 'These credentials do not match our records.', 'data' => []], $this->errorStatus);
        }
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function logoutApi(Request $request) {
        if (!$this->guard()->check()) {
            return response()->json(['status' => 'error', 'massage' => 'No active user session was found', 'data' => []], $this->errorStatus);
        }
        $request->user()->token()->revoke();
        return response()->json(['status' => 'success', 'massage' => 'Logged out successfully', 'data' => []], $this->successStatus);
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function list(Request $request) {
        $questions = Questions::inRandomOrder()->get();
        foreach ($questions as &$question) {
            $question->options = QuestionsOptions::where('question_id', $question->id)->inRandomOrder()->get();
        }
        return response()->json(['status' => 'success', 'massage' => 'List get successfully', 'data' => $questions], $this->successStatus);
    }

}
