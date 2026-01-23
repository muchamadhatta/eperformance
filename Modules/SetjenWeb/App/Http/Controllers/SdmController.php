<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\Sdm;
use App\Models\Setjen\Menu;
use Carbon\Carbon;

class SdmController extends Controller
{
    protected $id_website;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->id_website = $request->session()->get('id_website');
            return $next($request);
        });
    }

    public function index()
    {

        $sdms = Sdm::where('status', 1)->where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::sdm.index', compact('sdms'));
    }

    public function create()
    {
        $menus = Menu::where('status', 1)->orderBy('id', 'asc')->get();
        return view('setjenweb::sdm.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_website'] = $this->id_website;
        $sdm = Sdm::create($data);
        return redirect()->route('setjenweb.sdm.edit', ['id' => $sdm->id])
        ->with('success', 'Daftar SDM berhasil ditambahkan.');

    }

    public function edit($id)
    {
        $sdm = Sdm::findOrFail($id);
        $menus = Menu::where('status', 1)->orderBy('id', 'asc')->get();
        return view('setjenweb::sdm.edit', compact('sdm', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $sdm = Sdm::findOrFail($id);
        $sdm->update($data);

        return redirect()->route('setjenweb.sdm.index')
            ->with('success', 'Daftar SDM berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sdm = Sdm::findOrFail($id);
        $sdm->status = 9;
        $sdm->save();

        return redirect()->route('setjenweb.sdm.index')
            ->with('success', 'SDM berhasil dihapus.');
    }
}
