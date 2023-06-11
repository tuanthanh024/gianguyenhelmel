@extends('backend.layout.app')
@section('title', 'Edit Category')
@section('content')
    @include('backend.blocks.breadcrumb', [
        'page_title' => 'categories',
        'current_page' => 'edit categories',
    ])
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form class="w-75" action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label>Category name</label>
                                <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Slug</label>
                                <input type="text" class="form-control" name="slug" value="{{ $category->slug }}"
                                    readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label>Category description</label>
                                <input type="text" class="form-control" name="description"
                                    value="{{ $category->description }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select class="form-select" name="status">
                                    <option selected disabled>Select status</option>
                                    <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>
                                        Inactive</option>
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
