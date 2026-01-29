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
                                    <label class="col-xl-12 form-label" for="fname">Nama</label>
                                    <div class="col-12 ">
                                        <input type="text" value="{{@$item->name ? @$item->name :  old('name')}}" name="name"  class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama Sekolah" required>
                                        @error('name')
                                        <span class="invalid-feedback" style="display: block!important;"><strong>{{$message}}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="col-xl-12 form-label">Alias</label>
                                    <div class="col-12 ">
                                        <input type="text" value="{{@$item->alias ? @$item->alias :  old('alias')}}" name="alias"  class="form-control @error('alias') is-invalid @enderror" placeholder="Masukan Nama Sekolah" required>
                                        @error('alias')
                                        <span class="invalid-feedback" style="display: block!important;"><strong>{{$message}}</strong></span>
                                        @enderror
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
@endsection