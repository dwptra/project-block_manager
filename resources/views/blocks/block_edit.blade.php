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
                            <a class="btn btn-danger ml-1" href="{{ route('block', $page_id) }}">Back</a>
                        </div>
                        <hr>
                        {{-- <div class="row mt-3">
                            <div class="col-md-4"><b>Project Name:</b></div>
                            <div class="col">{{ $pageDB->projects->project_name }}</div>
                        </div> --}}
                        {{-- <div class="row mt-3">
                            <div class="col-md-4"><b>Project Manager:</b></div>
                            <div class="col-md-8">{{ $blockEdit->name }}</div>
                        </div> --}}
                        <hr>
                        <form action="{{ route('block.update', $blockEdit['id'])}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="row mt-3">
                                <div class="col-md-4"><b>Section Name:</b></div>
                                <div class="col-md-8"><input type="text" name="section_name" class="form-control"
                                        placeholder="Enter Section Name" value="{{ $blockEdit->section_name}}"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4"><b>Section Note:</b></div>
                                <div class="col-md-8"><textarea type="text" name="note" class="form-control"
                                        placeholder="Enter Note">{{ $blockEdit->note}}</textarea></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4"><b>Sort:</b></div>
                                <div class="col-md-8"><input type="number" name="sort" class="form-control"
                                        placeholder="Enter Section Name" value="{{ $blockEdit->sort}}"></div>
                            </div>
                            <div class="mt-3 mb-3">
                                <button type="submit" class="btn btn-primary">Save Block</button>
                            </div>
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapseOne">
                                            Hero Banner
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body">
                                            <div class="d-flex justify-content-center">
                                                @foreach ($blockDB as $block)
                                                <div class="card mx-4" style="width: 18rem;">
                                                    <img class="card-img-top"
                                                        src="{{ asset('storage/images/main_image/' . basename($block->main_image)) }}"
                                                        alt="Card image cap">
                                                    <div class="card-body">
                                                        <input type="radio" class="btn-check" name="block_id"
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
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                            Section Text
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingTwo">
                                        <div class="accordion-body">
                                            <strong>This is the second item's accordion body.</strong> It is hidden by
                                            default, until the collapse plugin adds the appropriate classes that we use
                                            to style each element. These classes control the overall appearance, as well
                                            as the showing and hiding via CSS transitions. You can modify any of this
                                            with custom CSS or overriding our default variables. It's also worth noting
                                            that just about any HTML can go within the <code>.accordion-body</code>,
                                            though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                            Section Feature
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingThree">
                                        <div class="accordion-body">
                                            <strong>This is the second item's accordion body.</strong> It is hidden by
                                            default, until the collapse plugin adds the appropriate classes that we use
                                            to style each element. These classes control the overall appearance, as well
                                            as the showing and hiding via CSS transitions. You can modify any of this
                                            with custom CSS or overriding our default variables. It's also worth noting
                                            that just about any HTML can go within the <code>.accordion-body</code>,
                                            though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                            Content Page
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingFour">
                                        <div class="accordion-body">
                                            <strong>This is the second item's accordion body.</strong> It is hidden by
                                            default, until the collapse plugin adds the appropriate classes that we use
                                            to style each element. These classes control the overall appearance, as well
                                            as the showing and hiding via CSS transitions. You can modify any of this
                                            with custom CSS or overriding our default variables. It's also worth noting
                                            that just about any HTML can go within the <code>.accordion-body</code>,
                                            though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                                            Footer
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingFive">
                                        <div class="accordion-body">
                                            <strong>This is the second item's accordion body.</strong> It is hidden by
                                            default, until the collapse plugin adds the appropriate classes that we use
                                            to style each element. These classes control the overall appearance, as well
                                            as the showing and hiding via CSS transitions. You can modify any of this
                                            with custom CSS or overriding our default variables. It's also worth noting
                                            that just about any HTML can go within the <code>.accordion-body</code>,
                                            though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseSix">
                                            Header
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingSix">
                                        <div class="accordion-body">
                                            <strong>This is the second item's accordion body.</strong> It is hidden by
                                            default, until the collapse plugin adds the appropriate classes that we use
                                            to style each element. These classes control the overall appearance, as well
                                            as the showing and hiding via CSS transitions. You can modify any of this
                                            with custom CSS or overriding our default variables. It's also worth noting
                                            that just about any HTML can go within the <code>.accordion-body</code>,
                                            though the transition does limit overflow.
                                        </div>
                                    </div>
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
@endsection
