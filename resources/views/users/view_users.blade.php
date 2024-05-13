@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Student Management'])
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
                    <h5 class="mb-0">Student Management</h5>
                </div>

                <div class="table-responsive">
                    <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-height fixed-columns">
                        <div class="dataTable-top">
                            <div class="dataTable-dropdown">
                    <table class="table table-flush dataTable-table" id="datatable-basic">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="false" >Profile</th>
                                </a></th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="" ><a href="#" class="dataTable-sorter">
                                ID
                                </a></th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="" ><a href="#" class="dataTable-sorter">Name
                                </a></th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable=""><a href="#" class="dataTable-sorter">
                                Email
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="" ><a href="#" class="dataTable-sorter">
                                Created At
                                </a></th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="false" style="width: 15.267%;">
                                Action
                                </th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="text-sm font-weight-normal" style="text-align:center">
                                    <span class="my-2 text-xs">
                                    @if($user->image)
                                    <img src="{{ asset('uploads/user/'.$user->image) }}" class="border-radius-lg shadow-sm height-100 w-auto" alt="user1">    
                                    @else
                                    <img src="{{ asset('uploads/user/default-img.jpg') }}" class="border-radius-lg shadow-sm height-100 w-auto" alt="user1">    
                                    @endif
                                </span>
                                </td>
                                <td class="text-sm font-weight-normal">{{$user->student_ID}}</td>
                                <td class="text-sm font-weight-normal">{{$user->name}}</td>
                                <td class="text-sm font-weight-normal">{{$user->email}}</td>
                                <td class="text-sm font-weight-normal">{{$user->created_at}}</td>
                                <td class="text-sm">
                                    <span class="d-flex">
                                        <a href="{{route('users.edit',$user->id)}}" class="me-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                          <i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
                                        </a>
                                        <form action="{{route('users.destroy',$user->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                             <button onclick="confirm('Are you sure you want to delete the user?')"  class="border-0 bg-white" type="submit">
                                                 <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
  </div>
  </div>
 </div>
@endsection
