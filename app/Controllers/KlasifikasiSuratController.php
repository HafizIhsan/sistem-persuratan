<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_KlasifikasiSurat;
use App\Models\M_KategoriKlasifikasi;

class KlasifikasiSuratController extends BaseController
{
    protected $klasifikasi_surat;

    public $output = [
        'sukses'    => false,
        'pesan'     => '',
        'data'      => []
    ];

    function __construct()
    {
        $this->klasifikasi_surat = new M_KlasifikasiSurat();
        $this->kategori_klasifikasi = new M_KategoriKlasifikasi();
    }

    public function index()
    {
        $data['klasifikasi_surat'] = $this->klasifikasi_surat->findAll();
        $data['kategori_klasifikasi'] = $this->kategori_klasifikasi->findAll();

        $kategori  = array_column($data['kategori_klasifikasi'], 'KATEGORI');
        array_multisort($kategori, SORT_ASC, $data['kategori_klasifikasi']);

        return view('admin/data_klasifikasi_surat', $data);
    }

    public function klasifikasi_surat()
    {
        $data['klasifikasi_surat'] = $this->klasifikasi_surat->findAll();
        $data['kategori_klasifikasi'] = $this->kategori_klasifikasi->findAll();

        $kategori  = array_column($data['kategori_klasifikasi'], 'KATEGORI');
        array_multisort($kategori, SORT_ASC, $data['kategori_klasifikasi']);

        return view('pegawai/klasifikasi_surat', $data);
    }

    // public function kelola_klasifikasi()
    // {
    //     $data['klasifikasi_surat'] = $this->klasifikasi_surat->findAll();
    //     $data['kategori_klasifikasi'] = $this->kategori_klasifikasi->findAll();
    //     return view('admin/kelola_klasifikasi_surat', $data);
    // }

    public function create()
    {
        $this->klasifikasi_surat->insert([
            'kode' => $this->request->getPost('kode'),
            'nomor_klasifikasi' => $this->request->getPost('nomor_klasifikasi'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        return redirect('admin/data_klasifikasi_surat')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {

        $this->klasifikasi_surat->update($id, [
            'kode' => $this->request->getPost('kode'),
            'nomor_klasifikasi' => $this->request->getPost('nomor_klasifikasi'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        return redirect('data_klasifikasi_surat')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        $this->klasifikasi_surat->delete($id);

        return redirect('admin/data_klasifikasi_surat')->with('success', 'Data berhasis dihapus');
    }
}
