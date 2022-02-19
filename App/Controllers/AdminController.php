<?php

namespace Albet\Asmvc\Controllers;

use Albet\Asmvc\Core\Flash;
use Albet\Asmvc\Core\Requests;
use Albet\Asmvc\Core\Validator;
use Albet\Asmvc\Models\Admin;
use Albet\Asmvc\Models\Level;
use Albet\Asmvc\Models\Pelanggan;
use Albet\Asmvc\Models\Pengunaan;
use Albet\Asmvc\Models\Tarif;

class AdminController
{
    public function index()
    {
        return view('Admin.dashboard', [
            'nama' => Admin::user()->nama_admin,
            'level' => Admin::user()->level->nama_level
        ]);
    }

    public function akun()
    {
        return view('Admin.akun.index', [
            'accounts' => Admin::with('level')->get()
        ]);
    }

    public function vBuatAkun()
    {
        return view('Admin.akun.create', [
            'levels' => Level::get()
        ]);
    }

    public function buatAkun(Requests $requests)
    {
        $validate = Validator::make([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required|min:8',
            'conpass' => 'required|same:password',
            'level' => 'required'
        ], [
            'nama:required' => 'Gak punya nama kah?',
            'username:required' => 'Nama panggilan? masa ga ada juga?',
            'password:required' => 'Kasih lah password. Mau buat akun atau apa?',
            'password:min' => 'Nih password pendek amat. Tar di hack nangis.',
            'conpass:required' => 'Isi juga ini oi',
            'conpass:same' => 'Samain dong bambang sama password lu',
            'level:required' => 'Kalau ga lu kasih level. Gimana caranya gw indentifikasi akun lu?'
        ]);

        if (!$validate) {
            return redirect('/admin/akun/buat', false);
        }

        Admin::create([
            'nama_admin' => $requests->input('nama'),
            'username' => $requests->input('username'),
            'password' => mkPass(PASSWORD_BCRYPT, $requests->input('password')),
            'id_level' => $requests->input('level')
        ]);

        Flash::flash('pesan', 'Account created successfully!');

        return redirect('/admin/akun', false);
    }

    public function vEditAkun($id)
    {
        $fetch = Admin::with('level')->where('id_admin', $id)->first();

        if (!$fetch) {
            return ReturnError(404);
        }

        return view('Admin.akun.edit', [
            'akun' => $fetch,
            'levels' => Level::get()
        ]);
    }

    public function editAkun(Requests $requests, $id)
    {
        $fetch = Admin::with('level')->where('id_admin', $id)->first();

        if (!$fetch) {
            return ReturnError(404);
        }

        $rules = [
            'nama' => 'required',
            'username' => 'required',
            'level' => 'required'
        ];

        $message = [
            'nama:required' => 'Gak punya nama kah?',
            'username:required' => 'Nama panggilan? masa ga ada juga?',
            'level:required' => 'Kalau ga lu kasih level. Gimana caranya gw indentifikasi akun lu?'
        ];

        $data = [
            'nama_admin' => $requests->input('nama'),
            'username' => $requests->input('username'),
            'id_level' => $requests->input('level')
        ];

        if (request()->input('password')) {
            $rules[] = [
                'password' => 'required|min:8',
                'conpass' => 'required|same:password'
            ];
            $message[] = [
                'password:required' => 'Kasih lah password. Mau buat akun atau apa?',
                'password:min' => 'Nih password pendek amat. Tar di hack nangis.',
                'conpass:required' => 'Isi juga ini oi',
                'conpass:same' => 'Samain dong bambang sama password lu'
            ];
            $data[] = [
                'password' => mkPass(PASSWORD_BCRYPT, $requests->input('password'))
            ];
        }

        $validate = Validator::make($rules, $message);

        if (!$validate) {
            return redirect('/admin/akun/edit/' . $fetch->id_admin, false);
        }

        $fetch->update($data);

        Flash::flash('pesan', 'Account edited successfully!');

        return redirect('/admin/akun', false);
    }

    public function delAkun($id)
    {
        $fetch = Admin::with('level')->where('id_admin', $id)->first();

        if (!$fetch) {
            return ReturnError(404);
        }

        $fetch->delete();

        Flash::flash('pesan', 'Account deleted successfully!');

        return redirect('/admin/akun', false);
    }

    public function pelanggan()
    {
        $customers = Pelanggan::with('tarif')->get();
        return view('Admin.pelanggan.index', compact('customers'));
    }

    public function vAddPelanggan()
    {
        $tarifs = Tarif::get();
        return view('Admin.pelanggan.create', compact('tarifs'));
    }

    public function addPelanggan(Requests $requests)
    {
        $validate = Validator::make([
            'username' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'password' => 'required|min:8',
            'conpass' => 'required|same:password',
            'tarif' => 'required',
            'no_kwh' => 'required|numeric'
        ]);

        if (!$validate) {
            return redirect('/admin/pelanggan/buat', false);
        }

        Pelanggan::create([
            'username' => $requests->input('username'),
            'nama_pelanggan' => $requests->input('nama'),
            'alamat' => $requests->input('alamat'),
            'password' => mkPass(PASSWORD_BCRYPT, $requests->input('password')),
            'id_tarif' => $requests->input('tarif'),
            'no_kwh' => $requests->input('no_kwh')
        ]);

        Flash::flash('pesan', 'Customers added');
        return redirect('/admin/pelanggan', false);
    }

    public function vEditPelanggan($id)
    {
        $fetch = Pelanggan::with('tarif')->where('id_pelanggan', $id)->first();

        if (!$fetch) {
            return ReturnError(404);
        }

        return view('Admin.pelanggan.edit', [
            'customer' => $fetch,
            'tarifs' => Tarif::get()
        ]);
    }

    public function editPelanggan(Requests $requests, $id)
    {
        $fetch = Pelanggan::where('id_pelanggan', $id)->first();

        if (!$fetch) {
            return ReturnError(404);
        }
        $data = [
            'username' => $requests->input('username'),
            'nama_pelanggan' => $requests->input('nama'),
            'alamat' => $requests->input('alamat'),
            'id_tarif' => $requests->input('tarif'),
            'no_kwh' => $requests->input('no_kwh')
        ];
        $rules = [
            'username' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'tarif' => 'required',
            'no_kwh' => 'required|numeric'
        ];
        if ($requests->input('password')) {
            $rules[] = [
                'password' => 'required|min:8',
                'conpass' => 'required|same:password'
            ];
            $data[] = [
                'password' => mkPass(PASSWORD_BCRYPT, $requests->input('password'))
            ];
        }
        $validate = Validator::make($rules);
        $fetch->update($data);

        if (!$validate) {
            return redirect('/admin/pelanggan/edit/' . $id, false);
        }

        Flash::flash('pesan', 'Customer updated.');
        return redirect('/admin/pelanggan', false);
    }

    public function delPelanggan($id)
    {
        $fetch = Pelanggan::where('id_pelanggan', $id)->first();

        if (!$fetch) {
            return ReturnError(404);
        }

        $fetch->delete();

        Flash::flash('pesan', 'Customer deleted.');
        return redirect('/admin/pelanggan', false);
    }

    public function tarif()
    {
        $tarifs = Tarif::get();
        return view('Admin.tarif.index', compact('tarifs'));
    }

    public function vAddTarif()
    {
        return view('Admin.tarif.create');
    }

    public function addTarif(Requests $requests)
    {
        $validate = Validator::make([
            'daya' => 'required|numeric',
            'tarifperkwh' => 'required|numeric'
        ]);

        if (!$validate) {
            return redirect('/admin/tarif/buat', false);
        }

        Tarif::create([
            'daya' => $requests->input('daya'),
            'tarifperkwh' => $requests->input('tarifperkwh')
        ]);

        Flash::flash('pesan', 'Price added.');

        return redirect('/admin/tarif', false);
    }

    public function vEditTarif($id)
    {
        $fetch = Tarif::where('id_tarif', $id)->first();

        if (!$fetch) return ReturnError(404);

        return view('/admin/tarif/edit', ['tarif' => $fetch]);
    }

    public function editTarif(Requests $requests, $id)
    {
        $fetch = Tarif::where('id_tarif', $id)->first();

        if (!$fetch) return ReturnError(404);

        $validate = Validator::make([
            'daya' => 'required|numeric',
            'tarifperkwh' => 'required|numeric'
        ]);

        if (!$validate) {
            return redirect('/admin/tarif/edit/' . $id, false);
        }

        $fetch->update([
            'daya' => $requests->input('daya'),
            'tarifperkwh' => $requests->input('tarifperkwh')
        ]);

        Flash::flash('pesan', 'Price edited.');

        return redirect('/admin/tarif', false);
    }

    public function delTarif($id)
    {
        $fetch = Tarif::where('id_tarif', $id)->first();

        if (!$fetch) return ReturnError(404);

        $fetch->delete();

        Flash::flash('pesan', 'Price deleted.');

        return redirect('/admin/tarif', false);
    }

    public function pengunaan()
    {
        $usages = Pengunaan::with('pelanggan')->get();

        return view('Admin.pengunaan.index', compact('usages'));
    }

    public function vAddPengunaan()
    {
        $customers = Pelanggan::get();

        return view('Admin.pengunaan.create', compact('customers'));
    }

    public function addPengunaan(Requests $requests)
    {
        $validate = Validator::make([
            'pelanggan' => 'required',
            'bulan' => 'required',
            'meter_awal' => 'required|numeric',
            'meter_akhir' => 'required|numeric',
        ]);

        if (!$validate || $requests->input('pelanggan') == '') {
            Flash::flash('pesan', 'Customer invalid.');
            return redirect('/admin/pengunaan/buat', false);
        }

        $split = explode('-', $requests->input('bulan'));


        Pengunaan::create([
            'id_pelanggan' => $requests->input('pelanggan'),
            'tahun' => $split[0],
            'bulan' => $split[1],
            'meter_awal' => $requests->input('meter_awal'),
            'meter_akhir' => $requests->input('meter_akhir')
        ]);

        Flash::flash('pesan', 'Usage added.');
        return redirect('/admin/pengunaan', false);
    }

    public function vEditPengunaan($id)
    {
        $fetch = Pengunaan::with('pelanggan')->where('id_penggunaan', $id)->first();

        if (!$fetch) return ReturnError(404);

        $array = [$fetch->tahun, $fetch->bulan];
        $combined = implode('-', $array);

        return view('Admin.pengunaan.edit', [
            'usage' => $fetch,
            'date' => $combined,
            'customers' => Pelanggan::get()
        ]);
    }

    public function editPengunaan(Requests $requests, $id)
    {
        $fetch = Pengunaan::with('pelanggan')->where('id_penggunaan', $id)->first();

        if (!$fetch) return ReturnError(404);

        $validate = Validator::make([
            'pelanggan' => 'required',
            'bulan' => 'required',
            'meter_awal' => 'required|numeric',
            'meter_akhir' => 'required|numeric',
        ]);

        if (!$validate) {
            return redirect('/admin/pengunaan/edit/' . $id, false);
        }

        $split = explode('-', $requests->input('bulan'));

        $fetch->update([
            'id_pelanggan' => $requests->input('pelanggan'),
            'tahun' => $split[0],
            'bulan' => $split[1],
            'meter_awal' => $requests->input('meter_awal'),
            'meter_akhir' => $requests->input('meter_akhir')
        ]);

        Flash::flash('pesan', 'Usage edited.');
        return redirect('/admin/pengunaan', false);
    }

    public function delPengunaan($id)
    {
        $fetch = Pengunaan::with('pelanggan')->where('id_penggunaan', $id)->first();

        if (!$fetch) return ReturnError(404);

        $fetch->delete();

        Flash::flash('pesan', 'Usage deleted.');
        return redirect('/admin/pengunaan', false);
    }
}
