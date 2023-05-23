@extends('layout')
@section('content')
<style>
    .row p b {
        display: inline-block;
        min-width: 125px;
    }

    li {
        list-style: none;
    }

</style>
<div class="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>Block Category List</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><b>Master Data</b></div>
                    <div class="breadcrumb-item text-muted">Block Category</div>
                </div>
            </div>
            @if (Session::get('createCategory'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button> <strong>Success!</strong> {{ Session::get('createCategory')}}
            </div>
            @endif
            @if (Session::get('updateCategory'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button> <strong>Success!</strong> {{ Session::get('updateCategory')}}
            </div>
            @endif
            @if (Session::get('deleteCategory'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button> <strong>Success!</strong> {{ Session::get('deleteCategory')}}
            </div>
            @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary" data-toggle="modal"
                                        data-target="#createCategories">Create
                                        Category</button>
                                </div>
                                <hr>
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped table-bordered zero-configuration" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="max-width: 60px;">No</th>
                                                <th>Category</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            ?>
                                            @forelse ($categoriesDB as $category)
                                            <tr>
                                                <td class="text-center">{{ $i++ }}</td>
                                                <td>{{ $category->category_name }}</td>
                                                <td>
                                                    <li><b>Created At :</b>
                                                        {{ $category->created_at->format('Y-m-d H:i') }}</li>
                                                    <li><b>Updated At :</b>
                                                        {{ $category->updated_at->format('Y-m-d H:i') }}</li>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <button class="btn btn-success mr-1" data-toggle="modal"
                                                            data-target="#editCategories{{ $category->id }}"><i
                                                                class="fa-solid fa-pen"></i></button>
                                                        <a title="Delete" class="btn btn-danger mr-1 text-white"
                                                            style="width: 40px;" data-toggle="modal"
                                                            data-target="#deleteCategory{{ $category->id }}"><i
                                                                class="fa-solid fa-trash"></i></a>
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
        </section>
    </div>
</div>

{{-- Modal --}}

{{-- create --}}
<div class="modal fade" id="createCategories" tabindex="-1" role="dialog" aria-labelledby="createCategoriesLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoriesLabel">Create Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('category.post') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Category Name:</label>
                        <input name="category_name" type="text" class="form-control" id="recipient-name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Category</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- edit --}}
@foreach ($categoriesDB as $category)
<div class="modal fade" id="editCategories{{ $category->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editCategoriesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoriesLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('category.update', $category->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Category Name:</label>
                        <input name="category_name" type="text" class="form-control" id="recipient-name" required
                            value="{{ $category->category_name }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Category</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete --}}
<div class="modal fade" id="deleteCategory{{ $category->id }}" tabindex="-1" role="dialog"
    aria-labelledby="createCategoriesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoriesLabel">Delete Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('category.delete', $category->id) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="form-group">
                        <span>Are you sure?, Once deleted, you will not be able to recover this category!?</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
