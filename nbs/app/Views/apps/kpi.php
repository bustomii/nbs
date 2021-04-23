<?= $this->extend('menu/footer'); ?>
<?= $this->section('content'); ?>
<!-- Main content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- content message -->
                <!-- warning -->
                <div class="col-12">
                    <?php if (session()->getFlashData('warning')) { ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?= session()->getFlashData('warning') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div><?php } ?>

                    <!-- success -->
                    <?php if (session()->getFlashData('success')) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashData('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div><?php } ?>

                    <!-- danger -->
                    <?php if (session()->getFlashData('danger')) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashData('danger') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div><?php } ?>
                </div>
                <!-- end message -->
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h5><i class="icon fas fa-info"></i> Data KPI, Jika belum ada data anda dapat menambahkannya dengan menekan tombol Tambah dibawah, atau dapat langsung menghitung KPI jika data sudah ada</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="row">
                            <div class="card-body">
                                <button data-toggle="modal" data-target="#tambah" title="add" class="btn btn-success"><span class="fas fa-plus"></span> Tambah Data</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="20px">NO</th>
                                                <th>BIDANG</th>
                                                <th>POSISI PEKERJAAN</th>
                                                <th>KPI</th>
                                                <th style="text-align: center">BOBOT</th>
                                                <th style="text-align: center">TARGET</th>
                                                <th style="text-align: center">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($data as $d) { ?>
                                                <tr>
                                                    <td style="text-align: right"><?= $no++ . '.' ?></td>
                                                    <td><?= $d['bidang'] ?></td>
                                                    <td><?= $d['posisi'] ?></td>
                                                    <td><?php $no_ = 1;
                                                        foreach ($d['kpi'] as $kpi) {
                                                            echo $no_++ . '. ' . $kpi->key_performance_indicator . '<br/>';
                                                        } ?></td>
                                                    <td style="text-align: center">
                                                        <?php $no_ = 1;
                                                        foreach ($d['kpi'] as $kpi) {
                                                            echo $kpi->bobot . '<br />';
                                                        } ?>
                                                    </td>
                                                    <td style="text-align: center">
                                                        <?php $no_ = 1;
                                                        foreach ($d['kpi'] as $kpi) {
                                                            echo $kpi->target . '<br />';
                                                        } ?>
                                                    </td>
                                                    <td style="text-align: center">
                                                        <a href='/menghitung/<?= $d['id'] ?>'><button title="menghitung" style="width:130px" onclick="menghitung('<?= $d['id'] ?>')" type="button" class="btn btn-outline-info"><span class="fas fa-pen"></span> Menghitung</button></a>
                                                        <button title="delete" style="width:50px" onclick="hapusid('<?= $d['id'] ?>')" type="button" class="btn btn-outline-danger"><span class="fas fa-trash-alt"></span> </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th width="20px">NO</th>
                                                <th>BIDANG</th>
                                                <th>POSISI PEKERJAAN</th>
                                                <th>KPI</th>
                                                <th style="text-align: center">BOBOT</th>
                                                <th style="text-align: center">TARGET</th>
                                                <th style="text-align: center">ACTION</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </section>
</div>

<?= form_open_multipart(base_url('/add')); ?>
<div class=" modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Data KPI</h4>
            </div>
            <div class="modal-body center">
                <div class="form-group row">
                    <label for="kelas" class="col-sm-3 col-form-label">Bidang</label>
                    <div class="col-sm-8">
                        <input type="text" name="bidang" id="bidang" class="form-control" placeholder="Enter ..." required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kelas" class="col-sm-3 col-form-label">Posisi Pekerjaan</label>
                    <div class="col-sm-8">
                        <input type="text" name="posisi" id="posisi" class="form-control" placeholder="Enter ..." required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                    <button type="submit" name="submit" class="btn btn-info"> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>
<!-- Tutup Modal Edit -->

<script language="javascript">
    function hapusid(hapusid) {
        if (confirm("Yakin Menghapus KPI")) {
            window.location.href = '/delete/' + hapusid;
            return true;
        }
    }
</script>
<?= $this->endSection(); ?>