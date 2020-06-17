<?php

namespace App\Http\Controllers\Pegawai;

use Illuminate\Http\Request;
use DB;


class JabatanController{

    public function getAllJabatan(Request $request){
        $columns = array(
            0 =>'id',
            1 =>'id',
            2 =>'jabatan',
            3 =>'gaji',
            4 =>'keterangan'
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        
        if(empty($request->input('search.value'))){
            $data_search = DB::table('jabatan')->orderBy($order, $dir);
        }else{
            $search = $request->input('search.value');
            $data_search = DB::table('jabatan')
            ->where('id', 'like', "%{$search}%")
            ->orWhere('gaji', 'like', "%{$search}%")
            ->orWhere('keterangan', 'like', "%{$search}%")
            ->orderBy($order, $dir);
        }


        $totaldata = count($data_search->get());
        $posts = $data_search
                    ->offset($start)
                    ->limit($limit)
                    ->get();
        $totalFiltered = $totaldata;

        $data = array();
        if($posts){
            foreach($posts as $row){

                $nestedData['action'] =  "<button class='btn btn-outline-warning btn-sm' 
                                            onClick=\"setData('$row->id','$row->jabatan','$row->gaji','$row->keterangan')\"
                                            data-toggle='modal' data-target='#updateData'>Edit</button>
                                            <button class='btn btn-outline-danger btn-sm' onClick=\"hapusData('$row->id')\">Hapus</button>
                                            ";
                $nestedData['id'] =  $row->id;
                $nestedData['jabatan'] =  $row->jabatan;
                $nestedData['gaji'] =  $row->gaji;
                $nestedData['keterangan'] =  $row->keterangan;
                $data[] = $nestedData;
            }
        }
        echo json_encode(array(
            "draw"              => intval($request->input('draw')),
            "recordsTotal"      => intval($totaldata),
            "recordsFiltered"   => intval($totalFiltered),
            "data"              => $data
        ));
    }
    public function insertJabatan(Request $request){
        $respError = FALSE;
        $respMesssage = '';

        $result = DB::table('jabatan')->insert([
            'jabatan' => $request->jabatan,
            'gaji' => $request->gaji,
            'keterangan' => $request->keterangan
        ]);

        if($result){
            $respError = TRUE;
            $respMesssage = 'Input data jabatan berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat input data';
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
    public function updateJabatan(Request $request){

        $respError = FALSE;
        $respMesssage = '';
        $result = DB::table('jabatan')->where('id', $request->id)->update([
            'jabatan' => $request->jabatan,
            'gaji' => $request->gaji,
            'keterangan' => $request->keterangan
        ]);

        if($result){
            $respError = TRUE;
            $respMesssage = 'Update data jabatan berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat update data';
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
    public function deleteJabatan($id){
        $respError = FALSE;
        $respMesssage = '';
        $result = DB::table('jabatan')->where('id', $id)->delete();
        if($result){
            $respError = TRUE;
            $respMesssage = 'Hapus data jabatan berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat hapus data';
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
}