<?php

namespace App\Http\Controllers\Pegawai;

use Illuminate\Http\Request;
use DB;


class PegawaiController{

    public function index(){
        $jabatan1 = DB::table('jabatan')
        ->where('jabatan', '!=' ,'Kepala Sekolah')
        ->where('jabatan', '!=' ,'Kepala Jurusan')
        ->where('jabatan', '!=' ,'Wali Kelas')
        ->where('jabatan', '!=' ,'Waka Kurikulum')
        ->where('jabatan', '!=' ,'Waka Kesiswaan')
        ->get();
        $jabatan2 = DB::table('jabatan')
        ->where('jabatan', '!=' ,'Kepala Sekolah')
        ->where('jabatan', '!=' ,'Kepala Jurusan')
        ->where('jabatan', '!=' ,'Wali Kelas')
        ->where('jabatan', '!=' ,'Waka Kurikulum')
        ->where('jabatan', '!=' ,'Waka Kesiswaan')
        ->get();

        return view('page.pegawai.pegawai', compact('jabatan1','jabatan2'));
    }

    public function dataPegawai(Request $request){
        $columns = array(
            0 =>'id',
            1 =>'kode_pegawai',
            2 =>'nama_pegawai',
            3 =>'tempat_lahir',
            4 =>'jenis_kelamin',
            5 =>'pendidikan_terahir',
            6 =>'alamat',
            7 =>'pegawai',
            8 =>'tugas_tambahan',
            9 =>'status'
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        
        if(empty($request->input('search.value'))){
            $data_search = DB::table('v_pegawai')->orderBy($order, $dir);
        }else{
            $search = $request->input('search.value');
            $data_search = DB::table('v_pegawai')
            ->where('id', 'like', "%{$search}%")
            ->orWhere('kode_pegawai', 'like', "%{$search}%")
            ->orWhere('nama_pegawai', 'like', "%{$search}%")
            ->orWhere('tempat_lahir', 'like', "%{$search}%")
            ->orWhere('tanggal_lahir', 'like', "%{$search}%")
            ->orWhere('jenis_kelamin', 'like', "%{$search}%")
            ->orWhere('pendidikan_terahir', 'like', "%{$search}%")
            ->orWhere('alamat', 'like', "%{$search}%")
            ->orWhere('jabatan', 'like', "%{$search}%")
            ->orWhere('tugas_tambahan', 'like', "%{$search}%")
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
                if($row->tugas_tambahan){
                    $tugastambahan = $row->tugas_tambahan;
                }else{
                    $tugastambahan = '-';
                }

                $nestedData['action'] =  "<button class='btn btn-outline-warning btn-sm' 
                                            onClick=\"setData('$row->id','$row->kode_pegawai','$row->nama_pegawai','$row->tempat_lahir','$row->tanggal_lahir','$row->jenis_kelamin','$row->pendidikan_terahir','$row->alamat','$row->pegawai','$row->status')\"
                                            data-toggle='modal' data-target='#updateData'>Edit</button>
                                            <button class='btn btn-outline-danger btn-sm' onClick=\"hapusData('$row->id')\">Hapus</button>
                                            ";
                $nestedData['kode_pegawai'] =  $row->kode_pegawai;
                $nestedData['nama_pegawai'] =  $row->nama_pegawai;
                $nestedData['lahir'] =  $row->tempat_lahir.",".$row->tanggal_lahir;
                $nestedData['jenis_kelamin'] =  $row->jenis_kelamin;
                $nestedData['pendidikan_terahir'] =  $row->pendidikan_terahir;
                $nestedData['alamat'] =  $row->alamat;
                $nestedData['pegawai'] =  $row->jabatan;
                $nestedData['tugas_tambahan'] =  $tugastambahan;
                $nestedData['status'] =  $row->status;
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

    public function insertPegawai(Request $request){
        $cek_data = DB::table('pegawai')->where('kode_pegawai', '=', $request->kode_pegawai)->first();
        $respError = FALSE;
        $respMesssage = '';

        if($cek_data){
            $respMesssage = 'Data dengan kode pegawai tersebut sudah ada';
        }else{
            $result = DB::table('pegawai')->insert([
                'kode_pegawai' => $request->kode_pegawai,
                'nama_pegawai' => $request->nama_pegawai,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'pendidikan_terahir' => $request->pendidikan_terahir,
                'pegawai' => $request->jabatan,
                'tugas_tambahan' => $request->tugas_tambahan,
                'status' => $request->status
            ]);
            if($result){
                $respError = TRUE;
                $respMesssage = 'Input data pegawai berhasil';
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
    public function updatePegawai(Request $request){
        $respError = FALSE;
        $respMesssage = '';


        $result = DB::table('pegawai')->where('id', '=', $request->id)->update([
            'kode_pegawai' => $request->kode_pegawai,
            'nama_pegawai' => $request->nama_pegawai,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'pendidikan_terahir' => $request->pendidikan_terahir,
            'pegawai' => $request->jabatan,
            'tugas_tambahan' => $request->tugas_tambahan,
            'status' => $request->status
        ]);

        if($result){
            $respError = TRUE;
            $respMesssage = 'Update data pegawai berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat update data';
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }

    public function deletePegawai($id){
        $respError = FALSE;
        $respMesssage = '';
        $result = DB::table('pegawai')->where('id', $id)->delete();
        if($result){
            $respError = TRUE;
            $respMesssage = 'Hapus data pegawai berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat hapus data';
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
    public function getAllPegawai(){
        $data_pegawai = DB::table('pegawai')->where('tugas_tambahan', '!=', 'Waka Kesiswaan')->where('tugas_tambahan', '!=', 'Waka Kurikulum')->where('tugas_tambahan', '!=', 'Wali Kelas')->where('pegawai', '=', 1)->get();

        return response()->json($data_pegawai);
    }
    public function getPegawaiById($id){
        $data_pegawai = DB::table('pegawai')->where('id', $id)->first();

        return response()->json($data_pegawai);
    }
}