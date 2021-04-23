<?php

namespace App\Controllers;

class Delete extends BaseController
{

    function __construct()
    {
        $this->session = session();
        $this->db = db_connect();
    }

    public function index($id, $id_hasil)
    {
        $this->db->query("delete FROM hasil WHERE id_hasil_akhir = '" . $id_hasil . "' ");
        $this->db->query("delete FROM h_akhir WHERE id = '" . $id_hasil . "' ");

        session()->setFlashData('success', 'Berhasil Menghapus');
        return redirect()->to(base_url('/menghitung/' . $id));
    }

    public function kpi($id)
    {
        $this->db->query("delete FROM kpi WHERE id = '" . $id . "' ");

        session()->setFlashData('success', 'Berhasil Menghapus');
        return redirect()->to(base_url('/'));
    }
}
