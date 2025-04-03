<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= BASEURL; ?>/img/LOGO.jpg" type="image/x-icon">
    <title><?= $data['title'] ?> - Aplikasi E-Sabililah</title>
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .container,
            .container * {
                visibility: visible;
            }

            .container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                max-width: 210mm;
                margin: 0;
                padding: 20mm;
                border: none;
                box-shadow: none;
            }

            @page {
                size: A4;
                margin: 0;
            }

            .no-print {
                display: none;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            position: relative;
        }

        .no-print {
            position: fixed;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            z-index: 1000;
            background: #ffffff;
            padding: 10px 20px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            border-bottom: 2px solid #e0e0e0;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .no-print-img {
            width: 20px;
            margin-right: 10px;
        }

        .text-header {
            font-size: clamp(1rem, 2.5vw, 1.2rem);
            font-weight: 600;
            line-height: 35px;
            color: #333;
        }

        .btn-no-print {
            margin-right: 3%;
            display: flex;
            gap: 12px;
        }

        .no-print a,
        .no-print button {
            padding: 12px 24px;
            font-size: 16px;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
        }

        .no-print a {
            background-color: #6c757d;
        }

        .no-print button {
            background-color: #007bff;
        }

        .no-print a:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }

        .no-print button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .container {
            width: 100%;
            max-width: 210mm;
            margin: 0 auto;
            background: #ffffff;
            padding: 20mm;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 150px;
            height: auto;
        }

        .header h1 {
            margin: 10px 0;
            font-size: 28px;
            font-weight: bold;
        }

        .header p {
            margin: 5px 0;
            font-size: 16px;
        }

        .document-title {
            text-align: center;
            margin: 0px 0 30px;
            font-size: 24px;
            font-weight: bold;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        td {
            vertical-align: middle;
            align-items: center;
        }

        .product-img img {
            max-width: 100px;
            height: auto;
        }

        .name-tabel {
            margin: 10%;
        }
    </style>
</head>

<body>
    <div class="no-print">
        <span class="text-header"><?= $data['text-header'] ?></span>
        <div class="btn-no-print">
            <a href="<?= BASEURL; ?>/admin/categoryData">
                <img class="no-print-img" src="<?= BASEURL; ?>/img/arrow-left.svg" alt="">
                <span>Kembali</span>
            </a>
            <button onclick="window.print()">Print</button>
        </div>
    </div>

    <div class="container">
        <div class="header">
            <img src="<?= BASEURL; ?>/img/LOGO.jpg" alt="Logo Perusahaan">
            <h1>TPS3R KPP BINA LINDUNG</h1>
            <p>Alamat: Komplek Bina Lindung, Jl. Binasiswa l, Jaticempaka, Kota Bekasi</p>
            <p>Telepon: 0813-1109-9171 | Email: info@tps3rjaticempaka.co.id</p>
            <p>Tanggal: <?= $data['waktu'] ?></p>
        </div>

        <div class="document-title">Daftar Kategori Sampah</div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>ID</th>
                    <th>Harga</th>
                    <th>Unit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                foreach ($data['categories'] as $category) :
                ?>
                    <tr>
                        <td><?= $number ?></td>
                        <td class="product-img">
                            <img src="<?= BASEURL; ?>/uploads/<?= $category['category_image'] ?>" alt="product" />
                            <p class="name-tabel"><?= $category['category_name'] ?></p>
                        </td>
                        <td>SMPH-<?= $category['category_id'] ?></td>
                        <td><?php echo " " . number_format(floatval($category['category_price']), 2, ",", "."); ?></td>
                        <td>Kg</td>
                    </tr>
                <?php
                    $number++;
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
