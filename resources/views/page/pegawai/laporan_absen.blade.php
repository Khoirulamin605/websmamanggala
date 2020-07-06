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
                        <tr align="center" >
                            <th colspan="{{$jumlah_tanggal}}">@php
                                echo date('F');
                            @endphp</th>
                        </tr>
                        <tr>
                            <td>Nama</td>
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
</script>
@endpush