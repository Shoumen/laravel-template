@extends('backend.layouts.master')
@section('content')
<div class="pagetitle">
    <div class="row">
        <div class="col-md-8">
            <h1>Product</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                    <li class="breadcrumb-item active">New Product</li>
                    <div>
                </ol>
            </nav>
        </div>
        <div class="col-md-4" style="text-align: right;">
            <div class="">
                <a class="" href="{{ route('product.index') }}">
                    <i class="ri-add-circle-line"></i>
                    <span>Product List</span>
                </a>
            </div>
        </div>
    </div>   
</div>
<!-- End Page Title -->




@endsection