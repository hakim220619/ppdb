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
                              <!-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#usermodal">
                                  <i class="fa fa-plus"></i>
                                  Add User
                              </button> -->
                          </div>
                      </div>

                      <div class="card-body">
                          <!-- Modal -->
                          <div class="table-responsive">
                              <table id="datatable" class="display table table-striped table-hover">
                                  <thead class="center">
                                      <tr style="font-size: 10px;">
                                          <th>NO</th>
                                          <th>NO Pendaftran</th>
                                          <th>Nama Lengkap</th>
                                          <th>Nama Panggilan</th>
                                          <th>Jenis Kelamin</th>
                                          <th>Status Verifikasi</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody class="center">
                                      <?php
                                        $no = 1;
                                        foreach ($verivikasi as $a) { ?>

                                          <tr>
                                              <td><?= $no++ ?></td>
                                              <td><?= $a->no_pendaftaran ?></td>
                                              <td><?= $a->full_name ?></td>
                                              <td><?= $a->username ?></td>
                                              <td><?= $a->jenis_kelamin ?></td>
                                              <td>
                                                  <?php if ($a->id_verivikasi == 2) { ?>
                                                      <button type="button" class="btn btn-danger" style="font-size: 10px;">BELUM DIVERIFIKASI</button>
                                                  <?php } elseif ($a->id_verivikasi == 1) { ?>
                                                      <button type="button" class="btn btn-success" style="font-size: 10px;">DIVERIFIKASI</button>
                                                  <?php } elseif ($a->id_verivikasi == 3) { ?>
                                                      <button type="button" class="btn btn-info" style="font-size: 10px;">DITOLAK</button>
                                                  <?php } ?>
                                              </td>

                                              <td>
                                                  <div class="form-button-action">
                                                      <a href="<?= base_url('admin/detail_siswa/' . $a->no_pendaftaran . '') ?>" type="button" title="Detail Data Siswa" class="btn btn-link btn-primary btn-lg">
                                                          <i class="fa fa-info-circle"></i>
                                                      </a>
                                                      <?php if ($a->id_verivikasi == 2) { ?>
                                                          <a onclick="deleteConfirm('<?php echo site_url('admin/acc_siswa/' . $a->no_pendaftaran) ?>')" type="button" title="Setuju Data Siswa" class="btn btn-link btn-primary btn-lg">
                                                              <i class="fa fa-check"></i>
                                                          </a>
                                                      <?php } elseif ($a->id_verivikasi == 1) { ?>
                                                          <a onclick="deleteConfirmbatal('<?php echo site_url('admin/batal_siswa/' . $a->no_pendaftaran) ?>')" type="button" title="Batal Verivikasi Data Siswa" class="btn btn-link btn-danger btn-lg">
                                                              <i class="fa fa-minus"></i>
                                                          </a>

                                                      <?php } ?>
                                                      <a onclick="deleteConfirmhapus('<?php echo site_url('admin/tidterima_siswa/' . $a->no_pendaftaran) ?>')" type="button" title="Siswa Tidak Di Terima" class="btn btn-link btn-danger btn-lg">
                                                          <i class="fa fa-times"></i>
                                                      </a>

                                                  </div>
                                              </td>
                                          </tr>
                                          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Apakah Kamu Yakin?</h5>
                                                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">×</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">Siswa yang sudah lengkap pemberkasan bisa Diverivikasi.</div>
                                                      <div class="modal-footer">
                                                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                                                          <a id="btn-delete" class="btn btn-danger" href="#">Setuju</a>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="modal fade" id="deleteModal-batal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Apakah Kamu Yakin?</h5>
                                                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">×</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">Jika ada siswa yang data pemberkasan tidak sesuai silahkan Batalkan verivikasi.</div>
                                                      <div class="modal-footer">
                                                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                                                          <a id="btn-delete-batal" class="btn btn-danger" href="#">Batalkan</a>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="modal fade" id="deleteModal-hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin?</h5>
                                                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">×</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">Tolak Siswa karena belum sesuai berkas</div>
                                                      <div class="modal-footer">
                                                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                          <a id="btn-delete-hapus" class="btn btn-danger" href="#">Tolak</a>
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

  <script>
      function deleteConfirm(url) {
          $('#btn-delete').attr('href', url);
          $('#deleteModal').modal();
      }

      function deleteConfirmbatal(url) {
          $('#btn-delete-batal').attr('href', url);
          $('#deleteModal-batal').modal();
      }

      function deleteConfirmhapus(url) {
          $('#btn-delete-hapus').attr('href', url);
          $('#deleteModal-hapus').modal();
      }
  </script>

  <script>
      $(document).ready(function() {
          $('#datatable').DataTable();
      });
  </script>