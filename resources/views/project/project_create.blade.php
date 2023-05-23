@extends('layout')
@section('content')
<div class="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>Create Project</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><b>Dashboard</b></div>
                    <div class="breadcrumb-item"><a href="{{ route('project') }}">Project</a></div>
                    <div class="breadcrumb-item text-muted">Create</div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-valide" action="{{ route('project.post') }}" method="post">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mr-1">Save Project</button>
                                <a class="btn btn-danger" href="{{ route('project') }}">Back</a>
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
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Project Name <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" name="project_name" class="form-control" id="val-username"
                                            placeholder="Enter a Project Name" value="{{ old('project_name') }}"
                                            required>
                                    </div>
                                </div>
                                @if(Auth::user()->role == 'Admin')
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-email">Project Manager <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control selectric" aria-label="Default select example"
                                            name="project_manager">
                                            <option value="" selected disabled>Select Project Manager</option>
                                            @foreach ($user as $pm)
                                            @if($pm['role'] == 'Project Manager')
                                            <option value="{{ $pm->id }}"
                                                {{ old('project_manager') == $pm->id ? 'selected' : '' }}>
                                                {{ $pm->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                @endif
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
