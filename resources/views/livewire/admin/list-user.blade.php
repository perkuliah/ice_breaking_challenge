@section('title', 'Data Pengguna')
<div>
    <div class="page-heading">
        <h3>Data Pengguna</h3>
    </div>

    <section class="section">
        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    List Pengguna
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
                        <table class="table table-striped text-center" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama Lengkap</th>
                                    <th>WhatsApp</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th class="text-center">Laporan</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($user->foto == null)
                                        <img src="https://ui-avatars.com/api/?name={{ $user->name }}" alt="{{ $user->name }}" class="img-fluid" style="max-width: 80px; height: auto">
                                        @else
                                        <img src="{{ asset('storage/users/' . $user->foto) }}" alt="{{ $user->name }}" class="img-fluid" style="max-width: 80px; height: auto">
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->whatsapp }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td class="text-center">{{ $user->laporans_count }}</td>
                                    <td class="text-center">
                                        <!-- <a href="#" wire:navigate class="btn btn-warning">Edit</a> -->
                                        <button
                                            class="btn btn-danger"
                                            wire:click="resetPassword({{ $user->id }}, '{{ $user->name }}')"
                                            wire:loading.attr="disabled"
                                            wire:target="resetPassword,resetDefault">Reset Password</button>
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