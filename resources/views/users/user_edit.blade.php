@extends('layout')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4>User Create</h4>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-danger" href="/user">Back</a>
                    </div>
                    <hr>
                    <div class="form-validation">
                        <form class="form-valide" action="{{ route('user.update', $project->id) }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-name">Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" name="name" class="form-control" id="val-name" placeholder="Enter a Name" value="{{ $project->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-email">Email <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="email" name="email" class="form-control" id="val-email" placeholder="Enter a Email" value="{{ $project->email }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-password">Password <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="password" name="password" class="form-control" id="val-password" placeholder="Enter a Password">
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