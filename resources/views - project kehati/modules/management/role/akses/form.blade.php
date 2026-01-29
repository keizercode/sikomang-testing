@extends('layouts.master')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form action="{{route($route.'.store')}}" method="POST" class="">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-responsive-sm table-striped table-hover table-header-center table-row-top text-nowrap"
                                    data-toggle="table"
                                    data-search="false"
                                    data-show-refresh ="false"
                                    data-page-size="700">
                                    <thead>
                                    <tr>
                                        <th width="20">#</th>
                                        <th>Menu</th>
                                        <th width="100"><label><input type="checkbox" class="checkread"> Read</label></th>
                                        <th width="100"><label><input type="checkbox" class="checkadd"> Create</label></th>
                                        <th width="100"><label><input type="checkbox" class="checkedit"> Update</label></th>
                                        <th width="100"><label><input type="checkbox" class="checkdel"> Delete</label></th>
                                        <th width="100"><label><input type="checkbox" class="checkdownload"> Download</label></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($menu as $key1 => $parent)
                                        <tr>
                                            <td>
                                                @if(count($parent['level1']) > 0)
                                                <a href="javascript:;" class="show_detail" data-id="{{$parent['id']}}" data-status="1">
                                                    <i id="parent{{$parent['id']}}" class="mdi mdi-minus"></i>
                                                </a>
                                                @endif
                                            </td>
                                            <td>{{$parent['title']}}</td>
                                            <td align="center">
                                                <input type="checkbox" name="is_read[]"
                                                    value="is_read+{{$parent['id']}}" @if($parent['checked']['is_read'] == 1) {{'checked'}} @endif>
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="is_create[]"
                                                    value="is_create+{{$parent['id']}}" @if($parent['checked']['is_create'] == 1) {{'checked'}} @endif>
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="is_update[]"
                                                    value="is_update+{{$parent['id']}}" @if($parent['checked']['is_update'] == 1) {{'checked'}} @endif>
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="is_delete[]"
                                                    value="is_delete+{{$parent['id']}}" @if($parent['checked']['is_delete'] == 1) {{'checked'}} @endif>
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="is_download[]"
                                                    value="is_download+{{$parent['id']}}" @if($parent['checked']['is_download'] == 1) {{'checked'}} @endif>
                                            </td>
                                            
                                        </tr>
                                        @if($parent['level1'])
                                            @foreach($parent['level1'] as $key2 => $level1)
                                                <tr class="parent_{{$parent['id']}} hide_child">
                                                    <td>
                                                        @if(count($level1['level2']) > 0)<a href="javascript:;"
                                                                                            class="show_detail"
                                                                                            data-id="{{$level1['id']}}"
                                                                                            data-status="1"><i
                                                                    id="parent{{$level1['id']}}"
                                                                    class="mdi mdi-minus"></i></a>@endif
                                                    </td>
                                                    <td style="text-indent:30px;">--- {{$level1['title']}}</td>
                                                    <td align="center">
                                                        <input type="checkbox" name="is_read[]" value="is_read+{{$level1['id']}}" @if($level1['checked']['is_read'] == 1) {{'checked'}} @endif>
                                                    </td>
                                                    <td align="center">
                                                        <input type="checkbox" name="is_create[]" value="is_create+{{$level1['id']}}" @if($level1['checked']['is_create'] == 1) {{'checked'}} @endif>
                                                    </td>
                                                    <td align="center">
                                                        <input type="checkbox" name="is_update[]" value="is_update+{{$level1['id']}}" @if($level1['checked']['is_update'] == 1) {{'checked'}} @endif>
                                                    </td>
                                                    <td align="center">
                                                        <input type="checkbox" name="is_delete[]" value="is_delete+{{$level1['id']}}" @if($level1['checked']['is_delete'] == 1) {{'checked'}} @endif>
                                                    </td>
                                                    <td align="center">
                                                        <input type="checkbox" name="is_download[]" value="is_download+{{$level1['id']}}" @if($level1['checked']['is_download'] == 1) {{'checked'}} @endif>
                                                    </td>

                                                    
                                                </tr>
                                                @if($level1['level2'])
                                                    @foreach($level1['level2'] as $key3 => $level2)
                                                        <tr class="parent_{{$level1['id']}} hide_child">
                                                            <td>
                                                                @if(count($level2['level3']) > 0)<a href="javascript:;"
                                                                                                    class="show_detail"
                                                                                                    data-id="{{$level2['id']}}"
                                                                                                    data-status="1"><i
                                                                            id="parent{{$level2['id']}}"
                                                                            class="mdi mdi-minus"></i></a>@endif
                                                            </td>
                                                            <td style="text-indent: 60px">------ {{$level2['title']}}</td>
                                                            <td align="center">
                                                                <input type="checkbox" name="is_read[]" value="is_read+{{$level2['id']}}" @if($level2['checked']['is_read'] == 1) {{'checked'}} @endif>
                                                            </td>
                                                            <td align="center">
                                                                <input type="checkbox" name="is_create[]" value="is_create+{{$level2['id']}}" @if($level2['checked']['is_create'] == 1) {{'checked'}} @endif>
                                                            </td>
                                                            <td align="center">
                                                                <input type="checkbox" name="is_update[]" value="is_update+{{$level2['id']}}" @if($level2['checked']['is_update'] == 1) {{'checked'}} @endif>
                                                            </td>
                                                            <td align="center">
                                                                <input type="checkbox" name="is_delete[]" value="is_delete+{{$level2['id']}}" @if($level2['checked']['is_delete'] == 1) {{'checked'}} @endif>
                                                            </td>
                                                            <td align="center">
                                                                <input type="checkbox" name="is_download[]" value="is_download+{{$level2['id']}}" @if($level2['checked']['is_download'] == 1) {{'checked'}} @endif>
                                                            </td>
                                                        </tr>
                                                        @if($level2['level3'])
                                                            @foreach($level2['level3'] as $key4 => $level3)
                                                                <tr class="parent_{{$level2['id']}} hide_child">
                                                                    <td>
                                                                        @if(count($level3['level4']) > 0)<a href="javascript:;"
                                                                                                            class="show_detail"
                                                                                                            data-id="{{$level3['id']}}"
                                                                                                            data-status="1"><i
                                                                                    id="parent{{$level3['id']}}"
                                                                                    class="mdi mdi-minus"></i></a>@endif
                                                                    </td>
                                                                    <td style="text-indent: 90px;">--------- {{$level3['title']}}</td>
                                                                    <td align="center">
                                                                        <input type="checkbox" name="is_read[]" value="is_read+{{$level3['id']}}" @if($level3['checked']['is_read'] == 1) {{'checked'}} @endif>
                                                                    </td>
                                                                    <td align="center">
                                                                        <input type="checkbox" name="is_create[]" value="is_create+{{$level3['id']}}" @if($level3['checked']['is_create'] == 1) {{'checked'}} @endif>
                                                                    </td>
                                                                    <td align="center">
                                                                        <input type="checkbox" name="is_update[]" value="is_update+{{$level3['id']}}" @if($level3['checked']['is_update'] == 1) {{'checked'}} @endif>
                                                                    </td>
                                                                    <td align="center">
                                                                        <input type="checkbox" name="is_delete[]" value="is_delete+{{$level3['id']}}" @if($level3['checked']['is_delete'] == 1) {{'checked'}} @endif>
                                                                    </td>
                                                                    <td align="center">
                                                                        <input type="checkbox" name="is_download[]" value="is_download+{{$level3['id']}}" @if($level3['checked']['is_download'] == 1) {{'checked'}} @endif>
                                                                    </td>
                                                                </tr>
                                                                @if($level3['level4'])
                                                                    @foreach($level3['level4'] as $key5 => $level4)
                                                                        <tr class="parent_{{$level3['id']}} hide_child">
                                                                            <td>
                                                                                <span style="color: #7F8FA4">{{$level4['id']}}</span>
                                                                            </td>
                                                                            <td style="text-indent: 130px">------------ {{$level4['title']}}</td>
                                                                            <td align="center">
                                                                                <input type="checkbox" name="is_read[]" value="is_read+{{$level4['id']}}" @if($level4['checked']['is_read'] == 1) {{'checked'}} @endif>
                                                                            </td>
                                                                            <td align="center">
                                                                                <input type="checkbox" name="is_create[]" value="is_create+{{$level4['id']}}" @if($level4['checked']['is_create'] == 1) {{'checked'}} @endif>
                                                                            </td>
                                                                            <td align="center">
                                                                                <input type="checkbox" name="is_update[]" value="is_update+{{$level4['id']}}" @if($level4['checked']['is_update'] == 1) {{'checked'}} @endif>
                                                                            </td>
                                                                            <td align="center">
                                                                                <input type="checkbox" name="is_delete[]" value="is_delete+{{$level4['id']}}" @if($level4['checked']['is_delete'] == 1) {{'checked'}} @endif>
                                                                            </td>
                                                                            <td align="center">
                                                                                <input type="checkbox" name="is_download[]" value="is_download+{{$level4['id']}}" @if($level4['checked']['is_download'] == 1) {{'checked'}} @endif>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                <input type="hidden" name="group_id" value="{{encode_id(@$id)}}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{route('modules.management.role.index')}}" class="btn btn-danger"><i class="mdi mdi-cancel"></i> Batal</a>
                                <button type="submit" class="btn btn-success"><i class="mdi mdi-content-save-outline"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
	<script type="text/javascript">
        function toggle(toggle) {
            toggle == 'undefined' ? toggle = 0 : toggle = toggle;
            if (toggle == 0) {
                $('.show_detail').attr('data-status', '1');
                $('.show_detail').click();
            } else {
                $('.show_detail').attr('data-status', '0');
                $('.show_detail').click();
            }
        }
        $(document).ready(function () {
            $('.hide_child').show();
            $('.show_detail').click(function () {
                var id = $(this).attr('data-id');
                var status = $(this).attr('data-status');
                if (status == 1) {
                    $(this).attr('data-status', '0');
                    $(".parent_" + id).show('falt');
                    $("#parent" + id).removeClass('mdi mdi-plus').addClass('mdi mdi-minus');
                } else {
                    $(this).attr('data-status', '1');
                    $(".parent_" + id).hide('falt');
                    $("#parent" + id).removeClass('mdi mdi-minus').addClass('mdi mdi-plus');
                }
            });

            $('#menu_group').change(function () {
                window.location.href = "{{url('system/groups/access/'.encode_id(@$id))}}/" + this.value;
            });

            $('.checkread').change(function () {
                var checked = $(this).prop('checked');
                $('.table').find('input[name*="is_read[]"]').prop('checked', checked);
            });
            $('.checkverify').change(function () {
                var checked = $(this).prop('checked');
                $('.table').find('input[name*="is_verify[]"]').prop('checked', checked);
            });
            $('.checkadd').change(function () {
                var checked = $(this).prop('checked');
                $('.table').find('input[name*="is_create[]"]').prop('checked', checked);
            });
            $('.checkedit').change(function () {
                var checked = $(this).prop('checked');
                $('.table').find('input[name*="is_update[]"]').prop('checked', checked);
            });
            $('.checkdel').change(function () {
                var checked = $(this).prop('checked');
                $('.table').find('input[name*="is_delete[]"]').prop('checked', checked);
            });
            $('.checkapprove').change(function () {
                var checked = $(this).prop('checked');
                $('.table').find('input[name*="is_approve[]"]').prop('checked', checked);
            });
            $('.checkdownload').change(function () {
                var checked = $(this).prop('checked');
                $('.table').find('input[name*="is_download[]"]').prop('checked', checked);
            });
        });
    </script>
@endsection