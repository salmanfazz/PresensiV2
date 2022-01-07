<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SiswaController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
	
    public function index() 
	{
		$data['siswa'] = \App\Siswa::orderBy('nis')
						->get();
		$data['kelas'] = \App\Kelas::orderBy('id_kelas')
						->get();
		return view('siswa', $data);
	}
	public function store(Request $request)
	{
		$rule = [
			'nis'=>'required|string',
			'nama'=>'required|string',
			'id_kelas'=>'required|string',
		];
		$this->validate($request, $rule);
		
		$input = $request->all();
		
		$siswa = new \App\Siswa;
		$siswa->nis			= $input['nis'];
		$siswa->nama 		= $input['nama'];
		$siswa->id_kelas 	= $input['id_kelas'];
		$status = $siswa->save();
		
		if ($status) {
			return redirect('/siswa')->with('success', 'Data Berhasil Ditambahkan');
		} else {
			return redirect('/siswa')->with('error', 'Data Gagal Ditambahkan');
		}
	}
	
	public function update(Request $request)
	{
		$rule = [
			'nis'=>'required|string',
			'nama'=>'required|string',
			'id_kelas'=>'required|string',
		];
		$this->validate($request, $rule);
		
		$input = $request->all();
		
		$siswa = \App\Siswa::find($input['nis']);
		$siswa->nama 		= $input['nama'];
		$siswa->id_kelas 	= $input['id_kelas'];
		$status = $siswa->update();
		
		if ($status) {
			return redirect('/siswa')->with('success', 'Data Berhasil Diubah');
		} else {
			return redirect('/siswa')->with('error', 'Data Berhasil Diubah');
		}
	}
	
	public function destroy(Request $request, $nis)
	{
		$siswa = \App\Siswa::find($nis);
		$status = $siswa->delete();
		
		if ($status) {
			return redirect('/siswa')->with('success', 'Data berhasil dihapus');
		} else {
			return redirect('/siswa')->with('error', 'Data gagal dihapus');
		}
	}
	
	function action(Request $request)
    {
		if($request->ajax()) {
			$output = '';
			$query = $request->get('query');
		
			if($query != '') {
				$data = \App\Siswa::where('nis', 'like', '%'.$query.'%')
				->orWhere('nama', 'like', '%'.$query.'%')
				->orWhere('id_kelas', 'like', '%'.$query.'%')
				->orderBy('nis')
				->get();
			}
			else {
				$data = DB::table('tsiswa')
				->orderBy('nis')
				->get();
			}
			$total_row = $data->count();
			if($total_row > 0) {
				foreach($data as $row) {
					$output .= '
						<tr>
							<td>'.$row->nis.'</td>
							<td>'.$row->nama.'</td>
							<td>'.$row->id_kelas.'</td>
							<td>
								<center><a data-toggle="modal" data-nis="'.$row->nis.'" data-nama="'.$row->nama.'" data-id_kelas="'.$row->id_kelas.'" title="Add this item" class="open-EditSiswa btn btn-primary" href="#addSiswaDialog">Edit</a></center>
							</td>
							<td>
								<form action = "'.url('/siswa', $row->nis) .'" method = "post">
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
}
