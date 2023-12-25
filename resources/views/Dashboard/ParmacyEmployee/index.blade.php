@extends('Dashboard.layouts.master')
@section('title')
قائمة الصيادلة
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
							<h4 class="content-title mb-0 my-auto">الصيدلية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الموظفين</span>
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
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                                        اضافة موظف 
                                     </button>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table text-md-nowrap" id="example1" style="text-align: center">
                                            <thead>
                                                <tr>
                                                    <th class="wd-15p border-bottom-0">رقم الموظف</th>
                                                    <th class="wd-15p border-bottom-0">اسم الموظف</th>
                                                    <th class="wd-15p border-bottom-0">الايميل</th>
                                                    <th class="wd-15p border-bottom-0">تاريخ الاضافة</th> 
                                                    <th class="wd-15p border-bottom-0">العمليات</th>
            
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($parmacyEmployee as $parmacy)
                                                   
                                                    <tr>
                                                        <td>{{ $parmacy->id }}</td>
                                                        <td>{{ $parmacy->name }}</td>
                                                        <td>{{ $parmacy->email }}</td>
                                                        <td>{{ $parmacy->created_at->format('Y-m-d')}}</td>
                                                        <td>
                                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"  data-toggle="modal" href="#edit{{$parmacy->id}}"><i class="las la-pen"></i></a>
                                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$parmacy->id}}"><i class="las la-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    @include('Dashboard.ParmacyEmployee.edit')
                                                    @include('Dashboard.ParmacyEmployee.delete')
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- row closed -->
                    </div>
                    @include('Dashboard.ParmacyEmployee.add')
                    <!-- row closed -->
                </div>
                
		<!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection