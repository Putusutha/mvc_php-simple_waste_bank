<div class="form-wrapper">
  <div class="content">
    <div class="page-header">
      <?php
        $pick = $data['pickup'];
        $categories = $data['categories'];
      ?>
      <div class="page-title">
        <h4>Konfirmasi Penjemputan</h4>
        <h6>Konfirmasi data penjemputan dari warga</h6>
      </div>
    </div>
    <form class="card" method="POST" action="<?= BASEURL ?>/officer/updatePickup&data=<?=urlencode($_GET['data'])?>">
      <div class="row">
        <div class="col-lg-4 col-sm-6 col-12">
          <div class="form-group">
            <label>Order ID</label>
            <input type="text" maxlength="50" value="DLV/TPS3R-<?=$pick['pickup_id']?>" disabled/>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="username" value="<?=$pick['full_name']?>" maxlength="35" disabled />
          </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
          <div class="form-group">
            <label>Waktu</label>
            <input type="text" name="card" value="<?=$pick['pickup_schedule']?>" disabled/>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="address" value="<?=$pick['address']?>" disabled/>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
          <div class="form-group">
            <label>RT</label>
            <input type="text" name="rt"  value="<?=$pick['rt']?>" disabled/>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Kategori</label>
              <select class="select" name="category" required>
                <option value="<?=$pick['category_id']?>"><?=$pick['category_name']?></option>
                <?php
                    foreach($categories AS $category):
                ?>
                <option value="<?=$category['category_id']?>"><?=$category['category_name']?></option>
                <?php
                  endforeach;
                ?>
              </select>
            </div>
          </div>
        <div class="col-lg-4 col-sm-6 col-12">
          <div class="form-group">
            <label>Berat</label>
            <input type="number" name="weight" required />
          </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
          <div class="form-group">
            <label>Kondisi</label>
            <input type="text" name="condition" maxlength="50" required />
          </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Status</label>
              <select class="select" name="status" required>
                <option value="Selesai">Selesai</option>
                <option value="Ditolak">Ditolak</option>
              </select>
            </div>
          </div>
        <div class="col-lg-4 col-sm-6 col-12">
          <div class="form-group">
            <label>Catatan</label>
            <input type="text" name="note"value="<?=$pick['pickup_note']?>"  required />
          </div>
        </div>
        <div class="col-lg-12">
          <input type="submit" class="btn btn-submit me-2" />
        </div>
      </div>
  </div>
  </form>
</div>