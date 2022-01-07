<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
	public $table = 'ttutor';
	protected $primaryKey = 'nip';
	public $timestamps = false;
	
	protected $fillable = [
		'nip','nama','id_mapel'
	];
}