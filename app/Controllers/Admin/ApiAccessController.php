<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Models\Admin\AdminModel;
use App\Middleware\AuthMiddleware;

class ApiAccessController {
    /**
     * Render API Access & Key Management Hub
     */
    public function index(): void {
        AuthMiddleware::check();

        $model = new AdminModel();
        $apiKeys = $model->getApiKeys();
        $stats = $model->getDashboardStats();

        $currentUser = $_SESSION['admin_user'] ?? [
            'id' => 1,
            'name' => 'Lead Architect Admin',
            'role' => 'super_admin',
            'email' => 'admin@clickcodex.com',
            'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop&crop=face'
        ];

        $pageTitle = "API Access & Secret Key Generator | ClickCodex Studio Console";
        $topbarTitle = "REST API Access & Keys";
        $activeNav = 'api_access';

        include __DIR__ . '/../../Views/admin/api-access.php';
    }

    /**
     * Generate new API key
     */
    public function create(): void {
        AuthMiddleware::check();
        header('Content-Type: application/json; charset=utf-8');

        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $name = trim((string)($input['name'] ?? ''));
        $scopes = $input['scopes'] ?? ['services:read', 'articles:read'];
        $actorId = (int)($_SESSION['admin_user']['id'] ?? 1);

        if (empty($name)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Please provide an application or key identifier name.']);
            exit;
        }

        $model = new AdminModel();
        $result = $model->createApiKey($name, $scopes, $actorId);

        if (!$result['success']) {
            http_response_code(400);
        }

        echo json_encode($result);
        exit;
    }

    /**
     * Toggle active state
     */
    public function toggle(): void {
        AuthMiddleware::check();
        header('Content-Type: application/json; charset=utf-8');

        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $id = (int)($input['id'] ?? 0);
        $actorId = (int)($_SESSION['admin_user']['id'] ?? 1);

        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Invalid key ID.']);
            exit;
        }

        $model = new AdminModel();
        $result = $model->toggleApiKey($id, $actorId);

        echo json_encode($result);
        exit;
    }

    /**
     * Revoke API key
     */
    public function revoke(): void {
        AuthMiddleware::check();
        header('Content-Type: application/json; charset=utf-8');

        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $id = (int)($input['id'] ?? 0);
        $actorId = (int)($_SESSION['admin_user']['id'] ?? 1);

        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Invalid key ID.']);
            exit;
        }

        $model = new AdminModel();
        $result = $model->revokeApiKey($id, $actorId);

        echo json_encode($result);
        exit;
    }
}
