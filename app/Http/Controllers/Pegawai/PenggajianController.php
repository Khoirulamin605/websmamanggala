<?php

namespace App\Http\Controllers\Pegawai;

use Illuminate\Http\Request;
use DB;

class PenggajianController{
    public function index(){
        $periode = DB::table('v_penggajian')->select('periode')->groupBy('periode')->get();
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
        if(empty($request->periode)){
            $data_search = DB::table('v_penggajian')->where('periode',$month_now)->orderBy($order, $dir);
        }else{;
            $data_search = DB::table('v_penggajian')
            ->where('periode', $request->periode)
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


                $nestedData['nama_pegawai'] =  $row->nama_pegawai;
                $nestedData['periode'] =  $row->periode;
                $nestedData['gaji'] =  $row->gaji;
                $nestedData['tambahan'] =  $row->tambahan;
                $nestedData['total'] =  $row->total;
                
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
}