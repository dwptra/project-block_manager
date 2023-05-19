@extends('layout')
@section('content')
<style>
    .row p b {
        display: inline-block;
        min-width: 125px;
    }

</style>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>Block List</h1>     
            </div>
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
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button> <strong>Success!</strong> {{ Session::get('deleteBlock')}}
                </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-primary" href="{{ route('block.create', $pageDB->id) }}">Create Block</a>
                            <a class="btn btn-warning ml-1 text-white" href="{{ route('blocks.print', $pageDB['id'])}}" target="_blank">Export Block List
                            </a>
                            <a class="btn btn-danger ml-1" href="{{ route('page', $pageDB->project_id) }}">Back</a>
                        </div>
                        <hr>
                        <div class="form-group row mb-1">
                            <div class="col-sm-10">
                                <label class="col-sm-2"><b>Project Name</b></label>
                                <span style="font-size: 14px;">: {{ $pageDB->projects->project_name }}</span>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <div class="col-sm-10">
                                <label class="col-sm-2"><b>Project Manager</b></label>
                                <span style="font-size: 14px;">: {{ $pageDB->page_name }}</span>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Sort</th>
                                        <th>Block Name</th>
                                        <th>Section Name</th>
                                        <th>Note</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @forelse ($blockList->sortBy('sort') as $block)
                                    <tr>
                                        <td class="text-center">{{ $block->sort }}</td>
                                        <td>{{ $block->blocks->block_name }}</td>
                                        <td>{{ $block->section_name }}</td>
                                        <td style="max-width: 300px;">
                                            <?php
                                            if(isset($block->note)){
                                                echo substr($block->note, 0, 97) . '<a href="#">...</a>';
                                            } else {
                                                echo '-';
                                            }
                                            ?>
                                        </td>
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
@endsection
