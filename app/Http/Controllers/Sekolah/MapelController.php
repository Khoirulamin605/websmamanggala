<?php

namespace App\Http\Controllers\Sekolah;
use Illuminate\Http\Request;
use DB;



class MapelController{
    public function index(){
        $jurusan = DB::table('jurusan')->get();
        $jurusan1 = DB::table('jurusan')->get();
        $wali_kelas = DB::table('pegawai')->get();
        $wali_kelas1 = DB::table('pegawai')->get();
        return view('page.sekolah.mapel', compact(['jurusan','jurusan1','wali_kelas','wali_kelas1']));
    }
    public function mapel(Request $request){

        $columns = array(
            0 =>'id',
            1 =>'nama_mapel',
            2 =>'jurusan',
            3 =>'kelas',
            4 =>'guru_pengajar',
            5 =>'status'
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $data_search = DB::table('mapel')->orderBy($order, $dir);
        }else{
            $search = $request->input('search.value');
            $data_search = DB::table('mapel')
            ->where('nama_mapel', 'like', "%{$search}%")
            ->orWhere('jrurusan', 'like', "%{$search}%")
            ->orWhere('kelas', 'like', "%{$search}%")
            ->orWhere('guru_pengajar', 'like', "%{$search}%")
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

                // $nestedData['id'] =  $row->no_induk;
                $nestedData['nama_mapel'] =  $row->nama_mapel;
                $nestedData['jurusan'] =  $row->jurusan;
                $nestedData['kelas'] =  $row->kelas;
                $nestedData['guru_pengajar'] =  $row->guru_pengajar;
                $nestedData['status'] =  $row->status;
                $nestedData['action'] = "<button class='btn btn-outline-warning btn-sm' 
                                        onClick=\"setData('$row->id','$row->nama_mapel','$row->jurusan','$row->kelas','$row->guru_pengajar','$row->status')\"
                                        data-toggle='modal' data-target='#updateData'>Edit</button>
                                        <button class='btn btn-outline-danger btn-sm' onClick=\"hapusData('$row->id')\">Hapus</button>"; 
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
    public function insertMapel(Request $request){
        $result = DB::table('mapel')->insert([
            'nama_mapel' => $request->nama_mapel,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'guru_pengajar' => $request->pengajar,
            'status' => $request->status
        ]);


        $respError = FALSE;
        $respMesssage = '';


        if($result){
            $respError = TRUE;
            $respMesssage = 'Input data mapel berhasil';
        }else{
            $respMesssage = 'Terjadi kesalahan saat input data';
        }

        $response = array(
            'status' => $respError,
            'message' => $respMesssage
        );

        return response()->json($response);
    }
    public function updateMapel(Request $request){
        $result = DB::table('mapel')->where('id', $request->id)->update([
            'nama_mapel' => $request->nama_mapel,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'guru_pengajar' => $request->pengajar,
            'status' => $request->status
        ]);


        $respError = FALSE;
        $respMesssage = '';


        if($result){
            $respError = TRUE;
            $respMesssage = 'Update data mapel berhasil';
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
        $result = DB::table('mapel')->where('id', $id)->delete();
        if($result){
            $respError = TRUE;
            $respMesssage = 'Hapus data mapel berhasil';
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