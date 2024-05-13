@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Advertisement Management'])
    <div class="container-fluid py-4">

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
    <div class="row mb-5">
        <div class="col-lg-9 col-12 mx-auto">
            <div class="card card-body mt-4">
                <h6 class="mb-0">Edit Advertisement</h6>
                <hr class="horizontal dark my-3">
                
                <form method="POST" action="{{route('advertisement.update',$advertisement->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                     <div>
                        <label class="mt-4 form-label" for="picture">Heading</label>
                        <input type="text" class="form-control" id="heading" name="heading" value="{{$advertisement->heading}}" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                    @if($advertisement->image)                                    
                    <img src="{{ asset('uploads/advertisement/'.$advertisement->image) }}" class="avatar-xxl border-radius-lg shadow-sm mt-4">
                    @endif
                    <div class="d-flex flex-column">
                        <label class="mt-4 form-label" for="picture">Change Image</label>
                        <input type="file" name="file" accept="image/*" id="file" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                    
                    <label class="mt-4">Description</label>
                    <div>
                        <textarea name="description" rows="2" class="w-100 form-control">{{$advertisement->description}}</textarea>
                    </div>
                    
                    <div class="row mt-4 d-flex flex-column">
                        <label class="form-label">Item Status</label>
                        <div class=" d-flex flex-column">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="status" id="Active" value="active" @if($advertisement->status == 'active')checked @endif>
                                <label class="custom-control-label" for="active">Active</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="status" id="draft" value="inactive" @if($advertisement->status == 'inactive')checked @endif>
                                <label class="custom-control-label" for="draft">InActive</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn bg-primary m-0 ms-2" style="color:#fff">Create</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection
