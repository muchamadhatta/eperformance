<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\WebsiteMenu;
use App\Models\Setjen\Menu;

class WebsiteMenuController extends Controller
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
        $website_menus = WebsiteMenu::where('status', 1)->where('id_website', $this->id_website)->where('type', 'link')->orderBy('id', 'asc')->get();
        return view('setjenweb::website_menu.index', compact('website_menus'));
    }

    public function create()
    {
        return view('setjenweb::website_menu.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $website_menu = WebsiteMenu::create($data);
        return redirect()->route('setjenweb.website_menu.edit', ['id' => $website_menu->id])
        ->with('success', 'Daftar Menu Website berhasil ditambahkan.');

    }

    public function edit($id)
    {
        $website_menu = WebsiteMenu::findOrFail($id);
        $menus = Menu::where('status', 1)->get();
        return view('setjenweb::website_menu.edit', compact('website_menu', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $website_menu = WebsiteMenu::findOrFail($id);
        $website_menu->update($data);

        return redirect()->route('setjenweb.website_menu.index')
            ->with('success', 'Daftar Menu Website berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $website_menu = WebsiteMenu::findOrFail($id);
        $website_menu->status = 9;
        $website_menu->save();

        return redirect()->route('setjenweb.website_menu.index')
            ->with('success', 'Menu Website berhasil dihapus.');
    }
}
