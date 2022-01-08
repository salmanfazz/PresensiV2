<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
	public $table = 'tpresensi';
	protected $primaryKey = 'id_presensi';
	public $timestamps = false;
	
	protected $fillable = [
		'id_presensi','nis', 'id_kelas', 'id_jenjang', 'mapel', 'waktu', 'keterangan'
	];
}