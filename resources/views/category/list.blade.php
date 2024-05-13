@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Category Management'])
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
        <h5 class="mb-0">Category Management</h5>
        <a href="{{route('category.create')}}" class="btn bg-primary btn-sm float-end mb-0" style="color:#fff">Add Category</a>
        </div>

        <div class="table-responsive">
            <table class="table table-flush dataTable-table" id="datatable-basic">
                <thead class="thead-light">
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="" style="width: 22.1771%;"><a href="#" class="dataTable-sorter">Name</a></th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="" style="width: 40.322%;"><a href="#" class="dataTable-sorter">Creation Date</a></th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" data-sortable="false" style="width: 23.5212%;">Action
                        </th>
                    </tr>
                </thead>
                
                <tbody>
                @if(count($category) > 0)
                    @foreach($category as $row)
                    <tr>
                        <td class="text-sm font-weight-normal">{{$row->name}}</td>
                        <td class="text-sm font-weight-normal">{{$row->created_at}}</td>
                        <td class="text-sm">
                            <span class="d-flex">
                            <a href="{{route('category.edit',$row->id)}}" class="me-3" data-bs-toggle="tooltip" data-bs-original-title="Edit category">
                            <i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
                            </a>
                            <form action="{{route('category.destroy',$row->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button onclick="confirm('Are you sure you want to delete the category?')"  class="border-0 bg-white" type="submit">
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
