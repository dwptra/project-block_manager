@extends('layout')
@section('content')
<style>
    .row p b {
        display: inline-block;
        min-width: 125px;
    }
</style>
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
                        <h4 class="card-title">Block List</h4>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-primary" href="/createBlock{{ $pageDB->id }}">Create Block</a>
                            <a class="btn btn-primary ml-1" href="#">Export Block List</a>
                            <a class="btn btn-danger ml-1" href="/page{{ $pageDB->project_id }}">Back</a>
                        </div>
 
                        <p class="col"><b class="">Project Name :</b> {{ $pageDB->projects->project_name }}</p>
                        <p class="col"><b class="">Page Name :</b> {{ $blockList->pages->page_name }}</p>


                        
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Sort ID</th>
                                        <th>Block Name</th>
                                        <th>Section Name</th>
                                        <th>Note</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @forelse ($blockList as $block)
                                    <tr>
                                        <td>{{ $block->sort }}</td>
                                        <td>}</td>
                                        <td>{{ $block->section_name }}</td>
                                        <td>{{ $block->note }}</td>
                                        <td>
                                            {{-- <div class="d-flex">
                                                <a class="btn btn-warning text-white mr-1" href="{{ route('block', $page['id']) }}">See Blocks</a> 
                                                <a class="btn btn-primary mr-1" href="{{ route('page.edit', $page['id']) }}">Edit</a>
                                                <form action="{{ route('page.delete', $page['id']) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')" type="submit">Delete</button>
                                                </form>
                                            </div> --}}
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No pages found.</td>
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