<?php


namespace App\Http\Controllers\Pegawai;

use Illuminate\Http\Request;
use DB;
use QrCode;
use Spipu\Html2Pdf\Html2Pdf;
// use App\Http\Libraries\AuthLibrary;


class AbsenPegawaiController{
    public function index(){
        // $code = DB::table('absen')->where('tanggal',date('d-m-Y'))->first();
        return view('page.pegawai.absen');
    }

    public function viewAbsensi(){
        return view('page.pegawai.laporan_absen');
    }
    public function detailAbsensi(Request $request){
        if(empty($request->bulan) && empty($request->tahun)){
            $bulan_ini = date("m-Y");
            // $hari = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
            $date = date('d');
            $hari = 31;
        }elseif($request->bulan.'-'.$request->tahun == date('m-Y')){
            $bulan_ini = date("m-Y");
            $date = date('d');
            $hari = 31;
        }else{
            if($request->bulan < 10){
                $bulan_ini = '0'.$request->bulan.'-'.$request->tahun;
            }else{
                $bulan_ini = $request->bulan.'-'.$request->tahun;
            }
            // $hari = cal_days_in_month(CAL_GREGORIAN,$request->bulan,$request->tahun);
            $date = 31;
            $hari = 31;
        }
        // Limit
        $limit = $request->input('length');
        $start = $request->input('start');
        $data_search = DB::table('pegawai');
        // $data_pegawai = DB::table('pegawai')->get();

        $totaldata = count($data_search->get());
        $posts = $data_search
                    ->offset($start)
                    ->limit($limit)
                    ->get();
        $totalFiltered = $totaldata;

        $data = array();

        // dd($bulan_ini);
        foreach($posts as $pegawai){
            $col = array();
            $col[] = $pegawai->nama_pegawai;
            for($tgl = 1; $tgl <= $hari; $tgl++){
                if($tgl <= $date){
                    if(strlen($tgl) == 1){
                        $tglnow = '0'.$tgl.'-'.$bulan_ini;
                    }else{
                        $tglnow = $tgl.'-'.$bulan_ini;
                    }
                    $data_absen = DB::table('absen')->where('tanggal',$tglnow)->where('id_pegawai',$pegawai->id)->first();
                    if($data_absen){
                        if($data_absen->masuk != '-' && $data_absen->pulang != '-'){
                            $col[] = 'HH';
                        }
                        elseif($data_absen->masuk != '-' && $data_absen->pulang != '-'){
                            $col[] = 'H-';
                        }
                        elseif($data_absen->masuk == '-' && $data_absen->pulang == '-'){
                            $col[] = '-';
                        }
                        else{
                            $col[] = 'A';
                        }
                    }else{
                        $col[] = '';
                    }
                }else{
                    $col[] = '';
                }
            }
            $data[] = $col;
        }

        echo json_encode(array(
            "draw"              => intval($request->input('draw')),
            "recordsTotal"      => intval($totaldata),
            "recordsFiltered"   => intval($totalFiltered),
            "data"              => $data
        ));
    }

    public function getDataAbsen(Request $request){
        $date_now = date('d-m-Y');
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
            $data_search = DB::table('v_absen')->where('tanggal', $date_now)->orderBy($order, $dir);
        }else{
            $search = $request->input('search.value');
            $data_search = DB::table('v_absen')
            ->where('tanggal', $date_now)
            ->where('nama_pegawai', 'like', "%{$search}%")
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
        $thid_date = date('d-m-Y');

        $respError = FALSE;
        $respMesssage = '';
        $qr_id = uniqid();

        $cek_data = DB::table('absen')->where('tanggal', $thid_date)->first();

        if($cek_data){
            $respMesssage = 'Absen Sudah dibuka';
        }else{
            // $data_pegawai = DB::table('v_jam')->where('hari', '=', $this_day)->get();
            // $data_pegawai_non_guru = DB::table('pegawai')->where('pegawai', '!=' , 1)->get();

            $pegawai = DB::table('pegawai')->where('status', '=' ,'Active')->get();


            $data_absen = array();
            for($data_awal = 0; $data_awal <= count($pegawai)-1; $data_awal++){
                $cek_v_jam = DB::table('v_jam')->where('hari', '=', $this_day)->where('id_pegawai',$pegawai[$data_awal]->id)->first();
                if($cek_v_jam){
                    $jam = $cek_v_jam->jumlah_jam;
                }else{
                    $jam = 0;
                }
                $data_absen[] = [
                    'id_pegawai' => $pegawai[$data_awal]->id,
                    'tanggal' => date('d-m-Y'),
                    'masuk' => '-',
                    'pulang' => '-',
                    'jumlah_jam' => $jam,
                    'keterangan' => '',
                    'bulan_tahun' => date('m-Y'),
                    'id_qr' => $qr_id
                ]; 
            }
            $result = DB::table('absen')->insert($data_absen);
            $result = 'ok';

            if($result){
                $respError = TRUE;
                $respMesssage = 'Absen telah dibuka';
            }else{
                $respMesssage = 'Terjadi kesalahan';
            }
        }
        
        $response = array(
            'status' => $respError,
            'message' => $respMesssage,
            'qr_id' => $qr_id
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

    public function cobaGenerate($qr){
        $data_array = json_encode(array(
            'tanggal' => date('d-m-yy'),
            'qr_id' => $qr
        ));
        $nama_file = 'absen_pegawai-'.date('d-m-yy').'.pdf';
        $data = QrCode::format('png')->size(250)->generate($data_array);
        $qr_tag = "
            <h2>Silahkan scan kode dibawah untuk melakukan absen</h2>
            <img src=data:image/png;base64,".base64_encode($data)."/>
        ";
        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($qr_tag);
        $html2pdf->output($nama_file);
        // return response($data);
        // return view('page.pegawai.qr_absen', compact('data'));
    }

    public function cekAbsensi(){
        $data = DB::table('absen')->where('tanggal',date('d-m-Y'))->first();
        if($data){
            $result = $data;
        }else{
            $result = FALSE;
        }
        return response()->json($result);
    }

}