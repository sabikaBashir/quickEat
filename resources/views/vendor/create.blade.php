@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Vendor Management'])
   <div class="container-fluid py-4">
        <div class="row mb-5">
            <div class="col-lg-9 col-12 mx-auto">
                <div class="card card-body mt-4">
                   <h6 class="mb-0">New Vendor</h6>
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
                    <form method="POST" action="{{route('vendor.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>

                        <div class="mb-3">
                        <label for="name" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>

                        <div class="mb-3">
                        <label for="choices-category" class="form-label ">Category</label>
                        <select name="category" class="form-control">
                        <option value>Select Category</option>
                        @foreach($category as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                        </select>
                        </div>

                        <div class="mb-3">
                        <label for="name" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                        
                        <div class="d-flex flex-column">
                        <label class="mt-4 form-label" for="picture">Add Image</label>
                        <input type="file" name="file" accept="image/*" id="picture" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn bg-primary m-0 ms-2" style="color:#fff">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
