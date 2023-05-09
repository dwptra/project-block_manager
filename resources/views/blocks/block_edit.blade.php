@extends('layout')
@section('content')
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <section class="section">
            <div class="section-header">
                <h1>Block Edit</h1>     
            </div>
        <div class="row">
            <div class="col-12">
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
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-danger ml-1" href="{{ route('block', $page->id) }}">Back</a>
                        </div>
                        <hr>
                        <form action="{{ route('block.update', $blockEdit['id'])}}" method="post">
                            @csrf
                            @method('PATCH')
                            <table>
                                <tbody>
                                    <tr>
                                        <td><b>Project Name</b></td>
                                        <td class="ml-4">&nbsp&nbsp:</td>
                                        <td style="width: 1035px">{{ $page->projects->project_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Project Manager</b></td>
                                        <td> &nbsp&nbsp:</td>
                                        <td class="">{{ $page->projects->projectManager->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Section Name</b></td>
                                        <td> &nbsp&nbsp</td>
                                        <td>
                                            <input type="text" name="section_name" class="form-control" placeholder="Enter Section Name" value="{{ $blockEdit->section_name}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b> Section Note</b></td>
                                        <td> &nbsp&nbsp</td>
                                        <td>
                                            <textarea type="text" name="note" class="form-control mt-1" placeholder="Enter Note">{{ $blockEdit->note}}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b> Sort</b></td>
                                        <td> &nbsp&nbsp</td>
                                        <td>
                                            <input type="text" name="sort" class="form-control" placeholder="Enter Section Sort" value="{{ $blockEdit->sort}}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            {{-- <div class="row mt-3">
                                <div class="col-md-4"><b>Section Name:</b></div>
                                <div class="col-md-8"><input type="text" name="section_name" class="form-control"
                                        placeholder="Enter Section Name" value="{{ $blockEdit->section_name}}"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4"><b>Section Note:</b></div>
                                <div class="col-md-8"><textarea type="text" name="note" class="form-control"
                                        placeholder="Enter Note">{{ $blockEdit->note}}</textarea></div>
                            </div> --}}
                            {{-- <div class="row mt-3">
                                <div class="col-md-4"><b>Sort:</b></div>
                                <div class="col-md-8">
                                    <select class="form-select" aria-label="Default select example" name="sort">
                                        @foreach ($sort as $so)    
                                        <option value="{{ $so->sort }}" {{ $so->sort == $blockEdit->sort ? 'selected' : '' }}>{{ $so->sort }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="mt-3 mb-3">
                                <button type="submit" class="btn btn-primary">Save Block</button>
                            </div>
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                @foreach ($blockDB->groupBy('categories.category_name') as $categoryName => $blocks)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#{{ Str::slug($categoryName) }}" aria-expanded="true"
                                            aria-controls="{{ Str::slug($categoryName) }}">
                                            {{ $categoryName }}
                                        </button>
                                    </h2>
                                    <div id="{{ Str::slug($categoryName) }}" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body">
                                            <div class="d-flex justify-content-center">
                                                @foreach ($blocks as $block)
                                                <div class="card mx-4" style="width: 18rem;">
                                                    <div class="gallery gallery-fw" data-item-height="300">
                                                        <div class="gallery-item card-img-top" data-image="{{ asset('storage/images/main_image/' . basename($block->main_image)) }}" data-title="Image 1"></div>
                                                        {{-- hide --}}
                                                        <div class="gallery-item gallery-hide" data-image="{{ asset('storage/images/mobile_image/' . basename($block->mobile_image)) }}" data-title="Image 2"></div>
                                                        <div class="gallery-item gallery-hide" data-image="{{ asset('storage/images/sample_image_1/' . basename($block->sample_image_1)) }}" data-title="Image 3"></div>
                                                        <div class="gallery-item gallery-hide" data-image="{{ asset('storage/images/sample_image_2/' . basename($block->sample_image_2)) }}" data-title="Image 4"></div>
                                                    </div>       
                                                    <div class="card-body">
                                                        <input type="radio" class="btn-check btn-check-custom" name="block_id"
                                                            id="option{{ $block->id }}" autocomplete="off"
                                                            value="{{ $block->id }}" {{ $block->id == $blockEdit->block_id ? 'checked' : '' }} />
                                                        <label class="btn btn-light align-center w-100 mb-0"
                                                            for="option{{ $block->id }}">{{ $block->block_name }}</label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/slide.js')}}"></script>
@endsection
