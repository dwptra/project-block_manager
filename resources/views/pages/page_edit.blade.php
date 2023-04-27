@extends('layout')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-validation">
                        <h4>Page Edit</h4>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-danger" href="{{ route('page', $pageDB->project_id) }}">Back</a>
                        </div>
                        <hr>
                        <form class="form-valide" action="{{ route('page.update', $pageDB['id']) }}" method="post">
                            @csrf
                            @method('PATCH')
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
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-project-id">Project Name <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <select name="project_id" class="form-control" id="val-project-id">
                                        <option value="{{ $pageDB->project_id }}">{{ $pageDB->projects->project_name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-page-name">Page Name <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input name="page_name" type="text" class="form-control" id="val-page-name"
                                        name="val-page-name" placeholder="Enter page-name.."
                                        value="{{ $pageDB->page_name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-note">Note <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <textarea name="note" class="form-control" id="val-note" name="val-note" rows="5"
                                        placeholder="Not Required">{{ $pageDB->note }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-skill">Status <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="val-skill" name="status">
                                        <option value="On Progress"
                                            {{ $pageDB->status == 'On Progress' ? 'selected' : '' }}>On Progress
                                        </option>
                                        <option value="On Review"
                                            {{ $pageDB->status == 'On Review' ? 'selected' : '' }}>On Review</option>
                                        <option value="Approved" {{ $pageDB->status == 'Approved' ? 'selected' : '' }}>
                                            Approved</option>
                                        <option value="Declined" {{ $pageDB->status == 'Declined' ? 'selected' : '' }}>
                                            Declined</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-8 ml-auto">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
