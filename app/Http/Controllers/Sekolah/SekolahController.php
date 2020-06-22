<?php

namespace App\Http\Controllers\Sekolah;
use Illuminate\Http\Request;
use DB;



class SekolahController{
    public function index(){
        $data_pegawai1 = DB::table('pegawai')->where('tugas_tambahan', '!=', 'Wali Kelas')->where('tugas_tambahan', '!=', 'Kepala Jurusan')->where('pegawai', '=', 1)->get();
        $data_pegawai2 = DB::table('pegawai')->where('tugas_tambahan', '!=', 'Wali Kelas')->where('tugas_tambahan', '!=', 'Kepala Jurusan')->where('pegawai', '=', 1)->get();
        $data_pegawai3 = DB::table('pegawai')->where('tugas_tambahan', '!=', 'Wali Kelas')->where('tugas_tambahan', '!=', 'Kepala Jurusan')->where('pegawai', '=', 1)->get();
        $data_sekolah = DB::table('v_sekolah')->get()[0];
        return view('page.sekolah.sekolah', compact(['data_sekolah', 'data_pegawai1', 'data_pegawai2','data_pegawai3']));
    }

    public function getDataSekolah($id){
        $data_sekolah = DB::table('v_sekolah')->where('id',$id)->first();
        
        return response()->json($data_sekolah);
    }
    public function updatePegawaiTugas($id){
        DB::table('pegawai')->where('id', $id)->update([
            'tugas_tambahan' => ''
        ]);
    }
    public function updateData(Request $request){
        $data_lama = DB::table('sekolah')->select('kepala','wakasis','wakakur')->where('id',$request->id)->first();
        $this->updatePegawaiTugas($data_lama->kepala);
        $this->updatePegawaiTugas($data_lama->wakasis);
        $this->updatePegawaiTugas($data_lama->wakakur);

        $respError = FALSE;
        $respMesssage = '';

        $result = DB::table('sekolah')->where('id', $request->id)->update([
            'nama' => $request->nama,
            'npsn' => $request->npsn,
            'alamat' => $request->alamat,
            'tahun_berdiri' => $request->tahun_berdiri,
            'kepala' => $request->kepala,
            'wakasis' => $request->wakasis,
            'wakakur' => $request->wakakur,
            'akreditasi' => $request->akreditasi,
            'email' => $request->email,
            'telpon' => $request->telpon,
            'kurikulum' => $request->kurikulum,
            'status' => $request->status
        ]);

        if($result){
            DB::table('pegawai')->where('id', $request->kepala)->update([
                'tugas_tambahan' => 'Kepala Sekolah'
            ]);
            DB::table('pegawai')->where('id', $request->wakasis)->update([
                'tugas_tambahan' => 'Waka Kesiswaan'
            ]);
            DB::table('pegawai')->where('id', $request->wakakur)->update([
                'tugas_tambahan' => 'Waka Kurikulum'
            ]);
            $respError = TRUE;
            $respMesssage = 'Update data sekolah berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat Update data';
        }

        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
}