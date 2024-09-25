<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Content extends Model
{
    use HasFactory,HasTranslations;

    public $guarded = [];

    public $translatable = ['text'];

    public function file()
    {
        return $this->morphOne('App\\Models\\File', 'fileable');
    }
}
