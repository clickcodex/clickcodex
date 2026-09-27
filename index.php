<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

// 1. Load Environment Variables from .env if present
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    foreach ($_ENV as $key => $value) {
        putenv("$key=$value");
    }
}

// 2. Production vs Development Error Configuration
$appEnv = $_ENV['APP_ENV'] ?? getenv('APP_ENV') ?: 'production';
$appDebug = filter_var($_ENV['APP_DEBUG'] ?? getenv('APP_DEBUG') ?: false, FILTER_VALIDATE_BOOLEAN);

if ($appDebug || $appEnv === 'development' || $appEnv === 'local') {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
    ini_set('log_errors', '1');

    $logDir = __DIR__ . '/storage/logs';
    if (!is_dir($logDir)) {
        @mkdir($logDir, 0755, true);
    }
    ini_set('error_log', $logDir . '/error.log');

    // Production Global Unhandled Exception Handler
    set_exception_handler(function (\Throwable $e) {
        $logDir = __DIR__ . '/storage/logs';
        $msg = sprintf("[%s] Unhandled Exception: %s in %s:%d\nStack Trace:\n%s\n\n",
            date('Y-m-d H:i:s'),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $e->getTraceAsString()
        );
        @file_put_contents($logDir . '/error.log', $msg, FILE_APPEND);

        http_response_code(500);
        if (file_exists(__DIR__ . '/app/Views/errors/500.php')) {
            require __DIR__ . '/app/Views/errors/500.php';
        } else {
            echo "<h1>500 Internal Server Error</h1>";
        }
        exit;
    });

    // Production Fatal Error Shutdown Handler
    register_shutdown_function(function () {
        $err = error_get_last();
        if ($err && in_array($err['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
            $logDir = __DIR__ . '/storage/logs';
            $msg = sprintf("[%s] Fatal Error: %s in %s:%d\n\n",
                date('Y-m-d H:i:s'),
                $err['message'],
                $err['file'],
                $err['line']
            );
            @file_put_contents($logDir . '/error.log', $msg, FILE_APPEND);

            if (!headers_sent()) {
                http_response_code(500);
                if (file_exists(__DIR__ . '/app/Views/errors/500.php')) {
                    require __DIR__ . '/app/Views/errors/500.php';
                } else {
                    echo "<h1>500 Internal Server Error</h1>";
                }
            }
        }
    });
}

// 3. Robust BASE_URL Resolution (Clean, no backslashes, supports live & localhost)
$configuredUrl = $_ENV['APP_URL'] ?? getenv('APP_URL') ?: null;
if (!empty($configuredUrl)) {
    define('BASE_URL', rtrim($configuredUrl, '/'));
} elseif (isset($_SERVER['HTTP_HOST'])) {
    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') 
            || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
    $protocol = $isHttps ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
    $basePath = rtrim($scriptDir, '/');
    define('BASE_URL', $protocol . '://' . $host . $basePath);
} else {
    define('BASE_URL', '');
}

// 4. Resolve Route via Router
require_once __DIR__ . '/app/routes.php';