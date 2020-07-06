<?php


namespace App\Http\Controllers\Pegawai;

use Illuminate\Http\Request;
use DB;


class AbsenPegawaiController{
    public function index(){
        return view('page.pegawai.absen');
    }

    public function getDataAbsen(Request $request){
        $columns = array(
            0 =>'id',
            1 =>'nama_pegawai',
            2 =>'tanggal',
            3 =>'masuk',
            4 =>'pulang',
            // 5 =>'keterangan'
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        
        if(empty($request->input('search.value'))){
            $data_search = DB::table('v_absen')->orderBy($order, $dir);
        }else{
            $search = $request->input('search.value');
            $data_search = DB::table('v_absen')
            ->where('id', 'like', "%{$search}%")
            ->orWhere('nama_pegawai', 'like', "%{$search}%")
            // ->orWhere('keterangan', 'like', "%{$search}%")
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

                if($row->masuk == '-'){
                    $button = "<button class='btn btn-outline-success btn-sm' onClick=\"masuk('$row->id')\">Masuk</button> ";
                }elseif($row->masuk != '-' && $row->pulang != '-'){
                    $button = "-";
                }else{
                    $button = "<button class='btn btn-outline-primary btn-sm' onClick=\"pulang('$row->id')\">Pulang</button>";

                }

                $nestedData['action'] =  $button;
                $nestedData['nama_pegawai'] =  $row->nama_pegawai;
                $nestedData['tanggal'] =  $row->tanggal;
                $nestedData['masuk'] =  $row->masuk;
                $nestedData['pulang'] =  $row->pulang;
                // $nestedData['keterangan'] =  $row->keterangan;
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

    public function bukaAbsen(){

        $this_day = date('N');
        $thid_date = date('d-m-yy');

        $respError = FALSE;
        $respMesssage = '';

        $cek_data = DB::table('absen')->where('tanggal', $thid_date)->first();

        if($cek_data){
            $respMesssage = 'Absen Sudah digenerate';
        }else{
            $data_pegawai = DB::table('v_jam')->where('hari', '=', $this_day)->get();
            $data_pegawai_non_guru = DB::table('pegawai')->where('pegawai', '!=' , 1)->get();

            $data_absen = array();
            for($data_awal = 0; $data_awal <= count($data_pegawai)-1; $data_awal++){
                $data_absen[] = [
                    'id_pegawai' => $data_pegawai[$data_awal]->id_pegawai,
                    'tanggal' => date('d-m-yy'),
                    'masuk' => '-',
                    'pulang' => '-',
                    'jumlah_jam' => $data_pegawai[$data_awal]->jumlah_jam,
                    'keterangan' => ''
                ]; 
            }
            for($data_awal1 = 0; $data_awal1 <= count($data_pegawai_non_guru)-1; $data_awal1++){
                $data_absen[] = [
                    'id_pegawai' => $data_pegawai_non_guru[$data_awal1]->id,
                    'tanggal' => date('d-m-yy'),
                    'masuk' => '-',
                    'pulang' => '-',
                    'jumlah_jam' => 0,
                    'keterangan' => ''
                ]; 
            }
            // dd($data_absen);

            $result = DB::table('absen')->insert($data_absen);

            if($result){
                $respError = TRUE;
                $respMesssage = 'Absen telah dibuka';
            }else{
                $respMesssage = 'Terjadi kesalahan';
            }
        }
        
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }

    public function hadir($id){
        date_default_timezone_set("Asia/Bangkok");
        $respError = FALSE;
        $respMesssage = '';
        $result = DB::table('absen')->where('id',$id)->update([
            'masuk' => date('H:i:s')
        ]);
        if($result){
            $respError = TRUE;
            $respMesssage = 'Berhasil';
        }else{
            $respMesssage = 'Gagal';
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }

    public function pulang($id){
        date_default_timezone_set("Asia/Bangkok");
        $respError = FALSE;
        $respMesssage = '';
        $result = DB::table('absen')->where('id',$id)->update([
            'pulang' => date('H:i:s')
        ]);
        if($result){
            $respError = TRUE;
            $respMesssage = 'Berhasil';
        }else{
            $respMesssage = 'Gagal';
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }

    public function izin($id){
        date_default_timezone_set("Asia/Bangkok");
        $respError = FALSE;
        $respMesssage = '';
        $result = DB::table('absen')->where('id',$id)->update([
            'masuk' => date('H:i:s')
        ]);
        if($result){
            $respError = TRUE;
            $respMesssage = 'Berhasil';
        }else{
            $respMesssage = 'Gagal';
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
}