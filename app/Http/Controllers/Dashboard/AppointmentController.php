<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
   
    public function index()
    {
        $appointments = Appointment::where('type','غير مؤكد')->get();
        return view('Dashboard.appointments.index',compact('appointments'));
    }

    public function index2(){

        $appointments = Appointment::where('type','مؤكد')->get();
        return view('Dashboard.appointments.index2',compact('appointments'));
    }

    public function index3(){

        $appointments = Appointment::where('type','منتهي')->get();
        return view('Dashboard.appointments.index3',compact('appointments'));
    }


    public function approval(Request $request, $id)
    {
        $appointment = Appointment::findorFail($id);
        
        $appointment->update([
            'type'=>'مؤكد',
            'appointment'=>$request->appointment
        ]);


        session()->flash('add');
        return back();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
