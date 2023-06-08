@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Logo </h4>
                        <p class="card-description">
                            nb: all fields with red are required
                        </p>
                        <form class="forms-sample" action="{{ route('settings.store') }}" method="post" enctype="multipart/form-data">
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
                            @if($logo)
                                <input type="hidden" name="id" value="{{$logo->id}}" id="id">

                            @endif
                            <input type="hidden" name="key" value="logo" id="key">
                            <input type="hidden" name="name" value="logo" id="name">
                            <div class="form-group">
                                <label for="exampleTextarea1">Logo <span class="text-danger">*</span></label>
                                <input type="file" name="value" accept="image/*" onchange="putImage()" id="image" class="file-upload-default" required  >
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info  @if ($errors->has('value')) is-invalid @endif" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                           <button class="file-upload-browse btn btn-primary text-white" type="button">Upload</button>
                                       </span>
                                </div>
                                @if ($errors->has('value'))
                                    <div  class="invalid-feedback">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="d-flex justify-content-center">
                                @if($logo)
                                <img id="image_content"  src="{{asset($logo->value)}}" alt="">
                                @else
                                    <img id="image_content" style="display: none;" src="" alt="">
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Social Media </h4>
                        <p class="card-description">
                            nb: all fields with red are required
                        </p>
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
                        <div class="pull-right mb-2">
                            <a class="btn btn-success text-white" onClick="add()" href="javascript:void(0)"> Add Social Media Link</a>
                        </div>
                        @foreach($socials as $social)
                            <div class="d-flex justify-content-around align-items-center my-3 py-2 rounded-2 shadow-lg" href="#" data-abc="true">
                                @if(strtolower($social->key)  == "facebook")
                                    <img class="w-30px" src="https://img.icons8.com/color/60/000000/facebook-new.png" alt="...">
                                @endif
                                @if(strtolower($social->key)  == "email")
                                    <img class="w-30px" src="https://img.icons8.com/color/60/000000/google-logo.png" alt="...">
                                @endif
                                @if(strtolower($social->key)  == "youtube")
                                    <img class="w-30px" src="https://img.icons8.com/color/60/000000/youtube-squared.png" alt="...">
                                @endif
                                @if(strtolower($social->key)  == "linkedin")
                                    <img class="w-30px" src="https://img.icons8.com/color/60/000000/linkedin.png" alt="...">
                                @endif
                                <h5 id="key-val-convert">{{$social->key}}</h5>
                                <h5 id="key-val-convert">{{$social->value}}</h5>
                                <a href="javascript:void(0);" data-toggle="tooltip" onClick="editFunc({{$social->id}})" data-original-title="Edit" class="edit text-white btn btn-primary edit">Edit</a>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 grid-margin-stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Blog Title </h4>
                        <p class="card-description">
                            nb: all fields with red are required
                        </p>
                        <form class="forms-sample" action="{{ route('settings.store') }}" method="post" enctype="multipart/form-data">
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
                            @if($name)
                                <input type="hidden" name="id" value="{{$name->id}}" id="id">

                            @endif
                            <input type="hidden" name="key" value="title" >
                            <input type="hidden" name="name" value="Blog Title" >
                            <div class="form-group">
                                <label for="exampleTextarea1">Blog Name <span class="text-danger">*</span></label>

                                <input type="text" class="form-control @if ($errors->has('value')) is-invalid @endif"  name="value" value="{{$name?$name->value:''}}" placeholder="Enter Blog Title" maxlength="50" required>
                                @if ($errors->has('value'))
                                    <div  class="invalid-feedback">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Blog Name Arabic <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('value_ar')) is-invalid @endif"  name="value_ar" value="{{$name? $name->value_ar:''}}" placeholder="Enter Blog Title Arabic" maxlength="50" required>
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
            <div class="col-md-6 col-12 grid-margin-stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Blog Subtitle </h4>
                        <p class="card-description">
                            nb: all fields with red are required
                        </p>
                        <form class="forms-sample" action="{{ route('settings.store') }}" method="post" enctype="multipart/form-data">
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
                            @if($subname)
                                <input type="hidden"  value="{{$subname->id}}" id="id">

                            @endif
                            <input type="hidden" name="key" value="subtitle" >
                            <input type="hidden" name="name" value="Blog Title" >
                            <div class="form-group">
                                <label for="exampleTextarea1">Blog SubTitle <span class="text-danger">*</span></label>

                                <input type="text" class="form-control @if ($errors->has('value')) is-invalid @endif"  name="value" value="{{$subname?$subname->value:''}}" placeholder="Enter Blog Subtitle" maxlength="50" required>
                                @if ($errors->has('value'))
                                    <div  class="invalid-feedback">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Blog Subtitle Arabic <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('value_ar')) is-invalid @endif"  name="value_ar" value="{{$subname? $subname->value_ar:''}}" placeholder="Enter Blog Subtitle Arabic" maxlength="50" required>
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
    <div class="modal fade" id="category-modal" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="CategoryModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('settings.store')}}" id="CategoryForm" name="CategoryForm" class="form-horizontal" method="POST" enctype="multipart/form-data">@csrf
                        @csrf

                        <input type="hidden" name="id" id="social_id">
                        <input type="hidden" name="name" value="Social Media" >

                                <div class="form-group">
                                    <label for="exampleSelectGender">Name <span class="text-danger">*</span></label>
                                    <select class="form-select  @if ($errors->has('key')) is-invalid @endif" id="key_social" name="key" required>
                                        <option value="facebook">Facebook</option>
                                        <option value="email">Email</option>
                                        <option value="youtube">Youtube</option>
                                        <option value="linkedin">LinkedIn</option>
                                    </select>
                                    @if ($errors->has('key'))
                                        <div  class="invalid-feedback">
                                            <strong>{{ $errors->first('key') }}</strong>
                                        </div>
                                    @endif
                                </div>
                        <div class="form-group">
                            <label for="name_ar" >Link</label>

                                <input type="url" class="form-control @if ($errors->has('value')) is-invalid @endif" id="value_social" name="value" placeholder="Enter Link Value" maxlength="50" required>
                            @if ($errors->has('value'))
                                <div  class="invalid-feedback">
                                    <strong>{{ $errors->first('value') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary text-white" id="btn-save">Save changes
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
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
        });

        function putImage(){
            const [file] = document.getElementById('image').files
            if (file) {
                $('#image_content').attr('src',URL.createObjectURL(file)).show()
            }
        }
        function add(){
            $('#CategoryForm').trigger("reset");
            $('#CategoryModal').html("Add Social Media Link");
            $('#category-modal').modal('show');
            $('#id').val('');
        }

        function editFunc(id){
            var token =$('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type:"POST",
                url: "{{ route('settings.edit') }}",
                _token:token,
                data: { id: id },
                dataType: 'json',
                success: function(res){
                    $('#CategoryModal').html("Edit Social Media Link");
                    $('#category-modal').modal('show');
                    $('#social_id').val(res.id);
                    $('#key_social').val(res.key);
                    $('#value_social').val(res.value);
                }
            });
        }
    </script>
@endsection