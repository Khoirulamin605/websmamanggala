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
    // $jumlah_tanggal =  cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
    $jumlah_tanggal = 31;
@endphp
<!-- ============================================================== -->
<!-- Content -->
<!-- ============================================================== -->
<div class="p-10" style="background-color:white;">
    <div class="row m-0">
        <div class="col-sm-3 pt-2">
            <select class="form-control" id="tahun">
                <option selected value="">--- Pilih Tahun ---</option>
                @for ($tahun = 2016; $tahun <= date('Y'); $tahun++)
                <option value="{{$tahun}}">{{$tahun}}</option>
                @endfor
            </select>
        </div>
        <div class="col-sm-3 pt-2">
            <select class="form-control" id="bulan">
                <option selected value="">--- Pilih Bulan ---</option>
                @for ($bulan = 1; $bulan <= 12; $bulan++)
                <option value="{{$bulan}}">
                    @php 
                    switch ($bulan) {
                        case "1":
                            echo "Januari";
                            break;
                        case "2":
                            echo "Februari";
                            break;
                        case "3":
                            echo "Maret";
                            break;
                        case "4":
                            echo "April";
                            break;
                        case "5":
                            echo "Mei";
                            break;
                        case "6":
                            echo "Juni";
                            break;
                        case "7":
                            echo "Juli";
                            break;
                        case "8":
                            echo "Agustus";
                            break;
                        case "9":
                            echo "September";
                            break;
                        case "10":
                            echo "Oktober";
                            break;
                        case "11":
                            echo "November";
                            break;
                        case "12":
                            echo "Desember";
                            break;
                        default:
                            echo "Bulan tidak ada";
                        }
                    @endphp
                </option>
                @endfor
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
    function resetDataTable(){
        $('#data_tables').DataTable().destroy();
        $('#tahun').prop('selectedIndex',0);
        $('#bulan').prop('selectedIndex',0);
        getDataTables();
    };
    function search(){
        $('#data_tables').DataTable().destroy();
        getDataTables($('#tahun').val(),$('#bulan').val());
    }
    function getDataTables(tahun,bulan){
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
                    "_token": "<?= csrf_token()?>",
                    bulan:bulan,
                    tahun:tahun
                }
            }
        });
    } 
</script>
@endpush