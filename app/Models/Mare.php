<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Mare extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded =[];

    public $translatable = ['name'];


    public function parent()
    {
        return $this->belongsTo(Mare::class, 'mother_id');
    }

    public function children()
    {
        return $this->hasMany(Mare::class, 'mother_id');
    }

    public function father()
    {
        return $this->belongsTo(Stallion::class,'father_id');
    }

    public function horse()
    {
        return $this->hasOne(Horse::class,'mother_id');
    }

}
