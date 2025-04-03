<div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <?php
              $warga = $data['warga'];
            ?>
            <div class="page-title">
              <h4>Daftar Warga</h4>
              <h6>Potong saldo data warga berdasarkan ID WRG-<?=$warga['account_id']?></h6>
            </div>
          </div>
          <form class="card" method="POST" action="<?= BASEURL?>/TableWarga/updateWarga&data=<?=urlencode($_GET['data'])?>">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" value="<?=$warga['full_name']?>" readonly/>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="<?=$warga['username']?>" readonly/>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Nomor Kartu Keluarga</label>
                    <input type="text" name="kk"  value="<?=$warga['family_card_number']?>" readonly/>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?=$warga['email']?>" readonly/>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="telp" value="<?=$warga['phone_number']?>" readonly/>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label style="font-weight: bold;">Jumlah Potongan Saldo</label>
                    <input type="number" name="balance" value="<?=$warga['balance']?>"/>
                  </div>
                </div>
                <div class="col-lg-8 col-12">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="<?=$warga['address']?>" readonly/>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="form-group">
                    <label>RT</label>
                    <input type="text" name="rt" value="<?=$warga['rt']?>" readonly/>
                  </div>
                </div>
                <div class="col-lg-12">
                  <input type="submit" class="btn btn-submit me-2"
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