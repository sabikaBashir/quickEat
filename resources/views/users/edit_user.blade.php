@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Student Management'])
    <div class="container-fluid my-5 py-2">

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="d-flex justify-content-center mb-5">
<div class="col-lg-9 mt-lg-0 mt-4">

<div class="card card-body" id="profile">
<div class="row justify-content-center">
<div class="col-sm-auto col-4">
<div class="avatar avatar-xl position-relative">
<div>

<span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
@if($user->image)
    <img src="{{ asset('uploads/user/'.$user->image) }}" class="w-100 border-radius-lg shadow-sm" alt="user1">    
@else
    <img src="{{ asset('uploads/user/default-img.jpg') }}" class="w-100 border-radius-lg shadow-sm" alt="user1">    
@endif
</span>
</div>
</div>
</div>
<div class="col-sm-auto col-8 my-auto">
<div class="h-100">
<h3 class="mb-1 font-weight-bolder">{{$user->name}}</h3>
<p class="mb-0 font-weight-bold text-sm"><b>STUDENT-ID:</b> {{$user->student_ID}}</p>
</div>
</div>
<div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
</div>
</div>
</div>


<div class="card mt-4" id="basic-info">
<div class="card-header">
<h5>Edit Info</h5>
</div>
<div class="card-body pt-0">
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
<form method="POST" action="{{route('users.update',$user->id)}}" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="row">
<div class="col-6">
<label class="form-label">Name</label>
<div class="input-group">
<input id="name" name="name" class="form-control" type="text" value="{{$user->name}}" onfocus="focused(this)" onfocusout="defocused(this)">
</div>
</div>
<div class="col-6">
<label class="form-label">Email</label>
<div class="input-group">
<input id="email" name="email" class="form-control" type="text" value="{{$user->email}}" onfocus="focused(this)" onfocusout="defocused(this)">
</div>
</div>
</div>
<div class="d-flex flex-column">
                        <label class="mt-4 form-label" for="picture">Change Image</label>
                        <input type="file" name="file" accept="image/*" id="picture" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
<button type="submit" class="btn btn-sm float-end mt-6 mb-0"  style="background-color:#c21801;color:#fff">Update</button>
</form>
</div>
</div>
</div>
</div>
</div>
@endsection
