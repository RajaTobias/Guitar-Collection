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

        <h5 class="card-title fw-bolder mb-3">Ubah Data Supplier</h5>

		<form method="post" action="{{ route('sup.update', $data->ID_SUPPLIER) }}">
			@csrf
            <div class="mb-3">
                <label for="ID_SUPPLIER" class="form-label">ID Supplier</label>
                <input type="text" class="form-control" id="ID_SUPPLIER" name="ID_SUPPLIER">
            </div>
			<div class="mb-3">
                <label for="NAMA_SUPPLIER" class="form-label">Nama Supplier</label>
                <input type="text" class="form-control" id="NAMA_SUPPLIER" name="NAMA_SUPPLIER">
            </div>
            <div class="mb-3">
                <label for="ALAMAT" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="ALAMAT" name="ALAMAT">
            </div>
            <div class="mb-3">
                <label for="NO_TELEPON" class="form-label">No. Telepon</label>
                <input type="text" class="form-control" id="NO_TELEPON" name="NO_TELEPON">
            </div>
            <div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
		</form>
	</div>
</div>

@stop