@extends('layout')
@section('content')
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>User Edit</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-success text-white"
                                    href="{{ route('password.edit', $user->id) }}">Change Password</a>
                                <a class="btn btn-danger ml-2" href="{{ route('user') }}">Back</a>
                            </div>
                            <hr>
                            <div class="form-validation">
                                @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span>
                                    </button> <strong>Error:</strong>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                                @endif
                                <form class="form-valide" action="{{ route('user.update', $user->id) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-name">Name <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="name" class="form-control" id="val-name"
                                                placeholder="Enter a Name" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-email">Email <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="email" name="email" class="form-control" id="val-email"
                                                placeholder="Enter a Email" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-skill">Role <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control selectric">
                                                <option value="Project Manager" {{ $user->role == 'Project Manager' ? 'selected' : '' }}>Project Manager</option>
                                                <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : ''}}>Admin</option>
                                              </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-8 ml-auto">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
</div>
<!-- #/ container -->
</div>
<!--**********************************
Content body end
***********************************-->
@endsection
