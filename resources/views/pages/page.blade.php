@extends('layout')
@section('content')
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>Page List</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><b>Dashboard</b></div>
                    <div class="breadcrumb-item"><a href="{{ route('project') }}">Project</a></div>
                    <div class="breadcrumb-item text-muted">Page</div>
                </div>
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
                                <a class="btn btn-primary" href="{{ route('page.create', $project->id) }}">Create
                                    Page</a>
                                <a class="btn btn-danger ml-1" href="{{ route('project') }}">Back</a>
                            </div>
                            <hr>
                            <div class="form-group row mb-1">
                                <div class="col-sm-10">
                                    <label class="col-sm-2"><b>Project Name</b></label>
                                    <span>: {{ $project->project_name }}</span>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <div class="col-sm-10">
                                    <label class="col-sm-2"><b>Project Manager</b></label>
                                    <span>: {{ $project->projectManager->name }}</span>
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
                                                    <a class="btn btn-info text-white mr-1" title="see blocks"
                                                        href="{{ route('block', $page['id']) }}">See Blocks</a>
                                                    <a title="View" class="btn btn-primary mr-1 text-white"
                                                        style="width: 40px;" data-toggle="modal"
                                                        data-target="#viewBlock{{ $page->id }}"><i
                                                            class="fa-solid fa-info"></i></a>
                                                    <a class="btn btn-success mr-1" title="edit"
                                                        href="{{ route('page.edit', $page['id']) }}"><i
                                                            class="fa-solid fa-pen"></i></a>
                                                    <a title="delete" class="btn btn-danger mr-1 text-white"
                                                        style="width: 40px;" data-toggle="modal"
                                                        data-target="#deleteBlock{{ $page->id }}"><i
                                                            class="fa-solid fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No data found.</td>
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


@foreach ($pageDB as $page)
<div class="modal fade" id="viewBlock{{ $page->id }}" tabindex="-1" role="dialog"
    aria-labelledby="createCategoriesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoriesLabel">View Page</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Page Name</label>
                        <span class="d-block">{{$page->page_name}}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Status</label>
                        <span class="d-block">{{$page->status}}</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Note</label>
                        <span class="d-block">@if ($page->note)
                            <ul style="padding-left: 0; list-style: none;">
                                @foreach(explode(PHP_EOL, $page->note) as $line)
                                <li>{{ $line }}</li>
                                @endforeach
                            </ul>
                            @else
                            -
                            @endif</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Delete --}}

<div class="modal fade" id="deleteBlock{{ $page->id }}" tabindex="-1" role="dialog"
    aria-labelledby="createCategoriesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoriesLabel">Delete Page</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('page.delete', $page['id']) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="form-group">
                        <span>Are you sure?, Once deleted, you will not be able to recover this page!?</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
        </div>
        </form>
    </div>
</div>
@endforeach
@endsection
