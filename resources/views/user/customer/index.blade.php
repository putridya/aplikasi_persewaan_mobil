@extends('user.layouts.app')

@section('styles')
    <style>

    </style>
@endsection

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Customers</h1>

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
                                    <form action="{{ route('user.customer.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="merk" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="name_customer" name="name_customer">
                                            </div>
                                            <div class="mb-3">
                                                <label for="model" class="form-label">Alamat</label>
                                                <input type="text" class="form-control" id="address_customer" name="address_customer">
                                            </div>
                                            <div class="mb-3">
                                                <label for="plat" class="form-label">No Telepon</label>
                                                <input type="text" class="form-control" id="telephone_number" name="telephone_number">
                                            </div>
                                            <div class="mb-3">
                                                <label for="tarif" class="form-label">Nomor SIM</label>
                                                <input type="number" class="form-control" id="sim_number" name="sim_number">
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
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Nomor Telepon</th>
                                    <th>Nomor SIM</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer as $index => $item)   
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $item->name_customer }}</td>
                                    <td>{{ $item->address_customer }}</td>
                                    <td>{{ $item->telephone_number }}</td>
                                    <td>{{ $item->sim_number }}</td>
                                    <td>
                                        <form action="{{ route('user.customer.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
