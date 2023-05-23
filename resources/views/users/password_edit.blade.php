@extends('layout')
@section('content')
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>Change Password</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><b>Master Data</b></div>
                    <div class="breadcrumb-item"><a href="{{ route('user') }}">User</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('user.edit', $user->id) }}">Edit</a></div>
                    <div class="breadcrumb-item text-muted">Password</div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-valide" action="{{ route('password.update', $user->id) }}" method="post">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary mr-1">Save Password</button>
                                    <a class="btn btn-danger ml-2" href="{{ route('user.edit', $user->id) }}">Back</a>
                                </div>
                                <hr>
                                <div class="form-validation">
                                    @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close"><span aria-hidden="true">&times;</span>
                                        </button> <strong>Error:</strong>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </div>
                                    @endif
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-name">Password <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="password" name="password" class="form-control"
                                                id="val-password" placeholder="Enter a Password" required>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<!-- #/ container -->
</div>
<!--**********************************
Content body end
***********************************-->
@endsection
