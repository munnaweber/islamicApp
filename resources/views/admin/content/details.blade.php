@extends("layouts.admin")
@section("title")
Details Content
@endsection
@php
    // $content = App\DuaList::orderBy("id", "desc")->get();
    $category = App\MainCategory::all();
@endphp

@section("body")
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="m-b-30 m-t-0">{{ $content->title }}</h4>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <strong>
                                ক্যাটাগরিঃ {{ $content->getCat->title }}
                            </strong>
                        </div>
                        <div class="col-12 mt-2">
                            {!! $content->details !!}
                        </div>
                        <div class="col-12 mt-2">
                            {{ $content->created_at }}
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div>
@endsection

@section("css")
<style>
    p[Attributes Style] {
        direction: rtl;
        text-align: right!important;
        unicode-bidi: isolate;
    }
</style>
@endsection

@section("js")
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