@extends('layouts.app')


@section('content')

<!-- ============================================================== -->
<!-- Breadcrumb -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Data Siswa Non Aktif</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Siswa</a></li>
            <li class="breadcrumb-item active">Data Siswa Non Aktif</li>
        </ol>
    </div>
</div>

<!-- ============================================================== -->
<!-- Content -->
<!-- ============================================================== -->
<div class="p-10" style="background-color:white;">
    <div class="row m-0">
        <div class="col-sm-3 pt-2">
            <select class="form-control" id="search_kelas">
                <option selected value="">--- Pilih Tahun Lulus ---</option>
                @for ($i = 2016; $i <= date("Y"); $i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="col-sm-3 pt-2">
            <input type="text" id="search_siswa" placeholder="Masukkan Nama Siswa" class="form-control">
        </div>
        <div class="col-sm-3 pt-2">
            <button type="button" class="btn btn-success" onclick="search()"><i class="mdi mdi-magnify mr-2"></i>Search</button>
            <button type="button" class="btn btn-warning" onclick="resetDataTable()"><i class="mdi mdi-undo mr-2"></i>Reload</button>
        </div>
    </div>
    <div class="row p-0 m-0">
        <div class="col">
            <div class="table-responsive">
                <table id="data_tables" class="table table-striped table-bordered no-wrap">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>No. Induk</th>
                            <th>Nama</th>
                            <th>Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Ortu/Wali</th>
                            <th>Tahun Lulus</th>
                        </tr>
                    </thead>
                    <tbody class="small"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <!-- Modal VIew -->
    <div class="modal fade" id="viewSiswa" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="viewSiswaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewSiswaLabel">View Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pl-0 pr-0">
                    <div class="row m-0">
                        <div class="col-sm-12">
                            <table class="table table-striped">
                                <tr>
                                    <th width="150px">No Induk</th>
                                    <td><span id="no_induk"></span></td>
                                </tr>
                                <tr>
                                    <th width="150px">Nama</th>
                                    <td><span id="nama_siswa"></span></td>
                                </tr>
                                <tr>
                                    <th width="150px">Lahir</th>
                                    <td><span id="lahir"></span></td>
                                </tr>
                                <tr>
                                    <th width="150px">Jenis Kelamin</th>
                                    <td><span id="jenis_kelamin"></span></td>
                                </tr>
                                <tr>
                                    <th width="150px">Alamat</th>
                                    <td><span id="alamat"></span></td>
                                </tr>
                                <tr>
                                    <th width="150px">Ortu/Wali</th>
                                    <td><span id="wali"></span></td>
                                </tr>
                                <tr>
                                    <th width="150px">Kelas</th>
                                    <td><span id="kelas"></span></td>
                                </tr>
                                <tr>
                                    <th width="150px">Jurusan</th>
                                    <td><span id="jurusan"></span></td>
                                </tr>
                                <tr>
                                    <th width="150px">Alasan Keluar</th>
                                    <td><span id="alasan_keluar"></span></td>
                                </tr>
                                <tr>
                                    <th width="150px">Tanggal Keluar</th>
                                    <td><span id="tanggal_keluar"></span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@push('scripts')

<script>
    function resetDataTable(){
        $('#data_tables').DataTable().destroy();
        $('#search_kelas').prop('selectedIndex',0);
        $('#search_siswa').val('');
        getDataTables();
    };
    function search(){
        $('#data_tables').DataTable().destroy();
        getDataTables($('#search_kelas').val(),$('#search_siswa').val());
    }
    getDataTables()
    // getJurusan()
    function getDataTables(search_kelas,search_siswa){
        $('#data_tables').DataTable({
            lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": {
                "url" : "/siswa/get_alumni",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "<?= csrf_token()?>", 
                    search_tahun : search_kelas,
                    search_siswa:search_siswa
                }
            },
            "buttons": [
                "csv","excel","pdf","print"
            ],
            "columns" : [
                {"data": "action"},
                {"data": "no_induk"},
                {"data": "nama_siswa"},
                {"data": "lahir"},
                {"data": "jenis_kelamin"},
                {"data": "alamat"},
                {"data": "wali"},
                {"data": "tanggal_keluar"},
            ]
        });
    }  
    function setData(no_induk, nama_siswa, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, kelas, jurusan, alasan_keluar, wali, tanggal_keluar){
        $("#no_induk").html(no_induk);
        $("#nama_siswa").html(nama_siswa);
        $("#lahir").html(tempat_lahir+', '+tanggal_lahir);
        $("#jenis_kelamin").html(jenis_kelamin);
        $("#alamat").html(alamat);
        $("#kelas").html(kelas);
        $("#jurusan").html(jurusan);
        $("#alasan_keluar").html(alasan_keluar);
        $("#wali").html(wali);
        $("#tanggal_keluar").html(tanggal_keluar);
    }

</script>
    
@endpush