<?php
// Contoh array produk
$products = [
    [
        'name' => 'Pupuk Organik',
        'price' => 'Rp 25.000',
        'image' => 'assets/foto/fertilizer.webp',
        'desc' => 'Pupuk organik berkualitas untuk tanaman Anda.'
    ],
    [
        'name' => 'Cangkul',
        'price' => 'Rp 40.000',
        'image' => 'assets/foto/cangkul.webp',
        'desc' => 'Cangkul besi kuat dan tahan lama.'
    ],
    [
        'name' => 'Bibit Cabai',
        'price' => 'Rp 10.000',
        'image' => 'assets/foto/bibitcabai.webp',
        'desc' => 'Bibit cabai unggul siap tanam.'
    ],
    [
        'name' => 'Pestisida Alami',
        'price' => 'Rp 30.000',
        'image' => 'assets/foto/pestisida.webp',
        'desc' => 'Pestisida alami ramah lingkungan.'
    ],
];
?>

<div class="container mt-4">
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-3 mb-4">
                <div class="card card-custom h-100 shadow-sm">
                    <div style="aspect-ratio: 1/1; overflow: hidden;">
                        <img src="<?php echo $product['image']; ?>" class="card-img-top"
                            alt="<?php echo $product['name']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <p class="card-text text-muted mb-2"><?php echo $product['desc']; ?></p>
                        <div class="mt-auto">
                            <span class="fw-bold text-success"><?php echo $product['price']; ?></span>
                            <a href="#" class="btn btn-primary btn-sm float-end">Beli</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>