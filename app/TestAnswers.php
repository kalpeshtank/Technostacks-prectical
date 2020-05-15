<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestAnswers extends Model {

    use SoftDeletes;

    protected $fillable = ['user_id', 'test_id', 'question_id', 'option_id', 'correct'];

    public function question() {
        return $this->belongsTo(Questions::class, 'question_id');
    }

}
