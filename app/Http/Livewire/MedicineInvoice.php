<?php

namespace App\Http\Livewire;

use App\Models\Doctor;
use App\Models\FundAccount;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\PharmacyInvoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class MedicineInvoice extends Component
{
    public $MedicinesItems = [];
    public $allMedicines = [];
    public $catchError;
    public $Addmedicine;
    public $price, $invoice_id, $Qty, $type, $medicine_id, $tax_rate;
    public $doctor_id;
    public $patient_id;
    public $Medicine;
    public $SavedMode = false;
    public $UpdateMode = false;
    public $show_table = true;
    public $pharmacy;
    public $discount_value = 0;
    public $taxes = 15;
    public $MedicineSaved = false;
    public $MedicineUpdated = false;
    public $pharmacy_invoice_id;
    public $medicineDetails;

    public function mount()
    {

        $this->allMedicines = Medicine::all();
        // $this->Medicine = Medicine::all();

    }

    public function render()
    {
        $total = 0;
        foreach ($this->MedicinesItems as $medicineItem) {
            if ($medicineItem['is_saved'] && $medicineItem['price'] && $medicineItem['Qty']) {
                $total += $medicineItem['price'] * $medicineItem['Qty'];
            }
        }

        return view('livewire.Medicine.medicine-invoice', [

            'pharmacy_invoices' => PharmacyInvoice::all(),
            'doctors' => Doctor::get(),
            'patients' => Patient::get(),
            'subtotal' => $Total_after_discount = $total - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'total' => $Total_after_discount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100),
            'tax_value' => $Total_after_discount * ((is_numeric($this->taxes) ? $this->taxes : 0) / 100)
        ]);
    }
    //=======================================================================================================================================

    public function show_form_add()
    {
        $this->show_table = false;
    }

    public function get_price()
    {
        $this->price = Medicine::where('id', $this->MedicinesItems)->first()->price;
    }
    //=======================================================================================================================

    public function Addmedicine()
    {
        foreach ($this->MedicinesItems as $key => $medicineItem) {
            if (!$medicineItem['is_saved']) {
                $this->addError('MedicinesItems.' . $key, 'يجب حفظ هذا الدواء قبل إضافة دواء جديد.');
                return;
            }
        }

        $this->MedicinesItems[] = [
            'medicine_id' => '',
            'Qty' => 1,
            'is_saved' => false,
            'Medicine' => '',
            'price' => 0
        ];

        $this->MedicineSaved = false;
    }
    //================================================================================================================
    public function saveMedicine($index)
    {
        $this->resetErrorBag();
        $product = $this->allMedicines->find($this->MedicinesItems[$index]['medicine_id']);
        $this->MedicinesItems[$index]['Medicine'] = $product->name;
        $this->MedicinesItems[$index]['price'] = $product->price;
        $this->MedicinesItems[$index]['is_saved'] = true;
    }

    //===============================================================================================================
    public function editMedicine($index)
    {
        foreach ($this->MedicinesItems as $key => $medicineItem) {
            if (!$medicineItem['is_saved']) {
                $this->addError('MedicinesItems.' . $key, 'This line must be saved before editing another.');
                return;
            }
        }

        $this->MedicinesItems[$index]['is_saved'] = false;
    }

    public function removeMedicine($index)
    {
        unset($this->MedicinesItems[$index]);
        $this->MedicinesItems = array_values($this->MedicinesItems);
    }
    //===============================================================================================================
    public function SavePharmacyInvoice()
    {
        DB::beginTransaction();
        try {
            if ($this->type == 1) {
                
                if ($this->UpdateMode) 
                {
                    $PharmacyInvoice = PharmacyInvoice::find($this->pharmacy_invoice_id);
                    $total = 0;
                    foreach ($this->MedicinesItems as $medicineItem) {
                        if ($medicineItem['is_saved'] && $medicineItem['price'] && $medicineItem['Qty']) {
                            $total += $medicineItem['price'] * $medicineItem['Qty'];
                        }
                    }
                    $PharmacyInvoice->type = $this->type;
                    $PharmacyInvoice->patient_id = $this->patient_id;
                    $PharmacyInvoice->doctor_id = $this->doctor_id;
                    $PharmacyInvoice->Total_before_discount = $total;
                    $PharmacyInvoice->discount_value = $this->discount_value;
                    $PharmacyInvoice->tax_rate = $this->taxes;
                    $PharmacyInvoice->tax_value = ($total - $this->discount_value) * ((is_numeric($this->taxes) ? $this->taxes : 0) / 100);
                    $PharmacyInvoice->Total_after_discount = $total - ((is_numeric($this->discount_value) ? $this->discount_value : 0));
                    $PharmacyInvoice->total_with_tax = $PharmacyInvoice->Total_after_discount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100);
                    $PharmacyInvoice->save();
                    
                    $PharmacyInvoice->medicine_details()->detach();
                    foreach ($this->MedicinesItems as $medicineItem) {
                        $PharmacyInvoice->medicine_details()->attach($medicineItem['medicine_id'], ['Qty' => $medicineItem['Qty']]);
                    }

                    $fund_accounts = FundAccount::where('pharmacy_invoice_id',$this->pharmacy_invoice_id)->first();
                    $fund_accounts->date = date('Y-m-d');
                    $fund_accounts->pharmacy_invoice_id = $PharmacyInvoice->id;
                    $fund_accounts->Debit = $PharmacyInvoice->total_with_tax;
                    $fund_accounts->credit = 0.00;
                    $fund_accounts->save();

                    $this->MedicineSaved = false;
                    $this->MedicineUpdated = true;
                } 
                
                else
                 {
                    // insert
                    $PharmacyInvoice = new PharmacyInvoice();
                    $total = 0;
                    foreach ($this->MedicinesItems as $medicineItem) {
                        if ($medicineItem['is_saved'] && $medicineItem['price'] && $medicineItem['Qty']) {
                            $total += $medicineItem['price'] * $medicineItem['Qty'];
                        }
                    }
                    $PharmacyInvoice->type = $this->type;
                    $PharmacyInvoice->patient_id = $this->patient_id;
                    $PharmacyInvoice->doctor_id = $this->doctor_id;
                    $PharmacyInvoice->Total_before_discount = $total;
                    $PharmacyInvoice->discount_value = $this->discount_value;
                    $PharmacyInvoice->tax_rate = $this->taxes;
                    $PharmacyInvoice->tax_value = ($total - $this->discount_value) * ((is_numeric($this->taxes) ? $this->taxes : 0) / 100);
                    $PharmacyInvoice->Total_after_discount = $total - ((is_numeric($this->discount_value) ? $this->discount_value : 0));
                    $PharmacyInvoice->total_with_tax = $PharmacyInvoice->Total_after_discount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100);
                    $PharmacyInvoice->save();
    
                    foreach ($this->MedicinesItems as $medicineItem) {
                        $PharmacyInvoice->medicine_details()->attach($medicineItem['medicine_id'], ['Qty' => $medicineItem['Qty']]);
                    }

                    $fund_accounts = new FundAccount();
                    $fund_accounts->date = date('Y-m-d');
                    $fund_accounts->pharmacy_invoice_id = $PharmacyInvoice->id;
                    $fund_accounts->Debit = $PharmacyInvoice->total_with_tax;
                    $fund_accounts->credit = 0.00;
                    $fund_accounts->save();

                    $this->MedicineSaved = true;
                }

            } 
            else 
            {
                if($this->UpdateMode)
                {
                    $PharmacyInvoice = PharmacyInvoice::find($this->pharmacy_invoice_id);
                    $total = 0;
                    foreach ($this->MedicinesItems as $medicineItem) {
                        if ($medicineItem['is_saved'] && $medicineItem['price'] && $medicineItem['Qty']) {
                            $total += $medicineItem['price'] * $medicineItem['Qty'];
                        }
                    }
                    $PharmacyInvoice->type = $this->type;
                    $PharmacyInvoice->patient_id = $this->patient_id;
                    $PharmacyInvoice->doctor_id = $this->doctor_id;
                    $PharmacyInvoice->Total_before_discount = $total;
                    $PharmacyInvoice->discount_value = $this->discount_value;
                    $PharmacyInvoice->tax_rate = $this->taxes;
                    $PharmacyInvoice->tax_value = ($total - $this->discount_value) * ((is_numeric($this->taxes) ? $this->taxes : 0) / 100);
                    $PharmacyInvoice->Total_after_discount = $total - ((is_numeric($this->discount_value) ? $this->discount_value : 0));
                    $PharmacyInvoice->total_with_tax = $PharmacyInvoice->Total_after_discount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100);
                    $PharmacyInvoice->save();
                    
                    $PharmacyInvoice->medicine_details()->detach();
                    foreach ($this->MedicinesItems as $medicineItem) {
                        $PharmacyInvoice->medicine_details()->attach($medicineItem['medicine_id'], ['Qty' => $medicineItem['Qty']]);
                    }

                    $patient_accounts = PatientAccount::where('pharmacy_invoice_id',$this->PharmacyInvoice)->first();
                    $patient_accounts->date = date('Y-m-d');
                    $patient_accounts->pharmacy_invoice_id = $PharmacyInvoice->id;
                    $patient_accounts->patient_id = $PharmacyInvoice->patient_id;
                    $patient_accounts->Debit = $PharmacyInvoice->total_with_tax;
                    $patient_accounts->credit = 0.00;
                    $patient_accounts->save();

                    $this->MedicineSaved = false;
                    $this->MedicineUpdated = true;
                }
                else
                {

                    $PharmacyInvoice = new PharmacyInvoice();
                    $total = 0;
                    foreach ($this->MedicinesItems as $medicineItem) {
                        if ($medicineItem['is_saved'] && $medicineItem['price'] && $medicineItem['Qty']) {
                            $total += $medicineItem['price'] * $medicineItem['Qty'];
                        }
                    }
                    $PharmacyInvoice->type = $this->type;
                    $PharmacyInvoice->patient_id = $this->patient_id;
                    $PharmacyInvoice->doctor_id = $this->doctor_id;
                    $PharmacyInvoice->Total_before_discount = $total;
                    $PharmacyInvoice->discount_value = $this->discount_value;
                    $PharmacyInvoice->tax_rate = $this->taxes;
                    $PharmacyInvoice->tax_value = ($total - $this->discount_value) * ((is_numeric($this->taxes) ? $this->taxes : 0) / 100);
                    $PharmacyInvoice->Total_after_discount = $total - ((is_numeric($this->discount_value) ? $this->discount_value : 0));
                    $PharmacyInvoice->total_with_tax = $PharmacyInvoice->Total_after_discount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100);
                    $PharmacyInvoice->save();
    
                    foreach ($this->MedicinesItems as $medicineItem) {
                        $PharmacyInvoice->medicine_details()->attach($medicineItem['medicine_id'], ['Qty' => $medicineItem['Qty']]);
                    }

                    $patient_accounts = new PatientAccount();
                    $patient_accounts->date = date('Y-m-d');
                    $patient_accounts->pharmacy_invoice_id = $PharmacyInvoice->id;
                    $patient_accounts->patient_id = $PharmacyInvoice->patient_id;
                    $patient_accounts->Debit = $PharmacyInvoice->total_with_tax;
                    $patient_accounts->credit = 0.00;
                    $patient_accounts->save();

                    $this->MedicineSaved = true;
                }

            }

            DB::commit();
        } 
        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        }
    }
    //=========================================================================================================================================
    public function edit($id)
    {

        $this->show_table = false;
        $this->UpdateMode = true;

        $pharmacy_invoices = PharmacyInvoice::where('id', $id)->first();
        $this->pharmacy_invoice_id = $id;
        // $this->reset('MedicinesItems',)
        // $this->pharmacy_invoice_id = $pharmacy_invoices->id;
        $this->patient_id = $pharmacy_invoices->patient_id;
        $this->doctor_id = $pharmacy_invoices->doctor_id;
        $this->discount_value = intval($pharmacy_invoices->discount_value);
        // $this->tax_rate = $pharmacy_invoices->tax_rate;
        $this->type = $pharmacy_invoices->type;
        $this->MedicineSaved = false;
        foreach ($pharmacy_invoices->medicine_details as $medicineDetails) {
            $this->MedicinesItems[] = [
                'medicine_id' => $medicineDetails->id,
                'Qty' => $medicineDetails->pivot->Qty,
                'is_saved' => true,
                'Medicine' => $medicineDetails->name,
                'price' => $medicineDetails->price,
            ];
        }

    }

    public function delete($id)
    {
        PharmacyInvoice::destroy($id);
        return redirect()->to('/medicine-invoice');
    }

    public function print($id)
    {
        $pharmacy_invoices = PharmacyInvoice::findorfail($id);
        
        return Redirect::route('Print_medicine-invoice',[
            'id' => $pharmacy_invoices->id,
            'date' => date('Y-m-d'),
            'doctor_id' => $pharmacy_invoices->Doctor->name,
            'patient_id' => $pharmacy_invoices->Patient->name,
            'type' => $pharmacy_invoices->type,
            'Total_before_discount' => $pharmacy_invoices->Total_before_discount,
            'discount_value' => $pharmacy_invoices->discount_value,
            'Total_after_discount' => $pharmacy_invoices->Total_after_discount,
            'tax_rate' => $pharmacy_invoices->tax_rate,
            'tax_value' => $pharmacy_invoices->tax_value,
            'total_with_tax' => $pharmacy_invoices->total_with_tax,
            
        ]);

        foreach ($pharmacy_invoices->medicine_details as $medicineDetails) {
            $this->MedicinesItems[] = [
                'medicine_id' => $medicineDetails->id,
                'Qty' => $medicineDetails->pivot->Qty,
                'Medicine' => $medicineDetails->name,
                'price' => $medicineDetails->price,
            ];
        }
    }
}
