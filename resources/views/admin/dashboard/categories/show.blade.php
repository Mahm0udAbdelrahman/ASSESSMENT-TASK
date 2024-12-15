@extends('admin.layouts.app')

@section('content')
    <!-- APP-CONTENT START -->
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h2 class="main-content-title fs-24 mb-1">Show Category</h2>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show Category</li>
            </ol>
        </div>
    </div>
    <!-- Page Header Close -->


    <!-- Start:: row -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Category Details</h3>
                    <a href="{{ route('category.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <h6 class="fw-bold">Category Name:</h6>
                        </div>
                        <div class="col-md-9">
                            <p class="mb-0">{{ $category->name }}</p>
                        </div>
                    </div>

                    <!-- Add more details here if needed -->
                </div>
            </div>
        </div>
    </div>
    <!-- End:: row -->
    <!-- APP-CONTENT CLOSE -->
@endsection
