<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Tambah Data Kategori</h4>
                <h6>Buat kategori baru</h6>
            </div>
        </div>
        <form class="card" method="post" action="<?= BASEURL ?>/tableCategory/createCategory" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input type="text" name="name" maxlength="50" required/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Harga (per kg)</label>
                            <input type="number" maxlength="12" name="price" required/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Contoh Gambar Kategori</label>
                            <div class="image-upload">
                                <input type="file" maxlength="255" name="file"/>
                                <div class="image-uploads">
                                    <img src="<?= BASEURL; ?>/plugins/img/upload.svg" alt="img" />
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
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
