@extends('layouts.app')

@section('content')

<!-- ============================================================== -->
<!-- Breadcrumb -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Absensi Pegawai</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pegawai</a></li>
            <li class="breadcrumb-item active">Absensi Pegawai</li>
        </ol>
    </div>
</div>

<!-- ============================================================== -->
<!-- Content -->
<!-- ============================================================== -->
<div class="p-10" style="background-color:white;">
    <div class="row p-0 m-0">
        <div class="col">
            <div class="table-responsive">
                <button type="" class="btn btn-primary mt-2" onclick="bukaAbsensi()"><i class="mdi mdi-plus mr-2"></i> Buka Absen </button>
                {{-- <a href="" id="link_qr" target="_blank" class="btn btn-success mt-2 disabled"><i class="mdi mdi-qrcode mr-2"></i> QRCode Absen </a> --}}
                <!-- <button type="" class="btn btn-success mt-2" data-toggle="modal" data-target="#importData"><i class="mdi mdi-file-excel mr-2"></i> Import </button> -->
                <table id="data_tables" class="table table-striped table-bordered no-wrap">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Nama Pegawai</th>
                            <th>Tanggal Absen</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                            {{-- <th>Keterangan</th> --}}
                        </tr>
                    </thead>
                    <tbody class="small"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    getDataTables();
    cekData();
    function cekData(){
        $.get('/pegawai/cek_absensi', function(data, status){
            if(data){
                $('#link_qr').removeClass('disabled');
                $('#link_qr').attr("href", `/get_qr_absen/${data.id_qr}`);
            }
        });
    }
    function getDataTables(){
        $('#data_tables').DataTable({
            lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
            "processing": true,
            "serverSide": true,
            // "searching": false,
            "ajax": {
                "url" : "/pegawai/get_absen_aktif",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "<?= csrf_token()?>"
                }
            },
            "dom": 'lBfrtip',
            "buttons": [
                    {
                        "extend": 'excel',
                        className:'ml-3 btn-sm',
                        "exportOptions": {
                            "columns": ':not(.notexport)'
                        }
                    },
                    {
                        "extend": 'pdf',
                        className:'ml-3 btn-sm',
                        "exportOptions": {
                            "columns": ':not(.notexport)'
                        }
                    }
            ],
            "columns" : [
                {"data": "action"},
                {"data": "nama_pegawai"},
                {"data": "tanggal"},
                {"data": "masuk"},
                {"data": "pulang"},
                // {"data": "keterangan"}
            ]
        });
    } 
    function bukaAbsensi(){
        $.get(`/pegawai/buka_absensi`, function(data){
            if(data.status){
                Swal.fire({
                    title: 'Sukses',
                    text: data.message,
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    allowOutsideClick :false,
                }).then((result) => {
                    // window.open(`/get_qr_absen/${data.qr_id}`, '_blank');
                    if (result.value) {               
                        // $('#link_qr').removeClass('disabled');
                        // $('#link_qr').attr("href", `/get_qr_absen/${data.qr_id}`);
                        $('#data_tables').DataTable().ajax.reload();
                    }
                })
            }else{
                Swal.fire(
                    'Gagal',
                    data.message,
                    'error'
                )
            }
        });
    }
    function masuk(id){
        Swal.fire({
            title: 'Konfirmasi',
            text: "Pegawai sudah hadir ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor:'#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.value) {
                $.get(`/pegawai/hadir/${id}`, function(data){
                    if(data.status){
                        Swal.fire({
                            title: 'Sukses',
                            text: data.message,
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            allowOutsideClick :false,
                        }).then((result) => {
                            if (result.value) {
                                $('#data_tables').DataTable().ajax.reload();
                            }
                        })
                    }else{
                        Swal.fire(
                            'Gagal',
                            data.message,
                            'error'
                        )
                    }
                });
            }
        })
    }
    function pulang(id){
        Swal.fire({
            title: 'Konfirmasi',
            text: "Pegawai sudah pulang ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor:'#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.value) {
                $.get(`/pegawai/pulang/${id}`, function(data){
                    if(data.status){
                        Swal.fire({
                            title: 'Sukses',
                            text: data.message,
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            allowOutsideClick :false,
                        }).then((result) => {
                            if (result.value) {
                                $('#data_tables').DataTable().ajax.reload();
                            }
                        })
                    }else{
                        Swal.fire(
                            'Gagal',
                            data.message,
                            'error'
                        )
                    }
                });
            }
        })
    }
</script>
@endpush