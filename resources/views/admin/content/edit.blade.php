@extends("layouts.admin")
@section("title")
Update Content
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
                    <form action="{{ url('admin/panel/update/content/post') }}" method="post"> @csrf
                        <input type="hidden" name="id" value="{{ $content->id }}">
                        <h4 class="m-b-30 m-t-0">Update Content</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="demo-box">
                                    <h6 class="text-muted"><b>Content Title</b></h6>
                                    <input type="text" class="form-control @error("title") is-invalid @enderror "name="title" id="title" placeholder="Enter content title" value="{{ $content->title }}" />
                                    @error("title")
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="demo-box">
                                    <h6 class="text-muted"><b>Content Category</b></h6>
                                   <select class="form-control @error('category') is-invalid @enderror" name="category">
                                        <option value="">Select Category</option>
                                        @foreach($category as $show)
                                            <option value="{{ $show->id }}" {{ $content->category == $show->id ? 'selected' : '' }} >{{ $show->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="demo-box">
                                    <h6 class="text-muted"><b>Content Descriptions</b></h6>
                                    <textarea type="text" class="form-control tinyarea @error("description") is-invalid @enderror " name="description" id="description" placeholder="Enter content description">{!! $content->details !!}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                             <div class="col-lg-12 mt-3 text-center">
                                <div class="demo-box">
                                   <button type="submit" class="btn btn-md btn-dark">
                                       Update Content
                                   </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- end row -->
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div>
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