@extends('layout')
@section('content')

<div class="container-fluid mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if (Session::get('createPage'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button> <strong>Success!</strong> {{ Session::get('createPage')}}
                </div>
                @endif
                @if (Session::get('updatePage'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button> <strong>Success!</strong> {{ Session::get('updatePage')}}
                </div>
                @endif
                @if (Session::get('deletePage'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button> <strong>Success!</strong> {{ Session::get('deletePage')}}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button> <strong>Error:</strong>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create Block</h4>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-danger ml-1" href="{{ route('block', $pageDB['id']) }}">Back</a>
                        </div>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-md-4"><b>Project Name:</b></div>
                            <div class="col">{{ $pageDB->projects->project_name }}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4"><b>Project Manager:</b></div>
                            <div class="col-md-8">{{ $pageDB->projects->project_manager }}</div>
                        </div>
                        <hr>
                        <form action="{{ route('block.post', $page->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-3">
                                <div class="col-md-4"><b>Category:</b></div>
                                <div class="col">
                                    <select name="category_id" class="form-control">
                                        @foreach ($blockCategory as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4"><b>Block Name:</b></div>
                                <div class="col-md-8"><input type="text" name="block_name" class="form-control"
                                        placeholder="Enter Block Name"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4"><b>Section Note:</b></div>
                                <div class="col-md-8"><textarea name="description" class="form-control"></textarea></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4"><b>Main Image:</b></div>
                                <div class="input-group mb-3 col-md-8">
                                    <div class="custom-file">
                                        <input name="main_image" type="file" class="custom-file-input">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4"><b>Mobile Image:</b></div>
                                <div class="input-group mb-3 col-md-8">
                                    <div class="custom-file">
                                        <input name="mobile_image" type="file" class="custom-file-input">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4"><b>Sample Image 1:</b></div>
                                <div class="input-group mb-3 col-md-8">
                                    <div class="custom-file">
                                        <input name="sample_image_1" type="file" class="custom-file-input">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4"><b>Main Image:</b></div>
                                <div class="input-group mb-3 col-md-8">
                                    <div class="custom-file">
                                        <input name="sample_image_2" type="file" class="custom-file-input">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Save Block</button>
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
