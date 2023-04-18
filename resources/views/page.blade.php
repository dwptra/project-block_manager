@extends('layout')
@section('content')
<div class="container-fluid mt-3">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Page List</h4>
                        <hr>
                        <p><b class="pr-4">Project Name</b>: </p>
                        <p><b class="pr-2">Project Manager</b>: </p>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Project Name</th>
                                        <th>Project Manager</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>
                                            <a href="">See Pages</a> | 
                                            <form action="">
                                                <a href="">Delete</a>
                                            </form>
                                        </td>
                                    </tr>
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
