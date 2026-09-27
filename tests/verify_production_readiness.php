<?php
declare(strict_types=1);

echo "====================================================================\n";
echo "CLICKCODEX PRODUCTION READINESS & SEO VERIFICATION SUITE\n";
echo "====================================================================\n";

$phpBinary = 'C:\\xampp\\php\\php.exe';

$routes = [
    '/' => ['status' => 200, 'checks' => ['<!DOCTYPE html>', 'Click Codex', 'schema.org', 'canonical', 'Organization', 'WebSite']],
    '/aboutus' => ['status' => 200, 'checks' => ['About Click Codex', 'canonical', 'schema.org', 'BreadcrumbList']],
    '/services' => ['status' => 200, 'checks' => ['Our Services', 'canonical', 'schema.org']],
    '/services/full-stack-web-development' => ['status' => 200, 'checks' => ['Full-Stack Web Development', 'canonical', 'Service']],
    '/service-finder' => ['status' => 200, 'checks' => ['Solution Advisor', 'canonical']],
    '/portfolio' => ['status' => 200, 'checks' => ['Portfolio', 'canonical']],
    '/pricing' => ['status' => 200, 'checks' => ['Pricing', 'canonical']],
    '/blogs' => ['status' => 200, 'checks' => ['Blogs', 'canonical']],
    '/blogs/how-to-choose-the-right-website-for-your-business' => ['status' => 200, 'checks' => ['How to Choose the Right Type of Website', 'BlogPosting', 'canonical']],
    '/contactus' => ['status' => 200, 'checks' => ['Contact Us', 'canonical']],
    '/privacy-policy' => ['status' => 200, 'checks' => ['Privacy Policy', 'canonical']],
    '/terms-of-service' => ['status' => 200, 'checks' => ['Terms of Service', 'canonical']],
    '/sitemap.xml' => ['status' => 200, 'checks' => ['<?xml', '<urlset', '/services/', '/blogs/']],
    '/robots.txt' => ['status' => 200, 'checks' => ['User-agent:', 'Disallow: /admin/', 'Sitemap:']],
    '/route-that-does-not-exist' => ['status' => 404, 'checks' => ['404', 'Return to Homepage', 'noindex']]
];

$passCount = 0;
$totalCount = count($routes);

// Runner script template
$runnerTemplate = <<<'RUNNER'
<?php
register_shutdown_function(function() {
    $code = http_response_code() ?: 200;
    $output = ob_get_contents();
    echo "\nHTTP_CODE:" . $code . "\n";
    echo "BODY_START\n";
    echo $output;
});
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['REQUEST_URI'] = '%s';
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['HTTP_HOST'] = 'localhost';
ob_start();
require __DIR__ . '/../index.php';
RUNNER;

foreach ($routes as $uri => $spec) {
    $script = sprintf($runnerTemplate, $uri);
    $tmpFile = __DIR__ . '/_run_tmp.php';
    file_put_contents($tmpFile, $script);

    $cmd = "\"{$phpBinary}\" \"{$tmpFile}\"";
    $output = shell_exec($cmd) ?: '';
    @unlink($tmpFile);

    preg_match('/HTTP_CODE:(\d+)/', $output, $mCode);
    $code = isset($mCode[1]) ? (int)$mCode[1] : 0;

    $bodyPos = strpos($output, "BODY_START\n");
    $body = $bodyPos !== false ? substr($output, $bodyPos + 11) : $output;

    $passed = true;
    $errors = [];

    if ($code !== $spec['status']) {
        $passed = false;
        $errors[] = "Expected HTTP {$spec['status']}, got {$code}";
    }

    foreach ($spec['checks'] as $chk) {
        if (strpos($body, $chk) === false) {
            $passed = false;
            $errors[] = "Missing needle: '{$chk}'";
        }
    }

    if ($passed) {
        echo "✓ PASS [HTTP {$code}] {$uri}\n";
        $passCount++;
    } else {
        echo "✗ FAIL [HTTP {$code}] {$uri} -> " . implode(', ', $errors) . "\n";
    }
}

echo "--------------------------------------------------------------------\n";
echo "SUMMARY: {$passCount} / {$totalCount} ROUTE TESTS PASSED (" . round(($passCount / $totalCount) * 100) . "%)\n";

// Verify manifest
$manifestPath = __DIR__ . '/../public/site.webmanifest';
if (file_exists($manifestPath)) {
    $manifestData = json_decode(file_get_contents($manifestPath), true);
    if (!empty($manifestData['name'])) {
        echo "✓ PASS site.webmanifest is valid JSON ({$manifestData['name']})\n";
    } else {
        echo "✗ FAIL site.webmanifest JSON invalid\n";
    }
} else {
    echo "✗ FAIL site.webmanifest not found\n";
}

// Verify robots.txt physical file
if (file_exists(__DIR__ . '/../robots.txt')) {
    echo "✓ PASS physical robots.txt exists in root\n";
} else {
    echo "✗ FAIL physical robots.txt missing\n";
}

// Verify sitemap.xml physical file
if (file_exists(__DIR__ . '/../sitemap.xml')) {
    echo "✓ PASS physical sitemap.xml exists in root\n";
} else {
    echo "✗ FAIL physical sitemap.xml missing\n";
}

echo "====================================================================\n";
