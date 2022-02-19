<?php

namespace Albet\Asmvc\Controllers;

use Albet\Asmvc\Core\Flash;
use Albet\Asmvc\Core\Requests;
use Albet\Asmvc\Core\Validator;
use Albet\Asmvc\Models\Admin;
use Albet\Asmvc\Models\Pembayaran;
use Albet\Asmvc\Models\Tagihan;

class PembayaranController
{

    private $url;

    public function __construct()
    {
        $this->url = Admin::user()->level->nama_level == 'admin' ? '/admin' : '/user';
    }

    public function index()
    {
        $payments = Pembayaran::with(['tagihan', 'pelanggan', 'admin'])->get();
        $url = $this->url;

        return view('Global.pembayaran.index', compact('payments', 'url'));
    }

    public function buat()
    {
        $url = $this->url;
        $bills = Tagihan::get();
        $admins = Admin::get();

        return view('Global.pembayaran.create', compact('url', 'bills', 'admins'));
    }

    public function prosesBuat(Requests $requests)
    {
        $validate = Validator::make([
            'tagihan' => 'required',
            'bulan' => 'required',
            'total_bayar' => 'required',
            'biaya_admin' => 'required',
            'admin' => 'required'
        ]);

        if (!$validate) {
            return redirect($this->url . '/pembayaran/buat', false);
        }

        $pelanggan = Tagihan::with('pelanggan')->where('id_tagihan', $requests->input('tagihan'))->first()->pelanggan->id_pelanggan;
        $bulan = explode('-', $requests->input('bulan'));
        $totalBayar = $requests->input('total_bayar') - $requests->input('biaya_admin');

        $data = [
            'id_tagihan' => $requests->input('tagihan'),
            'id_pelanggan' => $pelanggan,
            'bulan_bayar' => $bulan[1],
            'biaya_admin' => $requests->input('biaya_admin'),
            'total_bayar' => $totalBayar,
            'id_admin' => $requests->input('admin')
        ];

        if ($requests->input('tanggal_pembayaran')) $data['tanggal_pembayaran'] = $requests->input('tanggal_pembayaran');

        Pembayaran::create($data);

        Flash::flash('pesan', 'Payment added.');
        return redirect($this->url . '/pembayaran', false);
    }

    public function seeDetail($id)
    {
        $fetch = Pembayaran::where('id_pembayaran', $id)->first()->id_tagihan;
        $bill = Tagihan::where('id_tagihan', $fetch)->first();
        $url = $this->url;

        return view('Global.pembayaran.detail', compact('bill', 'url'));
    }

    public function edit($id)
    {
        $url = $this->url;
        $pembayaran = Pembayaran::with('tagihan', 'admin')->where('id_pembayaran', $id)->first();
        $bills = Tagihan::get();
        $admins = Admin::get();
        $date = explode(' ', $pembayaran->tanggal_pembayaran)[0];

        if (!$pembayaran) ReturnError(404);

        return view('Global.pembayaran.edit', compact('url', 'bills', 'admins', 'pembayaran', 'date'));
    }

    public function prosesEdit(Requests $requests, $id)
    {
        $url = $this->url;
        $pembayaran = Pembayaran::with('tagihan', 'admin')->where('id_pembayaran', $id)->first();
        if (!$pembayaran) ReturnError(404);

        $validate = Validator::make([
            'tagihan' => 'required',
            'bulan' => 'required',
            'total_bayar' => 'required',
            'biaya_admin' => 'required',
            'admin' => 'required'
        ]);

        if (!$validate) {
            return redirect($url . '/pembayaran/edit/' . $id, false);
        }

        $pelanggan = Tagihan::with('pelanggan')->where('id_tagihan', $requests->input('tagihan'))->first()->pelanggan->id_pelanggan;
        $bulan = explode('-', $requests->input('bulan'));
        $totalBayar = $requests->input('total_bayar') - $requests->input('biaya_admin');

        $data = [
            'id_tagihan' => $requests->input('tagihan'),
            'id_pelanggan' => $pelanggan,
            'bulan_bayar' => $bulan[1],
            'biaya_admin' => $requests->input('biaya_admin'),
            'total_bayar' => $totalBayar,
            'id_admin' => $requests->input('admin'),
            'tanggal_pembayaran' => $requests->input('tanggal_pembayaran')
        ];

        $pembayaran->update($data);

        Flash::flash('pesan', 'Payment edited.');
        return redirect($this->url . '/pembayaran', false);
    }

    public function delete($id)
    {
        $url = $this->url;
        $pembayaran = Pembayaran::with('tagihan', 'admin')->where('id_pembayaran', $id)->first();
        if (!$pembayaran) ReturnError(404);
        $pembayaran->delete();

        Flash::flash('pesan', 'Payment deleted.');
        return redirect($this->url . '/pembayaran', false);
    }
}
