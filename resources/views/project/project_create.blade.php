@extends('layout')
@section('content')
<div class="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>Project Create</h1>
            </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
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
                        <form class="form-valide" action="{{ route('project.post') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-username">Project Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" name="project_name" class="form-control" id="val-username" placeholder="Enter a Project Name">
                                </div>
                            </div>
                            @if(Auth::user()->role == 'Admin')
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-email">Project Manager <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <select class="form-control selectric" aria-label="Default select example" name="project_manager">
                                        <option value="" selected disabled>Select Project Manager</option>                                                                    
                                        @foreach ($user as $pm)
                                            @if($pm['role'] == 'Project Manager')
                                                <option value="{{ $pm->id }}">{{ $pm->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>       
                                </div>
                            </div>
                            @endif
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
</div>  
<!-- #/ container -->
</div>
<!--**********************************
Content body end
***********************************-->
@endsection