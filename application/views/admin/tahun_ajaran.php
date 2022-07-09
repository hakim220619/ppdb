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
                                  Add Tahun Ajaran
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
                                          <th>Status</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody class="center">
                                      <?php
                                        $no = 1;
                                        foreach ($tahun_ajaran as $a) { ?>

                                          <tr>
                                              <td><?= $no++ ?></td>
                                              <td><?= $a->tahun ?></td>
                                              <td><?= $a->status ?></td>
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

                                                          <form action="<?= base_url('admin/update_tahunajaran'); ?>" method="post" enctype="multipart/form-data">
                                                              <div class="row">
                                                                  <input hidden type="text" class="form-control" id="id" name="id" placeholder="id" value="<?= $a->id ?>">
                                                                  <div class="col-sm-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Tahun Ajaran</label>
                                                                          <input type="text" class="form-control" id="tahun" name="tahun" placeholder="tahun" value="<?= $a->tahun ?>">
                                                                          <?= form_error('tahun', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-md-12 ">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Status</label>
                                                                          <div class="col-sm-12 kosong">
                                                                              <select class="form-control" name="status" id="status">
                                                                                  <option value="<?php $a->status ?>" selected="selected"></option>
                                                                                  <?php
                                                                                    foreach ($status as $level) { ?>
                                                                                      <option <?= ($level == $a->status ? 'selected=""' : '') ?> value="<?= $level; ?>"><?= $level; ?></option>
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
                                                          <h5 class="modal-title" id="addNewDonaturLabel">Hapus Tahun Ajaran</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <p>Anda yakin ingin menghapus <?= $a->tahun ?></p>
                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          <a href="<?= base_url('admin/delete_tahunajaran?id=') ?><?= $a->id ?>" class="btn btn-primary">Hapus</a>
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
                  <form class="pegawai" method="post" action="<?= base_url('admin/insert_thajaran'); ?>" enctype="multipart/form-data">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group form-group-default">
                                  <label>Tahun</label>
                                  <input type="text" class="form-control" id="tahun" name="tahun" placeholder="tahun" value="<?= set_value('tahun'); ?>">
                                  <?= form_error('tahun', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-md-12 ">
                              <div class="form-group form-group-default">
                                  <label>Status</label>
                                  <div class="col-sm-12 kosong">
                                      <select class="form-control" name="status" id="status">
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