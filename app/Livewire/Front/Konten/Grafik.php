<?php

namespace App\Livewire\Front\Konten;

use App\Models\Laporan;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.front')]
class Grafik extends Component
{
    public $totalLaporan;
    public $laporanPending;
    public $laporanProses;
    public $laporanSelesai;
    public $laporanPerBulan;

    public function mount()
    {
        $this->totalLaporan = Laporan::count();
        $this->laporanPending = Laporan::where('status', 'pending')->count();
        $this->laporanProses = Laporan::where('status', 'diproses')->count();
        $this->laporanSelesai = Laporan::where('status', 'selesai')->count();

        $this->laporanPerBulan = Laporan::whereYear('tanggal', now()->year)
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->tanggal)->format('m');
            })
            ->map->count()
            ->toArray();
    }
    public function render()
    {
        return view('livewire.front.konten.grafik');
    }
}
