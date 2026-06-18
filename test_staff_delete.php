<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$email = $argv[1] ?? 'dd@yopmail.com';
$user = App\Models\User::where('email', $email)->with('staff')->first();
if (!$user) { echo "User not found: $email\n"; exit(1); }

echo "User {$user->id} ({$user->email}) role_id={$user->role_id} staff=" . ($user->staff ? 'yes' : 'no') . "\n";
echo "Events: " . count($user->event) . "\n";
echo "Wallet: " . Modules\Wallet\Entities\WalletBalance::where('user_id', $user->id)->count() . "\n";
echo "Seller products: " . (class_exists(Modules\Seller\Entities\SellerProduct::class) ? Modules\Seller\Entities\SellerProduct::where('user_id', $user->id)->count() : 0) . "\n";

try {
    app(\App\Repositories\UserRepository::class)->delete($user->id);
    echo "DELETE OK - user exists: " . (App\Models\User::find($user->id) ? 'yes' : 'no') . "\n";
} catch (Throwable $e) {
    echo "DELETE FAILED: {$e->getMessage()}\n{$e->getFile()}:{$e->getLine()}\n";
}
