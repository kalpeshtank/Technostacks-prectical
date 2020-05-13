<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Test extends Model {

    use SoftDeletes;

    protected $fillable = ['user_id', 'result'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
