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
        <h2>Tutorial Jemput Sampah</h2>
        <ol>
            <li>Login ke akun Anda di aplikasi E-Sabililah.</li>
            <li>Pilih tanggal dan waktu penjemputan yang sesuai.</li>
            <li>Data-data sampah yang perlu dijemput akan ditampilkan.</li>
            <li>Gunakan dua tombol berikut:
                <ul>
                    <li><strong>Cari</strong>: Untuk mencari alamat warga menggunakan Google Maps.</li>
                    <li><strong>Konfirmasi</strong>: Untuk mengonfirmasi sampah yang akan dijemput.</li>
                </ul>
            </li>
            <li>Petugas menginput data konfirmasi, termasuk:
                <ul>
                    <li>Jenis sampah</li>
                    <li>Berat</li>
                    <li>Jumlah</li>
                    <li>Kondisi</li>
                    <li>Keterangan (jika diperlukan)</li>
                </ul>
            </li>
            <li>Pilih status penjemputan:
                <ul>
                    <li><strong>Selesai</strong>: Jika sampah telah diangkut. Data akan otomatis diproses oleh admin.</li>
                    <li><strong>Sedang Dalam Perjalanan</strong>: Jika masih di dalam perjalanan.</li>
                    <li><strong>Ditunda</strong>: Jika ada penundaan pengambilan sampah.</li>
                    <li><strong>Ditolak</strong>: Jika sampah tidak dapat diproses oleh admin.</li>
                </ul>
            </li>
            <li>Klik tombol submit untuk mengkonfimasi datanya jika sudah valid.</li>
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