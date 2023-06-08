@extends('admin.layouts.app')
@section('content')
<style>
    .ar{
        direction: rtl
    }
</style>
    <div class="container py-2 mt-4">

        <div class="alert alert-danger alert-dismissible fade " role="alert">
            <strong>error</strong> <span></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="pull-right mb-2">
            <a class="btn btn-success text-white" onClick="add()" href="javascript:void(0)"> Add Question</a>
        </div>


        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2>Frequently Asked Questions table</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered " id="datatables-example" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Question</th>
                            <th>Question (Ar)</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="modal fade" id="category-modal" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content p-2">
                    <div class="alert alert-info"><strong>Note: </strong> The response can only be a text OR an article but not both (The text will be taken by default)</div>
                    <div class="modal-header">
                        <h4 class="modal-title" id="CategoryModal"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="CategoryForm" name="CategoryForm" class="form-horizontal"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="name">Question (Fr)</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="question_fr" name="question_fr"
                                        placeholder="Enter Question " required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name_ar">Question (Ar)</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control ar" id="question_ar" name="question_ar"
                                        placeholder="أدخل السؤال باللغة العربية">
                                </div>
                            </div>

                            <h4>Text as a response</h4>
                            <div class="form-group">
                                <label for="name">Response (Fr)</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="response_fr" name="response_fr"
                                        placeholder="Enter response ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name_ar">Response (Ar)</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control ar" id="response_ar" name="response_ar"
                                        placeholder="Enter Arabic response ">
                                </div>
                            </div>

                            <hr>

                            <h4>Article as a response</h4>
                            <div class="form-group">
                                <label for="category_id">Category </label>
                                <select class="form-control " id="category_id" name="category_id">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subcategory_id">Subcategory </label>
                                <select class="form-control " id="subcategory_id" name="subcategory_id">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="article_id">Article (Response)</label>
                                <select class="form-control " id="article_id" name="article_id">
                                </select>
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
                ajax: "{{ route('faqs') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'question_fr',
                        name: 'question_fr'
                    },
                    {
                        data: 'question_ar',
                        name: 'question_ar'
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
            $('#category_id').find('option').remove();
            $.ajax({
                type: "POST",
                url: "{{ route('faqs.create') }}",
                data: {
                    category_id: null
                },
                success: function(res) {
                    $('#category_id').append($('<option>', {
                            value: '',
                            text: 'Select category'
                        }));
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
                    url: "{{ route('faqs.delete') }}",
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
                url: "{{ route('faqs.edit') }}",
                _token: token,
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#category_id').find('option').remove();
                    $('#category_id').append($('<option>', {
                            value: '',
                            text: 'Select category'
                        }));
                    $.each(res.categories, function(i, item) {
                            $('#category_id').append($('<option>', {
                                value: item.id,
                                text: item.name,
                            }));
                    });
                    $('#subcategory_id').find('option').remove();
                    $('#subcategory_id').append($('<option>', {
                            value: '',
                            text: 'Select category'
                        }));
                    $.each(res.subcategories, function(i, item) {
                            $('#subcategory_id').append($('<option>', {
                                value: item.id,
                                text: item.name,
                            }));
                    });
                    $('#article_id').find('option').remove();
                    $('#article_id').append($('<option>', {
                            value: '',
                            text: 'Select category'
                        }));
                    $.each(res.articles, function(i, item) {
                            $('#article_id').append($('<option>', {
                                value: item.id,
                                text: item.title,
                            }));
                    });
                    $('#CategoryModal').html("Edit Category");
                    $('#category-modal').modal('show');
                    $('#id').val(res.faq.id);
                    $('#question_fr').val(res.faq.question_fr);
                    $('#question_ar').val(res.faq.question_ar);
                    $('#response_fr').val(res.faq.response_fr);
                    $('#response_ar').val(res.faq.response_ar);
                    if(res.faq.article_id){
                        $('#category_id').val(res.cat_id);
                        $('#subcategory_id').val(res.subcat_id);
                        $('#article_id').val(res.faq.article_id);
                    }

                }
            });
        }

        $('#CategoryForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('faqs.store') }}",
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

        $('#category_id').on('change', function() {
            const cat_id = this.value;
            $('#subcategory_id').find('option').remove();
            $.ajax({
                type: "POST",
                url: "{{ route('faqs.create') }}",
                data: {
                    category_id: cat_id
                },
                success: function(res) {
                    $('#subcategory_id').append($('<option>', {
                            value: '',
                            text: 'Select subcategory'
                        }));
                    $.each(res.subcategories, function(i, item) {
                        $('#subcategory_id').append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));
                    });
                }
            });
        });

        $('#subcategory_id').on('change', function() {
            const subcat_id = this.value;
            $('#article_id').find('option').remove();
            $.ajax({
                type: "POST",
                url: "{{ route('faqs.create') }}",
                data: {
                    subcategory_id: subcat_id
                },
                success: function(res) {
                    $('#subcategory_id').append($('<option>', {
                            value: '',
                            text: 'Select Article'
                        }));
                    $.each(res.articles, function(i, item) {
                        $('#article_id').append($('<option>', {
                            value: item.id,
                            text: item.title
                        }));
                    });
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
