<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyInvoice extends Model
{
    use HasFactory;
    // protected $guarded=[];
    protected $guarded=[];
 
   
    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function Doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function medicine_details()
    {
        return $this->belongsToMany(Medicine::class,'medicine_details')->withPivot('Qty');

    }


}
