<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Summernote Testing</title>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
</head>
<body>
<div class="container">
    <nav></nav>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="well">
                <form method="post">
                    <div class="form-group">
                        <label for="summernote">Description</label>
                        <textarea id="summernote" name="description" class="summernote" class="form-control"></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
<script>
    $(document).ready(function () {
       $('#summernote').summernote({
           placeholder: "Hello welcome to summernote",
           tabsize: 2,
           height: 100,
           disableDragAndDrop: true,
           shortcuts: false,
           popatmouse: false,
           toolbar: [
               ['style', ['bold', 'italic']],
               ['fontsize', ['fontsize']],
               ['para', ['ul', 'ol', 'paragraph']],
               ['insert', ['picture']],
               ['view', ['fullscreen', 'help']]
           ],
           popover: {
               image: [
                   ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                   ['float', ['floatLeft', 'floatRight', 'floatNone']],
                   ['remove', ['removeMedia']]
               ],
               link: [
                   ['link', ['linkDialogShow', 'unlink']]
               ],
               air: [
                   ['color', ['color']],
                   ['font', ['bold', 'underline', 'clear']],
                   ['para', ['ul', 'paragraph']],
                   ['table', ['table']],
                   ['insert', ['link', 'picture']]
               ]
           },
           callbacks: {
               onImageUpload : function (files) {
                   // Upload image to server and create imgNode
                   $summernote.summernote('insertNode', imgNode);
                   // sendFile(files[0]);
                   console.log('An Image was uploaded');
               },
               onMediaDelete: function(target) {
                   // deleteFile(target[0].src);
                   console.log('An Image was deleted');
               }
               // onPaste: function () {
               //     console.log('summernote has been called...')
               // }

           }
       });
    });
</script>
</body>
</html>