@extends('layout')
@section('content')
<div class="container-fluid mt-3">
    @if (Session::get('isGuest'))
    <div class="alert alert-primary alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button> <strong>Fail!</strong> {{ Session::get('isGuest')}}
    </div>
    @endif
    @if (Session::get('createProject'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button> <strong>Success!</strong> {{ Session::get('createProject')}}
    </div>
    @endif
    @if (Session::get('updateProject'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button> <strong>Success!</strong> {{ Session::get('updateProject')}}
    </div>
    @endif
    @if (Session::get('deleteProject'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button> <strong>Success!</strong> {{ Session::get('deleteProject')}}
    </div>
    @endif
    @if (Session::get('successLogin'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button> <strong>Success!</strong> {{ Session::get('successLogin')}}
    </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Block List</h4>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-primary" href="{{ route('blockmaster.create') }}">Create New Block</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <?php
                                        $i = 1;
                                    ?>
                                    <tr>
                                        <th>NO</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Main Image</th>
                                        <th>Mobile Image</th>
                                        <th>Sample Image 1</th>
                                        <th>Sample Image 2</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blockCategory as $block)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $block->id }}</td>
                                        <td>{{ $block->name }}</td>
                                        <td>{{ $block->main_image}}</td>
                                        <td>{{ $block->mobile_image }}</td>
                                        <td>{{ $block->sample_image_1 }}</td>
                                        <td>{{ $block->sample_image_2 }}</td>
                                        <td>
                                            {{-- <div class="d-flex">
                                                <a class="btn btn-warning text-white mr-1" href="{{ route('page', $project->id)  }}">See Pages</a> 
                                                <a class="btn btn-primary mr-1" href="{{ route('project.edit', $project['id']) }}">Edit</a>
                                                <form action="{{ route('project.delete', $project['id']) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')" type="submit">Delete</button>
                                                </form>
                                            </div> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>NO</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Main Image</th>
                                        <th>Mobile Image</th>
                                        <th>Sample Image 1</th>
                                        <th>Sample Image 2</th>
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
    <!-- #/ container -->
</div>
@endsection
