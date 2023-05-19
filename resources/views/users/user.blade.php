@extends('layout')
@section('content')
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <section class="section">
                <div class="section-header">
                    <h1>User</h1>     
                </div>
                @if (Session::get('updateUser'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button> <strong>Success!</strong> {{ Session::get('updateUser')}}
                </div>
                @endif     
                @if (Session::get('createUser'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button> <strong>Success!</strong> {{ Session::get('createUser')}}
                </div>
                @endif
                @if (Session::get('deleteUser'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button> <strong>Success!</strong> {{ Session::get('deleteUser')}}
                </div>
                @endif
                @if (Session::get('updatePassword'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button> <strong>Success!</strong> {{ Session::get('updatePassword')}}
                </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if(Auth::user()->role == 'Admin')
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-primary" href="{{ route('user.create') }}">Create Users</a>
                                    </div>
                                @endif
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>No</th>
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
                                            <?php
                                            $i = 1;
                                            ?>
                                            @foreach ($projectMDB as $project)
                                            <tr>
                                                <td>{{ $i++ }}</td>
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
                                                <td>{{ $project->updated_at->format('Y-m-d H:i:s') }}</td>
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
                                                <th>No</th>
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
            </section>
        </div>
    </div>

@endsection
