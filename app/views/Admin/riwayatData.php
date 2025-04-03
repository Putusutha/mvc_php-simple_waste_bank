<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Daftar Riwayat</h4>
        <h6>Guna mengatur data riwayat transaksi</h6>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="table-top">
          <div class="search-set">
            <div class="search-path">
              <a class="btn btn-filter" id="filter_search">
                <img src="<?= BASEURL; ?>/plugins/img/filter.svg" alt="img" />
                <span><img src="<?= BASEURL; ?>/plugins/img/closes.svg" alt="img" /></span>
              </a>
            </div>
            <div class="search-input">
              <a class="btn btn-searchset"><img src="<?= BASEURL; ?>/plugins/img/search-white.svg" alt="img" /></a>
            </div>
          </div>
        </div>

        <div class="card mb-0" id="filter_inputs">
          <div class="card-body pb-0">
            <div class="row">
            <div class="col-lg-12 col-sm-12">
                <form method="POST" action="<?=BASEURL?>/TableRiwayat/printRiwayat" class="row">
                  <div class="col-lg col-sm-6 col-12">
                    <div class="form-group">
                      <select name="filter" class="select">
                        <option value="transaction_id">Filter</option>
                        <option value="username">Username</option>
                        <option value="pickup_type">Tipe</option>
                        <option value="category_name">Kategori</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg col-sm-6 col-12">
                    <div class="form-group">
                      <input type="text" name="input-filter" placeholder="Masukkan filter yang ingin diprint....." class="search-input">
                    </div>
                  </div>
                  <div class="col-lg-1 col-sm-6 col-12">
                    <div class="form-group">
                      <button type='submit' class="btn btn-filters ms-auto">
                        <i data-feather="printer"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table datanew">
            <thead>
              <tr>
                <th>
                  No.
                </th>
                <th>Invoice ID</th>
                <th>Username</th>
                <th>Waktu</th>
                <th>Tipe</th>
                <th>Kategori</th>
                <th>Berat</th>
                <th>Total</th>
                <th>Kondisi</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $number = 1;
              foreach ($data['data'] as $histori) :
                
              ?>
                <tr>
                  <td>
                    <?= $number ?>
                  </td>
                  <td>INV/TPS3R-<?=$histori['transaction_id'] ?></td>
                  <td><?= $histori['username'] ?></td>
                  <td><?= $histori['pickup_schedule'] ?></td>
                  <td><?= $histori['pickup_type'] ?></td>
                  <td><?= $histori['category_name'] ?></td>
                  <td><?= $histori['waste_weight'] ?></td>
                  <td><?= $histori['amount'] ?></td>
                  <td><?= $histori['waste_condition'] ?></td>
                  <td>
                    <span class="<?php
                          if ($histori['transaction_status'] == 'Selesai') {
                              $class = 'badges bg-lightgreen';
                            } else {
                              $class = 'badges bg-lightred';
                            }
                          echo $class;
                      ?>"><?= $histori['transaction_status'] ?>
                    </span></td>
                  <td>
                  <?php
                        $hashId = hash('sha256', $histori['transaction_id']);
                    ?>
                    <a class="me-3" href="<?= BASEURL; ?>/TableRiwayat/confirmRiwayat&data=<?=urlencode($hashId)?>">
                      <img src="<?= BASEURL; ?>/plugins/img/edit.svg" alt="img" />
                    </a>
                    <a class="confirm-text" href="<?= BASEURL; ?>/TableRiwayat/deleteRiwayat&data=<?=urlencode($hashId)?>">
                      <img src="<?= BASEURL; ?>/plugins/img/delete.svg" alt="img" />
                    </a>
                  </td>
                </tr>
              <?php
                $number++;
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