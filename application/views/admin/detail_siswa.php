  <style>
      .center {
          text-align: center;
      }
  </style>
  <div class="main-panel">
      <div class="content">
          <div class="page-inner">
              <div class="col-md-12">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="card">
                              <a href="#informasisantri" class="d-block bg-success border border-success card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                  <h6 class="m-0 font-weight-bold text-white"> Data Siswa</h6>
                              </a>
                              <div class="collapse show" id="informasisantri">
                                  <div class="card-body">
                                      <table class="table table-striped">
                                          <tbody>
                                              <?php foreach ($detail_siswa as $u) { ?>
                                                  <tr>
                                                      <td>No Pendaftaran </td>
                                                      <td>: <?php echo $u->no_pendaftaran ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>No Telepon</td>
                                                      <td>: <?php echo $u->no_tlp ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Golongan</td>
                                                      <td>: <?php echo $u->golongan ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Nama Lengkap</td>
                                                      <td>: <?php echo $u->full_name ?></span></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Jenis Kelmain</td>
                                                      <td>: <?php echo $u->jenis_kelamin ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Tahun Ajaran</td>
                                                      <td>: <?php echo $u->tahun ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Tanggal Daftar</td>
                                                      <td>: <?php echo $u->tanggal_daftar ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Tempat Lahir</td>
                                                      <td>: <?php echo $u->tempat_lahir ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Tanggal Lahir</td>
                                                      <td>: <?php echo $u->tanggal_lahir ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Agama</td>
                                                      <td>: <?php echo $u->agama ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Kewarganegaraan</td>
                                                      <td>: <?php echo $u->kewarganegaraan ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Berkebutuhan Khususu</td>
                                                      <td>: <?php echo $u->ber_khusus ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Alamat</td>
                                                      <td>: <?php echo $u->alamat ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Rt</td>
                                                      <td>: <?php echo $u->rt ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Rw</td>
                                                      <td>: <?php echo $u->rw ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Dusun</td>
                                                      <td>: <?php echo $u->dusun ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Desa</td>
                                                      <td>: <?php echo $u->desa ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Kecamatan</td>
                                                      <td>: <?php echo $u->kecamatan ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Kode Pos</td>
                                                      <td>: <?php echo $u->kode_pos ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Tempat Tinggal</td>
                                                      <td>: <?php echo $u->tempat_tinggal ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Transportasi</td>
                                                      <td>: <?php echo $u->transportasi ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Anak Ke</td>
                                                      <td>: <?php echo $u->anak_keberapa ?></td>
                                                  </tr>
                                              <?php } ?>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="card">
                              <a href="#datapriodik" class="d-block bg-warning border border-warning card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                  <h6 class="m-0 font-weight-bold text-white"> Data Priodik</h6>
                              </a>
                              <div class="collapse show" id="datapriodik">
                                  <div class="card-body">
                                      <table class="table table-striped">
                                          <tbody>
                                              <?php foreach ($priodik as $u) { ?>
                                                  <tr>
                                                      <td>No Pendaftaran </td>
                                                      <td>: <?php echo $u->no_pendaftaran ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Tinggi Badan</td>
                                                      <td>: <?php echo $u->tinggi_badan ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Berat Badan</td>
                                                      <td>: <?php echo $u->berat_badan ?></span></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Jarak Kesekolah</td>
                                                      <td>: <?php echo $u->jarak_kesekolah ?></span></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Waktu Kesekolah</td>
                                                      <td>: <?php echo $u->waktu_kesekolah ?></span></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Saudara Kandung</td>
                                                      <td>: <?php echo $u->saudara_kandung ?></span></td>
                                                  </tr>
                                              <?php } ?>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                          <div class="card">
                              <a href="#dataayah" class="d-block bg-primary border border-primary card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                  <h6 class="m-0 font-weight-bold text-white"> Data Ayah</h6>
                              </a>
                              <div class="collapse show" id="dataayah">
                                  <div class="card-body">
                                      <table class="table table-striped">
                                          <tbody>
                                              <?php foreach ($ayah as $u) { ?>
                                                  <tr>
                                                      <td>No Pendaftaran </td>
                                                      <td>: <?php echo $u->no_pendaftaran ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Nama Ayah</td>
                                                      <td>: <?php echo $u->nama_ayah ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Tempat Lahir</td>
                                                      <td>: <?php echo $u->tempat_lahir ?></span></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Tanggal Lahir</td>
                                                      <td>: <?php echo $u->tanggal_lahir ?></span></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Pendidikan</td>
                                                      <td>: <?php echo $u->pendidikan ?></span></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Pekerjaan</td>
                                                      <td>: <?php echo $u->pekerjaan ?></span></td>
                                                  </tr>
                                              <?php } ?>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                          <div class="card">
                              <a href="#dataibu" class="d-block bg-info border border-info card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                  <h6 class="m-0 font-weight-bold text-white"> Data Ibu</h6>
                              </a>
                              <div class="collapse show" id="dataibu">
                                  <div class="card-body">
                                      <table class="table table-striped">
                                          <tbody>
                                              <?php foreach ($ibu as $u) { ?>
                                                  <tr>
                                                      <td>No Pendaftaran </td>
                                                      <td>: <?php echo $u->no_pendaftaran ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Nama Ibu</td>
                                                      <td>: <?php echo $u->nama_ibu ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Tempat Lahir</td>
                                                      <td>: <?php echo $u->tempat_lahir ?></span></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Tanggal Lahir</td>
                                                      <td>: <?php echo $u->tanggal_lahir ?></span></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Pendidikan</td>
                                                      <td>: <?php echo $u->pendidikan ?></span></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Pekerjaan</td>
                                                      <td>: <?php echo $u->pekerjaan ?></span></td>
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
      </div>

      <script>
          $(document).ready(function() {
              $('#datatables').DataTable({});
          });
      </script>