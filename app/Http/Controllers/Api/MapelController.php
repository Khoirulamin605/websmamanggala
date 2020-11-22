<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Libraries\ResponseApi;
use DB;
// use URL;

class MapelController{

    function __construct(){
        $this->res = new ResponseApi();
    }

    public function allMapel(){
        $id_pegawai = Session::get('isLogin')->nama_pegawai;
        $result = DB::table('mapel')->where('guru_pengajar', $id_pegawai)->get();
        if(!empty($result[0])){
            $response = $this->res->index(0,'Cek Data Berhasil', $result);
        }else{
            $response = $this->res->index(1,'Data Tidak Tersedia');
        }
        return response()->json($response);
    }

    public function nilaiMapel($id){
        $result = DB::table('v_nilai')->where('id_mapel',$id)->get();
        if(!empty($result[0])){
            $response = $this->res->index(0,'Cek Data Berhasil', $result);
        }else{
            $response = $this->res->index(1,'Data Tidak Tersedia');
        }
        return response()->json($response);
    }

    public function inputNilai(Request $request){
        $response = array();

        if(!$request->id_nilai || !$request->nilai){
            $response['errNumber'] = 1;
            $response['status'] = 'fialed';
            $response['respTime'] = date('Y-m-d H:i:s');
            $response['errMessage'] = 'Invalid Parameter Nilai';


            return response()->json($response);
        }
        
        $cek_data = DB::table('nilai')->where('id',$request->id_nilai)->first();
        if(!$cek_data){
            $response['errNumber'] = 1;
            $response['status'] = 'fialed';
            $response['respTime'] = date('Y-m-d H:i:s');
            $response['errMessage'] = 'Data Tudak Tersedia';

            return response()->json($response);
        }else{
            DB::table('nilai')->where('id',$request->id_nilai)->update([
                'nilai' => $request->nilai
            ]);
            $result = DB::table('v_nilai')->where('id',$request->id_nilai)->first();

            $response['errNumber'] = 0;
            $response['status'] = 'success';
            $response['respTime'] = date('Y-m-d H:i:s');
            $response['errMessage'] = 'Nilai Berhasil Diinput';
            $response['data'] = array(
                "nama_siswa" => $result->nama_siswa,
                "jurusan" => $result->jurusan,
                "nama_mapel" => $result->nama_mapel,
                "kelas" => $result->kelas,
                "nilai" => $result->nilai,
            );

            return response()->json($response);
        }

        
    }

    public function cekTahunAjaran(){
        $result = DB::table('nilai')->select('tahun_ajaran')->groupBy('tahun_ajaran')->get();
        // dd($result);
        if(!empty($result[0])){
            $response = $this->res->index(0,'Cek Data Berhasil', $result);
        }else{
            $response = $this->res->index(1,'Data Tidak Tersedia');
        }
        return response()->json($response);
    }

    public function cekNilaiSiswa(Request $request){
        if(!$request->tahun || !$request->jurusan  || !$request->kelas || !$request->smester || !$request->siswa){
            $response = $this->res->index(1,'Input Kosong');
        }else{
            $result = DB::table('v_nilai')
                        ->where('tahun_ajaran',$request->tahun)
                        ->where('id_jurusan',$request->jurusan)
                        ->where('kelas',$request->kelas)
                        ->where('semester',$request->smester)
                        ->where('id_siswa',$request->siswa)
                        ->get();
            if(!empty($result[0])){
                $response = $this->res->index(0,'Cek Data Berhasil', $result);
            }else{
                $response = $this->res->index(1,'Data Tidak Tersedia');
            }
        }
        return response()->json($response);
    }

    public function cekDataSiswa(Request $request){
        if(!$request->jurusan || !$request->kelas){
            $response = $this->res->index(1,'Input Kosong');
        }else{
            $result = DB::table('v_siswa_aktif')->where('jurusan',$request->jurusan)->where('kelas',$request->kelas)->get();
            if(!empty($result[0])){
                $data = array();
                foreach($result as $result){
                    $col = array();
                    
                    $col["id"] = $result->id;
                    $col["no_induk"] =  $result->no_induk;
                    $col["nama_siswa"] =  $result->nama_siswa;
                    $col["tempat_lahir"] =  $result->tempat_lahir;
                    $col["tanggal_lahir"] =  $result->tanggal_lahir;
                    $col["jenis_kelamin"] =  $result->jenis_kelamin;
                    $col["alamat"] =  $result->alamat;
                    $col["wali"] =  $result->wali;
                    $col["avatar"] =  $result->avatar;
                    $col["kelas"] =  $result->kelas;
                    $col["jurusan"] =  $result->jurusan;
                    $col["nama_jurusan"] =  $result->nama_jurusan;

                    $data[] = $col;
                }

                $response = $this->res->index(0,'Cek Data Berhasil', $data);
            }else{
                $response = $this->res->index(1,'Data Tidak Tersedia');
            }
        }
        return response()->json($response);
    }

    public function cekDataSiswaID($id){
        $result = DB::table('v_siswa_aktif')->where('id', $id)->first();
        if($result){
            $data["id"] = $result->id;
            $data["no_induk"] =  $result->no_induk;
            $data["nama_siswa"] =  $result->nama_siswa;
            $data["tempat_lahir"] =  $result->tempat_lahir;
            $data["tanggal_lahir"] =  $result->tanggal_lahir;
            $data["jenis_kelamin"] =  $result->jenis_kelamin;
            $data["alamat"] =  $result->alamat;
            $data["wali"] =  $result->wali;
            $data["avatar"] =  $result->avatar;
            $data["kelas"] =  $result->kelas;
            $data["jurusan"] =  $result->jurusan;
            $data["nama_jurusan"] =  $result->nama_jurusan;
            $response = $this->res->index(0,'Cek Data Berhasil', $data);
        }else{
            $response = $this->res->index(1,'Data Tidak Tersedia');
        }
        return response()->json($response);
    }
}