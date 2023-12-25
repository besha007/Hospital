@extends('Dashboard.layouts.master')
@section('title')
اضافة دواء
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
							<h4 class="content-title mb-0 my-auto"><a href="{{route('medicines.index')}}">الادوية</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/اضافة</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
@include('Dashboard.messages_alert')
				<!-- row -->
				<div class="row">

                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('medicines.store') }}" method="post" enctype="multipart/form-data"autocomplete="off">
                                    {{ csrf_field() }}
            
                                    <div class="row">
                                        <div class="col">
                                            <label for="inputName" class="control-label">اسم الدواء</label>
                                            <input type="text" class="form-control" id="inputName" name="name"
                                                title="يرجي ادخال اسم الدواء" required>
                                        </div>

                                        <div class="col">
                                            <label for="inputName" class="control-label">المجموعة</label>
                                            <input type="text" class="form-control" id="inputName" name="group"
                                                title="يرجي ادخال اسم المجموعة" required>
                                        </div>
            
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="inputName" class="control-label">الشركة</label>
                                            <input type="text" class="form-control" id="inputName" name="company"
                                                title="يرجي ادخال اسم الشركة المصنعة" required>
                                        </div>
            
                                        <div class="col">
                                            <label for="inputName" class="control-label">التكلفة</label>
                                            <input type="number" class="form-control" id="inputName" name="cost"
                                                title="يرجي ادخال تكلفة الدواء" required>
                                        </div>
                                    </div>
            
                                    <div class="row">
                                        <div class="col">
                                            <label for="inputName" class="control-label">السعر</label>
                                            <input type="number" class="form-control" id="inputName" name="price"
                                                title="يرجي ادخال سعر الدواء" required>
                                        </div>

                                        <div class="col">
                                            <label for="inputName" class="control-label">الصلاحية</label>
                                            <input type="date" class="form-control" id="inputName" name="exp"
                                                title="يرجي ادخال تاريخ الصحلاحية" required>
                                        </div>
                                    </div>
            
                                    <div class="row">
                                        <div class="col">
                                            <label for="exampleTextarea">ملاحظات</label>
                                            <textarea class="form-control" id="exampleTextarea" name="note" rows="3"></textarea>
                                        </div>
                                    </div><br>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                                    </div>
            
                                   
                                </form>
                            </div>
                        </div>
                    </div>

				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Notify js -->
<script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection