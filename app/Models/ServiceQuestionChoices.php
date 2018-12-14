<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceQuestionChoices extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id', 'choice'
    ];
}
