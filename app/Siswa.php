<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
	public $table = 'tsiswa';
	protected $primaryKey = 'nis';
	public $timestamps = false;
	
	protected $fillable = [
		'nis','nama','id_kelas'
	];
}