<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    //
    protected $fillable = [
        'url', 'slug', 'keywords', 'meta_desc',
    ];
}
