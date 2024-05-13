@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Advertisement Management'])
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
                    <h5 class="mb-0">Advertisement Management</h5>
                    @if(Auth::user()->role == 'vendor')
                    <a href="{{route('advertisement.create')}}" class="btn  btn-sm float-end mb-0" style="background-color:#c21801;color:#fff">Add advertisment</a>
                    @endif
                </div>

                <div class="table-responsive">
                    <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-height fixed-columns">
                        <div class="dataTable-top">
                            <div class="dataTable-dropdown">
                    <table class="table table-flush dataTable-table" id="datatable-basic">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="false" >Profile</th>
                                </a></th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="" >
                                Heading
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="">
                                Description</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="">
                                Status</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="">
                                Admin Approvel</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="" >
                                Created At
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="false" style="width: 15.267%;">
                                Action
                                </th>
                            </tr>
                        </thead>
                    
                        <tbody>
                        @if(count($advertisment) > 0)
                            @foreach($advertisment as $row)
                            <tr>
                                <td class="text-sm font-weight-normal" style="text-align:center">
                                    <span class="my-2 text-xs">
                                    @if($row->image)
                                    <img src="{{ asset('uploads/advertisement/'.$row->image) }}" class="avatar avatar-sm me-3" alt="user1">    
                                    @else
                                    <img src="{{ asset('uploads/advertisement/default-img.png') }}" class="avatar avatar-sm me-3" alt="user1">    
                                    @endif
                                </span>
                                </td>
                                <td class="text-sm font-weight-normal">{{$row->heading}}</td>
                                <td class="text-sm font-weight-normal">{{$row->description}}</td>
                                <td class="text-sm font-weight-normal">
                                    <span class="my-2 text-xs">
                                        @if($row->status == 'active')
                                            <span class="badge" style="background-color: #49af28;color:#fff">Active</span>
                                        @else
                                            <span class="badge " style="background-color: #c21801;color:#fff">Inactive</span>
                                        @endif
                                        </span>
                                </td>
                                <td class="text-sm font-weight-bold">
                                    <div class="d-flex align-items-center">
                                        @if($row->approve == 'approve')
                                            <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-check" aria-hidden="true"></i></button>
                                            <span>Accept</span>
                                        @elseif($row->approve == 'reject')
                                            <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-times" aria-hidden="true"></i></button>
                                            <span >Reject</span>
                                        @else
                                            --
                                        @endif
                                    </div>
                                </td>
                                <td class="text-sm font-weight-normal">{{$row->created_at}}</td>
                                <td class="text-sm">
                                    <span class="d-flex">
                                        @if(Auth::user()->role == 'admin')
                                        <a href="{{route('adds.approve', [$row->id,'approve'])}}" class="btn btn-success btn-xs">Approve</a>
                                        <a href="{{route('adds.approve', [$row->id,'reject'])}}" class="btn btn-danger btn-xs">Reject</a>
                                       
                                        @elseif(Auth::user()->role == 'vendor')
                                        <a href="{{route('advertisement.edit',$row->id)}}" class="me-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                          <i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
                                        </a>
                                        <form action="{{route('advertisement.destroy',$row->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                             <button onclick="confirm('Are you sure you want to delete the advertisment?')"  class="border-0 bg-white" type="submit">
                                                 <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
  </div>
  </div>
 </div>
@endsection
