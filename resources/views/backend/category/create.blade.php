@extends('backend.layout.app')
@section('title', 'Add Category')
@section('content')
    @include('backend.blocks.breadcrumb', [
        'page_title' => 'categories',
        'current_page' => 'add categories',
    ])
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form class="w-75" action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Category name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                            <input type="hidden" class="form-control" name="slug" value="{{ old('slug') }}" readonly>
                            <div class="form-group mb-3">
                                <label>Category description</label>
                                <textarea name="description" class="form-control" cols="30" rows="10">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select class="form-select" name="status">
                                    <option selected disabled>Select status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
