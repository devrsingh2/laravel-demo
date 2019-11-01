var canvas = fabric.Canvas;
// var canvas = this.__canvas = fabric.Canvas;
var activeObject = fabric.Object;
var color = '';
var opacity = Number;
const canvasContainerWidth = 920;
const canvasContainerHeight = 600;

fabric.Image.prototype._render = function(ctx) {
    var fwidth = this._element.width / (this.zoomLevel + 1);
    var fheight = this._element.height / (this.zoomLevel + 1);
    var wdiff = (fwidth - this._element.width) / 2;
    var hdiff = (fheight - this._element.height) / 2;
    ctx.drawImage(this._element, -wdiff, -hdiff, fwidth, fheight, -this.width/2, - this.height/2, this.width, this.height);
};

$(function () {
    initCanvas();
    // addText();
    // addRect();
    canvas.setActiveObject(canvas.item(0));
    window.addEventListener('resize', onWindowResize);
});

initCanvas = () => {
    canvas = new fabric.Canvas("canvas-data-container", {
        width: canvasContainerWidth,
        height: canvasContainerHeight,
        hoverCursor: 'pointer',
        selection: true,
        selectionBorderColor: 'green',
        backgroundColor: 'rgba(200,200,200,1)'
    });

    // extra canvas settings
    canvas.preserveObjectStacking = true;
    canvas.stopContextMenu = true;

    canvas.on('object:selected', () => {
        eval(() => {
            activeObject = canvas.getActiveObject();
            // color = this.mdPickerColors.getColor(this.activeObject.get('fill'));
            color = $('#colorpicker').val();
            opacity = activeObject.get('opacity') * 100;
        });
        $('.property-box').css('display', 'block');
    });

    canvas.on('selection:cleared', () => {
        eval(() => {
            activeObject = null;
            color = null;
            opacity = 0;
        });
        $('.property-box').css('display', 'none');
    });

    canvas.on('selection:updated', () => {
        eval(() => {
            activeObject = canvas.getActiveObject();
            // color = this.mdPickerColors.getColor(this.activeObject.get('fill'));
            color = $('#colorpicker').val();
            opacity = +(activeObject.get('opacity') * 100).toFixed();
        });
    });

    canvas.on('mouse:wheel', function(option) {
        var imgObj = canvas.getActiveObject();
        if (!imgObj) return;
        option.e.preventDefault();
        if (option.e.deltaY > 0) {
            zoomOut();
        } else {
            zoomIn();
        }
        canvas.renderAll();
    });

}
var SCALE_FACTOR = 1.1; //on clicking zoom, enlarge canvas in 30%. TBD
var zoomMax = 5;   //TBD

// Zoom In
function zoomIn() {
    if(canvas.getZoom().toFixed(5) > zoomMax){
        console.log("zoomIn: Error: cannot zoom-in anymore");
        return;
    }
    canvas.setZoom(canvas.getZoom() * 1.1 );
    /*canvas.setZoom(canvas.getZoom()*SCALE_FACTOR);
    canvas.setHeight(canvas.getHeight() * SCALE_FACTOR);
    canvas.setWidth(canvas.getWidth() * SCALE_FACTOR);
    canvas.renderAll();*/
}
// Zoom Out
function zoomOut() {
    if( canvas.getZoom().toFixed(5) <=1 ){
        console.log("zoomOut: Error: cannot zoom-out anymore");
        return;
    }
    canvas.setZoom(canvas.getZoom() / 1.1 );
    /*canvas.setZoom(canvas.getZoom()/SCALE_FACTOR);
    canvas.setHeight(canvas.getHeight() / SCALE_FACTOR);
    canvas.setWidth(canvas.getWidth() / SCALE_FACTOR);
    canvas.renderAll();*/
}

onWindowResize = () => {
    canvas.setDimensions({
        width: window.innerWidth * 0.7,
        height: window.innerHeight
    });
}

addText = () => {
    let text = new fabric.IText('Your Text', {
        left: canvas.width / 2,
        top: canvas.height / 2,
        fill: '#e0f7fa',
        fontFamily: 'sans-serif',
        hasRotatingPoint: false,
        centerTransform: true,
        originX: 'center',
        originY: 'center',
        lockUniScaling: true
    });
    canvas.add(text);
    text.on('scaling', () => {
        eval();
    });
    $('.colorbox-container').css('display', 'block');
}

addRect = () => {
    let width = 120;
    let height = 80;
    /*var rect = new fabric.Rect({
        // fill: '#ffa726',
        fill: 'rgba(0,0,0,0)',
        /!*width: 120,
        height: 80,*!/
        width: width,
        height: height,
        stroke: 'red',
        strokeWidth: 2,
    });*/
    // canvas.add(rect);
    /*var text = new fabric.Text('W',{top: canvas.height / 2, left: canvas.width / 2.17, fontSize: 16, originX: 'right'});
    var text2 = new fabric.Text('H',{top: canvas.height / 2.4, left: canvas.width / 1.85, fontSize: 16, originX: 'left', angle: -90});*/
    /*var text = new fabric.Text('W', {
        top: canvas.height / 2,
        left: canvas.width / 2.17,
        fill: '#ffffff',
        fontSize: 16,
        originX: 'right'
    });*/
    var rect = new fabric.Rect({
        width: 200,
        height: 100,
        top: canvas.height / 2,
        left: canvas.width / 2,
        fill: 'rgba(0,0,0,0)',
        stroke: 'red',
        strokeWidth: 2,
    });

    // create a rectangle object
    var textWidth = new fabric.IText("W", {
        backgroundColor: '#FFFFFF',
        fill: '#000000',
        fontSize: 10,
        left: rect.left + 60,
        top: rect.top + rect.height - 40,
        /*top: 85,
        left: 60,*/
        originX: 'right'
    });
    // textWidth.scaleToWidth(rect.width);
    // canvas.add(textWidth);

    var textHeight = new fabric.IText("H", {
        backgroundColor: '#FFFFFF',
        fill: '#000000',
        fontSize: 10,
        left: rect.left + rect.width - 40,
        top: rect.top + 60,
        /*top: 40,
        left: 170,*/
        originX: 'left',
        angle: -90
    });
    // textHeight.scaleToWidth(rect.height);
    // canvas.add(textHeight);

    var group = new fabric.Group([ rect, textWidth, textHeight ], {
        /*left: 100,
        top: 100,*/
        originX: 'center',
        originY: 'center',
        lockScalingX: false,
        lockScalingY: false,
        hasRotatingPoint: false,
        transparentCorners: false,
        cornerSize: 7


    });

    canvas.add(group);
    canvas.renderAll();
    canvas.on("object:scaling", updateMeasures);
    $('.colorbox-container').css('display', 'block');
};

addCircle = () => {
    var circle = new fabric.Circle({
        left: canvas.width / 2,
        top: canvas.height / 2,
        // fill: '#26a69a',
        fill: 'rgba(0,0,0,0)',
        radius: 50,
        originX: 'center',
        originY: 'center',
        stroke: 'red',
        strokeWidth: 2,
    });
    // canvas.add(circle);
    var text = new fabric.Text('W', {
        /*top: circle.top - 20,
        left: circle.left - 20,*/
        left: canvas.width / 2,
        top: canvas.height / 2,
        originX: 'center',
        originY: 'center',
        backgroundColor: '#FFFFFF',
        fill: '#000000',
        // fill: '#ffffff',
        fontSize: 12,
    });

    var group = new fabric.Group([ circle, text ], {
        /*left: canvas.width / 2,
        top: canvas.height / 2,*/
        originX: 'center',
        originY: 'center',
    });
    canvas.add(group);
    canvas.on("object:scaling", updateCircleMeasures);

    $('.colorbox-container').css('display', 'block');
    /*circle.on('scaling',function(){
        console.log(parseInt(this.getScaledWidth()))
    });*/
};

addTriangle = () => {
    /*canvas.add(new fabric.Triangle({
        left: canvas.width / 2,
        top: canvas.height / 2,
        // fill: '#78909c',
        fill: 'rgba(0,0,0,0)',
        width: 100,
        height: 100,
        originX: 'center',
        originY: 'center',
        stroke: 'red',
        strokeWidth: 2,
    }));*/
    var triangle = new fabric.Triangle({
        left: canvas.width / 2,
        top: canvas.height / 2,
        // fill: '#78909c',
        fill: 'rgba(0,0,0,0)',
        width: 100,
        height: 100,
        originX: 'center',
        originY: 'center',
        stroke: 'red',
        strokeWidth: 2,
    });

    // create a triangle object
    var textWidth = new fabric.IText("W", {
        backgroundColor: '#FFFFFF',
        fill: '#000000',
        fontSize: 10,
        left: triangle.left + 60,
        top: triangle.top + triangle.height - 40,
        originX: 'center',
        originY: 'center',
        /*top: 85,
        left: 60,*/
        originX: 'right'
    });
    // textWidth.scaleToWidth(rect.width);
    // canvas.add(textWidth);

    var textHeight = new fabric.IText("H", {
        backgroundColor: '#FFFFFF',
        fill: '#000000',
        fontSize: 10,
        left: triangle.left + triangle.width - 40,
        top: triangle.top + 60,
        originX: 'center',
        originY: 'center',
        /*top: 40,
        left: 170,*/
        originX: 'left',
        angle: -90
    });
    // textHeight.scaleToWidth(rect.height);
    // canvas.add(textHeight);

    var group = new fabric.Group([ triangle, textWidth, textHeight ], {
        /*left: 100,
        top: 100,*/
        originX: 'center',
        originY: 'center',
        lockScalingX: false,
        lockScalingY: false,
        hasRotatingPoint: false,
        transparentCorners: false,
        cornerSize: 7


    });

    canvas.add(group);
    canvas.renderAll();
    canvas.on("object:scaling", updateMeasures);

    $('.colorbox-container').css('display', 'block');
};

addLine = () => {
    canvas.add(new fabric.Line([0, 0, 100, 100], {
        left: canvas.width / 2,
        top: canvas.height / 2,
        fill: 'red',
        stroke: 'red',
        selectable: true,
        originX: 'center',
        originY: 'center',
        strokeWidth: 2,
        perPixelTargetFind: true
    }));
    $('.colorbox-container').css('display', 'block');
};

addImage = (ev) => {
    /*let confirm = dlg.prompt()
        .title('Add Image')
        .textContent('Copy and paste link of the image:')
        .placeholder('http://myimageurl.com')
        .ariaLabel('Image Url')
        .targetEvent(ev)
        .ok('Ok')
        .cancel('Cancel');*/

    /*dlg.show(confirm).then((result) => {
            fabric.Image.fromURL(result, (img) => {
                canvas.add(img);
            });
        });*/

    $('#imageModal').modal({
        show: true,
        backdrop: 'static',
        keyboard: false
    });
    $('#imageModal').on('shown.bs.modal', function (e) {
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });
    $('.colorbox-container').css('display', 'none');
};

initCanvasOnUpload = (imagePath) => {
    fabric.Image.fromURL(imagePath, (img) => {
        img.set({
            /*left: 50,
            top: 5,*/
            angle: 0,
            width: canvas.width * 10,
            height: canvas.height * 10,
            hasControls: false,
            // selection: false,
            selection: true,
            lockRotation:false,
            hasRotatingPoint: false,
            isDrawingMode: false,
            lockMovementX: true,
            lockMovementY: true,
        });

        var zoomLevel = 0;
        var zoomLevelMin = 0;
        var zoomLevelMax = 3;
        img.zoomLevel = 0
        img.scale(0.1);
        canvas.add(img);

        /*canvas.setBackgroundImage(img);
        canvas.renderAll();
        img.zoomIn = function() {
            if (zoomLevel < zoomLevelMax) {
                zoomLevel += 0.1;
                img.zoomLevel = zoomLevel;
            }
        };
        img.zoomOut = function() {
            zoomLevel -= 0.1;
            if (zoomLevel < 0) zoomLevel = 0;
            if (zoomLevel >= zoomLevelMin) {
                img.zoomLevel = zoomLevel;
            }
        };*/
        $('.colorbox-container').css('display', 'none');
    });

    /*canvas.on('mouse:wheel', function(option) {
        var imgObj = canvas.getActiveObject();
        if (!imgObj) return;
        option.e.preventDefault();
        if (option.e.deltaY > 0) {
            imgObj.zoomOut();
        } else {
            imgObj.zoomIn();
        }
        canvas.renderAll();
    });*/
};

function readImageURL() {
    /*var fd = new FormData();
    var files = $('#file')[0].files[0];
    fd.append('file',files);*/
    // var input = $('#imgInp')[0].files[0];
    var input = $('#imgInp')[0];
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            // $('#blah').attr('src', e.target.result);
            // console.log('e.target.result ', e.target.result);
            fabric.Image.fromURL(e.target.result, (img) => {
                img.set({
                    left: 50,
                    top: 5
                });
                img.scaleToHeight(250);
                img.scaleToWidth(250);
                canvas.add(img);
                window.setTimeout(hideImageModal, 100);
            });
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function hideImageModal(){
    $('#imageModal').modal('hide');
}

remove = () => {
    let activeObjects = canvas.getActiveObjects();
    canvas.discardActiveObject();
    if (activeObjects.length) {
        canvas.remove.apply(canvas, activeObjects);
    }
}

getStyle = (colorRGB) => {
    if (activeObject != null) {
        if (color != null) {
            /*if (color.hex !== activeObject.fill.toLowerCase()) {
                activeObject.set('fill', color.hex);
                canvas.requestRenderAll();
            }
            return color.style;*/
            if (colorRGB !== '') {
                canvas.getActiveObject().set("fill", colorRGB);
                canvas.requestRenderAll();
            }
            return color.style;
        }
        else {
            return {
                'background-color': activeObject.fill,
                'color': activeObject.fill
            };
        }
    }
}

getFontSize = () => {
    if (!activeObject) {
        return 0;
    }

    let size = activeObject.fontSize || 0;
    return +(size * activeObject.scaleX).toFixed();
}

setOpacity = () => {
    if (opacity < 0) {
        opacity = 0;
    }

    if (opacity > 100) {
        opacity = 100;
    }

    activeObject.set('opacity', opacity / 100);
    canvas.requestRenderAll();
}

fnBringForward = () => {
    var activeObject = canvas.getActiveObject();

    if (activeObject) {
        canvas.bringForward(activeObject);
        canvas.renderAll();
    }
};

fnBringToFront = () => {
    var activeObject = canvas.getActiveObject();
    if (activeObject) {
        canvas.bringToFront(activeObject);
        canvas.renderAll();
    }
};

fnSendBackwards = () => {
    var activeObject = canvas.getActiveObject();
    if (activeObject) {
        canvas.sendBackwards(activeObject);
        canvas.renderAll();
    }
};

fnSendToBack = () => {
    var activeObject = canvas.getActiveObject();

    if (activeObject) {
        canvas.sendToBack(activeObject);
        canvas.renderAll();
    }
};

function updateMeasures(evt) {
    var obj = evt.target;
    if (obj.type != 'group') {
        return;
    }
    /*var width = obj.getScaledWidth();
    var height = obj.getScaledHeight();*/
    var width = obj.getScaledWidth() * 2.54 / 96;
    var height = obj.getScaledHeight() * 2.54 / 96;
    // obj._objects[1].text = width.toFixed(2) + 'px';
    obj._objects[1].text = width.toFixed(2);
    obj._objects[1].scaleX= 1 / obj.scaleX;
    obj._objects[1].scaleY= 1 / obj.scaleY;
    // obj._objects[2].text = height.toFixed(2) + 'px';
    obj._objects[2].text = height.toFixed(2);
    obj._objects[2].scaleX= 1 / obj.scaleY;
    obj._objects[2].scaleY= 1 / obj.scaleX;
}

updateCircleMeasures = (evt) => {
    var obj = evt.target;
    if (obj.type != 'group') {
        return;
    }
    /*var width = obj.getScaledWidth();
    var height = obj.getScaledHeight();*/
    var width = obj.getScaledWidth() * 2.54 / 96;
    // obj._objects[1].text = width.toFixed(2) + 'px';
    obj._objects[1].text = width.toFixed(2);
    obj._objects[1].scaleX= 1 / obj.scaleX;
    obj._objects[1].scaleY= 1 / obj.scaleY;
}

var imageSaver = document.getElementById('btnSaveCanvasImage');
imageSaver.addEventListener('click', saveCanvasImage, false);
function saveCanvasImage(e) {
    this.href = canvas.toDataURL({
        format: 'png',
        quality: 0.8
    });
    this.download = 'canvas.png'
}
