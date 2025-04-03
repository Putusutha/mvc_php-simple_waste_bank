<div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="<?=$data['dashboard']?>">
                            <a href="<?= BASEURL; ?>/admin/index"><img src="<?= BASEURL; ?>/plugins/img/dashboard.svg" alt="img" /><span>
                                    Dashboard</span>
                            </a>
                        </li>
                        <li class="<?=$data['transaksi']?>">
                            <a href="javascript:void(0);"><img src="<?= BASEURL; ?>/plugins/img/sales1.svg" alt="img" /><span>
                                    Transaksi</span>
                                <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= BASEURL; ?>/TablePembayaran/index" class="<?=$data['pembayaran']?>">Pembayaran</a></li>
                                <li><a href="<?= BASEURL; ?>/TableRiwayat/index" class="<?=$data['riwayat']?>">Riwayat</a></li>
                            </ul>
                        </li>
                        <li class="<?=$data['kelola']?>">
                            <a href="javascript:void(0);"><img src="<?= BASEURL; ?>/plugins/img/product.svg" alt="img" /><span>
                                    Kelola Data</span>
                                <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= BASEURL; ?>/TableWarga/index" class="<?=$data['warga']?>">Data Warga</a></li>
                                <li><a href="<?= BASEURL; ?>/TablePetugas/index" class="<?=$data['petugas']?>">Data Petugas</a></li>
                                <li><a href="<?= BASEURL; ?>/TableCategory/index" class="<?=$data['kategori']?>">Data Kategori</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
