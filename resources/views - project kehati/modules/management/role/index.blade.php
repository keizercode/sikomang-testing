@extends('layouts.master')

@section('page-css')
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
                            <th data-width="50" data-field="action">#</th>
                            <th data-width="50" data-field="no">No</th>
                            <th data-field="name">Name</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        </table>
                        <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection