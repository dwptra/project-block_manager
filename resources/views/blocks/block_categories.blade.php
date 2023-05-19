@extends('layout')
@section('content')
<style>
    .row p b {
        display: inline-block;
        min-width: 125px;
    }

</style>
<div class="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>Categories List</h1>
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
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#createCategories">Create
                                        Category</button>
                                </div>
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="max-width: 60px;">No</th>
                                                <th>Category Name</th>
                                                <th>Created_at</th>
                                                <th>Updated_at</th>
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
                                                <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                                <td>{{ $category->updated_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <button class="btn btn-primary mr-1" data-toggle="modal"
                                                            data-target="#editCategories{{ $category->id }}">Edit</button>
                                                        <form action="{{ route('category.delete', $category->id) }}"
                                                            method="post">
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
                                        <tfoot>
                                            <tr>
                                                <th class="text-center" style="max-width: 60px;">No</th>
                                                <th>Category Name</th>
                                                <th>Created_at</th>
                                                <th>Updated_at</th>
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
                    <button type="submit" class="btn btn-primary">Create</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
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
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
