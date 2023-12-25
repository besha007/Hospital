<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Patient extends Authenticatable
{
    use Translatable;

    use HasFactory;
    public $translatedAttributes = ['name','Address'];
    public $fillable= ['email','Password','Date_Birth','Phone','Gender','Blood_Group'];

    public function doctor()
    {
        return $this->belongsTo(single_invoice::class,'doctor_id');
    }

    public function service()
    {
        return $this->belongsTo(single_invoice::class,'Service_id');
    }
}
