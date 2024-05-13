@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Vendor Management'])
   <div class="container-fluid py-4">
        <div class="row mb-5">
            <div class="col-lg-9 col-12 mx-auto">
                <div class="card card-body mt-4">
                   <h6 class="mb-0">Edit Vendor</h6>
                   <hr class="horizontal dark my-3">
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
                    <form method="POST" action="{{route('vendor.update',$vendor->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$vendor->name}}" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>

                        <div class="mb-3">
                        <label for="name" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$vendor->email}}" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>

                        <label for="choices-category" class="form-label mt-4">Category</label>
                    <select name="category" class="form-control">
                        <option value>Select Category</option>
                        @foreach($category as $cat)
                        <option value="{{$cat->id}}" @if($cat->id == $vendor->category_id) selected @endif>{{$cat->name}}</option>
                        @endforeach
                    </select>
                        @if($vendor->image)                                    
                        <img src="{{ asset('uploads/vendor/'.$vendor->image) }}" class="avatar-xxl border-radius-lg shadow-sm mt-4">
                        @endif

                        <div class="d-flex flex-column">
                            <label class="mt-4 form-label" for="picture">Change Image</label>
                            <input type="file" name="file" accept="image/*" id="picture" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn bg-primary m-0 ms-2" style="color:#fff">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
