<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kuitansi - Aplikasi E-Sabililah</title>
    <link rel="shortcut icon" href="<?= BASEURL; ?>/img/LOGO.jpg" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .btn-no-print {
            display: flex;
            text-align: right;
            padding: 10px 20px;
            background-color: #fff;
            border-bottom: 1px solid #ccc;
            height: 50px;
            width: 100%;
            justify-content: space-between;
        }

        .btn-no-print a {
            display: flex;
            align-items: center;
            text-decoration: none;
            background: #123C4B;
            color: white;
            gap: 10px;
            padding: 10px;
            width: 90px;
            border-radius: 3px;
        }

        .btn-print{
            padding-inline: 10px;
            width: 90px;
            color: white;
            background: #000;
            font-weight: bold;
            border-radius: 3px;
            border: none;
            cursor: pointer;
        }

        .kuitansi-container {
            width: 100%;
            max-width: 210mm;
            /* Lebar maksimum ukuran A4 */
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .kuitansi-header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        .kuitansi-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .kuitansi-header p {
            margin: 0;
            font-size: 14px;
            color: #555;
        }

        .kuitansi-header img {
            position: absolute;
            top: 0;
            left: 20px;
            width: 80px;
        }

        .kuitansi-info,
        .kuitansi-details,
        .kuitansi-harga {
            font-size: 16px;
            margin-bottom: 30px;
        }

        .kuitansi-info div,
        .kuitansi-details div,
        .harga-item {
            margin-bottom: 8px;
        }

        .harga-item {
            display: flex;
            justify-content: space-between;
        }

        .history-id {
            font-weight: bold;
        }

        .harga-value {
            font-weight: bold;
        }

        .total {
            font-weight: bold;
            font-size: 18px;
            border-top: 2px solid #000;
            padding-top: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 14px;
            color: #777;
        }

        @media print {
            body {
                background-color: #fff;
            }

            .kuitansi-container {
                box-shadow: none;
                border: none;
                margin: 0;
            }

            .header-container {
                box-shadow: none;
                border: none;
            }

            .btn-no-print {
                display: none;
            }
        }

        @media (max-width: 767px) {
            .header-container img {
                width: 60px;
                left: 10px;
            }

            .header-content h1 {
                font-size: 20px;
            }

            .header-content p {
                font-size: 12px;
            }

            .kuitansi-info,
            .kuitansi-details,
            .kuitansi-harga {
                font-size: 14px;
            }

            .total {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="btn-no-print">
        <a href="<?= BASEURL; ?>/user/index">
            <img width="20" class="no-print-img" src="<?= BASEURL; ?>/img/arrow-left.svg">
            <span>Kembali</span>
        </a>
        <button class="btn-print" onclick="window.print()">Print</button>
    </div>
    <div class="kuitansi-container">
        <div class="kuitansi-header">
            <?php
            $trans = $data['transactions'];
            $user = $data['data_user'];
            ?>
            <img src="<?=BASEURL?>/img/LOGO.jpg" alt="Logo TPS3R" />
            <h1>Kuitansi TPS3R</h1>
            <p>Jaticempaka, Pondok Gede, Kota Bekasi</p>
            <p>Waktu: <?= $trans['transaction_date'] ?></p>
        </div>
        <div class="kuitansi-info">
            <div class="history-id">
                <span>No. Invoice:</span>
                <span>INV/TPS3R/<?= $trans['transaction_id'] ?></span>
            </div>
            <div>
                <span>Pelanggan:</span>
                <span><?= $user['full_name'] ?></span>
            </div>
            <div>
                <span>Alamat:</span>
                <span><?= $user['address'] ?></span>
            </div>
        </div>
        <div class="kuitansi-details">
            <div>
                <span>Jenis Layanan:</span>
                <span><?= $trans['pickup_type'] ?></span>
            </div>
            <div>
                <span>Kategori:</span>
                <span><?= $trans['category_name'] ?></span>
            </div>
            <div>
                <span>Berat:</span>
                <span><?= $trans['waste_weight'] ?> Kg</span>
            </div>
            <div>
                <span>Kondisi:</span>
                <span><?= $trans['waste_condition'] ?></span>
            </div>
        </div>
        <div class="kuitansi-harga">
            <div class="harga-item">
                <span>Subtotal:</span>
                <span class="harga-value">Rp. <?= number_format(floatval($trans['waste_weight']*$trans['category_price']), 2, ",", ".")?></span>
            </div>
            <div class="harga-item">
                <span>Bonus:</span>
                <span class="harga-value">Rp. <?= number_format(floatval($trans['amount'] - ($trans['waste_weight'] * $trans['category_price'])), 2, ",", ".")?></span>
            </div>
            <div class="harga-item total">
                <span>Total:</span>
                <span class="harga-value">Rp. <?= number_format(floatval($trans['amount']), 2, ",", ".")?></span>
            </div>
        </div>
        <div class="footer">
            <p>Terima kasih atas kepercayaan Anda!</p>
            <p>TPS3R - Mitra Anda dalam Pengelolaan Sampah Berkelanjutan</p>
        </div>
    </div>
</body>

</html>