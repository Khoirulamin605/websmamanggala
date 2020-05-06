// Variable
// var base_url = window.location.origin + '/' + window.location.pathname.split('/')[1];
var base_url = window.location.origin;
var morrisArea;
var morrisAreaAnalisisMember;
var morrisAreaAnalisisInternal;
// Login
$('#btnLoginKey').click(function () {
  if ($("#formLoginKey").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Login/cek_key",
      type: "POST",
      data: $('#formLoginKey').serialize(),
      dataType: 'json',
      success: function (data) {
        if (data.status) {
          window.location.replace(base_url + "/Dashboard");
        }
        else {
          swal("Login Gagal", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function kirimUlangKey() {
  showBlockUI();
  $.ajax({
    url: base_url + "/Login/send_key",
    type: "POST",
    data: $('#formLoginKey').serialize(),
    dataType: 'json',
    success: function (data) {
      if (data.status) {
        swal("PROSES BERHASIL", data.message, "success");
        fnCD(60, 1);
      }
      else {
        swal("PROSES GAGAL", data.message, "error");
      }
      closeBlockUI();
    }
  });
}
// Dashboard
function initMorris() {
  morrisArea = new Morris.Area({
    element: 'mbr-v-trx',
    xkey: 'm',
    ykeys: ['b', 'a'],
    labels: ['Transaksi', 'Member'],
    lineColors: ['#E91E63', '#3F51B5'],
    hideHover: 'auto',
    fillOpacity: 0.4,
    behaveLikeLine: true,
    resize: true
  });
}
$('#datepicker_dashboard').datepicker({
  autoclose: true,
  viewMode: "years",
  minViewMode: "years",
  // orientation: 'bottom left',
  format: 'yyyy'
});
$('select[name=chart_periode]').change(function () {
  var chart_periode = $(this).find('option:selected').val();
  var new_options;
  var value;
  if (chart_periode == 'Harian') {
    new_options = {
      autoclose: true,
      minViewMode: 1,
      orientation: 'bottom left',
      format: 'mm-yyyy'
    };
    value = new Date().getMonth() + 1 + '-' + new Date().getFullYear();
  }
  else {
    new_options = {
      autoclose: true,
      viewMode: "years",
      minViewMode: "years",
      orientation: 'bottom left',
      format: 'yyyy'
    };
    value = (new Date().getFullYear()).toString();
  }
  // console.log(value);
  $('#datepicker_dashboard').datepicker('destroy');
  $('#datepicker_dashboard').datepicker(new_options);
  $('#datepicker_dashboard').datepicker('setDates', value);
});
$('#btnDashboardMorrisUp').click(function () {
  $('#temp-text').hide();
  showBlockUI();
  if ($('select[name=chart_periode]').val() == 'Bulanan') {
    $.ajax({
      url: base_url + "/Dashboard/get_morris",
      method: 'POST',
      dataType: 'json',
      data: $('#formDashboardMorrisUp').serialize(),
      success: function (data) {
        morrisArea.options.xLabelFormat = function (x) {
          return getMonthName(new Date(x).getMonth());
        };
        morrisArea.options.dateFormat = function (x) {
          return getMonthName(new Date(x).getMonth());
        };
        morrisArea.options.xkey = 'period';

        morrisArea.setData(data);
        closeBlockUI();
      }
    });
  }
  else if ($('select[name=chart_periode]').val() == 'Harian') {
    $.ajax({
      url: base_url + "/Dashboard/get_morris",
      method: 'POST',
      dataType: 'json',
      data: $('#formDashboardMorrisUp').serialize(),
      success: function (data) {
        morrisArea.options.xLabelFormat = function (x) {
          return new Date(x).getDate();
        },
          morrisArea.options.dateFormat = function (x) {
            return new Date(x).getDate() + ' ' + getMonthName(new Date(x).getMonth());
          };
        morrisArea.options.xkey = 'period';

        morrisArea.setData(data);
        closeBlockUI();
      }
    });
  }
  else if ($('select[name=chart_periode]').val() == 'Tahunan') {
    $.ajax({
      url: base_url + "/Dashboard/get_morris",
      method: 'POST',
      dataType: 'json',
      data: $('#formDashboardMorrisUp').serialize(),
      success: function (data) {
        morrisArea.options.xLabelFormat = function (x) {
          return x.getFullYear();
        };
        morrisArea.options.dateFormat = function (x) {
          return new Date(x).getFullYear();
        };
        morrisArea.options.xkey = 'period';

        morrisArea.setData(data);
        closeBlockUI();
      }
    });
  }
});
// Pengaturan Akun
$('#btnPengaturanProfileProfileUp').click(function () {
  if ($("#formPengaturanProfileProfileUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/PengaturanAkun/up_profile",
      method: 'POST',
      dataType: 'json',
      data: $('#formPengaturanProfileProfileUp').serialize(),
      success: function (data) {
        if (data.status) {
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
          $('input[name=key]').val('');
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('#formPengaturanProfilePasswordUp').validate({
  rules: {
    'user_password_repeat': {
      equalTo: '[name=user_password]'
    },
  }
});
$('#btnPengaturanProfilePasswordUp').click(function () {
  if ($("#formPengaturanProfilePasswordUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/PengaturanAkun/up_password",
      method: 'POST',
      dataType: 'json',
      data: $('#formPengaturanProfilePasswordUp').serialize(),
      success: function (data) {
        if (data.status) {
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
          $('input[name=key]').val('');
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('#btnPengaturanProfileSecureUp').click(function () {
  if ($("#formPengaturanProfileSecureUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/PengaturanAkun/up_secure",
      method: 'POST',
      dataType: 'json',
      data: $('#formPengaturanProfileSecureUp').serialize(),
      success: function (data) {
        if (data.status) {
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
          $('input[name=key]').val('');
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('input[name=stsprotect_device]').change(function () {
  if (this.checked) $('input[name=protect_device]').val('T');
  else $('input[name=protect_device]').val('F');
});
$(document).on('change', '#user_foto', function (e) {
  var cropper;
  var files = e.target.files;
  var done = function (url) {
    document.getElementById('user_foto').value = '';
    document.getElementById('imageUserPhoto').src = url;
    $.magnificPopup.open({
      items: {
        src: '#mdPengaturanAkunPhoto',
        type: 'inline',
      },
      mainClass: 'mfp-with-zoom',
      closeBtnInside: true,
      callbacks: {
        open: function () {
          cropper = new Cropper(document.getElementById('imageUserPhoto'), {
            aspectRatio: 1,
            viewMode: 3,
          });
        },
        close: function () {
          cropper.destroy();
          cropper = null;
        }
      }
    });
  };
  var reader;
  var file;
  var url;

  if (files && files.length > 0) {
    file = files[0];

    if (URL) {
      done(URL.createObjectURL(file));
    } else if (FileReader) {
      reader = new FileReader();
      reader.onload = function (e) {
        done(reader.result);
      };
      reader.readAsDataURL(file);
    }
  }
  document.getElementById('btnPengaturanAkunPhotoUp').addEventListener('click', function () {
    showBlockUI();

    var initialAvatarURL;
    var canvas;

    // console.log(cropper);

    if (cropper) {
      canvas = cropper.getCroppedCanvas({
        width: 500,
        height: 500,
      });

      canvas.toBlob(function (blob) {
        var formData = new FormData();

        formData.append('user_foto', blob);
        formData.append('user_login', $('input[name=user_login]').val());

        $.ajax({
          url: base_url + "/PengaturanAkun/up_photo",
          type: "POST",
          data: formData,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function (data) {
            var d = new Date();
            if (data.status) {
              $.magnificPopup.close();
              $("#PengaturanAkunImageFoto").attr("src", base_url + '/assets/imgMAX/pic_admin/' + $('input[name=user_login]').val() + '.jpg?' + d.getTime());
              $("#HeaderAdminPhoto").attr("src", base_url + '/assets/imgMAX/pic_admin/' + $('input[name=user_login]').val() + '.jpg?' + d.getTime());
              swal("PROSES BERHASIL", data.message, "success");
            }
            else {
              swal("PROSES GAGAL", data.message, "error");
              $.magnificPopup.close();
            }
            closeBlockUI();
          }
        });
      }, "image/jpeg", 0.75);
    }
  });
});
// Master Data -> Member Max
function tblMasterMemberMax() {
  // console.log(base_url);
  $('#tblMasterMemberMax').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/MemberMax/get_datatable",
      type: "POST",
      data: {
        status: 'MasterMemberMax',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        typeSearch: $('select[name=custom_type]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterMemberMax();
$('#btnMasterMemberMaxSrc').click(function () {
  $('#tblMasterMemberMax').DataTable().destroy();
  tblMasterMemberMax();
});
function showUpdateMemberMax(mbr_code, mbr_name, mbr_dob, mbr_address, mbr_mobile, mbr_email, mbr_status, mbr_id_number, mbr_bank_name, mbr_bank_num, mbr_bank_acc, mbr_kota) {
  $('input[name=mbr_code]').val(mbr_code);
  $('input[name=mbr_name]').val(mbr_name);
  var tgl = new Date(mbr_dob);
  $('input[name=mbr_dob]').datepicker("update", pad(tgl.getDate(), 2) + "-" + pad(tgl.getMonth() + 1, 2) + "-" + tgl.getFullYear());
  $('input[name=mbr_address]').val(mbr_address);
  $('input[name=mbr_mobile]').val(mbr_mobile);
  $('input[name=mbr_email]').val(mbr_email);
  $('input[name=mbr_status]').val(mbr_status);
  $('input[name=mbr_id_number]').val(mbr_id_number);
  $('input[name=mbr_bank_name]').val(mbr_bank_name);
  $('input[name=mbr_bank_num]').val(mbr_bank_num);
  $('input[name=mbr_bank_acc]').val(mbr_bank_acc);
  $('input[name=mbr_kota]').val(mbr_kota);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterMemberMaxUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterMemberMaxUp').trigger('reset');
        $('#formMasterMemberMaxUp').validate().resetForm();
        $('input').removeClass('error');
      }
    }
  });
}
$('#btnMasterMemberMaxUp').click(function () {
  if ($("#formMasterMemberMaxUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/MemberMax/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterMemberMaxUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterMemberMax').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showUpdateMemberMaxBlock(mbr_code, mbr_name) {
  swal({
    title: 'Silahkan masukkan KEY untuk melakukan BLOCK pada member ini!',
    type: 'warning',
    text: "[" + mbr_code + "] " + mbr_name,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/MemberMax/up_data_block",
        method: 'POST',
        dataType: 'json',
        data: {
          mbr_code: mbr_code,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterMemberMax').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
function showUpdateMemberMaxActive(mbr_code, mbr_name) {
  swal({
    title: 'Silahkan masukkan KEY untuk melakukan ACTIVE pada member ini!',
    type: 'question',
    text: "[" + mbr_code + "] " + mbr_name,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#47A447",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/MemberMax/up_data_active",
        method: 'POST',
        dataType: 'json',
        data: {
          mbr_code: mbr_code,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterMemberMax').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
function showUpdateMemberMaxBlock2(mbr_code, mbr_name) {
  swal.mixin({
    input: 'text',
    confirmButtonText: 'Next &rarr;',
    showCancelButton: true,
    progressSteps: ['1', '2']
  }).queue([
    {
      title: 'Alasan Block',
      text: "Mohon melengkapi alasan block akun member [" + mbr_code + "] dengan detail.",
    },
    {
      title: 'Masukkan Key Untuk Melanjutkan',
    },
  ]).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/MemberMax/up_data_block",
        method: 'POST',
        dataType: 'json',
        data: {
          mbr_code: mbr_code,
          key: result.value[1],
          alasan: result.value[0],
        },
        success: function (data) {
          if (data.status) {
            if (window.location.pathname.split('/')[1] == "Validasi") {
              $('#tblValidasiUpdateVerifiedMember').DataTable().ajax.reload();
            }
            else {
              $('#tblMasterMemberMax').DataTable().ajax.reload();
            }
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
function showUpdateMemberMaxActive2(mbr_code, mbr_name) {
  swal.mixin({
    input: 'text',
    confirmButtonText: 'Next &rarr;',
    showCancelButton: true,
    progressSteps: ['1', '2']
  }).queue([
    {
      title: 'Alasan Block',
      text: "Mohon melengkapi alasan active akun member [" + mbr_code + "] dengan detail.",
    },
    {
      title: 'Masukkan Key Untuk Melanjutkan',
    },
  ]).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/MemberMax/up_data_active",
        method: 'POST',
        dataType: 'json',
        data: {
          mbr_code: mbr_code,
          key: result.value[1],
          alasan: result.value[0],
        },
        success: function (data) {
          if (data.status) {
            if (window.location.pathname.split('/')[1] == "Validasi") {
              $('#tblValidasiUpdateVerifiedMember').DataTable().ajax.reload();
            }
            else {
              $('#tblMasterMemberMax').DataTable().ajax.reload();
            }
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
function fnMasterMemberMaxKtp(mbr_code) {
  $('input[name=mbr_code]').val(mbr_code);
}
$(document).on('change', '#MasterMemberMaxKtpUp', function (e) {
  var cropper;
  var files = e.target.files;
  var done = function (url) {
    document.getElementById('MasterMemberMaxKtpUp').value = '';
    document.getElementById('imageMasterMemberMaxKtpUp').src = url;
    $.magnificPopup.open({
      items: {
        src: '#mdMasterMemberMaxKtpUp',
        type: 'inline',
      },
      mainClass: 'mfp-with-zoom',
      closeBtnInside: true,
      callbacks: {
        open: function () {
          cropper = new Cropper(document.getElementById('imageMasterMemberMaxKtpUp'), {
            aspectRatio: 1.56 / 1,
            viewMode: 3,
          });
        },
        close: function () {
          cropper.destroy();
          cropper = null;
        }
      }
    });
  };
  var reader;
  var file;
  var url;

  if (files && files.length > 0) {
    file = files[0];

    if (URL) {
      done(URL.createObjectURL(file));
    } else if (FileReader) {
      reader = new FileReader();
      reader.onload = function (e) {
        done(reader.result);
      };
      reader.readAsDataURL(file);
    }
  }
  document.getElementById('btnMasterMemberMaxKtpUp').addEventListener('click', function () {
    showBlockUI();

    var initialAvatarURL;
    var canvas;

    // console.log(cropper);

    if (cropper) {
      canvas = cropper.getCroppedCanvas({
        width: 500,
        height: 320,
      });

      canvas.toBlob(function (blob) {
        var formData = new FormData();

        formData.append('ktp_member', blob);
        formData.append('mbr_code', $('input[name=mbr_code]').val());

        $.ajax({
          url: base_url + "/Master/MemberMax/up_ktp",
          type: "POST",
          data: formData,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function (data) {
            if (data.status) {
              $('#tblMasterMemberMax').DataTable().ajax.reload();
              $.magnificPopup.close();
              swal("PROSES BERHASIL", data.message, "success");
            }
            else {
              swal("PROSES GAGAL", data.message, "error");
              $.magnificPopup.close();
            }
            closeBlockUI();
          }
        }, "image/jpeg", 0.75);
      });
    }
  });
});
// Master Data - Downline Member
function tblMasterDownlineMember() {
  $('#tblMasterDownlineMember').DataTable({
    lengthMenu: [[10, 50, 200, 1000, -1], [10, 50, 200, 1000, 'all']],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/DownlineMember/get_datatable",
      type: "POST",
      data: {
        status: 'MasterDownlineMember',
        mbr_code: $('input[name=mbr_code]').val(),
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterDownlineMember();
$('#btnMasterDownlineMemberSrc').click(function () {
  if ($("#formMasterDownlineMember").valid()) {
    $('#tblMasterDownlineMember').DataTable().destroy();
    tblMasterDownlineMember();
  }
});
// Master Data -> Member Reseller
function tblMasterMemberReseller() {
  $('#tblMasterMemberReseller').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/MemberReseller/get_datatable",
      type: "POST",
      data: {
        status: 'MasterMemberReseller',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        typeSearch: $('select[name=custom_type]').val(),
        konter_level: $('select[name=konter_level]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterMemberReseller();
$('#btnMasterMemberResellerSrc').click(function () {
  $('#tblMasterMemberReseller').DataTable().destroy();
  tblMasterMemberReseller();
});
$('#btnMasterMemberResellerAdd').click(function () {
  if ($("#formMasterMemberResellerAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/MemberReseller/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterMemberResellerAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterMemberReseller').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showUpdateMemberReseller(mbr_code, mbr_name, konter_name, konter_addres, konter_kota) {
  $('input[name=mbr_code]').val(mbr_code);
  $('input[name=mbr_name]').val(mbr_name);
  $('input[name=konter_name]').val(konter_name);
  $('input[name=konter_addres]').val(konter_addres);
  $('select[name=input_kota]').val(konter_kota).trigger('change');

  $.magnificPopup.open({
    items: {
      src: '#mdMasterMemberResellerUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterMemberResellerUp').trigger('reset');
        $('#formMasterMemberResellerUp').validate().resetForm();
        $('input, select').removeClass('error');
      }
    }
  });
}
$('#btnMasterMemberResellerUp').click(function () {
  if ($("#formMasterMemberResellerUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/MemberReseller/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterMemberResellerUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterMemberReseller').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showUpdateMemberResellerBlock(mbr_code, mbr_name, konter_name) {
  swal({
    title: 'Silahkan masukkan KEY untuk melanjutkan!',
    type: 'warning',
    text: "Proses ini akan menutup akses akun reseller dengan id [" + mbr_code + "] dan tidak bisa bertransaksi. Apa Anda yakin melakukannya?",
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/MemberReseller/up_data_block",
        method: 'POST',
        dataType: 'json',
        data: {
          mbr_code: mbr_code,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterMemberReseller').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
function showUpdateMemberResellerActive(mbr_code, mbr_name, konter_name) {
  swal({
    title: 'Silahkan masukkan KEY untuk melanjutkan!',
    type: 'question',
    text: "Proses ini akan membuka akses akun reseller dengan id [" + mbr_code + "] dan kembali bisa bertransaksi. Apa Anda yakin melakukannya?",
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#47A447",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/MemberReseller/up_data_active",
        method: 'POST',
        dataType: 'json',
        data: {
          mbr_code: mbr_code,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterMemberReseller').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
function showUpdateMemberResellerSuspend(mbr_code, mbr_name, konter_name) {
  swal({
    title: "Silahkan masukkan KEY untuk melanjutkan",
    type: 'warning',
    text: "Proses INI akan menyebabkan akun member reseller dengan id [" + mbr_code + "] menyerahkan akunnya dan berpindah ke bisnis member!",
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/MemberReseller/up_data_suspend",
        method: 'POST',
        dataType: 'json',
        data: {
          mbr_code: mbr_code,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterMemberReseller').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
// Master Data -> Member Merchant
function tblMasterMemberMerchant() {
  $('#tblMasterMemberMerchant').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/MemberMerchant/get_datatable",
      type: "POST",
      data: {
        status: 'MasterMemberMerchant',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        typeSearch: $('select[name=custom_type]').val(),
        merchant_level: $('select[name=merchant_level]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterMemberMerchant();
$('#btnMasterMemberMerchantSrc').click(function () {
  $('#tblMasterMemberMerchant').DataTable().destroy();
  tblMasterMemberMerchant();
});
function showUpdateMemberMerchant(mbr_code, merchant_name, merchant_addres, merchant_kota, konter_status, merchant_langtitude, merchant_longtitude) {
  $('input[name=mbr_code]').val(mbr_code);
  $('input[name=merchant_name]').val(merchant_name);
  $('input[name=merchant_addres]').val(merchant_addres);
  $('select[name=input_kota]').val(merchant_kota).trigger('change');
  $('select[name=konter_status]').val(konter_status);
  $('input[name=merchant_langtitude]').val(merchant_langtitude);
  $('input[name=merchant_longtitude]').val(merchant_longtitude);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterMemberMerchantUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterMemberMerchantUp').trigger('reset');
        $('#formMasterMemberMerchantUp').validate().resetForm();
        $('input, select').removeClass('error');
      }
    }
  });
}
$('#btnMasterMemberMerchantUp').click(function () {
  if ($("#formMasterMemberMerchantUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/MemberMerchant/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterMemberMerchantUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterMemberMerchant').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('#btnMasterMemberMerchantAdd').click(function () {
  if ($("#formMasterMemberMerchantAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/MemberMerchant/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterMemberMerchantAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterMemberMerchant').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Master Data -> Harga Pokok Penjualan
function tblMasterHargaPokokPenjualan() {
  $('#tblMasterHargaPokokPenjualan').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/HargaPokokPenjualan/get_datatable",
      type: "POST",
      data: {
        status: 'MasterHargaPokokPenjualan',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterHargaPokokPenjualan();
$('#btnMasterHargaPokokPenjualanSrc').click(function () {
  $('#tblMasterHargaPokokPenjualan').DataTable().destroy();
  tblMasterHargaPokokPenjualan();
});
function showMasterHargaPokokPenjualanUp(hpp_id, hpp_dasar, supliyer_id, product_name, harga_jual, product_kode, kode_h2h, hpp_status) {
  $('input[name=hpp_id]').val(hpp_id);
  $('input[name=hpp_dasar]').val(hpp_dasar);
  $('select[name=supliyer_id]').val(supliyer_id);
  $('input[name=product_name]').val(product_name);
  $('input[name=harga_jual]').val(harga_jual);
  $('input[name=product_kode]').val(product_kode);
  $('input[name=kode_h2h]').val(kode_h2h);
  $('select[name=hpp_status]').val(hpp_status);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterHargaPokokPenjualanUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterHargaPokokPenjualanUp').trigger('reset');
        $('#formMasterHargaPokokPenjualanUp').validate().resetForm();
        $('input').removeClass('error');
      }
    }
  });
}
$('#btnMasterHargaPokokPenjualanUp').click(function () {
  if ($("#formMasterHargaPokokPenjualanUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/HargaPokokPenjualan/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterHargaPokokPenjualanUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterHargaPokokPenjualan').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('#product_kode').change(function () {
  var product_kode = $(this).find('option:selected').val();
  showBlockUI();
  $.ajax({
    url: base_url + "/Master/HargaPokokPenjualan/get_data_produk",
    method: 'POST',
    data: {
      product_kode: product_kode,
    },
    dataType: 'json',
    success: function (data) {
      $('input[name=harga_jual]').val(addCommas(data.harga_jual.slice(0, -3)));
      $('input[name=product_kode]').val(data.product_kode);
      closeBlockUI();
    }
  });
});
$('#btnMasterHargaPokokPenjualanAdd').click(function () {
  if ($("#formMasterHargaPokokPenjualanAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/HargaPokokPenjualan/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterHargaPokokPenjualanAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterHargaPokokPenjualan').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterHargaPokokPenjualanDel(hpp_id, provider_name) {
  swal({
    title: 'Silahkan masukkan KEY untuk menghapus data ini!',
    type: 'warning',
    text: provider_name,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/HargaPokokPenjualan/del_data",
        method: 'POST',
        dataType: 'json',
        data: {
          hpp_id: hpp_id,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterHargaPokokPenjualan').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
// Master Data -> Produk
function tblMasterProduk() {
  $('#tblMasterProduk').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/Produk/get_datatable",
      type: "POST",
      data: {
        status: 'MasterProduk',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        typeSearch: $('select[name=custom_type]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterProduk();
$('#btnMasterProdukSrc').click(function () {
  $('#tblMasterProduk').DataTable().destroy();
  tblMasterProduk();
});
function showMasterProdukUp(product_kode, product_name, h2h_code, harga_jual, product_status, type_product, provider_id, nominal_id, harga_h2h, admin_supplier, disc, product_image) {
  $('input[name=product_kode]').val(product_kode);
  $('input[name=product_name]').val(product_name);
  $('input[name=h2h_code]').val(h2h_code);
  $('input[name=harga_jual]').val(harga_jual.slice(0, -3));
  $('select[name=type_product]').val(type_product);
  $('select[name=provider_id]').val(provider_id);
  $('input[name=nominal_id]').val(nominal_id);
  $('select[name=product_status]').val(product_status);
  $('input[name=harga_h2h]').val(harga_h2h.slice(0, -3));
  $('input[name=admin_supplier]').val(admin_supplier);
  $('input[name=disc]').val(disc);
  $('input[name=product_image]').val(product_image);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterProdukUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterProdukUp').trigger('reset');
        $('#formMasterProdukUp').validate().resetForm();
        $('input,select').removeClass('error');
      }
    }
  });
}
$('#btnMasterProdukUp').click(function () {
  if ($("#formMasterProdukUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/Produk/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterProdukUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterProduk').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('#btnMasterProdukAdd').click(function () {
  if ($("#formMasterProdukAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/Produk/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterProdukAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterProduk').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterProdukDel(product_kode, product_name) {
  swal({
    title: 'Silahkan masukkan KEY untuk menghapus data ini!',
    type: 'warning',
    text: product_name,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/Produk/del_data",
        method: 'POST',
        dataType: 'json',
        data: {
          product_kode: product_kode,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterProduk').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
// Master Data -> Supplier
function tblMasterSupplier() {
  $('#tblMasterSupplier').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/Supplier/get_datatable",
      type: "POST",
      data: {
        status: 'MasterSupplier',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        typeSearch: $('select[name=custom_type]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterSupplier();
$('#btnMasterSupplierSrc').click(function () {
  $('#tblMasterSupplier').DataTable().destroy();
  tblMasterSupplier();
});
$('#btnMasterSupplierAdd').click(function () {
  if ($("#formMasterSupplierAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/Supplier/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterSupplierAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterSupplier').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterSupplierUp(supliyer_id, supliyer_name, ip_in, url_topup, user_url, paswd_url, url_report, usr_report, pswd_report, supliyer_status) {
  $('input[name=supliyer_id]').val(supliyer_id);
  $('input[name=supliyer_name]').val(supliyer_name);
  $('input[name=ip_in]').val(ip_in);
  $('input[name=url_topup]').val(url_topup);
  $('input[name=user_url]').val(user_url);
  $('input[name=paswd_url]').val(paswd_url);
  $('input[name=url_report]').val(url_report);
  $('input[name=usr_report]').val(usr_report);
  $('input[name=pswd_report]').val(pswd_report);
  $('select[name=supliyer_status]').val(supliyer_status);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterSupplierUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterSupplierUp').trigger('reset');
        $('#formMasterSupplierUp').validate().resetForm();
        $('input,select').removeClass('error');
      }
    }
  });
}
$('#btnMasterSupplierUp').click(function () {
  if ($("#formMasterSupplierUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/Supplier/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterSupplierUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterSupplier').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterSupplierDel(supliyer_id, supliyer_name) {
  swal({
    title: 'Silahkan masukkan KEY untuk menghapus data ini!',
    type: 'warning',
    text: supliyer_name,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/Supplier/del_data",
        method: 'POST',
        dataType: 'json',
        data: {
          supliyer_id: supliyer_id,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterSupplier').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
// Master Data -> Provider
function tblMasterProvider() {
  $('#tblMasterProvider').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/Provider/get_datatable",
      type: "POST",
      data: {
        status: 'MasterProvider',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        typeSearch: $('select[name=custom_type]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterProvider();
$('#btnMasterProviderSrc').click(function () {
  $('#tblMasterProvider').DataTable().destroy();
  tblMasterProvider();
});
function showMasterProviderUp(provider_id, provider_name, provaider_status, provaider_type, provaider_group) {
  $('input[name=provider_id]').val(provider_id);
  $('input[name=provider_name]').val(provider_name);
  $('select[name=provaider_status]').val(provaider_status);
  $('select[name=provaider_type2]').val(provaider_type);
  $('input[name=provaider_group]').val(provaider_group);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterProviderUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterProviderUp').trigger('reset');
        $('#formMasterProviderUp').validate().resetForm();
        $('input,select').removeClass('error');
      }
    }
  });
}
$('#btnMasterProviderUp').click(function () {
  if ($("#formMasterProviderUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/Provider/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterProviderUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterProvider').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('#btnMasterProviderAdd').click(function () {
  if ($("#formMasterProviderAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/Provider/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterProviderAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterProvider').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterProviderDel(provider_id, provider_name) {
  swal({
    title: 'Silahkan masukkan KEY untuk menghapus data ini!',
    type: 'warning',
    text: provider_name,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/Provider/del_data",
        method: 'POST',
        dataType: 'json',
        data: {
          provider_id: provider_id,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterProvider').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
/* Group/Prefix Provider */
$('select[name=provaider_type2]').change(function () {
  showBlockUI();
  $.ajax({
    url: base_url + "/Master/Provider/get_provider_group",
    method: 'POST',
    data: {
      provaider_type: this.value,
    },
    success: function (data) {
      $('input[name=provaider_group]').val(data);
      closeBlockUI();
    }
  });
});
// Master Data -> Bonus Transaksi
function tblMasterBonusTransaksi() {
  $('#tblMasterBonusTransaksi').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/BonusTransaksi/get_datatable",
      type: "POST",
      data: {
        status: 'MasterBonusTransaksi',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterBonusTransaksi();
$('#btnMasterBonusTransaksiSrc').click(function () {
  $('#tblMasterBonusTransaksi').DataTable().destroy();
  tblMasterBonusTransaksi();
});
// Master Data -> Bank
function tblMasterBank() {
  $('#tblMasterBank').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/Bank/get_datatable",
      type: "POST",
      data: {
        status: 'MasterBank',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        typeSearch: $('select[name=custom_type]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
$('#btnMasterBankSrc').click(function () {
  $('#tblMasterBank').DataTable().destroy();
  tblMasterBank();
});
function showUpdateBank(id, nama_bank, nomer_rekening, nama_pemilik, bank_status, cabang_bank, kode_bank, desc_bank) {
  $('input[name=id]').val(id);
  $('input[name=nama_bank]').val(nama_bank);
  $('input[name=nomer_rekening]').val(nomer_rekening);
  $('input[name=nama_pemilik]').val(nama_pemilik);
  $('input[name=cabang_bank]').val(cabang_bank);
  $('select[name=bank_status]').val(bank_status);
  $('input[name=kode_bank]').val(kode_bank);
  $('input[name=desc_bank]').val(desc_bank);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterBankUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterBankUp').trigger('reset');
        $('#formMasterBankUp').validate().resetForm();
        $('input,select').removeClass('error');
      }
    }
  });
}
$('#btnMasterBankUp').click(function () {
  if ($("#formMasterBankUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/Bank/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterBankUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterBank').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('#btnMasterBankAdd').click(function () {
  if ($("#formMasterBankAdd").valid()) {

    var formData = new FormData($('#formMasterBankAdd')[0]);

    showBlockUI();
    $.ajax({
      url: base_url + "/Master/Bank/add_data",
      method: 'POST',
      dataType: 'json',
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      async: false,
      success: function (data) {
        if (data.status) {
          $('#tblMasterBank').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterBankDel(id, nama_bank) {
  swal({
    title: 'Silahkan masukkan KEY untuk menghapus data ini!',
    type: 'warning',
    text: nama_bank,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/Bank/del_data",
        method: 'POST',
        dataType: 'json',
        data: {
          id: id,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterBank').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
function fnMasterBankLogo(id, nama_bank) {
  // swal("INFO", 'Fungsi Masih Dalam Pegembangan', "info");
  $('input[name=id]').val(id);
  $('input[name=nama_bank]').val(nama_bank);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterBankLogo',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterBankLogo').trigger('reset');
        $('#formMasterBankLogo').validate().resetForm();
        $('input,select').removeClass('error');
      }
    }
  });
}
$('#btnMasterBankLogo').click(function () {
  if ($("#formMasterBankLogo").valid()) {

    var formData = new FormData($('#formMasterBankLogo')[0]);

    showBlockUI();
    $.ajax({
      url: base_url + "/Master/Bank/up_banner",
      method: 'POST',
      dataType: 'json',
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      async: false,
      success: function (data) {
        if (data.status) {
          $('#tblMasterBank').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Master Data -> Web App
function tblMasterWebApp() {
  $('#tblMasterWebApp').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/WebApp/get_datatable",
      type: "POST",
      data: {
        status: 'MasterWebApp',
        trgSearch: $('select[name=search_type] :selected').parent().attr('label'),
        txtSearchKey: $('select[name=search_type]').val(),
        typeSearch: $('select[name=custom_type]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterWebApp();
$('#btnMasterWebAppSrc').click(function () {
  $('#tblMasterWebApp').DataTable().destroy();
  tblMasterWebApp();
});
$('#btnMasterWebAppAdd').click(function () {
  if ($("#formMasterWebAppAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/WebApp/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterWebAppAdd').serialize() + "&arr_product_kode=" + $('select[name=product_kode]').val(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterWebApp').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showUpdateWebApp(app_id, supliyer_id, jalur_trx, product_kode, limit_trx, status_app) {
  var product_kode = product_kode.split(',')
  product_kode.forEach(function (element) {
    $("select[name=product_kode] option[value=" + element + "]").prop("selected", "selected");
  });
  $('select[name=product_kode]').trigger("change");

  $('input[name=app_id]').val(app_id);
  $('select[name=supliyer_id]').val(supliyer_id);
  $('input[name=jalur_trx]').val(jalur_trx);
  $('input[name=limit_trx]').val(limit_trx);
  $('select[name=status_app]').val(status_app);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterWebAppUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterWebAppUp').trigger('reset');
        $('#formMasterWebAppUp').validate().resetForm();
        $('select[name=product_kode]').val("");
        $('select[name=product_kode]').trigger("change");
        $('input,select').removeClass('error');
      }
    }
  });
}
$('#btnMasterWebAppUp').click(function () {
  if ($("#formMasterWebAppUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/WebApp/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterWebAppUp').serialize() + "&arr_product_kode=" + $('select[name=product_kode]').val(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterWebApp').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterWebAppDel(app_id) {
  swal({
    title: 'Silahkan masukkan KEY untuk menghapus data ini!',
    type: 'warning',
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/WebApp/del_data",
        method: 'POST',
        dataType: 'json',
        data: {
          app_id: app_id,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterWebApp').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
// Master Data -> Jalur Transaksi
function tblMasterJalurTransaksi() {
  $('#tblMasterJalurTransaksi').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/JalurTransaksi/get_datatable",
      type: "POST",
      data: {
        status: 'MasterJalurTransaksi',
        trgSearch: $('select[name=search_type] :selected').parent().attr('label'),
        txtSearchKey: $('select[name=search_type]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterJalurTransaksi();
$('#btnMasterJalurTransaksiSrc').click(function () {
  $('#tblMasterJalurTransaksi').DataTable().destroy();
  tblMasterJalurTransaksi();
});
$('#btnMasterJalurTransaksiAdd').click(function () {
  if ($("#formMasterJalurTransaksiAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/JalurTransaksi/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterJalurTransaksiAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterJalurTransaksi').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterJalurTransaksiUp(id_jalur, product_name, supliyer_id, jalur, limit_jalur, status_jalur, antrean_number, product_kode, ep_cek) {
  $('input[name=id_jalur]').val(id_jalur);
  $('input[name=product_name]').val(product_name + ' [' + product_kode + ']');
  $('select[name=supliyer_id]').val(supliyer_id);
  $('input[name=jalur]').val(jalur);
  $('input[name=limit_jalur]').val(limit_jalur);
  $('input[name=antrean_number]').val(antrean_number);
  $('input[name=ep_cek]').val(ep_cek);
  $('select[name=status_jalur]').val(status_jalur);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterJalurTransaksiUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterJalurTransaksiUp').trigger('reset');
        $('#formMasterJalurTransaksiUp').validate().resetForm();
        $('input,select').removeClass('error');
      }
    }
  });
}
$('#btnMasterJalurTransaksiUp').click(function () {
  if ($("#formMasterJalurTransaksiUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/JalurTransaksi/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterJalurTransaksiUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterJalurTransaksi').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterJalurTransaksiDel(id_jalur, product_name) {
  swal({
    title: 'Silahkan masukkan KEY untuk menghapus data ini!',
    type: 'warning',
    text: product_name,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/JalurTransaksi/del_data",
        method: 'POST',
        dataType: 'json',
        data: {
          id_jalur: id_jalur,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterJalurTransaksi').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
// Master Data -> User CRM
function tblMasterUserCrm() {
  $('#tblMasterUserCrm').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/UserCrm/get_datatable",
      type: "POST",
      data: {
        status: 'MasterUserCrm',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        typeSearch: $('select[name=custom_type]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterUserCrm();
$('#btnMasterUserCrmSrc').click(function () {
  $('#tblMasterUserCrm').DataTable().destroy();
  tblMasterUserCrm();
});
function showUpdateUserCrm(user_login, user_fname, user_lname, user_level, user_active, level_user, user_hp) {
  $('input[name=user_login]').val(user_login);
  $('input[name=user_fname]').val(user_fname);
  $('input[name=user_lname]').val(user_lname);
  $('select[name=user_level]').val(user_level);
  $('select[name=user_active]').val(user_active);
  $('select[name=level_user]').val(level_user);
  $('input[name=user_hp]').val(user_hp);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterUserCrm',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterUserCrm').trigger('reset');
        $('#formMasterUserCrm').validate().resetForm();
        $('input,select').removeClass('error');
      }
    }
  });
}
$('#btnMasterUserCrm').click(function () {
  if ($("#formMasterUserCrm").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/UserCrm/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterUserCrm').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterUserCrm').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('#formMasterUserCrmAdd').validate({
  rules: {
    'user_password_repeat': {
      equalTo: '[name=user_password]'
    },
  }
});
$('#btnMasterUserCrmAdd').click(function () {
  if ($("#formMasterUserCrmAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/UserCrm/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterUserCrmAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterUserCrm').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Master Data -> Kompetisi Transaksi
function tblMasterKompetisiTransaksi() {
  $('#tblMasterKompetisiTransaksi').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/KompetisiTransaksi/get_datatable",
      type: "POST",
      data: {
        status: 'MasterKompetisiTransaksi',
        typeSearch: $('select[name=custom_type]').val(),
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
$('#btnMasterKompetisiTransaksiSrc').click(function () {
  $('#tblMasterKompetisiTransaksi').DataTable().destroy();
  tblMasterKompetisiTransaksi();
});
function showUpdateKompetisiTransaksi(id_kompetisi, nama_kompetisi, status_kompetisi, start_kompetisi, end_kompetisi, status_rekrut, peserta_kompetisi, sk_kompetisi, sortir_tgl_daftar, start_tgl_daftar, end_tgl_daftar, tipe_perhitungan) {
  $('input[name=id]').val(id_kompetisi);
  $('input[name=nama_kompetisi]').val(nama_kompetisi);
  $('select[name=status_kompetisi]').val(status_kompetisi);
  var tgl = new Date(start_kompetisi);
  $('input[name=start_kompetisi]').datepicker("update", pad(tgl.getDate(), 2) + "-" + pad(tgl.getMonth() + 1, 2) + "-" + tgl.getFullYear());
  var tgl = new Date(end_kompetisi);
  $('input[name=end_kompetisi]').datepicker("update", pad(tgl.getDate(), 2) + "-" + pad(tgl.getMonth() + 1, 2) + "-" + tgl.getFullYear());
  $('select[name=status_rekrut]').val(status_rekrut);
  $('select[name=peserta_kompetisi]').val(peserta_kompetisi);
  $('input[name=sk_kompetisi]').val(sk_kompetisi);

  $('select[name=sortir_tgl_daftar]').val(sortir_tgl_daftar);
  if (sortir_tgl_daftar == 1) {
    $('input[name=start_tgl_daftar],input[name=end_tgl_daftar').prop('disabled', false);
  } else {
    $('input[name=start_tgl_daftar],input[name=end_tgl_daftar').prop('disabled', true);
  }
  var tgl = new Date(start_tgl_daftar);
  $('input[name=start_tgl_daftar]').datepicker("update", pad(tgl.getDate(), 2) + "-" + pad(tgl.getMonth() + 1, 2) + "-" + tgl.getFullYear());
  var tgl = new Date(end_tgl_daftar);
  $('input[name=end_tgl_daftar]').datepicker("update", pad(tgl.getDate(), 2) + "-" + pad(tgl.getMonth() + 1, 2) + "-" + tgl.getFullYear());

  $('select[name=tipe_perhitungan]').val(tipe_perhitungan);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterKompetisiTransaksiUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterKompetisiTransaksiUp').trigger('reset');
        $('#formMasterKompetisiTransaksiUp').validate().resetForm();
        $('input,select').removeClass('error');
      }
    }
  });
}
$('#btnMasterKompetisiTransaksiUp').click(function () {
  if ($("#formMasterKompetisiTransaksiUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/KompetisiTransaksi/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterKompetisiTransaksiUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterKompetisiTransaksi').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('#btnMasterKompetisiTransaksiAdd').click(function () {
  if ($("#formMasterKompetisiTransaksiAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/KompetisiTransaksi/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterKompetisiTransaksiAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterKompetisiTransaksi').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showKompetisiTransaksiParam(id_kompetisi) {
  $('#formMasterKompetisiTransaksiParamAdd').trigger('reset');
  $('#formMasterKompetisiTransaksiParamAdd').validate().resetForm();
  $('input,select').removeClass('error');
  $('input[name=id]').val(id_kompetisi);
  showBlockUI();
  $.ajax({
    url: base_url + "/Master/KompetisiTransaksi/get_datatable_detail",
    type: "POST",
    data: {
      id_kompetisi: id_kompetisi,
    },
    dataType: 'JSON',
    success: function (data) {
      tblMasterKompetisiTransaksiParam.clear();
      tblMasterKompetisiTransaksiParam.rows.add(data).draw();
      $.magnificPopup.open({
        items: {
          src: '#mdMasterKompetisiTransaksiParam',
          type: 'inline',
        },
        mainClass: 'mfp-with-zoom',
        closeBtnInside: true,
        callbacks: {
          open: function () {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            $.magnificPopup.instance._onFocusIn = function (e) { };
          }
        }
      });
      closeBlockUI();
    }
  });
}
$('#btnMasterKompetisiTransaksiParamAdd').click(function () {
  if ($("#formMasterKompetisiTransaksiParamAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/KompetisiTransaksi/add_data_param",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterKompetisiTransaksiParamAdd').serialize(),
      success: function (data) {
        if (data.status) {
          var id_kompetisi = $('input[name=id]').val();
          $.ajax({
            url: base_url + "/Master/KompetisiTransaksi/get_datatable_detail",
            type: "POST",
            data: {
              id_kompetisi: id_kompetisi,
            },
            dataType: 'JSON',
            success: function (data) {
              tblMasterKompetisiTransaksiParam.clear();
              tblMasterKompetisiTransaksiParam.rows.add(data).draw();
            }
          });
          $('select[name=provaider_type]').val('').trigger('change');
          $('input[name=value_param]').val('');
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterKompetisiTransaksiParamDel(id_kompetisi, provaider_type) {
  swal({
    title: 'Silahkan masukkan KEY untuk menghapus data ini!',
    type: 'warning',
    text: provaider_type,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/KompetisiTransaksi/del_data_param",
        method: 'POST',
        dataType: 'json',
        data: {
          id_kompetisi: id_kompetisi,
          provaider_type: provaider_type,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $.ajax({
              url: base_url + "/Master/KompetisiTransaksi/get_datatable_detail",
              type: "POST",
              data: {
                id_kompetisi: id_kompetisi,
              },
              dataType: 'JSON',
              success: function (data) {
                tblMasterKompetisiTransaksiParam.clear();
                tblMasterKompetisiTransaksiParam.rows.add(data).draw();
              }
            });
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
// Master Data -> Tiket Seminar -> Tipe Seminar
function tblMasterTipeSeminar() {
  $('#tblMasterTipeSeminar').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/TiketSeminar/TipeSeminar/get_datatable",
      type: "POST",
      data: {
        status: 'MasterTipeSeminar',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
$('#btnMasterTipeSeminarSrc').click(function () {
  $('#tblMasterTipeSeminar').DataTable().destroy();
  tblMasterTipeSeminar();
});
function showMasterTipeSeminarUp(id_type_seminar, type) {
  $('input[name=id_type_seminar]').val(id_type_seminar);
  $('input[name=type]').val(type);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterTipeSeminarUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterTipeSeminarUp').trigger('reset');
        $('#formMasterTipeSeminarUp').validate().resetForm();
        $('input').removeClass('error');
      }
    }
  });
}
$('#btnMasterTipeSeminarUp').click(function () {
  if ($("#formMasterTipeSeminarUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/TiketSeminar/TipeSeminar/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterTipeSeminarUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterTipeSeminar').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('#btnMasterTipeSeminarAdd').click(function () {
  if ($("#formMasterTipeSeminarAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/TiketSeminar/TipeSeminar/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterTipeSeminarAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterTipeSeminar').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterTipeSeminarDel(id_type_seminar, type) {
  swal({
    title: 'Silahkan masukkan KEY untuk menghapus data ini!',
    type: 'warning',
    text: type,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/TiketSeminar/TipeSeminar/del_data",
        method: 'POST',
        dataType: 'json',
        data: {
          id_type_seminar: id_type_seminar,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterTipeSeminar').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
// Master Data -> Tiket Seminar -> Seminar
function tblMasterSeminar() {
  $('#tblMasterSeminar').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/TiketSeminar/Seminar/get_datatable",
      type: "POST",
      data: {
        status: 'MasterSeminar',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
        stsSearch: $('select[name=search_status]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
$('#btnMasterSeminarSrc').click(function () {
  $('#tblMasterSeminar').DataTable().destroy();
  tblMasterSeminar();
});
$('#btnMasterSeminarAdd').click(function () {
  if ($("#formMasterSeminarAdd").valid()) {

    var formData = new FormData($('#formMasterSeminarAdd')[0]);

    showBlockUI();
    $.ajax({
      url: base_url + "/Master/TiketSeminar/Seminar/add_data",
      method: 'POST',
      dataType: 'json',
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      async: false,
      success: function (data) {
        if (data.status) {
          $("select[name=id_type_seminar]").val('');
          $('select[name=id_type_seminar]').trigger("change");
          $('#tblMasterSeminar').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterSeminarUp(seminar_id, nama_seminar, pembicara, id_type_seminar, tgl_seminar, seminar_status, jumlah_kursi, keterangan, brosur_seminar, harga_seminar, ep, profit) {
  $('input[name=seminar_id]').val(seminar_id);
  $('input[name=nama_seminar]').val(nama_seminar);
  $('input[name=pembicara]').val(pembicara);
  $('select[name=id_type_seminar]').val(id_type_seminar).trigger('change');
  var tgl = new Date(tgl_seminar);
  $('input[name=tgl_seminar]').datepicker("update", pad(tgl.getDate(), 2) + "-" + pad(tgl.getMonth() + 1, 2) + "-" + tgl.getFullYear());
  $('select[name=seminar_status]').val(seminar_status);
  $('input[name=jumlah_kursi]').val(jumlah_kursi);
  $('textarea[name=keterangan]').val(keterangan);
  $('input[name=brosur_seminar]').val(brosur_seminar);
  $('input[name=harga_seminar]').val(harga_seminar);
  $('input[name=ep]').val(ep);
  $('input[name=profit]').val(profit);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterSeminarUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterSeminarUp').trigger('reset');
        $("select[name=id_type_seminar]").val('');
        $('select[name=id_type_seminar]').trigger("change");
        $('#formMasterSeminarUp').validate().resetForm();
        $('input, select').removeClass('error');
      }
    }
  });
}
$('#btnMasterSeminarUp').click(function () {
  if ($("#formMasterSeminarUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/TiketSeminar/Seminar/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterSeminarUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterSeminar').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function fnMasterSeminarImage(seminar_id) {
  $('input[name=seminar_id]').val(seminar_id);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterSeminarImage',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterSeminarImage').trigger('reset');
        $('#formMasterSeminarImage').validate().resetForm();
        $('input').removeClass('error');
      }
    }
  });
}
$('#btnMasterSeminarImage').click(function () {
  if ($("#formMasterSeminarImage").valid()) {

    var formData = new FormData($('#formMasterSeminarImage')[0]);

    showBlockUI();
    $.ajax({
      url: base_url + "/Master/TiketSeminar/Seminar/up_image",
      method: 'POST',
      dataType: 'json',
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      async: false,
      success: function (data) {
        if (data.status) {
          $('#tblMasterSeminar').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Master Data -> Menu User CRM -> Group
function tblMasterMenuCrmGroup() {
  $('#tblMasterMenuCrmGroup').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/MenuCrm/Group/get_datatable",
      type: "POST",
      data: {
        status: 'MasterMenuCrmGroup',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        typeSearch: $('select[name=custom_type]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterMenuCrmGroup();
$('#btnMasterMenuCrmGroupSrc').click(function () {
  $('#tblMasterMenuCrmGroup').DataTable().destroy();
  tblMasterMenuCrmGroup();
});
$('#btnMasterMenuCrmGroupAdd').click(function () {
  if ($("#formMasterMenuCrmGroupAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/MenuCrm/Group/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterMenuCrmGroupAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterMenuCrmGroup').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterMenuCrmGroupDel(menugroup_id, menu_name) {
  swal({
    title: 'Silahkan masukkan KEY untuk menghapus data ini!',
    type: 'warning',
    text: menu_name,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/MenuCrm/Group/del_data",
        method: 'POST',
        dataType: 'json',
        data: {
          menugroup_id: menugroup_id,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterMenuCrmGroup').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
function showMasterMenuCrmGroupUp(menugroup_id, menu_name, menu_status, menu_show, group_icon, group_type) {
  $('input[name=menugroup_id]').val(menugroup_id);
  $('input[name=menu_name]').val(menu_name);
  $('input[name=menu_show]').val(menu_show);
  $('input[name=group_icon]').val(group_icon);
  $('select[name=menu_status]').val(menu_status);
  $('select[name=group_type]').val(group_type);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterMenuCrmGroupUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterMenuCrmGroupUp').trigger('reset');
        $('#formMasterMenuCrmGroupUp').validate().resetForm();
        $('input').removeClass('error');
      }
    }
  });
}
$('#btnMasterMenuCrmGroupUp').click(function () {
  if ($("#formMasterMenuCrmGroupUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/MenuCrm/Group/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterMenuCrmGroupUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterMenuCrmGroup').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Master Data -> Menu User CRM -> Menu
function tblMasterMenuCrmMenu() {
  $('#tblMasterMenuCrmMenu').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/MenuCrm/Menu/get_datatable",
      type: "POST",
      data: {
        status: 'MasterMenuCrmMenu',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        typeSearch: $('select[name=custom_type]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterMenuCrmMenu();
$('#btnMasterMenuCrmMenuSrc').click(function () {
  $('#tblMasterMenuCrmMenu').DataTable().destroy();
  tblMasterMenuCrmMenu();
});
$('#btnMasterMenuCrmMenuAdd').click(function () {
  if ($("#formMasterMenuCrmMenuAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/MenuCrm/Menu/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterMenuCrmMenuAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterMenuCrmMenu').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterMenuCrmMenuUp(menu_id, menu_status, menugroup_id, menu_name, menu_link, opr_val, ac_val, op_val, all_val, menu_show) {
  $('input[name=menu_id]').val(menu_id);
  $('input[name=menu_name]').val(menu_name);
  $('input[name=menu_link]').val(menu_link);
  $('input[name=menu_show]').val(menu_show);
  $('select[name=menu_status]').val(menu_status);
  $('select[name=menugroup_id]').val(menugroup_id);
  $('select[name=opr_val]').val(opr_val);
  $('select[name=ac_val]').val(ac_val);
  $('select[name=op_val]').val(op_val);
  $('select[name=all_val]').val(all_val);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterMenuCrmMenuUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterMenuCrmMenuUp').trigger('reset');
        $('#formMasterMenuCrmMenuUp').validate().resetForm();
        $('input,select').removeClass('error');
      }
    }
  });
}
$('#btnMasterMenuCrmMenuUp').click(function () {
  if ($("#formMasterMenuCrmMenuUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/MenuCrm/Menu/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterMenuCrmMenuUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterMenuCrmMenu').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterMenuCrmMenuDel(menu_id, menu_name) {
  swal({
    title: 'Silahkan masukkan KEY untuk menghapus data ini!',
    type: 'warning',
    text: menu_name,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/MenuCrm/Menu/del_data",
        method: 'POST',
        dataType: 'json',
        data: {
          menu_id: menu_id,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterMenuCrmMenu').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}

// Master Data -> App Version
function tblMasterAppVersion() {
  $('#tblMasterAppVersion').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/AppVersion/get_datatable",
      type: "POST",
      data: {
        status: 'MasterAppVersion',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        // typeSearch: $('select[name=custom_type]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterAppVersion();
$('#btnMasterAppVersionSrc').click(function () {
  $('#tblMasterAppVersion').DataTable().destroy();
  tblMasterAppVersion();
});
$('#btnMasterAppVersionAdd').click(function () {
  if ($("#formMasterAppVersionAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/AppVersion/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterAppVersionAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $("select[name=user_login]").val('');
          $("select[name=menu_id]").val('');
          $('select[name=user_login],select[name=menu_id]').trigger("change");
          $('#tblMasterAppVersion').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterAppVersionUp(app_id, app_name, app_version, app_status) {
  $('input[name=app_id]').val(app_id);
  $('input[name=app_name]').val(app_name);
  $('input[name=app_version]').val(app_version);
  $('input[name=app_status]').val(app_status);

  $.magnificPopup.open({
    items: {
      src: '#mdMasterAppVersionUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterAppVersionUp').trigger('reset');
        $('#formMasterAppVersionUp').validate().resetForm();
        $('input,select').removeClass('error');
      }
    }
  });
}
$('#btnMasterAppVersionUp').click(function () {
  if ($("#formMasterAppVersionUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/AppVersion/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterAppVersionUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterAppVersion').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterAppVersionDel(app_id, app_name) {
  swal({
    title: 'Silahkan masukkan KEY untuk menghapus data ini!',
    type: 'warning',
    text: app_name,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/AppVersion/del_data",
        method: 'POST',
        dataType: 'json',
        data: {
          app_id: app_id,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterAppVersion').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
// Master Data -> Menu User CRM -> User
function tblMasterMenuCrmUser() {
  $('#tblMasterMenuCrmUser').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/MenuCrm/User/get_datatable",
      type: "POST",
      data: {
        status: 'MasterMenuCrmUser',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        // typeSearch: $('select[name=custom_type]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterMenuCrmUser();
$('#btnMasterMenuCrmUserSrc').click(function () {
  $('#tblMasterMenuCrmUser').DataTable().destroy();
  tblMasterMenuCrmUser();
});
$('#btnMasterMenuCrmUserAdd').click(function () {
  if ($("#formMasterMenuCrmUserAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/MenuCrm/User/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterMenuCrmUserAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $("select[name=user_login]").val('');
          $("select[name=menu_id]").val('');
          $('select[name=user_login],select[name=menu_id]').trigger("change");
          $('#tblMasterMenuCrmUser').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterMenuCrmUserUp(menu_user_id, user_login, user_level, menu_id) {
  $('input[name=menu_user_id]').val(menu_user_id);
  $('input[name=user_level]').val(user_level);
  // $('select[name=user_login]').val(user_login);
  // $('select[name=menu_id]').val(menu_id);
  $("select[name=user_login] option[value=" + user_login + "]").prop("selected", "selected");
  $("select[name=menu_id] option[value=" + menu_id + "]").prop("selected", "selected");
  $('select[name=user_login],select[name=menu_id]').trigger("change");

  $.magnificPopup.open({
    items: {
      src: '#mdMasterMenuCrmUserUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formMasterMenuCrmUserUp').trigger('reset');
        $('#formMasterMenuCrmUserUp').validate().resetForm();
        $('input,select').removeClass('error');
      }
    }
  });
}
$('#btnMasterMenuCrmUserUp').click(function () {
  if ($("#formMasterMenuCrmUserUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/MenuCrm/User/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterMenuCrmUserUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterMenuCrmUser').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterMenuCrmUserDel(menu_user_id, menu_name) {
  swal({
    title: 'Silahkan masukkan KEY untuk menghapus data ini!',
    type: 'warning',
    text: menu_name,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/MenuCrm/User/del_data",
        method: 'POST',
        dataType: 'json',
        data: {
          menu_user_id: menu_user_id,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterMenuCrmUser').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
// Master Data -> Block Destionation
function tblMasterBlockDestionation() {
  $('#tblMasterBlockDestionation').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/BlockDestination/get_datatable",
      type: "POST",
      data: {
        status: 'MasterBlockDestionation',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterBlockDestionation();
$('#btnMasterBlockDestionationSrc').click(function () {
  $('#tblMasterBlockDestionation').DataTable().destroy();
  tblMasterBlockDestionation();
});
$('#btnMasterBlockDestionationAdd').click(function () {
  if ($("#formMasterBlockDestionationAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/BlockDestination/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterBlockDestionationAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterBlockDestionation').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterBlockDestinationDel(id_destination, destination) {
  swal({
    title: 'Silahkan masukkan KEY untuk menghapus data ini!',
    type: 'warning',
    text: destination,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Lanjutkan!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/BlockDestination/del_data",
        method: 'POST',
        dataType: 'json',
        data: {
          id_destination: id_destination,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterBlockDestionation').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
// Master Data -> Block Device
function tblMasterBlockDevice() {
  $('#tblMasterBlockDevice').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/BlockDevice/get_datatable",
      type: "POST",
      data: {
        status: 'MasterBlockDevice',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterBlockDevice();
$('#btnMasterBlockDeviceSrc').click(function () {
  $('#tblMasterBlockDevice').DataTable().destroy();
  tblMasterBlockDevice();
});
$('#btnMasterBlockDeviceAdd').click(function () {
  if ($("#formMasterBlockDeviceAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/BlockDevice/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterBlockDeviceAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterBlockDevice').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterBlockDeviceDel(id_destination, destination) {
  swal({
    title: 'Silahkan masukkan KEY untuk menghapus data ini!',
    type: 'warning',
    text: destination,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Lanjutkan!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/BlockDevice/del_data",
        method: 'POST',
        dataType: 'json',
        data: {
          id_destination: id_destination,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterBlockDevice').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
// Master Data -> TemplateNotifikasi
function tblMasterTemplateNotifikasi() {
  $('#tblMasterTemplateNotifikasi').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Master/TemplateNotifikasi/get_datatable",
      type: "POST",
      data: {
        status: 'MasterTemplateNotifikasi',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblMasterTemplateNotifikasi();
$('#btnMasterTemplateNotifikasiSrc').click(function () {
  $('#tblMasterTemplateNotifikasi').DataTable().destroy();
  tblMasterTemplateNotifikasi();
});
$('#btnMasterTemplateNotifikasi').click(function () {
  var tpl_text = $('div[name=tpl_text]').summernote('code');
  if ($("#formMasterTemplateNotifikasi").valid() && tpl_text != '' && tpl_text != '<p><br></p>') {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/TemplateNotifikasi/addup_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formMasterTemplateNotifikasi').serialize() + "&tpl_text=" + encodeURIComponent(tpl_text),
      success: function (data) {
        if (data.status) {
          $('#tblMasterTemplateNotifikasi').DataTable().ajax.reload();
          swal("PROSES BERHASIL", data.message, "success");
          $('input[name=kode_form]').val('INSERT');
          $('div[name=tpl_text]').summernote('code', '');
          $('#formMasterTemplateNotifikasi').trigger('reset');
          $('#formMasterTemplateNotifikasi').validate().resetForm();
          $('input').removeClass('error');
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showMasterTemplateNotifikasiUp(tpl_code) {
  showBlockUI();
  $.ajax({
    url: base_url + "/Master/TemplateNotifikasi/get_data",
    method: 'POST',
    dataType: 'json',
    data: { tpl_code: tpl_code },
    success: function (data) {
      $('input[name=kode_form]').val('UPDATE');
      $('input[name=tpl_code]').val(data.tpl_code);
      $('input[name=tpl_name]').val(data.tpl_name);
      $('input[name=tpl_subject]').val(data.tpl_subject);
      $('input[name=tpl_sender]').val(data.tpl_sender);
      $('div[name=tpl_text]').summernote('code', data.tpl_text);
      window.scrollTo(0, 0);
      closeBlockUI();
    }
  });
}
$('.reset-summernote').click(function () {
  $('div[name=tpl_text]').summernote('code', '');
  $('input[name=kode_form]').val('INSERT');
});
function showMasterTemplateNotifikasiDel(tpl_code, tpl_name) {
  swal({
    title: 'Silahkan masukkan KEY untuk menghapus data ini!',
    type: 'warning',
    text: tpl_name,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Master/TemplateNotifikasi/del_data",
        method: 'POST',
        dataType: 'json',
        data: {
          tpl_code: tpl_code,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblMasterTemplateNotifikasi').DataTable().ajax.reload();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
// Validasi -> Member -> Upgrade Keanggotaan
function tblValidasiUpgradeKeanggotaan() {
  var tblValidasiUpgradeKeanggotaan = $('#tblValidasiUpgradeKeanggotaan').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Validasi/Member/UpgradeKeanggotaan/get_datatable",
      type: "POST",
      data: {
        status: 'ValidasiUpgradeKeanggotaan',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblValidasiUpgradeKeanggotaan();
$('#btnValidasiUpgradeKeanggotaanSrc').click(function () {
  $('#tblValidasiUpgradeKeanggotaan').DataTable().destroy();
  tblValidasiUpgradeKeanggotaan();
});
function showValidasiUpgradeKeanggotaanReject(mbr_code, mbr_name) {
  swal({
    title: 'Silahkan masukkan KEY untuk melanjutkan!',
    type: 'warning',
    text: "Proses ini akan menolak pengajuan Upgrade Keanggotaan dari member [" + mbr_code + "] dan member tidak akan mendapatkan keuntungan member verified. Apa Anda yakin melakukannya?",
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Validasi/Member/UpgradeKeanggotaan/up_data_reject",
        method: 'POST',
        dataType: 'json',
        data: {
          mbr_code: mbr_code,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblValidasiUpgradeKeanggotaan').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
function showValidasiUpgradeKeanggotaanReject2(mbr_code, mbr_name) {
  swal.mixin({
    input: 'text',
    confirmButtonText: 'Next &rarr;',
    showCancelButton: true,
    progressSteps: ['1', '2']
  }).queue([
    {
      title: 'Alasan Tolak',
      text: "Proses ini akan menerima pengajuan Upgrade Keanggotaan dari member [" + mbr_code + "] dan member akan mendapatkan keuntungan member verified.",
    },
    {
      title: 'Masukkan Key Untuk Melanjutkan',
    },
  ]).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Validasi/Member/UpgradeKeanggotaan/up_data_reject",
        method: 'POST',
        dataType: 'json',
        data: {
          mbr_code: mbr_code,
          key: result.value[1],
          alasan: result.value[0],
        },
        success: function (data) {
          if (data.status) {
            $('#tblValidasiUpgradeKeanggotaan').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
function showValidasiUpgradeKeanggotaanApprove(mbr_code, mbr_name) {
  swal({
    title: 'Silahkan masukkan KEY untuk melanjutkan!',
    type: 'warning',
    text: "Proses ini akan menerima pengajuan Upgrade Keanggotaan dari member [" + mbr_code + "] dan member akan mendapatkan keuntungan member verified. Apa Anda yakin melakukannya?",
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#47A447",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Validasi/Member/UpgradeKeanggotaan/up_data_approve",
        method: 'POST',
        dataType: 'json',
        data: {
          mbr_code: mbr_code,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblValidasiUpgradeKeanggotaan').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
function showValidasiKK(mbr_code) {
  swal({
    title: 'Silahkan masukkan KEY untuk melanjutkan!',
    type: 'warning',
    text: "Proses ini akan menerima pengajuan Upgrade Keanggotaan dari member [" + mbr_code + "] dan member akan mendapatkan keuntungan member verified Serta memverifikasi bahwa member ini tidak 1 KK dengan Upline. Apa Anda yakin melakukannya?",
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#47A447",
    confirmButtonText: "Iya, saya yakin!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Validasi/Member/UpgradeKeanggotaan/up_data_approve_kk",
        method: 'POST',
        dataType: 'json',
        data: {
          mbr_code: mbr_code,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblValidasiUpgradeKeanggotaan').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
$('#btnValidasiUpgradeKeanggotaanAdd').click(function () {
  if ($("#formValidasiUpgradeKeanggotaanAdd").valid()) {

    var formData = new FormData($('#formValidasiUpgradeKeanggotaanAdd')[0]);

    showBlockUI();
    $.ajax({
      url: base_url + "/Validasi/Member/UpgradeKeanggotaan/add_data",
      method: 'POST',
      dataType: 'json',
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      async: false,
      success: function (data) {
        if (data.status) {
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Validasi -> Member -> Upgrade Limit Transaksi
function tblValidasiUpgradeLimitTransaksi() {
  var tblValidasiUpgradeLimitTransaksi = $('#tblValidasiUpgradeLimitTransaksi').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Validasi/Member/UpgradeLimitTransaksi/get_datatable",
      type: "POST",
      data: {
        status: 'ValidasiUpgradeLimitTransaksi',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblValidasiUpgradeLimitTransaksi();
$('#btnValidasiUpgradeLimitTransaksiSrc').click(function () {
  $('#tblValidasiUpgradeLimitTransaksi').DataTable().destroy();
  tblValidasiUpgradeLimitTransaksi();
});
function showValidasiUpdateLimit(mbr_code, mbr_name, max_balance, max_transaction, max_transfer) {
  $('input[name=mbr_code]').val(mbr_code);
  $('input[name=mbr_name]').val(mbr_name);
  $('input[name=max_balance]').val(max_balance).trigger('input');
  $('input[name=max_transaction]').val(max_transaction).trigger("input");
  $('input[name=max_transfer]').val(max_transfer).trigger('input');

  $.magnificPopup.open({
    items: {
      src: '#mdValidasiUpdateLimit',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formValidasiUpdateLimit').trigger('reset');
        $('#formValidasiUpdateLimit').validate().resetForm();
        $('input').removeClass('error');
      }
    }
  });
}
$('#btnValidasiUpdateLimit').click(function () {
  if ($("#formValidasiUpdateLimit").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Validasi/Member/UpgradeLimitTransaksi/up_data_limit",
      method: 'POST',
      dataType: 'json',
      data: $('#formValidasiUpdateLimit').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblValidasiUpgradeLimitTransaksi').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Validasi Data - Member - Update Member Verified
function tblValidasiUpdateVerifiedMember() {
  $('#tblValidasiUpdateVerifiedMember').DataTable({
    lengthMenu: [[10, 50, 200, 1000, -1], [10, 50, 200, 1000, 'all']],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Validasi/Member/UpdateMemberVerified/get_datatable",
      type: "POST",
      data: {
        status: 'ValidasiUpdateVerifiedMember',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblValidasiUpdateVerifiedMember();
$('#btnValidasiUpdateVerifiedMemberSrc').click(function () {
  if ($("#formValidasiUpdateVerifiedMember").valid()) {
    $('#tblValidasiUpdateVerifiedMember').DataTable().destroy();
    tblValidasiUpdateVerifiedMember();
  }
});
function showUpdateValidasiUpdateVerifiedMember(mbr_code, mbr_name, mbr_dob, mbr_address, mbr_mobile, mbr_email, mbr_status, mbr_id_number, mbr_bank_name, mbr_bank_num, mbr_bank_acc, mbr_kota) {
  $('input[name=mbr_code]').val(mbr_code);
  $('input[name=mbr_name]').val(mbr_name);
  var tgl = new Date(mbr_dob);
  $('input[name=mbr_dob]').datepicker("update", pad(tgl.getDate(), 2) + "-" + pad(tgl.getMonth() + 1, 2) + "-" + tgl.getFullYear());
  $('input[name=mbr_address]').val(mbr_address);
  $('input[name=mbr_mobile]').val(mbr_mobile);
  $('input[name=mbr_email]').val(mbr_email);
  $('input[name=mbr_status]').val(mbr_status);
  $('input[name=mbr_id_number]').val(mbr_id_number);
  $('input[name=mbr_bank_name]').val(mbr_bank_name);
  $('input[name=mbr_bank_num]').val(mbr_bank_num);
  $('input[name=mbr_bank_acc]').val(mbr_bank_acc);
  $('input[name=mbr_kota]').val(mbr_kota);

  $.magnificPopup.open({
    items: {
      src: '#mdUpdateValidasiUpdateVerifiedMemberUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formUpdateValidasiUpdateVerifiedMemberUp').trigger('reset');
        $('#formUpdateValidasiUpdateVerifiedMemberUp').validate().resetForm();
        $('input').removeClass('error');
      }
    }
  });
}
$('#btnUpdateValidasiUpdateVerifiedMemberUp').click(function () {
  if ($("#formUpdateValidasiUpdateVerifiedMemberUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Validasi/Member/UpdateMemberVerified/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formUpdateValidasiUpdateVerifiedMemberUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblValidasiUpdateVerifiedMember').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Validasi -> Transaksi -> Flag Transaksi
function tblValidasiFlagTransaksi() {
  $('#tblValidasiFlagTransaksi').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    ordering: true,
    processing: true,
    searching: false,
    ajax: {
      url: base_url + "/Validasi/Transaksi/FlagTransaksi/get_datatable",
      type: "POST",
      data: {
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    columns: [
      { data: 'Action' },
      { data: 'Data Member' },
      { data: 'Kode Produk' },
      { data: 'Tanggal Transaksi' },
      { data: 'Tujuan' },
      { data: 'Harga' },
      { data: 'Status Transaksi' },
    ],
    // language: {
    //   zeroRecords: "data tidak ditemukan"
    // },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },
      }
    ]
  });
}
tblValidasiFlagTransaksi();
$('#btnValidasiFlagTransaksiSrc').click(function () {
  $('#tblValidasiFlagTransaksi').DataTable().destroy();
  tblValidasiFlagTransaksi();
});

function showValidasiFlagTransaksiBlock(destination) {
  $('input[name=destination]').val(destination);

  $.magnificPopup.open({
    items: {
      src: '#mdValidasiFlagTransaksiBlock',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formValidasiFlagTransaksiBlock').trigger('reset');
        $('#formValidasiFlagTransaksiBlock').validate().resetForm();
        $('input,select').removeClass('error');
      }
    }
  });
}
$('#btnValidasiFlagTransaksiBlock').click(function () {
  if ($("#formValidasiFlagTransaksiBlock").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/BlockDestination/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formValidasiFlagTransaksiBlock').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblMasterBlockDestionation').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Validasi -> Saldo -> Deposit Saldo
function tblValidasiTopupMax() {
  var tblValidasiTopupMax = $('#tblValidasiTopupMax').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Validasi/SaldoEklankuMax/TopupMax/get_datatable",
      type: "POST",
      data: {
        status: 'ValidasiTopupMax',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    drawCallback: function (settings) {
      var countTable = tblValidasiTopupMax.rows({ filter: 'applied' }).nodes().length;
      var no = 0;
      var api = this.api();
      var myData = api.rows().data();
      myData.each(function () {
        var fDate = new Date($('#cdtm' + no).text());
        fDate.setHours(fDate.getHours() + 4);
        var thisID = '#cdtm' + no;
        $('#cdtm' + no).countdown({
          until: fDate,
          padZeroes: true,
          onExpiry: function () {
            expiredTopup(thisID);
          }
        });
        expiredTopup('#cdtm' + no);
        no++;
      });
    },
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [4];
      var useRp = ['Rp '];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
tblValidasiTopupMax();
$('#btnValidasiTopupMaxSrc').click(function () {
  $('#tblValidasiTopupMax').DataTable().destroy();
  tblValidasiTopupMax();
});

function showValidasiTopupMax(deposit_id, mbr_code, mbr_name, deposit_amount, desc_deposit, deposit_bank, deposit_code, codeunix) {
  $('input[name=deposit_id]').val(deposit_id);
  $('input[name=mbr_code]').val(mbr_code);
  $('input[name=mbr_name]').val(mbr_name);
  $('select[name=deposit_bank]').val(deposit_bank);
  $('input[name=deposit_code]').val(deposit_code);
  $('input[name=deposit_amount]').val(deposit_amount.slice(0, -3));
  $('input[name=codeunix]').val(codeunix);
  $('textarea[name=desc_deposit]').val(desc_deposit);

  $.magnificPopup.open({
    items: {
      src: '#mdValidasiTopupMax',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formValidasiTopupMax').trigger('reset');
        $('#formValidasiTopupMax').validate().resetForm();
        $('input').removeClass('error');
      }
    }
  });
}
$('#formValidasiTopupMax').validate({
  rules: {
    'deposit_amount': {
      number: true,
    },
    'codeunix': {
      number: true,
    },
  },
});
$('#btnValidasiTopupMaxApprove').click(function () {
  if ($("#formValidasiTopupMax").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Validasi/SaldoEklankuMax/TopupMax/up_data_approve",
      method: 'POST',
      dataType: 'json',
      data: $('#formValidasiTopupMax').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblValidasiTopupMax').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('#btnValidasiTopupMaxReject').click(function () {
  if ($("#formValidasiTopupMax").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Validasi/SaldoEklankuMax/TopupMax/up_data_reject",
      method: 'POST',
      dataType: 'json',
      data: $('#formValidasiTopupMax').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblValidasiTopupMax').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Validasi -> Saldo -> Penarikan Max
function tblValidasiPenarikanMax() {
  var tblValidasiPenarikanMax = $('#tblValidasiPenarikanMax').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Validasi/SaldoEklankuMax/PenarikanMax/get_datatable",
      type: "POST",
      data: {
        status: 'ValidasiPenarikanMax',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    drawCallback: function (settings) {
      var countTable = tblValidasiPenarikanMax.rows({ filter: 'applied' }).nodes().length;
      var no = 0;
      var api = this.api();
      var myData = api.rows().data();
      myData.each(function () {
        var fDate = new Date($('#cdpm' + no).text());
        fDate.setDate(fDate.getDate() + 1); // +1 hari
        var thisID = '#cdpm' + no;
        $('#cdpm' + no).countdown({
          until: fDate,
          padZeroes: true,
          onExpiry: function () {
            expiredPenarikan(thisID);
          }
        });
        expiredPenarikan('#cdpm' + no);
        no++;
      });
    },
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [5];
      var useRp = ['Rp '];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
tblValidasiPenarikanMax();
$('#btnValidasiPenarikanMaxSrc').click(function () {
  $('#tblValidasiPenarikanMax').DataTable().destroy();
  tblValidasiPenarikanMax();
});
function showValidasiPenarikanMaxVerif(penarikan_id, mbr_code, mbr_name, penarikan_code, penarikan_amount) {
  $('input[name=penarikan_id]').val(penarikan_id);
  $('input[name=mbr_code]').val(mbr_code);
  $('input[name=mbr_name]').val(mbr_name);
  $('input[name=penarikan_code]').val(penarikan_code);
  $('input[name=penarikan_amount]').val(addCommas(penarikan_amount));

  $.magnificPopup.open({
    items: {
      src: '#mdValidasiPenarikanMaxVerif',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formValidasiPenarikanMaxVerif').trigger('reset');
        $('#formValidasiPenarikanMaxVerif').validate().resetForm();
        $('input').removeClass('error');
      }
    }
  });
}
$('#btnValidasiPenarikanMaxVerif').click(function () {
  if ($("#formValidasiPenarikanMaxVerif").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Validasi/SaldoEklankuMax/PenarikanMax/verifikasi_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formValidasiPenarikanMaxVerif').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblValidasiPenarikanMax').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('select[name=status_verif]').change(function () {
  if (this.value == 'Reject') {
    $('textarea[name=alasan_reject]').prop('disabled', false);
    $('input, textarea').removeClass('error');
  }
  else {
    $('textarea[name=alasan_reject]').prop('disabled', true);
    $('input, textarea').removeClass('error');
  }
});
function showValidasiPenarikanMaxValid(penarikan_id, mbr_code, mbr_name, penarikan_code, penarikan_amount, opr) {
  $('input[name=penarikan_id]').val(penarikan_id);
  $('input[name=mbr_code]').val(mbr_code);
  $('input[name=mbr_name]').val(mbr_name);
  $('input[name=penarikan_code]').val(penarikan_code);
  $('input[name=penarikan_amount]').val(addCommas(penarikan_amount));
  $('textarea[name=verif_desc]').val('Penarikan dana ini telah di verifikasi oleh : ' + opr);

  $.magnificPopup.open({
    items: {
      src: '#mdValidasiPenarikanMaxValid',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formValidasiPenarikanMaxValid').trigger('reset');
        $('#formValidasiPenarikanMaxValid').validate().resetForm();
        $('input').removeClass('error');
      }
    }
  });
}
$('#btnValidasiPenarikanMaxValid').click(function () {
  if ($("#formValidasiPenarikanMaxValid").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Validasi/SaldoEklankuMax/PenarikanMax/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formValidasiPenarikanMaxValid').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblValidasiPenarikanMax').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Validasi -> Saldo -> Transfer Saldo
function tblValidasiTransferSaldo() {
  $('#tblValidasiTransferSaldo').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Validasi/SaldoEklankuMax/TransferSaldo/get_datatable",
      type: "POST",
      data: {
        status: 'ValidasiTransferSaldo',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [3];
      var useRp = ['Rp '];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
tblValidasiTransferSaldo();
$('#btnValidasiTransferSaldoSrc').click(function () {
  $('#tblValidasiTransferSaldo').DataTable().destroy();
  tblValidasiTransferSaldo();
});
function showValidasiTransferSaldoBatal(deposit_id, mbr_code, mbr_name, deposit_amount, desc_deposit, deposit_bank, deposit_code, refferency_code) {
  $('input[name=deposit_id]').val(deposit_id);
  $('input[name=mbr_code]').val(mbr_code);
  $('input[name=mbr_name]').val(mbr_name);
  $('input[name=deposit_code]').val(deposit_code);
  $('input[name=deposit_bank]').val(deposit_bank);
  $('input[name=deposit_amount]').val(addCommas(deposit_amount));
  $('textarea[name=desc_deposit]').html(desc_deposit);
  $('input[name=refferency_code]').val(refferency_code);

  $.magnificPopup.open({
    items: {
      src: '#mdValidasiTransferSaldoBatal',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formValidasiTransferSaldoBatal').trigger('reset');
        $('#formValidasiTransferSaldoBatal').validate().resetForm();
        $('input, textarea').removeClass('error');
      }
    }
  });
}
$('#btnValidasiTransferSaldoBatal').click(function () {
  if ($("#formValidasiTransferSaldoBatal").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Validasi/SaldoEklankuMax/TransferSaldo/up_data_batal",
      method: 'POST',
      dataType: 'json',
      data: $('#formValidasiTransferSaldoBatal').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblValidasiTransferSaldo').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showValidasiTransferSaldoLanjut(deposit_id, mbr_code, mbr_name, deposit_amount, desc_deposit, deposit_bank, deposit_code, refferency_code) {
  $('input[name=deposit_id]').val(deposit_id);
  $('input[name=mbr_code]').val(mbr_code);
  $('input[name=mbr_name]').val(mbr_name);
  $('input[name=deposit_code]').val(deposit_code);
  $('input[name=deposit_bank]').val(deposit_bank);
  $('input[name=deposit_amount]').val(addCommas(deposit_amount));
  $('textarea[name=desc_deposit]').html(desc_deposit);
  $('input[name=refferency_code]').val(refferency_code);

  $.magnificPopup.open({
    items: {
      src: '#mdValidasiTransferSaldoLanjut',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formValidasiTransferSaldoLanjut').trigger('reset');
        $('#formValidasiTransferSaldoLanjut').validate().resetForm();
        $('input, textarea').removeClass('error');
      }
    }
  });
}
$('#btnValidasiTransferSaldoLanjut').click(function () {
  if ($("#formValidasiTransferSaldoLanjut").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Validasi/SaldoEklankuMax/TransferSaldo/up_data_lanjut",
      method: 'POST',
      dataType: 'json',
      data: $('#formValidasiTransferSaldoLanjut').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblValidasiTransferSaldo').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Validasi Data -> Pengajuan Kredit
function tblValidasiPengajuanKredit() {
  $('#tblValidasiPengajuanKredit').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Validasi/PengajuanKredit/get_datatable",
      type: "POST",
      data: {
        status: 'ValidasiPengajuanKredit',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblValidasiPengajuanKredit();
$('#btnValidasiPengajuanKreditSrc').click(function () {
  $('#tblValidasiPengajuanKredit').DataTable().destroy();
  tblValidasiPengajuanKredit();
});
function showValidasiPengajuanKredit(id_kredit, mbr_code, mbr_name, nama_barang, harga_barang, nilai_dp, kode_kredit, mbr_mobile, tipe_barang, merk_barang) {
  $('input[name=id_kredit]').val(id_kredit);
  $('input[name=mbr_code]').val(mbr_code);
  $('input[name=mbr_name]').val(mbr_name);
  $('input[name=nama_barang]').val('[' + merk_barang + '] ' + nama_barang);
  $('input[name=harga_barang]').val(addCommas(harga_barang));
  $('input[name=nilai_dp]').val(addCommas(nilai_dp));
  $('input[name=kode_kredit]').val(kode_kredit);
  $('input[name=mbr_mobile]').val(mbr_mobile);
  $('input[name=tipe_barang]').val(tipe_barang);

  $.magnificPopup.open({
    items: {
      src: '#mdValidasiPengajuanKredit',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formValidasiPengajuanKredit').trigger('reset');
        $('#formValidasiPengajuanKredit').validate().resetForm();
        $('input,textarea').removeClass('error');
      }
    }
  });
}
$('#btnValidasiPengajuanKreditReject').click(function () {
  var status_kredit = 'Pengajuan Ditolak';

  if ($("#formValidasiPengajuanKredit").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Validasi/PengajuanKredit/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formValidasiPengajuanKredit').serialize() + "&status_kredit=" + encodeURIComponent(status_kredit),
      success: function (data) {
        if (data.status) {
          $('#tblValidasiPengajuanKredit').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('#btnValidasiPengajuanKreditApprove').click(function () {
  var status_kredit = 'Tahap 2: Pengajuan Diterima';

  if ($("#formValidasiPengajuanKredit").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Validasi/PengajuanKredit/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formValidasiPengajuanKredit').serialize() + "&status_kredit=" + encodeURIComponent(status_kredit),
      success: function (data) {
        if (data.status) {
          $('#tblValidasiPengajuanKredit').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Validasi Data -> Aktivasi Bonus Transaksi
$('#bulan_aktivasi').datepicker({
  autoclose: true,
  minViewMode: 1,
  orientation: 'bottom left',
  format: 'yyyy-mm-dd'
});
$('#btnValidasiAktivasiBonusTransaksi').click(function () {
  if ($("#formValidasiAktivasiBonusTransaksi").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Validasi/AktivasiBonusTransaksi/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formValidasiAktivasiBonusTransaksi').serialize(),
      success: function (data) {
        if (data.status) {
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Transaksi -> Antrean Transaksi
function tblTransaksiAntreanTransaksi() {
  var tblTransaksiAntreanTransaksi = $('#tblTransaksiAntreanTransaksi').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Penjualan/Transaksi/AntreanTransaksi/get_datatable",
      type: "POST",
      data: {
        status: 'TransaksiAntreanTransaksi',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    drawCallback: function (settings) {
      var countTable = tblTransaksiAntreanTransaksi.rows({ filter: 'applied' }).nodes().length;
      var no = 0;
      var api = this.api();
      var myData = api.rows().data();
      myData.each(function () {
        var fDate = new Date($('#cdat' + no + '').text());
        $('#cdat' + no + '').countdown({
          since: fDate,
          padZeroes: true
        });
        if (((new Date() - fDate) / 1000 / 60) > 5) $('#cdat' + no + '').addClass('text-danger');
        no++;
      });
    }
  });
}
tblTransaksiAntreanTransaksi();
$('#btnTransaksiAntreanTransaksiSrc').click(function () {
  $('#tblTransaksiAntreanTransaksi').DataTable().destroy();
  tblTransaksiAntreanTransaksi();
});
function showTransaksiAntreanTransaksi(transaksi_id, mbr_code, mbr_name, product_kode, product_name, tujuan, harga_jual, supliyer_id, transaksi_code) {
  $('input[name=transaksi_id]').val(transaksi_id);
  $('input[name=vsn]').val(transaksi_id);
  $('input[name=transaksi_code]').val(transaksi_code);
  $('input[name=mbr_code]').val(mbr_code);
  $('input[name=mbr_name]').val(mbr_name);
  $('input[name=product_name]').val(product_name);
  $('input[name=product_kode]').val(product_kode);
  $('input[name=harga_jual]').val(harga_jual);
  $('select[name=pilih_supliyer_id]').val(supliyer_id);
  $('input[name=supliyer_id]').val(supliyer_id);
  $('input[name=tujuan]').val(tujuan);

  $.magnificPopup.open({
    items: {
      src: '#mdTransaksiAntreanTransaksi',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formTransaksiAntreanTransaksi').trigger('reset');
        $('#formTransaksiAntreanTransaksi').validate().resetForm();
        $('input, textarea').removeClass('error');
      }
    }
  });
}
$('#btnTransaksiAntreanTransaksi').click(function () {
  if ($("#formTransaksiAntreanTransaksi").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Penjualan/Transaksi/AntreanTransaksi/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formTransaksiAntreanTransaksi').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblTransaksiAntreanTransaksi').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('select[name=pilih_supliyer_id]').change(function () {
  var id = this.value;
  $('input[name=supliyer_id]').val(id);
});
/* Keterangan Status Transaksi Gagal */
if ($('select[name=transaksi_status]').val() == 'Gagal') {
  showBlockUI();
  $.ajax({
    url: base_url + "/Penjualan/Transaksi/AntreanTransaksi/get_supplier_id_original",
    method: 'POST',
    dataType: 'json',
    data: { transaksi_id: $('input[name=transaksi_id]').val() },
    success: function (data) {
      if (data.status) {
        $('select[name=pilih_supliyer_id]').val(data.message);
      }
      else {
        $.magnificPopup.close();
        swal("PROSES GAGAL", data.message, "error");
      }
      closeBlockUI();
    }
  });
  $('input[name=vsn]').prop('disabled', true);
  $('input[name=stsSukses]').val('no');

  $('select[name=pilih_supliyer_id]').prop('disabled', true);

  $('textarea[name=alasan_gagal]').prop('disabled', false);
  $('input[name=stsGagal]').val('yes');

  $('input[name=harga_supliyer]').prop('disabled', true);
  $('input, textarea').removeClass('error');
}
else if ($('select[name=transaksi_status]').val() == 'Sukses') {
  showBlockUI();
  $.ajax({
    url: base_url + "/Penjualan/Transaksi/AntreanTransaksi/get_supplier_id_original",
    method: 'POST',
    dataType: 'json',
    data: { transaksi_id: $('input[name=transaksi_id]').val() },
    success: function (data) {
      if (data.status) {
        $('select[name=pilih_supliyer_id]').val(data.message);
      }
      else {
        $.magnificPopup.close();
        swal("PROSES GAGAL", data.message, "error");
      }
      closeBlockUI();
    }
  });
  $('input[name=vsn]').prop('disabled', false);
  $('input[name=stsSukses]').val('yes');

  $('select[name=pilih_supliyer_id]').prop('disabled', true);

  $('textarea[name=alasan_gagal]').prop('disabled', true);
  $('input[name=stsGagal]').val('no');

  var supliyer_id = $('input[name=supliyer_id]').val()
  if (supliyer_id == 4 || supliyer_id == 6 || supliyer_id == 8 || supliyer_id == 12) {
    $('input[name=harga_supliyer]').prop('disabled', false);
  }
  else {
    $('input[name=harga_supliyer]').prop('disabled', true);
  }

  $('input, textarea').removeClass('error');
}
else if ($('select[name=transaksi_status]').val() == 'Resend') {
  $('input[name=vsn]').prop('disabled', true);
  $('input[name=stsSukses]').val('no');

  $('select[name=pilih_supliyer_id]').prop('disabled', false);

  $('textarea[name=alasan_gagal]').prop('disabled', true);
  $('input[name=stsGagal]').val('no');

  $('input[name=harga_supliyer]').prop('disabled', true);
  $('input, textarea').removeClass('error');
}
else {
  $('input[name=vsn]').prop('disabled', true);
  $('input[name=stsSukses]').val('no');

  $('select[name=pilih_supliyer_id]').prop('disabled', true);

  $('textarea[name=alasan_gagal]').prop('disabled', true);
  $('input[name=stsGagal]').val('no');

  $('input[name=harga_supliyer]').prop('disabled', true);
  $('input, textarea').removeClass('error');
}
$('select[name=transaksi_status]').change(function () {
  if (this.value == 'Gagal') {
    showBlockUI();
    $.ajax({
      url: base_url + "/Penjualan/Transaksi/AntreanTransaksi/get_supplier_id_original",
      method: 'POST',
      dataType: 'json',
      data: { transaksi_id: $('input[name=transaksi_id]').val() },
      success: function (data) {
        if (data.status) {
          $('select[name=pilih_supliyer_id]').val(data.message);
        }
        else {
          $.magnificPopup.close();
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
    $('input[name=vsn]').prop('disabled', true);
    $('input[name=stsSukses]').val('no');

    $('select[name=pilih_supliyer_id]').prop('disabled', true);

    $('textarea[name=alasan_gagal]').prop('disabled', false);
    $('input[name=stsGagal]').val('yes');

    $('input[name=harga_supliyer]').prop('disabled', true);
    $('input, textarea').removeClass('error');
  }
  else if (this.value == 'Sukses') {
    showBlockUI();
    $.ajax({
      url: base_url + "/Penjualan/Transaksi/AntreanTransaksi/get_supplier_id_original",
      method: 'POST',
      dataType: 'json',
      data: { transaksi_id: $('input[name=transaksi_id]').val() },
      success: function (data) {
        if (data.status) {
          $('select[name=pilih_supliyer_id]').val(data.message);
        }
        else {
          $.magnificPopup.close();
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
    $('input[name=vsn]').prop('disabled', false);
    $('input[name=stsSukses]').val('yes');

    $('select[name=pilih_supliyer_id]').prop('disabled', true);

    $('textarea[name=alasan_gagal]').prop('disabled', true);
    $('input[name=stsGagal]').val('no');

    var supliyer_id = $('input[name=supliyer_id]').val()
    if (supliyer_id == 4 || supliyer_id == 6 || supliyer_id == 8 || supliyer_id == 12) {
      $('input[name=harga_supliyer]').prop('disabled', false);
    }
    else {
      $('input[name=harga_supliyer]').prop('disabled', true);
    }

    $('input, textarea').removeClass('error');
  }
  else if ($('select[name=transaksi_status]').val() == 'Resend') {
    $('input[name=vsn]').prop('disabled', true);
    $('input[name=stsSukses]').val('no');

    $('select[name=pilih_supliyer_id]').prop('disabled', false);

    $('textarea[name=alasan_gagal]').prop('disabled', true);
    $('input[name=stsGagal]').val('no');

    $('input[name=harga_supliyer]').prop('disabled', true);
    $('input, textarea').removeClass('error');
  }
  else {
    $('input[name=vsn]').prop('disabled', true);
    $('input[name=stsSukses]').val('no');

    $('textarea[name=alasan_gagal]').prop('disabled', true);
    $('input[name=stsGagal]').val('no');

    $('input[name=harga_supliyer]').prop('disabled', true);
    $('input, textarea').removeClass('error');
  }
  // console.log(this.value);
});
// Transaksi -> Transaksi Inquiry
function tblTransaksiTransaksiInquiry() {
  var tblTransaksiTransaksiInquiry = $('#tblTransaksiTransaksiInquiry').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Penjualan/Transaksi/TransaksiInquiry/get_datatable",
      type: "POST",
      data: {
        status: 'TransaksiTransaksiInquiry',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    drawCallback: function (settings) {
      var countTable = tblTransaksiTransaksiInquiry.rows({ filter: 'applied' }).nodes().length;
      var no = 0;
      var api = this.api();
      var myData = api.rows().data();
      myData.each(function () {
        var fDate = new Date($('#cdti' + no + '').text());
        $('#cdti' + no + '').countdown({
          since: fDate,
          padZeroes: true
        });
        no++;
      });
    }
  });
}
tblTransaksiTransaksiInquiry();
$('#btnTransaksiTransaksiInquirySrc').click(function () {
  $('#tblTransaksiTransaksiInquiry').DataTable().destroy();
  tblTransaksiTransaksiInquiry();
});
// Transaksi -> Kelola Transaksi
function tblTransaksiKelolaTransaksi() {
  $('#tblTransaksiKelolaTransaksi').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Penjualan/Transaksi/KelolaTransaksi/get_datatable",
      type: "POST",
      data: {
        status: 'TransaksiKelolaTransaksi',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        stsSearch: $('select[name=search_status]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [4];
      var useRp = ['Rp '];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
tblTransaksiKelolaTransaksi();
$('#btnTransaksiKelolaTransaksiSrc').click(function () {
  $('#tblTransaksiKelolaTransaksi').DataTable().destroy();
  tblTransaksiKelolaTransaksi();
});
function showTransaksiKelolaTransaksi(transaksi_code, mbr_code, mbr_name, product_name, harga_jual, supliyer_name, tujuan, transaksi_id, tgl_trx) {
  $('input[name=transaksi_code]').val(transaksi_code);
  $('input[name=mbr_code]').val(mbr_code);
  $('input[name=mbr_name]').val(mbr_name);
  $('input[name=product_name]').val(product_name);
  $('input[name=harga_jual]').val(addCommas(harga_jual));
  $('input[name=supliyer_name]').val(supliyer_name);
  $('input[name=tujuan]').val(tujuan);
  $('input[name=transaksi_id]').val(transaksi_id);
  $('input[name=tgl_trx]').val(tgl_trx);

  $.magnificPopup.open({
    items: {
      src: '#mdTransaksiKelolaTransaksi',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formTransaksiKelolaTransaksi').trigger('reset');
        $('#formTransaksiKelolaTransaksi').validate().resetForm();
        $('input, textarea').removeClass('error');
      }
    }
  });
}
$('#btnTransaksiKelolaTransaksi').click(function () {
  if ($("#formTransaksiKelolaTransaksi").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Penjualan/Transaksi/KelolaTransaksi/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formTransaksiKelolaTransaksi').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblTransaksiKelolaTransaksi').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Penjualan -> Cek Total Transaksi
$('#btnPenjualanCekTotalTransaksiHitung').click(function () {
  if ($("#formPenjualanCekTotalTransaksi").validate().element("input[name=mbr_code]") && $("#formPenjualanCekTotalTransaksi").validate().element("input[name=mbr_name]") && $("#formPenjualanCekTotalTransaksi").validate().element("input[name=mbr_type]")) {
    showBlockUI();
    var mKarier = $('input[name=mbr_type]').val();
    var mKarierNow = '';
    $.ajax({
      url: base_url + "/Penjualan/CekTotalTransaksi/get_total",
      method: 'POST',
      dataType: 'json',
      data: $('#formPenjualanCekTotalTransaksi').serialize(),
      success: function (data) {
        if (data.status) {
          if (mKarier == 'FREE' && data.message >= 200) mKarierNow = '1-STAR';
          else if (mKarier == 'FREE' && data.message >= 1000) mKarierNow = '2-STAR';
          else if (mKarier == 'FREE' && data.message >= 5000) mKarierNow = '3-STAR';
          else if (mKarier == 'FREE' && data.message >= 25000) mKarierNow = '4-STAR';
          else if (mKarier == 'FREE' && data.message >= 125000) mKarierNow = '5-STAR';
          else if (mKarier == 'FREE' && data.message >= 625000) mKarierNow = '6-STAR';
          else if (mKarier == 'FREE' && data.message >= 1000000) mKarierNow = 'FC';
          else if (mKarier == '1-STAR' && data.message >= 1000) mKarierNow = '2-STAR';
          else if (mKarier == '2-STAR' && data.message >= 5000) mKarierNow = '3-STAR';
          else if (mKarier == '3-STAR' && data.message >= 25000) mKarierNow = '4-STAR';
          else if (mKarier == '4-STAR' && data.message >= 125000) mKarierNow = '5-STAR';
          else if (mKarier == '5-STAR' && data.message >= 625000) mKarierNow = '6-STAR';
          else if (mKarier == '6-STAR' && data.message >= 1000000) mKarierNow = 'FC';
          else mKarierNow = '';

          if (mKarierNow != '') $("#btnPenjualanCekTotalTransaksi").prop('disabled', false);
          else $("#btnPenjualanCekTotalTransaksi").prop('disabled', true);

          $('input[name=total_transaksi]').val(data.message);
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('#btnPenjualanCekTotalTransaksi').click(function () {
  if ($("#formPenjualanCekTotalTransaksi").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Penjualan/CekTotalTransaksi/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formPenjualanCekTotalTransaksi').serialize(),
      success: function (data) {
        if (data.status) {
          swal("PROSES BERHASIL", data.message, "success");
          $('#formPenjualanCekTotalTransaksi').trigger('reset');
          $('#formPenjualanCekTotalTransaksi').validate().resetForm();
          $('input').removeClass('error');
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Penjualan -> Cek Komplain
function tblPenjualanCekKomplain() {
  $('#tblPenjualanCekKomplainInbox').DataTable({
    bLengthChange: false,
    bPaginate: false,
    ordering: false,
    searching: false,
    processing: true,
    ajax: {
      url: base_url + "/Penjualan/CekKomplain/get_inbox",
      type: "POST",
      data: {
        dateSearchStart: $('input[name=search_start_cek]').val(),
        dateSearchEnd: $('input[name=search_end_cek]').val(),
        eklSearch: $('input[name=mbr_code]').val(),
        tujuanSearch: $('input[name=tujuan]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
  });
  $('#tblPenjualanCekKomplainKhusus').DataTable({
    bLengthChange: false,
    bPaginate: false,
    ordering: false,
    searching: false,
    processing: true,
    ajax: {
      url: base_url + "/Penjualan/CekKomplain/get_khusus",
      type: "POST",
      data: {
        dateSearchStart: $('input[name=search_start_cek]').val(),
        dateSearchEnd: $('input[name=search_end_cek]').val(),
        tujuanSearch: $('input[name=tujuan]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
  });
  $('#tblPenjualanCekKomplainOutbox').DataTable({
    bLengthChange: false,
    bPaginate: false,
    ordering: false,
    searching: false,
    processing: true,
    ajax: {
      url: base_url + "/Penjualan/CekKomplain/get_outbox",
      type: "POST",
      data: {
        dateSearchStart: $('input[name=search_start_cek]').val(),
        dateSearchEnd: $('input[name=search_end_cek]').val(),
        eklSearch: $('input[name=mbr_code]').val(),
        tujuanSearch: $('input[name=tujuan]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
  });
  $('#tblPenjualanCekKomplainTransaksi').DataTable({
    bLengthChange: false,
    bPaginate: false,
    ordering: false,
    searching: false,
    processing: true,
    ajax: {
      url: base_url + "/Penjualan/CekKomplain/get_transaksi",
      type: "POST",
      data: {
        dateSearchStart: $('input[name=search_start_cek]').val(),
        dateSearchEnd: $('input[name=search_end_cek]').val(),
        eklSearch: $('input[name=mbr_code]').val(),
        tujuanSearch: $('input[name=tujuan]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
  });
  $('#tblPenjualanCekKomplainMutasi').DataTable({
    bLengthChange: false,
    bPaginate: false,
    ordering: false,
    searching: false,
    processing: true,
    ajax: {
      url: base_url + "/Penjualan/CekKomplain/get_mutasi",
      type: "POST",
      data: {
        dateSearchStart: $('input[name=search_start_cek]').val(),
        dateSearchEnd: $('input[name=search_end_cek]').val(),
        eklSearch: $('input[name=mbr_code]').val(),
        tujuanSearch: $('input[name=tujuan]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
  });
}
$('#btnPenjualanCekKomplainSrc').click(function () {
  if ($("#formPenjualanCekKomplainSrc").valid()) {
    showBlockUI();
    $('#tblPenjualanCekKomplainInbox').DataTable().destroy();
    $('#tblPenjualanCekKomplainKhusus').DataTable().destroy();
    $('#tblPenjualanCekKomplainOutbox').DataTable().destroy();
    $('#tblPenjualanCekKomplainTransaksi').DataTable().destroy();
    $('#tblPenjualanCekKomplainMutasi').DataTable().destroy();
    tblPenjualanCekKomplain();
    closeBlockUI();
  }
});
// Pesan -> Notifikasi Email
function tblPesanNotifikasiEmail() {
  $('#tblPesanNotifikasiEmail').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Pesan/NotifikasiEmail/get_datatable",
      type: "POST",
      data: {
        status: 'PesanNotifikasiEmail',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblPesanNotifikasiEmail();
$('#btnPesanNotifikasiEmailSrc').click(function () {
  var startMonth = new Date(toDate($('input[name=search_start]').val())).getMonth();
  var endMonth = new Date(toDate($('input[name=search_end]').val())).getMonth();
  var startYear = new Date(toDate($('input[name=search_start]').val())).getFullYear();
  var endYear = new Date(toDate($('input[name=search_end]').val())).getFullYear();
  if (startMonth == endMonth && startYear == endYear) {
    $('#tblPesanNotifikasiEmail').DataTable().destroy();
    tblPesanNotifikasiEmail();
  }
  else swal("PROSES GAGAL", 'Pencarian harus pada bulan dan tahun yang sama!', "error");
  // $('#tblPesanNotifikasiEmail').DataTable().destroy();
  // tblPesanNotifikasiEmail();
});
function fnResendEmail(out_id, i) {
  showBlockUI();
  $.ajax({
    url: base_url + "/Pesan/NotifikasiEmail/doResend",
    method: 'POST',
    dataType: 'json',
    data: {
      out_id: out_id,
    },
    success: function (data) {
      if (data.status) {
        swal("PROSES BERHASIL", data.message, "success");
        fnCD(60, i);
      }
      else {
        swal("PROSES GAGAL", data.message, "error");
      }
      closeBlockUI();
    }
  });
}
// Pesan -> Notifikasi Sms
function tblPesanNotifikasiSms() {
  $('#tblPesanNotifikasiSms').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Pesan/NotifikasiSms/get_datatable",
      type: "POST",
      data: {
        status: 'PesanNotifikasiSms',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblPesanNotifikasiSms();
$('#btnPesanNotifikasiSmsSrc').click(function () {
  var startMonth = new Date(toDate($('input[name=search_start]').val())).getMonth();
  var endMonth = new Date(toDate($('input[name=search_end]').val())).getMonth();
  var startYear = new Date(toDate($('input[name=search_start]').val())).getFullYear();
  var endYear = new Date(toDate($('input[name=search_end]').val())).getFullYear();
  if (startMonth == endMonth && startYear == endYear) {
    $('#tblPesanNotifikasiSms').DataTable().destroy();
    tblPesanNotifikasiSms();
  }
  else swal("PROSES GAGAL", 'Pencarian harus pada bulan dan tahun yang sama!', "error");

  // var startMonth = new Date(toDate($('input[name=search_start]').val())).getMonth();
  // var endMonth = new Date(toDate($('input[name=search_end]').val())).getMonth();
  // var startYear = new Date(toDate($('input[name=search_start]').val())).getFullYear();
  // var endYear = new Date(toDate($('input[name=search_end]').val())).getFullYear();
  // var diff = endMonth - startMonth;
  // if (diff <= 1 && startYear == endYear) {
  // $('#tblPesanNotifikasiSms').DataTable().destroy();
  // tblPesanNotifikasiSms();
  // }
  // else swal("PROSES GAGAL", 'Pencarian harus pada bulan dan tahun yang sama!', "error");
});
function fnResendSms(out_subject, i, out_recipient, out_body) {
  showBlockUI();
  $.ajax({
    url: base_url + "/Pesan/NotifikasiSms/doResend",
    method: 'POST',
    dataType: 'json',
    data: {
      out_subject: out_subject,
      out_recipient: out_recipient,
      out_body: out_body
    },
    success: function (data) {
      if (data.status) {
        swal("PROSES BERHASIL", data.message, "success");
        fnCD(60, i);
      }
      else {
        swal("PROSES GAGAL", data.message, "error");
      }
      closeBlockUI();
    }
  });
}
// Pesan -> Antrean Sms
var tblPesanAntreanSms = $('#tblPesanAntreanSms').DataTable({
  lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
  processing: true,
  serverSide: true,
  ordering: false,
  searching: false,
  ajax: {
    url: base_url + "/Pesan/AntreanSms/get_datatable",
    type: "POST",
    data: {
      status: 'PesanAntreanSms',
    }
  },
  dom: 'Blfrtip',
  buttons: [
    {
      extend: 'excel',
      footer: true,
      text: '<span class="fas fa-file-excel"></span> Excel Export',
      exportOptions: {
        modifier: {
          search: 'applied',
          order: 'applied'
        }
      },

    }
  ],
  drawCallback: function (settings) {
    var countTable = tblPesanAntreanSms.rows({ filter: 'applied' }).nodes().length;
    var no = 0;
    var api = this.api();
    var myData = api.rows().data();
    myData.each(function () {
      var fDate = new Date($('#cdas' + no + '').text());
      $('#cdas' + no + '').countdown({
        since: fDate,
        padZeroes: true
      });
      no++;
    });
  }
});
// Laporan -> Bonus -> Bonus Member Active
function tblLaporanBonusActive() {
  $('#tblLaporanBonusActive').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/Bonus/BonusActive/get_datatable",
      type: "POST",
      data: {
        status: 'LaporanBonusActive',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [4];
      var useRp = ['Rp '];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
tblLaporanBonusActive();
$('#btnLaporanBonusActiveSrc').click(function () {
  $('#tblLaporanBonusActive').DataTable().destroy();
  tblLaporanBonusActive();
});
// Laporan -> Bonus -> Bonus Member Lock
function tblLaporanBonusLock() {
  $('#tblLaporanBonusLock').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/Bonus/BonusLock/get_datatable",
      type: "POST",
      data: {
        status: 'LaporanBonusLock',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [4];
      var useRp = ['Rp '];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
tblLaporanBonusLock();
$('#btnLaporanBonusLockSrc').click(function () {
  $('#tblLaporanBonusLock').DataTable().destroy();
  tblLaporanBonusLock();
});
$('#btnLaporanBonusTransaksiMember').click(function () {
  showBlockUI();
  if ($("#formLaporanBonusTransaksiMember").valid()) {
    $.ajax({
      url: base_url + "/Laporan/Bonus/BonusLock/get_transaksi_member",
      method: 'POST',
      dataType: 'json',
      data: $('#formLaporanBonusTransaksiMember').serialize(),
      success: function (data) {
        if (data.status) {
          swal({
            title: 'Transaksi ' + data.periode,
            type: 'info',
            html: data.message,
          })
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Laporan -> Bonus -> Bonus Member Pending
function tblLaporanBonusPending() {
  $('#tblLaporanBonusPending').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/Bonus/BonusPending/get_datatable",
      type: "POST",
      data: {
        status: 'LaporanBonusPending',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [2];
      var useRp = ['Rp '];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
tblLaporanBonusPending();
$('#btnLaporanBonusPendingSrc').click(function () {
  $('#tblLaporanBonusPending').DataTable().destroy();
  tblLaporanBonusPending();
});
// Laporan -> Bonus -> Transfer Bonus Menjadi Saldo
function tblLaporanTransferBonus() {
  $('#tblLaporanTransferBonus').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/Bonus/TransferBonus/get_datatable",
      type: "POST",
      data: {
        status: 'LaporanTransferBonus',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [2];
      var useRp = ['Rp '];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
tblLaporanTransferBonus();
$('#btnLaporanTransferBonusSrc').click(function () {
  $('#tblLaporanTransferBonus').DataTable().destroy();
  tblLaporanTransferBonus();
});
// Laporan -> Bonus -> Mutasi Bonus Transaksi
function tblLaporanMutasiBonus() {
  $('#tblLaporanMutasiBonus').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/Bonus/MutasiBonus/get_datatable",
      type: "POST",
      data: {
        status: 'LaporanMutasiBonus',
        trgSearch: 'mbr_code',
        txtSearchKey: $('input[name=mbr_code]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblLaporanMutasiBonus();
$('#btnLaporanMutasiBonusSrc').click(function () {
  if ($("#formLaporanMutasiBonus").valid()) {
    // var startMonth = new Date(toDate($('input[name=search_start]').val())).getMonth();
    // var endMonth = new Date(toDate($('input[name=search_end]').val())).getMonth();
    // var startYear = new Date(toDate($('input[name=search_start]').val())).getFullYear();
    // var endYear = new Date(toDate($('input[name=search_end]').val())).getFullYear();
    // if (startMonth == endMonth && startYear == endYear) {
    $('#tblLaporanMutasiBonus').DataTable().destroy();
    tblLaporanMutasiBonus();
    // }
    // else swal("PROSES GAGAL", 'Pencarian harus pada bulan dan tahun yang sama!', "error");
  }
});
var tblLaporanMutasiBonusDetail = $('#tblLaporanMutasiBonusDetail').DataTable({
  ordering: false,
  searching: false,
  bLengthChange: false,
  responsive: true,
  scrollY: '40vh',
  scrollCollapse: true,
  paging: false,
  sScrollX: "100%",
  scrollX: true,
  render: {
    "_": "plain",
    "filter": "filter",
    "display": "display"
  }
});
function showLaporanMutasiBonusDetail(id_reff, uang_date, mbr_code) {
  showBlockUI();
  $.ajax({
    url: base_url + "/Laporan/Bonus/MutasiBonus/get_datatable_detail",
    type: "POST",
    data: {
      id_reff: id_reff,
      uang_date: uang_date,
      mbr_code: mbr_code,
    },
    dataType: 'JSON',
    success: function (data) {
      tblLaporanMutasiBonusDetail.clear();
      tblLaporanMutasiBonusDetail.rows.add(data).draw();
      $.magnificPopup.open({
        items: {
          src: '#mdLaporanMutasiBonusDetail',
          type: 'inline',
        },
        mainClass: 'mfp-with-zoom',
        closeBtnInside: true,
        callbacks: {
          open: function () {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
          }
        }
      });
      closeBlockUI();
    }
  });
}
// Laporan -> Bonus -> Penarikan Dana
function tblLaporanPencairanDana() {
  $('#tblLaporanPencairanDana').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/Bonus/PencairanDana/get_datatable",
      type: "POST",
      data: {
        status: 'LaporanPencairanDana',
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        typeSearch: $('select[name=custom_type]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [3];
      var useRp = ['Rp '];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b.substr(0, b.indexOf('<br>Invoice')).split(': ').pop());
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
tblLaporanPencairanDana();
$('#btnLaporanPencairanDanaSrc').click(function () {
  // var startMonth = new Date(toDate($('input[name=search_start]').val())).getMonth();
  // var endMonth = new Date(toDate($('input[name=search_end]').val())).getMonth();
  // var startYear = new Date(toDate($('input[name=search_start]').val())).getFullYear();
  // var endYear = new Date(toDate($('input[name=search_end]').val())).getFullYear();
  // if (startMonth == endMonth && startYear == endYear) {
  $('#tblLaporanPencairanDana').DataTable().destroy();
  tblLaporanPencairanDana();
  // }
  // else swal("PROSES GAGAL", 'Pencarian harus pada bulan dan tahun yang sama!', "error");
});
// Laporan -> Refund Dana
function tblLaporanRefundDana() {
  $('#tblLaporanRefundDana').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/Refund/RefundDana/get_datatable",
      type: "POST",
      data: {
        status: 'LaporanRefundDana',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [3];
      var useRp = ['Rp '];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
tblLaporanRefundDana();
$('#btnLaporanRefundDanaSrc').click(function () {
  $('#tblLaporanRefundDana').DataTable().destroy();
  tblLaporanRefundDana();
});
// Laporan -> Refund Transaksi
function tblLaporanRefundTransaksi() {
  $('#tblLaporanRefundTransaksi').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/Refund/RefundTransaksi/get_datatable",
      type: "POST",
      data: {
        status: 'LaporanRefundTransaksi',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [2];
      var useRp = ['Rp '];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
tblLaporanRefundTransaksi();
$('#btnLaporanRefundTransaksiSrc').click(function () {
  $('#tblLaporanRefundTransaksi').DataTable().destroy();
  tblLaporanRefundTransaksi();
});

// Laporan -> Saldo -> Deposit Saldo
function tblLaporanDepositSaldo() {
  $('#tblLaporanDepositSaldo').DataTable({
    lengthMenu: [[10, 50, 200, 1000, -1], [10, 50, 200, 1000, 'all']],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/Saldo/DepositSaldo/get_datatable",
      type: "POST",
      data: {
        status: 'LaporanDepositSaldo',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
        typeSearch: $('select[name=deposit_code]').val(),
        stsSearch: $('select[name=search_status]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [2];
      var useRp = ['Rp '];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
tblLaporanDepositSaldo();
$('#btnLaporanDepositSaldoSrc').click(function () {
  $('#tblLaporanDepositSaldo').DataTable().destroy();
  tblLaporanDepositSaldo();
});
function showLaporanDepositSaldoUp(deposit_id, mbr_code, mbr_name, deposit_amount, desc_deposit, deposit_bank, deposit_code, codeunix) {
  $('input[name=deposit_id]').val(deposit_id);
  $('input[name=mbr_code]').val(mbr_code);
  $('input[name=mbr_name]').val(mbr_name);
  $('select[name=deposit_bank]').val(deposit_bank);
  $('input[name=deposit_code]').val(deposit_code);
  $('input[name=deposit_amount]').val(deposit_amount.slice(0, -3));
  $('input[name=codeunix]').val(codeunix);
  $('textarea[name=desc_deposit]').val(desc_deposit);

  $.magnificPopup.open({
    items: {
      src: '#mdLaporanDepositSaldoUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formLaporanDepositSaldoUp').trigger('reset');
        $('#formLaporanDepositSaldoUp').validate().resetForm();
        $('input, select').removeClass('error');
      }
    }
  });
}
$('#btnLaporanDepositSaldoUp').click(function () {
  if ($("#formLaporanDepositSaldoUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Laporan/Saldo/DepositSaldo/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formLaporanDepositSaldoUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblLaporanDepositSaldo').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Laporan -> Saldo -> Mutasi Saldo
function tblLaporanMutasiSaldo() {
  $('#tblLaporanMutasiSaldo').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/Saldo/MutasiSaldo/get_datatable",
      type: "POST",
      data: {
        status: 'LaporanMutasiSaldo',
        trgSearch: 'mbr_code',
        txtSearchKey: $('input[name=mbr_code]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblLaporanMutasiSaldo();
$('#btnLaporanMutasiSaldoSrc').click(function () {
  if ($("#formLaporanMutasiSaldo").valid()) {
    // var startMonth = new Date(toDate($('input[name=search_start]').val())).getMonth();
    // var endMonth = new Date(toDate($('input[name=search_end]').val())).getMonth();
    // var startYear = new Date(toDate($('input[name=search_start]').val())).getFullYear();
    // var endYear = new Date(toDate($('input[name=search_end]').val())).getFullYear();
    // if (startMonth == endMonth && startYear == endYear) {
    $('#tblLaporanMutasiSaldo').DataTable().destroy();
    tblLaporanMutasiSaldo();
    // }
    // else swal("PROSES GAGAL", 'Pencarian harus pada bulan dan tahun yang sama!', "error");
  }
});

// Laporan Arv -> Deposit -> Mutasi Saldo
function tblLaporanMutasiSaldoArv() {
  $('#tblLaporanMutasiSaldoArv').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/LaporanArv/Deposit/MutasiSaldo/get_datatable",
      type: "POST",
      data: {
        status: 'LaporanMutasiSaldoArv',
        trgSearch: 'arv_code',
        txtSearchKey: $('input[name=arv_code]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblLaporanMutasiSaldoArv();
$('#btnLaporanMutasiSaldoArvSrc').click(function () {
  if ($("#formLaporanMutasiSaldoArv").valid()) {
    // var startMonth = new Date(toDate($('input[name=search_start]').val())).getMonth();
    // var endMonth = new Date(toDate($('input[name=search_end]').val())).getMonth();
    // var startYear = new Date(toDate($('input[name=search_start]').val())).getFullYear();
    // var endYear = new Date(toDate($('input[name=search_end]').val())).getFullYear();
    // if (startMonth == endMonth && startYear == endYear) {
    $('#tblLaporanMutasiSaldoArv').DataTable().destroy();
    tblLaporanMutasiSaldoArv();
    // }
    // else swal("PROSES GAGAL", 'Pencarian harus pada bulan dan tahun yang sama!', "error");
  }
});
// Laporan -> Penjualan -> Penjualan Supplier
function tblLaporanPenjualanSupplier() {
  $('#tblLaporanPenjualanSupplier').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    ordering: false,
    processing: true,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/Penjualan/PenjualanSupplier/get_datatable",
      type: "POST",
      data: {
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    columns: [
      { data: 'Supplier' },
      { data: 'Jumlah Penjualan' },
      { data: 'Penjualan' },
      { data: 'Pembelian' },
      { data: 'Laba Kotor' },
    ],
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [1, 2, 3, 4];
      var useRp = ['', 'Rp ', 'Rp ', 'Rp '];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
tblLaporanPenjualanSupplier();
$('#btnLaporanPenjualanSupplierSrc').click(function () {
  $('#tblLaporanPenjualanSupplier').DataTable().destroy();
  tblLaporanPenjualanSupplier();
});

// Laporan -> Penjualan -> Transaksi Reseller
function tblLaporanTransaksiReseller() {
  $('#tblLaporanTransaksiReseller').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    // serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/Penjualan/TransaksiReseller/get_datatable",
      type: "POST",
      data: {
        status: 'LaporanTransaksiReseller',
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [1];
      var useRp = [''];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
$('#btnLaporanTransaksiResellerSrc').click(function () {
  var startMonth = new Date(toDate($('input[name=search_start]').val())).getMonth();
  var endMonth = new Date(toDate($('input[name=search_end]').val())).getMonth();
  var startYear = new Date(toDate($('input[name=search_start]').val())).getFullYear();
  var endYear = new Date(toDate($('input[name=search_end]').val())).getFullYear();
  if (startMonth == endMonth && startYear == endYear) {
    $('#tblLaporanTransaksiReseller').DataTable().destroy();
    tblLaporanTransaksiReseller();
  }
  else swal("PROSES GAGAL", 'Pencarian harus pada bulan dan tahun yang sama!', "error");
});
// Laporan -> Penjualan -> Transaksi Reguler
function tblLaporanTransaksiReguler() {
  $('#tblLaporanTransaksiReguler').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    // serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/Penjualan/TransaksiReguler/get_datatable",
      type: "POST",
      data: {
        status: 'LaporanTransaksiReguler',
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [1];
      var useRp = [''];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
$('#btnLaporanTransaksiRegulerSrc').click(function () {
  var startMonth = new Date(toDate($('input[name=search_start]').val())).getMonth();
  var endMonth = new Date(toDate($('input[name=search_end]').val())).getMonth();
  var startYear = new Date(toDate($('input[name=search_start]').val())).getFullYear();
  var endYear = new Date(toDate($('input[name=search_end]').val())).getFullYear();
  if (startMonth == endMonth && startYear == endYear) {
    $('#tblLaporanTransaksiReguler').DataTable().destroy();
    tblLaporanTransaksiReguler();
  }
  else swal("PROSES GAGAL", 'Pencarian harus pada bulan dan tahun yang sama!', "error");
});
// Laporan -> Penjualan -> Penjualan Produk
function tblLaporanPenjualanProduk() {
  $('#tblLaporanPenjualanProduk').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    ordering: true,
    processing: true,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/Penjualan/PenjualanProduk/get_datatable",
      type: "POST",
      data: {
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    columns: [
      { data: 'No' },
      { data: 'Nama Produk' },
      { data: 'Kode Produk' },
      { data: 'Supplier' },
      { data: 'Jumlah Penjualan' },
      { data: 'Penjualan' },
      { data: 'Pembelian' },
      { data: 'Laba Kotor' },
    ],
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [4, 5, 6, 7];
      var useRp = ['', 'Rp ', 'Rp ', 'Rp '];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
tblLaporanPenjualanProduk();
$('#btnLaporanPenjualanProdukSrc').click(function () {
  $('#tblLaporanPenjualanProduk').DataTable().destroy();
  tblLaporanPenjualanProduk();
});
// Laporan -> Penjualan -> Detail Transaksi
function tblLaporanDetailTransaksi() {
  $('#tblLaporanDetailTransaksi').DataTable({
    lengthMenu: [[10, 50, 200, 1000, -1], [10, 50, 200, 1000, 'All']],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/Penjualan/DetailTransaksi/get_datatable",
      type: "POST",
      data: {
        status: 'LaporanDetailTransaksi',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [4];
      var useRp = ['Rp '];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
tblLaporanDetailTransaksi();
$('#btnLaporanDetailTransaksiSrc').click(function () {
  if ($("#formLaporanDetailTransaksi").valid()) {
    $('#tblLaporanDetailTransaksi').DataTable().destroy();
    tblLaporanDetailTransaksi();
  }
});
// Laporan -> Penjualan -> Analisis Transaksi Member
function initMorrisAreaAnalisisMember() {
  morrisAreaAnalisisMember = new Morris.Area({
    element: 'mbr-v-trx',
    xkey: 'm',
    ykeys: ['b', 'a'],
    labels: ['Transaksi Group', 'Transaksi Pribadi'],
    lineColors: ['#00A760', '#FF3C19'],
    hideHover: 'auto',
    fillOpacity: 0.4,
    behaveLikeLine: true,
    resize: true
  });
}
$('#periode_analisis').datepicker({
  autoclose: true,
  viewMode: "years",
  minViewMode: "years",
  orientation: 'bottom left',
  format: 'yyyy'
});
$('select[name=tipe_periode_analisis]').change(function () {
  var chart_periode = $(this).find('option:selected').val();
  var new_options;
  var value;
  if (chart_periode == 'Hari') {
    new_options = {
      autoclose: true,
      // minViewMode: 1,
      orientation: 'bottom left',
      format: 'dd-mm-yyyy'
    }
    value = new Date().getMonth() + 1 + '-' + new Date().getFullYear();
  }
  else if (chart_periode == 'Bulan') {
    new_options = {
      autoclose: true,
      minViewMode: 1,
      orientation: 'bottom left',
      format: 'mm-yyyy'
    }
    value = new Date().getMonth() + 1 + '-' + new Date().getFullYear();
  }
  else {
    new_options = {
      autoclose: true,
      viewMode: "years",
      minViewMode: "years",
      orientation: 'bottom left',
      format: 'yyyy'
    }
    value = (new Date().getFullYear()).toString();
  }
  $('#periode_analisis').datepicker('destroy');
  $('#periode_analisis').datepicker(new_options);
  $('#periode_analisis').datepicker('setDates', value);
});
$('#btnPencarianDataMemberSrc').click(function () {
  if ($("#formPencarianDataMemberSrc").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Laporan/Penjualan/AnalisisTransaksiMember/get_header_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formPencarianDataMemberSrc').serialize(),
      success: function (data) {
        $('#jumlah_downline').html(data.jumlah_downline);
        $('#total_transaksi').html(data.total_transaksi);
        $('#transaksi_group').html(data.transaksi_group);
        $('#transaksi_pribadi').html(data.transaksi_pribadi);
        closeBlockUI();
      }
    });
  }
});
$('#btnPencarianDataMemberMorrisSrc').click(function () {
  if ($("#formPencarianDataMemberSrc").valid()) {
    showBlockUI();
    if ($('select[name=tipe_periode_analisis]').val() == 'Tahun') {
      $.ajax({
        url: base_url + "/Laporan/Penjualan/AnalisisTransaksiMember/get_morris",
        method: 'POST',
        dataType: 'json',
        data: $('#formPencarianDataMemberSrc').serialize(),
        success: function (data) {
          morrisAreaAnalisisMember.options.xLabelFormat = function (x) {
            return getMonthName(new Date(x).getMonth());
          };
          morrisAreaAnalisisMember.options.dateFormat = function (x) {
            return getMonthName(new Date(x).getMonth());
          };
          morrisAreaAnalisisMember.options.xkey = 'period';

          morrisAreaAnalisisMember.setData(data);
          closeBlockUI();
        }
      });
    }
    else if ($('select[name=tipe_periode_analisis]').val() == 'Bulan') {
      $.ajax({
        url: base_url + "/Laporan/Penjualan/AnalisisTransaksiMember/get_morris",
        method: 'POST',
        dataType: 'json',
        data: $('#formPencarianDataMemberSrc').serialize(),
        success: function (data) {
          morrisAreaAnalisisMember.options.xLabelFormat = function (x) {
            return new Date(x).getDate();
          },
            morrisAreaAnalisisMember.options.dateFormat = function (x) {
              return new Date(x).getDate() + ' ' + getMonthName(new Date(x).getMonth());
            };
          morrisAreaAnalisisMember.options.xkey = 'period';

          morrisAreaAnalisisMember.setData(data);
          closeBlockUI();
        }
      });
    }
    else if ($('select[name=tipe_periode_analisis]').val() == 'Hari') {
      $.ajax({
        url: base_url + "/Laporan/Penjualan/AnalisisTransaksiMember/get_morris",
        method: 'POST',
        dataType: 'json',
        data: $('#formPencarianDataMemberSrc').serialize(),
        success: function (data) {
          // morrisAreaAnalisisMember.options.xLabelFormat = function(x) {
          //     return x.getFullYear();
          // };
          // morrisAreaAnalisisMember.options.dateFormat = function(x) {
          //     return new Date(x).getFullYear();
          // };
          morrisAreaAnalisisMember.options.xkey = 'period';

          morrisAreaAnalisisMember.setData(data);
          closeBlockUI();
        }
      });
    }
  }
});
// Laporan -> Lain Lain -> Monitoring Database
function tblLaporanMonitoringDatabase238() {
  $('#tblLaporanMonitoringDatabase238').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    // serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/LainLain/MonitoringDatabase/get_datatable238",
      type: "POST",
      data: {
        status: 'MonitoringDatabase',
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
function tblLaporanMonitoringDatabase240() {
  $('#tblLaporanMonitoringDatabase240').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    // serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/LainLain/MonitoringDatabase/get_datatable240",
      type: "POST",
      data: {
        status: 'MonitoringDatabase',
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
function showMonitoringDatabase238Kill(pid) {
  swal({
    title: 'Silahkan masukkan KEY untuk melakukan STOP pada proses ini!',
    type: 'warning',
    text: pid,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Lanjutkan!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Laporan/LainLain/MonitoringDatabase/stop_proccess_238",
        method: 'POST',
        dataType: 'json',
        data: {
          pid: pid,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblLaporanMonitoringDatabase238').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
function showMonitoringDatabase240Kill(pid) {
  swal({
    title: 'Silahkan masukkan KEY untuk melakukan STOP pada proses ini!',
    type: 'warning',
    text: pid,
    input: 'password',
    inputPlaceholder: 'contoh: xxxxxx',
    confirmButtonColor: "#D2322D",
    confirmButtonText: "Lanjutkan!",
    cancelButtonText: "Batal",
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {
      showBlockUI();
      $.ajax({
        url: base_url + "/Laporan/LainLain/MonitoringDatabase/stop_proccess_240",
        method: 'POST',
        dataType: 'json',
        data: {
          pid: pid,
          key: result.value,
        },
        success: function (data) {
          if (data.status) {
            $('#tblLaporanMonitoringDatabase240').DataTable().ajax.reload();
            $.magnificPopup.close();
            swal("PROSES BERHASIL", data.message, "success");
          }
          else {
            swal("PROSES GAGAL", data.message, "error");
          }
          closeBlockUI();
        }
      });
    }
  });
}
// Laporan -> Lain Lain -> Donasi
function tblLaporanDonasi() {
  $('#tblLaporanDonasi').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/LainLain/Donasi/get_datatable",
      type: "POST",
      data: {
        status: 'LaporanDonasi',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
        stsSearch: $('select[name=search_status]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(), data;

      var colNum = [2];
      var useRp = ['Rp '];
      var i = 0;

      colNum.forEach(function (element) {
        page = api
          .column(element, { page: 'current' })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(element).footer()).html(
          useRp[i] + page.toLocaleString(undefined, { minimumFractionDigits: 0 })
        );
        i++;
      });
    }
  });
}
tblLaporanDonasi();
$('#btnLaporanDonasiSrc').click(function () {
  $('#tblLaporanDonasi').DataTable().destroy();
  tblLaporanDonasi();
});
// Laporan -> Lain Lain -> Analisis Internal
function initMorrisAnalisisInternal() {
  morrisAreaAnalisisInternal = new Morris.Area({
    element: 'morAnalisisInternal',
    xkey: 'm',
    ykeys: ['a'],
    labels: ['Keuntungan'],
    lineColors: ['#E91E63'],
    hideHover: 'auto',
    fillOpacity: 0.4,
    behaveLikeLine: true,
    resize: true
  });
}
$('#AnalisisInternalDatepicker').datepicker({
  autoclose: true,
  viewMode: "years",
  minViewMode: "years",
  orientation: 'bottom left',
  format: 'yyyy'
});
$('select[name=AnalisisInternalPeriode]').change(function () {
  var chart_periode = $(this).find('option:selected').val();
  var new_options;
  var value;
  if (chart_periode == 'Harian') {
    new_options = {
      autoclose: true,
      orientation: 'bottom left',
      format: 'dd-mm-yyyy'
    }
    value = new Date().getMonth() + 1 + '-' + new Date().getFullYear();
  }
  else {
    new_options = {
      autoclose: true,
      viewMode: "years",
      minViewMode: "years",
      orientation: 'bottom left',
      format: 'yyyy'
    }
    value = (new Date().getFullYear()).toString();
  }
  // console.log(value);
  $('#AnalisisInternalDatepicker').datepicker('destroy');
  $('#AnalisisInternalDatepicker').datepicker(new_options);
  $('#AnalisisInternalDatepicker').datepicker('setDates', value);
});
$('#btnLaporanAnalisisInternalMorrisUp').click(function () {
  $('#temp-text').hide();
  showBlockUI();
  if ($('select[name=AnalisisInternalPeriode]').val() == 'Bulanan') {
    $.ajax({
      url: base_url + "/Laporan/LainLain/AnalisisInternal/get_morris",
      method: 'POST',
      dataType: 'json',
      data: $('#formLaporanAnalisisInternalMorrisUp').serialize(),
      success: function (data) {
        morrisAreaAnalisisInternal.options.xLabelFormat = function (x) {
          return getMonthName(new Date(x).getMonth());
        };
        morrisAreaAnalisisInternal.options.dateFormat = function (x) {
          return getMonthName(new Date(x).getMonth());
        };
        morrisAreaAnalisisInternal.options.xkey = 'period';

        morrisAreaAnalisisInternal.setData(data);
        closeBlockUI();
      }
    });
  }
  else if ($('select[name=AnalisisInternalPeriode]').val() == 'Harian') {
    $.ajax({
      url: base_url + "/Laporan/LainLain/AnalisisInternal/get_morris",
      method: 'POST',
      dataType: 'json',
      data: $('#formLaporanAnalisisInternalMorrisUp').serialize(),
      success: function (data) {
        morrisAreaAnalisisInternal.options.xLabelFormat = function (x) {
          return new Date(x).getDate();
        },
          morrisAreaAnalisisInternal.options.dateFormat = function (x) {
            return new Date(x).getDate() + ' ' + getMonthName(new Date(x).getMonth());
          };
        morrisAreaAnalisisInternal.options.xkey = 'period';

        morrisAreaAnalisisInternal.setData(data);
        closeBlockUI();
      }
    });
  }
  else if ($('select[name=AnalisisInternalPeriode]').val() == 'Tahunan') {
    $.ajax({
      url: base_url + "/Laporan/LainLain/AnalisisInternal/get_morris",
      method: 'POST',
      dataType: 'json',
      data: $('#formLaporanAnalisisInternalMorrisUp').serialize(),
      success: function (data) {
        morrisAreaAnalisisInternal.options.xLabelFormat = function (x) {
          return x.getFullYear();
        };
        morrisAreaAnalisisInternal.options.dateFormat = function (x) {
          return new Date(x).getFullYear();
        };
        morrisAreaAnalisisInternal.options.xkey = 'period';

        morrisAreaAnalisisInternal.setData(data);
        closeBlockUI();
      }
    });
  }
});
// Laporan -> Seminar -> Transaksi
function tblLaporanSeminarTransaksi() {
  $('#tblLaporanSeminarTransaksi').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/Seminar/TransaksiSeminar/get_datatable",
      type: "POST",
      data: {
        status: 'LaporanSeminarTransaksi',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
        stsSearch: $('select[name=search_status]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
$('#btnLaporanSeminarTransaksiSrc').click(function () {
  $('#tblLaporanSeminarTransaksi').DataTable().destroy();
  tblLaporanSeminarTransaksi();
});
// Laporan -> Seminar -> Tiket
function tblLaporanSeminarTiket() {
  $('#tblLaporanSeminarTiket').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Laporan/Seminar/TiketSeminar/get_datatable",
      type: "POST",
      data: {
        status: 'LaporanSeminarTiket',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
        stsSearch: $('select[name=search_status]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
$('#btnLaporanSeminarTiketSrc').click(function () {
  $('#tblLaporanSeminarTiket').DataTable().destroy();
  tblLaporanSeminarTiket();
});
// Content Web -> Event
function tblContentEvent() {
  $('#tblContentEvent').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Content/Event/get_datatable",
      type: "POST",
      data: {
        status: 'ContentEvent',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        typeSearch: $('select[name=custom_type]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
  });
}
tblContentEvent();
$('#btnContentEventSrc').click(function () {
  $('#tblContentEvent').DataTable().destroy();
  tblContentEvent();
});
function showUpdateEvent(id_event, name_event, start_date_event, date_show_event, time_show_event, place_event, type_event, organizer_event, pic_event, phone_pic_event, status_event) {
  $('input[name=id_event]').val(id_event);
  $('input[name=name_event]').val(name_event);
  var tgl = new Date(start_date_event);
  $('input[name=start_date_event]').datepicker("update", pad(tgl.getDate(), 2) + "-" + pad(tgl.getMonth() + 1, 2) + "-" + tgl.getFullYear());
  $('input[name=date_show_event]').val(date_show_event);
  $('input[name=time_show_event]').val(time_show_event);
  $('input[name=place_event]').val(place_event);
  $('select[name=type_event]').val(type_event);
  $('select[name=organizer_event]').val(organizer_event);
  $('input[name=pic_event]').val(pic_event);
  $('input[name=phone_pic_event]').val(phone_pic_event);
  $('select[name=status_event]').val(status_event);

  $.magnificPopup.open({
    items: {
      src: '#mdContentEventUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formContentEventUp').trigger('reset');
        $('#formContentEventUp').validate().resetForm();
        $('input, select').removeClass('error');
      }
    }
  });
}
$('#formContentEventUp').validate({
  rules: {
    'phone_pic_event': {
      number: true,
      maxlength: 13
    }
  }
});
$('#btnContentEventUp').click(function () {
  if ($("#formContentEventUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Content/Event/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formContentEventUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblContentEvent').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal({
            title: 'PROSES GAGAL',
            type: 'error',
            html: data.message,
          })
          // swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showBannerEvent(banner_event) {
  $.magnificPopup.open({
    items: {
      src: base_url + "/assets/imgMAX/pic_event/" + banner_event,
    },
    type: 'image',
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true
  });
}
function fnBannerEvent(id_event) {
  $('input[name=id_event]').val(id_event);
}
$(document).on('change', '#EventBannerUp', function (e) {
  var cropper;
  var files = e.target.files;
  var done = function (url) {
    document.getElementById('EventBannerUp').value = '';
    document.getElementById('imageEventBannerUp').src = url;
    $.magnificPopup.open({
      items: {
        src: '#mdContentEventBannerUp',
        type: 'inline',
      },
      mainClass: 'mfp-with-zoom',
      closeBtnInside: true,
      callbacks: {
        open: function () {
          cropper = new Cropper(document.getElementById('imageEventBannerUp'), {
            aspectRatio: 1,
            viewMode: 3,
          });
        },
        close: function () {
          cropper.destroy();
          cropper = null;
        }
      }
    });
  };
  var reader;
  var file;
  var url;

  if (files && files.length > 0) {
    file = files[0];

    if (URL) {
      done(URL.createObjectURL(file));
    } else if (FileReader) {
      reader = new FileReader();
      reader.onload = function (e) {
        done(reader.result);
      };
      reader.readAsDataURL(file);
    }
  }
  document.getElementById('btnContentEventBannerUp').addEventListener('click', function () {
    showBlockUI();

    var initialAvatarURL;
    var canvas;

    // console.log(cropper);

    if (cropper) {
      canvas = cropper.getCroppedCanvas({
        width: 350,
        height: 350,
      });

      canvas.toBlob(function (blob) {
        var formData = new FormData();

        formData.append('banner_event', blob);
        formData.append('id_event', $('input[name=id_event]').val());

        $.ajax({
          url: base_url + "/Content/Event/up_banner",
          type: "POST",
          data: formData,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function (data) {
            if (data.status) {
              $('#tblContentEvent').DataTable().ajax.reload();
              $.magnificPopup.close();
              swal("PROSES BERHASIL", data.message, "success");
            }
            else {
              swal("PROSES GAGAL", data.message, "error");
              $.magnificPopup.close();
            }
            closeBlockUI();
          }
        }, "image/jpeg", 0.75);
      });
    }
  });
});
$('#btnContentEventAdd').click(function () {
  if ($("#formContentEventAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Content/Event/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formContentEventAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblContentEvent').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('#formContentEventAdd').validate({
  rules: {
    'phone_pic_event': {
      number: true,
      maxlength: 13
    },
  }
});
// Content Web -> Promo
function tblContentPromo() {
  $('#tblContentPromo').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Content/Promo/get_datatable",
      type: "POST",
      data: {
        status: 'ContentPromo',
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        typeSearch: $('select[name=custom_type]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
  });
}
tblContentPromo();
$('#btnContentPromoSrc').click(function () {
  $('#tblContentPromo').DataTable().destroy();
  tblContentPromo();
});
function showUpdatePromo(id_promo, name_promo, start_promo, end_promo, status_promo, url_promo) {
  $('input[name=id_promo]').val(id_promo);
  $('input[name=name_promo]').val(name_promo);
  var tgl = new Date(start_promo);
  $('input[name=start_promo]').datepicker("update", pad(tgl.getDate(), 2) + "-" + pad(tgl.getMonth() + 1, 2) + "-" + tgl.getFullYear());
  var tgl = new Date(end_promo);
  $('input[name=end_promo]').datepicker("update", pad(tgl.getDate(), 2) + "-" + pad(tgl.getMonth() + 1, 2) + "-" + tgl.getFullYear());
  $('input[name=url_promo]').val(url_promo);
  $('select[name=status_promo]').val(status_promo);

  $.magnificPopup.open({
    items: {
      src: '#mdContentPromoUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formContentPromoUp').trigger('reset');
        $('#formContentPromoUp').validate().resetForm();
        $('input, select').removeClass('error');
      }
    }
  });
}
$('#btnContentPromoAdd').click(function () {
  if ($("#formContentPromoAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Content/Promo/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formContentPromoAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblContentPromo').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
})
$('#btnContentPromoUp').click(function () {
  if ($("#formContentPromoUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Content/Promo/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formContentPromoUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblContentPromo').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
})
function fnBannerPromo(id_promo) {
  $('input[name=id_promo]').val(id_promo);
}
$(document).on('change', '#PromoBannerMiniUp', function (e) {
  var cropper;
  var files = e.target.files;
  var done = function (url) {
    document.getElementById('PromoBannerMiniUp').value = '';
    document.getElementById('imageBannerMiniUp').src = url;
    $.magnificPopup.open({
      items: {
        src: '#mdContentPromoBannerMiniUp',
        type: 'inline',
      },
      mainClass: 'mfp-with-zoom',
      closeBtnInside: true,
      callbacks: {
        open: function () {
          cropper = new Cropper(document.getElementById('imageBannerMiniUp'), {
            aspectRatio: 1,
            viewMode: 3,
          });
        },
        close: function () {
          cropper.destroy();
          cropper = null;
        }
      }
    });
  };
  var reader;
  var file;
  var url;

  if (files && files.length > 0) {
    file = files[0];

    if (URL) {
      done(URL.createObjectURL(file));
    } else if (FileReader) {
      reader = new FileReader();
      reader.onload = function (e) {
        done(reader.result);
      };
      reader.readAsDataURL(file);
    }
  }
  document.getElementById('btnContentPromoBannerMiniUp').addEventListener('click', function () {
    showBlockUI();

    var initialAvatarURL;
    var canvas;

    // console.log(cropper);

    if (cropper) {
      canvas = cropper.getCroppedCanvas({
        width: 350,
        height: 350,
      });

      canvas.toBlob(function (blob) {
        var formData = new FormData();

        formData.append('croppedImg', blob);
        formData.append('id_promo', $('input[name=id_promo]').val());

        $.ajax({
          url: base_url + "/Content/Promo/banner_mini",
          type: "POST",
          data: formData,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function (data) {
            if (data.status) {
              $('#tblContentPromo').DataTable().ajax.reload();
              $.magnificPopup.close();
              swal("PROSES BERHASIL", data.message, "success");
            }
            else {
              swal("PROSES GAGAL", data.message, "error");
              $.magnificPopup.close();
            }
            closeBlockUI();
          }
        }, "image/jpeg", 0.75);
      });
    }
  });
});
$(document).on('change', '#PromoBannerWideUp', function (e) {
  var cropper;
  var files = e.target.files;
  var done = function (url) {
    document.getElementById('PromoBannerWideUp').value = '';
    document.getElementById('imageBannerWideUp').src = url;
    $.magnificPopup.open({
      items: {
        src: '#mdContentPromoBannerWideUp',
        type: 'inline',
      },
      mainClass: 'mfp-with-zoom',
      closeBtnInside: true,
      callbacks: {
        open: function () {
          cropper = new Cropper(document.getElementById('imageBannerWideUp'), {
            aspectRatio: 3.8 / 1,
            viewMode: 3,
          });
        },
        close: function () {
          cropper.destroy();
          cropper = null;
        }
      }
    });
  };
  var reader;
  var file;
  var url;

  if (files && files.length > 0) {
    file = files[0];

    if (URL) {
      done(URL.createObjectURL(file));
    } else if (FileReader) {
      reader = new FileReader();
      reader.onload = function (e) {
        done(reader.result);
      };
      reader.readAsDataURL(file);
    }
  }
  document.getElementById('btnContentPromoBannerWideUp').addEventListener('click', function () {
    showBlockUI();

    var initialAvatarURL;
    var canvas;

    // console.log(cropper);

    if (cropper) {
      canvas = cropper.getCroppedCanvas({
        width: 1900,
        height: 500,
      });

      canvas.toBlob(function (blob) {
        var formData = new FormData();

        formData.append('croppedImg', blob);
        formData.append('id_promo', $('input[name=id_promo]').val());

        $.ajax({
          url: base_url + "/Content/Promo/banner_wide",
          type: "POST",
          data: formData,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function (data) {
            if (data.status) {
              $('#tblContentPromo').DataTable().ajax.reload();
              $.magnificPopup.close();
              swal("PROSES BERHASIL", data.message, "success");
            }
            else {
              swal("PROSES GAGAL", data.message, "error");
              $.magnificPopup.close();
            }
            closeBlockUI();
          }
        }, "image/jpeg", 0.75);
      });
    }
  });
});
// Content Web -> Banner
function tblContentBanner() {
  $('#tblContentBanner').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Content/Banner/get_datatable",
      type: "POST",
      data: {
        status: 'ContentBanner',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        typeSearch: $('select[name=custom_type]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
  });
}
$('#btnContentBannerSrc').click(function () {
  $('#tblContentBanner').DataTable().destroy();
  tblContentBanner();
});
$('#btnContentBannerAdd').click(function () {
  if ($("#formContentBannerAdd").valid()) {
    var formData = new FormData($('#formContentBannerAdd')[0]);

    showBlockUI();
    $.ajax({
      url: base_url + "/Content/Banner/add_data",
      method: 'POST',
      dataType: 'json',
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      async: false,
      success: function (data) {
        if (data.status) {
          $('#tblContentBanner').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showContentBannerUp(id_banner, name_banner, status_banner, link_banner, group_banner) {
  $('input[name=id_banner]').val(id_banner);
  $('input[name=name_banner]').val(name_banner);
  $('input[name=link_banner]').val(link_banner);
  $('select[name=status_banner]').val(status_banner);
  $('select[name=group_banner]').val(group_banner);

  $.magnificPopup.open({
    items: {
      src: '#mdContentBannerUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formContentBannerUp').trigger('reset');
        $('#formContentBannerUp').validate().resetForm();
        $('input, select').removeClass('error');
      }
    }
  });
}
$('#btnContentBannerUp').click(function () {
  if ($("#formContentBannerUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Content/Banner/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formContentBannerUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblContentBanner').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function fnContentBannerImage(id_banner) {
  $('input[name=id_banner]').val(id_banner);

  $.magnificPopup.open({
    items: {
      src: '#mdContentBannerImage',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formContentBannerImage').trigger('reset');
        $('#formContentBannerImage').validate().resetForm();
        $('input').removeClass('error');
      }
    }
  });
}
$('#btnContentBannerImage').click(function () {
  if ($("#formContentBannerImage").valid()) {

    var formData = new FormData($('#formContentBannerImage')[0]);

    showBlockUI();
    $.ajax({
      url: base_url + "/Content/Banner/up_banner",
      method: 'POST',
      dataType: 'json',
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      async: false,
      success: function (data) {
        if (data.status) {
          $('#tblContentBanner').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});

// Content Web -> Informasi Eklanku
function tblContentInformasiEklanku() {
  $('#tblContentInformasiEklanku').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Content/InformasiEklanku/get_datatable",
      type: "POST",
      data: {
        status: 'ContentInformasiEklanku',
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        typeSearch: $('select[name=custom_type]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
  });
}
$('#btnContentInformasiEklankuSrc').click(function () {
  $('#tblContentInformasiEklanku').DataTable().destroy();
  tblContentInformasiEklanku();
});
$('#btnContentInformasiEklankuAdd').click(function () {
  if ($("#formContentInformasiEklankuAdd").valid()) {
    var formData = new FormData($('#formContentInformasiEklankuAdd')[0]);

    showBlockUI();
    $.ajax({
      url: base_url + "/Content/InformasiEklanku/add_data",
      method: 'POST',
      dataType: 'json',
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      async: false,
      success: function (data) {
        if (data.status) {
          $('#tblContentInformasiEklanku').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showContentBeritaEklankuUp(berita_id, berita_date, berita_status, berita_isi, berita_judul, berita_autor, berita_kode, berita_bahasa) {
  $('input[name=berita_id]').val(berita_id);
  $('input[name=berita_date]').val(berita_date);
  $('select[name=berita_status]').val(berita_status);
  $('textarea[name=berita_isi]').html(berita_isi);
  $('input[name=berita_judul]').val(berita_judul);
  $('select[name=berita_autor]').val(berita_autor);
  $('input[name=berita_kode]').val(berita_kode);
  $('select[name=berita_bahasa]').val(berita_bahasa);

  $.magnificPopup.open({
    items: {
      src: '#mdContentInformasiEklankuUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formContentInformasiEklankuUp').trigger('reset');
        $('#formContentInformasiEklankuUp').validate().resetForm();
        $('input, select, textarea').removeClass('error');
      }
    }
  });
}
$('#btnContentInformasiEklankuUp').click(function () {
  if ($("#formContentInformasiEklankuUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Content/InformasiEklanku/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formContentInformasiEklankuUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblContentInformasiEklanku').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function fnContentInformasiEklanku(berita_id) {
  $('input[name=berita_id]').val(berita_id);

  $.magnificPopup.open({
    items: {
      src: '#mdContentInformasiEklankuImage',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formContentInformasiEklankuImage').trigger('reset');
        $('#formContentInformasiEklankuImage').validate().resetForm();
        $('input,select').removeClass('error');
      }
    }
  });
}
$('#btnContentInformasiEklankuImage').click(function () {
  if ($("#formContentInformasiEklankuImage").valid()) {

    var formData = new FormData($('#formContentInformasiEklankuImage')[0]);

    showBlockUI();
    $.ajax({
      url: base_url + "/Content/InformasiEklanku/up_image",
      method: 'POST',
      dataType: 'json',
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      async: false,
      success: function (data) {
        if (data.status) {
          $('#tblContentInformasiEklanku').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('#btnContentInformasiEklankuClfAdd').click(function () {
  if ($("#formContentInformasiEklankuClfAdd").valid()) {
    var formData = new FormData($('#formContentInformasiEklankuClfAdd')[0]);

    showBlockUI();
    $.ajax({
      url: base_url + "/Content/InformasiEklanku/add_data_clf",
      method: 'POST',
      dataType: 'json',
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      async: false,
      success: function (data) {
        if (data.status) {
          $('#tblContentInformasiEklanku').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showContentBeritaEklankuClfUp(berita_id, berita_date, berita_status, berita_isi, berita_judul, berita_autor, berita_kode, berita_bahasa) {
  $('input[name=berita_id]').val(berita_id);
  var tgl = new Date(berita_date);
  $('input[name=berita_date]').datepicker("update", pad(tgl.getDate(), 2) + "-" + pad(tgl.getMonth() + 1, 2) + "-" + tgl.getFullYear());
  $('select[name=berita_status]').val(berita_status);
  $('input[name=berita_judul]').val(berita_judul);

  $.magnificPopup.open({
    items: {
      src: '#mdContentInformasiEklankuClfUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        // $('#formContentInformasiEklankuClfUp').trigger('reset');
        // $('#formContentInformasiEklankuClfUp').validate().resetForm();
        // $('input, select, textarea').removeClass('error');
      }
    }
  });
  $('textarea[name="berita_isi"]').summernote('code', berita_isi);
}
$('#btnContentInformasiEklankuClfUp').click(function () {
  if ($("#formContentInformasiEklankuClfUp").valid()) {
    var formData = new FormData($('#formContentInformasiEklankuClfUp')[0]);

    showBlockUI();
    $.ajax({
      url: base_url + "/Content/InformasiEklanku/up_data_clf",
      method: 'POST',
      dataType: 'json',
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      async: false,
      success: function (data) {
        if (data.status) {
          $('#tblContentInformasiEklanku').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('#btnContentInformasiEklankuGowistAdd').click(function () {
  if ($("#formContentInformasiEklankuGowistAdd").valid()) {
    var formData = new FormData($('#formContentInformasiEklankuGowistAdd')[0]);

    showBlockUI();
    $.ajax({
      url: base_url + "/Content/InformasiEklanku/add_data_gowist",
      method: 'POST',
      dataType: 'json',
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      async: false,
      success: function (data) {
        if (data.status) {
          $('#tblContentInformasiEklanku').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showContentBeritaEklankuGowistUp(berita_id, berita_date, berita_status, berita_tags, berita_isi, berita_judul, berita_autor, berita_kode, berita_bahasa) {
  $('input[name=berita_id]').val(berita_id);
  var tgl = new Date(berita_date);
  $('input[name=berita_date]').datepicker("update", pad(tgl.getDate(), 2) + "-" + pad(tgl.getMonth() + 1, 2) + "-" + tgl.getFullYear());
  $('select[name=berita_status]').val(berita_status);
  $('select[name=berita_tags]').val(berita_tags);
  $('input[name=berita_judul]').val(berita_judul);

  $.magnificPopup.open({
    items: {
      src: '#mdContentInformasiEklankuGowistUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
      }
    }
  });
  $('textarea[name="berita_isi"]').summernote('code', berita_isi);
}
$('#btnContentInformasiEklankuGowistUp').click(function () {
  if ($("#formContentInformasiEklankuGowistUp").valid()) {
    var formData = new FormData($('#formContentInformasiEklankuGowistUp')[0]);

    showBlockUI();
    $.ajax({
      url: base_url + "/Content/InformasiEklanku/up_data_gowist",
      method: 'POST',
      dataType: 'json',
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      async: false,
      success: function (data) {
        if (data.status) {
          $('#tblContentInformasiEklanku').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Content Web -> Informasi Internal
function tblContentInformasiInternal() {
  $('#tblContentInformasiInternal').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Content/InformasiInternal/get_datatable",
      type: "POST",
      data: {
        status: 'ContentInformasiInternal',
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        typeSearch: $('select[name=custom_type]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
  });
}
$('#btnContentInformasiInternalSrc').click(function () {
  $('#tblContentInformasiInternal').DataTable().destroy();
  tblContentInformasiInternal();
});
$('#btnContentInformasiInternalAdd').click(function () {
  if ($("#formContentInformasiInternalAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Content/InformasiInternal/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formContentInformasiInternalAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblContentInformasiInternal').DataTable().ajax.reload();
          $.magnificPopup.close();
          formReset('formContentInformasiInternalAdd');
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showContentInformasiInternalUp(id_notif, status_notif, content_notif, title_notif, url_notif) {
  content_notif = content_notif.replace(/<br>/g, "\r\n");
  $('input[name=id_notif]').val(id_notif);
  $('select[name=status_notif]').val(status_notif);
  $('textarea[name=content_notif]').val(content_notif);
  $('input[name=title_notif]').val(title_notif);
  $('input[name=url_notif]').val(url_notif);

  $.magnificPopup.open({
    items: {
      src: '#mdContentInformasiInternalUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formContentInformasiInternalUp').trigger('reset');
        $('#formContentInformasiInternalUp').validate().resetForm();
        $('input, select, textarea').removeClass('error');
      }
    }
  });
}
$('#btnContentInformasiInternalUp').click(function () {
  if ($("#formContentInformasiInternalUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Content/InformasiInternal/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formContentInformasiInternalUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblContentInformasiInternal').DataTable().ajax.reload();
          $.magnificPopup.close();
          formReset('formContentInformasiInternalUp');
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Content Web -> My Eklanku
function tblContentMyEklanku() {
  $('#tblContentMyEklanku').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Content/MyEklanku/get_datatable",
      type: "POST",
      data: {
        status: 'ContentMyEklanku',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        typeSearch: $('select[name=custom_type]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
  });
}
tblContentMyEklanku();
$('#btnContentMyEklankuSrc').click(function () {
  $('#tblContentMyEklanku').DataTable().destroy();
  tblContentMyEklanku();
});
$('#btnContentMyEklankuAdd').click(function () {
  if ($("#formContentMyEklankuAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Content/MyEklanku/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formContentMyEklankuAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblContentMyEklanku').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
})
function showMyEklankuUp(id_testi, mbr_code, mbr_name, text_testi, type_testi, status_testi) {
  $('input[name=id_testi]').val(id_testi);
  $('input[name=mbr_code]').val(mbr_code);
  $('input[name=mbr_name]').val(mbr_name);
  $('textarea[name=text_testi]').html(text_testi);
  $('select[name=type_testi]').val(type_testi);
  $('select[name=status_testi]').val(status_testi);

  $.magnificPopup.open({
    items: {
      src: '#mdContentMyEklankuUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formContentMyEklankuUp').trigger('reset');
        $('#formContentMyEklankuUp').validate().resetForm();
        $('input, select').removeClass('error');
      }
    }
  });
}
$('#btnContentMyEklankuUp').click(function () {
  if ($("#formContentMyEklankuUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Content/MyEklanku/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formContentMyEklankuUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblContentMyEklanku').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Content Web -> Sharing Content
function tblContentSharingContent() {
  $('#tblContentSharingContent').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Content/SharingContent/get_datatable",
      type: "POST",
      data: {
        status: 'ContentSharingContent',
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        // chkSearchDate: $('input[name=stsSearchDate]').val(),
        // startSearchDate: $('input[name=search_start]').val(),
        stsSearch: $('select[name=search_status]').val(),
      }
    },
    language: {
      zeroRecords: "data tidak ditemukan"
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
  });
}
tblContentSharingContent();
$('#btnContentSharingContentSrc').click(function () {
  $('#tblContentSharingContent').DataTable().destroy();
  tblContentSharingContent();
});
function showUpdateSharingContent(id_sharing, name_sharing, status_sharing) {
  $('input[name=id_sharing]').val(id_sharing);
  $('input[name=name_sharing]').val(name_sharing);
  $('select[name=status_sharing]').val(status_sharing);

  $.magnificPopup.open({
    items: {
      src: '#mdContentSharingContentUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formContentSharingContentUp').trigger('reset');
        $('#formContentSharingContentUp').validate().resetForm();
        $('input, select').removeClass('error');
      }
    }
  });
}
$('#btnContentSharingContentUp').click(function () {
  if ($("#formContentSharingContentUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Content/SharingContent/up_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formContentSharingContentUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblContentSharingContent').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal({
            title: 'PROSES GAGAL',
            type: 'error',
            html: data.message,
          });
        }
        closeBlockUI();
      }
    });
  }
});
function fnImageSharingContent(id_sharing) {
  $('input[name=id_sharing]').val(id_sharing);
}
$(document).on('change', '#SharingContentImageUp', function (e) {
  var cropper;
  var files = e.target.files;
  var done = function (url) {
    document.getElementById('SharingContentImageUp').value = '';
    document.getElementById('imageContentSharingUp').src = url;
    $.magnificPopup.open({
      items: {
        src: '#mdContentSharingContentImageUp',
        type: 'inline',
      },
      mainClass: 'mfp-with-zoom',
      closeBtnInside: true,
      callbacks: {
        open: function () {
          cropper = new Cropper(document.getElementById('imageContentSharingUp'), {
            aspectRatio: 2 / 1,
            viewMode: 3,
          });
        },
        close: function () {
          cropper.destroy();
          cropper = null;
        }
      }
    });
  };
  var reader;
  var file;
  var url;

  if (files && files.length > 0) {
    file = files[0];

    if (URL) {
      done(URL.createObjectURL(file));
    } else if (FileReader) {
      reader = new FileReader();
      reader.onload = function (e) {
        done(reader.result);
      };
      reader.readAsDataURL(file);
    }
  }
  document.getElementById('btnContentSharingContentImageUp').addEventListener('click', function () {
    showBlockUI();

    var initialAvatarURL;
    var canvas;

    if (cropper) {
      canvas = cropper.getCroppedCanvas({
        width: 800,
        height: 400,
      });

      canvas.toBlob(function (blob) {
        var formData = new FormData();

        formData.append('image_sharing', blob);
        formData.append('id_sharing', $('input[name=id_sharing]').val());

        $.ajax({
          url: base_url + "/Content/SharingContent/up_banner",
          type: "POST",
          data: formData,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function (data) {
            if (data.status) {
              $('#tblContentSharingContent').DataTable().ajax.reload();
              $.magnificPopup.close();
              swal("PROSES BERHASIL", data.message, "success");
            }
            else {
              swal("PROSES GAGAL", data.message, "error");
              $.magnificPopup.close();
            }
            closeBlockUI();
          }
        }, "image/jpeg", 0.75);
      });
    }
  });
});
$('#btnContentSharingContentAdd').click(function () {
  if ($("#formContentSharingContentAdd").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Content/SharingContent/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formContentSharingContentAdd').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblContentSharingContent').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Accounting -> Pencatatan Penarikan Bonus
$('#btnAccountingPencairanBonusPerusahaan').click(function () {
  if ($("#formAccountingPencairanBonusPerusahaan").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Accounting/PencairanBonusPerusahaan/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formAccountingPencairanBonusPerusahaan').serialize(),
      success: function (data) {
        if (data.status) {
          swal("PROSES BERHASIL", data.message, "success");
          $('#formAccountingPencairanBonusPerusahaan').trigger('reset');
          $('#formAccountingPencairanBonusPerusahaan').validate().resetForm();
          $('input, select').removeClass('error');
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Accounting -> Deposit Saldo Manual
$('#btnAccountingDepositSaldoManual').click(function () {
  if ($("#formAccountingDepositSaldoManual").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Accounting/DepositSaldoManual/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formAccountingDepositSaldoManual').serialize(),
      success: function (data) {
        if (data.status) {
          swal("PROSES BERHASIL", data.message, "success");
          $('#formAccountingDepositSaldoManual').trigger('reset');
          $('#formAccountingDepositSaldoManual').validate().resetForm();
          $('input, select').removeClass('error');
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Accounting -> Penarikan Saldo
// $('#formAccountingPenarikanSaldo').validate({
//     rules: {
//         'jumlah_saldo': {
//             number: true,
//             lessThanEqual: 'input[name=mbr_amount]',
//         },
//     },
// });
$('#btnAccountingPenarikanSaldo').click(function () {
  if ($("#formAccountingPenarikanSaldo").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Accounting/PenarikanSaldo/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formAccountingPenarikanSaldo').serialize(),
      success: function (data) {
        if (data.status) {
          swal("PROSES BERHASIL", data.message, "success");
          $('#formAccountingPenarikanSaldo').trigger('reset');
          $('#formAccountingPenarikanSaldo').validate().resetForm();
          $('input, select').removeClass('error');
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Accounting -> Hadiah Member
function tblAccountingHadiahMember() {
  $('#tblAccountingHadiahMember').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Accounting/HadiahMember/get_datatable",
      type: "POST",
      data: {
        status: 'AccountingHadiahMember',
        // chkSearchDate: $('input[name=stsSearchDate]').val(),
        // startSearchDate: $('input[name=search_start]').val(),
        // endSearchDate: $('input[name=search_end]').val(),
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        typeSearch: $('select[name=custom_type]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
tblAccountingHadiahMember();
$('#btnAccountingHadiahMemberUpdate').click(function () {
  if ($("#formAccountingHadiahMemberUpdate").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Accounting/HadiahMember/generateUpdateKompetisi",
      method: 'POST',
      dataType: 'json',
      data: $('#formAccountingHadiahMemberUpdate').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblAccountingHadiahMember').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
$('#btnAccountingHadiahMemberSrc').click(function () {
  $('#tblAccountingHadiahMember').DataTable().destroy();
  tblAccountingHadiahMember();
});
function showAccountingHadiahMemberUp(reward_id, mbr_code, mbr_name, reward_name, reward_periode, reward_position, reward_point, reward_amount) {
  $('input[name=reward_id]').val(reward_id);
  $('input[name=mbr_code]').val(mbr_code);
  $('input[name=mbr_name]').val(mbr_name);
  $('input[name=reward_name]').val(reward_name);
  $('input[name=reward_periode]').val(reward_periode);
  $('input[name=reward_position]').val(reward_position.replace(/\.00$/, ''));
  $('input[name=reward_point]').val(reward_point.replace(/\.00$/, ''));
  $('input[name=reward_amount]').val(addCommas(reward_amount));

  $.magnificPopup.open({
    items: {
      src: '#mdAccountingHadiahMemberUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formAccountingHadiahMemberUp').trigger('reset');
        $('#formAccountingHadiahMemberUp').validate().resetForm();
        $('input,select,textarea').removeClass('error');
      }
    }
  });
}
$('#btnAccountingHadiahMemberUp').click(function () {
  if ($("#formAccountingHadiahMemberUp").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Accounting/HadiahMember/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formAccountingHadiahMemberUp').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblAccountingHadiahMember').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Kompetisi -> Kompetisi Transaksi
function tblKompetisiKompetisiTransaksi() {
  $('#tblKompetisiKompetisiTransaksi').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Kompetisi/KompetisiTransaksi/get_datatable",
      type: "POST",
      data: {
        status: 'KompetisiKompetisiTransaksi',
        trgSearch: $('select[name=search_type]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}
$('#btnKompetisiKompetisiTransaksiSrc').click(function () {
  $('#tblKompetisiKompetisiTransaksi').DataTable().destroy();
  tblKompetisiKompetisiTransaksi();
});
function showKompetisiKompetisiTransaksiDetail(mbr_code, id_kompetisi) {
  showBlockUI();
  $.ajax({
    url: base_url + "/Kompetisi/KompetisiTransaksi/get_datatable_detail",
    type: "POST",
    data: {
      mbr_code: mbr_code,
      id_kompetisi: id_kompetisi,
    },
    dataType: 'JSON',
    success: function (data) {
      tblKompetisiKompetisiTransaksiDetail.clear();
      tblKompetisiKompetisiTransaksiDetail.rows.add(data).draw();
      $.magnificPopup.open({
        items: {
          src: '#mdKompetisiKompetisiTransaksiDetail',
          type: 'inline',
        },
        mainClass: 'mfp-with-zoom',
        closeBtnInside: true,
        callbacks: {
          open: function () {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
          }
        }
      });
      closeBlockUI();
    }
  });
}
// Kompetisi -> The Winning Team
function tblKompetisiTheWinningTeamNow() {
  $('#tblKompetisiTheWinningTeamNow').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Kompetisi/TheWinningTeam/get_datatable_temp",
      type: "POST",
      data: {
        periode: $('select[name=periode]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },
        filename: 'TWT ' + $('select[name=periode]').val(),
      }
    ]
  });
}
tblKompetisiTheWinningTeamNow();
$('#btnKompetisiTheWinningTeamNowSrc').click(function () {
  $('#tblKompetisiTheWinningTeamNow').DataTable().destroy();
  tblKompetisiTheWinningTeamNow();
});
var tblKompetisiTheWinningTeamNowDetail = $('#tblKompetisiTheWinningTeamNowDetail').DataTable({
  ordering: false,
  searching: false,
  bLengthChange: false,
  responsive: true,
  scrollY: '40vh',
  scrollCollapse: true,
  paging: false,
  sScrollX: "100%",
  scrollX: true,
  render: {
    "_": "plain",
    "filter": "filter",
    "display": "display"
  },
  dom: 'Blfrtip',
  buttons: [
    {
      extend: 'excel',
      footer: true,
      text: '<span class="fas fa-file-excel"></span> Excel Export',
      exportOptions: {
        modifier: {
          search: 'applied',
          order: 'applied'
        }
      },
    }
  ]
});
function showKompetisiTheWinningTeamNowDetail(id_team, periode) {
  showBlockUI();
  $.ajax({
    url: base_url + "/Kompetisi/TheWinningTeam/get_datatable_temp_detail",
    type: "POST",
    data: {
      id_team: id_team,
      periode: periode,
    },
    dataType: 'JSON',
    success: function (data) {
      tblKompetisiTheWinningTeamNowDetail.clear();
      tblKompetisiTheWinningTeamNowDetail.rows.add(data).draw();
      $.magnificPopup.open({
        items: {
          src: '#mdKompetisiTheWinningTeamNowDetail',
          type: 'inline',
        },
        mainClass: 'mfp-with-zoom',
        closeBtnInside: true,
        callbacks: {
          open: function () {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
          }
        }
      });
      closeBlockUI();
    }
  });
}
// Service -> Ongoing
function tblServiceOngoing() {
  var tblServiceOngoing = $('#tblServiceOngoing').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Service/OngoingService/get_datatable",
      type: "POST",
      data: {
        status: 'ServiceOngoing',
        typeSearch: $('select[name=custom_type]').val(),
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ],
    drawCallback: function (settings) {
      var countTable = tblServiceOngoing.rows({ filter: 'applied' }).nodes().length;
      var no = 0;
      var api = this.api();
      var myData = api.rows().data();
      myData.each(function () {
        var fDate = new Date($('#cdso' + no + '').text());
        $('#cdso' + no + '').countdown({
          since: fDate,
          padZeroes: true
        });
        if (((new Date() - fDate) / 1000 / 60) > 1440) $('#cdso' + no + '').addClass('text-danger');
        else $('#cdso' + no + '').addClass('text-warning');
        no++;
      });
    }
  });
}
$('#btnServiceOngoingSrc').click(function () {
  $('#tblServiceOngoing').DataTable().destroy();
  tblServiceOngoing();
});
function fnServiceOngoingPhoto(id_komplint, no_gambar) {
  $('input[name=id_komplint]').val(id_komplint);
  $('input[name=no_gambar]').val(no_gambar);

  $.magnificPopup.open({
    items: {
      src: '#mdServiceOngoingPhoto',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formServiceOngoingPhoto').trigger('reset');
        $('#formServiceOngoingPhoto').validate().resetForm();
        $('input').removeClass('error');
      }
    }
  });
}
$('#btnServiceOngoingPhoto').click(function () {
  if ($("#formServiceOngoingPhoto").valid()) {

    var formData = new FormData($('#formServiceOngoingPhoto')[0]);

    showBlockUI();
    $.ajax({
      url: base_url + "/Service/OngoingService/up_image",
      method: 'POST',
      dataType: 'json',
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      async: false,
      success: function (data) {
        if (data.status) {
          $('#tblServiceOngoing').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
function showServiceOngoingUp(id_komplint, type_komplint, id_member, isi_komplint, judul_komplint, mbr_mobile, mbr_name, mbr_email, mbr_id_number, device) {
  isi_komplint = isi_komplint.replace(/<br>/g, "\r\n");
  $('input[name=id_komplint]').val(id_komplint);
  $('select[name=type_komplint]').val(type_komplint);
  $('textarea[name=isi_komplint]').val(isi_komplint);
  $('select[name=judul_komplint]').val(judul_komplint);
  $('input[name=mbr_code]').val(id_member);
  $('input[name=mbr_name]').val(mbr_name);
  $('input[name=mbr_mobile]').val(mbr_mobile);
  $('input[name=mbr_email]').val(mbr_email);
  $('input[name=mbr_id_number]').val(mbr_id_number);
  $('input[name=device]').val(device);

  $.magnificPopup.open({
    items: {
      src: '#mdServiceOngoingUp',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      open: function () {
        $('#w2').bootstrapWizard('first');
        $(".next").removeClass("disabled");
      },
      close: function () {
        $('form').trigger('reset');
        $('#formServiceOngoingUp').validate().resetForm();
        $('input,select,textarea').removeClass('error');
      }
    }
  });
}
function showServiceOngoingSolve(id_komplint, type_komplint, id_member, isi_komplint, judul_komplint, mbr_name) {
  isi_komplint = isi_komplint.replace(/<br>/g, "\r\n");
  $('input[name=id_komplint]').val(id_komplint);
  $('select[name=type_komplint]').val(type_komplint);
  $('textarea[name=isi_komplint]').val(isi_komplint);
  $('input[name=judul_komplint]').val(judul_komplint);
  $('input[name=mbr_code]').val(id_member);
  $('input[name=mbr_name]').val(mbr_name);

  $.magnificPopup.open({
    items: {
      src: '#mdServiceOngoingSolve',
      type: 'inline',
    },
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true,
    callbacks: {
      close: function () {
        $('#formServiceOngoingSolve').trigger('reset');
        $('#formServiceOngoingSolve').validate().resetForm();
        $('input,select,textarea').removeClass('error');
      }
    }
  });
}
$('#btnServiceOngoingSolve').click(function () {
  if ($("#formServiceOngoingSolve").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Service/OngoingService/up_data_solve",
      method: 'POST',
      dataType: 'json',
      data: $('#formServiceOngoingSolve').serialize(),
      success: function (data) {
        if (data.status) {
          $('#tblServiceOngoing').DataTable().ajax.reload();
          $.magnificPopup.close();
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Service -> Complete
function tblServiceComplete() {
  var tblServiceComplete = $('#tblServiceComplete').DataTable({
    lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: base_url + "/Service/CompleteService/get_datatable",
      type: "POST",
      data: {
        status: 'ServiceComplete',
        typeSearch: $('select[name=custom_type]').val(),
        trgSearch: $('select[name=search_type]').val(),
        txtSearchKey: $('input[name=search_key]').val(),
        chkSearchDate: $('input[name=stsSearchDate]').val(),
        startSearchDate: $('input[name=search_start]').val(),
        endSearchDate: $('input[name=search_end]').val(),
      }
    },
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'excel',
        footer: true,
        text: '<span class="fas fa-file-excel"></span> Excel Export',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        },

      }
    ]
  });
}


// Kirim Key
$('#btnKirimKey').click(function () {
  if ($("#formKirimKey").valid()) {
    showBlockUI();
    $.ajax({
      url: base_url + "/KirimKey/add_data",
      method: 'POST',
      dataType: 'json',
      data: $('#formKirimKey').serialize(),
      success: function (data) {
        if (data.status) {
          swal("PROSES BERHASIL", data.message, "success");
        }
        else {
          swal("PROSES GAGAL", data.message, "error");
        }
        closeBlockUI();
      }
    });
  }
});
// Get Nama Member
$('input[name=mbr_code]').bind("change keyup input", function () {
  var mbr_code = $(this).val().toUpperCase();
  if (mbr_code.length == 10) {
    $.ajax({
      url: base_url + "/Master/DownlineMember/get_mbr_name",
      type: 'POST',
      data: { mbr_code },
      dataType: 'json',
      success: function (data) {
        $('input[name=mbr_name]').val(data.mbr_name);
        $('input[name=mbr_type]').val(data.mbr_type);
        $('select[name=carier_verifikasi]').val(data.carier_verifikasi);
        $('input[name=mbr_id_number]').val(data.mbr_id_number);
        $('input[name=mbr_mobile]').val(data.mbr_mobile);
        $('input[name=mbr_email]').val(data.mbr_email);
      }
    });
    $.ajax({
      url: base_url + "/Master/MemberMax/get_mbr_saldo",
      type: 'POST',
      data: { mbr_code },
      success: function (data) {
        $('input[name=mbr_amount]').val(addCommas(Number(data)));
      }
    });
  }
  else {
    $('input[name=mbr_name]').val('');
    $('input[name=mbr_amount]').val('');
    $('input[name=mbr_type]').val('');
    $('select[name=carier_verifikasi]').val('');
    $('input[name=total_transaksi]').val('');
    $('input[name=mbr_id_number]').val('');
    $('input[name=mbr_mobile]').val('');
    $('input[name=mbr_email]').val('');
  }
});
$('input[name=mbr_code2]').bind("change keyup input", function () {
  var mbr_code = $(this).val().toUpperCase();
  if (mbr_code.length == 10) {
    $.ajax({
      url: base_url + "/Master/DownlineMember/get_mbr_name",
      type: 'POST',
      data: { mbr_code },
      dataType: 'json',
      success: function (data) {
        $('input[name=mbr_name2]').val(data.mbr_name);
      }
    });
  }
  else {
    $('input[name=mbr_name2]').val('');
  }
});
// Get Bonus Transaksi
$("select[name=mbr_code]").change(function () {
  var mbr_code = $(this).val().toUpperCase();
  $.ajax({
    url: base_url + "/Master/MemberMax/get_mbr_bonus_transaksi",
    type: 'POST',
    data: { mbr_code },
    success: function (data) {
      $('input[name=mbr_bonus_transaksi]').val(addCommas(Number(data)));
    }
  });
});

// Get Level User
$('select[name=user_login]').change(function () {
  var user_login = $(this).find('option:selected').val();
  // console.log(user_login);
  if (user_login) {
    showBlockUI();
    $.ajax({
      url: base_url + "/Master/UserCrm/get_level",
      method: 'POST',
      data: { user_login: user_login },
      dataType: 'json',
      success: function (data) {
        $('input[name=user_level]').val(data.user_level);
        closeBlockUI();
      }
    });
  }
});
// Modal Show Animation
$('.modal-with-move-anim').magnificPopup({
  closeBtnInside: true,
  closeOnBgClick: true,
  mainClass: 'my-mfp-slide-bottom',
  modal: true,
  callbacks: {
    open: function () {
      $('form').trigger('reset');
    },
    close: function () {
      $('form').validate().resetForm();
      $('form').trigger('reset');
      $('input,select,textarea').removeClass('error');
      $('.error').remove();
    }
  }
});
// Modal Dismiss
$('.modal-dismiss').click(function (e) {
  e.preventDefault();
  $.magnificPopup.close();
});
/* Form Reset */
function formReset(form_name) {
  form_name = '#' + form_name;
  $(form_name).trigger("reset");
  $(form_name).validate().resetForm();
  $('input').removeClass('error');
  $('select').removeClass('error');
  $('select').trigger("change");
  $('textarea').removeClass('error');
}
// Show BlockUI
function showBlockUI() {
  $.blockUI({
    message: 'Mohon menunggu...',
    css: {
      'z-index': 10002,
      border: 'none',
      padding: '15px',
      backgroundColor: '#000',
      '-webkit-border-radius': '10px',
      '-moz-border-radius': '10px',
      opacity: .5,
      color: '#fff',
    }
  });
}
// Close BlockUI
function closeBlockUI() {
  $.unblockUI();
}
// Datepicker
$.fn.datepicker.defaults.format = "dd-mm-yyyy";
$('.datepicker').datepicker({
  todayHighlight: true,
  language: 'id',
  orientation: 'bottom left',
});
// Leading Zero
function pad(str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}
// Fix Input Group Icon
$("#formDepositSaldoManualKey").validate({
  highlight: function (label) {
    $(label).closest('.form-group').removeClass('has-success').addClass('has-error');
  },
  success: function (label) {
    $(label).closest('.form-group').removeClass('has-error');
    label.remove();
  },
  errorPlacement: function (error, element) {
    var placement = element.closest('.input-group');
    if (!placement.get(0)) {
      placement = element;
    }
    if (error.text() !== '') {
      placement.after(error);
    }
  }
});
// Select 2
$(function () {
  $('[data-plugin-selectTwo]').each(function () {
    var $this = $(this),
      opts = {};

    var pluginOptions = $this.data('plugin-options');
    if (pluginOptions)
      opts = pluginOptions;

    $this.themePluginSelect2(opts);
  });
});
$(function () {
  $('[data-plugin-masked-input]').each(function () {
    var $this = $(this),
      opts = {};

    var pluginOptions = $this.data('plugin-options');
    if (pluginOptions)
      opts = pluginOptions;

    $this.themePluginMaskedInput(opts);
  });
});
// Search Table by Date
if ($('input[name=swcSearchDate]').checked) {
  $('input[name=search_start],input[name=search_end').prop('disabled', false);
  $('input[name=stsSearchDate]').val('yes');
}
else {
  $('input[name=search_start],input[name=search_end').prop('disabled', true);
  $('input[name=stsSearchDate]').val('no');
}
$('input[name=swcSearchDate]').change(function () {
  if (this.checked) {
    $('input[name=search_start],input[name=search_end').prop('disabled', false);
    $('input[name=stsSearchDate]').val('yes');
  } else {
    $('input[name=search_start],input[name=search_end').prop('disabled', true);
    $('input[name=stsSearchDate]').val('no');
  }
  // console.log($('input[name=search_start]').val()+'-'+$('input[name=search_end]').val());
});
// Expired Check
function expiredPenarikan(id) {
  if ($(id).text() == "00jam00menit00detik") {
    $(id).text('Sudah lebih dari 1x24 jam mohon ditransfer');
    $(id).addClass('text-danger');
  }
}
function expiredTopup(id) {
  if ($(id).text() == "00jam00menit00detik") {
    $(id).text('Periode transfer sudah melebihi 4 jam');
    $(id).addClass('text-info');
  }
}
// Thousand Separator
function addCommas(nStr) {
  nStr += '';
  x = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return x1 + x2;
}
// Remove Thousand Separator
// function delCommas(nStr) {
// return nStr.replace(/,/g, '');
// }
// Button Countdown
function fnCD(counter, i) {
  setInterval(function () {
    counter--;
    span = document.getElementById("btnCD" + i);
    if (counter >= 0) {
      span.innerHTML = 'kirim ulang setelah : ' + counter + ' detik';
      span.disabled = true;
    }
    if (counter === 0) {
      span.innerHTML = 'Kirim Ulang';
      span.disabled = false;
      clearInterval(counter);
    }
  }, 1000);
}
// Convert String to Int
function intVal(i) {
  return typeof i === 'string' ?
    i.replace(/[\$,]/g, '') * 1 :
    typeof i === 'number' ?
      i : 0;
}
// Tooltip
(function ($) {
  'use strict';
  if ($.isFunction($.fn['tooltip'])) {
    $('[data-toggle=tooltip],[rel=tooltip]').tooltip({ container: 'body' });
  }
}).apply(this, [jQuery]);
// Popup Banner
function showBanner(link) {
  $.magnificPopup.open({
    items: {
      src: link,
    },
    type: 'image',
    mainClass: 'mfp-with-zoom',
    closeBtnInside: true
  });
}
// Button Group Active
$(".btn-group > .btn").click(function () {
  $(".btn-group > .btn").removeClass("active");
  $(this).addClass("active");
  // console.log($(this).html());
});
// Get Month Name
function getMonthName(i) {
  var month = new Array();
  month[0] = "Januari";
  month[1] = "Februari";
  month[2] = "Maret";
  month[3] = "April";
  month[4] = "Mei";
  month[5] = "Juni";
  month[6] = "Juli";
  month[7] = "Agustus";
  month[8] = "September";
  month[9] = "Oktober";
  month[10] = "November";
  month[11] = "Desember";

  return month[i];
}
// String to Data
function toDate(dateStr) {
  const [day, month, year] = dateStr.split("-")
  return new Date(year, month - 1, day)
}
// Fix Select2 Inside Magnific Popup
$.magnificPopup.instance._onFocusIn = function (e) {
  if ($(e.target).hasClass('select2-search__field')) {
    return true;
  }
  $.magnificPopup.proto._onFocusIn.call(this, e);
}
// Fix Enter Search
$('.form-src').on('keyup keypress', function (e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    $(".btn-src").trigger('click');
    return false;
  }
});
// Custom Validation
$.validator.addMethod('lessThanEqual', function (value, element, param) {
  return this.optional(element) || parseInt(value) <= parseInt($(param).val());
}, function (param, element) {
  return 'Nilai harus kurang atau sama dengan ' + parseInt($(param).val())
});
// Summernote
$('.summernote').summernote({
  placeholder: 'mulai tulis dari sini...',
  dialogsInBody: true,
  height: '200px',
});
// Pengembangan
function fnPengembangan() {
  swal("Maaf", 'Fungsi masih dalam pengembangan!', "info");
}
// Get Provinsi
$('select[name=input_kota]').change(function () {
  var provinsi = $('select[name=input_kota] :selected').parent().attr('label');
  $('input[name=input_provinsi]').val(provinsi);
});
/* Input Mask */
$(function () {
  $('.money').mask('#.##0', { reverse: true });
});
// Placeholder
$('input[name=search_key]').attr("placeholder", "masukkan kata kunci sesuai target pencarian");
$('input[name=member_code]').attr("placeholder", "contoh: MBR0000xxx");
$('input[name=mbr_code]').attr("placeholder", "contoh: EKL0000xxx");
$('input[name=mbr_id_number]').attr("placeholder", "contoh: 1234567890123456");
$('input[name=member_name],input[name=mbr_name],input[name=pemilik_kendaraan]').attr("placeholder", "contoh: Rhoda Hazan");
$('input[name=user_fname]').attr("placeholder", "contoh: Rhoda");
$('input[name=user_lname]').attr("placeholder", "contoh: Hazan Ingrim");
$('input[name=email],input[name=mbr_email],input[name=user_hp]').attr("placeholder", "contoh: super.star@abc.com");
$('input[name=member_mobile],input[name=mbr_mobile],input[name=destination]').attr("placeholder", "contoh: 08182982938x");
$('input[name=member_kota],input[name=mbr_kota]').attr("placeholder", "contoh: New York");
$('input[name=member_address],input[name=mbr_address]').attr("placeholder", "contoh: Jalan timur laut no 5x");
$('input[name=member_bank_name],input[name=mbr_bank_name]').attr("placeholder", "contoh: BRI");
$('input[name=member_bank_num],input[name=mbr_bank_num]').attr("placeholder", "contoh: 7162826732719xx");
$('input[name=member_bank_acc],input[name=mbr_bank_acc]').attr("placeholder", "contoh: Kelle Salvaggio");
$('input[name=key],input[name=user_password],input[name=user_password_repeat]').attr("placeholder", "contoh: xxxxxx");
$('input[name=jumlah_kuota],input[name=jumlah_saldo],input[name=jumlah],input[name=mbr_amount]').attr("placeholder", "contoh: 100000000");
$('input[name=link_branding]').attr("placeholder", "contoh: http://www.google.com");
$('input[name=tipe_kendaraan]').attr("placeholder", "contoh: Sepeda Motor");
$('input[name=nopol_kendaraan]').attr("placeholder", "contoh: B627XHX");
$('input[name=alasan],input[name=alasan_penarikan],input[name=refund]').attr("placeholder", "contoh: kemauan dari member");
$('input[name=name_sharing]').attr("placeholder", "contoh: pulsa minggu ke dua"); 