<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KelasController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
	
    public function index() 
	{
		$data['kelas'] = \App\Kelas::orderBy('id_kelas')
						->get();
		$data['jenjang'] = \App\Jenjang::orderBy('id_jenjang')
						->get();				
		return view('kelas', $data);
	}
	public function store(Request $request)
	{
		$rule = [
			'id_kelas'=>'required|string',
			'kelas'=>'required|string',
			'id_jenjang'=>'required|string',
		];
		$this->validate($request, $rule);
		
		$input = $request->all();
		
		$kelas = new \App\Kelas;
		$kelas->id_kelas	= $input['id_kelas'];
		$kelas->kelas 		= $input['kelas'];
		$kelas->id_jenjang 	= $input['id_jenjang'];
		$status = $kelas->save();
		
		if ($status) {
			return redirect('/kelas')->with('success', 'Data Berhasil Ditambahkan');
		} else {
			return redirect('/kelas')->with('error', 'Data Gagal Ditambahkan');
		}
	}
	
	public function update(Request $request)
	{
		$rule = [
			'id_kelas'=>'required|string',
			'kelas'=>'required|string',
			'id_jenjang'=>'required|string',
		];
		$this->validate($request, $rule);
		
		$input = $request->all();
		
		$kelas = \App\Kelas::find($input['id_kelas']);
		$kelas->kelas 		= $input['kelas'];
		$kelas->id_jenjang 	= $input['id_jenjang'];
		$status = $kelas->update();
		
		if ($status) {
			return redirect('/kelas')->with('success', 'Data Berhasil Diubah');
		} else {
			return redirect('/kelas')->with('error', 'Data Berhasil Diubah');
		}
	}
	
	public function destroy(Request $request, $id_kelas)
	{
		$kelas = \App\Kelas::find($id_kelas);
		$status = $kelas->delete();
		
		if ($status) {
			return redirect('/kelas')->with('success', 'Data berhasil dihapus');
		} else {
			return redirect('/kelas')->with('error', 'Data gagal dihapus');
		}
	}
	
	function action(Request $request)
    {
		if($request->ajax()) {
			$output = '';
			$query = $request->get('query');
		
			if($query != '') {
				$data = \App\Kelas::where('id_kelas', 'like', '%'.$query.'%')
				->orWhere('kelas', 'like', '%'.$query.'%')
				->orWhere('id_jenjang', 'like', '%'.$query.'%')
				->orderBy('id_kelas')
				->get();
			}
			else {
				$data = DB::table('tkelas')
				->orderBy('id_kelas')
				->get();
			}
			$total_row = $data->count();
			if($total_row > 0) {
				foreach($data as $row) {
					$output .= '
						<tr>
							<td>'.$row->id_kelas.'</td>
							<td>'.$row->kelas.'</td>
							<td>'.$row->id_jenjang.'</td>
							<td>
								<center><a data-toggle="modal" data-id_kelas="'.$row->id_kelas.'" data-kelas="'.$row->kelas.'" data-id_jenjang="'.$row->id_jenjang.'" title="Add this item" class="open-EditKelas btn btn-primary" href="#addKelasDialog">Edit</a></center>
							</td>
							<td>
								<form action = "'.url('/kelas', $row->id_kelas) .'" method = "post">
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
