<?php

namespace App\Http\Controllers\Pegawai;

use Illuminate\Http\Request;
use DB;
use File;
use Illuminate\Support\Facades\Hash;


class PegawaiController
{

    public function index()
    {
        $jabatan1 = DB::table('jabatan')
            ->where('jabatan', '!=', 'Kepala Sekolah')
            ->where('jabatan', '!=', 'Kepala Jurusan')
            ->where('jabatan', '!=', 'Wali Kelas')
            ->where('jabatan', '!=', 'Waka Kurikulum')
            ->where('jabatan', '!=', 'Waka Kesiswaan')
            ->get();
        $jabatan2 = DB::table('jabatan')
            ->where('jabatan', '!=', 'Kepala Sekolah')
            ->where('jabatan', '!=', 'Kepala Jurusan')
            ->where('jabatan', '!=', 'Wali Kelas')
            ->where('jabatan', '!=', 'Waka Kurikulum')
            ->where('jabatan', '!=', 'Waka Kesiswaan')
            ->get();

        return view('page.pegawai.pegawai', compact('jabatan1', 'jabatan2'));
    }

    public function dataPegawai(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'id',
            2 => 'kode_pegawai',
            3 => 'nama_pegawai',
            4 => 'tempat_lahir',
            5 => 'jenis_kelamin',
            6 => 'pendidikan_terahir',
            7 => 'alamat',
            8 => 'pegawai',
            9 => 'tugas_tambahan',
            10 => 'email',
            11 => 'status'
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $data_search = DB::table('v_pegawai')->orderBy($order, $dir);
        } else {
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
                ->orWhere('email', 'like', "%{$search}%")
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
        if ($posts) {

            foreach ($posts as $row) {
                if ($row->tugas_tambahan) {
                    $tugastambahan = $row->tugas_tambahan;
                } else {
                    $tugastambahan = '-';
                }
                if($row->avatar){
                    $avatar = "<img src='/profil/$row->avatar' class='img-circle' width='30' height='30'>";
                }else{
                    $avatar = "<img src='/profil/user_default.png' class='img-circle' width='30' height='30'>";
                }

                $nestedData['action'] =  "<button class='btn btn-outline-warning btn-sm' 
                                            onClick=\"setData('$row->id','$row->kode_pegawai','$row->nama_pegawai','$row->tempat_lahir','$row->tanggal_lahir','$row->jenis_kelamin','$row->pendidikan_terahir','$row->alamat','$row->pegawai','$row->status','$row->email')\"
                                            data-toggle='modal' data-target='#updateData'>Edit</button>
                                            <button class='btn btn-outline-danger btn-sm' onClick=\"hapusData('$row->id')\">Hapus</button>
                                            ";
                $nestedData['avatar'] =  $avatar;
                $nestedData['kode_pegawai'] =  $row->kode_pegawai;
                $nestedData['nama_pegawai'] =  $row->nama_pegawai;
                $nestedData['lahir'] =  $row->tempat_lahir . "," . $row->tanggal_lahir;
                $nestedData['jenis_kelamin'] =  $row->jenis_kelamin;
                $nestedData['pendidikan_terahir'] =  $row->pendidikan_terahir;
                $nestedData['alamat'] =  $row->alamat;
                $nestedData['pegawai'] =  $row->jabatan;
                $nestedData['tugas_tambahan'] =  $tugastambahan;
                $nestedData['email'] =  $row->email;
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

    public function insertPegawai(Request $request)
    {
        // dd($request->all());
        $cek_data = DB::table('pegawai')->where('kode_pegawai', '=', $request->kode_pegawai)->first();
        $respError = FALSE;
        $respMesssage = '';

        if ($cek_data) {
            $respMesssage = 'Data dengan kode pegawai tersebut sudah ada';
        }elseif($request->avatar){
            // Upload File
            $file = $request->avatar;
            $nama_file = $file->getClientOriginalName();

            $file_avatar = uniqid('pegawai-' . rand(100,999)) . '.' . $file->getClientOriginalExtension();
            $result_file = $file->move(\base_path() .'/public/profil', $file_avatar);
            if($result_file){
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
                    'status' => $request->status,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'avatar' => $file_avatar
                ]);
                if ($result) {
                    $respError = TRUE;
                    $respMesssage = 'Input data pegawai berhasil';
                } else {
                    $respMesssage = 'Terjadi kesalahan saat input data';
                }
            }else{
                if ($result) {
                    $respError = FALSE;
                    $respMesssage = 'Import avatar error';
                } else {
                    $respMesssage = 'Terjadi kesalahan saat input data';
                }
            }
        }else {
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
                'status' => $request->status,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            if ($result) {
                $respError = TRUE;
                $respMesssage = 'Input data pegawai berhasil';
            } else {
                $respMesssage = 'Terjadi kesalahan saat input data';
            }
        }

        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
    public function updatePegawai(Request $request)
    {
        $respError = FALSE;
        $respMesssage = '';
        $data_pegawai = array(); 

        $data_pegawai['kode_pegawai'] = $request->kode_pegawai;
        $data_pegawai['nama_pegawai'] = $request->nama_pegawai;
        $data_pegawai['tempat_lahir'] = $request->tempat_lahir;
        $data_pegawai['jenis_kelamin'] = $request->jenis_kelamin;
        $data_pegawai['tanggal_lahir'] = $request->tanggal_lahir;
        $data_pegawai['alamat'] = $request->alamat;
        $data_pegawai['pendidikan_terahir'] = $request->pendidikan_terahir;
        $data_pegawai['pegawai'] = $request->jabatan;
        $data_pegawai['tugas_tambahan'] = $request->tugas_tambahan;
        $data_pegawai['email'] = $request->email;
        $data_pegawai['status'] = $request->status;

        if (!empty($request->password)) {
            $data_pegawai['password'] = Hash::make($request->password);
        }
        if(!empty($request->avatar)){
            $cek_data = DB::table('pegawai')->where('id', '=', $request->id)->first();
            $file = $request->avatar;
            // dd($file->getClientOriginalName());
            $nama_file = 'pegawai-'.date('Y-m-d H:i:s').'-'.$file->getClientOriginalName();
            if(File::exists(\base_path() .'/public/profil/'.$cek_data->avatar)){
                File::delete(\base_path() .'/public/profil/'.$cek_data->avatar);
                $file->move(\base_path() .'/public/profil', $nama_file);
            }else{
                $file->move(\base_path() .'/public/profil', $nama_file);
            }
            $data_pegawai['avatar'] = $nama_file;
        }
        
        
        $result = DB::table('pegawai')->where('id', '=', $request->id)->update($data_pegawai);

        if ($result) {
            $respError = TRUE;
            $respMesssage = 'Update data pegawai berhasil';
        } else {
            $respMesssage = 'Terjadi kesalahan saat update data';
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }

    public function deletePegawai($id)
    {
        $respError = FALSE;
        $respMesssage = '';


        $cek_data = DB::table('pegawai')->where('id', '=', $id)->first();
        if(File::exists(\base_path() .'/public/profil/'.$cek_data->avatar)){
            File::delete(\base_path() .'/public/profil/'.$cek_data->avatar);
        }
        $result = DB::table('pegawai')->where('id', $id)->delete();
        if ($result) {
            $respError = TRUE;
            $respMesssage = 'Hapus data pegawai berhasil';
        } else {
            $respMesssage = 'Terjadi kesalahan saat hapus data';
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
    public function getAllPegawai()
    {
        $data_pegawai = DB::table('pegawai')->where('tugas_tambahan', '!=', 'Waka Kesiswaan')->where('tugas_tambahan', '!=', 'Waka Kurikulum')->where('tugas_tambahan', '!=', 'Wali Kelas')->where('pegawai', '=', 1)->get();

        return response()->json($data_pegawai);
    }
    public function getPegawaiById($id)
    {
        $data_pegawai = DB::table('pegawai')->where('id', $id)->first();

        return response()->json($data_pegawai);
    }
}
