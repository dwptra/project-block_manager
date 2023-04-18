@extends('layout')
@section('content')

<div class="container-fluid mt-3">
    @if (Session::get('isGuest'))
        <div class="alert alert-primary alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button> <strong>Fail</strong> {{ Session::get('isGuest')}}
        </div>
        @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Project List</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Project Name</th>
                                        <th>Project Manager</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projectDB as $project)
                                    <tr>
                                        <td>{{ $project->id }}</td>
                                        <td>{{ $project->project_name }}</td>
                                        <td>{{ $project->project_manager }}</td>
                                        <td>
                                            <a href="/page">See Pages</a> | 
                                            <form action="">
                                                <a href="">Delete</a>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Project Name</th>
                                        <th>Project Manager</th>
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

</div>
@endsection
