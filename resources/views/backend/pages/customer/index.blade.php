@extends('backend.layouts.master')
@section('content')
<div class="pagetitle">
    <div class="row">
        <div class="col-md-8">
            <h1>Customer</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Customer</li>
                    <div>
                </ol>
            </nav>
        </div>
        <div class="col-md-4" style="text-align: right;">
            <div class="">
                <a class="" href="#" data-bs-toggle="modal" data-bs-target="#customerModal">
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
            <th>SL.</th>
          <tr>
            <th>
              <b>N</b>ame
            </th>
            <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
            <th>Address & Phone</th>
            <th>Personal Stability</th>
            <th>Due Stability</th>
            <th>Created By</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($customers as $data)
              <tr>
                <td> {{ $loop->index + 1}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->date}}</td>
                <td>{{$data->phone}}<br>{{$data->address}}</td>
                <td>{{$data->personal_balance}}</td>
                <td>{{$data->due_balance}}</td>
                <td>{{$data->creator ?->name}}</td>
                <td class="table_data_style_right">
                  <div class="dropdown">
                      <button class="btn btn-sm btn-light dropdown-toggle" type="button"
                          id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                          Action
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <li>
                              <a class="dropdown-item d-flex align-items-center" 
                                data-bs-toggle="modal" data-bs-target="#editModal-{{$data->id}}" href="#">
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
              {{-- edit modal --}}
              <div class="modal fade" id="editModal-{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="{{ route('customer.update', $data->id) }}" method="post">
                      @method('PUT')
                      @csrf
                      <div class="modal-header">
                        <h1 class="modal-title fs-5"  id="{{ $data->id }}" >Customer Edit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-12">
                            <label for="inputNanme4" class="form-label">Name *</label>
                            <input type="text" class="form-control" name="name" value="{{ $data->name }}" id="inputNanme4">
                          </div>
                          <div class="col-12">
                            <label for="inputPhonel4" class="form-label">Phone *</label>
                            <input type="text" class="form-control" name="phone" value="{{ $data->phone }}" id="inputPhonel4">
                          </div>
                          <div class="col-12">
                            <label for="inputEmail4" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ $data->email }}" id="inputEmail4">
                          </div>
                          <div class="col-12">
                            <label for="inputAddress" class="form-label">Address *</label>
                            <input type="text" class="form-control" name="address" value="{{ $data->address }}" id="inputAddress" placeholder="">
                          </div>
                          <div class="col-6">
                            <label for="inputSatability" class="form-label">Personal Stability</label>
                            <input type="number" class="form-control" name="personal_blance" value="{{ $data->personal_balance }}" id="inputSatability" placeholder="">
                          </div>
                          <div class="col-6">
                            <label for="inputDue" class="form-label">Due Stability</label>
                            <input type="number" class="form-control"name="personal_due" value="{{ $data->due_balance }}" id="inputDue" placeholder="">
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

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

{{-----customer add-----}}
<div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{route('customer.store')}}" method="POST">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <label for="inputNanme4" class="form-label">Name *</label>
              <input type="text" class="form-control" name="name" id="inputNanme4">
            </div>
            <div class="col-12">
              <label for="inputPhonel4" class="form-label">Phone *</label>
              <input type="text" class="form-control" name="phone" id="inputPhonel4">
            </div>
            <div class="col-12">
              <label for="inputEmail4" class="form-label">Email</label>
              <input type="text" class="form-control" name="email" id="inputEmail4">
            </div>
            <div class="col-12">
              <label for="inputAddress" class="form-label">Address *</label>
              <input type="text" class="form-control" name="address" id="inputAddress" placeholder="">
            </div>
            <div class="col-6">
              <label for="inputSatability" class="form-label">Personal Stability</label>
              <input type="text" class="form-control" name="personal_blance" id="inputSatability" placeholder="0.00">
            </div>
            <div class="col-6">
              <label for="inputDue" class="form-label">Due Stability</label>
              <input type="text" class="form-control"name="personal_due"id="inputDue" placeholder="0.00">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection