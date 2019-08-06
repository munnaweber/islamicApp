@extends("layouts.admin")
@section("title")
All Content Category
@endsection
@php
    $category = App\MainCategory::all();
    $sl = 1;
@endphp
@section("css")
<!-- DataTables -->
<link href="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets') }}/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets') }}/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets') }}/plugins/datatables/scroller.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section("body")
<div class="container-fluid">
    <!-- Page-Title -->
      <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title m-0">All Contents</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="5%">Sl</th>
                                        <th>Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category as $show)
                                    <tr>
                                        <td class="text-center">{{ $sl++ }}</td>
                                        <td>{{ $show->title }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div> <!-- End Row -->
    </div>
    @endsection
    @section("js")
    <!-- Required datatable js-->
    <script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    
    <script src="{{ asset('assets') }}/plugins/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables/dataTables.keyTable.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables/dataTables.scroller.min.js"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets') }}/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <!-- Datatable init js -->
    <script src="{{ asset('assets') }}/pages/datatables.init.js"></script>
    @endsection