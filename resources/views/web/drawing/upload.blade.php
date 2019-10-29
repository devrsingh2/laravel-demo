@extends('web.layouts.dashboard-layout')
@section('header')
    <style>
        .tool-container li {
            display: inline-block;
        }
        #canvas-data-container {
            border: 2px dotted black;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/customize/drawing.css') }}" />
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
                                    <div class="toolblock">
                                        <h4>Drawing Tools</h4>
                                        <div class="inner_tool">
                                            <button class="line-drawing-tools" data-value="circle">
                                                <i class="toolicon1"></i>
                                            </button>
                                            <button class="line-drawing-tools" data-value="line">
                                                <i class="toolicon2"></i>
                                            </button>
                                            <button class="line-drawing-tools" data-value="angle">
                                                <i class="toolicon3"></i>
                                            </button>
                                            <button class="line-drawing-tools" data-value="move">
                                                <i class="toolicon4"></i>
                                            </button>

                                        </div>
                                        <a href="javascript:void(0)" class="line-drawing-tools" data-value="delete">Delete
                                            Selected Shape
                                        </a>
                                        <br>
                                        <a href="javascript:void(0)" class="line-drawing-tools" data-value="clear">Delete All
                                            Shapes
                                        </a>
                                    </div>
{{--                                    <div class="preview-uploaded-image"></div>--}}
                                    {{--<ul class="list-inline tool-container">
                                        <li class="tool">
                                            <img width="100" style="border: 1px solid slateblue;" src="{{ url('/') }}/assets/img/rect.png">
                                        </li>
                                        <li class="tool">
                                            <img width="80" style="border: 1px solid slateblue;" src="{{ url('/') }}/assets/img/triangle.png">
                                        </li>
                                        <li class="tool">
                                            <img width="80" style="border: 1px solid slateblue;" src="{{ url('/') }}/assets/img/circle.png">
                                        </li>
                                        <li>
                                            <img src="{{ url('/') }}/assets/img/user.png" id="myImageElem">
                                        </li>
                                    </ul>--}}
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
{{--                                    <div class="preview-uploaded-image"></div>--}}
                                    <div id="canvas-container">
                                        <canvas id="canvas-data-container">
                                            <p>Unfortunately, your browser is currently unsupported by our web
                                                application.  We are sorry for the inconvenience. Please use one of the
                                                supported browsers listed below, or draw the image you want using an
                                                offline tool.</p>
                                            <p>Supported browsers: <a href="http://www.opera.com">Opera</a>, <a
                                                    href="http://www.mozilla.com">Firefox</a>, <a
                                                    href="http://www.apple.com/safari">Safari</a>, and <a
                                                    href="http://www.konqueror.org">Konqueror</a>.</p>
                                        </canvas>
                                    </div>
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
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.6.2/fabric.min.js"></script>--}}
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>--}}
    <script src="{{ asset('assets/js/fabric-3.4.0.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/custom/canvas-drawing.js') }}"></script>
    <script>
        $("body").on("click","#upload_drawing",function(e){
            $(this).parents("form").ajaxForm({
                complete: function(response)
                {
                    // if ($.isEmptyObject(response.responseJSON.image)) {
                    if (response.responseJSON.url != undefined) {
                        // $('.preview-uploaded-image').html('<img width="620" src="'+response.responseJSON.url+'">');
                        let imagePath = '{{ url('/') }}/'+ response.responseJSON.url;
                        // initCanvasOnImageUpload(imagePath);
                        // addImage(20,20,0.50, imagePath);
                        initCanvasOnUpload(imagePath)
                    } else {
                        var msg = response.responseJSON;
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
