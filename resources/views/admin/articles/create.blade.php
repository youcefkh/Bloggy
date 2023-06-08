@extends('admin.layouts.app')
@section('content')
    <style scoped>
        .thumbnail-wrapper .image-container {
            display: none;
            width: 100%;
            height: 300px;
            overflow: hidden;
            margin: auto;
            border-radius: 5px;
        }

        .thumbnail-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .ar {
            direction: rtl;
        }

    </style>

    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create Or Update Article</h4>
                        <p class="card-description">
                            nb: all fields with red are required
                        </p>
                        <form class="forms-sample" action="{{ route('articles.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @if (\Session::get('create'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ \Session::get('create') }}

                                </div>
                            @endif

                            @if (\Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ \Session::get('error') }}
                                </div>
                            @endif
                            @if ($article)
                                <input type="hidden" name="id" value="{{ $article->id }}" id="id">
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Category <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" onchange="changeFunc()" id="category">
                                            <option value="">Select category</option>
                                            @foreach ($categories as $category)
                                                <option
                                                    {{ $article && $article->subcategory->category->name == $category->name ? 'selected' : '' }}
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Subcategory <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select  @if ($errors->has('subcategory_id')) is-invalid @endif"
                                            id="subcategory_id" name="subcategory_id" required>
                                            @if ($article)
                                                <option value="{{ $article->subcategory->id }}" selected>
                                                    {{ $article->subcategory->name }}</option>
                                            @endif
                                        </select>
                                        @if ($errors->has('subcategory_id'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('subcategory_id') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Status <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select  @if ($errors->has('status')) is-invalid @endif"
                                            id="status" name="status" required>
                                            <option {{ $article && $article->status == 'published' ? 'selected' : '' }}
                                                value="published">Published</option>
                                            <option
                                                {{ $article && $article->status == 'notpublished' ? 'selected' : '' }}
                                                value="notpublished">Not Published</option>
                                            <option {{ $article && $article->status == 'pending' ? 'selected' : '' }}
                                                value="pending">Pending</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="title-fr">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('title')) is-invalid @endif"
                                    name="title" id="title-fr" value="{{ $article ? $article->title : null }}"
                                    placeholder="Title" required>
                                @if ($errors->has('title'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="title-ar">Arabic Title </label>
                                <input type="text" class="form-control ar" name="title_ar" id="title-ar" autofocus
                                placeholder="العنوان بالعربية" value="{{ $article ? $article->title_ar : null }}" required>
                            </div>

                            <div class="row">
                                <div class="form-group thumbnail-wrapper col-md-6">
                                    <label for="thumbnail-ar" class="form-label">Thubmnail (Ar) <span
                                            class="text-danger">*</span></label>
                                    <input
                                        class="form-control thumbnail-input @if ($errors->has('thumbnail_ar')) is-invalid @endif"
                                        type="file" name="thumbnail_ar" id="thumbnail-ar" accept="image/*"
                                        {{ !$article ? 'required' : null }}>

                                    @if ($errors->has('thumbnail_ar'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('thumbnail_ar') }}</strong>
                                        </div>
                                    @endif
                                    <div class="{{ $article ? 'd-block' : null }} image-container mt-2">
                                        <img id="thumbnail-ar-content"
                                            src="{{ $article ? asset($article->thumbnail_ar) : null }}" alt="">
                                    </div>
                                </div>

                                <div class="form-group thumbnail-wrapper col-md-6">
                                    <label for="thumbnail-fr" class="form-label">Thubmnail (Fr) <span
                                            class="text-muted">(optional)</span></label>
                                    <input
                                        class="form-control thumbnail-input @if ($errors->has('thumbnail_fr')) is-invalid @endif"
                                        type="file" name="thumbnail_fr" id="thumbnail-fr" accept="image/*">

                                    @if ($errors->has('thumbnail_fr'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('thumbnail_fr') }}</strong>
                                        </div>
                                    @endif
                                    <div
                                        class="{{ $article && $article->thumbnail_fr ? 'd-block' : null }} image-container mt-2">
                                        <img id="thumbnail-fr-content"
                                            src="{{ $article ? asset($article->thumbnail_fr) : null }}" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="article-fr">Article <span class="text-danger">*</span></label>
                                <textarea class="form-control @if ($errors->has('article')) is-invalid @endif"
                                    name="article" id="article-fr" rows="7" autofocus> {!! $article ? $article->article : null !!}</textarea>
                                @if ($errors->has('article'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('article') }}</strong>
                                    </div>
                                @endif

                            </div>

                            <div class="form-group">
                                <label for="article-ar">Arabic Article</label>
                                <textarea class="form-control ar" name="article_ar" autofocus id="article-ar"
                                    rows="7">{!! $article ? $article->article_ar : null !!}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            tinymce.init({
                selector: 'textarea#article-fr', // Replace this CSS selector to match the placeholder element for TinyMCE
                height: 500,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime table paste imagetools wordcount'
                ],
                toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
                image_title: true,
                automatic_uploads: true,
                images_upload_url: 'image/upload',
                file_picker_types: 'image',
                file_picker_callback: function(cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('name', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function() {
                        var file = this.files[0];

                        var reader = new FileReader();
                        reader.onload = function() {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), {
                                title: file.name
                            });
                        };
                        reader.readAsDataURL(file);
                    };

                    input.click();
                },
            });
            tinymce.init({
                selector: 'textarea#article-ar', // Replace this CSS selector to match the placeholder element for TinyMCE
                height: 500,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime  table paste imagetools wordcount',

                    "directionality",
                ],
                directionality: "rtl",
                toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | ltr rtl',
                image_title: true,
                automatic_uploads: true,
                images_upload_url: 'image/upload',
                file_picker_types: 'image',
                file_picker_callback: function(cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('name', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function() {
                        var file = this.files[0];

                        var reader = new FileReader();
                        reader.onload = function() {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), {
                                title: file.name
                            });
                        };
                        reader.readAsDataURL(file);
                    };

                    input.click();
                },
            });
        });
        var token =$('meta[name="csrf-token"]').attr('content');
        function changeFunc() {
            var id = $('#category').val();
<<<<<<< HEAD
            $('#subcategory_id').find('option').remove();
=======

            $('#subcategory_id').find('option').remove()
>>>>>>> 562271cb9fe1c17b843e58760a6ed3cf120b1818
            console.log(id);
            $.ajax({
                type: "POST",
                _token: token,
                url: "{{ route('subcategories.byCategory') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#subcategory_id').append($('<option>', {
                            value: '',
                            text: 'Select subcategory'
                        }));
                    $.each(res.subcategories, function(i, item) {
                        $('#subcategory_id').append($('<option>', {
                            value: item.id,
                            text: item.name,
                        }));
                    });



                }
            });
        }

        //show thumbnail
        $('.thumbnail-input').on('change', function() {
            const imageContainer = $(this).siblings('.image-container');
            const image = imageContainer.find('img');
            console.log(image)
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imageContainer.show();
                    image.attr('src', this.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        })
    </script>
@endsection
