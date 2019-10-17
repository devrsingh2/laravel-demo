@extends('web.layouts.dashboard-layout')
@section('header')
    <style>
        .tool-container li {
            display: inline-block;
        }
    </style>
@endsection
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-display1 icon-gradient bg-premium-dark">
                        </i>
                    </div>
                    <div>Drawing
                        {{--                        <div class="page-title-subheading">Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.</div>--}}
                    </div>
                </div>
            </div>
        </div>
        <form class="" id="upload_file" method="post" enctype="multipart/form-data" action="{{ url('/') }}/upload-drawing">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="alert alert-danger error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Choose MC Type:</h5>
                            <div class="position-relative form-group">
                                <div>
                                    <input name="mc_type" id="mc_type" type="file" class="form-control-file">
                                    <small class="form-text text-muted">MC Type should be like(PDF/JPG/TIFF)</small>
                                </div>
                            </div>
                            <div class="pull-right">
                                <button class="btn btn-primary" name="upload_drawing" id="upload_drawing" type="submit">Upload Drawing</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Drawing Tool</h5>
                            <div class="position-relative form-group">
                                <div>
{{--                                    <div class="preview-uploaded-image"></div>--}}
                                    <ul class="list-inline tool-container">
                                        <li>
                                            <img width="100" src="{{ url('/') }}/assets/img/rect.png">
                                        </li>
                                        <li>
                                            <img width="80" src="{{ url('/') }}/assets/img/triangle.png">
                                        </li>
                                        <li>
                                            <img width="80" src="{{ url('/') }}/assets/img/circle.png">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Dra<span style="background: #f19240">win</span>g</h5>
                            <div class="position-relative form-group">
                                <div>
                                    <div class="preview-uploaded-image"></div>
                                    {{--<div id="canvas-container">
                                        <canvas id="canvas-data-container" width="930" height="600" style="border: 1px solid black;"></canvas>
                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.6.2/fabric.min.js"></script>
    <script src="{{ asset('assets/js/custom/canvas-drawing.js') }}"></script>
    <script>
        $("body").on("click","#upload_drawing",function(e){
            $(this).parents("form").ajaxForm({
                complete: function(response)
                {
                    if ($.isEmptyObject(response.responseJSON.image)) {
                        $('.preview-uploaded-image').html('<img width="620" src="'+response.responseJSON.url+'">');
                        {{--                        let imagePath = '{{ url('/') }}/'+ response.responseJSON.url;--}}
                    } else {
                        var msg = response.responseJSON.image;
                        $(".error-msg").find("ul").html('');
                        $(".error-msg").css('display','block');
                        $.each( msg, function( key, value ) {
                            $(".error-msg").find("ul").append('<li>'+value+'</li>');
                        });
                    }
                }
            });
        });

    </script>
@endsection
