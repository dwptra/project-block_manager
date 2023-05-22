@extends('layout')
@section('content')
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>Edit Block Master</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><b>Master Data</b></div>
                    <div class="breadcrumb-item active"><a href="{{ route('block.master') }}">Block Master</a></div>
                    <div class="breadcrumb-item text-muted">Edit</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
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
                            <form action="{{ route('blockmaster.update', $blockEdit['id']) }}" method="post"
                            enctype="multipart/form-data">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mr-1">Save Block</button>
                                <a class="btn btn-danger ml-1" href="{{ route('block.master') }}">Back</a>
                            </div>
                            <hr>
                                @csrf
                                @method('PATCH')
                                <div class="row mt-3">
                                    <div class="col-md-4"><b>Block Name <span class="text-danger">*</span></b></div>
                                    <div class="col-md-8"><input type="text" name="block_name" class="form-control" 
                                            placeholder="Enter Block Name" required value="{{ $blockEdit->block_name }}"></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4"><b>Category <span class="text-danger">*</span></b></div>
                                    <div class="col-lg-8">
                                        <select class="form-control selectric" aria-label="Default select example"
                                            name="category_id">
                                            <option value="" selected disabled>Select Category Block</option>
                                            @foreach($blockCategoryEdit as $category)
                                            <option value="{{$category->id}}"
                                                {{$category->id == $blockEdit->category_id ? 'selected' : '' }}>
                                                {{$category->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4"><b>Description <span class="text-danger"></span></b></div>
                                    <div class="col-md-8"><textarea name="description" class="form-control"
                                            id="val-note" rows="5"
                                            placeholder="Not Required">{{$blockEdit->description}}</textarea></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4"><b>Main Image <span class="text-danger">*</span></b></div>
                                    <div class="input-group col-lg-8">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="main_image"
                                                onchange="previewImage(event)" value="{{$blockEdit->main_image}}">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="col-8 offset-md-4">
                                        <p id="main-image-error" class="text-danger md-2 ml-1"></p>
                                        <p id="tipe-main-image" class="text-danger md-2 ml-1"></p>
                                        <p id="size-main-image" class="text-danger md-2 ml-1"></p>
                                    </div>
                                </div>
                                <div class="row mt-3" id="preview-container">
                                    <div class="col-md-4" for="preview"><b>Main Image Preview <span
                                                class="text-danger"></span></b></div>
                                    <div class="col-lg-8 offset-md-4">
                                        <img id="preview"
                                            src="{{ asset('storage/images/main_image/' . basename($blockEdit->main_image)) }}"
                                            alt="image preview" style="max-width: 400px; max-height: 300px;">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4"><b>Mobile Image <span class="text-danger">*</span></b></div>
                                    <div class="input-group col-lg-8">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="mobile_image"
                                                onchange="previewMobileImage(event)"
                                                value="{{$blockEdit->mobile_image}}">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="col-8 offset-md-4">
                                        <p id="mobile-image-error" class="text-danger md-2 ml-1"></p>
                                        <p id="tipe-mobile-image" class="text-danger md-2 ml-1"></p>
                                        <p id="size-mobile-image" class="text-danger md-2 ml-1"></p>
                                    </div>
                                </div>
                                <div class="row" id="mobile-preview-container">
                                    <div class="col-md-4" for="mobile_preview"><b>Mobile Image Preview <span
                                                class="text-danger"></span></b></div>
                                    <div class="col-lg-8 offset-md-4">
                                        <img id="mobile_preview"
                                            src="{{ asset('storage/images/mobile_image/' . basename($blockEdit->mobile_image)) }}"
                                            alt="image preview" style="max-width: 400px; max-height: 300px;">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4"><b>Sample Image 1<span class="text-danger">*</span></b></div>
                                    <div class="input-group col-lg-8">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="sample_image_1"
                                                onchange="previewSample1(event)" value="{{$blockEdit->sample_image_1}}">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="col-8 offset-md-4">
                                        <p id="sample-image-1-error" class="text-danger md-2 ml-1"></p>
                                        <p id="tipe-sample-image-1" class="text-danger md-2 ml-1"></p>
                                        <p id="size-sample-image-1" class="text-danger md-2 ml-1"></p>
                                    </div>
                                </div>
                                <div class="row" id="sample1-preview-container">
                                    <div class="col-md-4" for="sample1_preview"><b>Sample Image 1 Preview <span
                                                class="text-danger"></span></b></div>
                                    <div class="col-lg-8 offset-md-4">
                                        <img id="sample1_preview"
                                            src="{{ asset('storage/images/sample_image_1/' . basename($blockEdit->sample_image_1)) }}"
                                            alt="image preview" style="max-width: 400px; max-height: 300px;">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4"><b>Sample Image 2 <span class="text-danger">*</span></b></div>
                                    <div class="input-group col-lg-8">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="sample_image_2"
                                                onchange="previewSample2(event)" value="{{$blockEdit->sample_image_2}}">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="col-8 offset-md-4">
                                        <p id="sample-image-2-error" class="text-danger md-2 ml-1"></p>
                                        <p id="tipe-sample-image-2" class="text-danger md-2 ml-1"></p>
                                        <p id="size-sample-image-2" class="text-danger md-2 ml-1"></p>
                                    </div>
                                </div>
                                <div class="row mt-3" id="sample2-preview-container">
                                    <div class="col-md-4" for="sample2_preview"><b>Sample Image 2 Preview <span
                                                class="text-danger"></span></b></div>
                                    <div class="col-lg-8 offset-md-4">
                                        <img id="sample2_preview"
                                            src="{{ asset('storage/images/sample_image_2/' . basename($blockEdit->sample_image_2)) }}"
                                            alt="image preview" style="max-width: 400px; max-height: 300px;">
                                    </div>
                                </div>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="{{ asset('assets/js/imageEdit.js')}}"></script>
@endsection
