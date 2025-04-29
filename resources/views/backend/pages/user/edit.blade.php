@extends('backend.layouts.master')
@section('content')
<div class="pagetitle">
    <div class="row">
        <div class="col-md-8">
            <h1>Edit Users</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Edit User</li>
                    <div>
                </ol>
            </nav>
        </div>
        <div class="col-md-4" style="text-align: right;">
            <div class="">
                <a class="" href="{{route('user.index')}}">
                    <i class="bi bi-list-task"></i>
                    <span>All User</span>
                </a>
            </div>
        </div>
    </div>   
</div>
<!-- End Page Title -->

<section class="section customer">
    <form class="row g-3" action="{{route('user.update',$user->id)}}" method="POST">
        @method('PUT')
        @csrf
        <div class="col-md-12">
          <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Enter Name">
          <div class="errors text-danger mx-2">{{ $errors->has('name') ? $errors->first('name') : '' }}</div>
        </div>
        <div class="col-md-6">
          <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Enter Email">
          <div class="errors text-danger mx-2">{{ $errors->has('email') ? $errors->first('email') : '' }}</div>
        </div>
        <div class="col-md-6">
          <input type="number" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="Enter Phone">
          <div class="errors text-danger mx-2">{{ $errors->has('phone') ? $errors->first('phone') : '' }}</div>
        </div>
        {{-- <div class="col-md-6">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="errors text-danger mx-2">{{ $errors->has('password') ? $errors->first('password') : '' }}</div>
        </div> --}}
        {{-- <div class="col-12">
          <input type="text" class="form-control" placeholder="Address">
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" placeholder="City">
        </div>
        <div class="col-md-4">
          <select id="inputState" class="form-select">
            <option selected>Choose...</option>
            <option>...</option>
          </select>
        </div> --}}
        <div class="col-md-6">
          <input type="file" class="form-control" name="image" value="{{ $user->image }}" placeholder="Zip">
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
          {{-- <button type="reset" class="btn btn-secondary">Reset</button> --}}
        </div>
      </form>
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