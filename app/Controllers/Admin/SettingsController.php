<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Models\Admin\AdminModel;
use App\Middleware\AuthMiddleware;

class SettingsController {
    /**
     * Render the Global Site Settings & Configuration Management Console
     */
    public function index(): void {
        AuthMiddleware::check();

        $model = new AdminModel();

        // Retrieve settings organized by operational domain
        $groups        = $model->getSettingsGrouped();
        $settingsStats = $model->getSettingsStats();
        $stats         = $model->getDashboardStats();

        $currentUser = $_SESSION['admin_user'] ?? [
            'id' => 1,
            'name' => 'Lead Architect Admin',
            'role' => 'super_admin',
            'email' => 'admin@clickcodex.com',
            'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop&crop=face'
        ];

        $flashSuccess = $_SESSION['flash_success'] ?? null;
        $flashError   = $_SESSION['flash_error'] ?? null;
        unset($_SESSION['flash_success'], $_SESSION['flash_error']);

        $pageTitle   = "Global Site Settings & Studio Configuration | ClickCodex Admin";
        $topbarTitle = "Site Settings & Configuration";
        $activeNav   = 'settings';

        include __DIR__ . '/../../Views/admin/settings.php';
    }

    /**
     * Handle batch updates from setting tabs or forms
     */
    public function saveBatch(): void {
        AuthMiddleware::check();

        $actorId = (int)($_SESSION['admin_user']['id'] ?? 1);
        $model = new AdminModel();

        // Detect if JSON or AJAX request
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $isJson = strpos($contentType, 'application/json') !== false;
        $isAjax = $isJson 
            || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
            || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);

        if ($isJson) {
            $input = json_decode(file_get_contents('php://input'), true) ?: [];
            $settings = $input['settings'] ?? $input;
        } else {
            $settings = $_POST['settings'] ?? [];
            
            // Handle checkboxes that might not be submitted if unchecked
            $group = trim((string)($_POST['current_group'] ?? ''));
            if ($group === 'legal' && !isset($settings['cookie_consent_enabled'])) {
                $settings['cookie_consent_enabled'] = '0';
            }
            if ($group === 'general' && !isset($settings['maintenance_mode'])) {
                $settings['maintenance_mode'] = '0';
            }
        }

        if (!is_array($settings) || empty($settings)) {
            if ($isAjax) {
                http_response_code(400);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['success' => false, 'error' => 'No settings data supplied for update.']);
                exit;
            }
            $_SESSION['flash_error'] = 'No settings were received for update.';
            header('Location: ' . (defined('BASE_URL') ? BASE_URL : '') . '/admin/settings');
            exit;
        }

        $result = $model->saveSettingsBatch($settings, $actorId);

        if ($isAjax) {
            header('Content-Type: application/json; charset=utf-8');
            if (!$result['success']) {
                http_response_code(400);
            }
            echo json_encode($result);
            exit;
        }

        if ($result['success']) {
            $_SESSION['flash_success'] = $result['message'];
        } else {
            $_SESSION['flash_error'] = $result['error'] ?? 'Failed to update settings.';
        }

        $redirectTab = !empty($_POST['current_group']) ? '?tab=' . urlencode((string)$_POST['current_group']) : '';
        header('Location: ' . (defined('BASE_URL') ? BASE_URL : '') . '/admin/settings' . $redirectTab);
        exit;
    }

    /**
     * AJAX endpoint to save or toggle an individual setting
     */
    public function saveSingle(): void {
        AuthMiddleware::check();
        header('Content-Type: application/json; charset=utf-8');

        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $key = trim((string)($input['key'] ?? ''));
        $value = $input['value'] ?? null;
        $actorId = (int)($_SESSION['admin_user']['id'] ?? 1);

        if ($key === '' || $value === null) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Setting key and value are required.']);
            exit;
        }

        $model = new AdminModel();
        $res = $model->saveSetting($key, $value, null, null, null, null, $actorId);

        if (!$res['success']) {
            http_response_code(500);
        }
        echo json_encode($res);
        exit;
    }

    /**
     * Create a brand new custom site setting
     */
    public function create(): void {
        AuthMiddleware::check();
        header('Content-Type: application/json; charset=utf-8');

        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $actorId = (int)($_SESSION['admin_user']['id'] ?? 1);

        $key = preg_replace('/[^a-z0-9_]/', '', strtolower(trim((string)($input['setting_key'] ?? ''))));
        $val = trim((string)($input['setting_value'] ?? ''));
        $group = trim((string)($input['setting_group'] ?? 'general'));
        $type = trim((string)($input['value_type'] ?? 'string'));
        $desc = trim((string)($input['description'] ?? ''));
        $isPublic = isset($input['is_public']) ? (int)$input['is_public'] : 1;

        if (empty($key)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Valid alphanumeric setting key is required.']);
            exit;
        }

        $allowedGroups = ['general', 'contact', 'branding', 'seo', 'social', 'analytics', 'scripts', 'legal'];
        if (!in_array($group, $allowedGroups, true)) {
            $group = 'general';
        }

        $allowedTypes = ['string', 'text', 'boolean', 'integer', 'json'];
        if (!in_array($type, $allowedTypes, true)) {
            $type = 'string';
        }

        $model = new AdminModel();
        $res = $model->saveSetting($key, $val, $group, $type, $desc, $isPublic, $actorId);

        echo json_encode($res);
        exit;
    }

    /**
     * Remove a custom setting from the database
     */
    public function delete(): void {
        AuthMiddleware::check();
        header('Content-Type: application/json; charset=utf-8');

        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $key = trim((string)($input['key'] ?? ''));
        $actorId = (int)($_SESSION['admin_user']['id'] ?? 1);

        // Core protected keys that cannot be deleted
        $protectedKeys = [
            'company_name', 'site_name', 'contact_email', 'contact_phone', 
            'site_logo', 'default_meta_title', 'brand_primary_color'
        ];

        if (in_array($key, $protectedKeys, true)) {
            http_response_code(403);
            echo json_encode(['success' => false, 'error' => "Core setting '{$key}' is protected and cannot be deleted."]);
            exit;
        }

        if (empty($key)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Key is required for deletion.']);
            exit;
        }

        $model = new AdminModel();
        $res = $model->deleteSetting($key, $actorId);

        echo json_encode($res);
        exit;
    }

    /**
     * Export all configuration parameters as a downloadable JSON file
     */
    public function export(): void {
        AuthMiddleware::check();

        $model = new AdminModel();
        $json = $model->exportSettingsJson();

        $filename = 'clickcodex_site_settings_' . date('Y-m-d_His') . '.json';
        header('Content-Type: application/json; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($json));
        header('Pragma: no-cache');
        header('Expires: 0');

        echo $json;
        exit;
    }

    /**
     * Import site configuration from an uploaded JSON document
     */
    public function import(): void {
        AuthMiddleware::check();
        header('Content-Type: application/json; charset=utf-8');

        $actorId = (int)($_SESSION['admin_user']['id'] ?? 1);
        $jsonContent = '';

        if (!empty($_FILES['settings_file']['tmp_name'])) {
            $jsonContent = (string)file_get_contents($_FILES['settings_file']['tmp_name']);
        } elseif (!empty($_POST['json_payload'])) {
            $jsonContent = (string)$_POST['json_payload'];
        } else {
            $raw = file_get_contents('php://input');
            $decoded = json_decode($raw, true);
            if (!empty($decoded['json_payload'])) {
                $jsonContent = (string)$decoded['json_payload'];
            } elseif ($raw && isset($decoded['settings'])) {
                $jsonContent = $raw;
            }
        }

        if (trim($jsonContent) === '') {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'No valid JSON settings file or text payload provided.']);
            exit;
        }

        $model = new AdminModel();
        $res = $model->importSettingsJson($jsonContent, $actorId);

        echo json_encode($res);
        exit;
    }

    /**
     * Flush runtime storage caches & transients
     */
    public function clearCache(): void {
        AuthMiddleware::check();
        header('Content-Type: application/json; charset=utf-8');

        $cacheDir = __DIR__ . '/../../../storage/cache';
        $cleared = 0;
        if (is_dir($cacheDir)) {
            $files = glob($cacheDir . '/*');
            if ($files) {
                foreach ($files as $file) {
                    if (is_file($file)) {
                        @unlink($file);
                        $cleared++;
                    }
                }
            }
        }

        if (function_exists('opcache_reset')) {
            @opcache_reset();
        }

        $actorId = (int)($_SESSION['admin_user']['id'] ?? 1);
        $model = new AdminModel();
        $model->logAction($actorId, 'settings_cache_clear', 'site_settings', 0, ['cleared_files' => $cleared]);

        echo json_encode([
            'success' => true,
            'message' => "Runtime caches purged successfully. ({$cleared} cache tokens flushed)"
        ]);
        exit;
    }
}
