<?php
// === KONFIGURASI ===
$expectedToken = 'mysecrettoken123';
$branch = 'main';
$path = '/home/telkomam/public_html/lomba.telkomambis.com';

// === VALIDASI TOKEN ===
if (!isset($_GET['token']) || $_GET['token'] !== $expectedToken) {
    http_response_code(403);
    echo "Access denied!";
    exit;
}

// === EKSEKUSI GIT PULL ===
$output = [];
exec("cd $path && git pull origin $branch 2>&1", $output, $return_var);

// === SIMPAN LOG KE FILE ===
file_put_contents($path . '/deploy-log.txt', implode("\n", $output));

// === TAMPILKAN HASIL KE BROWSER ===
echo "<pre>";
echo "Return Code: $return_var\n";
echo "Output:\n" . implode("\n", $output);
echo "</pre>";
?>