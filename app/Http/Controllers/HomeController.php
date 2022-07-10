<?php

namespace App\Http\Controllers;

use App\PengajuanCuti;
use App\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dt = Carbon::now();
        $todayDate = $dt->translatedFormat('j F Y h:i:s a');
        $pegawai = User::all();
        $pengajuanCuti = PengajuanCuti::all();
        return view('layouts.home', compact('todayDate', 'pengajuanCuti', 'pegawai'));
    }
}
