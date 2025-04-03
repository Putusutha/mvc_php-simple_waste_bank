<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Daftar Staff</h4>
        <h6>Guna mengatur data petugas dan admin</h6>
      </div>
      <div class="page-btn">
        <a href="<?= BASEURL; ?>/TablePetugas/addPetugas" class="btn btn-added"><img src="<?= BASEURL; ?>/plugins/img/plus.svg" alt="img" class="me-1" />Tambah Data</a>
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
                <form method="POST" action="<?= BASEURL ?>/TablePetugas/printPetugas" class="row">
                  <div class="col-lg col-sm-6 col-12">
                    <div class="form-group">
                      <select name="filter" class="select">
                        <option value="user_id">Filter</option>
                        <option value="full_name">Nama</option>
                        <option value="username">Username</option>
                        <option value="family_card_number">Kartu Keluarga</option>
                        <option value="rt">RT</option>
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
                <th>Nama</th>
                <th>Username</th>
                <th>ID Account</th>
                <th>NIP</th>
                <th>Email</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th>Rt</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $number = 1;
              foreach ($data['data'] as $admin) :
              ?>
                <tr>
                  <td>
                    <?= $number ?>
                  </td>
                  <td><?= $admin['full_name'] ?></td>
                  <td><?= $admin['username'] ?></td>
                  <td>PTG-<?= $admin['user_id'] ?></td>
                  <td><?= $admin['family_card_number'] ?></td>
                  <td><?= $admin['email'] ?></td>
                  <td><?= $admin['phone_number'] ?></td>
                  <td><?= $admin['address'] ?></td>
                  <td><?= $admin['rt'] ?></td>
                  <td><?= $admin['role_name'] ?></td>
                  <td>
                    <?php
                    $hashId = hash('sha256', $admin['user_id']);
                    ?>
                    <a class="me-3" href="<?= BASEURL; ?>/TablePetugas/editPetugas&data=<?= urlencode($hashId) ?>">
                      <img src="<?= BASEURL; ?>/plugins/img/edit.svg" alt="img" />
                    </a>
                    <a class="confirm-text" href="<?= BASEURL; ?>/TablePetugas/deletePetugas&data=<?= urlencode($hashId) ?>">
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