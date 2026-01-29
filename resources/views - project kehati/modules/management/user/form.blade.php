@extends('layouts.master')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="mdi mdi-account"></i> {{$title}}
                    </div>
                    <form action="{{route($route.'.store')}}" method="POST" class="">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="secure_id" value="{{@$keyId}}">
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="col-xl-12 form-label" for="fname">Username</label>
                                    <div class="col-12 ">
                                        <input type="text" readonly value="{{@$item->username ? @$item->username :  old('username')}}" name="username" class="form-control bg-secondary @error('username') is-invalid @enderror" placeholder="Masukan username" required>
                                        @error('username')
                                        <span class="invalid-feedback" style="display: block!important;"><strong>{{$message}}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="col-xl-12 form-label" for="emailverify">Email</label>
                                    <div class="col-12 ">
                                        <input type="email" name="email" readonly value="{{@$item->email ? @$item->email :  old('email')}}" id="emailverify" class="form-control bg-secondary @error('email') is-invalid @enderror" placeholder="Masukan Email Aktif" required>
                                        @error('email')
                                            <span class="invalid-feedback" style="display: block!important;"><strong>{{$message}}</strong></span>
                                        @enderror
                                        <small class="text-primary">* Pastikan email benar dan aktif, akses aplikasi akan dikirim ke email yang didaftarkan.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="col-xl-12 form-label" for="fname">Nama</label>
                                    <div class="col-12 ">
                                        <input type="text" value="{{@$item->name ? @$item->name :  old('name')}}" name="name"  class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama" required>
                                        @error('name')
                                        <span class="invalid-feedback" style="display: block!important;"><strong>{{$message}}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="col-xl-12 form-label" for="fname">Role User</label>
                                    <div class="col-12 ">
                                        <select name="group" class="form-control @error('group') is-invalid @enderror" required>
                                            <option value="">-Pilih Role User-</option>
                                            @foreach($group as $data_group)
                                            <option {{@$item->ms_group_id == $data_group->MsGroupId ? 'selected' : ''}} value="{{encode_id($data_group->MsGroupId)}}">{{$data_group->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('group')
                                        <span class="invalid-feedback" style="display: block!important;"><strong>{{$message}}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="col-xl-12 form-label">Password Baru</label>
                                    <div class="col-12 ">
                                        <div class="input-group">
                                            <input type="password" id="password" autocomplete="new-password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan Password Minimm 8 characters">
                                            <div class="input-group-text">
                                                <button class="btn btn-default waves-effect waves-themed" type="button" id="togglePassword"><i class="mdi mdi-eye"></i></button>
                                            </div>
                                        </div>
                                        @error('password')
                                            <span class="text-danger" style="display: block!important;"><strong>{{$message}}</strong></span>
                                        @enderror
                                        <div class="help-block">
                                        Kata Sandi harus mengandung Minimal 8 karakter, maksimal 15 karakter, <br>setidaknya 1 huruf kecil dan huruf besar, angka dan simbol
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{route($route.'.index')}}" class="btn btn-danger"><i class="mdi mdi-cancel"></i> Batal</a>
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
     $(document).ready(function() {
            $('.numberInput').on('input', function() {
                this.value = this.value.replace(/[^0-9]/g, ''); // Hanya angka 0-9
            });
            $('#togglePassword').on('click', function() {
                let passwordField = $('#password');
                let icon = $(this).find('i');

                // Cek apakah input saat ini bertipe password
                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text'); // Ubah ke teks
                    icon.removeClass('mdi-eye').addClass('mdi-eye-off'); // Ganti ikon
                } else {
                    passwordField.attr('type', 'password'); // Ubah ke password
                    icon.removeClass('mdi-eye-off').addClass('mdi-eye'); // Kembalikan ikon
                }
            });
        });   
    </script>
@endsection