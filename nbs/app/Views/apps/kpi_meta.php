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
                            <h5><i class="icon fas fa-info"></i> Silahkan Pilih Data Karyawan dan Memasukan Realisasi Akhir Tahun</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <?= form_open_multipart(base_url('/add/kpi/' . $id)); ?>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Key Performance Indicator</label>
                                <label class="col-sm-2 col-form-label">Bobot</label>
                                <label class="col-sm-2 col-form-label">Target</label>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <input type="text" name="kpi" id="kpi" class="form-control" placeholder="Enter ..." required>
                                </div>
                                <div class="col-sm-2">
                                    <input type="number" name="bobot" id="bobot" class="form-control" placeholder="Enter ..." required>
                                </div>
                                <div class="col-sm-2">
                                    <input type="number" name="target" id="target" class="form-control" placeholder="Enter ..." required>
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" name="submit" class="btn btn-info"> Tambah KPI</button>
                                </div>
                            </div>
                            <?= form_close() ?>
                            <div class="modal-footer">
                                <button title="delete" onclick="hapusid('<?= $id ?>')" type="button" class="btn btn-danger"></span> Batal </button>
                                <a href="<?= base_url() ?>"><button type="submit" name="submit" class="btn btn-success"> Selesai</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="20px">NO</th>
                                                <th>KPI</th>
                                                <th style="text-align: center">BOBOT</th>
                                                <th style="text-align: center">TARGET</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($kpi as $d) { ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td>
                                                        <?= $d->key_performance_indicator ?>
                                                    </td>
                                                    <td style="text-align: center">
                                                        <?= $d->bobot ?>
                                                    </td>
                                                    <td style="text-align: center">
                                                        <?= $d->target ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th width="20px">NO</th>
                                                <th>KPI</th>
                                                <th style="text-align: center">BOBOT</th>
                                                <th style="text-align: center">TARGET</th>
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
<script language="javascript">
    function hapusid(hapusid) {
        if (confirm("Yakin Menghapus KPI")) {
            window.location.href = '/delete/' + hapusid;
            return true;
        }
    }
</script>
<?= $this->endSection(); ?>