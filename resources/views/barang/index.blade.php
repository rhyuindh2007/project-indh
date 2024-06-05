@extends('layouts.template')
@section('tambahanCSS')
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Toastr -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
@endsection
	
@section('judulh1','Admin - Barang')

@section('konten')



<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h2 class="card-title">Data Barang</h2>
            <a type="button" class="btn btn-success float-right" href="{{ route('barang.create') }}">
                <i class=" fas fa-plus"></i> Tambah Barang
            </a>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Stock</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($data as $dt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dt->barang }}</td>
                        <td>{{ $dt->stock }}</td>
                        <td>{{ $dt->harga }}</td>
                        <td>{{ $dt->description }}</td>
                        <td>
                            <div class="btn-group">
                                <form action="{{ route('barang.destroy',$dt->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class=" fas fa-trash"></i>
                                    </button>

                                </form>

                                <a type="button" class="btn btn-warning" href="{{ route('barang.edit',$dt->id) }}">
                                    <i class=" fas fa-edit"></i>
                                </a>
                                <a type="button" class="btn btn-success" href="{{ route('barang.show',$dt->id) }}">
                                    <i class=" fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection