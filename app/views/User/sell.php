<!-- Main form -->
<form class="main-form" method="POST">
    <!-- Form title -->
    <h2>Form Tukar</h2  >
    <!-- Form container -->
    <div class="form-container">
        <!-- Left column -->
        <div class="left-column">
            <div class="form-group-sell">
                <!-- Label for waste category selection -->
                <label class="caption-input">Pilih Jenis Sampah</label>
                <!-- Dropdown for selecting waste category -->
                <select class="input-option" name="category" required>
                    <?php
                    foreach ($data['categories'] as $category) : ?>
                        <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>
            <div class="form-group-sell">
                <!-- Label for exchange time -->
                <label class="caption-input">Waktu Penukaran</label>
                <!-- Input field for entering exchange time -->
                <input class="input-datetime" type="datetime-local" name="time" required>
                <!-- Error Date Time -->
                <!-- <span id="error-message">Tanggal tidak valid. Harus tanggal hari ini atau di masa depan.</span> -->
            </div>
            <div class="form-group-sell">
                <!-- Label for exchange option -->
                <label class="caption-input">Pilihan Metode Tukar</label>
                <!-- Dropdown for selecting exchange option -->
                <select class="input-option" name="type" required>
                    <option value="Langsung">Langsung</option>
                    <option value="Dijemput">Dijemput</option>
                </select>
            </div>
        </div>
        <!-- Right column -->
        <div class="right-column">
            <div class="form-group-sell">
                <!-- Label for additional notes -->
                <label class="caption-input">Catatan Tambahan</label>
                <!-- Text area for entering additional notes -->
                <textarea rows="9" class="input-note" name="note" required></textarea>
            </div>
        </div>
    </div>
    <!-- Form buttons -->
    <div class="btn-form">
        <input class="btn-submit" type="submit" value="TUKAR" name="pickupForm">
    </div>
</form>