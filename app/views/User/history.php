<main class="container">
    <div class="button-group">
        <button class="btn-select" id="btn-history">Transaksi</button>
        <button class="btn-select" id="btn-pickup">Jemput</button>
    </div>

    <div class="card-container">
        <div class="card-history" id="history-cards">
            <?php
            $transaction = $data['transaction'];
            if (!empty($transaction)) :
                foreach ($transaction as $trans) :
            ?>
                    <div class="history-item">
                        <div class="history-header">
                            <div class="history-id">INV/TPS3R/<?= $trans['transaction_id'] ?></div>
                            <div class="history-date">Tanggal: <?= $trans['transaction_date'] ?></div>
                        </div>
                        <div class="history-details">
                            <div class="history-info">
                                <div class="history-category">Tipe: <?= $trans['pickup_type'] ?></div>
                                <div class="history-category">Kategori: <?= $trans['category_name'] ?></div>
                                <div class="history-weight">Berat: <?= $trans['waste_weight'] ?> Kg</div>
                                <div class="history-condition">Kondisi: <?= $trans['waste_condition'] ?></div>
                            </div>
                            <div class="history-price">
                                <div class="price-item">
                                    <div class="price-label">Subtotal:</div>
                                    <div class="price-value">Rp. <?= number_format(($trans['category_price'] * $trans['waste_weight']), 2, ",", ".") ?></div>
                                </div>
                                <div class="price-item">
                                    <div class="price-label">Bonus:</div>
                                    <div class="price-value">Rp. <?= number_format($trans['amount'] - ($trans['category_price'] * $trans['waste_weight']), 2, ",", ".") ?></div>
                                </div>
                                <div class="price-item total">
                                    <div class="price-label">Total:</div>
                                    <div class="price-value">Rp. <?= number_format($trans['amount'], 2, ",", ".") ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="history-footer">
                            <div class="history-description">
                                <?= $trans['transaction_information']; ?>
                            </div>
                            <?php if ($trans['transaction_status'] != 'Selesai') :
                                if ($trans['transaction_status'] != 'Dibatalkan') :
                                    $color = 'orange';?>
                                <?php else :
                                    $color = 'red';?>
                                <?php endif; ?>
                                <h4 class="status-transaction" style="color: <?=$color?>;"><?= $trans['transaction_status']; ?> oleh Admin</h4>
                            <?php else : 
                                $hashId = hash('sha256',$trans['transaction_id']);
                            ?>
                                <a href="<?= BASEURL?>/user/print&data=<?=urlencode($hashId)?>" class="btn-print">Cetak</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <h2>Tidak ada data transaksi yang ditemukan</h2>
            <?php endif; ?>
        </div>

        <div class="card-pickup" id="pickup-cards" style="display: none;">
            <!-- Replace with actual pickup card content -->
            <?php
            $pickup = $data['pickup']; // Assuming you have pickup data
            if (!empty($pickup)) :
                foreach ($pickup as $pick) :
            ?>
                    <div class="pickup-item">
                        <div class="pickup-header">
                            <div class="pickup-id">ID Jemput: DLV/TPS3R/<?= $pick['pickup_id'] ?></div>
                            <div class="pickup-date">Jadwal Jemput: <?= $pick['pickup_schedule'] ?></div>
                        </div>
                        <div class="pickup-details">
                            <div class="pickup-info">
                                <div class="pickup-category">Kategori: <?= $pick['category_name'] ?></div>
                                <div class="pickup-weight">Berat: <?= $pick['waste_weight'] ?> Kg</div>
                                <div class="pickup-condition">Kondisi: <?= $pick['waste_condition'] ?></div>
                            </div>
                            <div class="pickup-price">
                                <div class="price-item">
                                    <div class="price-label">Tipe:</div>
                                    <div class="price-value"><?= $pick['pickup_type'] ?></div>
                                </div>
                                <div class="price-item">
                                    <div class="price-label">Harga:</div>
                                    <div class="price-value">Rp. <?= number_format($pick['category_price'], 2, ",", ".") ?></div>
                                </div>
                                <div class="price-item total">
                                    <div class="price-label">SubTotal:</div>
                                    <div class="price-value">Rp. <?= number_format(($pick['category_price'] * $pick['waste_weight']), 2, ",", ".") ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="pickup-footer">
                            <div class="history-description">
                                <?= $pick['pickup_note']; ?>
                            </div>
                            <?php if ($pick['pickup_status'] != 'Selesai') :
                                if ($pick['pickup_status'] != 'Ditolak') :
                                    $color = 'orange';?>
                                <?php else :
                                    $color = 'red';?>
                                <?php endif; ?>                                
                                <h4 class="status-transaction" style="color: <?=$color?>;"><?= $pick['pickup_status']; ?> oleh Petugas</h4>
                            <?php else : ?>
                                <h4 class="status-transaction">Telah selesai oleh Petugas pada <?= $pick['pickup_finished'] ?></h4>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <h4 class="empty-data">Tidak ada data jemput yang ditemukan</h4>
            <?php endif; ?>
        </div>
    </div>
</main>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnHistory = document.getElementById('btn-history');
        const btnPickup = document.getElementById('btn-pickup');
        const historyCards = document.getElementById('history-cards');
        const pickupCards = document.getElementById('pickup-cards');

        btnHistory.addEventListener('click', function() {
            historyCards.style.display = 'flex';
            pickupCards.style.display = 'none';
        });

        btnPickup.addEventListener('click', function() {
            historyCards.style.display = 'none';
            pickupCards.style.display = 'flex';
        });
    });
</script>