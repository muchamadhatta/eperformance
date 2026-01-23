<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\Tautan;
use Carbon\Carbon;

class TautanController extends Controller
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

        $tautans = Tautan::where('status', 1)->where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::tautan.index', compact('tautans'));
    }

    public function create()
    {
        return view('setjenweb::tautan.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_website'] = $this->id_website;
        $tautan = Tautan::create($data);
        return redirect()->route('setjenweb.tautan.edit', ['id' => $tautan->id])
        ->with('success', 'Daftar Tautan berhasil ditambahkan.');

    }

    public function edit($id)
    {
        $tautan = Tautan::findOrFail($id);
        return view('setjenweb::tautan.edit', compact('tautan'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $tautan = Tautan::findOrFail($id);
        $tautan->update($data);

        return redirect()->route('setjenweb.tautan.index')
            ->with('success', 'Daftar Tautan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tautan = Tautan::findOrFail($id);
        $tautan->status = 9;
        $tautan->save();

        return redirect()->route('setjenweb.tautan.index')
            ->with('success', 'Tautan berhasil dihapus.');
    }
}
