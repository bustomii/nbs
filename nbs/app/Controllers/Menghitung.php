<?php

namespace App\Controllers;

class Menghitung extends BaseController
{

    function __construct()
    {
        helper('form');
        $this->session = session();
        $this->db = db_connect();
    }

    public function index($id)
    {
        $karyawan = $this->request->getPost('id_karyawan');
        $realisasi = $this->request->getPost('realisasi');
        $bobot = $this->request->getPost('bobot');
        $target = $this->request->getPost('target');
        $id_kpi = $this->request->getPost('id_kpi');

        $select = $this->db->query("select * FROM karyawan a LEFT JOIN kpi b ON a.posisi = b.posisi WHERE b.id = '" . $id . "' ")->getResult();

        $kpi = $this->db->query("select b.id as id_meta, b.key_performance_indicator, b.bobot, b.target FROM kpi a LEFT JOIN kpi_meta b ON a.id = b.id_kpi WHERE a.id = '" . $id . "'")->getResult();

        if ($id_kpi != NULL) {
            $cek = $this->db->query("select * FROM h_akhir WHERE id_kpi = '" . $id . "' AND id_karyawan = '" . $karyawan . "'")->getResult();

            if (!empty($cek)) {
                $get_start = $this->db->transStart();
                session()->setFlashData('success', 'KPI Karyawan Sudah di Hitung');
            } else {

                $h_akhir = [
                    'id_kpi'        => $id,
                    'nilai_akhir'   => 0,
                    'id_karyawan'   => $karyawan

                ];
                $this->db->table('h_akhir')->insert($h_akhir);
                $last_id = $this->db->insertID();

                for ($x = 0; $x <  count($realisasi); $x++) {
                    $score = $realisasi[$x] / $target[$x] * 100;
                    $score_akhir = $score * $bobot[$x] / 100;

                    $data = [
                        'realisasi'      => $realisasi[$x],
                        'id_hasil_akhir' => $last_id,
                        'id_kpi_meta'    => $id_kpi[$x],
                        'score'          => $score,
                        'score_akhir'    => $score_akhir
                    ];
                    $this->db->table('hasil')->insert($data);
                    $akhir[] = $score_akhir;
                }
                $update = $this->db->table('h_akhir');
                $update->set('nilai_akhir', array_sum($akhir));
                $update->where('id_karyawan', $karyawan);
                $update->where('id_kpi', $id);
                $update->update();
                // print_r($akhir);

                $get_end = $this->db->transComplete();

                if ($get_start && $get_end) {
                    session()->setFlashData('success', 'Berhasil Menghitung KPI');
                } else {
                    session()->setFlashData('danger', 'Gagal Menghitung KPI' . $karyawan);
                }
            }
            // print_r($cek);
        }

        $hasil = $this->db->query("select * FROM h_akhir a LEFT JOIN karyawan b ON a.id_karyawan = b.id_karyawan WHERE a.id_kpi = '" . $id . "' ")->getResult();

        $active = 'home';
        return view('apps/menghitung', [
            'active' => $active,
            'select' => $select,
            'kpi'    => $kpi,
            'id'     => $id,
            'hasil'  => $hasil
        ]);
    }
}
