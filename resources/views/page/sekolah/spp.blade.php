@extends('layouts.app')

@section('content')

    <!-- ============================================================== -->
    <!-- Breadcrumb -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Data Pembayaran SPP</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Sekolah</a></li>
                <li class="breadcrumb-item active">Data Pembayaran SPP</li>
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
                    <button type="" class="btn btn-primary mt-2" data-toggle="modal" data-target="#addData"><i class="mdi mdi-plus mr-2"></i> Generate Pembayaran </button>
                    <!-- <button type="" class="btn btn-success mt-2" data-toggle="modal" data-target="#importData"><i class="mdi mdi-file-excel mr-2"></i> Import </button> -->
                    <table id="data_tables" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Nama Siswa</th>
                                <th>Periode Pembayaran</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Jumlah Tagihan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="small"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Generate -->
    <div class="modal fade" id="addData" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="form-insert" action="/sekolah/generate_spp">
			        {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDataLabel">Form Generate Pembayaran SPP</h5>
                        <button type="button" class="close" data-dismiss="modal" onclick="clearForm('form-insert')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nominal</label>
                            <input type="number" name="nominal" class="form-control" required>
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
                "url" : "/sekolah/get_spp",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "<?= csrf_token()?>"
                }
            },
            "columns" : [
                {"data": "action"},
                {"data": "nama_siswa"},
                {"data": "periode"},
                {"data": "tgl_bayar"},
                {"data": "nominal"},
                {"data": "status"},
            ]
        });
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
    function clearForm(data){
        document.getElementById(data).reset();
    }
    function getLunas(id){
        Swal.fire({
            title: 'Konfirmasi',
            text: "Data tersebut akan dilunasi",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor:'#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lunas',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.value) {
                $.get(`/sekolah/lunas_spp/${id}`, function(data){
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