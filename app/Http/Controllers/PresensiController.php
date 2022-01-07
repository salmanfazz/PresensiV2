<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PresensiController extends Controller 
{
	public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
	
    public function indexSiswa() 
	{
		$data['presensi'] = \App\Presensi::orderBy('id_presensi')
						->get();
		$data['siswa'] = \App\Siswa::orderBy('nis')
						->get();
		$data['mapel'] = \App\Mapel::orderBy('id_mapel')
						->get();
		return view('presensiSiswa', $data);
	}
	public function index() 
	{
		$data['presensi'] = \App\Presensi::orderBy('id_presensi')
						->get();
		$data['siswa'] = \App\Siswa::orderBy('nis')
						->get();
		$data['mapel'] = \App\Mapel::orderBy('id_mapel')
						->get();
		return view('presensi', $data);
	}
	public function prints() 
	{
		$data['presensi'] = \App\Presensi::orderBy('id_presensi')
						->get();
		$data['siswa'] = \App\Siswa::orderBy('nis')
						->get();
		$data['mapel'] = \App\Mapel::orderBy('id_mapel')
						->get();
		return view('print', $data);
	}
	public function store(Request $request)
	{
		$rule = [
			'nis'=>'required|string',
			'id_mapel'=>'required|string',
			'waktu'=>'required|string',
			'keterangan'=>'required|string',
		];
		$this->validate($request, $rule);
		
		$input = $request->all();
		
		$presensi = new \App\Presensi;
		$presensi->nis 			= $input['nis'];
		$presensi->id_mapel 	= $input['id_mapel'];
		$presensi->waktu 		= $input['waktu'];
		$presensi->keterangan 	= $input['keterangan'];
		$status = $presensi->save();
		
		if ($status) {
			return redirect('/presensiSiswa')->with('success', 'Data Berhasil Ditambahkan');
		} else {
			return redirect('/presensiSiswa')->with('error', 'Data Gagal Ditambahkan');
		}
	}
	
	public function update(Request $request)
	{
		$rule = [
			'id_presensi'=>'required|string',
			'nis'=>'required|string',
			'id_mapel'=>'required|string',
			'waktu'=>'required|string',
			'keterangan'=>'required|string',
		];
		$this->validate($request, $rule);
		
		$input = $request->all();
		
		$presensi = \App\Presensi::find($input['id_presensi']);
		$presensi->nis 			= $input['nis'];
		$presensi->id_mapel 	= $input['id_mapel'];
		$presensi->waktu 		= $input['waktu'];
		$presensi->keterangan 	= $input['keterangan'];
		$status = $presensi->update();
		
		if ($status) {
			return redirect('/presensi')->with('success', 'Data Berhasil Diubah');
		} else {
			return redirect('/presensi')->with('error', 'Data Berhasil Diubah');
		}
	}
	
	public function destroy(Request $request, $id_presensi)
	{
		$presensi = \App\Presensi::find($id_presensi);
		$status = $presensi->delete();
		
		if ($status) {
			return redirect('/presensi')->with('success', 'Data berhasil dihapus');
		} else {
			return redirect('/presensi')->with('error', 'Data gagal dihapus');
		}
	}
	
	function action(Request $request)
    {
		if($request->ajax()) {
			$output = '';
			$query = $request->get('query');
		
			if($query != '') {
				$data = \App\Presensi::where('id_presensi', 'like', '%'.$query.'%')
				->orWhere('nis', 'like', '%'.$query.'%')
				->orWhere('id_mapel', 'like', '%'.$query.'%')
				->orWhere('waktu', 'like', '%'.$query.'%')
				->orWhere('keterangan', 'like', '%'.$query.'%')
				->orderBy('id_presensi')
				->get();
			}
			else {
				$data = DB::table('tpresensi')
				->orderBy('id_presensi')
				->get();
			}
			$total_row = $data->count();
			if($total_row > 0) {
				foreach($data as $row) {
					$output .= '
						<tr>
							<td>'.$row->id_presensi.'</td>
							<td>'.$row->nis.'</td>
							<td>'.$row->id_mapel.'</td>
							<td>'.$row->waktu.'</td>
							<td>'.$row->keterangan.'</td>
							<td>
								<center><a data-toggle="modal" data-id_presensi="'.$row->id_presensi.'" data-nis="'.$row->nis.'" data-id_mapel="'.$row->id_mapel.'" " data-waktu="'.$row->waktu.'" " data-keterangan="'.$row->keterangan.'"title="Add this item" class="open-EditPresensi btn btn-primary" href="#addPresensiDialog">Edit</a></center>
							</td>
							<td>
								<form action = "'.url('/presensi', $row->id_presensi) .'" method = "post">
								'.csrf_field().'
								'.method_field('DELETE').'
								<center><button class = "btn btn-danger" type = "submit">Delete</button></center>
								</form>
							</td>
						</tr>
					';
				}
			}
			else {
				$output = '
					<tr>
						<td align="center" colspan="5">No Data Found</td>
					</tr>
				';
			}
		$data = array(
			'table_data'  => $output,
			'total_data'  => $total_row
		);
			echo json_encode($data);
		}
    }
	function actionSiswa(Request $request)
    {
		if($request->ajax()) {
			$output = '';
			$query = $request->get('query');
		
			if($query != '') {
				$data = \App\Presensi::where('id_presensi', 'like', '%'.$query.'%')
				->orWhere('nis', 'like', '%'.$query.'%')
				->orWhere('id_mapel', 'like', '%'.$query.'%')
				->orWhere('waktu', 'like', '%'.$query.'%')
				->orWhere('keterangan', 'like', '%'.$query.'%')
				->orderBy('id_presensi')
				->get();
			}
			else {
				$data = DB::table('tpresensi')
				->orderBy('id_presensi')
				->get();
			}
			$total_row = $data->count();
			if($total_row > 0) {
				foreach($data as $row) {
					$output .= '
						<tr>
							<td>'.$row->id_presensi.'</td>
							<td>'.$row->nis.'</td>
							<td>'.$row->id_mapel.'</td>
							<td>'.$row->waktu.'</td>
							<td>'.$row->keterangan.'</td>
						</tr>
					';
				}
			}
			else {
				$output = '
					<tr>
						<td align="center" colspan="5">No Data Found</td>
					</tr>
				';
			}
		$data = array(
			'table_data'  => $output,
			'total_data'  => $total_row
		);
			echo json_encode($data);
		}
    }
}
