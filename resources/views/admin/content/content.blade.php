@extends("layouts.admin")
@section("title")
    All Content 
@endsection
@php
    $content = App\DuaList::orderBy("id", "desc")->get();
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
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title m-0">All Contents</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Created Date</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($content as $show)
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td> {{ $show->title }} </td>
                                        <td class="text-center"> {{ $show->getCat->title }} </td>
                                        <td class="text-center">
                                            {{ date("d M Y | H:i a", strtotime($show->created_at)) }}
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-sm">
                                                <a href="{{ url('admin/content/edit/'.$show->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="{{ url('admin/content/details/'.$show->id) }}" class="btn btn-sm btn-success">Details</a>
                                                <a href="{{ url('admin/content/delete/'.$show->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you want delete this content?')">Delete</a>
                                            </div>
                                        </td>
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
    
    <script src="{{ asset('assets') }}/js/script.js"></script>
    <script>
        @if(Session::has('success'))
        Swal.fire(
                {
                    title: "Successfull",
                    text: '{{ Session::get('success') }}',
                    type: 'success',
                    confirmButtonColor: '#00c851'
                }
            )
        @endif
    </script>
@endsection