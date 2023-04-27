@extends('layout')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4>Project Create</h4>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-danger" href="{{ route('project') }}">Back</a>
                    </div>
                    <hr>
                    <div class="form-validation">
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
                                    <select class="form-select" aria-label="Default select example" name="project_manager">
                                        <option value="" selected disabled>Select Project Manager</option>                                                                    
                                        @foreach ($user as $pm)
                                            <option value="{{ $pm->id }}">{{ $pm->name }}</option>
                                        @endforeach
                                    </select>       
                                </div>
                            </div>
                            @else
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-email">Project Manager <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" name="project_manager" class="form-control" id="val-email" placeholder="Enter Project Manager" value="{{Auth::user()->name}}" readonly>
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