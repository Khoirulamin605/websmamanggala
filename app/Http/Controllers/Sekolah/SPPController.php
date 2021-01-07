<?php

namespace App\Http\Controllers\Sekolah;
use Illuminate\Http\Request;
use DB;



class SPPController{
    public function index(){
        // generate tahun
        $tahun = DB::table('spp')->select('periode')->groupBy('periode')->get();
        // $tahun = array();
        // dd(substr($tahun_from_db[0]->periode, -4));
        return view('page.sekolah.spp',compact(['tahun']));
    }
    public function spp(Request $request){
        $columns = array(
            0 =>'id',
            1 =>'nama_siswa',
            2 =>'periode',
            3 =>'tgl_bayar',
            4 =>'nominal',
            5 =>'status'
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        if(empty($request->search_tahun) && empty($request->search_bulan) && empty($request->search_status)){
            $mydate=getdate(date("U"));
            $periode = $mydate['mon'].'/'.$mydate['year'];
            $data_search = DB::table('v_spp')->where('periode', '=',$periode)->orderBy($order, $dir);
        }elseif($request->search_tahun && $request->search_bulan && $request->search_status){
            $periode = $request->search_bulan.'/'.$request->search_tahun;
            $data_search = DB::table('v_spp')
            ->where('periode', '=',$periode)
            ->where('status', '=', $request->search_status)
            ->orderBy($order, $dir);
        }elseif($request->search_tahun && $request->search_bulan){
            $periode = $request->search_bulan.'/'.$request->search_tahun;
            $data_search = DB::table('v_spp')
            ->where('periode', '=',$periode)
            ->orderBy($order, $dir);
        }elseif($request->search_tahun && $request->search_status){
            $data_search = DB::table('v_spp')
            ->where('periode', 'like',  "%{$request->search_tahun}%")
            ->where('status', '=', $request->search_status)
            ->orderBy($order, $dir);
        }elseif($request->search_status){
            $data_search = DB::table('v_spp')
            ->where('status', '=', $request->search_status)
            ->orderBy($order, $dir);
        }else{
            // dd('as');
            $search = $request->input('search.value');
            $data_search = DB::table('v_spp')
            ->where('nama_siswa', 'like', "%{$search}%")
            ->orWhere('periode', 'like', "%{$search}%")
            ->orWhere('tgl_bayar', 'like', "%{$search}%")
            ->orWhere('nominal', 'like', "%{$search}%")
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
                if($row->status == 'Lunas'){
                    $buttonLunas = "-";
                }else{
                    $buttonLunas = "<button class='btn btn-outline-success btn-sm' 
                                        onClick=\"getLunas('$row->id')\">Lunas</button>";
                }
                // $nestedData['id'] =  $row->no_induk;
                $nestedData['nama_siswa'] =  $row->nama_siswa;
                $nestedData['periode'] =  $this->format_bulan($row->periode);
                $nestedData['tgl_bayar'] =  $row->tgl_bayar;
                $nestedData['nominal'] =  $row->nominal;
                $nestedData['status'] =  $row->status;
                $nestedData['action'] = $buttonLunas; 
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
    public function generate(Request $request){
        $respError = FALSE;
        $respMesssage = '';

        $mydate=getdate(date("U"));
        $periode = $mydate['mon'].'/'.$mydate['year'];

        $cek_data = DB::table('v_spp')->where('periode', $periode)->first();

        if($cek_data){
            $respError = FALSE;
            $respMesssage = 'Periode bulan ini sudah di generate';
        }else{  
            $data_siswa = DB::table('siswa')->select('id')->where('status_aktif', 'Active')->get();
            for($array_start = 0; $array_start <= count($data_siswa)-1; $array_start++){
                $array_spp[] = [
                    'id_siswa' => $data_siswa[$array_start]->id,
                    'periode' => $periode,
                    'nominal' => $request->nominal,
                    'status' => 'Belum Dibayar'
                ];
            }

            $result = DB::table('spp')->insert($array_spp);
            if($result){
                $respError = TRUE;
                $respMesssage = 'Generete Sukses';
            }else{
                $respMesssage = 'Generate Gagal';
            }
        }


        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
    public function getLunas($id){
        $respError = FALSE;
        $respMesssage = '';
        
        $result = DB::table('spp')->where('id', $id)->update([
            'tgl_bayar' => date("Y-m-d", time()),
            'status' => 'Lunas'
        ]);
        if($result){
            $respError = TRUE;
            $respMesssage = 'Spp Sudah dilunasi';
        }else{
            $respMesssage = 'Gagal';
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }

    public function format_bulan($date){
        $bulan = explode("/",$date);
        $periode = '';

        switch ($bulan[0]) {
            case "1":
                $periode = "Januari-".$bulan[1];
                break;
            case "2":
                $periode =  "Februari-".$bulan[1];
                break;
            case "3":
                $periode =  "Maret-".$bulan[1];
                break;
            case "4":
                $periode =  "April-".$bulan[1];
                break;
            case "5":
                $periode =  "Mei-".$bulan[1];
                break;
            case "6":
                $periode =  "Juni-".$bulan[1];
                break;
            case "7":
                $periode =  "Juli-".$bulan[1];
                break;
            case "8":
                $periode =  "Agustus-".$bulan[1];
                break;
            case "9":
                $periode =  "September-".$bulan[1];
                break;
            case "10":
                $periode =  "Oktober-".$bulan[1];
                break;
            case "11":
                $periode =  "November-".$bulan[1];
                break;
            case "12":
                $periode =  "Desember-".$bulan[1];
                break;
            default:
                $periode =  "Not Read";
            }
        return $periode;
    }
}