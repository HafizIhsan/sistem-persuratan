<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_JenisSuratLainnya;
use App\Models\M_Pengguna;
use App\Models\M_SuratLainnya;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SuratLainnyaController extends BaseController
{
    protected $surat_lainnya;

    public function __construct()
    {
        if (session()->get('id_role') != 1) {
            echo 'Access denied';
            exit;
        }

        $this->surat_lainnya = new M_SuratLainnya();
        $this->pengguna = new M_Pengguna();
        $this->jenis_surat_lainnya = new M_JenisSuratLainnya();
    }

    public function index()
    {
        $data['surat_lainnya'] = $this->surat_lainnya->findAll();
        $data['jenis_surat_lainnya'] = $this->jenis_surat_lainnya->findAll();
        $data['pengguna'] = $this->pengguna->findAll();

        return view('admin/data_surat_lainnya', $data);
    }

    public function delete($id)
    {
        $data = $this->surat_lainnya->get_surat_lainnya($id);
        $this->surat_lainnya->delete($id);
        unlink("uploads/dokumentasi/" . $data[0]['SCAN_SURAT']);

        return redirect()->to(base_url('data_surat_lainnya'))->with('success', 'Data surat berhasil dihapus');
    }

    public function edit($id)
    {
        helper(['form', 'url']);

        $rules = [
            'nomor_surat' => 'required|min_length[5]|max_length[50]',
            'pihak_1' => 'required|string|min_length[5]|max_length[100]',
            'pihak_2' => 'required|min_length[5]|max_length[100]',
            'tentang' => 'required|min_length[5]',
        ];

        $error = [
            'nomor_surat' => [
                'min_length' => "Nomor surat setidaknya terdiri dari 5 karakter",
                'max_length' => "Nomor surat terlalu panjang",
            ],
            'pihak_1' => [
                'min_length' => "Nama pihak pertama setidaknya terdiri dari 5 karakter",
                'max_length' => "Nama pihak pertama terlalu panjang",
            ],
            'pihak_2' => [
                'min_length' => "Nama pihak kedua setidaknya terdiri dari 5 karakter",
                'max_length' => "Nama pihak kedua terlalu panjang",
            ],
            'tentang' => [
                'min_length' => "Tentang setidaknya terdiri dari 5 karakter"
            ],
        ];

        $input = $this->validate($rules, $error);
        if (!$input) {
            $msg = $this->validator;
            return redirect()->to(base_url('data_surat_lainnya'))->with('error', ['error' => $msg->listErrors(), 'id' => $id]);
        } else {
            if (strpos($this->request->getPost('nomor_surat'), '/') === false || strpos($this->request->getPost('nomor_surat'), '-') === false) {
                return redirect()->to(base_url('data_surat_lainnya'))->with('error', ['error' => 'Penulisan nomor surat salah', 'id' => $id]);
            }
            $this->surat_lainnya->update($id, [
                'nomor_surat' => $this->request->getPost('nomor_surat'),
                'pihak_1' => $this->request->getPost('pihak_1'),
                'pihak_2' => $this->request->getPost('pihak_2'),
                'tentang' => $this->request->getPost('tentang')
            ]);

            return redirect()->to(base_url('data_surat_lainnya'))->with('success', 'Data berhasil diubah');
        }
    }

    public function surat_lainnya_excel()
    {
        $dataSuratLainnya = $this->surat_lainnya->findAll();
        $dataJenisSuratLainnya = $this->jenis_surat_lainnya->findAll();

        if (count($dataSuratLainnya) == 0) {
            return redirect()->to(base_url('data_surat_lainnya'))->with('error', 'Tidak ada data surat');
        }

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nomor Surat')
            ->setCellValue('B1', 'Jenis Surat')
            ->setCellValue('C1', 'Pihak Pertama')
            ->setCellValue('D1', 'Pihak Kedua')
            ->setCellValue('E1', 'Tentang')
            ->setCellValue('F1', 'Dokumentasi');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($dataSuratLainnya as $data) {
            for ($i = 0; $i < count($dataJenisSuratLainnya); $i++) {
                if ($dataJenisSuratLainnya[$i]['ID_JENIS_SURAT_LAINNYA'] == $data['ID_JENIS_SURAT_LAINNYA']) {
                    $jenis_surat = $dataJenisSuratLainnya[$i]['JENIS_SURAT'];
                };
            }

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['NOMOR_SURAT'])
                ->setCellValue('B' . $column, $jenis_surat)
                ->setCellValue('C' . $column, $data['PIHAK_1'])
                ->setCellValue('D' . $column, $data['PIHAK_2'])
                ->setCellValue('E' . $column, $data['TENTANG'])
                ->setCellValue('F' . $column, base_url('uploads/dokumentasi/' . $data['SCAN_SURAT']));
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Surat Lainnya (exported at' . date("d-m-Y") . ')';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    function create()
    {
        helper(['form', 'url']);
        $rules = [
            'nomor_surat' => 'required|min_length[5]|max_length[30]',
            'pihak_1' => 'required|min_length[5]|max_length[50]',
            'pihak_2' => 'required|min_length[5]|max_length[50]',
            'tentang' => 'required|min_length[5]',
            'file' => 'uploaded[file]|mime_in[file,application/pdf]|max_size[file,1024]',
        ];

        $error = [
            'nomor_surat' => [
                'min_length' => "Nomor surat setidaknya terdiri dari 5 karakter",
                'max_length' => "Nomor surat terlalu panjang",
            ],
            'pihak_1' => [
                'min_length' => "Nama pihak pertama setidaknya terdiri dari 5 karakter",
                'max_length' => "Nama pihak pertama terlalu panjang",
            ],
            'pihak_2' => [
                'min_length' => "Nama pihak kedua setidaknya terdiri dari 5 karakter",
                'max_length' => "Nama pihak kedua terlalu panjang",
            ],
            'tentang' => [
                'min_length' => "Tentang setidaknya terdiri dari 5 karakter"
            ],
            'file' => [
                'max_size' => "Ukuran file terlalu besar (Max 1 MB)",
                'mime_in' => "Format file harus pdf"
            ],
        ];

        $input = $this->validate($rules, $error);

        if (!$input) {
            $msg = $this->validator;
            return redirect()->to(base_url('dokumentasi_surat_lainnya'))->with('error', $msg->listErrors());
        } else {
            if (!(strpos($this->request->getPost('nomor_surat'), '/') >= 0 || strpos($this->request->getPost('nomor_surat'), '-') >= NULL)) {
                return redirect()->to(base_url('dokumentasi_surat_masuk'))->with('error', 'Penulisan nomor surat salah');
            }
            $scan_surat_lainnya = $this->request->getFile('file');
            $scan_surat_lainnya->move('uploads/dokumentasi');

            $this->surat_lainnya->insert([
                'id_pengguna' => session()->get('id_pengguna'),
                'id_jenis_surat_lainnya' => $this->request->getPost('id_jenis_surat_lainnya'),
                'nomor_surat' => $this->request->getPost('nomor_surat'),
                'pihak_1' => $this->request->getPost('pihak_1'),
                'pihak_2' => $this->request->getPost('pihak_2'),
                'tentang' => $this->request->getPost('tentang'),
                'scan_surat' =>  $scan_surat_lainnya->getName(),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            return redirect()->to(base_url('dokumentasi_surat_lainnya'))->with('success', 'Dokumentasi surat lainnya berhasil dilakukan');
        }
    }
}
