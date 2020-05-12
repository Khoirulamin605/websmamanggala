@extends('layouts.app')

@section('content')

    <!-- ============================================================== -->
    <!-- Breadcrumb -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Data Rombongan Belajar</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Sekolah</a></li>
                <li class="breadcrumb-item active">Data Rombongan Belajar</li>
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
                    <table id="data_tables" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Nama Kelas</th>
                                <th>Nama Jurusan</th>
                                <th>Rombongan Belajar</th>
                                <th>Wali Kelas</th>
                                <th>Status</th>
                                <th>Tahun Ajaran</th>
                                <th>Semester</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Insert -->
    <div class="modal fade" id="addData" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="form-insert" action="/sekolah/insert_kelas">
			        {{ csrf_field() }}
                    <input type="hidden" name="id" id="id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDataLabel">Form Insert Data Rombongan Belajar</h5>
                        <button type="button" class="close" data-dismiss="modal" onclick="clearForm('form-insert')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kelas</label>
                            <select class="form-control" name="nama_kelas">
                                <option value="Kelas X">Kelas X</option>
                                <option value="Keals XI">Keals XI</option>
                                <option value="Keals XII">Keals XII</option>
                            </select>
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
                            <label for="exampleInputEmail1">Wali Kelas</label>
                            <select class="form-control" style="width:100%;" name="wali_kelas" id="wali_kelas">
                                @foreach ($wali_kelas as $wali_kelas)
                                    <option value="{{$wali_kelas->nama_pegawai}}">{{$wali_kelas->nama_pegawai}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select class="form-control" name="status">
                                <option value="Active">Active</option>
                                <option value="Non-Active">Non-Active</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Rombongan Belajar</label>
                            <input type="text" name="rombel" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tahun Ajaran</label>
                            <input type="text" name="tahun_ajar" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Semester</label>
                            <select class="form-control" name="semester">
                                <option value="I">Genap</option>
                                <option value="II">Ganjil</option>
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
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#data_tables').DataTable({
            lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
            // "searching": false,
            "ajax": {
                "url" : "/sekolah/get_kelas",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "<?= csrf_token()?>"
                }
            },
            "columns" : [
                {"data": "action"},
                {"data": "nama_kelas"},
                {"data": "jurusan"},
                {"data": "rombel"},
                {"data": "wali_kelas"},
                {"data": "status"},
                {"data": "tahun_ajar"},
                {"data": "semester"},
            ]
        });
        $('#wali_kelas').select2();
    });
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
                $.get(`/sekolah/delete_kelas/${id}`, function(data){
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