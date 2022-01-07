<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class JenjangController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
	
    public function index() 
	{
		$data['jenjang'] = \App\Jenjang::orderBy('id_jenjang')
						->get();				
		return view('jenjang', $data);
	}
	public function store(Request $request)
	{
		$rule = [
			'jenjang'=>'required|string',
		];
		$this->validate($request, $rule);
		
		$input = $request->all();
		
		$jenjang = new \App\Jenjang;
		$jenjang->jenjang 		= $input['jenjang'];
		$status = $jenjang->save();
		
		if ($status) {
			return redirect('/jenjang')->with('success', 'Data Berhasil Ditambahkan');
		} else {
			return redirect('/jenjang')->with('error', 'Data Gagal Ditambahkan');
		}
	}
	
	public function update(Request $request)
	{
		$rule = [
			'id_jenjang'=>'required|string',
			'jenjang'=>'required|string',
		];
		$this->validate($request, $rule);
		
		$input = $request->all();
		
		$jenjang = \App\Jenjang::find($input['id_jenjang']);
		$jenjang->jenjang 		= $input['jenjang'];
		$status = $jenjang->update();
		
		if ($status) {
			return redirect('/jenjang')->with('success', 'Data Berhasil Diubah');
		} else {
			return redirect('/jenjang')->with('error', 'Data Berhasil Diubah');
		}
	}
	
	public function destroy(Request $request, $id_jenjang)
	{
		$jenjang = \App\Jenjang::find($id_jenjang);
		$status = $jenjang->delete();
		
		if ($status) {
			return redirect('/jenjang')->with('success', 'Data berhasil dihapus');
		} else {
			return redirect('/jenjang')->with('error', 'Data gagal dihapus');
		}
	}
	
	function action(Request $request)
    {
		if($request->ajax()) {
			$output = '';
			$query = $request->get('query');
		
			if($query != '') {
				$data = \App\Jenjang::where('id_jenjang', 'like', '%'.$query.'%')
				->orWhere('jenjang', 'like', '%'.$query.'%')
				->orWhere('id_jenjang', 'like', '%'.$query.'%')
				->orderBy('id_jenjang')
				->get();
			}
			else {
				$data = DB::table('tjenjang')
				->orderBy('id_jenjang')
				->get();
			}
			$total_row = $data->count();
			if($total_row > 0) {
				foreach($data as $row) {
					$output .= '
						<tr>
							<td>'.$row->id_jenjang.'</td>
							<td>'.$row->jenjang.'</td>
							<td>
								<center><a data-toggle="modal" data-id_jenjang="'.$row->id_jenjang.'" data-nama="'.$row->jenjang.'" data-id_jenjang="'.$row->id_jenjang.'" title="Add this item" class="open-EditJenjang btn btn-primary" href="#addJenjangDialog">Edit</a></center>
							</td>
							<td>
								<form action = "'.url('/jenjang', $row->id_jenjang) .'" method = "post">
								'.method_field('DELETE').'
								'.csrf_field().'
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
