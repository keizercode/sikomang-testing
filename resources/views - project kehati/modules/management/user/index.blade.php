@extends('layouts.master')

@section('css')
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id="toolbar">
                            <a href="{{url($url.'/update')}}" id="btn-add" class="btn btn-primary">
                                <i class="mdi mdi-plus"></i> Tambah Data
                            </a>
                        </div>

                        <table class="table w-100" 
                        data-search="true"
                        data-toggle="table"
                        data-pagination="true"
                        data-toolbar="#toolbar"
                        data-show-refresh="false"
                        data-url="{{route($route.'.grid')}}"
                        data-ajax-options='{"xhrFields": {"withCredentials": true}}'
                        data-sort-name="ids"
                        data-sort-order="desc"
                        data-page-size="10"
                        data-id-field="id"
                        id="grid-data">
                            <thead class="table-primary text-primary">
                            <tr>
                                <th data-field="action">#</th>
                                <th data-field="no">No</th>
                                <th data-field="role">Role</th>
                                <th data-field="email">Email</th>
                                <th data-field="name">Name</th>
                                <th data-field="created_at">Created At</th>
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
@endsection
@section('js')
<script type="text/javascript">
$("#grid-data").on("click", ".forcelogin", function() {
    var base_url = $(this).attr('data-href');
    var id = $(this).attr('data-id');
    Swal.fire({
         title: "Force Login!",
         text: "Apa anda yakin ingin login sebagai akun ini ?",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "#3F7D58",
         confirmButtonText: "Ya Masuk Sekarang",
         cancelButtonText: "Tidak",
         closeOnConfirm: true,
         closeOnCancel: true
     },
     function(isConfirm) {
        if(isConfirm){
          
          request = $.ajax({
              url: base_url,
              type: "GET",
              xhrFields: {
                    withCredentials: true
                }
          });

          // Callback handler that will be called on success
          request.done(function(response, textStatus, jqXHR){
              console.log(response);
              if(response.status == true){
                toastr.success("Berhasil Login", 'Berhasil!', {positionClass: 'toast-bottom-right', containerId: 'toast-bottom-right'});
                console.log(response);
                window.location.href = '{{url("/dashboard")}}';
                history.pushState(null, null, location.href);
                window.onpopstate = function () {
                    history.go(1);
                };
              }else{
                toastr.error("Maaf Terjadi Kesalahan", 'Gagal!', {positionClass: 'toast-bottom-right', containerId: 'toast-bottom-right'});
                console.log(response);
              }
              
          });

          // Callback handler that will be called on failure
          request.fail(function (jqXHR, textStatus, errorThrown){
              toastr.error(
                  "Gagal "+textStatus, errorThrown
              );
          });
        }
     }); 
    return false;
});
$("#grid-data").on("click", ".remove_data", function() {
        var base_url = $(this).attr('data-href');
        var id = $(this).attr('data-id');
            Swal.fire({
            title: "Hapus Data!",
            text: "Apa anda yakin ingin menghapus data ini ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya Hapus Sekarang",
            cancelButtonText: "Tidak"
        }).then((result) => {

            if (result.isConfirmed) {

                request = $.ajax({
                    url: base_url,
                    xhrFields: {
                        withCredentials: true
                    },
                    type: "GET",
                });

                // Callback handler that will be called on success
                request.done(function(response, textStatus, jqXHR){
                    console.log(response);
                    alertify.success("Berhasil Menhapus Data");
                    $('#grid-data').bootstrapTable('refresh');
                });

                // Callback handler that will be called on failure
                request.fail(function (jqXHR, textStatus, errorThrown){
                    alertify.error("Gagal " + textStatus, errorThrown);
                });

            }

        });

    return false;
});
</script>
@endsection