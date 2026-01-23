<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\Polls;
use Illuminate\Support\Facades\File;


class PollsController extends Controller
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
        $pollss = Polls::where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::polls.index', compact('pollss'));
    }

    public function create()
    {
        return view('setjenweb::polls.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_website'] = $this->id_website;

        $polls = Polls::create($data);
        return redirect()->route('setjenweb.polls.edit', ['id' => $polls->id])
            ->with('success', 'Daftar Polls berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $polls = Polls::findOrFail($id);
        return view('setjenweb::polls.edit', compact('polls'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();

        $polls = Polls::findOrFail($id);
        $polls->update($data);

        return redirect()->route('setjenweb.polls.index')
            ->with('success', 'Polls berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $polls = Polls::findOrFail($id);
        $polls->delete();

        return redirect()->route('setjenweb.polls.index')
            ->with('success', 'Polls berhasil dihapus.');
    }

}


