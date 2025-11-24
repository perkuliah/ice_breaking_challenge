<?php

namespace App\Livewire\Dashboard;

use App\Models\Laporan;
use Livewire\Component;

class Home extends Component
{
    public $totalLaporan;

    protected $listeners = [
        'laporanCreated' => 'mount',
        'laporanUpdated' => 'mount',
        'laporanDeleted' => 'mount',
    ];

    public function mount()
    {
        $this->totalLaporan = Laporan::count();
    }

    public function render()
    {
        return view('livewire.dashboard.home', [
            'laporanPending' => Laporan::where('status', 'pending')->count(),
            'laporanProses' => Laporan::where('status', 'proses')->count(),
            'laporanSelesai' => Laporan::where('status', 'selesai')->count(),
        ]);
    }
}
