<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    // Login as first user
    $user = \App\Models\User::first();
    if($user) {
        \Illuminate\Support\Facades\Auth::login($user);
    }
    
    $request = \Illuminate\Http\Request::create('/transaksi/laporan/pdf', 'GET');
    $controller = app(\App\Http\Controllers\TransaksiController::class);
    $response = $controller->exportPdf($request);
    
    // Check if it's an exception or a download response
    if (method_exists($response, 'getFile')) {
        echo "SUCCESS PDF FILE\n";
    } else {
        echo "Response class: " . get_class($response) . "\n";
        echo "Content: \n" . substr($response->getContent(), 0, 500);
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
