@section('title', 'Laporan Saya')
<div>
    <div class="page-heading">
        <h3>Laporan</h3>
    </div>

    <div class="d-flex justify-content-end align-items-center mb-3">
        <a href="{{ route('user.laporan.create') }}" wire:navigate class="btn btn-primary">Tambah Laporan</a>
    </div>

    <section class="section">
        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    Data Laporan Saya
                </h5>
                <input type="text" wire:model.live="search" class="form-control w-25" placeholder="Cari Laporan...">
            </div>

            <div wire:loading.delay wire:target="search">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div wire:loading.remove wire:target="search">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Tanggal Laporan</th>
                                    <th>Judul Laporan</th>
                                    <th>Pelapor</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporans as $laporan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ $laporan->gambar }}" alt="" class="img-fluid" style="max-width: 80px; height: auto">
                                    </td>
                                    <td>{{ $laporan->tanggal }}</td>
                                    <td>{{ $laporan->judul }}</td>
                                    <td>{{ $laporan->user->name }}</td>
                                    <td>
                                        <span class="badge  
                                                    @if ($laporan->status == 'pending') 
                                                        bg-light-danger 
                                                    @elseif ($laporan->status == 'diproses')
                                                        bg-light-info 
                                                    @else
                                                        bg-light-success
                                                    @endif">
                                            {{ ucwords($laporan->status)  }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <!-- <a href="#" class="btn btn-primary">Detail</a> -->
                                        <a href="{{ route('user.laporan.edit', $laporan->id) }}" wire:navigate class="btn btn-warning">Edit</a>
                                        <button
                                            class="btn btn-danger"
                                            wire:click="deleteConfirm({{ $laporan->id }}, '{{ $laporan->judul }}')"
                                            wire:loading.attr="disabled"
                                            wire:target="deleteConfirm,delete">Hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush