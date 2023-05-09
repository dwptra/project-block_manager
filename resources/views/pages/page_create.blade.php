@extends('layout')
@section('content')
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>Page Create</h1>     
            </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-validation">
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-danger" href="{{ route('page', $project->id) }}">Back</a>
                        </div>
                        <hr>
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
                        <form class="form-valide" action="{{ route('page_create.post', $project->id) }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-page-name">Page Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input name="page_name" type="text" class="form-control" id="val-page-name" name="val-page-name" placeholder="Enter page-name.."  value="{{ old('page_name') }}" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-note">Note <span class="text-danger"></span>
                                </label>
                                <div class="col-lg-6">
                                    <textarea name="note" class="form-control" id="val-note" name="val-note" rows="5" placeholder="Not Required">{{ old('note') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-skill">Status <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <select class="form-control selectric" aria-label="Default select example" name="status"  value="{{ old('status') }}"> 
                                        <option value="On Progress">On Progress</option>
                                        <option value="On Review">On Review</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Declined">Declined</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-8 ml-auto">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>
</div>
<!-- #/ container -->
</div>
<!--**********************************
Content body end
***********************************-->
@endsection