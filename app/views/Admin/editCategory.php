<div class="page-wrapper">
        <div class="content">
          <div class="page-header">
          <?php
              $category = $data['categories'];
          ?>
            <div class="page-title">
              <h4>Edit Data Kategori</h4>
              <h6>Ubah data kategori berdasarkan ID kategori SMPH-<?=$category['category_id']?></h6>
            </div>
          </div>
          <form class="card" method="post" action="<?= BASEURL ?>/tableCategory/updateCategory&data=<?=urlencode($_GET['data'])?>" enctype="multipart/form-data">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name='name' value="<?=$category['category_name']?>"  required/>
                  </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Harga Kategori (per kg)</label>
                    <input type="number" name="price" value="<?=$category['category_price']?>" required />
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label>Contoh Gambar Kategori</label>
                    <div class="image-upload">
                      <input type="file" name="file"/>
                      <div class="image-uploads">
                        <img src="<?= BASEURL?>/plugins/img/upload.svg" alt="img" />
                        <h4>Drag and drop a file to upload</h4>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="product-list">
                    <ul class="row">
                      <li class="ps-0">
                        <div class="productviews">
                          <div class="productviewsimg">
                            <img src="<?= BASEURL?>/uploads/<?=$category['category_image']?>" alt="img" />
                          </div>
                          <div class="productviewscontent">
                            <div class="productviewsname">
                              </div>
                            <a href="javascript:void(0);" class="hideset">x</a>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-12">
                  <input type="submit" value="Submit" class="btn btn-submit me-2">
                  <a href="categorylist.html" class="btn btn-cancel">Cancel</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>