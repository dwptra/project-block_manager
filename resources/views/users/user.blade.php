@extends('layout')
@section('content')
<div class="container-fluid mt-3">
    @if (Session::get('createUser'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button> <strong>Success!</strong> {{ Session::get('createUser')}}
    </div>
    @endif
    @if (Session::get('updateUser'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button> <strong>Success!</strong> {{ Session::get('updateUser')}}
    </div>
    @endif
    @if (Session::get('deleteUser'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button> <strong>Success!</strong> {{ Session::get('deleteUser')}}
    </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User List</h4>
                        @if(Auth::user()->role == 'Admin')
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-primary" href="{{ route('user.create') }}">Create Users</a>
                            </div>
                        @endif
                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        @if(Auth::user()->role == 'Admin')
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projectMDB as $project)
                                    <tr>
                                        <td>{{ $project->id }}</td>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ $project->email }}</td>
                                        <td>
                                            @if($project->role == 'Admin')
                                                <span class="badge badge-danger px-2">{{ $project->role }}</span>
                                            @else
                                                <span class="badge badge-primary px-2">{{ $project->role }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $project->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $project->updated_at->format('Y-m-d') }}</td>
                                        @if(Auth::user()->role == 'Admin')
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-primary mr-1" href="{{ route('user.edit', $project['id']) }}">Edit</a>
                                                @if (Auth::user()->id == $project->id)
                                                @else
                                                <form action="{{ route('user.delete', $project->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')" type="submit">Delete</button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        @if(Auth::user()->role == 'Admin')
                                        <th>Action</th>
                                        @endif
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
