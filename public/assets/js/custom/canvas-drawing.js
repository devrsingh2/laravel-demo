$(function () {
    initCanvasOnUpload(null);
});

function initCanvasOnUpload(imageData) {
// canvas related stuff
    var canvas = document.getElementById("canvas-data-container");
    var ctx = canvas.getContext("2d");
    var WIDTH = canvas.width;
    var HEIGHT = canvas.height;
    ctx.fillStyle = "#A0DCE5";
    $myCanvas = $('#canvas-data-container');

//drag
    var isDragging = false;
    var startX;
    var startY;

//array of image objects
    var images = [];
    var NUM_IMAGES = 0;

// queue up 4 test images
addImage(20,20,0.50,imageData !== null ? imageData : 'https://res.cloudinary.com/demo/image/upload/w_250,h_250,c_pad,b_black/sample.jpg');
    /*addImage(20,20,0.50,'https://dl.dropboxusercontent.com/u/139992952/stackoverflow/house204-1.jpg');
    addImage(240,20,0.50,'https://dl.dropboxusercontent.com/u/139992952/stackoverflow/house204-2.jpg');
    addImage(20,220,0.50,'https://dl.dropboxusercontent.com/u/139992952/stackoverflow/house204-3.jpg');
    addImage(240,220,0.50,'https://dl.dropboxusercontent.com/u/139992952/stackoverflow/house204-4.jpg');*/

// trigger all images to load
    for (var i = 0; i < images.length; i++) {
        images[i].image.src = images[i].url;
    }


//////////////////////////////
// functions
//////////////////////////////

// queue up another image
    function addImage(x, y, scaleFactor, imgURL) {
        var img = new Image();
        img.crossOrigin = 'anonymous';
        img.onload = startInteraction;
        images.push({image: img, x: x, y: y, scale: scaleFactor, isDragging: false, url: imgURL});
        NUM_IMAGES++;
    }

// called after each image fully loads
    function startInteraction() {

        // return until all images are loaded
        if (--NUM_IMAGES > 0) {
            return;
        }

        // set all images width/height
        for (var i = 0; i < images.length; i++) {
            var img = images[i];
            img.width = img.image.width * img.scale;
            img.height = img.image.height * img.scale;
        }

        // render all images
        renderAll();

        // listen for mouse events
        $myCanvas.mousedown(onMouseDown);
        $myCanvas.mouseup(onMouseUp);
        $myCanvas.mouseout(onMouseUp);
        $myCanvas.mousemove(onMouseMove);

    }

// flood fill canvas and
// redraw all images in their assigned positions
    function renderAll() {
        ctx.fillRect(0, 0, WIDTH, HEIGHT);
        for (var i = 0; i < images.length; i++) {
            var r = images[i];
            ctx.drawImage(r.image, r.x, r.y, r.width, r.height);
        }
    }

// handle mousedown events
    function onMouseDown(e) {

        // tell browser we're handling this mouse event
        e.preventDefault();
        e.stopPropagation();

        //get current position
        var mx = parseInt(e.clientX - $myCanvas.offset().left);
        var my = parseInt(e.clientY - $myCanvas.offset().top);

        //test to see if mouse is in 1+ images
        isDragging = false;
        for (var i = 0; i < images.length; i++) {
            var r = images[i];
            if (mx > r.x && mx < r.x + r.width && my > r.y && my < r.y + r.height) {
                //if true set r.isDragging=true
                r.isDragging = true;
                isDragging = true;
            }
        }
        //save mouse position
        startX = mx;
        startY = my;
    }

// handle mouseup and mouseout events
    function onMouseUp(e) {
        //tell browser we're handling this mouse event
        e.preventDefault();
        e.stopPropagation();

        // clear all the dragging flags
        isDragging = false;
        for (var i = 0; i < images.length; i++) {
            images[i].isDragging = false;
        }
    }

// handle mousemove events
    function onMouseMove(e) {

        // do nothing if we're not dragging
        if (!isDragging) {
            return;
        }

        //tell browser we're handling this mouse event
        e.preventDefault
        e.stopPropagation

        //get current mouseposition
        var mx = parseInt(e.clientX - $myCanvas.offset().left);
        var my = parseInt(e.clientY - $myCanvas.offset().top);

        //calculate how far the mouse has moved;
        var dx = mx - startX;
        var dy = my - startY;

        //move each image by how far the mouse moved
        for (var i = 0; i < images.length; i++) {
            var r = images[i];
            if (r.isDragging) {
                r.x += dx;
                r.y += dy;
            }
        }

        //reset the mouse positions for next mouse move;
        startX = mx;
        startY = my;

        //re render the images
        renderAll();

    }

}
