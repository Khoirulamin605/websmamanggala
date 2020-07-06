@extends('layouts.app')

@section('content')

    <!-- ============================================================== -->
    <!-- Breadcrumb -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Data Mapel</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Sekolah</a></li>
                <li class="breadcrumb-item active">Data Mapel</li>
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
                                <th>Nama Mapel</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <th>Pengajar</th>
                                <th>Hari</th>
                                <th>Jumlah Jam</th>
                                <th>Status</th>
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
                <form id="form-insert" action="/sekolah/insert_mapel">
			        {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDataLabel">Form Insert Data Mata Pelajaran</h5>
                        <button type="button" class="close" data-dismiss="modal" onclick="clearForm('form-insert')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Mapel</label>
                            <input type="text" name="nama_mapel" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Jurusan</label>
                            <select class="form-control" style="width:100%;" name="jurusan">
                                @foreach ($jurusan as $jurusan)
                                    <option value="{{$jurusan->jurusan}}">{{$jurusan->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kelas</label>
                            <select class="form-control" name="kelas">
                                <option value="Kelas X">Kelas X</option>
                                <option value="Kelas XI">Kelas XI</option>
                                <option value="Kelas XII">Kelas XII</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Guru Pengampu</label>
                            <select class="form-control" style="width:100%;" name="pengajar" id="pengajar">
                                @foreach ($wali_kelas as $wali_kelas)
                                    <option value="{{$wali_kelas->nama_pegawai}}">{{$wali_kelas->nama_pegawai}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hari</label>
                            <select class="form-control" name="hari">
                                <option value="6">Sabtu</option>
                                <option value="7">Ahad</option>
                                <option value="1">Senin</option>
                                <option value="2">Selasa</option>
                                <option value="3">Rabu</option>
                                <option value="4">Kamis</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jumlah Jam</label>
                            <input type="number" name="jumlah_jam" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select class="form-control" name="status">
                                <option value="Active">Active</option>
                                <option value="Non-Active">Non-Active</option>
                            </select>
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
                <form id="form-update" action="/sekolah/update_mapel">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateDataLabel">Form Update Data Mata Pelajaran</h5>
                        <button type="button" class="close" data-dismiss="modal" onclick="clearForm('form-update')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Mapel</label>
                            <input type="text" name="nama_mapel" id="nama_mapel" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Jurusan</label>
                            <select class="form-control" style="width:100%;" name="jurusan" id="jurusan">
                                @foreach ($jurusan1 as $jurusan1)
                                    <option value="{{$jurusan1->jurusan}}">{{$jurusan1->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kelas</label>
                            <select class="form-control" name="kelas" id="kelas">
                                <option value="Kelas X">Kelas X</option>
                                <option value="Kelas XI">Kelas XI</option>
                                <option value="Kelas XII">Kelas XII</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Guru Pengampu</label>
                            <select class="form-control" style="width:100%;" name="pengajar" id="pengajar1">
                                @foreach ($wali_kelas1 as $wali_kelas1)
                                    <option value="{{$wali_kelas1->nama_pegawai}}">{{$wali_kelas1->nama_pegawai}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hari</label>
                            <select class="form-control" id="hari" name="hari">
                                <option value="6">Sabtu</option>
                                <option value="7">Ahad</option>
                                <option value="1">Senin</option>
                                <option value="2">Selasa</option>
                                <option value="3">Rabu</option>
                                <option value="4">Kamis</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jumlah Jam</label>
                            <input type="number" id="jumlah_jam" name="jumlah_jam" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="Active">Active</option>
                                <option value="Non-Active">Non-Active</option>
                            </select>
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

</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#data_tables').DataTable({
            lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
            "processing": true,
            "serverSide": true,
            // "searching": false,
            "ajax": {
                "url" : "/sekolah/get_mapel",
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
                {"data": "nama_mapel"},
                {"data": "jurusan"},
                {"data": "kelas"},
                {"data": "guru_pengajar"},
                {"data": "hari"},
                {"data": "jumlah_jam"},
                {"data": "status"},
            ]
        });
        $('#pengajar').select2();
        $('#pengajar1').select2();
    });
    function clearForm(data){
        document.getElementById(data).reset();
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
    })
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
                $.get(`/sekolah/delete_mapel/${id}`, function(data){
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
    function setData(data1, data2, data3, data4, data5, data6, data7, data8){ 
        $("#id").val(data1);
        $("#nama_mapel").val(data2);
        $("#jurusan").val(data3);
        $("#kelas").val(data4);
        $("#pengajar1").val(data5);
        $("#hari").val(data6);
        $("#jumlah_jam").val(data7);
        $("#status").val(data8);
    }
</script>
@endpush