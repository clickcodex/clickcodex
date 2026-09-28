<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
if (file_exists(__DIR__ . '/../.env')) {
    Dotenv\Dotenv::createImmutable(__DIR__ . '/..')->load();
    foreach ($_ENV as $k => $v) putenv("$k=$v");
}

$adminRoutes = [
    '/admin/login',
    '/admin/dashboard',
    '/admin/inquiries',
    '/admin/capabilities',
    '/admin/portfolio',
    '/admin/articles',
    '/admin/solution-advisor',
    '/admin/users',
    '/admin/analytics',
    '/admin/settings',
    '/admin/reporting',
    '/admin/integrations',
    '/admin/notifications',
    '/admin/data-export',
    '/admin/api-access',
    '/api/v1/status'
];

echo "=== TESTING ADMIN & API ROUTES ===\n";

$passCount = 0;
foreach ($adminRoutes as $uri) {
    $script = <<<PHP
<?php
session_start();
if ('{$uri}' !== '/admin/login') {
    \$_SESSION['admin_user'] = [
        'id' => 1,
        'name' => 'Lead Architect Admin',
        'role' => 'super_admin',
        'email' => 'admin@clickcodex.com',
        'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop&crop=face'
    ];
}
register_shutdown_function(function() {
    \$code = http_response_code() ?: 200;
    echo "\nHTTP_CODE:" . \$code . "\n";
});
\$_SERVER['REQUEST_METHOD'] = 'GET';
\$_SERVER['REQUEST_URI'] = '{$uri}';
\$_SERVER['SCRIPT_NAME'] = '/index.php';
\$_SERVER['HTTP_HOST'] = 'localhost';
ob_start();
require __DIR__ . '/../index.php';
PHP;

    $tmp = __DIR__ . '/_tmp_admin_test.php';
    file_put_contents($tmp, $script);
    $out = shell_exec("C:\\xampp\\php\\php.exe \"{$tmp}\"") ?: '';
    @unlink($tmp);

    preg_match('/HTTP_CODE:(\d+)/', $out, $m);
    $code = isset($m[1]) ? (int)$m[1] : 0;
    
    if ($code === 200) {
        echo "✓ PASS [HTTP 200] {$uri}\n";
        $passCount++;
    } else {
        echo "✗ FAIL [HTTP {$code}] {$uri}\nOutput snippet: " . substr($out, 0, 150) . "\n";
    }
}

echo "RESULT: {$passCount} / " . count($adminRoutes) . " passed.\n";
