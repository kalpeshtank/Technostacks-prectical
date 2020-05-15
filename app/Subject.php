<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model {

    use SoftDeletes;

    protected $fillable = ['title'];

    public function questions() {
        return $this->hasMany(Questions::class, 'subject_id')->withTrashed();
    }

}
