<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\TujuanAgenda;

class TujuanAgendaController extends Controller
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
        $tujuan_agendas = TujuanAgenda::where('status', 1)->where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::tujuan_agenda.index', compact('tujuan_agendas'));
    }

    public function create()
    {
        return view('setjenweb::tujuan_agenda.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_website'] = $this->id_website;

        $tujuan_agenda = TujuanAgenda::create($data);
        return redirect()->route('setjenweb.tujuan_agenda.edit', ['id' => $tujuan_agenda->id])
        ->with('success', 'Daftar Tujuan Agenda berhasil ditambahkan.');

    }

    public function edit($id)
    {
        $tujuan_agenda = TujuanAgenda::findOrFail($id);
        return view('setjenweb::tujuan_agenda.edit', compact('tujuan_agenda'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $tujuan_agenda = TujuanAgenda::findOrFail($id);
        $tujuan_agenda->update($data);

        return redirect()->route('setjenweb.tujuan_agenda.index')
            ->with('success', 'Daftar Tujuan Agenda berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tujuan_agenda = TujuanAgenda::findOrFail($id);
        $tujuan_agenda->status = 9;
        $tujuan_agenda->save();

        return redirect()->route('setjenweb.tujuan_agenda.index')
            ->with('success', 'Tujuan Agenda berhasil dihapus.');
    }
}
