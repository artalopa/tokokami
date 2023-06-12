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
                                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <p class="small">Tambah produk baru ke etalase toko</p>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nama produk</label>
                                                    <input id="name" name="name" type="text" class="form-control"
                                                        placeholder="masukkan nama produk" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Deskripsi</label>
                                                    <input id="desc" name="desc" type="text" class="form-control"
                                                        placeholder="masukkan deskripsi singkat">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Harga</label>
                                                    <input id="price" name="price" type="number" class="form-control"
                                                        placeholder="masukkan harga produk" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Kategori</label>
                                                    <select class="custom-select my-1 mr-sm-2" id="category_id"
                                                        name="category_id" required>
                                                        <option selected disabled value=''>Pilih kategori...</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Gambar</label>
                                                    <input id="image" name="image" type="file"
                                                        class="form-control">
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
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama produk</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td><img src="{{ asset('storage/uploads/' . $product->image) }}"
                                                alt="{{ $product->image }}" style="width: 100px;border-radius: 10px"
                                                class="my-2"></td>
                                        <td>{{ $product->name }}</td>
                                        <td>Rp. {{ $product->price }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <button data-toggle="modal" data-target="#ubahProduk-{{ $product->id }}"
                                                    class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <button data-toggle="modal" data-target="#hapusProduk-{{ $product->id }}"
                                                    class="btn btn-link btn-danger" data-original-title="Remove">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>

                                            <!-- modal ubah -->
                                            <div class="modal fade" id="ubahProduk-{{ $product->id }}" tabindex="-1"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                    Ubah produk</span>
                                                                <span class="fw-bold">
                                                                    "{{ $product->name }}"
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form
                                                            action="{{ route('products.update', ['product' => $product->id]) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <p class="small">Ubah produk yang telah terdaftar</p>
                                                                <input type="number" name="id" id="id"
                                                                    value="{{ $product->id }}" style="display: none;">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Nama produk</label>
                                                                            <input id="name" name="name"
                                                                                type="text" class="form-control"
                                                                                placeholder="masukkan nama produk"
                                                                                value="{{ $product->name }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Deskripsi</label>
                                                                            <input id="desc" name="desc"
                                                                                type="text" class="form-control"
                                                                                placeholder="masukkan deskripsi singkat"
                                                                                value="{{ $product->desc }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Harga</label>
                                                                            <input id="price" name="price"
                                                                                type="number" class="form-control"
                                                                                placeholder="masukkan harga produk"
                                                                                value="{{ $product->price }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Kategori</label>
                                                                            <select class="custom-select my-1 mr-sm-2"
                                                                                id="category_id" name="category_id"
                                                                                required>
                                                                                <option disabled>Pilih kategori...</option>
                                                                                @foreach ($categories as $category)
                                                                                    @if ($category->id == $product->category_id)
                                                                                        <option selected
                                                                                            value="{{ $category->id }}">
                                                                                            {{ $category->name }}
                                                                                        </option>
                                                                                    @endif
                                                                                    <option value="{{ $category->id }}">
                                                                                        {{ $category->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Gambar</label>
                                                                            <input id="image" name="image"
                                                                                type="file" class="form-control"
                                                                                placeholder="masukkan gambar produk"
                                                                                value="{{ $product->image }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Gambar saat ini</label>
                                                                            <input type="text" name="currentImage"
                                                                                value="{{ $product->image }}"
                                                                                style="display: none">
                                                                            <img src="{{ asset('storage/uploads/' . $product->image) }}"
                                                                                alt="{{ $product->image }}"
                                                                                style="width: 100px;border-radius: 10px"
                                                                                class="my-2">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer no-bd">
                                                                <input type="submit" class="btn btn-primary"
                                                                    value="Ubah">

                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- modal hapus -->
                                            <div class="modal fade" id="hapusProduk-{{ $product->id }}" tabindex="-1"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                    Hapus produk</span>
                                                                <span class="fw-bold">
                                                                    "{{ $product->name }}"
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form
                                                            action="{{ route('products.destroy', ['product' => $product->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-body">
                                                                <p class="small">Yakin ingin menghapus produk
                                                                    "{{ $product->name }}"?</p>
                                                                <input type="number" name="id" id="id"
                                                                    value="{{ $product->id }}" style="display: none;">
                                                            </div>
                                                            <div class="modal-footer no-bd">
                                                                <input type="submit" class="btn btn-primary"
                                                                    value="Hapus">

                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Close</button>
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
