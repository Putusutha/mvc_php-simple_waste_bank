<div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Daftar Kategori</h4>
              <h6>Guna mengatur data kategori</h6>
            </div>
            <div class="page-btn">
              <a href="<?= BASEURL; ?>/tablecategory/addCategory" class="btn btn-added"
                ><img
                  src="<?= BASEURL; ?>/plugins/img/plus.svg"
                  alt="img"
                  class="me-1"
                />Tambah Data</a
              >
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="table-top">
                <div class="search-set">
                <div class="search-path">
                    <a href="<?= BASEURL; ?>/tableCategory/printCategory" class="btn btn-filter" id="filter_search">
                      <img src="<?= BASEURL; ?>/plugins/img/printer.svg" alt="img">
                    </a>
                  </div>
                  <div class="search-input">
                    <a class="btn btn-searchset"
                      ><img src="<?= BASEURL; ?>/plugins/img/search-white.svg" alt="img"
                    /></a>
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
                      <th>Nama Kategori</th>
                      <th>ID Kategori</th>
                      <th>price</th>
                      <th>Unit</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $number=1;
                        foreach($data['categories'] AS $category):
                    ?>
                    <tr>
                      <td>
                        <?=$number?>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img
                            src="<?=BASEURL;?>/uploads/<?=$category['category_image']?>"
                            alt="product"
                          />
                        </a>
                        <a href="javascript:void(0);"><?=$category['category_name']?></a>
                      </td>
                      <td>SMPH-<?=$category['category_id']?></td>
                      <td><?php echo " ".number_format(floatval($category['category_price']), 2, ",", ".");?></td>
                      <td>Kg</td>
                      <td>
                      <?php
                        $hashId = hash('sha256',$category['category_id']);
                      ?>
                        <a class="me-3" href="<?= BASEURL; ?>/tableCategory/editCategory&data=<?=urlencode($hashId)?>">
                          <img src="<?= BASEURL; ?>/plugins/img/edit.svg" alt="img" />
                        </a>
                        <a class="confirm-text" href="<?= BASEURL; ?>/tableCategory/deleteCategory&data=<?=urlencode($hashId)?>">
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