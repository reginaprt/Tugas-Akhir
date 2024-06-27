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
            'energi' => 'required|numeric',
            'protein' => 'required|numeric',
            'lemak' => 'required|numeric',
            'karbo' => 'required|numeric',
            'bahan' => 'required',
            'cara' => 'required',
        ]);

        $menu = new Menu;

        $menu->nama = $req->get('nama');
        $menu->energi = $req->get('energi');
        $menu->protein = $req->get('protein');
        $menu->lemak = $req->get('lemak');
        $menu->karbo = $req->get('karbo');
        $menu->bahan = $req->input('bahan');
        $menu->cara = $req->input('cara');

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
            'energi' => 'sometimes|required|numeric',
            'protein' => 'sometimes|required|numeric',
            'lemak' => 'sometimes|required|numeric',
            'karbo' => 'sometimes|required|numeric',
            'bahan' => 'sometimes|required',
            'cara' => 'sometimes|required',
        ]);

        $menu->nama = $req->get('nama');
        $menu->energi = $req->get('energi');
        $menu->protein = $req->get('protein');
        $menu->lemak = $req->get('lemak');
        $menu->karbo = $req->get('karbo');
        $menu->bahan = $req->input('bahan');
        $menu->cara = $req->input('cara');

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
