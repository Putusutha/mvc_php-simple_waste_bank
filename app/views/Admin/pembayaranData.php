<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Daftar Transaksi</h4>
        <h6>Guna mengatur data transaksi</h6>
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
                <form method="POST" action="<?=BASEURL?>/TablePembayaran/printPembayaran" class="row">
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
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $number = 1;
              foreach ($data['data'] as $trans) :
              ?>
                <tr>
                  <td>
                    <?= $number ?>
                  </td>
                  <td>INV/TPS3R-<?= $trans['transaction_id'] ?></td>
                  <td><?= $trans['username'] ?></td>
                  <td><?= $trans['pickup_schedule'] ?></td>
                  <td><?= $trans['pickup_type'] ?></td>
                  <td><?= $trans['category_name'] ?></td>
                  <td><?= $trans['waste_weight'] ?></td>
                  <td><?= $trans['amount'] ?></td>
                  <td><?= $trans['waste_condition'] ?></td>
                  <td>
                    <?php
                    $hashId = hash('sha256', $trans['transaction_id']);
                    ?>
                    <a class="me-3" href="<?= BASEURL; ?>/TablePembayaran/confirmTransaksi&data=<?= urlencode($hashId) ?>">
                      <img src="<?= BASEURL; ?>/plugins/img/edit.svg" alt="img" />
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