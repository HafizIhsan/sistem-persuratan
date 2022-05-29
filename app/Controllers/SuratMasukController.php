<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Pengguna;
use App\Models\M_SuratMasuk;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SuratMasukController extends BaseController
{
    protected $surat_masuk;

    function __construct()
    {
        if (session()->get('id_role') != 1) {
            echo 'Access denied';
            exit;
        }
        $this->surat_masuk = new M_SuratMasuk();
        $this->pengguna = new M_Pengguna();
    }

    function index()
    {
        $data['surat_masuk'] = $this->surat_masuk->findAll();
        $data['pengguna'] = $this->pengguna->findAll();
        $id_role = 1;
        $data['admin'] = array_filter($this->pengguna->findAll(), function ($value) use ($id_role) {
            return ($value["ID_ROLE"] == $id_role);
        });

        return view('admin/data_surat_masuk', $data);
    }

    function create()
    {
        $petugas = $this->request->getPost('petugas');
        helper(['form', 'url']);
        if ($petugas == "") {
            $rules = [
                'nomor_surat' => 'required|min_length[5]|max_length[30]',
                'instansi_pengirim' => 'required|min_length[5]|max_length[100]',
                'perihal' => 'required|min_length[5]',
                'file' => 'uploaded[file]|mime_in[file,application/pdf]|max_size[file,2048]',
            ];
        } else {
            $rules = [
                'nomor_surat' => 'required|min_length[5]|max_length[30]',
                'instansi_pengirim' => 'required|min_length[5]|max_length[100]',
                'perihal' => 'required|min_length[5]',
                'file' => 'uploaded[file]|mime_in[file,application/pdf]|max_size[file,2048]',
                'uraian_penugasan' => 'required|min_length[5]|max_length[100]'
            ];
        }

        $error = [
            'file' => [
                'max_size' => "Ukuran file terlalu besar (Max 2MB)",
                'mime_in' => "Format file harus pdf"
            ],
        ];

        $input = $this->validate($rules, $error);

        if (!$input) {
            $msg = $this->validator;
            return redirect()->to(base_url('dokumentasi_surat_masuk'))->with('error', $msg->listErrors());
        } else {
            if (strpos($this->request->getPost('nomor_surat'), '/') === false || strpos($this->request->getPost('nomor_surat'), '-') === false) {
                return redirect()->to(base_url('dokumentasi_surat_masuk'))->with('error', 'Penulisan nomor surat salah');
            }
            $scan_surat_masuk = $this->request->getFile('file');
            $scan_surat_masuk->move('uploads/dokumentasi');
            $tenggat_penugasan = date('Y-m-d', strtotime($this->request->getPost('tenggat_d'))) . " " . date('H:i:s', strtotime($this->request->getPost('tenggat_t')));

            if ($petugas != "" || $petugas != NULL) {
                $this->surat_masuk->insert([
                    'id_pengguna' => session()->get('id_pengguna'),
                    'nomor_surat_masuk' => $this->request->getPost('nomor_surat'),
                    'tanggal_terima' => date('Y-m-d', strtotime($this->request->getPost('tanggal_terima'))),
                    'instansi_pengirim' => $this->request->getPost('instansi_pengirim'),
                    'perihal' => $this->request->getPost('perihal'),
                    'scan_surat_masuk' =>  $scan_surat_masuk->getName(),
                    'uraian_penugasan' => $this->request->getPost('uraian_penugasan'),
                    'petugas' => $this->request->getPost('petugas'),
                    'status' => 'Dalam proses',
                    'tenggat_penugasan' => $tenggat_penugasan,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $data_petugas = $this->pengguna->getPengguna($petugas);
                $message =
                    "<p>Berikut penugasan surat masuk untuk anda yang harus segera ditindaklanjuti</p>" .
                    "<p>Nomor surat : " . $this->request->getPost('nomor_surat') . "</p>" .
                    "<p>Pengirim : " . $this->request->getPost('instansi_pengirim') . "</p>" .
                    "<p>Uraian penugasan : " . $this->request->getPost('uraian_penugasan') . "</p>" .
                    "<p>Tenggat penugasan : " . date('d-m-Y', strtotime($this->request->getPost('tenggat_d'))) . " " . date('H:i', strtotime($this->request->getPost('tenggat_t'))) . " WIB</p>" .
                    "<p>Detail selengkapnya : " . base_url() . "</p>" .
                    "<hr><p>Note: Segera ditindaklanjuti kemudian memperbaharui status penugasan di " . base_url() . "</p>";
                $to = $data_petugas[0]['EMAIL'];
                $title = 'Penugasan Surat Masuk';
                $this->_sendEmail($to, $title, $message);
            } else {
                $this->surat_masuk->insert([
                    'id_pengguna' => session()->get('id_pengguna'),
                    'nomor_surat_masuk' => $this->request->getPost('nomor_surat'),
                    'tanggal_terima' => date('Y-m-d', strtotime($this->request->getPost('tanggal_terima'))),
                    'instansi_pengirim' => $this->request->getPost('instansi_pengirim'),
                    'perihal' => $this->request->getPost('perihal'),
                    'scan_surat_masuk' =>  $scan_surat_masuk->getName(),
                    'status' => 'Belum ditugaskan',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }

            return redirect()->to(base_url('dokumentasi_surat_masuk'))->with('success', 'Dokumentasi surat masuk berhasil dilakukan');
        }
    }

    public function delete($id)
    {
        $data = $this->surat_masuk->get_surat_masuk($id);
        $this->surat_masuk->delete($id);
        unlink("uploads/dokumentasi/" . $data[0]['SCAN_SURAT_MASUK']);

        return redirect()->to(base_url('data_surat_masuk'))->with('success', 'Data surat berhasil dihapus');
    }

    public function edit($id)
    {
        helper(['form', 'url']);

        $rules = [
            'nomor_surat' => 'required|min_length[5]|max_length[30]',
            'pengirim' => 'required|min_length[5]|max_length[100]',
            'perihal' => 'required|min_length[5]'
        ];

        $error = [
            'nomor_surat' => [
                'min_length' => "Nomor surat setidaknya terdiri dari 5 karakter",
                'max_length' => "Nomor surat terlalu panjang",
            ],
            'pengirim' => [
                'min_length' => "Input pengirim setidaknya terdiri dari 5 karakter",
                'max_length' => "Input pengirim terlalu panjang",
            ],
            'perihal' => [
                'min_length' => "Input perihal setidaknya terdiri dari 5 karakter"
            ],
        ];

        $input = $this->validate($rules, $error);
        if (!$input) {
            $msg = $this->validator;
            return redirect()->to(base_url('data_surat_masuk'))->with('error', ['error' => $msg->listErrors(), 'id' => $id]);
        } else {
            if (strpos($this->request->getPost('nomor_surat'), '/') === false || strpos($this->request->getPost('nomor_surat'), '-') === false) {
                return redirect()->to(base_url('data_surat_masuk'))->with('error', ['error' => 'Penulisan nomor surat salah', 'id' => $id]);
            }
            $this->surat_masuk->update($id, [
                'tanggal_terima' => $this->request->getPost('tanggal_terima'),
                'nomor_surat_masuk' => $this->request->getPost('nomor_surat'),
                'instansi_pengirim' => $this->request->getPost('pengirim'),
                'perihal' => $this->request->getPost('perihal')
            ]);
            return redirect()->to(base_url('data_surat_masuk'))->with('success', 'Data berhasil diubah');
        }
    }

    public function tambah_penugasan($id)
    {
        $petugas = $this->request->getPost('petugas');
        $tenggat_penugasan = date('Y-m-d', strtotime($this->request->getPost('tenggat_d'))) . " " . date('H:i:s', strtotime($this->request->getPost('tenggat_t')));

        helper(['form', 'url']);

        $rules = [
            'uraian_penugasan' => 'required|min_length[10]'
        ];

        $error = [
            'uraian_penugasan' => [
                'min_length' => "Input uraian penugasan setidaknya terdiri dari 10 karakter",
            ],
        ];

        $input = $this->validate($rules, $error);

        if (!$input) {
            $msg = $this->validator;
            return redirect()->to(base_url('data_surat_masuk'))->with('error', $msg->listErrors());
        } else {
            $this->surat_masuk->update($id, [
                'uraian_penugasan' => $this->request->getPost('uraian_penugasan'),
                'petugas' => $this->request->getPost('petugas'),
                'status' => 'Dalam proses',
                'tenggat_penugasan' => $tenggat_penugasan
            ]);

            $data_petugas = $this->pengguna->getPengguna($petugas);
            $message =
                "<p>Berikut penugasan surat masuk untuk anda yang harus segera ditindaklanjuti</p>" .
                "<p>Nomor surat : " . $this->request->getPost('nomor_surat') . "</p>" .
                "<p>Pengirim : " . $this->request->getPost('instansi_pengirim') . "</p>" .
                "<p>Uraian penugasan : " . $this->request->getPost('uraian_penugasan') . "</p>" .
                "<p>Tenggat penugasan : " . date('d-m-Y', strtotime($this->request->getPost('tenggat_d'))) . " " . date('H:i', strtotime($this->request->getPost('tenggat_t'))) . " WIB</p>" .
                "<p>Detail selengkapnya : " . base_url() . "</p>" .
                "<hr><p>Note: Segera ditindaklanjuti kemudian memperbaharui status penugasan di " . base_url() . "</p>";
            $to = $data_petugas[0]['EMAIL'];
            $title = 'Penugasan Surat Masuk';
            $this->_sendEmail($to, $title, $message);

            return redirect()->to(base_url('data_surat_masuk'))->with('success', 'Penugasan berhasil dilakukan');
        }
    }

    public function surat_masuk_excel()
    {
        $dataPengguna = $this->pengguna->findAll();
        $tahun = $this->request->getPost('tahun');
        if ($tahun != 'Semua') {
            $dataSuratMasuk = $this->surat_masuk->get_surat_masuk_by_tahun($tahun);
        } else {
            $dataSuratMasuk = $this->surat_masuk->findAll();
        }

        if (count($dataSuratMasuk) == 0) {
            return redirect()->to(base_url('data_surat_masuk'))->with('error', 'Tidak ada data surat masuk');
        }

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nomor Surat')
            ->setCellValue('B1', 'Tanggal Terima')
            ->setCellValue('C1', 'Pengirim')
            ->setCellValue('D1', 'Perihal')
            ->setCellValue('E1', 'Status')
            ->setCellValue('F1', 'Petugas')
            ->setCellValue('G1', 'Uraian Penugasan')
            ->setCellValue('H1', 'Tenggat Penugasan')
            ->setCellValue('I1', 'Dokumentasi')
            ->setCellValue('J1', 'Created at');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($dataSuratMasuk as $data) {
            for ($i = 0; $i < count($dataPengguna); $i++) {
                if ($dataPengguna[$i]['ID_PENGGUNA'] == $data['PETUGAS']) {
                    $nama = $dataPengguna[$i]['NAMA'];
                };
            }

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['NOMOR_SURAT_MASUK'])
                ->setCellValue('B' . $column, date('d-m-Y', strtotime($data['TANGGAL_TERIMA'])))
                ->setCellValue('C' . $column, $data['INSTANSI_PENGIRIM'])
                ->setCellValue('D' . $column, $data['PERIHAL'])
                ->setCellValue('E' . $column, $data['STATUS'])
                ->setCellValue('F' . $column, $nama)
                ->setCellValue('G' . $column, $data['URAIAN_PENUGASAN'])
                ->setCellValue('H' . $column, date('d-m-Y H:i:s', strtotime($data['TENGGAT_PENUGASAN'])))
                ->setCellValue('I' . $column, base_url('uploads/dokumentasi/' . $data['SCAN_SURAT_MASUK']))
                ->setCellValue('J' . $column, date('d-m-Y H:i:s', strtotime($data['CREATED_AT'])));
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Surat Masuk ' . $tahun . ' (exported at ' . date("d-m-Y") . ')';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    function penugasan()
    {
        $id = session()->get('id_pengguna');
        $data['surat_masuk'] = $this->surat_masuk->get_surat_masuk_by_petugas($id, 'Dalam proses');
        return view('admin/penugasan_surat_masuk', $data);
    }

    function update_status($id)
    {
        $this->surat_masuk->update($id, [
            'status' => 'Selesai'
        ]);

        return redirect()->to(base_url('penugasan_surat_masuk'))->with('success', 'Status penugasan berhasil diubah');
    }

    private function _sendEmail($to, $title, $message)
    {
        $email = \Config\Services::email();
        $email->setFrom('persuratan.sistem@gmail.com', 'Sistem Persuratan : Biro Humas & Hukum BPS');
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
