<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    // Menu Index ------------------------------------------------------------------------------------------------------
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menu', compact('menus'));
    }

    // Menu Create -----------------------------------------------------------------------------------------------------
    public function create(Request $req)
    {
        $validated = $req->validate([
            'nama' => 'required|max:50',
            'energi' => 'required|integer',
            'protein' => 'required|integer',
            'lemak' => 'required|integer',
            'karbo' => 'required|integer',
            'resep' => 'required',
        ]);

        $menu = new Menu;

        $menu->nama = $req->get('nama');
        $menu->energi = $req->get('energi');
        $menu->protein = $req->get('protein');
        $menu->lemak = $req->get('lemak');
        $menu->karbo = $req->get('karbo');
        $menu->resep = $req->input('resep');

        $menu->save();

        $notification = array(
            'message' => 'Menu Makanan Berhasil di Tambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.menu')->with($notification);
    }

    // Menu Get -------------------------------------------------------------------------------------------------------
    public function dataMenu($id)
    {
        $menu = Menu::find($id);

        return response()->json($menu);
    }

    // Menu Update ----------------------------------------------------------------------------------------------------
    public function update(Request $req)
    {
        $menu = Menu::find($req->get('id'));

        if (!$menu) {
            return redirect()->route('admin.menu')->with('error', 'Menu not found');
        }

        $validated = $req->validate([
            'nama' => 'sometimes|required|max:50',
            'energi' => 'sometimes|required|integer',
            'protein' => 'sometimes|required|integer',
            'lemak' => 'sometimes|required|integer',
            'karbo' => 'sometimes|required|integer',
            'resep' => 'sometimes|required',
        ]);

        $menu->nama = $req->get('nama');
        $menu->energi = $req->get('energi');
        $menu->protein = $req->get('protein');
        $menu->lemak = $req->get('lemak');
        $menu->karbo = $req->get('karbo');
        $menu->resep = $req->input('resep');

        $menu->save();

        $notification = array(
            'message' => 'Menu Makanan Berhasil di Ubah',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.menu')->with($notification);
    }

    // Menu Delete ----------------------------------------------------------------------------------------------------
    public function delete($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return redirect()->route('admin.menu')->with('error', 'Menu not found');
        }

        $menu->delete();

        $success = true;
        $message = "Menu Makanan Berhasil di Hapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
