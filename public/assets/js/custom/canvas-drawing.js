var canvas = fabric.Canvas;
var activeObject = fabric.Object;
var color = '';
var opacity = Number;

$(function () {
    initCanvas();
    // addText();
    canvas.setActiveObject(canvas.item(0));
    window.addEventListener('resize', onWindowResize);
});

initCanvas = () => {
    canvas = new fabric.Canvas("canvas-data-container", {
        width: 823,
        height: 400,
        hoverCursor: 'pointer',
        selection: true,
        selectionBorderColor: 'green',
        backgroundColor: '#b9c5c4'
    });
    /*canvas = new fabric.Canvas('canvas-data-container');
    canvas.setDimensions({
        width: window.innerWidth * 0.7,
        height: window.innerHeight
    });
    canvas.setBackgroundColor('#565656', canvas.renderAll.bind(canvas));*/

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
    var rect = new fabric.Rect({
        left: canvas.width / 2,
        top: canvas.height / 2,
        // fill: '#ffa726',
        fill: 'rgba(0,0,0,0)',
        /*width: 120,
        height: 80,*/
        width: width,
        height: height,
        originX: 'center',
        originY: 'center',
        stroke: 'black',
        strokeWidth: 1,
    });
    // canvas.add(rect);
    /*var text = new fabric.Text('W',{top: canvas.height / 2, left: canvas.width / 2.17, fontSize: 16, originX: 'right'});
    var text2 = new fabric.Text('H',{top: canvas.height / 2.4, left: canvas.width / 1.85, fontSize: 16, originX: 'left', angle: -90});*/
    var text = new fabric.Text('W', {top: canvas.height / 2, left: canvas.width / 2.17, fontSize: 16, originX: 'right'});
    var text2 = new fabric.Text('H', {top: canvas.height / 2.2, left: canvas.width / 1.85, fontSize: 16, originX: 'left', angle: -90});
    var group = new fabric.Group([rect, text, text2], {
        width: width,
        height: height,
        /*left: 5,
        top: 5,*/
        strokeWidth:0
    });
    canvas.add(group);
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
        stroke: 'black',
        strokeWidth: 1,
    });
    // canvas.add(circle);
    var text = new fabric.Text('W', {top: canvas.height / 2.1, left: canvas.width / 2, fontSize: 16, originX: 'right'});

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
    canvas.add(new fabric.Triangle({
        left: canvas.width / 2,
        top: canvas.height / 2,
        // fill: '#78909c',
        fill: 'rgba(0,0,0,0)',
        width: 100,
        height: 100,
        originX: 'center',
        originY: 'center',
        stroke: 'black',
        strokeWidth: 1,
    }));
    $('.colorbox-container').css('display', 'block');
};

addLine = () => {
    canvas.add(new fabric.Line([0, 0, 100, 100], {
        left: canvas.width / 2,
        top: canvas.height / 2,
        fill: 'tomato',
        stroke: 'tomato',
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
            left: 50,
            top: 5
        });
        img.scaleToHeight(250);
        img.scaleToWidth(250);
        canvas.add(img);
        $('.colorbox-container').css('display', 'none');
    });
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
    obj._objects[1].text = width.toFixed(2) + 'cm';
    obj._objects[1].scaleX= 1 / obj.scaleX;
    obj._objects[1].scaleY= 1 / obj.scaleY;
    // obj._objects[2].text = height.toFixed(2) + 'px';
    obj._objects[2].text = height.toFixed(2) + 'cm';
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
    obj._objects[1].text = width.toFixed(2) + 'cm';
    obj._objects[1].scaleX= 1 / obj.scaleX;
    obj._objects[1].scaleY= 1 / obj.scaleY;
}
