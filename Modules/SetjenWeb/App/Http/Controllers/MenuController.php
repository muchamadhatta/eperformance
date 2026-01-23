<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\Menu;

class MenuController extends Controller
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
        $menus = Menu::where('status', 1)->orderBy('id', 'asc')->get();
        return view('setjenweb::menu.index', compact('menus'));
    }

    public function create()
    {
        return view('setjenweb::menu.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $menu = Menu::create($data);
        return redirect()->route('setjenweb.menu.edit', ['id' => $menu->id])
        ->with('success', 'Daftar Menu berhasil ditambahkan.');

    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('setjenweb::menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $menu = Menu::findOrFail($id);
        $menu->update($data);

        return redirect()->route('setjenweb.menu.index')
            ->with('success', 'Daftar Menu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->status = 9;
        $menu->save();

        return redirect()->route('setjenweb.menu.index')
            ->with('success', 'Menu berhasil dihapus.');
    }
}
