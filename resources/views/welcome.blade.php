<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LaravelImageGallery</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    {{--    dropify--}}
    <link rel="stylesheet" href="https://jeremyfagis.github.io/dropify/dist/css/demo.css">
    <link rel="stylesheet" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    {{--lightbo Image Show --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    {{--Custom Css --}}
    <link rel="stylesheet" href="{{asset('css/custom.css')}} ">
</head>
<body>
<nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand">ImageGallery</a>
</nav>
<div class="container" style="margin-top:30px">
    <h3 class="font-weight-light text-center text-lg-left mt-4 mb-0">Your Image</h3>

    <div class="input-group mb-3">
        <div class="btn-group mr-5" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Upload
                Image
            </button>
        </div>
        <input type="text" class="form-control" id="search" onkeyup="imageTitleFilter()" onkeydown="imageTitleFilter()"
               onkeypress="imageTitleFilter()" placeholder="Search By Image Title..." aria-label="Recipient's username"
               aria-describedby="basic-addon2">
    </div>
    <hr class="mt-2 mb-5">
    <div class="row">
        <div class="row" id="all-images">

        </div>
    </div>
</div>

<!-- Image Upload modal -->
<div class="modal fade bd-example-modal-lg" id="image-add" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="error_message"></div>
            <div id="success_message"></div>
            <form id="image-save" method="POST" enctype="multipart/form-data" action="{{ route('upload-image') }}">
                @csrf
                <div class="modal-body">

                    <input type="file" name="image" class="dropify" id="image-input" data-default-file="" required/>
                    <hr class="mt-2 mb-5">
                    <div class="progress" style="display: none">
                        <div class="progress-bar bar">
                            <div class="percent">0%</div>
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        <label for="image-title" class="col-sm-2 col-form-label">Image Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="image_title" class="form-control" id="image-title"
                                   placeholder="Image Title" required data-allowed-file-extensions="png"
                                   data-max-file-size-preview="5M">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
{{--dropify --}}
<script src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
{{--lightbox--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
{{--custom JS--}}
<script src="{{asset('js/custom.js')}}"></script>
@include("script._script")
</body>
</html>
