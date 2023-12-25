<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::all();
        return view('Dashboard.Medicine.index',compact('medicines'));
    }

    public function create()
    {
        return view('Dashboard.Medicine.create');
    }

    public function store(Request $request)
    {
        try {

            $medicines = new Medicine();
            $medicines->name = $request->name;
            $medicines->group = $request->group;
            $medicines->company = $request->company;
            $medicines->cost = $request->cost;
            $medicines->price = $request->price;
            $medicines->exp = $request->exp;
            $medicines->note = $request->note;
            
            $medicines->save();
            session()->flash('add');
            return back();

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $medicines = Medicine::where('id',$id)->first();
       return view('Dashboard.Medicine.edit',compact('medicines'));
    }

    public function update(Request $request, $id)
    {
       
        try {

            $medicines = Medicine::findorfail($request->id);
            $medicines->name = $request->name;
            $medicines->group = $request->group;
            $medicines->company = $request->company;
            $medicines->cost = $request->cost;
            $medicines->price = $request->price;
            $medicines->exp = $request->exp;
            $medicines->note = $request->note;
            
            $medicines->save();
            session()->flash('edit');
            return back();

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        
        try {
            Medicine::destroy($request->id);
            session()->flash('delete');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
