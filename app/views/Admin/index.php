<?php
  $count = $data['users'] ;
  $trans = $data['transactions'];
?>
<div class="page-wrapper">
        <div class="content">
          <div class="row">
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count">
                <div class="dash-counts">
                  <h4><?= $count['count_warga']?></h4>
                  <h5>Warga</h5>
                </div>
                <div class="dash-imgs">
                  <i data-feather="users"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das1">
                <div class="dash-counts">
                  <h4><?= $count['count_officer']?></h4>
                  <h5>Petugas</h5>
                </div>
                <div class="dash-imgs">
                  <i data-feather="user-check"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das2">
                <div class="dash-counts">
                  <h4><?= $trans['count_trans']?></h4>
                  <h5>Transaksi Selesai</h5>
                </div>
                <div class="dash-imgs">
                  <i data-feather="file-text"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das3">
                <div class="dash-counts">
                  <h4><?= $trans['count_proses']?></h4>
                  <h5>Transaksi Diproses</h5>
                </div>
                <div class="dash-imgs">
                  <i data-feather="file"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
          <div class="card mb-0">
            <div class="card-body">
              <h4 class="card-title">Penukaran Sampah Terbaru</h4>
              <div class="table-responsive dataview">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Order ID</th>
                      <th>Nama Warga</th>
                      <th>Tipe</th>
                      <th>Nama Kategori</th>
                      <th>Waktu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($data['recent_pickup'] as $pickup):
                    ?>
                    <tr>
                      <td><?=$no?></td>
                      <td>DLV/TPS3R-<?=$pickup['pickup_id']?></td>
                      <td><?=$pickup['username']?></td>
                      <td><?=$pickup['pickup_type']?></td>
                      <td><?=$pickup['category_name']?></td>
                      <td><?=$pickup['pickup_schedule']?></td>
                    </tr>
                    <?php
                    $no++;
                    endforeach;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>