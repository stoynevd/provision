<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToDo extends Model {

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'date',
        'time',
    ];

    public function user() {
        return $this->belongsTo('\App\User');
    }

}
