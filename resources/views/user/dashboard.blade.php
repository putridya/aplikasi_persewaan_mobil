@extends('user.layouts.app')

@section('styles')
@endsection

@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Sewa</h1>

    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-body">
                    
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
