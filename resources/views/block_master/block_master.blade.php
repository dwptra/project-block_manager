@extends('layout')
@section('content')
<style>
    li{
        list-style: none;
    }
</style>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>Block Master List</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><b>Master Data</b></div>
                    <div class="breadcrumb-item text-muted">Block Master</div>
                </div>
            </div>
            @if (Session::get('createBlockMaster'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button> <strong>Success!</strong> {{ Session::get('createBlockMaster')}}
            </div>
            @endif
            @if (Session::get('updateBlockMaster'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button> <strong>Success!</strong> {{ Session::get('updateBlockMaster')}}
            </div>
            @endif
            @if (Session::get('deleteBlockMaster'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button> <strong>Success!</strong> {{ Session::get('deleteBlockMaster')}}
            </div>
            @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-primary" href="{{ route('blockmaster.create') }}">Create New
                                        Block</a>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration" id="table-1">
                                        <thead>
                                            <?php
                                                    $i = 1;
                                                ?>
                                            <tr>
                                                <th>No</th>
                                                <th>Block Name</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($blockCategory as $block)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $block->block_name }}</td>
                                                <td>{{ $block->categories->category_name }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a title="View" class="btn btn-primary mr-1 text-white"
                                                            style="width: 40px;" data-toggle="modal"
                                                            data-target="#viewBlock{{ $block->id }}"><i
                                                                class="fa-solid fa-info"></i></a>
                                                        <a title="Edit" class="btn btn-success mr-1"
                                                            style="width: 40px;"
                                                            href="{{ route('blockmaster.edit', $block->id) }}"><i
                                                                class="fa-solid fa-pen"></i></a>
                                                        <a title="View" class="btn btn-danger mr-1 text-white"
                                                            style="width: 40px;" data-toggle="modal"
                                                            data-target="#deleteBlock{{ $block->id }}"><i
                                                                class="fa-solid fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="10" class="text-center">No data found.</td>
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
        </section>
    </div>
</div>

{{-- Modal View --}}

@foreach ($blockCategory as $block)
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
                        <label for="inputEmail4">Name</label>
                        <span class="d-block">{{$block->block_name}}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Category</label>
                        <span class="d-block">{{$block->categories->category_name}}</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Note</label>
                        <span class="d-block">@if ($block->description)
                            <ul style="padding-left: 0; list-style: none;">
                                @foreach(explode(PHP_EOL, $block->description) as $line)
                                <li>{{ $line }}</li>
                                @endforeach
                            </ul>
                            @else
                            -
                            @endif</span>
                    </div>
                </div>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Main Image</label>
                        <div class="">
                            <img src="{{ asset('storage/images/main_image/' . basename($block->main_image)) }}"
                                style="width: 300px; border-radius: 4px;" alt="image"></td>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Mobile Image</label>
                        <div class="">
                            <img src="{{ asset('storage/images/mobile_image/' . basename($block->mobile_image)) }}"
                                style="width: 300px; border-radius: 4px;" alt="image"></td>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Sample Image Preview 1</label>
                        <div class="">
                            <img src="{{ asset('storage/images/sample_image_1/' . basename($block->sample_image_1)) }}"
                                style="width: 300px; border-radius: 4px;" alt="image"></td>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Sample Image Preview 2</label>
                        <div class="">
                            <img src="{{ asset('storage/images/sample_image_2/' . basename($block->sample_image_2)) }}"
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
            <form action="{{ route('blockmaster.delete', $block['id']) }}" method="post">
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
