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
        $this->surat_lainnya->delete($id);

        return redirect()->to(base_url('data_surat_lainnya'))->with('success', 'Data surat berhasil dihapus');
    }

    public function edit($id)
    {
        $this->surat_lainnya->update($id, [
            'pihak_1' => $this->request->getPost('pihak_1'),
            'pihak_2' => $this->request->getPost('pihak_2'),
            'tentang' => $this->request->getPost('tentang')
        ]);

        return redirect()->to(base_url('data_surat_lainnya'))->with('success', 'Data berhasil diubah');
    }

    public function surat_lainnya_excel()
    {
        $dataSuratLainnya = $this->surat_lainnya->findAll();
        $dataJenisSuratLainnya = $this->jenis_surat_lainnya->findAll();

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
        $fileName = 'Data Surat Lainnya (' . date("d-m-Y") . ')';

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
            'file' => 'uploaded[file]|mime_in[file,application/pdf]|max_size[file,2048]',
        ];

        $error = [
            'file' => [
                'max_size' => "Ukuran file terlalu besar (Max 2MB)",
            ],
        ];

        $input = $this->validate($rules, $error);

        if (!$input) {
            $msg = $this->validator;
            return redirect()->to(base_url('dokumentasi_surat_lainnya'))->with('error', $msg->listErrors());
        } else {
            $scan_surat_lainnya = $this->request->getFile('file');
            $scan_surat_lainnya->move('uploads/dokumentasi', $this->request->getPost('nomor_surat'));

            $this->surat_lainnya->insert([
                'id_pengguna' => session()->get('id_pengguna'),
                'id_jenis_surat_lainnya' => $this->request->getPost('id_jenis_surat_lainnya'),
                'nomor_surat' => $this->request->getPost('nomor_surat'),
                'pihak_1' => $this->request->getPost('pihak_1'),
                'pihak_2' => $this->request->getPost('pihak_2'),
                'tentang' => $this->request->getPost('tentang'),
                'scan_surat_lainnya' =>  $scan_surat_lainnya->getName(),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            return redirect()->to(base_url('dokumentasi_surat_lainnya'))->with('success', 'Dokumentasi surat lainnya berhasil dilakukan');
        }
    }
}
