<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SupController extends Controller
{
    
    public function create() {
        return view('sup.add');
        }
        public function store(Request $request) {
        $request->validate([
        'ID_SUPPLIER' => 'required',
        'NAMA_SUPPLIER' => 'required',
        'ALAMAT' => 'required',
        'NO_TELEPON' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO supplier (ID_SUPPLIER,NAMA_SUPPLIER,
        ALAMAT, NO_TELEPON) VALUES
        (:ID_SUPPLIER, :NAMA_SUPPLIER, :ALAMAT, :NO_TELEPON)',
        [
        'ID_SUPPLIER' => $request->ID_SUPPLIER,
        'NAMA_SUPPLIER' => $request->NAMA_SUPPLIER,
        'ALAMAT' => $request->ALAMAT,
        'NO_TELEPON' => $request->NO_TELEPON,
        ]
        );
        return redirect()->route('sup.index')->with('success', 'Data supplier berhasil disimpan');
        }
    
        public function index(Request $request) {
            if ($request->has('search')){
                $datas = DB::select('SELECT * FROM supplier WHERE is_delete = 0 and ID_SUPPLIER = :search;',[
                'search'=>$request->search
                
            ]);
            return view('sup.index')
            
            ->with('datas', $datas);
            } else {
                $datas = DB::select('SELECT * FROM supplier WHERE is_delete = 0');
            return view('sup.index')
            
            ->with('datas', $datas);
            }
            }

            public function edit($id) {
                $data = DB::table('supplier')->where('ID_SUPPLIER',
                $id)->first();
                return view('sup.edit')->with('data', $data);
                }
                public function update($id, Request $request) {
                $request->validate([
                'ID_SUPPLIER' => 'required',
                'NAMA_SUPPLIER' => 'required',
                'ALAMAT' => 'required',
                'NO_TELEPON' => 'required',
                ]);
                // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
                DB::update('UPDATE supplier SET ID_SUPPLIER =
                :ID_SUPPLIER, NAMA_SUPPLIER = :NAMA_SUPPLIER, ALAMAT = :ALAMAT, NO_TELEPON = :NO_TELEPON WHERE ID_SUPPLIER=:id',
                [
                'id' => $id,
                'ID_SUPPLIER' => $request->ID_SUPPLIER,
                'NAMA_SUPPLIER' => $request->NAMA_SUPPLIER,
                'ALAMAT' => $request->ALAMAT,
                'NO_TELEPON' => $request->NO_TELEPON,
                ]
                );
                return redirect()->route('sup.index')->with('success', 'Data supplier berhasil diubah');
                }

                public function delete($id) {
                    // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
                    DB::delete('DELETE FROM supplier WHERE ID_SUPPLIER =
                    :ID_SUPPLIER', ['ID_SUPPLIER' => $id]);
                    return redirect()->route('sup.index')->with('success', 'Data supplier berhasil dihapus');
                    }

                    public function soft($id)
                    {
                        DB::update('UPDATE supplier SET is_delete = 1 WHERE ID_SUPPLIER = :ID_SUPPLIER', ['ID_SUPPLIER' => $id]);

                        return redirect()->route('sup.index')->with('success', 'Data supplier berhasil dihapus');
                    }
}
