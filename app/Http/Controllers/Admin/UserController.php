<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('roles')->latest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actions = [];
                    if (!$row->email_verified_at) {
                        $actions['approve'] = route('users.active', $row->id);
                    }
                    $actions['destroy'] = [
                        'id' => $row->id,
                        'name' => $row->name
                    ];
                    
                    return view('admin.layouts.button', $actions);
                }) 
                ->addColumn('status', function ($row) {
                    if ($row->email_verified_at) {
                        return '<span class="badge badge-success">Aktif</span>';
                    }else{
                        return '<span class="badge badge-danger">Tidak Aktif</span>';
                    }
                }) 
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'email'     => 'required|string|email|unique:users,email',
            'name'      => 'required|string',
            'phone'     => 'required|string|max:15'
        ]);

        try {
            $data = $request->all();
            $data['password'] = bcrypt('cobadiuji');
            $user = User::create($data);

            $user->assignRole('user');

            $notification = array(
                'success'   => 'Berhasil tambah user dengan nama '.$request->input('name'),
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
            $users =  User::find($id);
            if ($users) {
                $users->delete();
            }

            return response()->json(['status' => 'success']);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function active($id){
        $user = User::find($id);
        $user->email_verified_at = Carbon::now();
        $user->save();

        $notification = array(
            'success'   => 'Berhasil aktivasi user dengan nama '.$user->name
        );

        return redirect()->back()->with($notification);
    }
}
