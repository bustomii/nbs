<?php

namespace App\Controllers;

class Add extends BaseController
{

    function __construct()
    {
        helper('form');
        $this->session = session();
        $this->db = db_connect();
    }

    public function index()
    {
        $bidang = $this->request->getPost('bidang');
        $posisi = $this->request->getPost('posisi');

        $get_start = $this->db->transStart();
        $data = [
            'bidang' => $bidang,
            'posisi' => $posisi,
        ];

        $this->db->table('kpi')->insert($data);

        $last_id = $this->db->insertID();

        $get_end = $this->db->transComplete();

        if ($get_start && $get_end) {
            session()->setFlashData('success', 'Silahkan Masukan Key Performance Indicator');
            return redirect()->to(base_url('/add/kpi/' . $last_id));
        } else {
            session()->setFlashData('danger', 'Failed');
            return redirect()->to(base_url('/'));
        }
    }

    public function kpi($id)
    {
        $kpi = $this->request->getPost('kpi');
        $bobot = $this->request->getPost('bobot');
        $target = $this->request->getPost('target');

        if ($kpi != NULL) {
            $get_start = $this->db->transStart();
            $data = [
                'key_performance_indicator' => $kpi,
                'bobot'                     => $bobot,
                'target'                    => $target,
                'id_kpi'                    => $id
            ];
            $this->db->table('kpi_meta')->insert($data);

            $get_end = $this->db->transComplete();
            if ($get_start && $get_end) {
                session()->setFlashData('success', 'Berhasil Menambahkan Key Performance Indicator');
                return redirect()->to(base_url('/add/kpi/' . $id));
            } else {
                session()->setFlashData('danger', 'Failed');
                return redirect()->to(base_url('/add/kpi/' . $id));
            }
        }

        $kpi = $this->db->query("select * FROM kpi_meta WHERE id_kpi = '" . $id . "'")->getResult();

        $active = 'home';
        return view('apps/kpi_meta', [
            'active' => $active,
            'kpi'    => $kpi,
            'id'     => $id,
        ]);
    }
}
