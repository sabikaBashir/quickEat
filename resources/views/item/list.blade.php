@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Food Item Management'])
   <div class="container-fluid py-4">
    <div class="row mt-4">
      <div class="col-12">
      @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card">

        <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">Item Management</h5>
        <a href="{{route('item.create')}}" class="btn bg-primary btn-sm float-end mb-0" style="color:#fff">Add Item</a>
        </div>

        <div class="table-responsive">
            <table class="table table-flush dataTable-table" id="datatable-basic">
                <thead class="thead-light">
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="" style="width: 23.5212%;">Name
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="false" style="width: 50.6265%;">Photo
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="" style="width: 22.4011%;">Category
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="" style="width: 42.5621%;">Price
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="" style="width: 42.5621%;">Status
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="" style="width: 40.322%;">Creation Date
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="false" style="width: 23.5212%;">Action
                        </th>
                    </tr>
                </thead>
                
                <tbody>
                  @if(count($item)>0)
                    @foreach($item as $row)
                    <tr>
                        <td class="text-sm font-weight-normal">{{$row->name}}</td>
                        <td class="text-sm font-weight-normal">
                            <span class="my-2 text-xs">
                            @if($row->image)
                             <img src="{{ asset('uploads/item/'.$row->image) }}" class="border-radius-lg shadow-sm height-100 w-auto" alt="user1">    
                            @else
                             <img src="{{ asset('uploads/item/default-img.png') }}" class="border-radius-lg shadow-sm height-100 w-auto" alt="user1">    
                            @endif                            </span>
                        </td>
                        <td class="text-sm font-weight-normal">{{$row->category->name ?? '--'}}</td>
                        <td class="text-sm font-weight-normal">{{$row->price}}</td>
                        <td class="text-sm font-weight-normal">
                            <span class="my-2 text-xs">
                                @if($row->status == 'active')
                                    <span class="badge" style="background-color: #49af28;color:#fff">Active</span>
                                @else
                                    <span class="badge " style="background-color: #c21801;color:#fff">Inactive</span>
                                @endif
                                </span>
                        </td>
                        <td class="text-sm font-weight-normal">{{$row->created_at}}</td>
                        <td class="text-sm">
                            <span class="d-flex">
                                <a href="{{route('item.edit',$row->id)}}" class="me-3" data-bs-toggle="tooltip" data-bs-original-title="Edit item">
                                <i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
                                </a>
                                <form action="{{route('item.destroy',$row->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="confirm('Are you sure you want to delete the Item?')"  class="border-0 bg-white" type="submit">            
                                <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
                                </button>
                                </form>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                  @else
                    <tr>
                        <td style="text-align: center;" colspan="6">No data to display</td>
                    <tr>
                  @endif
                </tbody>
            </table>
        </div>
     </div>
    </div>
   </div>
  </div>
@endsection
