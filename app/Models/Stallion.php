<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Stallion extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded =[];

    public $translatable = ['name'];


    public function parent()
    {
        return $this->belongsTo(Stallion::class, 'father_id');
    }

    public function children()
    {
        return $this->hasMany(Stallion::class, 'father_id');
    }

    public function mother()
    {
        return $this->belongsTo(Mare::class,'mother_id');
    }

    public function horse()
    {
        return $this->hasOne(Horse::class,'father_id');
    }
}
