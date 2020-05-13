<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Results extends Model {

    use SoftDeletes;

    protected $fillable = ['correct', 'date', 'user_id', 'question_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function question() {
        return $this->belongsTo(Question::class, 'question_id')->withTrashed();
    }

}
