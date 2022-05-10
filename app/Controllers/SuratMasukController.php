<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Pengguna;
use App\Models\M_SuratMasuk;

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
            $img->move('uploads');
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
}
