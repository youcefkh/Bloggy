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
            <a class="btn btn-success text-white" onClick="add()" href="javascript:void(0)"> Add SubCategory</a>
        </div>


        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2>SubCategories table</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered " id="datatables-example" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Arabic Name</th>
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
                                <label for="exampleFormControlSelect1">Category</label>
                                <select class="form-control " id="category_id" name="category_id" required>
                                </select>
                            </div>
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
                                        placeholder="أدخل اسم القسم الفرعي باللغة العربية" maxlength="50" required>
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
                    ajax: "{{ route('subcategories') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'category',
                            name: 'category'
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
                $.ajax({
                    type: "GET",
                    url: "{{ route('subcategories.create') }}",
                    success: function(res) {
                        $.each(res.categories, function(i, item) {
                            $('#category_id').append($('<option>', {
                                value: item.id,
                                text: item.name
                            }));
                        });
                        $('#CategoryForm').trigger("reset");
                        $('#CategoryModal').html("Add SubCategory");
                        $('#category-modal').modal('show');
                        $('#id').val('');
                    }
                });
            }

            var token = $('meta[name="csrf-token"]').attr('content');

            function deleteFunc(id) {
                if (confirm("Delete Record?") == true) {
                    var id = id;
                    $.ajax({
                        type: "POST",
                        _token: token,
                        url: "{{ route('subcategories.delete') }}",
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
                    url: "{{ route('subcategories.edit') }}",
                    _token: token,
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $.each(res.categories, function(i, item) {
                            $('#category_id').append($('<option>', {
                                value: item.id,
                                text: item.name,
                            }));
                        });
                        $('#CategoryModal').html("Edit SubCategory");
                        $('#category-modal').modal('show');
                        $('#id').val(res.subcategory.id);
                        $('#name').val(res.subcategory.name);
                        $('#name_ar').val(res.subcategory.name_ar);
                        $('#category_id').val(res.subcategory.category_id);
                    }
                });
            }

            $('#CategoryForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('subcategories.store') }}",
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

                    },
                    error: function(xhr, status, error) {
                        $("#btn-save").attr("disabled", false);
                        $("#category-modal").modal('hide');

                        $('.alert-danger span').html(JSON.parse(xhr.responseText).message);
                        $('.alert-danger').addClass('show');


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
