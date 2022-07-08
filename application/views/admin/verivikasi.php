  <style>
      .center {
          text-align: center;
      }
  </style>
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
                                          <th>NO Pendaftra</th>
                                          <th>Nama Lengkap</th>
                                          <th>Nama Panggilan</th>
                                          <th>Jenis Kelamin</th>
                                          <th>Status Verivikasi</th>
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
                                                      <button type="button" class="btn btn-danger" style="font-size: 10px;">BELUM DIVERIVIKASI</button>
                                                  <?php } elseif ($a->id_verivikasi == 1) { ?>
                                                      <button type="button" class="btn btn-danger" style="font-size: 10px;">DIVERIVIKASI</button>
                                                  <?php } ?>
                                              </td>

                                              <td>
                                                  <div class="form-button-action">
                                                      <button data-target="#edit-apk<?= $a->no_pendaftaran ?>" type="button" data-toggle="modal" title="Edit Data" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                          <i class="fa fa-edit"></i>
                                                      </button>
                                                      <button type="button" class="btn btn-link btn-danger btn-lg" data-toggle="modal" data-target="#deluser<?= $a->no_pendaftaran ?>">
                                                          <i class="fa fa-times"></i>
                                                      </button>
                                                  </div>
                                              </td>
                                          </tr>



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
      $(document).ready(function() {
          $('#datatable').DataTable();
      });
  </script>