@extends('backend.layouts.master')
@section('content')
<div class="pagetitle">
    <div class="row">
        <div class="col-md-8">
            <h1>Category</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Category</li>
                    <div>
                </ol>
            </nav>
        </div>
        <div class="col-md-4" style="text-align: right;">
            <div class="">
                <a class="" href="#" data-bs-toggle="modal" data-bs-target="#unitModal">
                    <i class="ri-add-circle-line"></i>
                    <span>Add New</span>
                </a>
            </div>
        </div>
    </div>   
</div>
<!-- End Page Title -->

<section class="section category">
    <table class="table datatable">
        <thead>
            <tr>
              <th>SL.</th>
            <th>
              <b>N</b>ame
            </th> 
            <th>Related To</th>
            <th>Related Value</th>
            <th>Final Value</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($units as $data)
           @php
                $count_ru = App\Models\Unit::where('related_unit_id', $data->id)->count();
                // $count_pro = App\Models\Product::where('unit_id', $data->id)->count();
            @endphp
              <tr>
                <td> {{ $loop->index + 1}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->related_unit ? $data->related_unit->name : '-' }}</td> 
                <td>{{$data->related_value ? $data->related_value : '-' }}</td>
                <td>
                    @if ($data->related_unit)
                        {{ $data->name }} = 1
                        {{ $data->related_unit ? $data->related_unit->name : '-' }}
                        {{ $data->related_sign ? $data->related_sign : '-' }}
                        {{ $data->related_value ? $data->related_value : '-' }}
                    @endif
                </td>
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
                    <form action="{{ route('unit.update', $data->id) }}" method="post">
                      @method('PUT')
                      @csrf
                      <div class="modal-header">
                        <h1 class="modal-title fs-5"  id="{{ $data->id }}" >category Edit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                       <div class="modal-body">
                        <div class="row">
                          
                          <div class="col-6">
                            <label for="inputSatability" class="form-label">Unit Name *</label>
                            <input type="text" class="form-control" name="name" id="inputSatability" placeholder="Enter Unit Name" required>
                          </div>
                          <div class="col-6">
                            <label for="related_unit_id" class="form-label">Related Unit*</label>
                            <select class="form-select" id="inputSatability" name="related_unit_id">
                                <option value="">Select Related Unit</option>
                                @foreach ($units as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                          <div class="col-6">
                            <label for="inputSatability" class="form-label">Related Sign *</label>
                            <input type="text" class="form-control" name="related_sign" id="inputSatability"  value="*" readonly>
                          </div>
                          <div class="col-6">
                            <label for="inputDue" class="form-label">Related Value *</label>
                            <input type="number" class="form-control"name="related_value"id="inputDue" placeholder="Enter Related Value">
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

{{-----Unit add-----}}
<div class="modal fade" id="unitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{route('unit.store')}}" method="POST">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            
            <div class="col-6">
              <label for="inputSatability" class="form-label">Unit Name *</label>
              <input type="text" class="form-control" name="name" id="inputSatability" placeholder="Enter Unit Name" required>
            </div>
            <div class="col-6">
              <label for="related_unit_id" class="form-label">Related Unit*</label>
              <select class="form-select" id="inputSatability" name="related_unit_id">
                  <option value="">Select Related Unit</option>
                  @foreach ($units as $data)
                      <option value="{{ $data->id }}">{{ $data->name }}</option>
                  @endforeach
              </select>
          </div>
            <div class="col-6">
              <label for="inputSatability" class="form-label">Related Sign *</label>
              <input type="text" class="form-control" name="related_sign" id="inputSatability"  value="*" readonly>
            </div>
            <div class="col-6">
              <label for="inputDue" class="form-label">Related Value *</label>
              <input type="number" class="form-control"name="related_value"id="inputDue" placeholder="Enter Related Value">
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