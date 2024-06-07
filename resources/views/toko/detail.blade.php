@extends('layouts.template')

@section('page-title')
Detail {{$data->nama_toko}}
@endsection

@section('content')

@if($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i> Sorry, Error</h5>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Area Detai Pemilik Toko --}}
<div class="row">
    <div class="col-md-12 col-sm-12">
        {{-- show data card --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h5>Detail Toko</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <th>Nama Toko</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data->nama_toko}}</td>
                            <td rowspan="7">
                                <div class="card-image">
                                    <img class="rounded-lg" width="70%" height="70%"
                                        src="{{asset('storage/image/toko/'.$data->icon_toko)}}" alt="gambar">

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Nama Pemilik</th>
                            <td width="5%"> : </td>`
                            <td width="50%">{{$data->user->name}}</td>
                        </tr>
                        <tr>
                            <th>Status Toko</th>
                            <td width="5%"> : </td>
                            <td width="50%">
                                @if ($data->status_aktif == TRUE)
                                <span class="badge badge-success">Toko Aktif</span>
                                @else
                                <span class="badge badge-danger">Toko Non-Aktif</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data->kategori_toko}}</td>
                        </tr>
                        <tr>
                            <th>hari Buka</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data->hari_buka}}</td>
                        </tr>
                        <tr>
                            <th>Jam Operasi</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data->jam_buka}} - {{$data->jam_libur}}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi Toko</th>
                            <td width="5%"> : </td>
                            <td width="50%">{!! $data->desc_toko !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- card-edit --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Data</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{route('toko.update',$data->id)}}" method="post">
                    @csrf
                    {{method_field('PUT')}}

                    <div class="modal-body">
                        <form-group>
                            <label>Nama Toko</label>
                            <input type="text" name="nama_toko" value="{{ $data->nama_toko }}" required class="form-control"> 
                        </form-group>

                        

                        <div class="row justify-content-arround">
                            <div class="form-group col-md-6">
                                <label>Jam Buka</label>
                                <input type="time" class="form-control" name="jam_buka">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Jam Tutup</label>
                                <input type="time" class="form-control" name="jam_libur">
                            </div>
                        </div>

                        <div class="form_group">
                            <label for="">Status Toko</label>
                            <select name="status_aktif" class="form-control" required>
                                <option value="0">Non-Aktif</option>
                                <option value="1">Aktif</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="kategori_toko">
                                <option value="elektronik">elektronik</option>
                                <option value="otomotif">otomotif</option>
                                <option value="sembako">sembako</option>
                                <option value="fashion">fashion</option>
                                <option value="makanan">makanan</option>
                                <option value="obat">obat</option>
                                <option value="aksesoris">aksesoris</option>
                                <option value="perabotan">perabotan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Hari Buka : </label>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="senin"
                                    value="senin">
                                <label for="senin" class="custom-control-label">Senin</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="selasa"
                                    value="selasa">
                                <label for="selasa" class="custom-control-label">Selasa</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="rabu"
                                    value="rabu">
                                <label for="rabu" class="custom-control-label">Rabu</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="kamis"
                                    value="kamis">
                                <label for="kamis" class="custom-control-label">Kamis</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="jumat"
                                    value="jumat">
                                <label for="jumat" class="custom-control-label">Jumat</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="sabtu"
                                    value="sabtu">
                                <label for="sabtu" class="custom-control-label">Sabtu</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="minggu"
                                    value="minggu">
                                <label for="minggu" class="custom-control-label">Minggu</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Icon Toko</label>
                            <input type="file" name="icon_toko" class="form-control" enctype="multipart/form-data"
                                id="">
                        </div>


                        <form-group>
                            <label>Deskripsi Toko</label>
                            <textarea name="desc_toko" id="summernote">
                                </textarea>
                        </form-group>

                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
