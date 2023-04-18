@extends('layout')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-validation">
                        <h4>Page Create</h4>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-primary" href="/page{{ $project->id }}">Back</a>
                        </div>
                        <hr>
                        <form class="form-valide" action="{{ route('page_create.post', $project->id) }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-project-id">Project Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <select name="project_id" class="form-control" id="val-project-id" name="val-project-id">
                                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-page-name">Page Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input name="page_name" type="text" class="form-control" id="val-page-name" name="val-page-name" placeholder="Enter page-name..">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-note">Note <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <textarea name="note" class="form-control" id="val-note" name="val-note" rows="5" placeholder="Not Required"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-skill">Status <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="val-skill" name="status">
                                        <option value="On Progress">On Progress</option>
                                        <option value="On Review">On Review</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Declined">Declined</option>
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
</div>  
<!-- #/ container -->
</div>
<!--**********************************
Content body end
***********************************-->
@endsection