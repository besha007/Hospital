<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use App\Models\RayEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class RayEmployeeController extends Controller
{
    // private $employee;

    // public function __construct(RayEmployeeRepositoryInterface $employee)
    // {
    //     $this->employee = $employee;
    // }


    public function index()
    {
        $ray_employees = RayEmployee::all();
        return view('Dashboard.ray_employee.index',compact('ray_employees'));
        //return $this->employee->index();
    }



    public function store(Request $request)
    {
        try {

            $ray_employee = new RayEmployee();
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

       // return $this->employee->store($request);
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

        $ray_employee = RayEmployee::find($id);
        $ray_employee->update($input);

        session()->flash('edit');
        return redirect()->back();
        
      //  return $this->employee->update($request,$id);
    }


    public function destroy($id)
    {
        try {
            RayEmployee::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
       // return $this->employee->destroy($id);
    }
}
