@extends('layout')
@section('content')
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>Block List</h1>
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
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <?php
                                        $i = 1;
                                    ?>
                                            <tr>
                                                <th style="max-width: 70px;">NO</th>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($blockCategory as $block)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $block->id }}</td>
                                                <td>{{ $block->block_name }}</td>
                                                <td>{{ $block->categories->category_name }}</td>
                                                <td class="text-center">{{ $block->description ?? '-' }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a title="View" class="btn btn-primary mr-1 text-white"
                                                        data-toggle="modal" data-target="#viewBlock{{ $block->id }}"><i class="fa-solid fa-info"></i></a>
                                                        <a title="Edit" class="btn btn-success mr-1"
                                                            href="{{ route('blockmaster.edit', $block->id) }}"><i class="fa-solid fa-pen"></i></a>
                                                        <form action="{{ route('blockmaster.delete', $block['id']) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" title="Delete"
                                                                onclick="return confirm('Yakin ingin menghapus?')"
                                                                type="submit"><i class="fa-solid fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>

                                            @empty
                                            <tr>
                                                <td colspan="10" class="text-center">No data found.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>NO</th>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
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
</div>

@foreach ($blockCategory as $block)
    {{-- Modal View --}}
    <div class="modal fade" id="viewBlock{{ $block->id }}" tabindex="-1" role="dialog" aria-labelledby="createCategoriesLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoriesLabel">Block</h5>
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
                                <span class="d-block">{{$block->note ?? '-'}}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Main Image</label>
                                <div class="">
                                    <img
                                        src="{{ asset('storage/images/main_image/' . basename($block->main_image)) }}"
                                        style="width: 300px; border-radius: 4px;"
                                        alt="image"></td>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Mobile Image</label>
                                <div class="">
                                    <img
                                        src="{{ asset('storage/images/mobile_image/' . basename($block->mobile_image)) }}"
                                        style="width: 300px; border-radius: 4px;"
                                        alt="image"></td>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Sample Image Preview 1</label>
                                <div class="">
                                    <img
                                        src="{{ asset('storage/images/sample_image_1/' . basename($block->sample_image_1)) }}"
                                        style="width: 300px; border-radius: 4px;"
                                        alt="image"></td>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Sample Image Preview 2</label>
                                <div class="">
                                    <img
                                        src="{{ asset('storage/images/sample_image_2/' . basename($block->sample_image_2)) }}"
                                        style="width: 300px; border-radius: 4px;"
                                        alt="image"></td>
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
@endforeach
@endsection
