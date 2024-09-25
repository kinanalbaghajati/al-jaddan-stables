<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Horse extends Model
{
    use HasFactory,HasTranslations;
    protected $table = 'horses';
    protected $guarded = [];

    public $translatable = ['name','owner','disc','ancestors'];

    public function file()
    {
        return $this->morphMany(File::class,'fileable');
    }

    public function image()
    {
        return $this->morphOne(File::class,'fileable');
    }
}
