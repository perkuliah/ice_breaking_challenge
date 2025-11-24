<div>
    @auth
        @if(auth()->user()->role == 'user')            
            <livewire:user.create-laporan/>
        @else
            Anda Admin Tidak Perlu Membuat Laporan
        @endif
    @else
        <div class="text-center">
            <a href="{{ route('login') }}" class="btn btn-primary">Login Untuk Membuat Laporan</a>
        </div>
    @endauth
</div>