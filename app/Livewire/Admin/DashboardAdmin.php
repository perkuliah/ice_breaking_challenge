<?php

namespace App\Livewire\Admin;

use App\Models\Laporan;
use Livewire\Component;

class DashboardAdmin extends Component
{
    public $totalLaporan;
    public $laporanPending;
    public $laporanProses;
    public $laporanSelesai;

    public function mount()
    {
        $this->totalLaporan = Laporan::count();
        $this->laporanPending = Laporan::where('status', 'pending')->count();
        $this->laporanProses = Laporan::where('status', 'diproses')->count();
        $this->laporanSelesai = Laporan::where('status', 'selesai')->count();
    }
    public function render()
    {
        return view('livewire.admin.dashboard-admin');
    }
}
