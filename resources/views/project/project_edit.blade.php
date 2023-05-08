@extends('layout')
@section('content')
<div class="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>Project Edit</h1>
            </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-danger" href="{{ route('project') }}">Back</a>
                    </div>
                    <hr>
                    <div class="form-validation">
                        <form class="form-valide" action="{{ route('project.update', $project['id']) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-username">Project Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" name="project_name" class="form-control" id="val-username" placeholder="Enter a Project Name" value="{{ $project['project_name'] }}">
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
                                            <option value="{{ $pm->id }}" @if ($pm->id == $project->project_manager) selected @endif>{{ $pm->name }}</option>
                                        @endforeach
                                    </select>       
                                </div>
                            </div>
                            @else
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-email">Project Manager <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <select class="form-control selectric" aria-label="Default select example" name="project_manager">
                                        <option value="{{ Auth::user()->id }}" selected readonly>{{ Auth::user()->name }}</option>                                                                    
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