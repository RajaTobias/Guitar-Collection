@extends('admin.layout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
	<div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Ubah Data Barang</h5>

		<form method="post" action="{{ route('admin.update', $data->ID_GITAR) }}">
			@csrf
            <div class="mb-3">
                <label for="ID_GITAR" class="form-label">ID Gitar</label>
                <input type="text" class="form-control" id="ID_GITAR" name="ID_GITAR" value="{{ $data->ID_GITAR }}">
            </div>
            <div class="mb-3">
                <label for="ID_SUPPLIER" class="form-label">ID Supplier</label>
                <input type="text" class="form-control" id="ID_SUPPLIER" name="ID_SUPPLIER">
            </div>
			<div class="mb-3">
                <label for="MERK" class="form-label">Merk</label>
                <input type="text" class="form-control" id="MERK" name="MERK" value="{{ $data->MERK }}">
            </div>
            <div class="mb-3">
                <label for="TIPE" class="form-label">Tipe</label>
                <input type="text" class="form-control" id="TIPE" name="TIPE" value="{{ $data->TIPE }}">
            </div>
            <div class="mb-3">
                <label for="WARNA" class="form-label">Warna</label>
                <input type="text" class="form-control" id="WARNA" name="WARNA" value="{{ $data->WARNA }}">
            </div>
            <div class="mb-3">
                <label for="STOK" class="form-label">Stok</label>
                <input type="text" class="form-control" id="STOK" name="STOK">
            </div>
            <div class="mb-3">
                <label for="HARGA" class="form-label">Harga</label>
                <input type="text" class="form-control" id="HARGA" name="HARGA">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
            
		</form>
	</div>
</div>

@stop