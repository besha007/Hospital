<?php
namespace App\Repository\Services;

use App\Interfaces\Services\SingleServiceRepositoryInterface;
use App\Models\Service;

class SingleServiceRepository implements SingleServiceRepositoryInterface
{
     //Get SingleService Data
    public function index()
    {
        $services = Service::all();
        
        return view('Dashboard.Services.Single Service.index',compact('services'));
        
    }
  //Save SingleService
  public function store($request)
    {
        try {
            $SingleService = new Service();
            $SingleService->price = $request->price;
            $SingleService->description = $request->description;
            $SingleService->status = 1;
            $SingleService->save();

            // store trans
            $SingleService->name = $request->name;
            $SingleService->save();

            session()->flash('add');
            return redirect()->route('Service.index');

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    //Update SingleService
    public function update($request)
    {
           try {

            $SingleService = Service::findOrFail($request->id);
            $SingleService->price = $request->price;
            $SingleService->description = $request->description;
            $SingleService->status = $request->status;
            $SingleService->save();

            // store trans
            $SingleService->name = $request->name;
            $SingleService->save();

            session()->flash('edit');
            return redirect()->route('Service.index');

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    //Delete SingleService
    public function destroy($request)
    {
        Service::destroy($request->id);
        session()->flash('delete');
        return redirect()->route('Service.index');
    }
}