<?php

namespace App\Http\Controllers\Sekolah;
use Illuminate\Http\Request;
use DB;



class KeuanganController {

    public function index(){
        return view('page.sekolah.keuangan');
    }

    public function getKeuangan(Request $request){

        $columns = array(
            0 =>'id',
            1 =>'uang_masuk',
            2 =>'uang_keluar',
            3 =>'slado_akhir',
            4 =>'tanggal',
            5 =>'keterangan'
        );

        // Limit
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');


        if(empty($request->search_tahun) && empty($request->search_bulan)){
            $data_search = DB::table('keuangan')->orderBy($order, $dir);
        }elseif($request->search_tahun && $request->search_bulan){
            // create date
            $date = $request->search_tahun.'-'.$request->search_bulan;
            $data_search = DB::table('keuangan')
            ->where('tanggal', 'like', "%{$date}%")
            ->orderBy($order, $dir);
        }elseif($request->search_tahun){
            $data_search = DB::table('keuangan')
            ->where('tanggal', 'like', "%{$request->search_tahun}%")
            ->orderBy($order, $dir);
        }elseif($request->search_bulan){
            $data_search = DB::table('keuangan')
            ->where('tanggal', 'like', "%{$request->search_bulan}%")
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
            foreach($posts as $res){

                $row = array();

                $row[] =  "<button class='btn btn-outline-warning btn-sm' 
                            onClick=\"setData('$res->id','$res->uang_masuk','$res->uang_keluar','$res->saldo_akhir','$res->tanggal','$res->keterangan')\"
                            data-toggle='modal' data-target='#updateData'>Edit</button>
                            <button class='btn btn-outline-danger btn-sm' onClick=\"hapusData('$res->id')\">Hapus</button>";
                $row[] =  number_format($res->uang_masuk);
                $row[] =  number_format($res->uang_keluar);
                $row[] =  number_format($res->saldo_akhir);
                $row[] =  $res->tanggal;
                $row[] =  $res->keterangan;

                $data[] = $row;
            }
        }

        echo json_encode(array(
            "draw"              => intval($request->input('draw')),
            "recordsTotal"      => intval($totaldata),
            "recordsFiltered"   => intval($totalFiltered),
            "data"              => $data
        ));
    }

    public function insert_keuangan(Request $request){
        $respError = FALSE;
        $respMesssage = '';

        $saldo = DB::table('keuangan')->select('saldo_akhir as saldo')->orderByDesc('id')->limit(1)->first();
        if($request->jenis_uang == 'masuk'){
            $result = DB::table('keuangan')->insert([
                'uang_masuk' => $request->nominal,
                'uang_keluar' => 0,
                'saldo_akhir' => $saldo->saldo + $request->nominal,
                'keterangan' => $request->keterangan,
                'tanggal' => $request->tanggal
            ]);
        }else{
            $result = DB::table('keuangan')->insert([
                'uang_masuk' => 0,
                'uang_keluar' => $request->nominal,
                'saldo_akhir' => $saldo->saldo - $request->nominal,
                'keterangan' => $request->keterangan,
                'tanggal' => $request->tanggal
            ]);
        }

        if($result){
            $respError = TRUE;
            $respMesssage = 'Input data keuangan berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat input data';
        }

        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
    public function update_keuangan(Request $request){
        $respError = FALSE;
        $respMesssage = '';

        $result = DB::table('keuangan')->where('id', $request->id)->update([
            // 'uang_masuk' => $request->nominal,
            // 'uang_keluar' => 0,
            // 'saldo_akhir' => $saldo->saldo + $request->nominal,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal
        ]);

        if($result){
            $respError = TRUE;
            $respMesssage = 'Update data keuangan berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat Update data';
        }

        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
    public function delete($id){
        $respError = FALSE;
        $respMesssage = '';
        $result = DB::table('keuangan')->where('id', $id)->delete();
        if($result){
            $respError = TRUE;
            $respMesssage = 'Hapus data keuangan berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat input data';
        }
        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
}