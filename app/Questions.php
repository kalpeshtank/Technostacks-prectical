<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model {

    use SoftDeletes;

    protected $fillable = ['question_text', 'code_snippet', 'answer_explanation', 'subject_id'];

    public function subjet() {
        return $this->belongsTo(Subject::class, 'subject_id')->withTrashed();
    }

    public function options() {
        return $this->hasMany(QuestionsOptions::class, 'question_id')->withTrashed();
    }

}
