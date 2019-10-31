@extends('web.layouts.dashboard-layout')
@section('header')
    <style>
        .tool-container li {
            display: inline-block;
        }
        #canvas-data-container {
            border: 2px dotted black;
            /*max-width: 640px;
            max-height: 480px;
            overflow: hidden;*/
        }
        .modal-dialog{
            top: 100px;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/customize/drawing.css') }}" />
@endsection
@section('content')
    <!-- Button trigger modal -->
    {{--<button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal">
        Basic Modal
    </button>--}}
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
                                    <div class="flex">
                                        {{--                                        <h2 style="text-align: center;">Toolbox</h2>--}}
                                        <div>
{{--                                            <button type="button" class="btn btn-outline-dark" onclick="addText()">Add Text</button>--}}
                                            <button type="button" class="btn btn-outline-dark" onclick="addRect()">Add Rectangle</button>
                                            <button type="button" class="btn btn-outline-dark" onclick="addCircle()">Add Circle</button>
                                            <button type="button" class="btn btn-outline-dark" onclick="addTriangle()">Add Triangle</button>
                                            <button type="button" class="btn btn-outline-dark" onclick="addLine()">Add Line</button>
                                            <button type="button" class="btn btn-outline-dark" onclick="addImage(this)">Add Image</button>
{{--                                            <button type="button" class="btn btn-danger" onclick="remove()">Remove</button>--}}
                                        </div>
                                        <div style="display: none;" class="property-box">
                                            <div class="colorbox-container" >
                                                {{--<md-color-menu color="main.color">
                                                    <div class="colorbox" ng-style="getStyle()">
                                                    </div>
                                                </md-color-menu>--}}
                                                {{--                                                <input type="text" id="colorpicker" name="color" class="picker" onblur="getStyle()" value="#e0e0e0"/>--}}
                                                <div class="form-group">
                                                    <br/>
{{--                                                    <input type="text" style="width: 200px;" class="form-control" id="colorpicker-input" name="color" class="picker" value="rgb(255, 128, 0)"/>--}}
                                                </div>
                                                {{--                                                <span>Fill: {{main.activeObject.fill}}</span>--}}
                                            </div>
                                            <div>
                                                {{--<md-slider-container>
                                                    <span>Opacity</span>
                                                    <md-slider
--}}{{--                                                        ng-model="main.opacity"--}}{{--
                                                        onchange="setOpacity()"
                                                        min="0"
                                                        max="100"
                                                        step="1"
                                                        class="md-primary">
                                                    </md-slider>
                                                    <md-input-container>
                                                        <input
--}}{{--                                                            ng-model="main.opacity"--}}{{--
                                                            onchange="setOpacity()" />
                                                    </md-input-container>
                                                </md-slider-container>--}}
                                            </div>
                                            {{--<div layout="row">
                                                <button type="button" class="btn btn-outline-dark btn-sm" onclick="fnBringForward()"
                                                        data-toggle="tooltip" data-placement="top" title="Bring forward"
                                                >↑
                                                </button>
                                                <button type="button" class="btn btn-outline-dark btn-sm" onclick="fnBringToFront()"
                                                        data-toggle="tooltip" data-placement="top" title="Bring to front"
                                                >⇑
                                                </button>
                                                <button type="button" class="btn btn-outline-dark btn-sm" onclick="fnSendBackwards()"
                                                        data-toggle="tooltip" data-placement="top" title="Send backwards"
                                                >↓
                                                </button>
                                                <button type="button" class="btn btn-outline-dark btn-sm" onclick="fnSendToBack()"
                                                        data-toggle="tooltip" data-placement="top" title="Send to back"
                                                >⇓
                                                </button>
                                            </div>--}}
                                        </div>
                                        <div ng-show="activeObject.type === 'i-text'" class="property-box">
                                            {{--<div>
          <span>Font size: {{ main.getFontSize() }}
          </span><br />
                                                <span>Font family: {{main.activeObject.fontFamily}}
          </span><br />
                                                <span>Text align: {{main.activeObject.textAlign}}
          </span><br />
                                            </div>--}}
                                        </div>
                                    </div>
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
                    <div class="main-card mb-3 card">
                        <a href="#" class="btn btn-outline-success" id="btnSaveCanvasImage">Save</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Modal -->
    <div class="imageBrowseModal modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">
                        <input type='file' id="imgInp" />
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>&nbsp;
                    <button type="button" class="btn btn-outline-success" onclick="readImageURL()">Upload</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap-colorpicker/bootstrap-colorpicker.js') }}"></script>
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.6.2/fabric.min.js"></script>--}}
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>--}}
    <script src="{{ asset('assets/js/fabric-3.4.0.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/custom/canvas-drawing.js') }}"></script>
    {{--    <script src="{{ asset('assets/js/custom/custom.js') }}"></script>--}}
    <script>
        $(function () {
            $('#colorpicker-input').colorpicker();
            // Example using an event, to change the color of the .jumbotron background:
            $('#colorpicker-input').on('changeColor', function(event) {
                // $('.jumbotron').css('background-color', event.color.toString());
                $(this).css({'background-color': event.color.toString(), color: '#fff'});
                getStyle(event.color.toString());
            });
        });
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
