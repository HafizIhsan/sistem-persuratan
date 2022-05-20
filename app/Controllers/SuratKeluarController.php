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

    public function check_nomor_surat_availability()
    {
        $requestBody = json_decode($this->request->getBody());

        $nomor_surat = $requestBody->nomor_surat;

        if ('post' === $this->request->getMethod() && $nomor_surat) {
            $model = new M_SuratKeluar();

            $data = $model->getSuratKeluar($nomor_surat);

            $result = $model->get_nomor_surat_keluar($nomor_surat);

            if ($result === true) {
                echo '<small id="klasifikasiHelpBlock" class="form-text text-success">Nomor surat ditemukan</small>';
                echo "<input type='text' class='form-control' name='id_surat_keluar' id='id_surat_keluar' value=" . $data[0]['ID_SURAT_KELUAR'] . " hidden>";
            } else {
                echo '<small id="klasifikasiHelpBlock" class="form-text text-danger">Nomor surat tidak ditemukan</small>';
            }
        }
    }

    public function update_dokumentasi()
    {
        helper(['form', 'url']);
        $rules = [
            'nomor_surat_keluar' => 'required|min_length[5]|max_length[30]',
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
            return redirect()->to(base_url('dokumentasi_surat_keluar'))->with('error', $msg->listErrors());
        } else {
            $dokumentasi_surat_keluar = $this->request->getFile('file');
            $dokumentasi_surat_keluar->move('uploads/dokumentasi');

            $id = $this->request->getPost('id_surat_keluar');
            $this->surat_keluar->update($id, [
                'status' => $this->request->getPost('status'),
                'scan_surat_keluar' => $dokumentasi_surat_keluar->getName()
            ]);
        }
        return redirect()->to(base_url('dokumentasi_surat_keluar'))->with('success', 'Dokumentasi surat keluar berhasil ditambah');
    }

    public function check_tanggal_surat_availability()
    {
        $requestBody = json_decode($this->request->getBody());

        $tanggal_surat = $requestBody->tanggal_surat;

        if ('post' === $this->request->getMethod() && $tanggal_surat) {
            $model = new M_SuratKeluar();

            $data = $model->get_no_urut_akhir($tanggal_surat);

            $now = date('Y-m-d');
            $tgl = date('Y-m-d', strtotime($tanggal_surat));

            $result = $model->get_tanggal_surat_keluar($tanggal_surat);

            if ($data['max_no_urut'] != NULL) {
                if ($result === true) {
                    if ($tgl == $now) {
                        echo "<input type='text' value='" . ($data['max_no_urut'] + 1) . "' id='no_urut' name='no_urut' hidden>";
                        echo "<input type='text' value='' id='sub_no_urut' name='sub_no_urut' hidden>";
                    } else {
                        echo "<input type='text' value='" . ($data['max_no_urut']) . "' id='no_urut' name='no_urut' hidden>";
                        echo "<input type='text' value='" . ($data['max_sub_no_urut'] + 1) . "' id='sub_no_urut' name='sub_no_urut' hidden>";
                    }
                } else {
                    if ($now == $tgl) {
                        echo "<input type='text' value='" . ($data['max_no_urut'] + 1) . "' id='no_urut' name='no_urut' hidden>";
                        echo "<input type='text' value='' id='sub_no_urut' name='sub_no_urut' hidden>";
                    } else {
                        echo "<input type='text' value='" . ($data['max_no_urut']) . "' id='no_urut' name='no_urut' hidden>";
                        echo "<input type='text' value='" . ($data['max_sub_no_urut'] + 1) . "' id='sub_no_urut' name='sub_no_urut' hidden>";
                    }
                }
            } else {
                echo "<input type='text' value='" . (($data['max_no_urut']) + 1) . "' id='no_urut' name='no_urut' hidden>";
                echo "<input type='text' value='' id='sub_no_urut' name='sub_no_urut' hidden>";
            }
        } else {
            echo '<span style="color:red;">Isi tanggal surat</span>';
        }
    }
}
