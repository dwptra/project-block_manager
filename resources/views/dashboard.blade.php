@extends('layout')
@section('content')

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
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <section class="section">
                <div class="section-header">
                    <h1>Dashboard</h1>
                </div>
            </section>
        </div>
    </div>
@endsection
