@extends('admin/layouts/main')

@section('content')
<h4 class="page-title">{{ $title }}</h4>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Tambah Produk</h4>
                    <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"></i>
                        Tambah Produk
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
                                        Produk
                                    </span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/admin/produk/store" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <p class="small">Tambah produk baru ke etalase toko</p>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Nama produk</label>
                                                <input id="nama_produk" name="nama_produk" type="text" class="form-control" placeholder="masukkan nama produk" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default">
                                                <label>Deskripsi</label>
                                                <input id="deskripsi" name="deskripsi" type="text" class="form-control" placeholder="masukkan deskripsi singkat" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default">
                                                <label>Harga</label>
                                                <input id="harga" name="harga" type="number" class="form-control" placeholder="masukkan harga produk" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default">
                                                <label>Kategori</label>
                                                <select class="custom-select my-1 mr-sm-2" id="kategori_id" name="kategori_id" required>
                                                    <option selected disabled>Pilih kategori...</option>
                                                    @foreach($dataKategori as $kategori)
                                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default">
                                                <label>Gambar</label>
                                                <input id="gambar" name="gambar" type="file" class="form-control" required>
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
                                <th>Gambar</th>
                                <th>Nama produk</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama produk</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($dataProduk as $produk)
                            <tr>
                                <td><img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->gambar }}" style="width: 100px;border-radius: 10px" class="my-2"></td>
                                <td>{{ $produk->nama_produk }}</td>
                                <td>{{ $produk->deskripsi }}</td>
                                <td>{{ $produk->nama_kategori }}</td>
                                <td>Rp. {{ $produk->harga }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <button data-toggle="modal" data-target="#ubahProduk-{{ $produk->id }}" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <button data-toggle="modal" data-target="#hapusProduk-{{ $produk->id }}" class="btn btn-link btn-danger" data-original-title="Remove">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>

                                    <!-- modal ubah -->
                                    <div class="modal fade" id="ubahProduk-{{ $produk->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header no-bd">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold">
                                                            Ubah produk</span>
                                                        <span class="fw-bold">
                                                            "{{ $produk->nama_produk }}"
                                                        </span>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="/admin/produk/update" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p class="small">Ubah produk yang telah terdaftar</p>
                                                        <input type="number" name="id" id="id" value="{{ $produk->id }}" style="display: none;">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group form-group-default">
                                                                    <label>Nama produk</label>
                                                                    <input id="nama_produk" name="nama_produk" type="text" class="form-control" placeholder="masukkan nama produk" value="{{ $produk->nama_produk }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>Deskripsi</label>
                                                                    <input id="deskripsi" name="deskripsi" type="text" class="form-control" placeholder="masukkan deskripsi singkat" value="{{ $produk->deskripsi }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>Harga</label>
                                                                    <input id="harga" name="harga" type="number" class="form-control" placeholder="masukkan harga produk" value="{{ $produk->harga }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>Kategori</label>
                                                                    <select class="custom-select my-1 mr-sm-2" id="kategori_id" name="kategori_id" required>
                                                                        <option disabled>Pilih kategori...</option>
                                                                        @foreach($dataKategori as $kategori)
                                                                        @if($kategori->id == $produk->kategori_id)
                                                                        <option selected value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                                                        @endif
                                                                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>Gambar</label>
                                                                    <input id="gambar" name="gambar" type="file" class="form-control" placeholder="masukkan gambar produk" value="{{ $produk->gambar }}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-12">
                                                                <div class="form-group form-group-default">
                                                                    <label>Gambar saat ini</label>
                                                                    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->gambar }}" style="width: 100px;border-radius: 10px" class="my-2">
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
                                    <div class="modal fade" id="hapusProduk-{{ $produk->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header no-bd">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold">
                                                            Hapus produk</span>
                                                        <span class="fw-bold">
                                                            "{{ $produk->nama_produk }}"
                                                        </span>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="/admin/produk/delete" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p class="small">Yakin ingin menghapus produk "{{ $produk->nama_produk }}"?</p>
                                                        <input type="number" name="id" id="id" value="{{ $produk->id }}" style="display: none;">
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