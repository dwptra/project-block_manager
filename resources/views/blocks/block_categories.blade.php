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
                            <a class="btn btn-primary" href="">Create Category</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="max-width: 30px;">#</th>
                                        <th>Category Name</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @forelse ($categoriesDB as $category)
                                    <tr>
                                        <td class="text-center">{{ $category->id }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>{{ $category->updated_at }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-primary mr-1" href="#">Edit</a>
                                                <form action="" method="post">
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
