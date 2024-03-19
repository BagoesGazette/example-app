<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actions = [];
                    $actions['destroy'] = [
                        'id' => $row->id,
                        'name' => $row->name
                    ];
                    
                    return view('admin.layouts.button', $actions);
                }) 
                ->addColumn('status', function ($row) {
                    if ($row->is_active) {
                        return '<span class="badge badge-success">Aktif</span>';
                    }else{
                        return '<span class="badge badge-danger">Tidak Aktif</span>';
                    }
                }) 
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'price'     => 'required|string|max:15',
            'image'     => 'required',
            'is_active' => 'required',
        ]);

        try {
            $data   = $request->all();
            $image  = $request->file('image');
            $image->storeAs('public/product', $image->hashName());
            $data['image'] = $image->hashName();
            Product::create($data);

            $notification = array(
                'success'   => 'Berhasil tambah produk',
            );

            return redirect()->back()->with($notification);
        } catch (\Throwable $e) {
            return redirect()->route('login')->with(['error' => 'Tambah data gagal! ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product =  Product::find($id);
            if ($product) {
                Storage::disk('local')->delete('public/product/'.basename($product->image));
                $product->delete();
            }

            return response()->json(['status' => 'success']);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
