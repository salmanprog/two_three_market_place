<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$rows = Illuminate\Support\Facades\DB::table('admin_notifications')->get();
foreach ($rows as $row) {
    $decoded = json_decode($row->message, true);
    if (is_array($decoded) && json_last_error() === JSON_ERROR_NONE) {
        echo "ARRAY id={$row->id} slug={$row->slug} message=".substr($row->message,0,100).PHP_EOL;
    }
}
echo 'total=' . count($rows) . PHP_EOL;
