@extends('admin.layouts.app')
@section('content')
    <div class="container py-2 mt-4">

        <div class="alert alert-danger alert-dismissible fade " role="alert">
            <strong>error</strong> <span ></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2>Contacts table</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered " id="datatables-example" style="width:100%">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Email</th>
                        <th>Code</th>
                        <th>State</th>
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
                        <form  id="CategoryForm" name="CategoryForm" class="form-horizontal" >
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="name" > Email</label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" maxlength="50" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name_ar" >Question</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="question" name="question" placeholder="Enter Question" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name_ar" >State</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="condition" name="condition" placeholder="Enter condition"  readonly>
                                </div>
                            </div>
                            <div class="form-floating mb-4">
                                <textarea class="form-control"  id="message" name="message" placeholder="Enter  Message " style="height: 100px" readonly></textarea>
                                <label for="name_ar" >Message</label>
                            </div>
                            <div class="form-group">
                                <label for="name_ar" >Code</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="code" name="code" placeholder="Enter Code" maxlength="50" required readonly>
                                </div>
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

                $('#datatables-example').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('contacts') }}",
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'email', name: 'email' },
                        { data: 'code', name: 'code' },
                        { data: 'condition', name: 'condition' },
                        { data: 'created_at', name: 'created_at' },
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            });

            var token =$('meta[name="csrf-token"]').attr('content');
            function deleteFunc(id){
                if (confirm("Delete Record?") == true) {
                    var id = id;
                    $.ajax({
                        type:"POST",
                        _token:token,
                        url: "{{ route('contacts.delete') }}",
                        data: { id: id },
                        dataType: 'json',
                        success: function(res){
                            var oTable = $('#datatables-example').dataTable();
                            oTable.fnDraw(false);
                        },
                        error: function (xhr){
                            console.log(xhr)
                        }
                    });
                }
            }
            function editFunc(id){
                const condition = $(`body #edit-${id}`).parents('td').prev().prev()
                $.ajax({
                    type: "GET",
                    url: "{{ route('contacts.notification') }}",
                    _token: token,
                    dataType: 'json',
                    data: { id: id },
                    success: function(res) {
                        condition.text(1);
                        if(res > 0){
                            $('#conatcts-badge').removeClass("d-none");
                            $('#conatcts-badge').html(res);
                        }else{
                            $('#conatcts-badge').hide();
                        }

                        $.ajax({
                            type:"POST",
                            url: "{{ route('contacts.show') }}",
                            _token:token,
                            data: { id: id },
                            dataType: 'json',
                            success: function(res){
                                $('#CategoryModal').html("Show Contact");
                                $('#category-modal').modal('show');
                                $('#id').val(res.id);
                                $('#email').val(res.email);
                                $('#question').val(res.question);
                                $('#condition').val(res.condition);
                                $('#code').val(res.code);
                                $('#message').val(res.message);
        
                            }
                        });
                    }
                });
                

            }


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </div>
@endsection