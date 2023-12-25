<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Authenticatable
{
    use Translatable;

    use HasFactory;
    protected $translatedAttributes = ['name', 'appointments'];
    public $fillable = [
        'email',
        'email_verified_at',
        'password',
        'phone',
        'name',
        'section_id',
        'status',
        'number_of_statement'
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function doctorappointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_doctor');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
