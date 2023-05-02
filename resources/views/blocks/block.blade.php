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
                @if (Session::get('createBlock'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button> <strong>Success!</strong> {{ Session::get('createBlock')}}
                </div>
                @endif
                @if (Session::get('updateBlock'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button> <strong>Success!</strong> {{ Session::get('updateBlock')}}
                </div>
                @endif
                @if (Session::get('deleteBlock'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button> <strong>Success!</strong> {{ Session::get('deleteBlock')}}
                </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Block List</h4>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-primary" href="{{ route('block.create', $pageDB->id) }}">Create Block</a>
                            <a class="btn btn-warning ml-1 text-white" href="{{ route('blocks.print', $pageDB['id'])}}"
                                target="_blank" onclick="var w = 1000; var h = 750; var left = (screen.width/2)-(w/2); var top = 0; 
                                window.open('{{ route('blocks.print', $pageDB['id'])}}','Print','width='+w+',height='+h+',top='+top+',left='+left); 
                                return false;">Export Block List
                            </a>
                            <a class="btn btn-danger ml-1" href="{{ route('page', $pageDB->project_id) }}">Back</a>
                        </div>
                        <p class="col"><b class="">Project Name :</b> {{ $pageDB->projects->project_name }}</p>
                        <p class="col"><b class="">Page Name :</b>{{ $pageDB->page_name }}</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th style="max-width: 60px;">Sort</th>
                                        <th>Block Name</th>
                                        <th>Section Name</th>
                                        <th>Note</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @forelse ($blockList as $block)
                                    <tr>
                                        <td class="text-center">{{ $block->sort }}</td>
                                        <td>{{ $block->blocks->block_name }}</td>
                                        <td>{{ $block->section_name }}</td>
                                        <td>{{ $block->note }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-primary mr-1" href="{{ route('block.edit', $block->id) }}">Edit</a>
                                                <form action="{{ route('block.delete', $block['id']) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus?')"
                                                        type="submit">Delete</button>
                                                </form>
                                            </div>
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
