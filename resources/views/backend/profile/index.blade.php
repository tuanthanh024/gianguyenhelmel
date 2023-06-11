@extends('backend.layout.app')
@section('title', 'Profile')

@section('content')
    @include('backend.blocks.breadcrumb', [
        'page_title' => 'profile',
        'current_page' => 'edit profile',
    ])
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body profile-card">
                        <div class="mt-4 text-center"> <img src="{{ asset('storage/users/' . $user->avatar) }}"
                                class="rounded-circle" width="150" />
                            <h4 class="card-title mt-2">{{ $user->name }}</h4>
                            <h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
                            <div class="row text-center justify-content-center">
                                <div class="col-4">
                                    <a href="javascript:void(0)" class="link">
                                        <i class="icon-people" aria-hidden="true"></i>
                                        <span class="value-digit">254</span>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="javascript:void(0)" class="link">
                                        <i class="icon-picture" aria-hidden="true"></i>
                                        <span class="value-digit">54</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal form-material mx-2">
                            <div class="form-group">
                                <label class="col-md-12 mb-0">Full Name</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Johnathan Doe"
                                        class="form-control ps-0 form-control-line" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" placeholder="johnathan@admin.com"
                                        class="form-control ps-0 form-control-line" name="example-email" id="example-email"
                                        value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0">Phone No</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="123 456 7890"
                                        class="form-control ps-0 form-control-line" value="{{ $user->phone_number }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0">Description</label>
                                <div class="col-md-12">
                                    <textarea rows="5" class="form-control ps-0 form-control-line">{{ $user->description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Select Country</label>
                                <div class="col-sm-12 border-bottom">
                                    <select class="form-select shadow-none ps-0 border-0 form-control-line">
                                        <option>London</option>
                                        <option>India</option>
                                        <option>Usa</option>
                                        <option>Canada</option>
                                        <option>Thailand</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 d-flex">
                                    <button class="btn btn-success mx-auto mx-md-0 text-white">Update
                                        Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
