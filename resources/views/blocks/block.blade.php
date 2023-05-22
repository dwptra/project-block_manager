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
                                <label class="col-sm-2"><b>Page Name</b></label>
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
                                        <th>Action</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @forelse ($blockList->sortBy('sort') as $block)
                                    <tr>
                                        <td class="text-center">{{ $block->sort }}</td>
                                        <td>{{ $block->blocks->block_name }}</td>
                                        <td>{{ $block->section_name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a title="View" class="btn btn-primary mr-1 text-white" style="width: 40px;" data-toggle="modal"  data-target="#viewBlock{{ $block->id }}"><i
                                                    class="fa-solid fa-info"></i></a>
                                                <a class="btn btn-success mr-1" title="Edit" href="{{ route('block.edit', $block->id) }}"><i
                                                    class="fa-solid fa-pen"></i></a>
                                                <a title="Delete" class="btn btn-danger mr-1 text-white" style="width: 40px;" data-toggle="modal" data-target="#deleteBlock{{ $block->id }}"><i
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


@foreach ($blockList as $block)
<div class="modal fade" id="viewBlock{{ $block->id }}" tabindex="-1" role="dialog"
    aria-labelledby="createCategoriesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoriesLabel">View Block</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Block Name</label>
                        <span class="d-block">{{$block->blocks->block_name}}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Section Name</label>
                        <span class="d-block">{{$block->section_name}}</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Note</label>
                        <span class="d-block">@if ($block->note)
                            <ul style="padding-left: 0; list-style: none;">
                                @foreach(explode(PHP_EOL, $block->note) as $line)
                                <li>{{ $line }}</li>
                                @endforeach
                            </ul>
                            @else
                            -
                            @endif</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Sort</label>
                        <span class="d-block">{{$block->sort}}</span>
                    </div>
                </div>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Main Image</label>
                        <div class="">
                            <img src="{{ asset('storage/images/main_image/' . basename($block->blocks->main_image)) }}"
                                style="width: 300px; border-radius: 4px;" alt="image"></td>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Mobile Image</label>
                        <div class="">
                            <img src="{{ asset('storage/images/mobile_image/' . basename($block->blocks->mobile_image)) }}"
                                style="width: 300px; border-radius: 4px;" alt="image"></td>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Sample Image Preview 1</label>
                        <div class="">
                            <img src="{{ asset('storage/images/sample_image_1/' . basename($block->blocks->sample_image_1)) }}"
                                style="width: 300px; border-radius: 4px;" alt="image"></td>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Sample Image Preview 2</label>
                        <div class="">
                            <img src="{{ asset('storage/images/sample_image_2/' . basename($block->blocks->sample_image_2)) }}"
                                style="width: 300px; border-radius: 4px;" alt="image"></td>
                        </div>
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

<div class="modal fade" id="deleteBlock{{ $block->id }}" tabindex="-1" role="dialog"
    aria-labelledby="createCategoriesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoriesLabel">Delete Block</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('block.delete', $block['id']) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="form-group">
                        <span>Are you sure?, Once deleted, you will not be able to recover this block!?</span>
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

</div>
@endforeach
@endsection
