@extends("layouts.admin")
@section("title")
	Admin Panel
@endsection

@php
	$alluser = App\User::all();
	$thismonthuser = App\User::whereMonth("created_at", "=", date("m"))->get();
	$categories = App\MainCategory::all();
	$contents = App\DuaList::all();
	$last10register = App\User::take(10)->orderBy("id", "desc")->get();
	$last20dua = App\DuaList::take(20)->orderBy("id", "desc")->get();
@endphp

@section("body")
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title m-0">Dashboard</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-heading p-4">
                    <div class="body">
                        <h2 class="text-primary mb-0">{{ $alluser->count() }}</h2>
                        <p class="text-muted mb-0 mt-2">Total Users</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-heading p-4">
                    <div class="body">
                        <h2 class="text-primary mb-0">{{ $contents->count() }}</h2>
                        <p class="text-muted mb-0 mt-2">Total Content</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
           <div class="card">
                <div class="card-heading p-4">
                    <div class="body">
                        <h2 class="text-primary mb-0">{{ $categories->count() }}</h2>
                        <p class="text-muted mb-0 mt-2">Categories</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-heading p-4">
                    <div class="body">
                        <h2 class="text-primary mb-0">{{ $thismonthuser->count() }}</h2>
                        <p class="text-muted mb-0 mt-2">This Months Users</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="m-b-30 m-t-0">Last Contact Messages</h4>
                    <div class="inbox-widget slimscroller" style="height:300px;">

                        <div class="media inbox-item"  style="border-bottom: 1px solid rgba(0,0,0,0.1); margin-bottom: 15px">
                            <img class="mr-3 rounded-circle" src="{{ asset('assets') }}/images/users/thumb.png" alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="mt-0">Clinton Murphy</h5>
                                <p class="text-muted">Nullam id tincidunt ante on auctor lacus vivamus laoreet pellentesque quam aliquam efficitur.</p>
                                <p class="inbox-item-time">5 mins ago</p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- end col -->

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="m-b-30 m-t-0">Last Registered Users Lists</h4>
                    <div class="inbox-widget slimscroller" style="max-height:360px;">
						@foreach($last10register as $user)
						@php
							$now = Carbon\Carbon::now();
							$diff = $now->diffForHumans($user->created_at, true);
						@endphp
                        <div class="media inbox-item" style="border-bottom: 1px solid rgba(0,0,0,0.1); margin-bottom: 15px">
                        	@if($user->pic)
                        	@else
                            	<img class="mr-3 rounded-circle" src="{{ asset('assets') }}/images/users/thumb.png" alt="{{ $user->name }}">
                            @endif
                            <div class="media-body">
                                <h5 class="mt-0">{{ $user->name }}</h5>
                                <p class="text-muted">{{ $user->email }}</p>
                                <p class="inbox-item-time"> {{ $diff }} Ago </p>
                            </div>
                        </div>
						@endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="m-b-30 m-t-0">Last Added Contents</h4>
                    <div class="inbox-widget slimscroller" style="max-height:360px;">
                    	@if($last20dua->count() > 0)
						@foreach($last20dua as $dua)
                        <a href="{{ url('admin/content/details/'.$dua->id) }}">
                            <div class="media inbox-item px-2" style="border-bottom: 1px solid rgba(0,0,0,0.1); margin-bottom: 15px">
                                <div class="media-body">
                                    <p class="inbox-item-time">5 mins ago</p>
                                    <h5 class="mt-0">{{ $dua->title }}</h5>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        @else
                        <div class="media inbox-item"  style="border-bottom: 1px solid rgba(0,0,0,0.1); margin-bottom: 15px">
                            <div class="media-body">
                                <h5 class="mt-0">No Contents Found</h5>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end container-fluid -->
</div>
@endsection