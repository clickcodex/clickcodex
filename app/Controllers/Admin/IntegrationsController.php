<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Models\Admin\AdminModel;
use App\Middleware\AuthMiddleware;

class IntegrationsController {
    /**
     * Render Integrations Management Hub
     */
    public function index(): void {
        AuthMiddleware::check();

        $model = new AdminModel();
        $webhooks = $model->getWebhooks();
        $stats = $model->getDashboardStats();

        $currentUser = $_SESSION['admin_user'] ?? [
            'id' => 1,
            'name' => 'Lead Architect Admin',
            'role' => 'super_admin',
            'email' => 'admin@clickcodex.com',
            'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop&crop=face'
        ];

        $pageTitle = "Third-Party Webhooks & Integrations | ClickCodex Studio Console";
        $topbarTitle = "Third-Party Integrations";
        $activeNav = 'integrations';

        include __DIR__ . '/../../Views/admin/integrations.php';
    }

    /**
     * Save / Update a webhook
     */
    public function save(): void {
        AuthMiddleware::check();
        header('Content-Type: application/json; charset=utf-8');

        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $actorId = (int)($_SESSION['admin_user']['id'] ?? 1);

        $model = new AdminModel();
        $result = $model->saveWebhook($input, $actorId);

        if (!$result['success']) {
            http_response_code(400);
        }

        echo json_encode($result);
        exit;
    }

    /**
     * Delete a webhook
     */
    public function delete(): void {
        AuthMiddleware::check();
        header('Content-Type: application/json; charset=utf-8');

        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $id = (int)($input['id'] ?? 0);
        $actorId = (int)($_SESSION['admin_user']['id'] ?? 1);

        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Invalid webhook ID.']);
            exit;
        }

        $model = new AdminModel();
        $result = $model->deleteWebhook($id, $actorId);

        if (!$result['success']) {
            http_response_code(400);
        }

        echo json_encode($result);
        exit;
    }

    /**
     * Test ping a webhook
     */
    public function test(): void {
        AuthMiddleware::check();
        header('Content-Type: application/json; charset=utf-8');

        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $id = (int)($input['id'] ?? 0);

        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Invalid webhook ID.']);
            exit;
        }

        $model = new AdminModel();
        $result = $model->testWebhook($id);

        echo json_encode($result);
        exit;
    }
}
