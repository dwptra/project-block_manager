@extends('layout')
@section('content')
<div class="container-fluid mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create Block</h4>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-danger ml-1" href="{{ route('block.master') }}">Back</a>
                        </div>
                        <hr>
                        <form action="{{ route('blockmaster.post') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-3">
                                <div class="col-md-4"><b>Block Name <span class="text-danger">*</span></b></div>
                                <div class="col-md-8"><input type="text" name="block_name" class="form-control"
                                        placeholder="Enter Block Name" value="{{ $blockEdit->block_name }}"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4"><b>Category <span class="text-danger">*</span></b></div>
                                <div class="col-lg-8">
                                    <select class="form-select" aria-label="Default select example" name="category_id">
                                        <option value="" selected disabled>Select Category Block</option>
                                        @foreach($blockCategoryEdit as $category)
                                            <option value="{{$category->id}}" {{$category->id == $blockEdit->category_id ? 'selected' : '' }}>{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                                                       
                            <div class="row mt-3">
                                <div class="col-md-4"><b>Description <span class="text-danger"></span></b></div>
                                <div class="col-md-8"><textarea name="description" class="form-control" id="val-note" rows="5" placeholder="Not Required">{{$blockEdit->description}}</textarea></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4"><b>Main Image <span class="text-danger">*</span></b></div>
                                <div class="input-group col-lg-8">   
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="main_image">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>                           
                            <div class="mt-3 mb-3">
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
