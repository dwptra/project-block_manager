<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print</title>
    <link rel="icon" type="image/png" sizes="16x16" href="https://cdn-icons-png.flaticon.com/512/3665/3665896.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        
        
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12 mt-4">
                <h1>{{ $pageDB->projects->project_name }}</h1>
                <div class="mt-4 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Project Name</label>
                    <div class="col-sm-10">
                        <p>: {{ $pageDB->projects->project_name }}</p>
                    </div>
                </div>
                <div class="row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Project Manager</label>
                    <div class="col-sm-10">
                        <p>: {{ $project->project_manager }}</p>
                    </div>
                </div>
                <div class="row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Page Name</label>
                    <div class="col-sm-10">
                        <p>: {{ $pageDB->page_name }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-12 mt-4 ">
            @forelse($blockList as $block)
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="https://ps.w.org/full-width-responsive-slider-wp/assets/icon-256x256.png?rev=1784180"
                                class="img-fluid rounded-start" style="max-width: 180px;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text"><strong>Urutan/Sort</strong> : {{ $block->sort }}</p>
                                <p class="card-text"><strong>Section Name</strong> : {{ $block->section_name }}</p>
                                <p class="card-text"><strong>Block Name</strong> : {{ $block->blocks->block_name }}</p>
                                <p class="card-text"><strong>Note</strong> : {{ $block->note }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                @empty
                <p>No data found</p>
            @endforelse

        </div>
    </div>
    <!-- #/ container -->
    </div>
    <!--**********************************
    Content body end
    ***********************************-->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
    <script>
        window.onload = function() {
            window.print();
            setTimeout(function(){window.close();}, 3000);
        }
        
        window.onafterprint = function() {
            window.close();
        }
        
        window.onbeforeunload = function() {
            window.close();
        }
    </script>
</body>

</html>