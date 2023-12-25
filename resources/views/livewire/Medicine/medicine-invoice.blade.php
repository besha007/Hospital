<div>
    @if ($catchError)
    <div class="alert alert-danger" id="success-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
      خطأ في عملية الادخال الرجاء مراجعة الحقول
    </div>
@endif
    @if ($MedicineSaved)
    <div class="alert alert-success">تم حفظ البيانات</div>
@endif

@if ($MedicineUpdated)
<div class="alert alert-success">تم تعديل البيانات</div>
@endif

@if($show_table)
@include('livewire.Medicine.Table')
@else

    <form wire:submit.prevent="SavePharmacyInvoice">
        @csrf
        <div class="row">
            <div class="col">
                <label>اسم المريض</label>
                <select name="patient_id" class="form-control" wire:model="patient_id">
                    <option value="">-- Choose Patient --</option>
                    @foreach($patients as $patient)
                    <option value="{{$patient->id}}">{{$patient->name}}</option>
                     @endforeach
                </select>
            </div>
           
            <div class="col">
                <label>اسم الطبيب</label>
                <select name="doctor_id" class="form-control" wire:model="doctor_id">
                    <option value="">-- Choose Doctor --</option>
                    @foreach($doctors as $doctor)
                    <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                     @endforeach
                </select>

            </div>

            <div class="col">
                <label>نوع الفاتورة</label>
                <select class="form-control" name="type" wire:model="type" {{$UpdateMode == true ? 'disabled':''}}>
                    <option value="">-- اختر من القائمة --</option>
                    <option value="1">نقدي</option>
                    <option value="2">اجل</option>
                </select>
            </div>

        </div><br>
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0"></h4>
                        </div>
                    </div>
                   
                        <div class="card-header">
                            <div class="col-md-12">
                                <button class="btn btn-outline-primary" wire:click.prevent="Addmedicine"
                                >اضافة دواء</button>
                            </div>
                        </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-primary">
                                        <th width="200">اسم الدواء</th>
                                        <th width="200">السعر</th>
                                        <th width="200">الكمية</th>
                                        <th width="200">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($MedicinesItems as $index => $medicineItem)
                                    <tr>
                                        <td>
                                            @if($medicineItem['is_saved'])
                                                <input type="hidden" name="MedicinesItems[{{$index}}][medicine_id]"
                                                       wire:model="MedicinesItems.{{$index}}.medicine_id"/>

                                                @if($medicineItem['Medicine'] && $medicineItem['price'])
                                                    {{ $medicineItem['Medicine'] }}
                                                    {{-- ({{ number_format($medicineItem['price'], 2) }}) --}}
                                                @endif
                                            @else

                                                <select name="MedicinesItems[{{$index}}][medicine_id]"
                                                        class="form-control{{ $errors->has('MedicinesItems.' . $index) ? ' is-invalid' : '' }}"
                                                        wire:model="MedicinesItems.{{$index}}.medicine_id" wire:change="get_price",$medicine_id>

                                                    <option value="">-- Choose Medicine --</option>
                                                    @foreach ($allMedicines as $medicine)
                                                        <option value="{{ $medicine->id }}">
                                                            {{ $medicine->name }}
                                                            {{-- {{ \App\Models\Medicine::where(['medicin_id' => $medicine->id])->pluck('name')->first() }}
                                                            ({{ number_format($medicine->price, 2) }}) --}}
                                                        </option>
                                                    @endforeach
                                                </select>


                                                @if($errors->has('MedicinesItems.' . $index))
                                                    <em class="invalid-feedback">
                                                        {{ $errors->first('MedicinesItems.' . $index) }}
                                                    </em>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if($medicineItem['is_saved'])
                                            <input type="hidden" name="MedicinesItems[{{$index}}][price]"
                                                   wire:model="MedicinesItems.{{$index}}.price"/>
                                            {{ $medicineItem['price'] }}
                                        @else
                                            <input type="number" name="MedicinesItems[{{$index}}][price]"
                                             class="form-control" wire:model="MedicinesItems.{{$index}}.price" readonly/>
                                        @endif
                                                {{-- <input type="number" name="price" wire:model="price" readonly class="form-control"> --}}
                                        </td>
                                        <td>
                                            @if($medicineItem['is_saved'])
                                                <input type="hidden" name="MedicinesItems[{{$index}}][Qty]"
                                                       wire:model="MedicinesItems.{{$index}}.Qty"/>
                                                {{ $medicineItem['Qty'] }}
                                            @else
                                                <input type="number" name="MedicinesItems[{{$index}}][Qty]"
                                                       class="form-control" wire:model="MedicinesItems.{{$index}}.Qty"/>
                                            @endif
                                        </td>
                                        <td>

                                            @if($medicineItem['is_saved'])
                                                <button class="btn btn-sm btn-primary"
                                                        wire:click.prevent="editMedicine({{$index}})">
                                                    تعديل
                                                </button>
                                            @elseif($medicineItem['medicine_id'])
                                                <button class="btn btn-sm btn-success mr-1"
                                                        wire:click.prevent="saveMedicine({{$index}})">
                                                    حفظ
                                                </button>
                                            @endif
                                            <button class="btn btn-sm btn-danger"
                                                    wire:click.prevent="removeMedicine({{$index}})">
                                                   حذف
                                            </button> 
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- bd -->

                        <div class="col-lg-4 ml-auto text-right">
                            <table class="table pull-right">
                                <tr>
                                    <td style="color: red">الاجمالي</td>
                                    <td>{{ number_format($subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="color: red">قيمة الخصم</td>
                                    <td width="125">
                                        <input type="number" wire:model="discount_value" name="discount_value" class="form-control w-75 d-inline">
                                    </td>
                                </tr>
    
                                <tr>
                                    <td style="color: red">نسبة الضريبة</td>
                                    <td>
                                        <input type="number" wire:model="taxes" name="taxes" class="form-control w-75 d-inline" min="0" max="100" value="15"> %
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: red">قيمة الضريبة</td>
                                    <td class="form-control">{{ number_format($tax_value, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="color: red">الاجمالي شامل الضريبة</td>
                                    <td>{{ number_format($total, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div><!-- bd -->
                    </div>
                </div><!-- bd -->
          
        </div>
        <input class="btn btn-outline-success" type="submit" value="تاكيد البيانات">

    </form>
@endif

</div>
