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
                            <?= form_open_multipart(base_url('/menghitung/' . $id)); ?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Key Performance Indicator</label>
                                <label class="col-sm-2 col-form-label">Realisasi Akhir Tahun</label>
                            </div>
                            <?php foreach ($kpi as $k) { ?>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <input readonly type="hidden" name="id_kpi[]" id="id_kpi" class="form-control" value="<?= $k->id_meta ?>" required>
                                        <input readonly type="hidden" name="bobot[]" id="bobot" class="form-control" value="<?= $k->bobot ?>" required>
                                        <input readonly type="hidden" name="target[]" id="target" class="form-control" value="<?= $k->target ?>" required>
                                        <input readonly type="text" name="kpi[]" id="kpi" class="form-control" value="<?= $k->key_performance_indicator ?>" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="number" max="<?= $k->target ?>" name="realisasi[]" id="realisasi" class="form-control" placeholder="Enter ..." required>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label">Karyawan</label>
                                <div class="col-sm-3">
                                    <select name="id_karyawan" class="form-control" required>
                                        <option value="" disabled selected>Pilih Karyawan</option>
                                        <?php foreach ($select as $s) { ?>
                                            <option name="id_karyawan" value="<?= $s->id_karyawan ?>"><?= $s->nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" name="submit" class="btn btn-info"> Hitung</button>
                                </div>
                            </div>
                            <?= form_close() ?>
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
                                                <th>KARYAWAN</th>
                                                <th style="text-align: center">NILAI AKHIR</th>
                                                <th style="text-align: center">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($hasil as $h) { ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $h->nama ?></td>
                                                    <td style="text-align: center"><?= $h->nilai_akhir ?></td>
                                                    <td style="text-align: center">
                                                        <button title="delete" style="width:50px" onclick="hapusid('<?= $h->id ?>')" type="button" class="btn btn-outline-danger"><span class="fas fa-trash-alt"></span> </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th width="20px">NO</th>
                                                <th>KARYAWAN</th>
                                                <th style="text-align: center">NILAI AKHIR</th>
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

<script language="javascript">
    function hapusid(hapusid) {
        if (confirm("Yakin Menghapus Hasil")) {
            window.location.href = '/delete/<?= $id ?>/' + hapusid;
            return true;
        }
    }
</script>

<?= $this->endSection(); ?>