@extends('layouts.app')

@section('content')

<!-- ============================================================== -->
<!-- Breadcrumb -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Data Absensi Pegawai</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pegawai</a></li>
            <li class="breadcrumb-item active">Data Absensi Pegawai</li>
        </ol>
    </div>
</div>
@php
    $jumlah_tanggal =  cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
                                // dd($absen);
@endphp
<!-- ============================================================== -->
<!-- Content -->
<!-- ============================================================== -->
<div class="p-10" style="background-color:white;">
    <div class="row p-0 m-0">
        <div class="col">
            <div class="table-responsive">
                {{-- <button type="" class="btn btn-primary mt-2" onclick="bukaAbsensi()"><i class="mdi mdi-plus mr-2"></i> Buka Absen </button> --}}
                <!-- <button type="" class="btn btn-success mt-2" data-toggle="modal" data-target="#importData"><i class="mdi mdi-file-excel mr-2"></i> Import </button> -->
                <table id="data_tables" class="table table-striped table-bordered no-wrap">
                    <thead>
                        <tr>
                            <td rowspan="2" align="center" style="vertical-align:middle">Nama</td>
                            <td colspan="{{$jumlah_tanggal}}" align="center">Tanggal</td>
                        </tr>
                        <tr>
                            @for ($i = 1; $i <= $jumlah_tanggal; $i++)
                                <td>{{$i}}</td>
                            @endfor
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
    function getDataTables(){
        $('#data_tables').DataTable({
            lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ordering": false,
            "ajax": {
                "url" : "/pegawai/get_view_absen",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "<?= csrf_token()?>"
                }
            }
        });
    } 
</script>
@endpush