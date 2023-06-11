@extends('backend.layout.app')
@section('title', 'Add User')
@section('content')
    @include('backend.blocks.breadcrumb', [
        'page_title' => 'users',
        'current_page' => 'add users',
    ])
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form class="w-75" action="{{ route('admin.users.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" value="{{ old('name') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Password</label>
                                <input type="text" class="form-control" name="password" value="{{ old('name') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Confirm password</label>
                                <input type="text" class="form-control" name="password_confirmation"
                                    value="{{ old('name') }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Permission</label>
                                <div class="form-check">
                                    <input class="form-check-input" checked type="radio" name="permission"
                                        id="flexRadioDefault1" value="0">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        User
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="permission" id="flexRadioDefault2"
                                        value="1">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Admin
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
