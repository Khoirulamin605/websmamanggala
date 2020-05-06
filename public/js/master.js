// Kompetisi Transaksi
$('select[name=sortir_tgl_daftar]').change(function() {
    if (this.value == 1) {
        $('input[name=start_tgl_daftar],input[name=end_tgl_daftar').prop('disabled', false);
    } else {
        $('input[name=start_tgl_daftar],input[name=end_tgl_daftar').prop('disabled', true);
    }
});