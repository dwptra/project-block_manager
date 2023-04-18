@extends('layout')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-validation">
                        <h4>Page Create</h4>
                        <hr>
                        <form class="form-valide" action="#" method="post">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-project-name">Project Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-project-name" name="val-project-name" value="{{ $pages->projects->project_name }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-email">Email <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-email" name="val-email" placeholder="Your valid email..">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-password">Password <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="password" class="form-control" id="val-password" name="val-password" placeholder="Choose a safe one..">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-confirm-password">Confirm Password <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="password" class="form-control" id="val-confirm-password" name="val-confirm-password" placeholder="..and confirm it!">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-suggestions">Suggestions <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <textarea class="form-control" id="val-suggestions" name="val-suggestions" rows="5" placeholder="What would you like to see?"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-skill">Best Skill <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="val-skill" name="val-skill">
                                        <option value="">Please select</option>
                                        <option value="html">HTML</option>
                                        <option value="css">CSS</option>
                                        <option value="javascript">JavaScript</option>
                                        <option value="angular">Angular</option>
                                        <option value="angular">React</option>
                                        <option value="vuejs">Vue.js</option>
                                        <option value="ruby">Ruby</option>
                                        <option value="php">PHP</option>
                                        <option value="asp">ASP.NET</option>
                                        <option value="python">Python</option>
                                        <option value="mysql">MySQL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-currency">Currency <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-currency" name="val-currency" placeholder="$21.60">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-website">Website <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-website" name="val-website" placeholder="http://example.com">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-phoneus">Phone (US) <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-phoneus" name="val-phoneus" placeholder="212-999-0000">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-digits">Digits <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-digits" name="val-digits" placeholder="5">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-number">Number <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-number" name="val-number" placeholder="5.0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-range">Range [1, 5] <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-range" name="val-range" placeholder="4">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"><a href="#">Terms &amp; Conditions</a>  <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <label class="css-control css-control-primary css-checkbox" for="val-terms">
                                        <input type="checkbox" class="css-control-input" id="val-terms" name="val-terms" value="1"> <span class="css-control-indicator"></span> I agree to the terms</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-8 ml-auto">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
<!-- #/ container -->
</div>
<!--**********************************
Content body end
***********************************-->
@endsection