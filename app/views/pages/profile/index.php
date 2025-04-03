<div class="form-wrapper">
  <div class="content">
    <div class="page-header">
      <?php
      $warga = $data['data_user'];
      ?>
      <div class="page-title">
        <h4>Pengaturan Profil</h4>
        <h6>Edit data privasi milik anda</h6>
      </div>
    </div>
    <form class="card" method="POST" action="<?= BASEURL ?>/<?= $data['jenis'] ?>/updateProfil">
      <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" maxlength="50" value="<?= $warga['full_name'] ?>" required />
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" maxlength="35" value="<?= $warga['username'] ?>" required />
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="form-group">
            <label>Nomor Kartu Keluarga</label>
            <input type="text" name="card" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="16" value="<?= $warga['family_card_number'] ?>" required />
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" maxlength="50" value="<?= $warga['email'] ?>" required />
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="form-group">
            <label>Telepon</label>
            <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="13" name="phone" value="<?= $warga['phone_number'] ?>" required />
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="address" value="<?= $warga['address'] ?>" required />
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="form-group">
            <label>RT</label>
            <input type="text" name="rt" value="<?= $warga['rt'] ?>" required />
          </div>
        </div>
        <div class="col-lg-12">
          <input type="submit" class="btn btn-submit me-2" />
        </div>
      </div>
  </div>
  </form>
  <div class="content">
    <div class="page-header">
      <?php
      $warga = $data['data_user'];
      ?>
      <div class="page-title">
        <h4>Ganti Passwod</h4>
        <h6>Ubah password lama milik anda</h6>
      </div>
    </div>
    <form class="card" method="POST" action="<?= BASEURL ?>/<?= $data['jenis'] ?>/updatePassword">
      <div class="row">
        <div class="col-lg-6 col-sm-6 col-12">
          <div class="form-group">
            <label>New Password</label>
            <input type="password" name="new-password" placeholder="Input New Password" maxlength="6" required />
          </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-12">
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm-password" placeholder="Input Confirm Password" maxlength="6" required />
          </div>
        </div>
        <div class="col-lg-12">
          <input type="submit" class="btn btn-submit me-2" />
        </div>
      </div>
  </div>
  </form>
</div>
</div>