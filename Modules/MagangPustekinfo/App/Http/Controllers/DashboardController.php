<?php

namespace Modules\MagangPustekinfo\App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\MagangPustekinfo\App\Services\PesertaMagangService;

class DashboardController extends Controller
{
    protected $pesertaMagangService;

    public function __construct(PesertaMagangService $pesertaMagangService)
    {
        $this->pesertaMagangService = $pesertaMagangService;
    }

    public function index()
    {
        $stats = $this->pesertaMagangService->getDashboardStats();
        $recentPeserta = $this->pesertaMagangService->getRecentPeserta();

        return view('magangpustekinfo::admin.dashboard.index', compact('stats', 'recentPeserta'));
    }
}
