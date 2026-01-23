<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\Agenda;
use App\Models\Setjen\TujuanAgenda;
use Carbon\Carbon;

class AgendaController extends Controller
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

        $agendas = Agenda::where('status', 1)->where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::agenda.index', compact('agendas'));
    }

    public function create()
    {
        $tujuan_agendas = TujuanAgenda::where('status', 1)->where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::agenda.create', compact('tujuan_agendas'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');
        $data['id_website'] = $this->id_website;
        $agenda = Agenda::create($data);
        return redirect()->route('setjenweb.agenda.edit', ['id' => $agenda->id])
        ->with('success', 'Daftar Agenda berhasil ditambahkan.');

    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        $tujuan_agendas = TujuanAgenda::where('status', 1)->where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::agenda.edit', compact('agenda', 'tujuan_agendas'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        // dd($data);
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

        $agenda = Agenda::findOrFail($id);
        $agenda->update($data);

        return redirect()->route('setjenweb.agenda.index')
            ->with('success', 'Daftar Agenda berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->status = 9;
        $agenda->save();

        return redirect()->route('setjenweb.agenda.index')
            ->with('success', 'Agenda berhasil dihapus.');
    }
}
