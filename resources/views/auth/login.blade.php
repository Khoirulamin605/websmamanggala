@extends('layouts.app')
<section id="wrapper">
<div class="login-register" style="background-image:url({{ asset('assets') }}/images/background/login-register.jpg);">
    <div class="login-box card">
        <div class="card-body">
            <div class="form-horizontal form-material">
                {{-- @csrf --}}
                <h3 class="box-title m-b-20">Sign In</h3>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox checkbox-primary pull-left p-t-0">
                            <input id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup"> Remember me </label>
                        </div> 
                            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right">
                                    {{-- <i class="fa fa-lock m-r-5"></i> Forgot pwd? --}}
                            </a> 
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button id="buttonLogin" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" onclick="login()">Log In</button>
                        {{-- <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" onclick="passwordBaru()">fdherh</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="loading" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="loadingLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="col-sm-12" align="center">
            <div class="spinner-border text-danger" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</div>

</section>

@push('scripts')
<script>
    $("#password").keyup(function(event){
        if(event.keyCode == 13){
            $("#buttonLogin").click();
        }
    });
    $("#email").keyup(function(event){
        if(event.keyCode == 13){
            $("#buttonLogin").click();
        }
    });
</script>
<script>
    // function hideModal(){
    //     $('#loading').modal('hide')
    // }
    function login(){
        email = $('#email').val();
        password = $('#password').val();
        // data = $('#loginform').serialize()
        
        if(email && password){
            // $('#loading').modal('show')
            $.ajax({
                url: "/loginuser",
                method: 'POST',
                dataType: 'json',
                data: {
                    "_token": "<?= csrf_token()?>",
                    email : email,
                    password : password
                },
                success: function (data) {
                    if(data.status){
                        Swal.fire({
                            title: 'Login Berhasil',
                            text:  data.message,
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok',
                            allowOutsideClick: false,
                        }).then((result) => {
                            // $('#loading').modal('show')
                            if (result.value) {
                                window.location = '/home'
                            }
                        })
                    }else{
                        Swal.fire("ERROR", data.message, "error") 
                    }
                }
            });
        }else{
            Swal.fire("LOGIN GAGAL", "Lengkapi data terlegih dahulu", "error")
        }
        
    }
</script>
@endpush
