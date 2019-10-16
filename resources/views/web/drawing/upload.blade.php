@extends('web.layouts.dashboard-layout')
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
                <div class="col-md-6">
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
                    {{--<div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Inline</h5>
                            <div class="position-relative form-group">
                                <div>
                                    <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline" class="custom-control-input"><label class="custom-control-label"
                                                                                                                                                                                          for="exampleCustomInline">An inline custom
                                            input</label></div>
                                    <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline2" class="custom-control-input"><label class="custom-control-label"
                                                                                                                                                                                           for="exampleCustomInline2">and another one</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Drawing Preview</h5>
                            <div class="position-relative form-group">
                                <div>
{{--                                    <div class="preview-uploaded-image"></div>--}}
                                    <canvas  width="500" height="900" id="canvas"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Form Select</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group"><label for="exampleCustomSelect" class="">Custom Select</label><select type="select" id="exampleCustomSelect" name="customSelect" class="custom-select">
                                            <option value="">Select</option>
                                            <option>Value 1</option>
                                            <option>Value 2</option>
                                            <option>Value 3</option>
                                            <option>Value 4</option>
                                            <option>Value 5</option>
                                        </select></div>
                                    <div class="position-relative form-group"><label for="exampleCustomMutlipleSelect" class="">Custom Multiple Select</label><select multiple="" type="select" id="exampleCustomMutlipleSelect"
                                                                                                                                                                      name="customSelect" class="custom-select">
                                            <option value="">Select</option>
                                            <option>Value 1</option>
                                            <option>Value 2</option>
                                            <option>Value 3</option>
                                            <option>Value 4</option>
                                            <option>Value 5</option>
                                        </select></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group"><label for="exampleCustomSelectDisabled" class="">Custom Select Disabled</label><select type="select" id="exampleCustomSelectDisabled" name="customSelect"
                                                                                                                                                                      disabled="" class="custom-select">
                                            <option value="">Select</option>
                                            <option>Value 1</option>
                                            <option>Value 2</option>
                                            <option>Value 3</option>
                                            <option>Value 4</option>
                                            <option>Value 5</option>
                                        </select></div>
                                    <div class="position-relative form-group"><label for="exampleCustomMutlipleSelectDisabled" class="">Custom Multiple Select Disabled</label><select multiple="" type="select"
                                                                                                                                                                                       id="exampleCustomMutlipleSelectDisabled"
                                                                                                                                                                                       name="customSelect" disabled="" class="custom-select">
                                            <option value="">Select</option>
                                            <option>Value 1</option>
                                            <option>Value 2</option>
                                            <option>Value 3</option>
                                            <option>Value 4</option>
                                            <option>Value 5</option>
                                        </select></div>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>
        </form>
    </div>
@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
    <script src="http://code.createjs.com/easeljs-0.5.0.min.js"></script>
    <script>
        var canvas;
        var stage;
        $("body").on("click","#upload_drawing",function(e){
            $(this).parents("form").ajaxForm({
                complete: function(response)
                {
                    if($.isEmptyObject(response.responseJSON.image)){
                        // $('.preview-uploaded-image').html('<img src="'+response.responseJSON.url+'">');
                        let imagePath = '{{ url('/') }}/'+ response.responseJSON.url;
                        displayPicture(imagePath);

                    }else{
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
        /**
         * Load and display the uploaded picture on CreateJS Stage
         */
        function displayPicture(imgPath)
        {
            var image = new Image();
            image.onload = function () {
                // Create a Bitmap from the loaded image
                var img = new createjs.Bitmap(event.target)
                // scale it
                img.scaleX = img.scaleY = 0.5;
                /// Add to display list
                stage.addChild(img);
                //Enable Drag'n'Drop
                enableDrag(img);
                // Render Stage
                stage.update();
            }
            // Load the image
            image.src = imgPath;
        }


        /**
         * Enable drag'n'drop on DisplayObjects
         */
        function enableDrag(item) {
            // OnPress event handler
            item.onPress = function(evt) {
                var offset = {	x:item.x-evt.stageX,
                    y:item.y-evt.stageY};
                // Bring to front
                stage.addChild(item);
                // Mouse Move event handler
                evt.onMouseMove = function(ev) {

                    item.x = ev.stageX+offset.x;
                    item.y = ev.stageY+offset.y;
                    stage.update();
                }
            }
        }
    </script>
@endsection
