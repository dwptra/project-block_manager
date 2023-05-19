@extends('layout')
@section('content')
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>Page List</h1>     
            </div>
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
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-primary" href="{{ route('page.create', $project->id) }}">Create Page</a>
                            <a class="btn btn-danger ml-1" href="{{ route('project') }}">Back</a>
                        </div>
                        <hr>
                        <div class="form-group row mb-1">
                            <label class="col-sm-2 col-form-label"><b>Project Name</b></label>
                            <div class="">
                                <span style="font-size: 14px;">: {{ $project->project_name }}</span>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-2 col-form-label"><b>Project Manager</b></label>
                            <div class="">
                                <span style="font-size: 14px;">: {{ $project->projectManager->name }}</span>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Page Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                    ?>
                                    @forelse ($pageDB as $page)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $page->page_name }}</td>
                                        <td>
                                            @if ($page->status == 'On Progress')
                                                <span class="badge badge-primary px-2">{{ $page->status }}</span>
                                            @elseif ($page->status == 'On Review')
                                                <span class="badge badge-warning px-2">{{ $page->status }}</span>
                                            @elseif ($page->status == 'Approved')
                                                <span class="badge badge-success px-2">{{ $page->status }}</span>
                                            @else
                                                <span class="badge badge-danger px-2">{{ $page->status }}</span>
                                            @endif
                                        </td>                                   
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-warning text-white mr-1" href="{{ route('block', $page['id']) }}">See Blocks</a> 
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
                                        <td colspan="3" class="text-center">No data found.</td>
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
@endsection
