@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Food Item Management'])
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
      <div class="row">
        <div class="col-lg-9 col-12 mx-auto">
            <div class="card card-body mt-4">
            
            <h6 class="mb-0">Edit Item</h6>
            <hr class="horizontal dark my-3">
            
                <form method="POST" action="{{route('item.update',$item->id)}}" enctype="multipart/form-data" class="item-form">
                    
                    @CSRF
                    @method('PUT')

                    <div>
                        <?php
                        $value = ""; 
                            foreach($category as $cat){
                                if($cat->id == Auth::user()->category_id){ $value = $cat->name; }
                            }
                        ?>
                        <label class="mt-4 form-label" for="picture">Category</label>
                        <input type="text" class="form-control" id="category" name="category" value="{{$value}}" readonly onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>

                    <div>
                        <label class="mt-4 form-label" for="picture">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$item->name}}" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>

                    @if($item->image)                                    
                    <img src="{{ asset('uploads/item/'.$item->image) }}" class="avatar-xxl border-radius-lg shadow-sm mt-4">
                    @endif

                    <div class="d-flex flex-column">
                        <label class="mt-4 form-label" for="picture">Change Image</label>
                        <input type="file" name="file" accept="image/*" id="picture" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                    
                    <label class="mt-4">Description</label>
                    <div>
                        <textarea name="description" rows="2" class="w-100 form-control">{{$item->description}}</textarea>
                    </div>
                    <div>
                        <label class="mt-4 form-label" for="picture"  >Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{$item->price}}"onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                            
                    <div>
                        <label class="mt-4 form-label" for="picture">Ingredients</label>
                        <input type="text" class="form-control" id="ingredients" name="ingredients" value="{{$item->ingredients}}" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>

                    <div class="row mt-4 d-flex flex-column">
                        <label class="form-label">Item Status</label>
                        <div class=" d-flex flex-column">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="status" id="Active" value="active" @if($item->status == 'active')checked @endif>
                                <label class="custom-control-label" for="active">Active</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="status" id="draft" value="inactive" @if($item->status == 'inactive')checked @endif>
                                <label class="custom-control-label" for="draft">InActive</label>
                            </div>
                        </div>
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
