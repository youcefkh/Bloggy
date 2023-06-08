@extends('admin.layouts.app')
@section('content')
    <style>
        .ar {
            direction: rtl;
        }
    </style>
    <div class="container py-2 mt-4">

        <div class="alert alert-danger alert-dismissible fade " role="alert">
            <strong>error</strong> <span></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="pull-right mb-2">
            <a class="btn btn-success text-white" onClick="add()" href="javascript:void(0)"> Add Category</a>
        </div>


        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2>Categories table</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered " id="datatables-example" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Arabic Name</th>
                            <th>image</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="modal fade" id="category-modal" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="CategoryModal"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="CategoryForm" name="CategoryForm" class="form-horizontal"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="name"> Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Category Name" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name_ar">Arabic Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control ar" id="name_ar" name="name_ar"
                                        placeholder="أدخل اسم الفئة باللغة العربية" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Image upload</label>
                                <input type="file" name="image" accept="image/*" onchange="putImage()" id="image"
                                    class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary text-white"
                                            type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <img id="image_content" style="display: none;height: 100px;width: 150px;" src="" alt="">
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
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#datatables-example').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('categories') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'name_ar',
                            name: 'name_ar'
                        },
                        {
                            data: 'image',
                            name: 'image',
                            render: function(data, type, full, meta) {
                                return "<img src=\"/" + data + "\" height=\"50\"/>";
                            },
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });

            function add() {
                $('#CategoryForm').trigger("reset");
                $('#CategoryModal').html("Add Category");
                $('#category-modal').modal('show');
                $('#id').val('');
            }

            function putImage() {
                const [file] = document.getElementById('image').files
                if (file) {
                    $('#image_content').attr('src', URL.createObjectURL(file)).show()
                }

            }
            var token = $('meta[name="csrf-token"]').attr('content');

            function deleteFunc(id) {
                if (confirm("Delete Record?") == true) {
                    var id = id;
                    $.ajax({
                        type: "POST",
                        _token: token,
                        url: "{{ route('categories.delete') }}",
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(res) {
                            var oTable = $('#datatables-example').dataTable();
                            oTable.fnDraw(false);
                        },
                        error: function(xhr) {
                            console.log(xhr)
                        }
                    });
                }
            }

            function editFunc(id) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('categories.edit') }}",
                    _token: token,
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#CategoryModal').html("Edit Category");
                        $('#category-modal').modal('show');
                        $('#id').val(res.id);
                        $('#name').val(res.name);
                        $('#name_ar').val(res.name_ar);
                        var base_url = '{!! url('/') !!}';
                        $('#image').attr('required', false);
                        $('#image_content').attr('src', base_url + '/' + res.image).show();
                    }
                });
            }

            $('#CategoryForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('categories.store') }}",
                    data: formData,
                    _token: token,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        $("#category-modal").modal('hide');
                        var oTable = $('#datatables-example').dataTable();
                        oTable.fnDraw(false);
                        $("#btn-save").html('Submit');
                        $("#btn-save").attr("disabled", false);
                        $('#image_content').hide();
                        $('#image').attr('required', true);
                    },
                    error: function(xhr, status, error) {
                        $("#btn-save").attr("disabled", false);
                        $("#category-modal").modal('hide');

                        $('.alert-danger span').html(JSON.parse(xhr.responseText).message);
                        $('.alert-danger').addClass('show');
                        $('#image_content').hide();

                    }
                });
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </div>
@endsection
