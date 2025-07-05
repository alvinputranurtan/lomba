<?php
// Data dummy hasil panen
$dummy_panen = [
    [
        'id' => 1,
        'user_id' => 2,
        'username' => 'petani_andi',
        'nama' => 'Tomat Segar',
        'harga' => 15000,
        'deskripsi' => 'Tomat hasil panen pagi, segar dan organik.',
        'gambar' => 'foto/tomat.webp'
    ],
    [
        'id' => 2,
        'user_id' => 3,
        'username' => 'petani_budi',
        'nama' => 'Cabai Merah',
        'harga' => 25000,
        'deskripsi' => 'Cabai merah super pedas, cocok untuk sambal.',
        'gambar' => 'foto/cabai merah.webp'
    ],
    [
        'id' => 3,
        'user_id' => 1,
        'username' => 'petani_sari',
        'nama' => 'Jagung Manis',
        'harga' => 12000,
        'deskripsi' => 'Jagung manis siap konsumsi, hasil panen sendiri.',
        'gambar' => 'foto/jagung manis.webp'
    ],
    [
        'id' => 4,
        'user_id' => 1,
        'username' => 'petani_sari',
        'nama' => 'Wortel Organik',
        'harga' => 18000,
        'deskripsi' => 'Wortel segar dan renyah, tanpa pestisida.',
        'gambar' => 'foto/wortel.webp'
    ],
];

// Simulasi user login
$_SESSION['user_id'] = 1; // misal user login sebagai petani_sari

// Dummy feedback untuk form
$feedback = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $feedback = '<div class="alert alert-success mt-2">Postingan berhasil diisi (dummy, tidak disimpan).</div>';
}
?>

<div class="container mt-4">

    <!-- Form Upload Dummy (aktif, tapi tidak menyimpan data) -->
    <div class="card card-custom mb-4">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Hasil Panen" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="harga" class="form-control" placeholder="Harga (Rp)" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" required>
                    </div>
                    <div class="col-md-2">
                        <input type="file" name="gambar" class="form-control" accept="image/*" required>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-success w-100">Upload</button>
                    </div>
                </div>
            </form>
            <div class="text-muted mt-2" style="font-size:0.95em;">* Data tidak benar-benar dikirim (dummy)</div>
            <?php if ($feedback)
                echo $feedback; ?>
        </div>
    </div>

    <!-- Card hasil panen dummy -->
    <div class="row">
        <?php foreach ($dummy_panen as $row): ?>
            <div class="col-md-3 mb-4">
                <div class="card card-custom h-100 shadow-sm">
                    <div style="aspect-ratio: 1/1; overflow: hidden;">
                        <img src="pages/<?php echo htmlspecialchars($row['gambar']); ?>"
                            alt="<?php echo htmlspecialchars($row['nama']); ?>"
                            style="width:100%;height:100%;object-fit:cover;">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['nama']); ?></h5>
                        <p class="card-text text-muted mb-2"><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                        <div class="mt-auto mb-2">
                            <span class="fw-bold text-success">Rp
                                <?php echo number_format($row['harga'], 0, ',', '.'); ?></span>
                            <span
                                class="badge bg-secondary float-end"><?php echo htmlspecialchars($row['username']); ?></span>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary btn-sm flex-fill" disabled>Beli</button>
                            <?php if ($row['user_id'] == $_SESSION['user_id']): ?>
                                <button class="btn btn-danger btn-sm flex-fill" disabled>Hapus</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>