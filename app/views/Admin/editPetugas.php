<div class="page-wrapper">
        <div class="content">
          <div class="page-header">
          <?php
              $petugas = $data['petugas'];
          ?>
            <div class="page-title">
              <h4>Edit Data Staff</h4>
              <h6>Ubah data staff berdasarkan ID petugas PTG-<?=$petugas['user_id']?></h6>
            </div>
          </div>
          <form class="card" method="POST" action="<?= BASEURL?>/TablePetugas/updatePetugas&data=<?=urlencode($_GET['data'])?>">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" value="<?=$petugas['full_name']?>" maxlength="50" required/>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="<?=$petugas['username']?>" maxlength="50" required/>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>NIP</label>
                    <input type="text" name="nip" value="<?=$petugas['family_card_number']?>" maxlength="16" required/>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?=$petugas['email']?>" maxlength="50" required/>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="telp" value="<?=$petugas['phone_number']?>" maxlength="13" required/>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Pilih Role</label>
                    <select class="select" name="role" required>
                      <option value="<?=$petugas['role_id']?>"><?=$petugas['role_name']?></option>
                      <option value="1">Admin</option>
                      <option value="2">Petugas</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-8 col-12">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="<?=$petugas['address']?>" maxlength="255" required/>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Pilih RT</label>
                    <select class="select" name="rt" required>
                      <option value="<?=$petugas['rt']?>"><?=$petugas['rt']?></option>
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