<?php

namespace App\Http\Controllers;

use App\Titulare;
use App\Documento;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use DB;


class TitularController extends Controller
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
        $doc = Documento::orderBy('documento','ASC')->get();
        if ($request->ajax()) {
            $data = DB::select('SELECT t.id,t.nom_tit,t.id_doc_tit,t.doc_tit,t.tel_tit,t.email_tit,t.id_user_mod,d.documento as documentot from titulares t JOIN documentos d on t.id_doc_tit = d.id order By t.nom_tit ');
            // $data = Titulare::orderBy('nom_tit','ASC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                         $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="view" class="btn btn-secondary btn-sm view-titular" title="Ver"><i class="fas fa-eye"></i></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-titular" title="Modificar"><i class="fas fa-pencil-square-o"></i></a>';
                        // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-banco"><i class="fas fa-trash"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
                    }
        $titulo='Titulares';
        return view('titulares.index',compact('data','titulo','doc'));
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
Titulare::updateOrCreate(['id' => $uId],['nom_tit' => $request->nom_tit,'id_doc_tit' => $request->id_doc_tit,'doc_tit' => $request->doc_tit,'tel_tit' => $request->tel_tit,'email_tit'=> $request->email_tit, 'id_user_mod' => $user_mod]);
if(empty($request->id))
    $msg = 'User created successfully.';
    else
    $msg = 'User data is updated successfully';
    return redirect()->route('bancos.index')->with('success',$msg);
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // $where = array('id' => $id);
        // $data = Titulare::where($where)->first();
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
        // $where = array('id' => $id);
        // $data = Titulare::where($where)->first();
         $data = DB::select ('SELECT t.id,t.nom_tit,t.id_doc_tit,t.doc_tit,t.tel_tit,t.email_tit,t.id_user_mod,d.documento from titulares t JOIN documentos d on d.id = t.id_doc_tit where t.id =?',[$id]);

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
