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
                'uraian_penugasan' => 'min_length[5]|max_length[100]'
            ];
        }

        $error = [
            'file' => [
                'max_size' => "Ukuran file terlalu besar (Max 2MB)",
                'mime_in' => "Tipe file dokuemntasi surat salah"
            ],
        ];

        $input = $this->validate($rules, $error);

        if (!$input) {
            $msg = $this->validator;
            return redirect()->to(base_url('dokumentasi_surat_masuk'))->with('error', $msg->listErrors());
        } else {
            $scan_surat_masuk = $this->request->getFile('file');
            $scan_surat_masuk->move('uploads/dokumentasi');
            $tenggat_penugasan = date('Y-m-d', strtotime($this->request->getPost('tenggat_d'))) . " " . date('H:i:s', strtotime($this->request->getPost('tenggat_t')));

            if ($petugas != "") {
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

    public function tambah_penugasan($id)
    {
        $tenggat_penugasan = date('Y-m-d', strtotime($this->request->getPost('tenggat_d'))) . " " . date('H:i:s', strtotime($this->request->getPost('tenggat_t')));
        $this->surat_masuk->update($id, [
            'uraian_penugasan' => $this->request->getPost('uraian_penugasan'),
            'petugas' => $this->request->getPost('petugas'),
            'status' => 'Dalam proses',
            'tenggat_penugasan' => $tenggat_penugasan
        ]);

        return redirect()->to(base_url('data_surat_masuk'))->with('success', 'Penugasan berhasil dilakukan');
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
}
