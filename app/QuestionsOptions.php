<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class QuestionsOptions extends Model {

    use SoftDeletes;

    protected $fillable = ['option', 'correct', 'question_id'];

    public function question() {
        return $this->belongsTo(Questions::class, 'question_id')->withTrashed();
    }

}
