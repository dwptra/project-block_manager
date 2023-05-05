@extends('layout')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4>User Edit</h4>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-danger ml-2" href="{{ route('user.edit', $user->id) }}">Back</a>
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
                        <form class="form-valide" action="{{ route('password.update', $user->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-name">Password <span class="text-danger">*</span>
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