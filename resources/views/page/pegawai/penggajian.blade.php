@extends('layouts.app')

@section('content')

<!-- ============================================================== -->
<!-- Breadcrumb -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Penggajian Pegawai</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pegawai</a></li>
            <li class="breadcrumb-item active">Penggajian Pegawai</li>
        </ol>
    </div>
</div>

<!-- ============================================================== -->
<!-- Content -->
<!-- ============================================================== -->
<div class="p-10" style="background-color:white;">
    <div class="row m-0">
        <div class="col-sm-6 pt-2">
            <button type="" class="btn btn-primary mt-2" onclick="bukaPenggajian()"><i class="mdi mdi-plus mr-2"></i> Buka Penggajian </button>
        </div>
        <div class="col-sm-3 pt-2">
            <select class="form-control" id="periode">
                <option selected value="">--- Pilih Periode ---</option>
                @foreach ($periode as $periode)
                    <option value="{{$periode->periode}}">{{$periode->periode}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3 pt-2">
            <button type="button" class="btn btn-success" onclick="search()"><i class="mdi mdi-magnify mr-2"></i>Search</button>
            <button type="button" class="btn btn-warning" onclick="resetDataTable()"><i class="mdi mdi-undo mr-2"></i>Reload</button>
        </div>
    </div>
    <div class="row p-0 m-0">
        <div class="col">
            <div class="table-responsive">
                <!-- <button type="" class="btn btn-success mt-2" data-toggle="modal" data-target="#importData"><i class="mdi mdi-file-excel mr-2"></i> Import </button> -->
                <table id="data_tables" class="table table-striped table-bordered no-wrap">
                    <thead>
                        <tr>
                            <th>Nama Pegawai</th>
                            <th>Periode</th>
                            {{-- <th>Jumlah Jam</th> --}}
                            <th>Gaji</th>
                            <th>Tugas Tambahan</th>
                            <th>Total</th>
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
    function resetDataTable(){
        $('#data_tables').DataTable().destroy();
        $('#periode').prop('selectedIndex',0);
        getDataTables();
    };
    function search(){
        $('#data_tables').DataTable().destroy();
        getDataTables($('#periode').val());
    }
    function getDataTables(periode){
        $('#data_tables').DataTable({
            lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": {
                "url" : "/pegawai/get_data_gaji",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "<?= csrf_token()?>",
                    periode:periode
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
                {"data": "nama_pegawai"},
                {"data": "periode"},
                {"data": "gaji"},
                {"data": "tambahan"},
                {"data": "total"}
            ]
        });
    } 
    function bukaPenggajian(){
        $.get(`/pegawai/buka_penggajian`, function(data){
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
</script>
@endpush