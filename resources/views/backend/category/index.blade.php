@extends('backend.layout.app')
@section('title', 'Categories')
@section('content')
    @include('backend.blocks.breadcrumb', [
        'page_title' => 'categories',
        'current_page' => 'all categories',
    ])
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end align-items-center mb-3">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-success cl-fff">Add Category</a>
                        </div>
                        <div class="table-responsive px-2">
                            <table class="table align-middle mb-5 table-hover" id="data-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->description ?? 'No description' }}</td>
                                            <td>
                                                <div
                                                    class="text-capitalize badge rounded-pill bg-{{ $item->status == 'active' ? 'success' : 'danger' }}">
                                                    {{ $item->status }}</div>
                                            </td>
                                            <td>
                                                <div>
                                                    <a class="btn btn-success btn-xs"
                                                        href="{{ route('admin.categories.edit', $item->id) }}">Edit</a>
                                                    <button data-url='{{ route('admin.delete_category') }}'
                                                        data-id="{{ $item->id }}" class="btn btn-danger btn-xs delete"
                                                        type="button">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">You don't have any categories yet, please click add button
                                                to create a new one.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('backend/js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('backend/js/popup-delete.js') }}"></script>
@endsection
