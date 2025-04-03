<div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Daftar Warga</h4>
              <h6>Buat warga baru</h6>
            </div>
          </div>
          <form class="card" method="POST" action="<?= BASEURL?>/TableWarga/createWarga">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" maxlength="50" required/>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" maxlength="50" required/>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Nomor Kartu Keluarga</label>
                    <input type="text" name="nip" maxlength="16" required/>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" maxlength="50" required/>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="telp" maxlength="13" required/>
                  </div>
                </div>
                <div class="col-lg-8 col-12">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" maxlength="255" required/>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Pilih RT</label>
                    <select class="select" name="rt" required>
                      <option>Pilih RT</option>
                      <?php
                        $rt = 1;
                        while ($rt<12):
                      ?>
                      <option value="<?=$rt?>"><?=$rt?></option>
                      <?php
                        $rt++;
                        endwhile;
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-lg-12">
                  <input type="submit" href="javascript:void(0);" class="btn btn-submit me-2"
                    />
                  <a href="javascript:void(0);" class="btn btn-cancel"
                    >Cancel</a
                  >
                </div>
              </div>
            </div>
        </form>
        </div>
      </div>
    </div>