@extends('layouts.app')

@section('content')

    <!-- ============================================================== -->
    <!-- Breadcrumb -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Jabatan</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Pegawai</a></li>
                <li class="breadcrumb-item active">Jabatan</li>
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
                                <th>ID Jabatan</th>
                                <th>Jabatan</th>
                                <th>Gaji</th>
                                <th>Keterangan</th>
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
                <form id="form-insert" action="/jabatan/insert_jabatan">
			        {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDataLabel">Form Insert Data Jabatan</h5>
                        <button type="button" class="close" data-dismiss="modal" onclick="clearForm('form-insert')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Gaji/Upah</label>
                            <input type="number"  name="gaji" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Keterangan</label>
                            <select class="form-control" name="keterangan">
                                <option value="Per Bulan">Per Bulan</option>
                                <option value="Per Jam">Per Jam</option>
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
                <form id="form-update" action="/jabatan/update_jabatan">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateDataLabel">Form Update Data Jabatan</h5>
                        <button type="button" class="close" data-dismiss="modal" onclick="clearForm('form-update')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Gaji/Upah</label>
                                <input type="number" name="gaji" id="gaji" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Keterangan</label>
                                <select class="form-control" name="keterangan"  id="keterangan">
                                    <option value="Per Bulan">Per Bulan</option>
                                    <option value="Per Jam">Per Jam</option>
                                </select>
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
@endsection
@push('scripts')
<script>
    getDataTables();
    function getDataTables(){
        $('#data_tables').DataTable({
            lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
            "processing": true,
            "serverSide": true,
            // "searching": false,
            "ajax": {
                "url" : "/jabatan/get_all_jabatan",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "<?= csrf_token()?>"
                }
            },
            "buttons": [
                "csv","excel","pdf","print"
            ],
            "columns" : [
                {"data": "action"},
                {"data": "id"},
                {"data": "jabatan"},
                {"data": "gaji"},
                {"data": "keterangan"}
            ]
        });
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
    function clearForm(data){
        document.getElementById(data).reset();
    }
    function setData(data1, data2, data3, data4){
        $("#id").val(data1);
        $("#jabatan").val(data2);
        $("#gaji").val(data3);
        $("#keterangan").val(data4);
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
                $.get(`/jabatan/hapus_jabatan/${id}`, function(data){
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