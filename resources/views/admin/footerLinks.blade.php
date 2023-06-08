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
            <a class="btn btn-success text-white" onClick="add()" href="javascript:void(0)"> Add Link</a>
        </div>


        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2>Footer links table</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered " id="datatables-example" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name (Fr)</th>
                            <th>Name (Ar)</th>
                            <th>URL</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="modal fade" id="Links-Modal" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="LinksModal"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="LinksForm" name="LinksForm" class="form-horizontal"
                            method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="name"> Name (fr)</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="name_fr" name="name_fr" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name_ar">Name (Ar)</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control ar" id="name_ar" name="name_ar"
                                        maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name_ar">URL</label>
                                <div class="col-sm-12">
                                    <input type="url" class="form-control" id="url" name="url"
                                        maxlength="50" required>
                                </div>
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
                    ajax: "{{ route('footer-links') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name_fr',
                            name: 'name_fr'
                        },
                        {
                            data: 'name_ar',
                            name: 'name_ar'
                        },
                        {
                            data: 'url',
                            name: 'url'
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
                $('#LinksForm').trigger("reset");
                $('#LinksModal').html("Add Link");
                $('#Links-Modal').modal('show');
                $('#id').val('');
            }
            var token = $('meta[name="csrf-token"]').attr('content');

            function deleteFunc(id) {
                if (confirm("Delete Record?") == true) {
                    var id = id;
                    $.ajax({
                        type: "POST",
                        _token: token,
                        url: "{{ route('footer-links.delete') }}",
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
                    url: "{{ route('footer-links.edit') }}",
                    _token: token,
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#LinksModal').html("Edit Category");
                        $('#Links-Modal').modal('show');
                        $('#id').val(res.id);
                        $('#name_fr').val(res.name_fr);
                        $('#name_ar').val(res.name_ar);
                        $('#url').val(res.url);
                    }
                });
            }

            $('#LinksForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('footer-links.store') }}",
                    data: formData,
                    _token: token,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        $("#Links-Modal").modal('hide');
                        var oTable = $('#datatables-example').dataTable();
                        oTable.fnDraw(false);
                        $("#btn-save").html('Submit');
                        $("#btn-save").attr("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        $("#btn-save").attr("disabled", false);
                        $("#Links-Modal").modal('hide');

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
