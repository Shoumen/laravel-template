@extends('backend.layouts.master')
@section('content')
<div class="pagetitle">
    <div class="row">
        <div class="col-md-8">
            <h1>Users</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">All User</li>
                    <div>
                </ol>
            </nav>
        </div>
        <div class="col-md-4" style="text-align: right;">
            <div class="">
                <a class="" href="{{route('user.create')}}">
                    <i class="ri-add-circle-line"></i>
                    <span>Add New</span>
                </a>
            </div>
        </div>
    </div>   
</div>
<!-- End Page Title -->

<section class="section customer">
    <table class="table datatable">
        <thead>
            <tr>
              <th>SL.</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Status</th>
            <th>Image</th>
            <th>Created By</th>
            <th>Updated By</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $data)
              <tr>
                <td> {{ $loop->index + 1}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->status}}</td>
                <td>{{$data->image}}</td>
                <td>{{$data->creator?->name}}</td>
                <td>{{$data->updated_by}}</td>
                <td class="table_data_style_right">
                  <div class="dropdown">
                      <button class="btn btn-sm btn-light dropdown-toggle" type="button"
                          id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                          Action
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <li>
                              <a class="dropdown-item d-flex align-items-center"  href="{{route('user.edit',$data->id)}}">
                                  <i class="bi bi-pencil me-2" style="font-size: 14px;"></i> <small>Edit</small>
                              </a>
                          </li>
                          <li>
                              <a class="dropdown-item d-flex align-items-center text-danger" href="#">
                                  <i class="bi bi-trash me-2" style="font-size: 14px;"></i> <small>Delete</small>
                              </a>
                          </li>
                      </ul>
                  </div>
              </td>
              </tr>
                    {{-- delete modal --}}
            {{-- <form action="{{ route('customer.destroy', $data->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <x-delete-modal title="Customer" id="{{ $data->id }}" />
            </form> --}}
          @empty
              <tr>
                <td colspan="7">No data found</td>
              </tr>
          @endforelse
          
        </tbody>
    </table>
</section>


@endsection