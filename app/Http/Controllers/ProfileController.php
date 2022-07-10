<?php

namespace App\Http\Controllers;

use App\Divisi;
use App\Jabatan;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data user
        $divisi = Divisi::all();
        $jabatan = Jabatan::all();
        $user = Auth::user();
        return view('usermanagement.profile', compact('user', 'divisi', 'jabatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //get user dengan relasi pegawai
        $user = User::with('pegawai')->find(Auth::id());;

        return response()->json([
            'status' => 200,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        //user id
        $emp_id = $request->emp_id;
        $user = User::find($emp_id);

        //validator
        $request->validate([
            'name'                      => 'required',
            'email'                     => ['required', 'unique:users,email,' . $emp_id],
            'tempat_lahir'              => 'required',
            'tanggal_lahir'             => 'required',
            'jenis_kelamin'             => 'required',

        ], [
            'name.required'                      => 'nama Pegawai harus diisi',
            'email.required'                     => 'Email Pegawai harus diisi',
            'nik.required'                       => 'NIK harus diisi',
            'tempat_lahir.required'              => 'tempat lahir harus diisi',
            'tanggal_lahir.required'             => 'tanggal lahir harus diisi',
            'jenis_kelamin.required'             => 'jenis kelamin harus diisi',
        ]);

        //calculate usia
        $tanggal_lahir = Carbon::parse($request['tanggal_lahir']);
        $usia = $tanggal_lahir->age;


        //update data
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->usia = $usia;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;

        $user->update();

        return redirect()->back()->with('success', 'Data user Berhasil Diubah');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePersonal(Request $request)
    {
        //user id
        $per_id = $request->per_id;
        $user = User::find($per_id);

        //update data pegawai
        $user->pegawai()->update([
            'status_keluarga'           => $request->status_keluarga,
            'pendidikan'                => $request->pendidikan,
            'jurusan'                   => $request->jurusan,
            'nik_ktp'                   => $request->nik_ktp,
            'no_bpjs_kesehatan'         => $request->no_bpjs_kesehatan,
            'no_bpjs_ketenagakerjaan'   => $request->no_bpjs_ketenagakerjaan,
            'no_rek'                    => $request->no_rek,
            'npwp'                      => $request->npwp,
            'ukuran_baju'               => $request->ukuran_baju,
            'ukuran_sepatu'             => $request->ukuran_sepatu,
        ]);

        return redirect()->back()->with('success', 'Data personal Berhasil Diubah');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateKantor(Request $request)
    {
        //user id
        $kan_id = $request->kan_id;
        $user = User::find($kan_id);

        //update data kantor
        $user->pegawai()->update([
            'sk'                        => $request->sk,
            'segmen'                    => $request->segmen,
            'no_inhealth'               => $request->no_inhealth,
            'darat_laut_lokasi'         => $request->darat_laut_lokasi,
            'gol_skala_tht'             => $request->gol_skala_tht,
            'skala_tht'                 => $request->skala_tht,
            'gol_skala_phdp'            => $request->gol_skala_phdp,
            'gol_phdp'                  => $request->gol_phdp,
            'gol_skala_gaji'            => $request->gol_skala_gaji,
            'gol_gaji'                  => $request->gol_gaji,
            'golongan'                  => $request->golongan,
            'pangkat'                   => $request->pangkat,
        ]);

        return redirect()->back()->with('success', 'Data Kantor Berhasil Diubah');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFotoPegawai(Request $request, $id)
    {
        //user id
        $user = User::find($id);

        //update foto profile
        if ($request->hasFile('foto')) {

            $lokasi = 'fotoPegawai/' . $user->pegawai->foto;
            if (File::exists($lokasi)) {
                File::delete($lokasi);
            }
            $request->file('foto')->move('fotoPegawai/', $request->file('foto')->getClientoriginalName());
            $user->pegawai->foto = $request->file('foto')->getClientOriginalName();
            $user->pegawai->update();
        }

        return redirect()->back()->with('success', 'Foto Profile Berhasil Diubah');
    }
}
