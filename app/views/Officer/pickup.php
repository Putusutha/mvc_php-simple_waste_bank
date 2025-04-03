<main>
    <div class="container">
        <div class="input-container">
            <form method="POST" action="<?= BASEURL ?>/officer/pickup">
                <label for="datetime">Pilih Tanggal Penjemputan:</label>
                <input type="date" id="datetime" name="datetime" value="<?= $datetime ?>" onchange="this.form.submit()">
            </form>
        </div>

        <?php
        if (empty($data['pickup'])) : ?>
            <p class="not-found">Tidak ada penjemputan pada hari ini</p>
        <?php else : ?>
            <div class="card-container">
                <?php foreach ($data['pickup'] as $trans) : ?>
                    <!-- Card list warga -->
                    <div class="card">
                        <h2>DLV/TPS3R/<?= $trans['pickup_id'] ?></h2>
                        <p><strong>Nama: </strong><?= $trans['full_name'] ?></p>
                        <p><strong>Alamat: </strong><?= $trans['address'] ?></p>
                        <p><strong>RT: </strong><?= $trans['rt'] ?></p>
                        <p><strong>Waktu: </strong> <?= $trans['pickup_schedule'] ?></p>
                        <p><strong>Jenis Sampah: </strong><?= $trans['category_name'] ?></p>
                        <p><strong>Keterangan: </strong><?= $trans['pickup_note'] ?></p>
                        <p><strong>Status: </strong><?= $trans['pickup_status'] ?></p>
                        <div class="button-container">
                        <button class="copy-button" data-address="<?php echo $trans['address'] ?>, Kel. Jaticempaka, Kec. Pondok Gede, Kota Bekasi">Cari</button>
                    <?php
                        $hashId = hash('sha256', $trans['pickup_id']);
                      ?>
                    <a href='<?= BASEURL; ?>/officer/confirmPickup&data=<?=urlencode($hashId)?>' class="confirm-button">Konfirm</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>
<script src="<?= BASEURL ?>/js/script.js"></script>