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
        $this->surat_masuk = new M_SuratMasuk();
        $this->pengguna = new M_Pengguna();
    }

    function index()
    {
        $data['surat_masuk'] = $this->surat_masuk->findAll();
        $data['pengguna'] = $this->pengguna->findAll();

        return view('admin/data_surat_masuk', $data);
    }

    function upload()
    {
        helper(['form', 'url']);
        $database = \Config\Database::connect();
        $db = $database->table('surat_masuk');
        $input = $this->validate([
            'file' => [
                'uploaded[file]',
                'mime_in[file,application/pdf]',
                'max_size[file,1024]',
            ]
        ]);

        if (!$input) {
            redirect()->to(base_url('dokumentasi_surat_masuk'))->with('error', 'Format file harus pdf');
        } else {
            $img = $this->request->getFile('file');
            $img->move('uploads/dokumentasi');
            $data = [
                'name' =>  $img->getName(),
                'type'  => $img->getClientMimeType()
            ];
            $save = $db->insert($data);
            redirect()->to(base_url('dokumentasi_surat_masuk'))->with('success', 'Dokumentasi surat masuk berhasil dilakukan');
        }
    }

    public function delete($id)
    {
        $this->surat_masuk->delete($id);

        return redirect()->to(base_url('data_surat_masuk'))->with('success', 'Data surat berhasil dihapus');
    }

    public function edit($id)
    {
        $this->surat_masuk->update($id, [
            'tanggal_terima' => $this->request->getPost('tanggal_terima'),
            'nomor_surat' => $this->request->getPost('nomor_surat'),
            'pengirim' => $this->request->getPost('pengirim'),
            'status' => $this->request->getPost('status'),
            'perihal' => $this->request->getPost('perihal')
        ]);

        return redirect()->to(base_url('data_surat_masuk'))->with('success', 'Data berhasil diubah');
    }

    public function surat_masuk_excel()
    {
        $dataSuratMasuk = $this->surat_masuk->findAll();
        $dataPengguna = $this->pengguna->findAll();

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
            ->setCellValue('I1', 'Dokumentasi');

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
                ->setCellValue('I' . $column, base_url('uploads/dokumentasi/' . $data['SCAN_SURAT_MASUK']));
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Surat Masuk (' . date("d-m-Y") . ')';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
