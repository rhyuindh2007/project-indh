@extends('layouts.template')
@section('judulh1','Admin - Barang')

@section('konten')
<div class="col-md-6">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>	
    </div>
    @endif

    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Barang</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('barang.update',$barang->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                    <label for="nama">Barang</label>
                    <input type="text" class="form-control" id="barang" name="barang" value="{{$barang->nama}}">
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{$barang->stock}}">
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="{{$barang->harga}}">
                </div>
                <div class=" form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" class=" form-control"
                        rows="4">{{ $barang->description }}</textarea>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-warning float-right">Ubah</button>
            </div>
        </form>
    </div>
</div>

@endsection