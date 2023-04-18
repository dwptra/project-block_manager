@extends('layout')
@section('content')
<div class="container-fluid mt-3">
    @if (Session::get('isGuest'))
    <div class="alert alert-primary alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button> <strong>Fail!</strong> {{ Session::get('isGuest')}}
    </div>
    @endif
    @if (Session::get('createProject'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button> <strong>Success!</strong> {{ Session::get('createProject')}}
    </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Project List</h4>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-primary" href="{{ route('project.create') }}">Create New Project</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Project Name</th>
                                        <th>Project Manager</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projectDB as $project)
                                    <tr>
                                        <td>{{ $project->id }}</td>
                                        <td>{{ $project->project_name }}</td>
                                        <td>{{ $project->project_manager }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="/page{{ $project->id }}">See Pages  |</a> 
                                                <a class="ml-1" href="{{ route('project.edit', $project['id']) }}">Edit  |</a>
                                                <form action="">
                                                    <a class="ml-1" href="">Delete</a>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Project Name</th>
                                        <th>Project Manager</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
@endsection
