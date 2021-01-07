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
        <button type="" class="btn btn-primary mt-2" data-toggle="modal" data-target="#addData"><i class="mdi mdi-plus mr-2"></i> Generate Pembayaran </button>
        <div class="row m-0">
            <div class="col-sm-3 pt-2">
                <select class="form-control" id="search_tahun">
                    <option selected value="">--- Pilih Tahun ---</option>
                    @for ($tahun = 2016; $tahun <= date('Y'); $tahun++)
                        <option value="{{$tahun}}">{{$tahun}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-sm-3 pt-2">
                <select class="form-control" id="search_bulan">
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
                <select class="form-control" id="search_status">
                    <option selected value="">--- Pilih Status ---</option>
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Dibayar">Belum Dibayar</option>
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
    getDataTables()
    function resetDataTable(){
        $('#data_tables').DataTable().destroy();
        $('#search_tahun').prop('selectedIndex',0);
        $('#search_bulan').prop('selectedIndex',0);
        $('#search_status').prop('selectedIndex',0);
        getDataTables();
    };
    function search(){
        $('#data_tables').DataTable().destroy();
        getDataTables($('#search_tahun').val(),$('#search_bulan').val(),$('#search_status').val());
    }
    function getDataTables(search_tahun,search_bulan,search_status) {
        var tanggal = '<?=date('m-Y')?>';
        $('#data_tables').DataTable({
            lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": {
                "url" : "/sekolah/get_spp",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "<?= csrf_token()?>",
                    search_tahun : search_tahun,
                    search_bulan : search_bulan,
                    search_status:search_status
                }
            },
            "dom": 'lBfrtip',
            "buttons": [
                    {
                        "extend": 'excel',
                        className:'ml-3 btn-sm',
                        "title" : 'Pembayaran SPP '+tanggal,
                        "exportOptions": {
                            "columns": ':not(.notexport)'
                        }
                    },
                    {
                        "extend": 'pdf',
                        className:'ml-3 btn-sm',
                        "title" : 'Pembayaran SPP '+tanggal,
                        "exportOptions": {
                            "columns": ':not(.notexport)'
                        }
                    }
            ],
            "columns" : [
                {"data": "action"},
                {"data": "nama_siswa"},
                {"data": "periode"},
                {"data": "tgl_bayar"},
                {"data": "nominal"},
                {"data": "status"},
            ]
        });
    };
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