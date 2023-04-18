@extends('layout')
@section('content')

<div class="container-fluid mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if (Session::get('createPage'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button> <strong>Success!</strong> {{ Session::get('createPage')}}
                </div>
                @endif
                @if (Session::get('updatePage'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button> <strong>Success!</strong> {{ Session::get('updatePage')}}
                </div>
                @endif
                @if (Session::get('deletePage'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button> <strong>Success!</strong> {{ Session::get('deletePage')}}
                </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Page List</h4>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-primary" href="/createPage{{ $project->id }}">Create Page</a>
                            <a class="btn btn-danger ml-1" href="/dashboard">Back</a>
                        </div>
                        <hr>
                        <p><b class="pr-4">Project Name</b>: {{ $project->project_name }}</p>
                        <p><b class="pr-2">Project Manager</b>: {{ $project->project_manager }}</p>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Page Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pageDB as $page)
                                    <tr>
                                        <td>{{ $page->page_name }}</td>
                                        <td>{{ $page->status }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-warning text-white mr-1" href="/page{{ $project->id }}">See Blocks</a> 
                                                <a class="btn btn-primary mr-1" href="{{ route('page.edit', $page['id']) }}">Edit</a>
                                                <form action="{{ route('page.delete', $page['id']) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3">No pages found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
