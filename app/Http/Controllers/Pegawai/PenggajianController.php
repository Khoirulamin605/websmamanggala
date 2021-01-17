<?php

namespace App\Http\Controllers\Pegawai;

use Illuminate\Http\Request;
use DB;
use App\Http\Model\Pegawai;
use App\Http\Model\Absen;
use App\Http\Model\Jabatan;


class PenggajianController{
    public function index(){
        $periode =Absen::select('bulan_tahun')->groupBy('bulan_tahun')->get();
        // dd($periode);
        return view('page.pegawai.penggajian', compact('periode'));
    }

    public function getDataPenggajian(Request $request){
        // $date_now = date('d-m-yy');
        $columns = array(
            0 =>'nama_pegawai',
            1 =>'periode',
            2 =>'gaji',
            3 =>'tambahan',
            4 =>'total',
            // 5 =>'keterangan'
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        $month_now = date('m-yy');
        $data_search = Pegawai::where('status', 'Active')->orderBy($order, $dir);
        if(empty($request->periode)){
            $periode = date('m-Y');
        }else{
            $periode = $request->periode;
        }


        $totaldata = count($data_search->get());
        $posts = $data_search
                    ->offset($start)
                    ->limit($limit)
                    ->get();
        $totalFiltered = $totaldata;

        $data = array();
        if($posts){
            foreach($posts as $posts){
                $tugas_tambahan = Jabatan::where('jabatan', $posts->tugas_tambahan)->first();
                $gaji_pokok = Jabatan::where('jabatan', 'Guru')->first();
                $absen = Absen::where('id_pegawai', $posts->id)
                    ->where('bulan_tahun', $periode)
                    ->where('masuk', '!=', '-')
                    ->where('pulang', '!=', '-')->select('jumlah_jam')->sum('jumlah_jam');
                if($tugas_tambahan){
                    $gaji_tambahan = $tugas_tambahan->gaji;
                }else{
                    $gaji_tambahan = 0;
                }
                
                // $row = array();
                $nestedData['nama_pegawai'] = $posts->nama_pegawai;
                $nestedData['periode'] =  $this->format_bulan($periode);
                $nestedData['gaji'] = $absen * $gaji_pokok->gaji;
                $nestedData['tambahan'] = $gaji_tambahan;
                $nestedData['total'] = $gaji_tambahan + ($absen * $gaji_pokok->gaji);
                $data[] = $nestedData;
                // $gaji[] = $row;
            }
        // dd($gaji);

        }
        echo json_encode(array(
            "draw"              => intval($request->input('draw')),
            "recordsTotal"      => intval($totaldata),
            "recordsFiltered"   => intval($totalFiltered),
            "data"              => $data
        ));
    }
    public function bukaPenggajian(){
        $month_now = date('m-yy');

        $cek_data = DB::table('penggajian')->where('periode', $month_now)->first();
        if($cek_data){
            $jumlah_jam = DB::table('v_penghitung_gaji')->where('bulan_tahun',$month_now)->get();;
            // $data_gaji = array();
            for($data_awal = 0; $data_awal <= count($jumlah_jam)-1; $data_awal++){

                if($jumlah_jam[$data_awal]->total_jam == 0){
                    $gaji = $jumlah_jam[$data_awal]->gaji_pokok;
                }else{
                    $gaji = $jumlah_jam[$data_awal]->total_jam*$jumlah_jam[$data_awal]->gaji_pokok;
                }    

                if(is_null($jumlah_jam[$data_awal]->gaji_tambahan)){
                    $total = $gaji;
                    $gaji_tambahan = 0;
                }else{
                    $gaji_tambahan = $jumlah_jam[$data_awal]->gaji_tambahan;
                    $total = $gaji+$jumlah_jam[$data_awal]->gaji_tambahan;
                } 

                DB::table('penggajian')->where('id_pegawai', $jumlah_jam[$data_awal]->id_pegawai)->where('periode',$month_now)->update([
                    'total_jam' => $jumlah_jam[$data_awal]->total_jam,
                    'gaji' =>  $gaji ,
                    'tambahan' => $gaji_tambahan,
                    'total' => $total
                ]);  
            }
            $result = 'ok';
        }else{
            $jumlah_jam = DB::table('v_penghitung_gaji')->where('bulan_tahun',$month_now)->get();;
            $data_gaji = array();
            for($data_awal = 0; $data_awal <= count($jumlah_jam)-1; $data_awal++){

                if($jumlah_jam[$data_awal]->total_jam == 0){
                    $gaji = $jumlah_jam[$data_awal]->gaji_pokok;
                }else{
                    $gaji = $jumlah_jam[$data_awal]->total_jam*$jumlah_jam[$data_awal]->gaji_pokok;
                }    

                if(is_null($jumlah_jam[$data_awal]->gaji_tambahan)){
                    $total = $gaji;
                    $gaji_tambahan = 0;
                }else{
                    $gaji_tambahan = $jumlah_jam[$data_awal]->gaji_tambahan;
                    $total = $gaji+$jumlah_jam[$data_awal]->gaji_tambahan;
                } 

                $data_gaji[] = [
                    'id_pegawai' => $jumlah_jam[$data_awal]->id_pegawai,
                    'periode' => $month_now,
                    'total_jam' => $jumlah_jam[$data_awal]->total_jam,
                    'gaji' =>  $gaji ,
                    'tambahan' => $gaji_tambahan,
                    'total' => $total
                ]; 
            }
            $result = DB::table('penggajian')->insert($data_gaji); 

        }


        if($result){
            $respError = TRUE;
            $respMesssage = 'Selesai';
        }else{
            $respMesssage = 'Terjadi kesalahan';
        }
        
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }


    public function format_bulan($date){
        $bulan = explode("-",$date);
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

    public function fake_absen(){
        $data = array();

        for($day=1;$day<=17;$day++){
            // $data_sehari = array();
            if($day < 10){
                $day = '0'.$day;
            }
            if($day % 7 == 0){
                // $data[] = 'jumat';
            }else{
                for($pegawai=1;$pegawai<=22;$pegawai++){
                    $col['id_pegawai'] = $pegawai;
                    $col['tanggal'] = $day.'-01-2021';
                    $col['masuk'] = '07:30:13';
                    $col['pulang'] = '13:30:13';
                    $col['jumlah_jam'] = 4;
                    $col['keterangan'] = '';
                    $col['id_qr'] = 'ok';
                    $col['bulan_tahun'] = '01-2021';
                    $data[] = $col;
                }
            }
        }  
        DB::table('absen')->insert($data);
    }
}