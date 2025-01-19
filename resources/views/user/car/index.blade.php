@extends('user.layouts.app')

@section('styles')
    <style>

    </style>
@endsection

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Car</h1>

        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add Data
                        </button>
                        <br>
                        <br>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('user.car.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="merk" class="form-label">Merk</label>
                                                <input type="text" class="form-control" id="merk" name="merk">
                                            </div>
                                            <div class="mb-3">
                                                <label for="model" class="form-label">Model</label>
                                                <input type="text" class="form-control" id="model" name="model">
                                            </div>
                                            <div class="mb-3">
                                                <label for="plat" class="form-label">Plat</label>
                                                <input type="text" class="form-control" id="plat" name="plat">
                                            </div>
                                            <div class="mb-3">
                                                <label for="tarif" class="form-label">Tarif</label>
                                                <input type="number" class="form-control" id="tarif" name="tarif">
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Merk</th>
                                    <th>Model</th>
                                    <th>Plat</th>
                                    <th>Tarif /hari</th>
                                    <th>Status</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($car as $index => $item)   
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $item->merk }}</td>
                                    <td>{{ $item->model }}</td>
                                    <td>{{ $item->plat }}</td>
                                    <td>Rp {{ number_format($item->tarif, 0, ',', '.') }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <form action="{{ route('user.car.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
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

@section('scripts')
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                "infoEmpty": "Tidak ada data tersedia",
                "paginate": {
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                }
            },
            "paging": true,         // Aktifkan pagination
            "searching": true,      // Aktifkan fitur search
            "ordering": true        // Aktifkan fitur sorting
        });
    });
</script>
@endsection
