<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print</title>
    <link rel="icon" type="image/png" sizes="16x16" href="https://cdn-icons-png.flaticon.com/512/3665/3665896.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-lg-12 mt-4">
                    <h1>{{ $pagePrint->projects->project_name }}</h1>
                    <table>
                        <tbody>
                            <tr>
                                <td><b>Project Name</b></td>
                                <td class="">&nbsp:</td>
                                <td style="">{{ $pagePrint->projects->project_name }}</td>
                            </tr>
                            <tr>
                                <td><b>Project Manager</b></td>
                                <td> &nbsp:</td>
                                <td>{{ $projectPrint->projectManager->name }}</td>
                            </tr>
                            <tr>
                                <td><b>Page Name</b></td>
                                <td class="ml-4"> &nbsp:</td>
                                <td>
                                    {{ $pagePrint->page_name }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mt-4 ">
                @forelse($blockPrint as $block)
                <div class="card w-100 mb-3 text-start" ">
                    <div class="row g-0">
                        <div class="col">
                            <img src="{{ asset('storage/images/main_image/' . basename($block->blocks->main_image)) }}"
                                class="img-fluid rounded-start" style="max-width: 350px;">
                        </div>
                        <div class="col">
                            <div class="card-body">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td><b>Urutan/Sort</b></td>
                                            <td class="">&nbsp:</td>
                                            <td style="">{{ $block->sort }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Section Name</b></td>
                                            <td> &nbsp:</td>
                                            <td>{{ $block->section_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Block Name</b></td>
                                            <td class="ml-4"> &nbsp:</td>
                                            <td>
                                                {{ $block->blocks->block_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b> Section Note</b></td>
                                            <td> &nbsp:</td>
                                            <td>
                                                {{ $block->note }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p>No data found</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="table-wrapper mt-5" style="text-align:center">
        <table class="table table-bordered" style="max-width: 300px;">
            <thead>
              <tr class="text-center">
                <th scope="col">Dibuat Oleh</th>
                <th scope="col">Disetujui Oleh</th>
              </tr>
            </thead>
            <tbody>
              <tr class="text-center align-middle" style="height: 70px;">
                <td> {{ $projectPrint->projectManager->name }}</td>
                <td> ... </td>
              </tr>
            </tbody>
          </table>
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
        window.onload = function () {
            window.print();
            setTimeout(function () {
                window.close();
            }, 3000);
        }

        window.onafterprint = function () {
            window.close();
        }

        window.onbeforeunload = function () {
            window.close();
        }

    </script>
</body>


</html>
