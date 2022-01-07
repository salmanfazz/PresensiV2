<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MapelController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
	
    public function index() 
	{
		$data['mapel'] = \App\Mapel::orderBy('id_mapel')
						->get();
		return view('mapel', $data);
	}
	public function store(Request $request)
	{
		$rule = [
			'mapel'=>'required|string',
			'jadwal'=>'required|string',
		];
		$this->validate($request, $rule);
		
		$input = $request->all();
		
		$mapel = new \App\Mapel;
		$mapel->mapel 		= $input['mapel'];
		$mapel->jadwal 		= $input['jadwal'];
		$status = $mapel->save();
		
		if ($status) {
			return redirect('/mapel')->with('success', 'Data Berhasil Ditambahkan');
		} else {
			return redirect('/mapel')->with('error', 'Data Gagal Ditambahkan');
		}
	}
	
	public function update(Request $request)
	{
		$rule = [
			'id_mapel'=>'required|string',
			'mapel'=>'required|string',
			'jadwal'=>'required|string',
		];
		$this->validate($request, $rule);
		
		$input = $request->all();
		
		$mapel = \App\Mapel::find($input['id_mapel']);
		$mapel->mapel 		= $input['mapel'];
		$mapel->jadwal 		= $input['jadwal'];
		$status = $mapel->update();
		
		if ($status) {
			return redirect('/mapel')->with('success', 'Data Berhasil Diubah');
		} else {
			return redirect('/mapel')->with('error', 'Data Berhasil Diubah');
		}
	}
	
	public function destroy(Request $request, $id_mapel)
	{
		$mapel = \App\Mapel::find($id_mapel);
		$status = $mapel->delete();
		
		if ($status) {
			return redirect('/mapel')->with('success', 'Data berhasil dihapus');
		} else {
			return redirect('/mapel')->with('error', 'Data gagal dihapus');
		}
	}
	
	function action(Request $request)
    {
		if($request->ajax()) {
			$output = '';
			$query = $request->get('query');
		
			if($query != '') {
				$data = \App\Mapel::where('id_mapel', 'like', '%'.$query.'%')
				->orWhere('mapel', 'like', '%'.$query.'%')
				->orWhere('jadwal', 'like', '%'.$query.'%')
				->orderBy('id_mapel')
				->get();
			}
			else {
				$data = DB::table('tmapel')
				->orderBy('id_mapel')
				->get();
			}
			$total_row = $data->count();
			if($total_row > 0) {
				foreach($data as $row) {
					$output .= '
						<tr>
							<td>'.$row->id_mapel.'</td>
							<td>'.$row->mapel.'</td>
							<td>'.$row->jadwal.'</td>
							<td>
								<center><a data-toggle="modal" data-id_mapel="'.$row->id_mapel.'" data-mapel="'.$row->mapel.'" data-jadwal="'.$row->jadwal.'" title="Add this item" class="open-EditMapel btn btn-primary" href="#addMapelDialog">Edit</a></center>
							</td>
							<td>
								<form action = "'.url('/mapel', $row->id_mapel) .'" method = "post">
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
