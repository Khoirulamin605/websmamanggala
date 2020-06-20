@extends('layouts.app')

@section('content')

    <!-- ============================================================== -->
    <!-- Breadcrumb -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Data Siswa Aktif</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Siswa</a></li>
                <li class="breadcrumb-item active">Data Siswa Aktif</li>
            </ol>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- Content -->
    <!-- ============================================================== -->
    <div class="p-10" style="background-color:white;">
        <button type="" class="btn btn-primary mt-2" data-toggle="modal" data-target="#addData"><i class="mdi mdi-plus mr-2"></i> Tambah </button>
        <button type="" class="btn btn-success mt-2" data-toggle="modal" data-target="#importData"><i class="mdi mdi-file-excel mr-2"></i> Import </button>
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
                <select class="form-control" id="search_kelas">
                    <option selected value="">--- Pilih Kelas ---</option>
                    <option value="Kelas X">Kelas X</option>
                    <option value="Kelas XI">Kelas XI</option>
                    <option value="Kelas XII">Kelas XII</option>
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
                <div class="table-responsive"> <table id="data_tables" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>No. Induk</th>
                                <th>Nama</th>
                                <th>Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Ortu/Wali</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody class="small"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Insert -->
    <div class="modal fade" id="addData" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="form-insert" action="/siswa/insert_siswa">
			        {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDataLabel">Form Insert Data Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" onclick="clearForm('form-insert')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pl-0 pr-0">
                        <div class="row m-0">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No. Induk</label>
                                    <input type="text" name="no_induk" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Siswa</label>
                                    <input type="text" name="nama_siswa" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin">
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kelas</label>
                                    <select class="form-control" name="kelas">
                                        <option value="Kelas X">Kelas X</option>
                                        <option value="Kelas XI">Kelas XI</option>
                                        <option value="Kelas XII">Kelas XII</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jurusan</label>
                                    <select class="form-control" name="jurusan" id="jurusan">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alasan Masuk</label>
                                    <select class="form-control" name="alasan_masuk">
                                        <option value="Baru">Siswa Baru</option>
                                        <option value="Pindahan">Siswa Pindahan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ortu/Wali</label>
                                    <input type="text" name="wali" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="clearForm('form-insert')" data-dismiss="modal">Batal</button>
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
                <form id="form-update" action="/siswa/update_siswa">
			        {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateDataLabel">Form Update Data Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" onclick="clearForm('form-update')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pl-0 pr-0">
                        <input type="hidden" name="id" id="id">
                        <div class="row m-0">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No. Induk</label>
                                    <input type="text" name="no_induk" id="no_induk" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Siswa</label>
                                    <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat</label>
                                    <input type="text" name="alamat" id="alamat" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kelas</label>
                                    <select class="form-control" name="kelas" id="kelas">
                                        <option value="Kelas X">Kelas X</option>
                                        <option value="Kelas XI">Kelas XI</option>
                                        <option value="Kelas XII">Kelas XII</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jurusan</label>
                                    <select class="form-control" name="jurusan" id="jurusan1">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alasan Masuk</label>
                                    <select class="form-control" name="alasan_masuk" id="alasan_masuk">
                                        <option value="Baru">Siswa Baru</option>
                                        <option value="Pindahan">Siswa Pindahan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ortu/Wali</label>
                                    <input type="text" name="wali" id="wali" class="form-control" required>
                                </div>
                            </div>
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

    <!-- Modal Update -->
    <div class="modal fade" id="keluarSiswa" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="keluarSiswaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="form-keluar" action="/siswa/siswa_keluar">
			        {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="keluarSiswaLabel">Siswa Pindah Atau Keluar</h5>
                        <button type="button" class="close" data-dismiss="modal" onclick="clearForm('form-keluar')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id_siswa">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Keluar/Pindah</label>
                            <select class="form-control" name="status_aktif" id="status_aktif">
                                <option value="Keluar">Keluar</option>
                                <option value="Pindah">Pindah</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="clearForm('form-keluar')" data-dismiss="modal">Batal</button>
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
                                <a href="/download/ImportSiswa.xlsx" download="ImportSiswa.xlsx" class="btn btn-success"><i class="mdi mdi-file-excel mr-2"></i> Download Excel</a><br/><br/>
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
    getDataTables()
    function resetDataTable(){
        $('#data_tables').DataTable().destroy();
        $('#search_jurusan').prop('selectedIndex',0);
        $('#search_kelas').prop('selectedIndex',0);
        $('#search_siswa').val('');
        getDataTables();
    };
    function search(){
        $('#data_tables').DataTable().destroy();
        getDataTables($('#search_jurusan').val(),$('#search_kelas').val(),$('#search_siswa').val());
    }
    getJurusan()
    function getDataTables(search_jurusan,search_kelas,search_siswa){
        $('#data_tables').DataTable({
            lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": {
                "url" : "/siswa/get_siswa_aktif",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "<?= csrf_token()?>", 
                    search_jurusan : search_jurusan,
                    search_kelas : search_kelas,
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
                {"data": "nama_jurusan"},
                {"data": "kelas"},
            ]
        });
    }  
    function getJurusan(){
        var jurusanList = document.getElementById("jurusan");
        var jurusanList1 = document.getElementById("jurusan1");
        $.get(`/sekolah/get_all_jurusan`, function(data){
            for(array_jurusan = 0; array_jurusan < data.length; array_jurusan++){
                var jurusanOption = new Option(data[array_jurusan].jurusan, array_jurusan);
                jurusanOption.value = data[array_jurusan].id;
                jurusanList.options.add(jurusanOption);
            }
            for(array_jurusan1 = 0; array_jurusan1 < data.length; array_jurusan1++){
                var jurusanOption1 = new Option(data[array_jurusan1].jurusan, array_jurusan1);
                jurusanOption1.value = data[array_jurusan1].id;
                jurusanList1.options.add(jurusanOption1);
            }
        }); 
    }  
    function clearForm(data){
        document.getElementById(data).reset();
    }

    $('#form-insert').on('submit',function(e){
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
                            clearForm('form-insert');
                            $('#addData').modal('hide');
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
    function setData(id, no_induk, nama_siswa, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, kelas, jurusan, alasan_masuk, wali){
        $("#id").val(id);
        $("#no_induk").val(no_induk);
        $("#nama_siswa").val(nama_siswa);
        $("#tempat_lahir").val(tempat_lahir);
        $("#tanggal_lahir").val(tanggal_lahir);
        $("#jenis_kelamin").val(jenis_kelamin);
        $("#alamat").val(alamat);
        $("#kelas").val(kelas);
        $("#jurusan1").val(jurusan);
        $("#alasan_masuk").val(alasan_masuk);
        $("#wali").val(wali);
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
    });

    function hapusData(id){
        Swal.fire({
            title: 'Konfirmasi',
            text: "Apakah anda yakin mau menghapus data ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor:'#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.value) {
                $.get(`/siswa/delete_siswa/${id}`, function(data){
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

    function setDataKeluar(data1, data2){
        $("#id_siswa").val(data1);
        $("#status_aktif1").val(data2);   
    }
    $('#form-keluar').on('submit',function(e){
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
                            clearForm('form-keluar');
                            $('#keluarSiswa').modal('hide');
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

    $('#form-import').on('submit',function(e){
        e.preventDefault()
        var form = $(this)
        var url = form.attr('action')
        $.ajax({
            method : "POST",
            url : url,
            dataType: 'json',
            data: new FormData($('#form-import')[0]),
            contentType: false,
            processData: false,
            cache: false,
            async: false,
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
                            clearForm('form-import');
                            $('#importData').modal('hide');
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
