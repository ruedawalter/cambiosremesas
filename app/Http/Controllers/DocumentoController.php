<?php

namespace App\Http\Controllers;

use App\Documento;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;


class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response

     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Documento::orderBy('documento','ASC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                         $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="view" class="btn btn-secondary btn-sm view-documento" title="Ver"><i class="fas fa-eye"></i></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-documento" title="Modificar"><i class="fas fa-pencil-square-o"></i></a>';
                        // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-banco"><i class="fas fa-trash"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
                    }
        $titulo='Documentos';
        return view('documentos.index',compact('data','titulo'));
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
        // $r=$request->validate([
        //     'nom_banco' => 'required',
        // ]);

$uId = $request->id;
$user_mod = Auth::id();
Documento::updateOrCreate(['id' => $uId],['documento' => $request->documento, 'id_user_mod' => $user_mod]);
if(empty($request->id))
    $msg = 'User created successfully.';
    else
    $msg = 'User data is updated successfully';
    return redirect()->route('documentos.index')->with('success',$msg);
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $where = array('id' => $id);
        $data = Documento::where($where)->first();
        return Response::json($data);
//return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $data = Documento::where($where)->first();
        return response()->json($data);
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
        //
    }
}
