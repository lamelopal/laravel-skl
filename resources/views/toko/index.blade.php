@extends('layouts.template')

@section('page-title')
Halaman Data Toko
@endsection

@section('content')

{{-- ketika ada error --}}
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

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title">Data Toko</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-xl">
                            Tambah Data
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Toko</th>
                            <th>Kategori</th>
                            <th>Pemilik Toko</th>
                            <th>Status Toko</th>
                            <th>Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($toko as $item)
                        <tr>
                            <td>{{$item->nama_toko}}</td>
                            <td>{{$item->kategori_toko}}</td>
                            <td>{{$item->user->name}}</td>
                            <td>
                                @if($item->status_aktif == FALSE)
                                    <span class="badge badge-danger">Toko Non-Aktif</span>
                                @else
                                    <span class="badge badge-success">Toko Aktif</span>
                                
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-outline-success" data-toggle="dropdown"> Pilihan </a>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="{{route('toko.show', $item->id)}}">Detail</a>
                                    <form action="{{route('toko.destroy', $item->id)}}" method="post">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="dropdown-item"
                                            onclick="return confirm('Hapus data?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nama Toko</th>
                            <th>Kategori</th>
                            <th>Pemilik Toko</th>
                            <th>Status Toko</th>
                            <th>Pilihan</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Toko</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('toko.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Toko</label>
                        <input type="text" name="nama_toko" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama Pemilik</label>
                        <select name="id_user" class="form-control">
                            <option value="">Pilih nama pemilik</option>
                            @foreach($user as $item)
                                @if($item->level == 'penjual')
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Toko</label>
                            <textarea name="desc_toko" id="summernote">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Kategori Toko</label>
                        <select name="kategori_toko" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            <option value="elektronik">Elektronik</option>
                            <option value="otomotif">Otomotif</option>
                            <option value="sembako">Sembako</option>
                            <option value="fashion">Fashion</option>
                            <option value="makanan">Makanan</option>
                            <option value="obat">Obat</option>
                            <option value="aksesoris">Aksesoris</option>
                            <option value="perabotan">Perabotan</option>
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

                    <div class="form-group">
                        <select name="status_aktif" class="form-control" required>
                            <option value="0">Non-Aktif</option>
                            <option value="1">Aktif</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Icon Foto</label>
                        <input type="file" name="icon_toko" class="form-control">
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection