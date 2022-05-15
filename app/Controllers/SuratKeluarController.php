<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Pengguna;
use App\Models\M_SuratKeluar;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class SuratKeluarController extends BaseController
{
    protected $surat_keluar;

    function __construct()
    {
        $this->surat_keluar = new M_SuratKeluar();
        $this->pengguna = new M_Pengguna();
    }

    function index()
    {
        $data['surat_keluar'] = $this->surat_keluar->findAll();
        $data['pengguna'] = $this->pengguna->findAll();

        return view('admin/data_surat_keluar', $data);
    }

    public function delete($id)
    {
        $this->surat_keluar->delete($id);

        return redirect()->to(base_url('data_surat_keluar'))->with('success', 'Data surat berhasil dihapus');
    }

    public function edit($id)
    {
        $this->surat_keluar->update($id, [
            'penerima' => $this->request->getPost('penerima'),
            'ttd' => $this->request->getPost('ttd'),
            'perihal' => $this->request->getPost('perihal')
        ]);

        return redirect()->to(base_url('data_surat_keluar'))->with('success', 'Data berhasil diubah');
    }

    public function surat_keluar_excel()
    {
        $dataSuratKeluar = $this->surat_keluar->findAll();
        $dataPengguna = $this->pengguna->findAll();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nomor Surat')
            ->setCellValue('B1', 'Tanggal Surat')
            ->setCellValue('C1', 'Pembuat')
            ->setCellValue('D1', 'Penerima')
            ->setCellValue('E1', 'TTD')
            ->setCellValue('F1', 'Perihal')
            ->setCellValue('G1', 'Status')
            ->setCellValue('H1', 'Draft Final')
            ->setCellValue('I1', 'Dokumentasi');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($dataSuratKeluar as $data) {
            for ($i = 0; $i < count($dataPengguna); $i++) {
                if ($dataPengguna[$i]['ID_PENGGUNA'] == $data['ID_PENGGUNA']) {
                    $nama = $dataPengguna[$i]['NAMA'];
                };
            }

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['NOMOR_SURAT_KELUAR'])
                ->setCellValue('B' . $column, date('d-m-Y', strtotime($data['TANGGAL_SURAT'])))
                ->setCellValue('C' . $column, $nama)
                ->setCellValue('D' . $column, $data['PENERIMA'])
                ->setCellValue('E' . $column, $data['TTD'])
                ->setCellValue('F' . $column, $data['PERIHAL'])
                ->setCellValue('G' . $column, $data['STATUS'])
                ->setCellValue('H' . $column, base_url('uploads/draft/' . $data['DRAFT_SURAT_KELUAR']))
                ->setCellValue('I' . $column, base_url('uploads/dokumentasi/' . $data['SCAN_SURAT_KELUAR']));
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Surat Keluar (' . date("d-m-Y") . ')';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
