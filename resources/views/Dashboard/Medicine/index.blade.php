@extends('Dashboard.layouts.master')
@section('title')
قائمة الادوية
@stop
@section('css')
 <!-- Internal Data table css -->
 <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
 <!--Internal   Notify -->
 <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الصيدلية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الادوية</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
@include('Dashboard.messages_alert')
				<!-- row -->
                <div class="row row-sm">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <!-- Button trigger modal -->
                                    <a class=" btn btn btn-primary" href="{{route('medicines.create')}}">إضافة دواء</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table text-md-nowrap" id="example1" style="text-align: center">
                                            <thead>
                                                <tr>
                                                    <th class="wd-10p border-bottom-0">#</th>
                                                    <th class="wd-10p border-bottom-0">اسم الدواء</th>
                                                    <th class="wd-10p border-bottom-0">المجموعة</th>
                                                    <th class="wd-10p border-bottom-0">الشركة</th> 
                                                    <th class="wd-10p border-bottom-0">التكلفة</th>
                                                    <th class="wd-10p border-bottom-0">السعر</th> 
                                                    <th class="wd-10p border-bottom-0">تاريخ الصلاحية</th>
                                                    <th class="wd-10p border-bottom-0">ملاحظات</th>
                                                    <th class="wd-10p border-bottom-0">العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($medicines as $medicine)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{ $medicine->name }}</td>
                                                        <td>{{ $medicine->group }}</td>
                                                        <td>{{ $medicine->company }}</td>
                                                        <td>{{ $medicine->cost }}</td>
                                                        <td>{{ $medicine->price }}</td>
                                                        <td>{{ $medicine->exp}}</td>
                                                        <td>{{ $medicine->note}}</td>
                                                        <td>
                                                            <a class=" btn btn-sm btn-info" href="{{route('medicines.edit',$medicine->id)}}"><i class="las la-pen"></i></a>
                                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$medicine->id}}"><i class="las la-trash"></i></a>
                                                        </td>
                                                    </tr>
                                              @include('Dashboard.Medicine.delete')
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- row closed -->
                    </div>
                    <!-- row closed -->
                </div>
           
@endsection
@section('js')
<!--Internal  Notify js -->
<script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection