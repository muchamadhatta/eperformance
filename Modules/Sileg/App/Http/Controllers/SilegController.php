<?php

namespace Modules\Sileg\App\Http\Controllers;

// use App\Models\Sileg\Komisi; //belum ada model
// use App\Models\Sileg\Fraksi; //belum ada model
use App\Models\Sileg\Masyarakat;
use App\Models\Sileg\Pemerintah;
use App\Models\Sileg\Dpd;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SilegController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $komisis = Masyarakat::where('status', 1)->orderBy('id', 'desc')->get();
        $fraksis = Masyarakat::where('status', 1)->orderBy('id', 'desc')->get();
        $masyarakats = Masyarakat::where('status', 1)->orderBy('id', 'desc')->get();
        $pemerintahs = Pemerintah::where('status', 1)->orderBy('id', 'desc')->get();
        $dpds = Dpd::where('status', 1)->orderBy('id', 'desc')->get();

        $models = [
            $komisis,
            $fraksis,
            $masyarakats,
            $pemerintahs,
            $dpds
        ];

        return view('sileg::index', compact('komisis', 'fraksis', 'masyarakats', 'pemerintahs', 'dpds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sileg::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('sileg::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('sileg::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
