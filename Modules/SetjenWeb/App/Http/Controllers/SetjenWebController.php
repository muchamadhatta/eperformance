<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Setjen\Agenda;
use App\Models\Setjen\Berita;
use App\Models\Setjen\FotoAlbum;
use App\Models\Setjen\User;
use App\Models\Setjen\Dokumen;



class SetjenWebController extends Controller
{
    protected $id_website;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->id_website = $request->session()->get('id_website');
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $agendas = Agenda::where('id_website', $this->id_website)->orderBy('id', 'desc')->get();
        $beritas = Berita::where('id_website', $this->id_website)->orderBy('id', 'desc')->get();
        $galeris = FotoAlbum::where('id_website', $this->id_website)->orderBy('id', 'desc')->get();
        $pegawais = User::where('id_website', $this->id_website)->orderBy('id', 'desc')->get();
        $publikasis = Dokumen::where('id_website', $this->id_website)->orderBy('id', 'desc')->get();

        return view('setjenweb::index', compact('agendas', 'beritas', 'galeris', 'pegawais', 'publikasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setjenweb::create');
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
        return view('setjenweb::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('setjenweb::edit');
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
