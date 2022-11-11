@extends('layouts.master')

@section('content')
    @push('css')
        <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    @endpush
    <div class="container">
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Posts</h5>
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="text-muted">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void()" class="text-active">Posts</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom gutter-b">
                    <div class="card-header flex-wrap py-3">
                        <div class="card-title">
                            <h3 class="card-label">All Posts
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('post.create') }}" class="btn btn-primary font-weight-bolder">
                                <span class="svg-icon svg-icon-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <circle fill="#000000" cx="9" cy="15" r="6"></circle>
                                            <path
                                                d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                                fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                </span>New Post</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable no-footer dtr-inline" id="kt_datatable" aria-describedby="kt_datatable_info" >
                                        <thead>
                                            <tr>
                                                <td>ID</td>
                                                <td>Title</td>
                                                <td>Status</td>
                                                <td>Published Date</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(document).ready(() => {
            const table = $("#kt_datatable").DataTable({
                processing:true,
                responsive:true,
                pageLength: 20,
                lengthMenu: [[10,20,40,80, -1], [10, 20,40,80, "All"]],
                serverSide: true,
                scrollX: true,
                ajax:"{{ route('post.index') }}",
                columns:[
                    {data:'id' , name:'id'},
                    {data:'text' , name:'text'},
                    {data:'status' , name:'status'},
                    {data:'created_at' , name:'created_at'},
                    {data:'action' , name:'action', orderable: false, searchable:false},
                ]
            })

            $(document).on('click', '.delete', function()  {

                const id = $(this).data("id")
                Swal.fire({
                    title: "Are you sure you ant to delete this post?",
                    text: "You will not able to revert the action !",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!"
                }).then(function(result) {
                    if (result.value) {
                        $(this).attr("disabled", true)
                        const url = route('post.destroy', { post: id });
                        window.axios.delete(url).then((response) => {
                            if(response.status === 200) {
                                table.ajax.reload();
                            }
                        })
                        Swal.fire(
                            "Deleted!",
                            "Post has been deleted successfully.",
                            "success"
                        )
                    }
                });
            })
        })
    </script>
@endpush

