<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
	public $table = 'tkelas';
	protected $primaryKey = 'id_kelas';
	public $timestamps = false;
	
	protected $fillable = [
		'id_kelas','kelas'
	];
}