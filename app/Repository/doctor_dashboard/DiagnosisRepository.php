<?php
namespace App\Repository\doctor_dashboard;

use App\Interfaces\doctor_dashboard\DiagnosisRepositoryInterface;
use App\Models\Diagnostic;
use App\Models\Invoice;
use App\Models\Pharmacy;
use Illuminate\Support\Facades\DB;

class DiagnosisRepository implements DiagnosisRepositoryInterface
{
//=================================================================================================
    public function store($request)
    {
        DB::beginTransaction();
        try
        {
        $invoice_status = Invoice::findOrFail($request->invoice_id);
        $invoice_status->update([
         'invoice_status'=>3
        ]);
          $dianosis = new Diagnostic();
          $dianosis->date = date('Y-m-d');
          $dianosis->diagnosis = $request->diagnosis;
          $dianosis->medicine = $request->medicine;
          $dianosis->invoice_id = $request->invoice_id;
          $dianosis->patient_id = $request->patient_id;
          $dianosis->doctor_id = $request->doctor_id;
          $dianosis->save();
          
          $pharmacies = new Pharmacy();
          $pharmacies->diagnosis = $request->diagnosis;
          $pharmacies->medicine = $request->medicine;
          $pharmacies->invoice_id = $request->invoice_id;
          $pharmacies->patient_id = $request->patient_id;
          $pharmacies->doctor_id = $request->doctor_id;
          $pharmacies->save();
          
          DB::commit();
          session()->flash('add');
          return redirect()->back();

        }
        catch (\Exception $e){
            DB::rollBack();
         return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }
    }
//=================================================================================================
    public function show($id)
    {
        $patient_records = Diagnostic::where('patient_id',$id)->get();
        return view('Dashboard.Doctor.Invoices.patient_record',compact('patient_records'));
    }
//=================================================================================================
    public function addReview($request)
    {
        DB::beginTransaction();
        try
        {
        $invoice_status = Invoice::findOrFail($request->invoice_id);
        $invoice_status->update([
         'invoice_status'=>2
        ]);
          $dianosis = new Diagnostic();
          $dianosis->date = date('Y-m-d');
          $dianosis->review_date = date('Y-m-d H:i:s');
          $dianosis->diagnosis = $request->diagnosis;
          $dianosis->medicine = $request->medicine;
          $dianosis->invoice_id = $request->invoice_id;
          $dianosis->patient_id = $request->patient_id;
          $dianosis->doctor_id = $request->doctor_id;
          $dianosis->save();
          
          DB::commit();
          session()->flash('add');
          return redirect()->back();

        }
        catch (\Exception $e){
            DB::rollBack();
         return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }
    }
}