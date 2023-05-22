@extends('layout')
@section('content')
<div class="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>Project List</h1>
            </div>
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
                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-primary" href="{{ route('project.create') }}">Create New Project</a>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration" id="table-1">
                                        <thead>
                                            <?php
                                            $i = 1;
                                            ?>
                                            <tr>
                                                <th>NO</th>
                                                <th>Project Name</th>
                                                <th>Project Manager</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($projectDB as $project)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $project->project_name }}</td>
                                                <td>{{ $project->projectManager->name }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a title="See Pages" class="btn btn-info text-white mr-1"
                                                            href="{{ route('page', $project->id)  }}">See
                                                            Pages</a>
                                                        <a title="Edit" class="btn btn-success mr-1" href="{{ route('project.edit', $project['id']) }}"><i
                                                            class="fa-solid fa-pen"></i></a>
                                                        <a title="Delete" class="btn btn-danger mr-1 text-white" style="width: 40px;" data-toggle="modal" data-target="#deleteProject{{ $project->id }}"><i
                                                            class="fa-solid fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No data found.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</div>

@foreach ($projectDB as $project)
{{-- Modal Delete --}}

<div class="modal fade" id="deleteProject{{ $project->id }}" tabindex="-1" role="dialog"
    aria-labelledby="createCategoriesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoriesLabel">Delete Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('project.delete', $project['id']) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="form-group">
                        <span>Are you sure?, Once deleted, you will not be able to recover this project!?</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
