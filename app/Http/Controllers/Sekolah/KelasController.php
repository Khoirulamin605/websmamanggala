<?php

namespace App\Http\Controllers\Sekolah;
use Illuminate\Http\Request;
use DB;



class KelasController{

    public function index(){
        $jurusan = DB::table('jurusan')->get();
        $jurusan1 = DB::table('jurusan')->get();
        $wali_kelas = DB::table('pegawai')->where('tugas_tambahan', '!=', 'Waka Kesiswaan')->where('tugas_tambahan', '!=', 'Waka Kurikulum')->where('tugas_tambahan', '!=', 'Kepala Jurusan')->where('pegawai', '=', 1)->get();
        $wali_kelas1 = DB::table('pegawai')->where('tugas_tambahan', '!=', 'Waka Kesiswaan')->where('tugas_tambahan', '!=', 'Waka Kurikulum')->where('tugas_tambahan', '!=', 'Kepala Jurusan')->where('pegawai', '=', 1)->get();
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
                                        onClick=\"setData('$row->id','$row->nama_kelas','$row->jurusan','$row->rombel','$row->wali_kelas','$row->status','$row->tahun_ajar','$row->semester')\"
                                        data-toggle='modal' data-target='#updateData'>Edit</button>
                                        <button class='btn btn-outline-danger btn-sm' onClick=\"hapusData('$row->id')\">Hapus</button>";
                $data[] = $nestedData;
            }
        }

        echo json_encode(array(
            "data"              => $data
        ));
    }

    public function updatePegawaiTugas($id){
        DB::table('pegawai')->where('nama_pegawai', $id)->update([
            'tugas_tambahan' => ''
        ]);
        // $respError = TRUE;
        // $respMesssage = 'Update data kelas berhasil';
        // $response = array(
        //     'status' => $respError,
        //     'message' => $respMesssage
        // );

        // return response()->json($response);
    }
    public function update(Request $request){
        $wali_kelas_lama = DB::table('kelas')->select('wali_kelas')->where('id',$request->id)->first();
        $this->updatePegawaiTugas($wali_kelas_lama->wali_kelas);
        DB::table('pegawai')->where('nama_pegawai', $request->wali_kelas)->update([
            'tugas_tambahan' => 'Wali Kelas'
        ]);
        $result = DB::table('kelas')->where('id', $request->id)->update([
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
            $respMesssage = 'Update data kelas berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat Update data';
        }

        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
    public function insert(Request $request){
        DB::table('pegawai')->where('nama_pegawai', $request->wali_kelas)->update([
            'tugas_tambahan' => 'Wali Kelas'
        ]);
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