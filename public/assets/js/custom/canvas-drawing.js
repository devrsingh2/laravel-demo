(function() {
    var canvas_container = document.getElementById('canvas-container');
    var canvas = new fabric.Canvas('canvas-data-container');
    var ctx = canvas.getContext('2d');
    canvas_container.addEventListener('drop', function (e) {
        console.log("DROP");
        e = e || window.event;
        if (e.preventDefault) {
            e.preventDefault();
        }
        var dt = e.dataTransfer;
        var files = dt.files;
        for (var i=0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            //attach event handlers here...
            reader.onload = function (e) {
                var img = new Image();
                img.src = e.target.result;
                var imgInstance = new fabric.Image(img, {
                    left: 100,
                    top: 100,
                });
                canvas.add(imgInstance);
            }
            reader.readAsDataURL(file);
        }

        return false;
    });
    canvas_container.addEventListener('dragover', cancel);
    canvas_container.addEventListener('dragenter', cancel);

    function cancel(e) {
        if (e.preventDefault) { e.preventDefault(); }
        return false;
    }

    // fabric.Object.prototype.transparentCorners = false;

    var rect = new fabric.Rect({
        left: 100,
        top: 50,
        width: 100,
        height: 100,
        fill: 'green',
        angle: 20,
        padding: 10
    });
    // canvas.add(rect);
})();
