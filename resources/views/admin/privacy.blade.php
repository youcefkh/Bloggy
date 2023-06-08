@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Privacy Policy </h4>
                        <p class="card-description">
                            nb: all fields with red are required
                        </p>
                        <form class="forms-sample" action="{{ route('policies.store') }}" method="post">
                             @csrf
                            @if(session()->has('create'))
                                <div class="alert alert-success alert-dismissible fade show " role="alert">
                                    <strong>success</strong> <span >  {{ session()->get('create') }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if(session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                                    <strong>error</strong> <span > {{ session()->get('error') }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if($privacy)
                                <input type="hidden" name="id" value="{{$privacy->id}}" id="id">
                            @endif
                                <div class="form-group">
                                    <label for="exampleTextarea1">Privacy Policies <span class="text-danger">*</span></label>
                                    <textarea class="form-control @if ($errors->has('value')) is-invalid @endif" name="value"  id="exampleTextarea1" rows="7" autofocus > {!! $privacy ? $privacy->value:null !!}</textarea>
                                    @if ($errors->has('value'))
                                        <div  class="invalid-feedback">
                                            <strong>{{ $errors->first('value') }}</strong>
                                        </div>
                                    @endif

                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea2">Arabic Privacy Policies <span class="text-danger">*</span></label>
                                     <textarea class="form-control @if ($errors->has('value_ar')) is-invalid @endif" name="value_ar"  id="exampleTextarea2" rows="7" autofocus > {!! $privacy ? $privacy->value_ar:null !!}</textarea>
                                    @if ($errors->has('value_ar'))
                                        <div  class="invalid-feedback">
                                            <strong>{{ $errors->first('value_ar') }}</strong>
                                        </div>
                                    @endif
                                  </div>
                              <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready( function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            tinymce.init({
                selector: 'textarea#exampleTextarea1', // Replace this CSS selector to match the placeholder element for TinyMCE
                height: 700,
                plugins:  [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime table paste imagetools wordcount'
                ],
                toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
                image_title: true,
                automatic_uploads: true,
                images_upload_url: 'image/upload',
                file_picker_types: 'image',
                file_picker_callback: function (cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('name', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function () {
                        var file = this.files[0];

                        var reader = new FileReader();
                        reader.onload = function () {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), { title: file.name });
                        };
                        reader.readAsDataURL(file);
                    };

                    input.click();
                },
            });
            tinymce.init({
                selector: 'textarea#exampleTextarea2', // Replace this CSS selector to match the placeholder element for TinyMCE
                height: 700,
                plugins:  [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime  table paste imagetools wordcount'
                ],
                toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
                image_title: true,
                automatic_uploads: true,
                images_upload_url: 'image/upload',
                file_picker_types: 'image',
                file_picker_callback: function (cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('name', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function () {
                        var file = this.files[0];

                        var reader = new FileReader();
                        reader.onload = function () {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), { title: file.name });
                        };
                        reader.readAsDataURL(file);
                    };

                    input.click();
                },
            });
        });
    </script>
@endsection