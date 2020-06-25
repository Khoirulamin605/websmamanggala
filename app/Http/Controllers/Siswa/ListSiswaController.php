<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use PHPExcel; 
use PHPExcel_IOFactory;
use File;
use DB;

class ListSiswaController{
    public function index(){
        $jurusan = DB::table('jurusan')->select('id','jurusan')->get();
        $kelas = DB::table('siswa')->select('kelas')->where('status_aktif', 'Active')->groupBy('kelas')->get();
        return view('page.siswa.list_siswa', compact(['jurusan', 'kelas']));
    }
    public function alumni(){
        // $jurusan = DB::table('jurusan')->select('id','jurusan')->get();
        return view('page.siswa.list_lulusan');
    }

    public function getDataSiswaAktif(Request $request){
        $columns = array(
            0 =>'no_induk',
            1 =>'no_induk',
            2 =>'nama_siswa',
            3 =>'tempat_lahir',
            4 =>'jenis_kelamin',
            5 =>'alamat',
            6 =>'wali',
            7 =>'nama_jurusan',
            8 =>'kelas',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        

        if(empty($request->search_siswa) && empty($request->search_jurusan) && empty($request->search_kelas)){
            $data_search = DB::table('v_siswa_aktif')->orderBy($order, $dir);
        }elseif($request->search_jurusan && $request->search_kelas && $request->search_siswa){
            $data_search = DB::table('v_siswa_aktif')
            ->where('jurusan', '=', $request->search_jurusan)
            ->where('kelas', '=', $request->search_kelas)
            ->where('nama_siswa', '=', $request->search_siswa)
            ->orderBy($order, $dir);
        }elseif($request->search_jurusan && $request->search_kelas){
            $data_search = DB::table('v_siswa_aktif')
            ->where('jurusan', '=', $request->search_jurusan)
            ->where('kelas', '=', $request->search_kelas)
            ->orderBy($order, $dir);
        }elseif($request->search_jurusan){
            $data_search = DB::table('v_siswa_aktif')
            ->where('jurusan', '=', $request->search_jurusan)
            ->orderBy($order, $dir);
        }else{
            $data_search = DB::table('v_siswa_aktif')->orderBy($order, $dir);

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

                $nestedData['no_induk'] =  $row->no_induk;
                $nestedData['nama_siswa'] =  $row->nama_siswa;
                $nestedData['lahir'] =  $row->tempat_lahir.', '.$row->tanggal_lahir;
                $nestedData['alamat'] =  $row->alamat;
                $nestedData['jenis_kelamin'] =  $row->jenis_kelamin;
                $nestedData['wali'] =  $row->wali;
                $nestedData['nama_jurusan'] =  $row->nama_jurusan;
                $nestedData['kelas'] =  $row->kelas;
                $nestedData['action'] =  "<button class='btn btn-outline-warning btn-sm' 
                                            onClick=\"setData('$row->id','$row->no_induk','$row->nama_siswa','$row->tempat_lahir','$row->tanggal_lahir','$row->jenis_kelamin','$row->alamat','$row->kelas','$row->jurusan','$row->alasan_masuk','$row->wali')\"
                                            data-toggle='modal' data-target='#updateData'>Edit</button>
                                            <button class='btn btn-outline-danger btn-sm' onClick=\"hapusData('$row->id')\">Hapus</button>
                                            <button class='btn btn-outline-info btn-sm' onClick=\"setDataKeluar('$row->id')\"
                                             data-toggle='modal' data-target='#keluarSiswa'>Keluar</button>
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

    public function getDataSiswaNonAktif(Request $request){

        $columns = array(
            0 =>'no_induk',
            1 =>'no_induk',
            2 =>'nama_siswa',
            3 =>'tempat_lahir',
            4 =>'jenis_kelamin',
            5 =>'alamat',
            6 =>'wali',
            7 =>'kelas',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        
        if(empty($request->input('search.value'))){
            $data_search = DB::table('v_siswa_inactive')->orderBy($order, $dir);
        }else{
            $search = $request->input('search.value');
            $data_search = DB::table('v_siswa_inactive')
            ->where('no_induk', 'like', "%{$search}%")
            ->orWhere('nama_siswa', 'like', "%{$search}%")
            ->orWhere('tempat_lahir', 'like', "%{$search}%")
            ->orWhere('jenis_kelamin', 'like', "%{$search}%")
            ->orWhere('alamat', 'like', "%{$search}%")
            ->orWhere('wali', 'like', "%{$search}%")
            ->orWhere('kelas', 'like', "%{$search}%")
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

                $nestedData['no_induk'] =  $row->no_induk;
                $nestedData['nama_siswa'] =  $row->nama_siswa;
                $nestedData['lahir'] =  $row->tempat_lahir.', '.$row->tanggal_lahir;
                $nestedData['alamat'] =  $row->alamat;
                $nestedData['jenis_kelamin'] =  $row->jenis_kelamin;
                $nestedData['wali'] =  $row->wali;
                $nestedData['kelas'] =  $row->kelas;
                $nestedData['action'] =  "<button class='btn btn-outline-success btn-sm' data-toggle='modal'
                                            onClick=\"setData('$row->no_induk','$row->nama_siswa','$row->tempat_lahir','$row->tanggal_lahir','$row->jenis_kelamin','$row->alamat','$row->kelas','$row->nama_jurusan','$row->status_aktif','$row->wali','$row->tanggal_keluar')\"
                                            data-target='#viewSiswa'>Lihat Detail</button>";
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

    public function getAlumni(Request $request){

        $columns = array(
            0 =>'no_induk',
            1 =>'no_induk',
            2 =>'nama_siswa',
            3 =>'tempat_lahir',
            4 =>'jenis_kelamin',
            5 =>'alamat',
            6 =>'wali',
            7 =>'tanggal_keluar',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        
        if(empty($request->search_siswa) && empty($request->search_tahun)){
            $data_search = DB::table('v_siswa_lulus')->orderBy($order, $dir);
        }elseif($request->search_tahun && $request->search_siswa){
            $data_search = DB::table('v_siswa_lulus')
            ->where('tanggal_keluar', '=', $request->search_tahun)
            ->where('nama_siswa', '=', $request->search_siswa)
            ->orderBy($order, $dir);
        }elseif($request->search_tahun){
            $data_search = DB::table('v_siswa_lulus')
            ->where('tanggal_keluar', '=', $request->search_tahun)
            ->orderBy($order, $dir);
        }elseif($request->search_siswa){
            $data_search = DB::table('v_siswa_lulus')
            ->where('nama_siswa', '=', $request->search_siswa)
            ->orderBy($order, $dir);
        }else{
            $search = $request->input('search.value');
            $data_search = DB::table('v_siswa_lulus')
            ->where('no_induk', 'like', "%{$search}%")
            ->orWhere('nama_siswa', 'like', "%{$search}%")
            ->orWhere('tempat_lahir', 'like', "%{$search}%")
            ->orWhere('jenis_kelamin', 'like', "%{$search}%")
            ->orWhere('alamat', 'like', "%{$search}%")
            ->orWhere('wali', 'like', "%{$search}%")
            ->orWhere('tanggal_keluar', 'like', "%{$search}%")
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

                $nestedData['no_induk'] =  $row->no_induk;
                $nestedData['nama_siswa'] =  $row->nama_siswa;
                $nestedData['lahir'] =  $row->tempat_lahir.', '.$row->tanggal_lahir;
                $nestedData['alamat'] =  $row->alamat;
                $nestedData['jenis_kelamin'] =  $row->jenis_kelamin;
                $nestedData['wali'] =  $row->wali;
                $nestedData['tanggal_keluar'] =  $row->tanggal_keluar;
                $nestedData['action'] =  "<button class='btn btn-outline-success btn-sm' data-toggle='modal'
                                            onClick=\"setData('$row->no_induk','$row->nama_siswa','$row->tempat_lahir','$row->tanggal_lahir','$row->jenis_kelamin','$row->alamat','$row->kelas','$row->nama_jurusan','$row->status_aktif','$row->wali','$row->tanggal_keluar')\"
                                            data-target='#viewSiswa'>Lihat Detail</button>";
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

    public function insertDataSiswa(Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $respError = FALSE;
        $respMesssage = '';
        $cekData = DB::table('siswa')->where('no_induk', $request->no_induk)->first();

        if($cekData){
            $respMesssage = 'Data dengan id tersebut terdaftar di database';
        }else{
            $result =  DB::table('siswa')->insert([
                'no_induk' => $request->no_induk,
                'nama_siswa' => $request->nama_siswa,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'wali' => $request->wali,
                'kelas' => $request->kelas,
                'jurusan' =>$request->jurusan,
                'tanggal_masuk' =>  DATE("Y-m-d"),
                'alasan_masuk' => $request->alasan_masuk,
                'status_aktif' => 'Active'
            ]);
            if($result){
                $respError = TRUE;
                $respMesssage = 'Input data siswa berhasil';
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

    public function updateDataSiswa(Request $request){

        $respError = FALSE;
        $respMesssage = '';

        $result =  DB::table('siswa')->where('id', $request->id)->update([
            'no_induk' => $request->no_induk,
            'nama_siswa' => $request->nama_siswa,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'wali' => $request->wali,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'alasan_masuk' => $request->alasan_masuk,
        ]);
        if($result){
            $respError = TRUE;
            $respMesssage = 'Update data siswa berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat update data';
        }

        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }

    public function deleteSiswa($id){
        $respError = FALSE;
        $respMesssage = '';
        $result = DB::table('siswa')->where('id', $id)->delete();
        if($result){
            $respError = TRUE;
            $respMesssage = 'Hapus data siswa berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat hapus data';
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }

    public function pindahkanSiswa(Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $respError = FALSE;
        $respMesssage = '';

        $result =  DB::table('siswa')->where('id', $request->id)->update([
            'status_aktif' => $request->status_aktif,
            'tanggal_keluar' => DATE("Y-m-d")
        ]);
        if($result){
            $respError = TRUE;
            $respMesssage = 'Update data siswa berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat update data';
        }

        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }

    public function importData(Request $request){
        $respError = FALSE;
        $respMesssage = '';


        // Upload File
        $file = $request->file('file_excel');
        $nama_file = $file->getClientOriginalName();

        $file_excel = uniqid('ImportSiswa_' . rand(100,999)) . '.' . $file->getClientOriginalExtension();
        $result = $file->move(\base_path() .'/public/upload', $file_excel);

        if($result){
            $obj = PHPExcel_IOFactory::load(\base_path() .'/public/upload/'.$file_excel);
            $data_import = $obj->getActiveSheet()->toArray(null, true, true, true);
            
            //get all data siswa
            $menu_cari = json_decode(json_encode(DB::table('siswa')->get(), true));
            for($array_start = 9; $array_start <= count($data_import); $array_start++){
                $res = array_search($data_import[$array_start]['A'], array_column($menu_cari, 'no_induk'));
                if($res  !== false ){
                }else{
                    $data_siswa[] = [
                        'no_induk' => $data_import[$array_start]['A'],
                        'nama_siswa' => $data_import[$array_start]['B'],
                        'tempat_lahir' =>$data_import[$array_start]['C'],
                        'tanggal_lahir' => $data_import[$array_start]['D'],
                        'jenis_kelamin' => $data_import[$array_start]['E'],
                        'alamat' => $data_import[$array_start]['F'],
                        'wali' => $data_import[$array_start]['G'],
                        'kelas' => $data_import[$array_start]['H'],
                        'jurusan' => $data_import[$array_start]['I'],
                        'tanggal_masuk' =>  DATE("Y-m-d"),
                        'alasan_masuk' => $data_import[$array_start]['J'],
                        'status_aktif' => 'Active'
                    ];
                }
            }
            File::delete(\base_path() .'/public/upload/'.$file_excel);

            $reesult_insert = DB::table('siswa')->insert($data_siswa);
            if($reesult_insert){
                $respError = TRUE;
                $respMesssage = 'Import data berhasil';
            }else{
                $respMesssage = 'Terjadi kesalahan saat import data';
            }
        }else{
            $respMesssage = 'Import data siswa Gagal';
        }

        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);

    }
    public function naikKelas(Request $request){
        $respError = FALSE;
        $respMesssage = '';

        // Cek Kelas Lanjut If Exist
        $cek_kelas_lanjut = DB::table('siswa')->where('kelas', $request->kelas_lanjut)->first();
        // Cek Kelas Sebelumnya If Exist
        $cek_kelas_sebelumnya = DB::table('siswa')->where('kelas', $request->kelas_asal)->first();

        if(!$cek_kelas_sebelumnya){
            $respMesssage = 'Kelas yang akan dinaikkan sudah kosong';
        }elseif($cek_kelas_lanjut){
            $respMesssage = 'Kelas yang akan dimasuki sudah ada';
        }elseif($request->kelas_asal != "Kelas XII" && $request->kelas_lanjut == 'Lulus'){
            $respMesssage = 'Anda Tidak bisa meluluskan yang bukan Kelas XII';
        }else{
            if($request->kelas_lanjut == "Lulus"){
                $result = DB::table('siswa')->where('kelas', $request->kelas_asal)->update([
                    'status_aktif' => $request->kelas_lanjut
                ]);
            }else{
                $result = DB::table('siswa')->where('kelas', $request->kelas_asal)->update([
                    'kelas' => $request->kelas_lanjut
                ]);
            }
            if($result){
                $respMesssage = 'Menaikan kelas berhasil';
            }else{
                $respMesssage = 'Menaikan kelas gagal';
            }
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }

}