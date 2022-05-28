<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_KlasifikasiSurat;
use App\Models\M_KategoriKlasifikasi;

class KlasifikasiSuratController extends BaseController
{
    protected $klasifikasi_surat;

    function __construct()
    {
        $this->klasifikasi_surat = new M_KlasifikasiSurat();
        $this->kategori_klasifikasi = new M_KategoriKlasifikasi();
    }

    public function index()
    {
        if (session()->get('id_role') != 1) {
            echo 'Access denied';
            exit;
        }

        $data['klasifikasi_surat'] = $this->klasifikasi_surat->findAll();
        $data['kategori_klasifikasi'] = $this->kategori_klasifikasi->findAll();

        $kategori  = array_column($data['kategori_klasifikasi'], 'KATEGORI');
        array_multisort($kategori, SORT_ASC, $data['kategori_klasifikasi']);

        return view('admin/data_klasifikasi_surat', $data);
    }

    public function klasifikasi_surat()
    {

        if (session()->get('id_role') != 2) {
            echo 'Access denied';
            exit;
        }
        $data['klasifikasi_surat'] = $this->klasifikasi_surat->findAll();
        $data['kategori_klasifikasi'] = $this->kategori_klasifikasi->findAll();

        $kategori  = array_column($data['kategori_klasifikasi'], 'KATEGORI');
        array_multisort($kategori, SORT_ASC, $data['kategori_klasifikasi']);

        return view('pegawai/klasifikasi_surat', $data);
    }

    public function create()
    {
        helper(['form', 'url']);

        $rules = [
            'kode' => 'required|max_length[3]',
            'nomor_klasifikasi' => 'required|numeric|min_length[3]|max_length[4]',
            'keterangan' => 'required|min_length[5]'
        ];

        $error = [
            'nomor_klasifikasi' => [
                'min_length' => "Nomor klasifikasi setidaknya terdiri dari 3 angka",
                'max_length' => "Nomor klasifikasi terlalu panjang",
                'numeric' => "Nomor klasifikasi harus berupa angka"
            ],
            'keterangan' => [
                'min_length' => "Keterangan setidaknya terdiri dari 5 karakter"
            ],
        ];

        $input = $this->validate($rules, $error);

        if (!$input) {
            $msg = $this->validator;
            return redirect()->to(base_url('data_klasifikasi_surat'))->with('error', $msg->listErrors());
        } else {
            $this->klasifikasi_surat->insert([
                'kode' => $this->request->getPost('kode'),
                'nomor_klasifikasi' => $this->request->getPost('nomor_klasifikasi'),
                'keterangan' => $this->request->getPost('keterangan'),
            ]);

            return redirect('admin/data_klasifikasi_surat')->with('success', 'Data berhasil ditambahkan');
        }
    }

    public function edit($id)
    {
        helper(['form', 'url']);

        $rules = [
            'keterangan' => 'required|min_length[5]'
        ];

        $error = [
            'keterangan' => [
                'min_length' => "Keterangan setidaknya terdiri dari 5 karakter"
            ],
        ];

        $input = $this->validate($rules, $error);

        if (!$input) {
            $msg = $this->validator;
            return redirect()->to(base_url('data_klasifikasi_surat'))->with('error_edit', ['error' => $msg->listErrors(), 'id' => $id]);
        } else {
            $this->klasifikasi_surat->update($id, [
                'keterangan' => $this->request->getPost('keterangan'),
            ]);

            return redirect('data_klasifikasi_surat')->with('success', 'Data berhasil diubah');
        }
    }

    public function delete($id)
    {
        $this->klasifikasi_surat->delete($id);

        return redirect('admin/data_klasifikasi_surat')->with('success', 'Data berhasis dihapus');
    }
}
