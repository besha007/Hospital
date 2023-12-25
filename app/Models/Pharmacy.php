<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function Invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }

    public function employee()
    {
        return $this->belongsTo(ParmacyEmployee::class,'employee_id')
            ->withDefault(['name'=>'No Employee']);
    }

    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function Diagnostic()
    {
        return $this->belongsTo(Diagnostic::class, 'diagnostic_id');
    }
}
