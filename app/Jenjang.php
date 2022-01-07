<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
	public $table = 'tjenjang';
	protected $primaryKey = 'id_jenjang';
	public $timestamps = false;
	
	protected $fillable = [
		'id_jenjang','jenjang',
	];
}