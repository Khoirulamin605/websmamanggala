@php

    // nama file
    $filename="import-nilai".date('Y-m-d').".xlsx";

    //header info for browser
    header("Content-Type: application/vnd-ms-excel"); 
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    echo ("ID \t Nama Siswa \t Jurusan \t Kelas \t Mapel \t Tahun Pelajaran \t Semester \t Nilai");
@endphp

 {{-- //menampilkan nama kolom di baris pertama
 echo implode("\t", array_keys($record)) . "\n"; --}}