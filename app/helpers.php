<?php
function rupiah($value)
{
    return 'Rp ' . number_format($value, 0, ',', '.');
}

function bulanIndo($bln)
{
    $bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    return $bulan[$bln - 1];
}