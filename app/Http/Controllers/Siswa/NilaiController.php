<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
// use PHPExcel; 
// use PHPExcel_IOFactory;
// use File;
use DB;

class NilaiController{
    public function index(){
        $jurusan = DB::table('jurusan')->select('id','jurusan')->get();
        $jurusan1 = DB::table('jurusan')->select('id','jurusan')->get();
        $mapel = DB::table('mapel')->select('id','nama_mapel')->get();
        $mapel1 = DB::table('mapel')->select('id','nama_mapel')->get();
        $kelas = DB::table('siswa')->select('kelas')->where('status_aktif', 'Active')->groupBy('kelas')->get();
        $kelas1 = DB::table('siswa')->select('kelas')->where('status_aktif', 'Active')->groupBy('kelas')->get();
        $tahun = DB::table('v_nilai')->select('tahun_ajaran')->groupBy('tahun_ajaran')->get();
        // dd($tahun);
        return view('page.siswa.nilai', compact(['jurusan', 'kelas', 'mapel', 'jurusan1', 'kelas1', 'mapel1', 'tahun']));
    }
    public function dataNilai(Request $request){
        // dd($request->all());        
        $columns = array(
            0 =>'id',
            1 =>'nama_siswa',
            2 =>'jurusan',
            3 =>'kelas',
            4 =>'tahun_ajaran',
            5 =>'semester',
            6 =>'nilai',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        // $search = $request->input('search.value');
        $data_search = DB::table('v_nilai')
        ->where('id_jurusan', $request->search_jurusan)
        ->where('kelas', $request->search_kelas)
        ->where('id_mapel', $request->search_mapel)
        ->where('tahun_ajaran', $request->search_tahun)
        ->where('semester', $request->search_semester)
        ->orderBy($order, $dir);

        $totaldata = count($data_search->get());
        $posts = $data_search
                    ->offset($start)
                    ->limit($limit)
                    ->get();
        $totalFiltered = $totaldata;

        $data = array();
        if($posts){
            foreach($posts as $row){
                if($row->nilai == ''){
                    $nilai = "-";
                }else{
                    $nilai = $row->nilai;
                }
                $nama_siswa = $this->RemoveSpecialChapr($row->nama_siswa);
                $nestedData['nama_siswa'] =  $row->nama_siswa;
                $nestedData['jurusan'] =  $row->jurusan;
                $nestedData['kelas'] =  $row->kelas;
                $nestedData['tahun_ajaran'] =  $row->tahun_ajaran;
                $nestedData['semester'] =  $row->semester;
                $nestedData['nilai'] =  $nilai;
                $nestedData['action'] = "<button class='btn btn-outline-success btn-sm' data-toggle='modal' data-target='#updateData' 
                onClick=\"setData('$row->id', '$nama_siswa', '$row->jurusan', '$row->kelas', '$row->kelas', '$row->tahun_ajaran', '$row->semester', '$row->nilai')\">Update</button>"; 
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
    public function getDataSiswa(){
        return view('page.siswa.import_nilai');
    }
    public function getMapelByKelas(Request $request){
        // dd($request->all());
        $result = DB::table('mapel')->where('jurusan', $request->jurusan)->where('kelas', $request->kelas)->get();
        return response()->json($result);
    }
    public function bukaPenilaian(Request $request){
        $cekData = DB::table('nilai')->where('id_jurusan',$request->jurusan)->where('kelas', $request->kelas)->where('semester', $request->semester)->where('tahun_ajaran', $request->tahun_ajaran)->first();

        $respError = FALSE;
        $respMesssage = '';
        if($cekData){
            $respMesssage = 'Nilai untuk Kelas tersebut sudah ada';
        }else{
            $data_siswa = DB::table('siswa')->where('Kelas', $request->kelas)->where('status_aktif', '=' , 'Active')->where('jurusan', $request->jurusan)->get();
            $data_mapel = DB::table('v_custom_mapel')->where('id_jurusan', $request->jurusan)->where('kelas', $request->kelas)->where('status', '=', 'Active')->get();
            $array_nilai = array();
            for($array_start = 0; $array_start <= count($data_siswa)-1; $array_start++){
                for($mapel_start = 0; $mapel_start <= count($data_mapel)-1; $mapel_start++){
                    $array_nilai[] = [
                        'id_siswa' => $data_siswa[$array_start]->id,
                        'id_jurusan' => $request->jurusan,
                        'tahun_ajaran' => $request->tahun_ajaran,
                        'semester' => $request->semester,
                        'kelas' => $request->kelas,
                        'id_mapel' => $data_mapel[$mapel_start]->id
                    ];
                }
            }
            
            $result = DB::table('nilai')->insert($array_nilai);
            if($result){
                $respError = TRUE;
                $respMesssage = 'Generate Penilaian Sukses';
            }else{
                $respMesssage = 'Terjadi kesalahan saat generate data';
            }
        }

        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
    public function update(Request $request){
        $result = DB::table('nilai')->where('id', $request->id)->update([
            'nilai' => $request->nilai
        ]);


        $respError = FALSE;
        $respMesssage = '';


        if($result){
            $respError = TRUE;
            $respMesssage = 'Update data nilai berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat Update data';
        }

        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
    function RemoveSpecialChapr($value){
        $title = str_replace( array( '\'', '"', ',' , ';', '<', '>' ), ' ', $value);
        return $title;
    }
}