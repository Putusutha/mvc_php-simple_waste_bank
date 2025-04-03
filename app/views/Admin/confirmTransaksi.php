<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
    <?php
        $trans = $data['transaction'];
        $categories = $data['categories'];
      ?>
      <div class="page-title">
        <h4>Daftar <?=$data['title']?></h4>
        <h6>Konfirmasi <?=$data['title']?> Transaksi berdasarkan ID INV/TPS3R-<?=$trans['transaction_id']?> </h6>
      </div>
    </div>
    <form class="card" method="POST" action="<?= BASEURL ?>/Table<?=$data['link']?>/update<?=$data['link']?>&data=<?=urlencode($_GET['data'])?>">
      <div class="card-body">
        <div class="row">
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Order ID</label>
              <input type="text" name="name" maxlength="50" value="DLV/TPS3R-<?=$trans['pickup_id']?>" readonly/>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="name" maxlength="50" value="<?=$trans['username']?>" readonly/>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Waktu</label>
              <input type="text" name="username" maxlength="50" value="<?=$trans['pickup_finished']?>" readonly/>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Tipe</label>
              <input type="text" name="nip" maxlength="16" value="<?=$trans['pickup_type']?>" readonly/>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Kategori</label>
              <select class="select" name="category" required>
                <option value="<?=$trans['category_id']?>"><?=$trans['category_name']?></option>
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
              <input type="number" name="weight" value="<?=$trans['waste_weight']?>"/>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Bonus</label>
              <input type="number" name="bonus" value=0 required/>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Kondisi</label>
              <input type="text" name="kondisi" maxlength="50" value="<?=$trans['waste_condition']?>" required/>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="form-group">
              <label>Status</label>
              <select class="select" name="status" required>
              <option value="<?=$trans['transaction_status']?>"><?=$trans['transaction_status']?></option>
                <option value="Sedang Diproses">Sedang Diproses</option>
                <option value="Dibatalkan">Dibatalkan</option>
                <option value="Selesai">Selesai</option>
              </select>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <label>Deskripsi</label>
              <textarea name="desc" class="form-control"></textarea>
            </div>
          </div>
          <div class="col-lg-12">
            <input type="submit" href="javascript:void(0);" class="btn btn-submit me-2" />
            <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</div>