<!-- row opened -->
<button class="btn btn-outline-primary pull-right" wire:click="show_form_add" type="button">اضافة فاتورة</button><br><br>
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1" style="text-align: center">
                        <thead>
                           
                            <tr>

                                <th>رقم الفاتورة</th>
                                <th >تاريخ الفاتورة</th>
                                <th >اسم المريض</th>
                                <th>الطبيب</th>
                                <th>الاجمالي</th>
                                <th>الخصم</th>
                                <th>الضريبة</th>
                                <th>الاجمالي شامل الضريبة</th>
                                <th>نوع الفاتورة</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pharmacy_invoices as $pharmacy)
                            <tr>
                                <td>{{ $pharmacy->id }}</td>
                                <td>{{ $pharmacy->created_at->format('Y-m-d') }}</td>
                                <td>{{ $pharmacy->Patient->name }}</td>
                                <td>{{ $pharmacy->Doctor->name }}</td>
                                <td>{{ $pharmacy->Total_before_discount }}</td>
                                <td>{{ $pharmacy->discount_value }}</td>
                                <td>{{ $pharmacy->tax_rate }}</td>
                                <td>{{ $pharmacy->Total_after_discount }}</td>
                                <td>{{ $pharmacy->type == 1 ? 'نقدي':'اجل' }}</td>
                                <td>
                                    <button title="تعديل" wire:click="edit({{ $pharmacy->id }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                                    <button title="عرض" wire:click="print({{ $pharmacy->id }})" type="button" class="btn btn-info btn-sm"><i class="fa fa-print"></i></button>
                                    <button title="حذف" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteInvoice{{$pharmacy->id}}"><i class="fa fa-trash"></i></button>
                                </td>
                               
                            </tr>
                            @include('livewire.Medicine.delete')
                            @endforeach
                        </tbody>
                    </table>
                 
                </div>
    <!--/div-->
