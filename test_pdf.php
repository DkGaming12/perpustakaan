<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
try {
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML('<h1>Test</h1>');
    $out = $pdf->output();
    echo 'SUCCESS: ' . strlen($out) . ' bytes';
} catch (\Exception $e) {
    echo 'ERROR: ' . $e->getMessage();
}
