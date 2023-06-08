@extends('admin.layouts.app')
@section('content')
    <div class="container  py-2 mt-4">
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
            <a class="btn btn-success text-white"  href="{{route('articles.create')}}"> Add Article</a>
        </div>


        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2>Articles table</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered " id="datatables-example" style="width:100%">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>SubCategory</th>
                        <th>Title</th>
                        <th>Arabic Title</th>
                        <th>Views</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
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
                    ajax: "{{ route('articles') }}",
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'category', name: 'category' },
                        { data: 'subcategory', name: 'subcategory' },
                        { data: 'title', name: 'title' },
                        { data: 'title_ar', name: 'title_ar' },
                        { data: 'views', name: 'views' },
                        { data: 'status', name: 'status' },
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
                        url: "{{ route('articles.delete') }}",
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </div>
@endsection