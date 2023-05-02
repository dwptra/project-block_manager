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
    @if (Session::get('updateProject'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button> <strong>Success!</strong> {{ Session::get('updateProject')}}
    </div>
    @endif
    @if (Session::get('deleteProject'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button> <strong>Success!</strong> {{ Session::get('deleteProject')}}
    </div>
    @endif
    @if (Session::get('successLogin'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button> <strong>Success!</strong> {{ Session::get('successLogin')}}
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
                                    <?php
                                        $i = 1;
                                    ?>
                                    <tr>
                                        <th>NO</th>
                                        <th>ID</th>
                                        <th>Project Name</th>
                                        <th>Project Manager</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projectDB as $project)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $project->id }}</td>
                                        <td>{{ $project->project_name }}</td>
                                        <td>{{ $project->projectManager->name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-warning text-white mr-1" href="{{ route('page', $project->id)  }}">See Pages</a> 
                                                <a class="btn btn-primary mr-1" href="{{ route('project.edit', $project['id']) }}">Edit</a>
                                                <form action="{{ route('project.delete', $project['id']) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>NO</th>
                                        <th>ID</th>
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
