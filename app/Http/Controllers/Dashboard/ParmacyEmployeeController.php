<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ParmacyEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class ParmacyEmployeeController extends Controller
{
   
    public function index()
    {
       $parmacyEmployee = ParmacyEmployee::all();
       return view('Dashboard.ParmacyEmployee.index',compact('parmacyEmployee'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {

            $ray_employee = new ParmacyEmployee();
            $ray_employee->name = $request->name;
            $ray_employee->email = $request->email;
            $ray_employee->password = Hash::make($request->password);
            $ray_employee->save();
            session()->flash('add');
            return back();

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function update(Request $request, $id)
    {
        $input = $request->all();

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }
        else{
            $input = Arr::except($input, ['password']);
        }

        $ray_employee = ParmacyEmployee::find($id);
        $ray_employee->update($input);

        session()->flash('edit');
        return redirect()->back();
        
    }

    public function destroy($id)
    {
        try {
            ParmacyEmployee::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
