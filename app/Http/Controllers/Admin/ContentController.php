<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Content::with('menu')->latest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actions = [];
                    $actions['destroy'] = $row->id;
                    
                    return view('admin.layouts.button', $actions);
                })
                ->addColumn('image', function ($row) {
                    if ($row->image) {
                        // Ensure the image URL is properly wrapped in an HTML img tag
                        return '<img src="' . $row->image . '" style="height:50px; width:50px;">';
                    }
                    return 'No image'; // Placeholder or message when no image is available
                })
                
                ->addColumn('content', function ($row) {
                    return $row->content;
                })
                ->rawColumns(['action', 'content', 'image'])
                ->make(true);
        }
        return view('admin.content.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = Menu::all();

        return view('admin.content.create', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_id'  => 'required|unique:contents,menu_id',
            'content'  => 'required|string',
            'image'    => 'mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            if (isset($validated['image'])) {

                $validated['image']->storeAs('public/image', $validated['image']->hashName());
            
                $validated['image'] = $validated['image']->hashName();
            }
            

            Content::create($validated);

            $notification = array(
                'success'   => 'Berhasil tambah konten',
            );


            return redirect()->route('content.index')->with($notification);
        } catch (\Throwable $e) {
            return redirect()->route('content.index')->with(['error' => 'Tambah data gagal! ' . $e->getMessage()]);
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
        $menu   = Menu::all();
        $detail = Content::find($id);

        return view('admin.content.edit', compact('menu', 'detail'));
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
        $request->validate([
            'menu_id'  => 'required|string',
            'content' => 'required|string',
            'url'   => 'required|string'
        ]);

        try {
            $data   = $request->all();
            $detail = Content::find($id);
            $detail->update($data);

            $notification = array(
                'success'   => 'Berhasil update content',
            );


            return redirect()->route('admin.content.index')->with($notification);
        } catch (\Throwable $e) {
            return redirect()->route('admin.content.index')->with(['error' => 'Tambah data gagal! ' . $e->getMessage()]);
        }
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
            $detail =  Content::find($id);
            if ($detail) {
                Storage::disk('local')->delete('public/image/'.basename($detail->image));
                $detail->delete();
            }

            return response()->json(['status' => 'success']);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
