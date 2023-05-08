@extends('admin/layouts/main')

@section('content')
<h4 class="page-title">{{ $title }}</h4>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Tambah Kategori</h4>
                    <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"></i>
                        Tambah Kategori
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- Modal tambah -->
                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header no-bd">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold">
                                        Tambah</span>
                                    <span class="fw-bold">
                                        Kategori
                                    </span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/admin/kategori/store" method="post">
                                @csrf
                                <div class="modal-body">
                                    <p class="small">Tambah kategori baru ke etalase toko</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default">
                                                <label>Nama kategori</label>
                                                <input id="nama_kategori" name="nama_kategori" type="text" class="form-control" placeholder="masukkan nama kategori" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default">
                                                <label>Deskripsi</label>
                                                <input id="deskripsi" name="deskripsi" type="text" class="form-control" placeholder="masukkan deskripsi singkat" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer no-bd">
                                    <input type="submit" class="btn btn-primary" value="Tambah">

                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nama katgoti</th>
                                <th>Deskripsi</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>id</th>
                                <th>Nama katgoti</th>
                                <th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($dataKategori as $kategori)
                            <tr>
                                <td>{{ $kategori->id }}</td>
                                <td>{{ $kategori->nama_kategori }}</td>
                                <td>{{ $kategori->deskripsi }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <button data-toggle="modal" data-target="#ubahKategori-{{ $kategori->id }}" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <button data-toggle="modal" data-target="#hapusKategori-{{ $kategori->id }}" class="btn btn-link btn-danger" data-original-title="Remove">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>

                                    <!-- modal ubah -->
                                    <div class="modal fade" id="ubahKategori-{{ $kategori->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header no-bd">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold">
                                                            Ubah kategori</span>
                                                        <span class="fw-bold">
                                                            "{{ $kategori->nama_kategori }}"
                                                        </span>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="/admin/kategori/update" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p class="small">Ubah kategori yang telah terdaftar</p>
                                                        <input type="number" name="id" id="id" value="{{ $kategori->id }}" style="display: none;">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>Nama kategori</label>
                                                                    <input id="nama_kategori" name="nama_kategori" type="text" class="form-control" placeholder="masukkan nama kategori" value="{{ $kategori->nama_kategori }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>Deskripsi</label>
                                                                    <input id="deskripsi" name="deskripsi" type="text" class="form-control" placeholder="masukkan deskripsi singkat" value="{{ $kategori->deskripsi }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer no-bd">
                                                        <input type="submit" class="btn btn-primary" value="Ubah">

                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- modal hapus -->
                                    <div class="modal fade" id="hapusKategori-{{ $kategori->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header no-bd">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold">
                                                            Hapus kategori</span>
                                                        <span class="fw-bold">
                                                            "{{ $kategori->nama_kategori }}"
                                                        </span>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="/admin/kategori/delete" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p class="small">Yakin ingin menghapus kategori "{{ $kategori->nama_kategori }}"?</p>
                                                        <input type="number" name="id" id="id" value="{{ $kategori->id }}" style="display: none;">
                                                    </div>
                                                    <div class="modal-footer no-bd">
                                                        <input type="submit" class="btn btn-primary" value="Hapus">

                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection