<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_KlasifikasiSurat;
use App\Models\M_SuratKeluar;

class BuatSuratKeluarController extends BaseController
{
    protected $surat_keluar;

    function __construct()
    {
        $this->surat_keluar = new M_SuratKeluar();
        $this->klasifikasi_surat = new M_KlasifikasiSurat();
    }

    public function index()
    {
        $data['klasifikasi_surat'] = $this->klasifikasi_surat->findAll();
        $data['max_no_urut'] = $this->surat_keluar->getMaxNoUrut();
        return view('admin/buat_surat_keluar', $data);
    }

    public function index_p()
    {
        $data['klasifikasi_surat'] = $this->klasifikasi_surat->findAll();
        return view('pegawai/buat_surat_keluar_p', $data);
    }

    function create()
    {
        $klasifikasi = $this->klasifikasi_surat->findAll();

        helper(['form', 'url']);
        $rules = [
            'nomor_surat_keluar' => 'required|min_length[5]|max_length[30]',
            // 'pihak_1' => 'required|min_length[5]|max_length[50]',
            // 'pihak_2' => 'required|min_length[5]|max_length[50]',
            // 'tentang' => 'required|min_length[5]',
            'file' => 'uploaded[file]|mime_in[file,application/msword]|max_size[file,2048]',
        ];

        $error = [
            'file' => [
                'max_size' => "Ukuran file terlalu besar (Max 2MB)",
            ],
        ];

        $input = $this->validate($rules, $error);

        if (!$input) {
            $msg = $this->validator;
            return redirect()->to(base_url('buat_surat_keluar'))->with('error', $msg->listErrors());
        } else {
            $kl = $this->request->getPost('klasifikasi_surat');
            $kode = substr($kl, 0, 2);
            $no = substr($kl, 4);
            foreach ($klasifikasi as $klasifikasi) {
                if ($kode == $klasifikasi['KODE'] && $no == $klasifikasi['NOMOR_KLASIFIKASI']) {
                    $id_klasifikasi_surat = $klasifikasi['ID_KLASIFIKASI_SURAT'];
                }
            }

            $draft_surat_keluar = $this->request->getFile('file');
            $draft_surat_keluar->move('uploads/draft');

            $this->surat_keluar->insert([
                'id_pengguna' => session()->get('id_pengguna'),
                'id_klasifikasi_surat' => $id_klasifikasi_surat,
                'no_urut' => $this->request->getPost('no_urut'),
                'tanggal_surat' => date('Y-m-d', strtotime($this->request->getPost('tanggal_surat'))),
                'nomor_surat_keluar' => $this->request->getPost('nomor_surat_keluar'),
                'penerima' => $this->request->getPost('penerima'),
                'ttd' => $this->request->getPost('ttd'),
                'perihal' => $this->request->getPost('tentang'),
                'draft_surat_keluar' =>  $draft_surat_keluar->getName(),
                'status' =>  'Pengajuan',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            return redirect()->to(base_url('buat_surat_keluar'))->with('success', 'Surat keluar berhasil dibuat');
        }
    }
}
