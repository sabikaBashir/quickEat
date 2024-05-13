@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Vendor Management'])
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
        <h5 class="mb-0">Vendor Management</h5>
        <a href="{{route('vendor.create')}}" class="btn bg-primary btn-sm float-end mb-0" style="color:#fff">Add Vendor</a>
        </div>

        <div class="table-responsive">
            <table class="table table-flush dataTable-table" id="datatable-basic">
                <thead class="thead-light">
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="" style="width: 22.1771%;"><a href="#" class="dataTable-sorter">Profile</a></th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="" style="width: 22.1771%;"><a href="#" class="dataTable-sorter">Name</a></th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="" style="width: 40.322%;"><a href="#" class="dataTable-sorter">Email</a></th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="" style="width: 40.322%;"><a href="#" class="dataTable-sorter">Created At</a></th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="false" style="width: 23.5212%;">Action
                        </th>
                    </tr>
                </thead>
                
                <tbody>
                 @if(count($vendor) > 0)
                    @foreach($vendor as $row)
                    <tr>
                        <td class="text-sm font-weight-normal" style="text-align:center">
                         <span class="my-2 text-xs">
                            @if($row->image)
                                <img src="{{ asset('uploads/vendor/'.$row->image) }}" class="avatar avatar-sm me-3" alt="user1">    
                            @else
                                <img src="{{ asset('uploads/vendor/default-img.jpg') }}" class="avatar avatar-sm me-3" alt="user1">    
                            @endif
                          </span>
                        </td>
                        <td class="text-sm font-weight-normal">{{$row->name}}</td>
                        <td class="text-sm font-weight-normal">{{$row->email}}</td>
                        <td class="text-sm font-weight-normal">{{$row->created_at}}</td>
                        <td class="text-sm">
                            <span class="d-flex">
                            <a href="{{route('vendor.edit',$row->id)}}" class="me-3" data-bs-toggle="tooltip" data-bs-original-title="Edit vendor">
                            <i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
                            </a>
                            
                            <form action="{{route('vendor.destroy',$row->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button onclick="confirm('Are you sure you want to delete the vendor?')"  class="border-0 bg-white" type="submit">
                            <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
                            </button>
                            </form>
                            </span>
                            </td>
                    </tr>
                    @endforeach
                  @else
                    <tr>
                        <td style="text-align: center;"  ></td>
                        <td style="text-align: center;">No data to display</td>
                        <td style="text-align: center;"  ></td>
                        <td style="text-align: center;"  ></td>
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
