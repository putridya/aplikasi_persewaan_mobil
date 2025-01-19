@extends('user.layouts.app')

@section('styles')
    <style>

    </style>
@endsection

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Sewa</h1>

        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Sewa
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal123">
                            Pengembalian
                        </button>
                        <br>
                        <br>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('user.transaction.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="customer" class="form-label">Customer</label>
                                                <select name="customer_id" class="form-control" id="customer_id">
                                                    <option value="">--Pilih customer--</option>
                                                    @foreach ($customer as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name_customer }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="customer" class="form-label">Mobil</label>
                                                <select name="car_id" class="form-control" id="car_id">
                                                    <option value="">--Pilih Mobil--</option>
                                                    @foreach ($car as $item)
                                                        <option value="{{ $item->id }}">{{ $item->model }} - {{ $item->merk }} - Rp {{ number_format($item->tarif, 0, ',', '.') }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="start_date" class="form-label">Start Date</label>
                                                <input type="date" class="form-control" id="start_date" name="start_date">
                                            </div>
                                            <div class="mb-3">
                                                <label for="end_date" class="form-label">End Date</label>
                                                <input type="date" class="form-control" id="end_date" name="end_date">
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


                        {{-- PENGEMBALIAN --}}
                        <div class="modal fade" id="exampleModal123" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('user.transaction.returned') }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="customer" class="form-label">Plat</label>
                                                <select name="id" class="form-control" id="id">
                                                    <option value="">--Pilih Plat--</option>
                                                    @foreach ($rental as $item)
                                                        <option value="{{ $item->id }}">{{ $item->car->plat }} - {{ $item->car->merk }}</option>
                                                    @endforeach
                                                </select>
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
                                    <th>Customer</th>
                                    <th>Mobil</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Jumlah Hari</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rental as $index => $item)   
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $item->customer->name_customer }}</td>
                                    <td>{{ $item->car->merk }} - {{ $item->car->model }}</td>
                                    <td>{{ $item->start_date }}</td>
                                    <td>{{ $item->end_date }}</td>
                                    @php
                                        $start = Carbon\Carbon::parse($item->start_date);
                                        $end = Carbon\Carbon::parse($item->end_date);
                                        $total_days = $start->diffInDays($end);
                                    @endphp 
                                    <td>{{ $total_days }} Hari</td>
                                    <td>Rp {{ number_format($item->total_price, 0, ',', '.') }}</td>
                                    <td>{{ $item->is_returned == 1 ? 'Disewa' : 'Dikembalikan' }}</td>
                                    <td>
                                        <form action="{{ route('user.transaction.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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

    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Pengembalian</h1>

        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-body">
                        
                        <table id="example2" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Customer</th>
                                    <th>Mobil</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Jumlah Hari</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengembalian as $index => $item)   
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $item->customer->name_customer }}</td>
                                    <td>{{ $item->car->merk }} - {{ $item->car->model }}</td>
                                    <td>{{ $item->start_date }}</td>
                                    <td>{{ $item->end_date }}</td>
                                    @php
                                        $start = Carbon\Carbon::parse($item->start_date);
                                        $end = Carbon\Carbon::parse($item->end_date);
                                        $total_days = $start->diffInDays($end);
                                    @endphp 
                                    <td>{{ $total_days }} Hari</td>
                                    <td>Rp {{ number_format($item->total_price, 0, ',', '.') }}</td>
                                    <td>{{ $item->is_returned == 1 ? 'Disewa' : 'Dikembalikan' }}</td>
                                    <td>
                                        <form action="{{ route('user.transaction.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
    $(document).ready(function () {
        $('#example2').DataTable({
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
