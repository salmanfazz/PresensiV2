<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	 
	public function auth(Request $request)
    {
        if (Auth::user()->role == 1) {
			$data['presensi'] = \App\Presensi::count();
			$data['kelas'] = \App\Kelas::count();
			$data['jenjang'] = \App\Jenjang::count();
			$data['mapel'] = \App\Mapel::count();
			$data['tutor'] = \App\Tutor::count();
			return view('admin', $data);
		}else{
			$data['presensi'] = \App\Presensi::count();
			return view('home', $data);
		}
    }
	
    public function index()
    {
        $data['presensi'] = \App\Presensi::count();
		return view('home', $data);
    }
	
	public function admin()
	{
		$data['presensi'] = \App\Presensi::count();
		$data['kelas'] = \App\Kelas::count();
		$data['jenjang'] = \App\Jenjang::count();
		$data['mapel'] = \App\Mapel::count();
		$data['tutor'] = \App\Tutor::count();
		return view('admin', $data);
	}
}
