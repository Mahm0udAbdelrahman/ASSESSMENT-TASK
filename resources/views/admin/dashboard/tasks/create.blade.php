@extends('admin.layouts.app')
@section('content')
    <!--APP-CONTENT START-->

    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h2 class="main-content-title fs-24 mb-1">Create Post</h2>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Posts</li>
            </ol>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @push('cs')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    @endpush
    <style>
        .item {
            background-color: #f1f1f1;
            padding: 10px;
            margin-bottom: 10px;

        }
    </style>

    <!-- Page Header Close -->

    <!-- Start:: row-1 -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Add new
                    </div>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('task.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group ">
                            <div class="row row-sm">
                                <div class="col-md-3">
                                    <label class="form-label">{{ __('Category') }}</label>
                                </div>
                                <div class="col-md-9">

                                    <select class="form-select" name="category_id">
                                        <option disabled selected>{{ __('Choose Category...') }}</option>
                                        @foreach ($categories as $category)
                                            <option @selected(old('category_id')==$category->id ) value="{{ $category->id }}">
                                                {{ $category->name }}
                                             </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <label for="basic-url" class="form-label">title</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control"  name="title" value="{{ old('title') }}"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('title')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <div class="form-group ">
                            <label for="description" class="form-label">{{ __('Description') }}</label>

                            <textarea name="description" id="description" class="form-control custom-textarea" rows="4" placeholder="{{ __('Enter description...') }}">{{ old('description') }}</textarea>
                        </div>

                        @error('description')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror


                        <div class="form-group">
                            <div class="row row-sm">
                                <div class="col-md-3">
                                    <label class="form-label">{{ __('Status') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select" name="status">
                                        <option disabled selected>{{ __('Choose status...') }}</option>
                                        <option value="1" @selected(old('status')==1)  >{{ __('pending') }}</option>
                                        <option value="2" @selected(old('status')==2)  >{{ __('completed') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        @error('status')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <input type="date" name="due_date" class="form-control" value="{{ old('due_date') }}">
                        </div>
                        @error('due_date')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror


                        <button class="form-control btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
