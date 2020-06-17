@extends('layouts.app')

@section('content')

    <!-- ============================================================== -->
    <!-- Breadcrumb -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Data Pegawai</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Pegawai</a></li>
                <li class="breadcrumb-item active">Data Pegawai</li>
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
                    <button type="" class="btn btn-primary mt-2" data-toggle="modal" data-target="#addData"><i class="mdi mdi-plus mr-2"></i> Tambah </button>
                    <!-- <button type="" class="btn btn-success mt-2" data-toggle="modal" data-target="#importData"><i class="mdi mdi-file-excel mr-2"></i> Import </button> -->
                    <table id="data_tables" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>ID Jurusan</th>
                                <th>Nama Jurusan</th>
                                <th>Kepala Jurusan</th>
                                <th>Status</th>
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