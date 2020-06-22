@extends('layouts.app')

@section('content')

<!-- ============================================================== -->
<!-- Breadcrumb -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Data Statistik Sekolah</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Sekolah</a></li>
            <li class="breadcrumb-item active">Data Statistik Sekolah</li>
        </ol>
    </div>
</div>

<!-- ============================================================== -->
<!-- Content -->
<!-- ============================================================== -->
<div class="p-10" style="background-color:white;">
    <div class="row m-0">
        <div class="col-sm-12">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <th style="width:20%">Nama Sekolah </th>
                        <th>:</th>
                        <td>{{$data_sekolah->nama}}</td>
                    </tr>
                    <tr>
                        <th style="width:20%">NPSN </th>
                        <th>:</th>
                        <td>{{$data_sekolah->npsn}}</td>
                    </tr>
                    <tr>
                        <th style="width:20%">Alamat </th>
                        <th>:</th>
                        <td>{{$data_sekolah->alamat}}</td>
                    </tr>
                    <tr>
                        <th style="width:20%">Tahun Berdiri </th>
                        <th>:</th>
                        <td>{{$data_sekolah->tahun_berdiri}}</td>
                    </tr>
                    <tr>
                        <th style="width:20%">Kepala Sekolah </th>
                        <th>:</th>
                        <td>{{$data_sekolah->nama_kasek}}</td>
                    </tr>
                    <tr>
                        <th style="width:20%">Waka Kurikulum </th>
                        <th>:</th>
                        <td>{{$data_sekolah->nama_wakakur}}</td>
                    </tr>
                    <tr>
                        <th style="width:20%">Waka Kesiswaan </th>
                        <th>:</th>
                        <td>{{$data_sekolah->nama_wakasis}}</td>
                    </tr>
                    <tr>
                        <th style="width:20%">Email </th>
                        <th>:</th>
                        <td>{{$data_sekolah->email}}</td>
                    </tr>
                    <tr>
                        <th style="width:20%">Telpon </th>
                        <th>:</th>
                        <td>{{$data_sekolah->telpon}}</td>
                    </tr>
                    <tr>
                        <th style="width:20%">Status Akreditasi </th>
                        <th>:</th>
                        <td>{{$data_sekolah->akreditasi}}</td>
                    </tr>
                    <tr>
                        <th style="width:20%">Kurikulum </th>
                        <th>:</th>
                        <td>{{$data_sekolah->kurikulum}}</td>
                    </tr>
                    <tr>
                        <th style="width:20%">Status </th>
                        <th>:</th>
                        <td>{{$data_sekolah->status}}</td>
                    </tr>
                </tbody>
            </table>
            <button class='btn btn-outline-primary' onclick="getData({{$data_sekolah->id}})" data-toggle="modal" data-target="#updateData">Update Data</button>    
        </div>
    </div>
</div>    <!-- Modal Update -->
<div class="modal fade" id="updateData" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-update" action="/sekolah/update_sekolah">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="updateDataLabel">Form Update Data Sekolah</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="clearForm('form-update')" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pl-0 pr-0">
                    <input type="hidden" name="id" id="id">
                    <div class="row m-0">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Sekolah</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">NPSN</label>
                                <input type="text" name="npsn" id="npsn" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tahun Berdiri</label>
                                <input type="date" name="tahun_berdiri" id="tahun_berdiri" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kepala Sekolah</label>
                                <select class="form-control" name="kepala" id="kepala">
                                    @foreach ($data_pegawai1 as $data_pegawai1)
                                        <option value="{{$data_pegawai1->id}}">{{$data_pegawai1->nama_pegawai}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Waka Kurikulum</label>
                                <select class="form-control" name="wakakur" id="wakakur">
                                    @foreach ($data_pegawai2 as $data_pegawai2)
                                        <option value="{{$data_pegawai2->id}}">{{$data_pegawai2->nama_pegawai}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Waka Kesiswaan</label>
                                <select class="form-control" name="wakasis" id="wakasis">
                                    @foreach ($data_pegawai3 as $data_pegawai3)
                                        <option value="{{$data_pegawai3->id}}">{{$data_pegawai3->nama_pegawai}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" name="email" id="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telpon</label>
                                <input type="text" name="telpon" id="telpon" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Akreditasi</label>
                                <input type="text" name="akreditasi" id="akreditasi" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kurikulum</label>
                                <input type="text" name="kurikulum" id="kurikulum" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="Swasta">Swasta</option>
                                    <option value="Negeri">Negeri</option>
                                </select>
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
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#kepala').select2();
        $('#wakakur').select2();
        $('#wakasis').select2();
    })
    function getData(id){  
        $.get(`sekolah/getById/${id}`, function(data){
            // console.log(data)
            $('#id').val(data.id);
            $('#kepala').val(data.kepala);
            $('#wakasis').val(data.wakasis);
            $('#wakakur').val(data.wakakur);
            $('#nama').val(data.nama);
            $('#npsn').val(data.npsn);
            $('#alamat').val(data.alamat);
            $('#tahun_berdiri').val(data.tahun_berdiri);
            $('#email').val(data.email);
            $('#telpon').val(data.telpon);
            $('#status').val(data.status);
            $('#akreditasi').val(data.akreditasi);
            $('#kurikulum').val(data.kurikulum);
        })
    }
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
</script>
@endpush
