@extends('Dashboard.layouts.master')
@section('css')
<!--Internal   Notify -->
<link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
    @endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/sections.sections_site') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ trans('Dashboard/sections.sections_all') }}</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                        data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
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
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                            data-target="#exampleModal">{{ trans('Dashboard/sections.create') }}</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0">{{ trans('Dashboard/sections.section_name') }}
                                        </th>
                                        <th class="wd-15p border-bottom-0">{{ trans('Dashboard/sections.description') }}
                                        </th>
                                        <th class="wd-20p border-bottom-0">{{ trans('Dashboard/sections.section_date') }}
                                        </th>
                                        
                                        <th class="wd-15p border-bottom-0">{{ trans('Dashboard/sections.operations') }}
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($sections as $section)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td><a href="{{ route('Sections.show',$section->id) }}">{{ $section->name }}</a></td>
                                            <td>{{ \Str::limit($section->description,50) }}</td>
                                            <td>{{ $section->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"  data-toggle="modal" href="#edit{{$section->id}}"><i class="las la-pen"></i></a>
                                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$section->id}}"><i class="las la-trash"></i></a>
                                            </td>
                                        </tr>
                                        @include('Dashboard.Sections.edit')
                                        @include('Dashboard.Sections.delete')
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
    @include('Dashboard.Sections.create')
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
     <!--Internal  Notify js -->
     <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
     <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection
