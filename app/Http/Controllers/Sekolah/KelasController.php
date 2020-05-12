<?php

namespace App\Http\Controllers\Sekolah;
use Illuminate\Http\Request;
use DB;



class KelasController{

    public function index(){
        $jurusan = DB::table('jurusan')->get();
        $jurusan1 = DB::table('jurusan')->get();
        $wali_kelas = DB::table('pegawai')->get();
        $wali_kelas1 = DB::table('pegawai')->get();
        return view('page.sekolah.rombel', compact(['jurusan','jurusan1','wali_kelas','wali_kelas1']));
    }

    public function get(Request $request){
        $posts = DB::table('kelas')->get();

        $data = array();
        if($posts){
            foreach($posts as $row){
                if($row->semester == 'I'){
                    $semester = 'Ganjil';
                }else{
                    $semester = 'Genap';
                }

                $nestedData['nama_kelas'] =  $row->nama_kelas;
                $nestedData['jurusan'] =   $row->jurusan;
                $nestedData['rombel'] =  $row->rombel;
                $nestedData['wali_kelas'] =  $row->wali_kelas;
                $nestedData['status'] =  $row->status;
                $nestedData['tahun_ajar'] =  $row->tahun_ajar;
                $nestedData['semester'] =  $semester;
                $nestedData['action'] = "<button class='btn btn-outline-warning btn-sm' 
                                        onClick=\"setData('$row->id')\"
                                        data-toggle='modal' data-target='#updateDataDosen'>Edit</button>
                                        <button class='btn btn-outline-danger btn-sm' onClick=\"hapusData('$row->id')\">Hapus</button>";
                $data[] = $nestedData;
            }
        }

        echo json_encode(array(
            "data"              => $data
        ));
    }

    public function insert(Request $request){
        $result = DB::table('kelas')->insert([
            'jurusan' => $request->jurusan,
            'nama_kelas' => $request->nama_kelas,
            'rombel' => $request->rombel,
            'wali_kelas' => $request->wali_kelas,
            'status' => $request->status,
            'tahun_ajar' => $request->tahun_ajar,
            'semester' => $request->semester
        ]);


        $respError = FALSE;
        $respMesssage = '';


        if($result){
            $respError = TRUE;
            $respMesssage = 'Input data kelas berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat input data';
        }

        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }


    public function delete($id){
        $respError = FALSE;
        $respMesssage = '';
        $result = DB::table('kelas')->where('id', $id)->delete();
        if($result){
            $respError = TRUE;
            $respMesssage = 'Hapus data kelas berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat input data';
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
}