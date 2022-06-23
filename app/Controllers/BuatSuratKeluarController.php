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
        if (session()->get('id_role') != 1) {
            echo 'Access denied';
            exit;
        }
        $data['klasifikasi_surat'] = $this->klasifikasi_surat->findAll();
        return view('admin/buat_surat_keluar', $data);
    }

    public function index_p()
    {
        if (session()->get('id_role') != 2) {
            echo 'Access denied';
            exit;
        }
        $data['klasifikasi_surat'] = $this->klasifikasi_surat->findAll();
        return view('pegawai/buat_surat_keluar_p', $data);
    }

    function create()
    {
        $klasifikasi = $this->klasifikasi_surat->findAll();
        $role = session()->get('id_role');

        helper(['form', 'url']);
        $rules = [
            'nomor_surat_keluar' => 'required|min_length[5]|max_length[50]',
            'penerima' => 'required|min_length[5]|max_length[50]',
            'ttd' => 'required|min_length[5]|max_length[50]',
            'perihal' => 'required|min_length[5]',
            'file' => 'uploaded[file]|mime_in[file,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword]|max_size[file,1024]'
        ];

        $error = [
            'file' => [
                'max_size' => "Ukuran file terlalu besar (Max 1 MB)",
                'mime_in' => "Format file harus doc atau docx"
            ],
        ];

        $input = $this->validate($rules, $error);

        if (!$input) {
            $msg = $this->validator;
            if ($role == 1) {
                return redirect()->to(base_url('buat_surat_keluar'))->with('error', $msg->listErrors());
            } else if ($role == 2) {
                return redirect()->to(base_url('buat_surat_keluar_p'))->with('error', $msg->listErrors());
            }
        } else {
            $kl = $this->request->getPost('klasifikasi_surat');
            $kode = substr($kl, 0, 2);
            $no = substr($kl, 4);
            foreach ($klasifikasi as $klasifikasi) {
                if ($kode == $klasifikasi['KODE'] && $no == $klasifikasi['NOMOR_KLASIFIKASI']) {
                    $id_klasifikasi_surat = $klasifikasi['ID_KLASIFIKASI_SURAT'];
                }
            }

            $sub_no = $this->request->getPost('sub_no_urut');
            $no_urut =  $this->request->getPost('no_urut');

            if ($this->surat_keluar->cek_nomor_urut_surat_keluar($no_urut, $sub_no)) {
                if ($role == 1) {
                    return redirect()->to(base_url('buat_surat_keluar'))->with('error', 'Nomor urut surat sudah digunakan. Silahkan coba lagi.');
                } else if ($role == 2) {
                    return redirect()->to(base_url('buat_surat_keluar_p'))->with('error', 'Nomor urut surat sudah digunakan. Silahkan coba lagi.');
                }
            }
            $draft_surat_keluar = $this->request->getFile('file');
            $draft_surat_keluar->move('uploads/draft');

            if ($sub_no == "") {
                $this->surat_keluar->insert([
                    'id_pengguna' => session()->get('id_pengguna'),
                    'id_klasifikasi_surat' => $id_klasifikasi_surat,
                    'no_urut' => $no_urut,
                    'tanggal_surat' => date('Y-m-d', strtotime($this->request->getPost('tanggal_surat'))),
                    'nomor_surat_keluar' => $this->request->getPost('nomor_surat_keluar'),
                    'penerima' => $this->request->getPost('penerima'),
                    'ttd' => $this->request->getPost('ttd'),
                    'perihal' => $this->request->getPost('perihal'),
                    'draft_surat_keluar' =>  $draft_surat_keluar->getName(),
                    'status' =>  'Pengajuan',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            } else {
                $this->surat_keluar->insert([
                    'id_pengguna' => session()->get('id_pengguna'),
                    'id_klasifikasi_surat' => $id_klasifikasi_surat,
                    'no_urut' => $no_urut,
                    'sub_no_urut' => $this->request->getPost('sub_no_urut'),
                    'tanggal_surat' => date('Y-m-d', strtotime($this->request->getPost('tanggal_surat'))),
                    'nomor_surat_keluar' => $this->request->getPost('nomor_surat_keluar'),
                    'penerima' => $this->request->getPost('penerima'),
                    'ttd' => $this->request->getPost('ttd'),
                    'perihal' => $this->request->getPost('perihal'),
                    'draft_surat_keluar' =>  $draft_surat_keluar->getName(),
                    'status' =>  'Pengajuan',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }

            $message =
                "<p>Anda telah membuat surat keluar dengan</p><br>" .
                "<p>Nomor surat : " . $this->request->getPost('nomor_surat_keluar') . "</p>" .
                "<p>Tanggal surat : " . date('d-m-Y', strtotime($this->request->getPost('tanggal_surat'))) . "</p>" .
                "<p>Ditujukan kepada : " . $this->request->getPost('penerima') . "</p>" .
                "<p>TTD : " . $this->request->getPost('ttd') . "</p>" .
                "<p>Perihal : " . $this->request->getPost('perihal') . "</p>" .
                "<p>Detail selengkapnya : " . base_url() . "</p>" .

                "<br><p style='font-weight:bold;'>Penting: Segera lakukan scan terhadap surat keluar setelah selesai di tanda tangani dan upload hasil scan surat di " . base_url() . "</p>";
            $to = session()->get('email');
            $title = 'Dokumentasi Surat Keluar Anda';
            $this->_sendEmail($to, $title, $message);

            if ($role == 1) {
                return redirect()->to(base_url('buat_surat_keluar'))->with('success', 'Surat keluar berhasil dibuat');
            } else if ($role == 2) {
                return redirect()->to(base_url('buat_surat_keluar_p'))->with('success', 'Surat keluar berhasil dibuat');
            }
        }
    }

    private function _sendEmail($to, $title, $message)
    {
        $email = \Config\Services::email();
        $email->setFrom('spersuratan@gmail.com', 'Sistem Persuratan : Biro Humas & Hukum BPS');
        $email->setTo($to);
        $email->setSubject($title);
        $email->setMessage($message);

        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }
}
