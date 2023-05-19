@extends('layout')
@section('content')
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>Block Create</h1>     
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning alert-has-icon">
                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                        <div class="alert-body">
                            <div class="alert-title">Warning</div>
                            Make sure <b>Sort</b> is not the same.
                        </div>
                    </div>
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
                        <form action="{{ route('block.post', $page->id) }}" method="post" enctype="multipart/form-data">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-1">Save Block</button>
                            <a class="btn btn-danger ml-1" href="{{ route('block', $page->id) }}">Back</a>
                        </div>
                        <hr>
                        @csrf
                        <div class="form-group row mb-1">
                            <label class="col-sm-2 col-form-label"><b>Project Name</b><span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <span style="font-size: 14px;">: {{ $page->projects->project_name }}</span>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-2 col-form-label"><b>Project Manager</b><span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <span style="font-size: 14px;">: {{ $page->projects->projectManager->name }}</span>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-2"><b>Section Name</b><span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" name="section_name" class="form-control" placeholder="Enter Section Name" value="{{ old('section_name') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-2 col-form-label"><b>Section Note</b></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <textarea name="note" class="form-control" rows="5" cols="50" placeholder="Enter Note">{{ old('note') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><b>Sort</b><span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" name="sort" class="form-control" placeholder="Enter Section Sort" value="{{ old('sort') }}" required>
                                </div>
                            </div>
                        </div>
                        <div id="accordion">
                            <div class="accordion">
                                @foreach ($blockDB->groupBy('categories.category_name') as $categoryName => $blocks)
                                <div class="accordion-item">
                                    <div class="accordion-header mt-2" role="button" data-toggle="collapse"
                                        data-target="#{{ Str::slug($categoryName) }}" aria-expanded="false"
                                        aria-controls="{{ Str::slug($categoryName) }}">
                                        <h4>
                                            {{ $categoryName }}
                                        </h4>
                                    </div>
                                    <div id="{{ Str::slug($categoryName) }}" class="accordion-collapse collapse"
                                        data-parent="#accordion">
                                        <div class="accordion-body">
                                            <div class="d-flex justify-content-center">
                                                @foreach ($blocks as $block)
                                                <div class="card mx-4 mb-4" style="width: 18rem;">
                                                    <div class="gallery gallery-fw" data-item-height="300">
                                                        <div class="gallery-item" data-image="{{ asset('storage/images/main_image/' . basename($block->main_image)) }}" data-title="Image 1"></div>
                                                        {{-- hide --}}
                                                        <div class="gallery-item gallery-hide" data-image="{{ asset('storage/images/mobile_image/' . basename($block->mobile_image)) }}" data-title="Image 2"></div>
                                                        <div class="gallery-item gallery-hide" data-image="{{ asset('storage/images/sample_image_1/' . basename($block->sample_image_1)) }}" data-title="Image 3"></div>
                                                        <div class="gallery-item gallery-hide" data-image="{{ asset('storage/images/sample_image_2/' . basename($block->sample_image_2)) }}" data-title="Image 4"></div>
                                                    </div>
                                                    <div class="card-body">
                                                        <input type="radio" class="selectgroup-input"  name="block_id" id="option{{ $block->id }}" autocomplete="off" value="{{ $block->id }}">
                                                        <label class="selectgroup-button btn btn-light align-center w-100 mb-0" for="option{{ $block->id }}">{{ $block->block_name }}</label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        // Menutup semua accordion saat halaman dimuat
        $('.accordion-collapse').collapse('hide');

        // Membuka accordion pertama saat halaman dimuat
        $('.accordion-item:first-child .accordion-collapse').collapse('show');
        $('.accordion-item:first-child .accordion-header').attr('aria-expanded', 'true');
    });
</script>

@endsection