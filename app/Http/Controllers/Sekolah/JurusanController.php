<?php

namespace App\Http\Controllers\Sekolah;

use Illuminate\Http\Request;
use DB;

class JurusanController{
    public function getDataJurusan(Request $request){
        $columns = array(
            0 =>'id',
            1 =>'id',
            2 =>'jurusan',
            3 =>'kepala_jurusan',
            4 =>'status'
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        
        if(empty($request->input('search.value'))){
            $data_search = DB::table('jurusan')->orderBy($order, $dir);
        }else{
            $search = $request->input('search.value');
            $data_search = DB::table('jurusan')
            ->where('id', 'like', "%{$search}%")
            ->orWhere('jurusan', 'like', "%{$search}%")
            ->orWhere('kepala_jurusan', 'like', "%{$search}%")
            ->orWhere('status', 'like', "%{$search}%")
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

                $nestedData['id'] =  $row->id;
                $nestedData['jurusan'] =  $row->jurusan;
                $nestedData['kepala_jurusan'] =  $row->kepala_jurusan;
                $nestedData['status'] =  $row->status;
                $nestedData['action'] =  "<button class='btn btn-outline-warning btn-sm' 
                                            onClick=\"setData('$row->id','$row->jurusan','$row->kepala_jurusan','$row->status')\"
                                            data-toggle='modal' data-target='#updateData'>Edit</button>
                                            <button class='btn btn-outline-danger btn-sm' onClick=\"hapusData('$row->id')\">Hapus</button>
                                            ";
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

    public function insertJurusan(Request $request){
        $cek_data = DB::table('jurusan')->where('jurusan', $request->jurusan)->orWhere('kepala_jurusan', $request->kepala_jurusan)->first();

        $respError = FALSE;
        $respMesssage = '';

        if($cek_data){
            $respMesssage = 'Data sudah terdaftar di database';
        }else{
            $result = DB::table('jurusan')->insert([
                'jurusan' => $request->jurusan,
                'kepala_jurusan' => $request->kepala_jurusan,
                'status' => $request->status
            ]);

            if($result){
                $respError = TRUE;
                $respMesssage = 'Input data jurusan berhasil';
            }else{
                $respMesssage = 'Terjadi kesalahan saat input data';
            }
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);

    }

    public function updateJurusan(Request $request){
        $respError = FALSE;
        $respMesssage = '';
        $result = DB::table('jurusan')->where('id', $request->id)->update([
            'jurusan' => $request->jurusan,
            'kepala_jurusan' => $request->kepala_jurusan,
            'status' => $request->status
        ]);

        if($result){
            $respError = TRUE;
            $respMesssage = 'Update data jurusan berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat input data';
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }

    public function deleteJurusan($id){
        $respError = FALSE;
        $respMesssage = '';
        $result = DB::table('jurusan')->where('id', $id)->delete();
        if($result){
            $respError = TRUE;
            $respMesssage = 'Hapus data jurusan berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat input data';
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
    public function getDataJurusanAll(){

        $data_jurusan = DB::table('jurusan')->get();

        return response()->json($data_jurusan);
    }

    public function getJurusanById($id){
        $data_jurusan = DB::table('jurusan')->where('id', $id)->first();

        return response()->json($data_jurusan);
    }
}