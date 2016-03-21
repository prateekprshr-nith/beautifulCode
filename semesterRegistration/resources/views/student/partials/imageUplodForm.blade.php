@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<form class="form-horizontal" role="form" method="POST" action="/students/updateInfo/image"
      accept-charset="UTF-8" id="updateInfoForm" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <!-- Display Validation Errors -->
    @include('common.errors')

    <div class="form-group">
        <label class="col-md-2 control-label" for="image">Image</label>
        <div class="col-md-8">
            <input required class="file-loading" name="image" type="file"
                   id="image">
        </div>
        <div class="col-md-2">
            <a href="/students/updateInfo/image/skip" class="btn btn-default">
                <span class="glyphicon glyphicon-arrow-right"></span> Skip ...
            </a>
        </div>
    </div>

</form>
<script>
    $(document).on('ready', function() {
        $("#image").fileinput({
            initialPreview: [
            ],
            overwriteInitial: false,
            maxFileSize: 1024,
            initialCaption: ""
        });
    });
</script>