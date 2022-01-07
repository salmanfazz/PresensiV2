<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
	public $table = 'tmapel';
	protected $primaryKey = 'id_mapel';
	public $timestamps = false;
	
	protected $fillable = [
		'id_mapel','mapel','jadwal'
	];
}