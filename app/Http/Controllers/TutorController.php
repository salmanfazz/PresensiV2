<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TutorController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
	
    public function index() 
	{
		$data['tutor'] = \App\Tutor::orderBy('nip')
						->get();
		$data['mapel'] = \App\Mapel::orderBy('id_mapel')
						->get();
		return view('tutor', $data);
	}
	public function store(Request $request)
	{
		$rule = [
			'nip'=>'required|string',
			'nama'=>'required|string',
			'id_mapel'=>'required|string',
		];
		$this->validate($request, $rule);
		
		$input = $request->all();
		
		$tutor = new \App\Tutor;
		$tutor->nip	= $input['nip'];
		$tutor->nama 		= $input['nama'];
		$tutor->id_mapel 		= $input['id_mapel'];
		$status = $tutor->save();
		
		if ($status) {
			return redirect('/tutor')->with('success', 'Data Berhasil Ditambahkan');
		} else {
			return redirect('/tutor')->with('error', 'Data Gagal Ditambahkan');
		}
	}
	
	public function update(Request $request)
	{
		$rule = [
			'nip'=>'required|string',
			'nama'=>'required|string',
			'id_mapel'=>'required|string',
		];
		$this->validate($request, $rule);
		
		$input = $request->all();
		
		$tutor = \App\Tutor::find($input['nip']);
		$tutor->nama 		= $input['nama'];
		$tutor->id_mapel 		= $input['id_mapel'];
		$status = $tutor->update();
		
		if ($status) {
			return redirect('/tutor')->with('success', 'Data Berhasil Diubah');
		} else {
			return redirect('/tutor')->with('error', 'Data Berhasil Diubah');
		}
	}
	
	public function destroy(Request $request, $nip)
	{
		$tutor = \App\Tutor::find($nip);
		$status = $tutor->delete();
		
		if ($status) {
			return redirect('/tutor')->with('success', 'Data berhasil dihapus');
		} else {
			return redirect('/tutor')->with('error', 'Data gagal dihapus');
		}
	}
	
	function action(Request $request)
    {
		if($request->ajax()) {
			$output = '';
			$query = $request->get('query');
		
			if($query != '') {
				$data = \App\Tutor::where('nip', 'like', '%'.$query.'%')
				->orWhere('nama', 'like', '%'.$query.'%')
				->orWhere('id_mapel', 'like', '%'.$query.'%')
				->orderBy('nip')
				->get();
			}
			else {
				$data = DB::table('ttutor')
				->orderBy('nip')
				->get();
			}
			$total_row = $data->count();
			if($total_row > 0) {
				foreach($data as $row) {
					$output .= '
						<tr>
							<td>'.$row->nip.'</td>
							<td>'.$row->nama.'</td>
							<td>'.$row->id_mapel.'</td>
							<td>
								<center><a data-toggle="modal" data-nip="'.$row->nip.'" data-nama="'.$row->nama.'" data-id_mapel="'.$row->id_mapel.'" title="Add this item" class="open-EditTutor btn btn-primary" href="#addTutorDialog">Edit</a></center>
							</td>
							<td>
								<form action = "'.url('/tutor', $row->nip) .'" method = "post">
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
