@extends('admin.layouts.app')
@section('content')
    <!--APP-CONTENT START-->


    <!-- Page Header -->

    <div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h2 class="main-content-title fs-24 mb-1">Update task</h2>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">tasks</li>
            </ol>
        </div>

    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .item {
            background-color: #f1f1f1;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .item>* {
            margin-right: 10px;
        }

        .item button img {
            width: 20px;
            height: 20px;
        }

        .item select,
        .item input[type="text"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
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
                <form class="form-horizontal" method="post" action="{{ route('task.update', $task->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">




                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">{{ __('category') }}</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select" name="category_id">
                                <option disabled selected>{{ __('Choose category...') }}</option>
                                @foreach ($categories as $category)
                                <option @selected(old('category_id', $task->category_id) == $category->id) value="{{ $category->id }}">
                                  {{ $category->name }}
                            </option>
                                @endforeach
                            </select>
                            @error('caetgory_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>









                        <label for="basic-url" class="form-label">title</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $task->title }}" name="title"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('title')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <div class="form-group ">
                            <label for="description" class="form-label">{{ __('Description') }}</label>

                            <textarea name="description" id="description" class="form-control custom-textarea ck-editor" rows="4" placeholder="{{ __('Enter description...') }}">{{ $task->description }}</textarea>
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
                                        <option value="1" {{ old('status', $task->status ?? '') == 1 ? 'selected' : '' }}>{{ __('pending') }}</option>
                                        <option value="2" {{ old('status', $task->status ?? '') == 2 ? 'selected' : '' }}>{{ __('completed') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        @error('status')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <input type="date" name="due_date" class="form-control" value="{{ old('due_date', $task->due_date ?? '') }}">
                        </div>

                        @error('due_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                        <button class="form-control btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>



        <!-- End:: row-3 -->


    </div>
    <!--APP-CONTENT CLOSE-->


@endsection
