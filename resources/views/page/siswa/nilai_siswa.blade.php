@extends('layouts.app')

@section('content')
<!-- ============================================================== -->
<!-- Breadcrumb -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Nilai Siswa</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Siswa</a></li>
            <li class="breadcrumb-item active">Nilai Siswa</li>
        </ol>
    </div>
</div>

<!-- ============================================================== -->
<!-- Content -->
<!-- ============================================================== -->
<div class="p-10" style="background-color:white;">
<div class="row m-0">
        <div class="col-sm-3 pt-2">
            <select class="form-control" id="search_jurusan">
                <option selected value="">--- Pilih Jurusan ---</option>
                @foreach ($jurusan as $jurusan)
                    <option value="{{$jurusan->id}}">{{$jurusan->jurusan}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3 pt-2">
            <select class="form-control" onchange="getSiswa()" id="search_kelas">
                <option selected value="">--- Pilih Kelas ---</option>
                <option value="Kelas X">Kelas X</option>
                <option value="Kelas XI">Kelas XI</option>
                <option value="Kelas XII">Kelas XII</option>
            </select>
        </div>
        <div class="col-sm-3 pt-2">
            <select class="form-control" id="search_mapel">
                <option selected value="">--- Pilih Nama Siswa ---</option>
            </select>
        </div>
    </div>
    <div class="row m-0">
        <div class="col-sm-3 pt-2">
            <select class="form-control" id="search_tahun">
                <option selected value="">--- Pilih tahun ---</option>
                @foreach ($tahun as $tahun)
                    <option value="{{$tahun->tahun_ajaran}}">{{$tahun->tahun_ajaran}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3 pt-2">
            <select class="form-control" id="search_semester">
                <option selected value="">--- Pilih Semester ---</option>
                <option value="Genap">Genap</option>
                <option value="Ganjil">Ganjil</option>
            </select>
        </div>
        <div class="col-sm-3 pt-2">
            <button type="button" class="btn btn-success" onclick="search()"><i class="mdi mdi-magnify mr-2"></i>Search</button>
        </div>
    </div>
    <div class="row p-0 m-0">
        <div class="col">
            <div class="table-responsive"> <table id="data_tables" class="table table-striped table-bordered no-wrap">
                    <thead>
                        <tr>
                            {{-- <th>Nama Siswa</th> --}}
                            <th>Jurusan</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Tahun Ajaran</th>
                            <th>Semester</th>
                            <th>Nilai</th>
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
    function clearForm(data){
        document.getElementById(data).reset();
    } 
    search()
    function search(){
        $('#data_tables').DataTable().destroy();
        getDataTables($('#search_jurusan').val(),$('#search_kelas').val(),$('#search_mapel').val(),$('#search_tahun').val(),$('#search_semester').val());
    }
    function getDataTables(search_jurusan,search_kelas,search_mapel,search_tahun,search_semester){
        $('#data_tables').DataTable({
            lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": {
                "url" : "/siswa/get_nilai_persiswa",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "<?= csrf_token()?>", 
                    search_jurusan : search_jurusan,
                    search_kelas : search_kelas,
                    search_nama:search_mapel,
                    search_tahun:search_tahun,
                    search_semester:search_semester
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
                // {"data": "nama_siswa"},
                {"data": "jurusan"},
                {"data": "kelas"},
                {"data": "nama_mapel"},
                {"data": "tahun_ajaran"},
                {"data": "semester"},
                {"data": "nilai"},
            ]
        });
    }  

    function getSiswa(){
        // console.log();
        $('#search_mapel')
            .empty()
            .append('<option selected="selected" value="">--- Pilih Nama Siswa ---</option>')
        ;
        var jurusanList = document.getElementById("search_mapel");
        $.post(`/siswa/get_siswa_by_kelas`,{
            jurusan :$('#search_jurusan option:selected').text(),
            kelas : $('#search_kelas').val()
        }, function(data){
            // console.log(data)
            for(array_jurusan = 0; array_jurusan < data.length; array_jurusan++){
                var jurusanOption = new Option(data[array_jurusan].nama_siswa, array_jurusan);
                jurusanOption.value = data[array_jurusan].id;
                jurusanList.options.add(jurusanOption);
            }
        }); 
    } 


</script>
@endpush