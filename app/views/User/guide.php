<main>
    <section class="card-menu">
        <h2>List Harga Sampah</h2>
        <table>
            <thead>
                <tr>
                    <th>Jenis Sampah</th>
                    <th>Harga per Kg</th>
                    <th>Contoh Sampah</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($data['categories'])) :
                    foreach ($data['categories'] as $category) : ?>
                        <tr>
                            <td><?= $category['category_name'] ?></td>
                            <td>Rp. <?= number_format($category['category_price'], 2, ",", ".") ?></td>
                            <td><a href="<?= BASEURL ?>/uploads/<?= $category['category_image'] ?>" target="_blank">
                                    <img width="80px;" src="<?= BASEURL ?>/uploads/<?= $category['category_image'] ?>" alt="<?= $category['category_name'] ?>">
                                </a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3">Tidak ada data yang ditemukan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
    <section class="card-menu">
        <h2>Tutorial Tukar Sampah</h2>
        <ol>
            <li>Login ke akun Anda di aplikasi E-Sabililah.</li>
            <li>Pilih jenis sampah yang akan ditukar.</li>
            <li>Pilih waktu penukaran ketika sampah Anda ingin ditukar.</li>
            <li>Pilih metode penukaran : langsung dan dijemput oleh petugas.</li>
            <li>Berikan catatan tambahan jika Anda perlukan.</li>
            <li>Klik tombol "Tukar Sampah".</li>
            <li>Tunggu konfirmasi dari admin setelah proses pengolahan sampah.</li>
            <li>Untuk mencairkan saldo, klik "Tarik Saldo" di beranda dan hubungi admin melalui WhatsApp.</li>
        </ol>
    </section>
    <section class="card-menu">
        <h2>Edit Profil dan Ganti Password</h2>
        <ol>
            <li>Akses profil Anda dari menu utama.</li>
            <li>Edit informasi pribadi Anda seperti nama, alamat, dan nomor telepon.</li>
            <li>Ubah kata sandi Anda melalui opsi "Ubah Kata Sandi".</li>
        </ol>
    </section>
</main>