  <style>
      .center {
          text-align: center;
      }
  </style>
  <?php echo $this->session->flashdata('success'); ?>
  <div class="main-panel">
      <div class="content">
          <div class="page-inner">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-header">
                          <div class="d-flex align-items-center">
                              <h4 class="card-title"><?= $title ?></h4>
                              <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#usermodal">
                                  <i class="fa fa-plus"></i>
                                  Add Pembayaran
                              </button>
                          </div>
                      </div>

                      <div class="card-body">
                          <!-- Modal -->
                          <div class="table-responsive">
                              <table id="datatable" class="display table table-striped table-hover">
                                  <thead class="center">
                                      <tr>
                                          <th>NO</th>
                                          <th>Tahun Ajaran</th>
                                          <th>Golongan</th>
                                          <th>Sumbangan Awal</th>
                                          <th>Seragam</th>
                                          <th>Majalah</th>
                                          <th>Alat Tulis</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody class="center">
                                      <?php
                                        $no = 1;
                                        foreach ($pembayaran as $a) { ?>

                                          <tr>
                                              <td><?= $no++ ?></td>
                                              <td><?= $a->tahun ?></td>
                                              <td><?= $a->golongan ?></td>
                                              <td><?= rupiah($a->sumbangan_awal) ?></td>
                                              <td><?= rupiah($a->seragam) ?></td>
                                              <td><?= rupiah($a->majalah) ?></td>
                                              <td><?= rupiah($a->alat_tulis) ?></td>
                                              <td><?= $a->is_active ?></td>
                                              <td>
                                                  <div class="form-button-action">
                                                      <button data-target="#edit-apk<?= $a->id ?>" type="button" data-toggle="modal" title="Edit Data" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                          <i class="fa fa-edit"></i>
                                                      </button>
                                                      <button type="button" class="btn btn-link btn-danger btn-lg" data-toggle="modal" data-target="#deluser<?= $a->id ?>">
                                                          <i class="fa fa-times"></i>
                                                      </button>
                                                  </div>
                                              </td>
                                          </tr>
                                          <div class="modal fade" id="edit-apk<?= $a->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header no-bd">
                                                          <h5 class="modal-title">
                                                              <span class="fw-mediumbold">
                                                                  Edit</span>
                                                              <span class="fw-light">
                                                                  Tahun Ajaran
                                                              </span>
                                                          </h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">

                                                          <form action="<?= base_url('admin/update_pembayaran'); ?>" method="post" enctype="multipart/form-data">
                                                              <div class="row">
                                                                  <input hidden type="text" class="form-control" id="id" name="id" placeholder="id" value="<?= $a->id ?>">
                                                                  <div class="col-md-12 ">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Tahun Ajaran</label>
                                                                          <div class="col-sm-12 kosong">
                                                                              <select class="form-control" name="id_tahun" id="id_tahun">
                                                                                  <option value="">Pilih Tahun Ajaran</option>
                                                                                  <?php
                                                                                    foreach ($tahun_ajaran as $b) { ?>
                                                                                      <option <?= ($b->id == $a->id_tahun ? 'selected=""' : '') ?> value="<?= $b->id; ?>"><?= $b->tahun; ?></option>
                                                                                  <?php } ?>
                                                                              </select>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-md-12 ">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Golongan</label>
                                                                          <div class="col-sm-12 kosong">
                                                                              <select class="form-control" name="golongan" id="golongan">
                                                                                  <option value="">Pilih Golongan</option>
                                                                                  <?php
                                                                                    foreach ($gol as $b) { ?>
                                                                                      <option <?= ($b == $a->golongan ? 'selected=""' : '') ?> value="<?= $b; ?>"><?= $b; ?></option>
                                                                                  <?php } ?>
                                                                              </select>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-md-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Sumbangan Awal</label>
                                                                          <input type="text" class="form-control" id="sumbangan_awal" name="sumbangan_awal" placeholder="Rp." value="<?= $a->sumbangan_awal ?>">
                                                                          <?= form_error('sumbangan_awal', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-md-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Seragam</label>
                                                                          <input type="text" class="form-control" id="seragam" name="seragam" placeholder="Rp." value="<?= $a->seragam ?>">
                                                                          <?= form_error('seragam', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-md-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Majalah</label>
                                                                          <input type="text" class="form-control" id="majalah" name="majalah" placeholder="Rp." value="<?= $a->majalah ?>">
                                                                          <?= form_error('majalah', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-md-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Alat Tulis</label>
                                                                          <input type="text" class="form-control" id="alat_tulis" name="alat_tulis" placeholder="Rp." value="<?= $a->alat_tulis ?>">
                                                                          <?= form_error('alat_tulis', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-md-12 ">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Active</label>
                                                                          <div class="col-sm-12 kosong">
                                                                              <select class="form-control" name="is_active" id="is_active">
                                                                                  <option value=""></option>
                                                                                  <?php
                                                                                    foreach ($act as $b) { ?>
                                                                                      <option <?= ($b == $a->is_active ? 'selected=""' : '') ?> value="<?= $b; ?>"><?= $b; ?></option>
                                                                                  <?php } ?>
                                                                              </select>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <div class="modal-footer no-bd">
                                                                  <button type="submit" id="addRowButton" class="btn btn-primary">Edit</button>
                                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                              </div>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="modal fade" id="deluser<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="addNewDonaturLabel">Hapus Pembayaran</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <p>Anda yakin ingin menghapus <?= $a->tahun ?></p>
                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          <a href="<?= base_url('admin/delete_pembayaran?id=') ?><?= $a->id ?>" class="btn btn-primary">Hapus</a>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>

                                      <?php } ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="modal fade" id="usermodal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header no-bd">
                  <h5 class="modal-title">
                      <span class="fw-mediumbold">
                          Tahun Ajaran</span>
                      <span class="fw-light">
                          Add
                      </span>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <!-- <p class="small">Create a new row using this form, make sure you fill them all</p> -->
                  <form class="pegawai" method="post" action="<?= base_url('admin/insert_pembayaran'); ?>" enctype="multipart/form-data">
                      <div class="row">
                          <div class="col-md-12 ">
                              <div class="form-group form-group-default">
                                  <label>Tahun Ajaran</label>
                                  <div class="col-sm-12 kosong">
                                      <select class="form-control" name="id_tahun" id="id_tahun">
                                          <option value="">Pilih Tahun Ajaran</option>
                                          <?php
                                            foreach ($tahun_ajaran as $a) { ?>
                                              <option value="<?= $a->id; ?>"><?= $a->tahun; ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-12 ">
                              <div class="form-group form-group-default">
                                  <label>Golongan</label>
                                  <div class="col-sm-12 kosong">
                                      <select class="form-control" name="golongan" id="golongan">
                                          <option value="">Pilih Golongan</option>
                                          <option value="A">A</option>
                                          <option value="B">B</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group form-group-default">
                                  <label>Sumbangan Awal</label>
                                  <input type="text" class="form-control" id="sumbangan_awal" name="sumbangan_awal" placeholder="Rp." value="<?= set_value('sumbangan_awal'); ?>">
                                  <?= form_error('sumbangan_awal', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group form-group-default">
                                  <label>Seragam</label>
                                  <input type="text" class="form-control" id="seragam" name="seragam" placeholder="Rp." value="<?= set_value('seragam'); ?>">
                                  <?= form_error('seragam', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group form-group-default">
                                  <label>Majalah</label>
                                  <input type="text" class="form-control" id="majalah" name="majalah" placeholder="Rp." value="<?= set_value('majalah'); ?>">
                                  <?= form_error('majalah', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group form-group-default">
                                  <label>Alat Tulis</label>
                                  <input type="text" class="form-control" id="alat_tulis" name="alat_tulis" placeholder="Rp." value="<?= set_value('alat_tulis'); ?>">
                                  <?= form_error('alat_tulis', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-md-12 ">
                              <div class="form-group form-group-default">
                                  <label>Active</label>
                                  <div class="col-sm-12 kosong">
                                      <select class="form-control" name="is_active" id="is_active">
                                          <option value=""></option>
                                          <option value="Y">Y</option>
                                          <option value="N">N</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer no-bd">
                          <button type="submit" id="addRowButton" class="btn btn-primary">Add</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                  </form>
              </div>

          </div>
      </div>
  </div>


  <script>
      $(document).ready(function() {
          $(' #datatable').DataTable();
      });
  </script>