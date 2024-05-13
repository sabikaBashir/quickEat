@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Category Management'])
   <div class="container-fluid py-4">
        <div class="row mb-5">
            <div class="col-lg-9 col-12 mx-auto">
                <div class="card card-body mt-4">
                   <h6 class="mb-0">Edit Category</h6>
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
                    <form method="POST" action="{{route('category.update',$category->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}" onfocus="focused(this)" onfocusout="defocused(this)">
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
