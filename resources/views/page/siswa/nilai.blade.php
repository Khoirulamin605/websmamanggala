@extends('layouts.app')

@section('content')
<!-- ============================================================== -->
<!-- Breadcrumb -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Data Nilai Siswa</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Siswa</a></li>
            <li class="breadcrumb-item active">Data Nilai Siswa</li>
        </ol>
    </div>
</div>

<!-- ============================================================== -->
<!-- Content -->
<!-- ============================================================== -->
<div class="p-10" style="background-color:white;">
    {{-- <button type="" class="btn btn-success mt-2" data-toggle="modal" data-target="#importData"><i class="mdi mdi-file-excel mr-2"></i> Import </button> --}}
    {{-- <button type="" class="btn btn-info mt-2" data-toggle="modal" data-target="#setNaikKelas"><i class="mdi mdi-arrow-up mr-2"></i> Kenaikan Kelas </button> --}}
    <div class="row m-0">
        <div class="col-sm-3 pt-2">
            <button type="" class="btn btn-primary" data-toggle="modal" data-target="#bukaPenilaian"><i class="mdi mdi-plus mr-2"></i> Buka Penilaian </button>
        </div>
        <div class="col-sm-3 pt-2">
            <select class="form-control" id="search_jurusan">
                <option selected value="">--- Pilih Jurusan ---</option>
                @foreach ($jurusan as $jurusan)
                    <option value="{{$jurusan->id}}">{{$jurusan->jurusan}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3 pt-2">
            <select class="form-control" onchange="getMapel()" id="search_kelas">
                <option selected value="">--- Pilih Kelas ---</option>
                <option value="Kelas X">Kelas X</option>
                <option value="Kelas XI">Kelas XI</option>
                <option value="Kelas XII">Kelas XII</option>
            </select>
        </div>
        <div class="col-sm-3 pt-2">
            <select class="form-control" id="search_mapel">
                <option selected value="">--- Pilih Mata Pelajaran ---</option>
                {{-- @foreach ($mapel as $mapel)
                    <option value="{{$mapel->id}}">{{$mapel->nama_mapel}}</option>
                @endforeach --}}
            </select>
        </div>
    </div>
    <div class="row m-0">
        <div class="col-sm-3 pt-2">
        </div>
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
            {{-- <button type="button" class="btn btn-warning" onclick="resetDataTable()"><i class="mdi mdi-undo mr-2"></i>Reload</button> --}}
        </div>
    </div>
    <div class="row p-0 m-0">
        <div class="col">
            <div class="table-responsive"> <table id="data_tables" class="table table-striped table-bordered no-wrap">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Nama Siswa</th>
                            <th>Jurusan</th>
                            <th>Kelas</th>
                            <th>Tahun Ajaran</th>
                            <th>Semester</th>
                            <th>Nilai</th>
                            {{-- <th>Jurusan</th>
                            <th>Kelas</th> --}}
                        </tr>
                    </thead>
                    <tbody class="small"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Generate Nilai -->
<div class="modal fade" id="bukaPenilaian" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="bukaPenilaianLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-buka-nilai" action="/siswa/buka_penilaian" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="bukaPenilaianLabel">Buka Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="clearForm('form-naik')" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jurusan</label>
                        <select class="form-control" name="jurusan">
                            @foreach ($jurusan1 as $jurusan)
                                <option value="{{$jurusan->id}}">{{$jurusan->jurusan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kelas</label>
                        <select class="form-control" name="kelas">
                            @foreach ($kelas1 as $kelas)
                                <option value="{{$kelas->kelas}}">{{$kelas->kelas}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tahun Pelajaran</label>
                        <input type="text" name="tahun_ajaran" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Semester</label>
                        <select class="form-control" name="semester">
                            <option value="Genap">Genap</option>
                            <option value="Ganjil">Ganjil</option>
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="exampleInputEmail1">Mapel</label>
                        <select class="form-control" id="getMapelByKelas" name="mapel">
                        </select>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="clearForm('form-naik')" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
        
<!-- Modal Update -->
<div class="modal fade" id="updateData" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-update" action="/siswa/update_nilai">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="updateDataLabel">Form Update Data Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="clearForm('form-update')" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Siswa</label>
                        <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jurusan</label>
                        <input type="text" name="jurusan" id="jurusan" class="form-control" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kelas</label>
                        <input type="text" name="kelas" id="kelas" class="form-control" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Semester</label>
                        <input type="text" name="semester" id="semester" class="form-control" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nilai</label>
                        <input type="number" name="nilai" id="nilai" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="clearForm('form-update')" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>   

<!-- Modal Import -->
<div class="modal fade" id="importData" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="importDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-import" action="/siswa/import_data" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="importDataLabel">Import Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="clearForm('form-import')" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <span>Jika anda mau import data siswa, gunakan format file excel berikut</span><br/>
                            <a href="/siswa/impoort_file" class="btn btn-success"><i class="mdi mdi-file-excel mr-2"></i> Download Excel</a><br/><br/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Maukkan File Excel</label>
                            <input type="file" class="form-control-file" name="file_excel"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="clearForm('form-import')" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
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
                "url" : "/siswa/get_nilai_siswa",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "<?= csrf_token()?>", 
                    search_jurusan : search_jurusan,
                    search_kelas : search_kelas,
                    search_mapel:search_mapel,
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
                {"data": "action"},
                {"data": "nama_siswa"},
                {"data": "jurusan"},
                {"data": "kelas"},
                {"data": "tahun_ajaran"},
                {"data": "semester"},
                {"data": "nilai"},
            ]
        });
    }  
    function getMapel(){
        // console.log();
        $('#search_mapel')
            .empty()
            .append('<option selected="selected" value="">--- Pilih Mata Pelajaran ---</option>')
        ;
        var jurusanList = document.getElementById("search_mapel");
        $.post(`/siswa/get_nilai_by_kelas`,{
            jurusan :$('#search_jurusan option:selected').text(),
            kelas : $('#search_kelas').val()
        }, function(data){
            // console.log(data)
            for(array_jurusan = 0; array_jurusan < data.length; array_jurusan++){
                var jurusanOption = new Option(data[array_jurusan].nama_mapel, array_jurusan);
                jurusanOption.value = data[array_jurusan].id;
                jurusanList.options.add(jurusanOption);
            }
        }); 
    } 
    function setData(id, nama_siswa, jurusan, kelas, kelas, tahun_ajaran, semester, nilai){
        $("#id").val(id);
        $("#nama_siswa").val(nama_siswa);
        $("#jurusan").val(jurusan);
        $("#kelas").val(kelas);
        $("#tahun_ajaran").val(tahun_ajaran);
        $("#semester").val(semester);
        $("#nilai").val(nilai);
    }

    $('#form-update').on('submit',function(e){
        e.preventDefault()
        var form = $(this)
        var url = form.attr('action')
        $.ajax({
            type : "POST",
            url : url,
            data: form.serialize(),
            success: function(data){
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
                            clearForm('form-update');
                            $('#updateData').modal('hide');
                        }
                    })
                }else{
                    Swal.fire(
                        'Gagal',
                        data.message,
                        'error'
                    )
                }
            }
        })
    })

    $('#form-buka-nilai').on('submit',function(e){
        e.preventDefault()
        var form = $(this)
        var url = form.attr('action')
        $.ajax({
            type : "POST",
            url : url,
            data: form.serialize(),
            success: function(data){
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
                            clearForm('form-buka-nilai');
                            $('#bukaPenilaian').modal('hide');
                        }
                    })
                }else{
                    Swal.fire(
                        'Gagal',
                        data.message,
                        'error'
                    )
                }
            }
        })
    });
</script>
@endpush