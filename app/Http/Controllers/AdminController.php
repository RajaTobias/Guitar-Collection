<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AdminController extends Controller
{
    
    public function create() {
        return view('admin.add');
        }
        public function store(Request $request) {
        $request->validate([
        'ID_GITAR' => 'required',
        'ID_SUPPLIER' => 'required',
        'MERK' => 'required',
        'TIPE' => 'required',
        'WARNA' => 'required',
        'STOK' => 'required',
        'HARGA'=> 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO gitar (ID_GITAR,ID_SUPPLIER,
        MERK, TIPE, WARNA, STOK, HARGA) VALUES
        (:ID_GITAR, :ID_SUPPLIER, :MERK, :TIPE, :WARNA,
        :STOK, :HARGA)',
        [
        'ID_GITAR' => $request->ID_GITAR,
        'ID_SUPPLIER' => $request->ID_SUPPLIER,
        'MERK' => $request->MERK,
        'TIPE' => $request->TIPE,
        'WARNA' => $request->WARNA,
        'STOK' => $request->STOK,
        'HARGA' => $request->HARGA,
        ]
        );
        return redirect()->route('admin.index')->with('success', 'Data Barang berhasil disimpan');
        }

        public function index(Request $request) {
            if ($request->has('search')){
                $datas = DB::select('SELECT G.ID_GITAR, S.NAMA_SUPPLIER, G.MERK, G.TIPE, G.WARNA, G.STOK, G.HARGA
            FROM gitar G LEFT JOIN supplier S
            ON G.ID_SUPPLIER = S.ID_SUPPLIER WHERE G.is_delete = 0 and G.MERK = :search;',[
                'search'=>$request->search
                
            ]);
            return view('admin.index')
            
            ->with('datas', $datas);
            } else {
                $datas = DB::select('SELECT G.ID_GITAR, S.NAMA_SUPPLIER, G.MERK, G.TIPE, G.WARNA, G.STOK, G.HARGA
            FROM gitar G LEFT JOIN supplier S
            ON G.ID_SUPPLIER = S.ID_SUPPLIER WHERE G.is_delete = 0');
            return view('admin.index')
            
            ->with('datas', $datas);
            }
            }

            public function edit($id) {
                $data = DB::table('gitar')->where('ID_GITAR',
                $id)->first();
                return view('admin.edit')->with('data', $data);
                }
                public function update($id, Request $request) {
                $request->validate([
                'ID_GITAR' => 'required',
                'ID_SUPPLIER' => 'required',
                'MERK' => 'required',
                'TIPE' => 'required',
                'WARNA' => 'required',
                'STOK' => 'required',
                'HARGA' => 'required',
                ]);
                // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
                DB::update('UPDATE gitar SET ID_GITAR =
                :ID_GITAR, ID_SUPPLIER = :ID_SUPPLIER, MERK = :MERK, TIPE = :TIPE,
                WARNA = :WARNA, HARGA=:HARGA, STOK = :STOK WHERE ID_GITAR=:id',
                [
                'id' => $id,
                'ID_GITAR' => $request->ID_GITAR,
                'ID_SUPPLIER' => $request->ID_SUPPLIER,
                'MERK' => $request->MERK,
                'TIPE' => $request->TIPE,
                'WARNA' => $request->WARNA,
                'STOK' => $request->STOK,
                'HARGA' => $request->HARGA,
                ]
                );
                return redirect()->route('admin.index')->with('success', 'Data barang berhasil diubah');
                }

                public function delete($id) {
                    // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
                    DB::delete('DELETE FROM gitar WHERE ID_GITAR =
                    :ID_GITAR', ['ID_GITAR' => $id]);
                    return redirect()->route('admin.index')->with('success', 'Data Barang berhasil dihapus');
                    }

                    public function supplier() {
                        $datas = DB::select('SELECT * FROM supplier');
                        return view('admin.sup')
                        
                        ->with('datas', $datas);
                        }

                    public function search(Request $request){
                        // Get the search value from the request
                        $search = $request->input('search');
                    
                        // Search in the title and body columns from the posts table
                        $posts =DB::table('gitar')
                            ->where('Merk', 'LIKE', "%{$search}%")
                            ->orWhere('Tipe', 'LIKE', "%{$search}%")
                            ->get();
                    
                        // Return the search view with the resluts compacted
                        return view('admin.index',['gitar' => $posts]);
                    }
                    public function soft($id)
                    {
                        DB::update('UPDATE gitar SET G.is_delete = 1 WHERE id_gitar = :id_gitar', ['id_gitar' => $id]);

                        return redirect()->route('admin.index')->with('success', 'Data Barang berhasil dihapus');
                    }
}
