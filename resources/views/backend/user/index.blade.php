@extends('backend.layout.app')
@section('title', 'Users')

@section('css')
    <style>
        img.user-avatar {
            max-width: 40px;
            width: 40px;
            border-radius: 50%;
        }

        td {
            padding: 10px 5px !important;
        }
    </style>
@endsection

@section('content')
    @include('backend.blocks.breadcrumb', [
        'page_title' => 'users',
        'current_page' => 'all users',
    ])
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end align-items-center mb-3 gap-3">
                            <a href="{{ route('export_user') }}" class="btn btn-info cl-fff">Export</a>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-success cl-fff">Add User</a>
                        </div>
                        <div class="table-responsive px-2">
                            <table class="table align-middle mb-5 table-hover" id="data-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" colspan="2">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img class="user-avatar" src="{{ asset('storage/users/' . $item->avatar) }}"
                                                    alt="">
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone_number }}</td>
                                            <td>{{ $item->role == 0 ? 'User' : 'Admin' }}</td>
                                            <td>
                                                <a class="btn btn-success btn-xs" href=""><i
                                                        class="fas fa-edit"></i></a>
                                                <button data-url='' data-id="" class="btn btn-danger btn-xs delete"
                                                    type="button"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">There are no users, please click the add button to add a new
                                                one.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $users->links('pagination::bootstrap-4') }}
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
