@extends('Dashboard.layouts.master')
@section('title')
كشوفات المرضي
@stop
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الصيدلية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ كشوفات المرضي</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				 <!-- row opened -->
				 <div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table style="text-align: center" class="table text-md-nowrap" id="example1">
										<thead>
										<tr>
											<th>#</th>
											<th>اسم المريض</th>
											<th >رقم الفاتورة</th>
											<th>الطبيب</th>
											<th>التشخيص</th>
											<th>الدواء</th>
											<th >العمليات</th>
										</tr>
										</thead>
										<tbody>
									   @foreach($pharmacies as $pharmacy)
										   <tr>
											   <td>{{$loop->iteration}}</td>
											   <td>{{$pharmacy->Patient->name}}</td>
											   <td>{{ $pharmacy->invoice_id  }}</td>
											   <td>{{ $pharmacy->doctor->name }}</td>
											   <td>{{ $pharmacy->diagnosis }}</td>
											   <td>{{ $pharmacy->medicine }}</td>
											   <td>
												   <a class=" btn btn-sm btn-info" href="{{route('medicine-invoice',$pharmacy->id)}}"><i class="las la-pen"></i>اضافة فاتورة</a>
												   <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$pharmacy->id}}"><i class="las la-trash"></i>حذف</a>
											   </td>
										   </tr>
										   {{-- @include('livewire.pharmacy.medicine-invoice') --}}
									   @endforeach
										</tbody>
									</table>
								</div>
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
			</div>
			<!-- row closed -->
@endsection
@section('js')
@endsection