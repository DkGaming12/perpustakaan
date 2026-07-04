<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$user = \App\Models\User::first();
\Illuminate\Support\Facades\Auth::login($user);

$request = \Illuminate\Http\Request::create('/transaksi/laporan/pdf', 'GET');
$controller = app(\App\Http\Controllers\TransaksiController::class);
$response = $controller->exportPdf($request);

echo "Headers:\n";
foreach ($response->headers->all() as $name => $values) {
    echo $name . ": " . implode(", ", $values) . "\n";
}
