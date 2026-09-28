<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Admin\AdminModel;
use App\Models\ContactModel;
use App\Config\Database;

class ApiController {
    /**
     * Helper to authenticate API Key from Authorization header or X-API-Key
     */
    private function authenticate(string $requiredScope = ''): ?array {
        $key = $_SERVER['HTTP_X_API_KEY'] ?? '';
        if (empty($key)) {
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
            if (preg_match('/Bearer\s+(\S+)/i', $authHeader, $matches)) {
                $key = $matches[1];
            }
        }

        if (empty($key)) {
            http_response_code(401);
            echo json_encode([
                'success' => false,
                'error' => 'Unauthorized. Please supply a valid X-API-Key or Bearer token header.'
            ]);
            exit;
        }

        $adminModel = new AdminModel();
        $auth = $adminModel->validateApiKey($key, $requiredScope);

        if (!$auth) {
            http_response_code(403);
            echo json_encode([
                'success' => false,
                'error' => "Forbidden. Invalid API key or missing scope '{$requiredScope}'."
            ]);
            exit;
        }

        return $auth;
    }

    /**
     * GET /api/v1/status
     */
    public function status(): void {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'success' => true,
            'service' => 'ClickCodex Technologies Platform API',
            'version' => '1.0.0',
            'environment' => 'production',
            'timestamp' => date('c')
        ]);
        exit;
    }

    /**
     * GET /api/v1/services
     */
    public function services(): void {
        header('Content-Type: application/json; charset=utf-8');
        $this->authenticate('services:read');

        $db = Database::connect();
        $res = $db->query("SELECT id, slug, title, short_description, full_description, icon_svg, is_featured FROM services WHERE is_active = 1 ORDER BY order_num ASC");

        $services = [];
        if ($res) {
            while ($r = $res->fetch_assoc()) {
                $services[] = $r;
            }
        }

        echo json_encode([
            'success' => true,
            'count' => count($services),
            'services' => $services
        ]);
        exit;
    }

    /**
     * GET /api/v1/articles
     */
    public function articles(): void {
        header('Content-Type: application/json; charset=utf-8');
        $this->authenticate('articles:read');

        $db = Database::connect();
        $res = $db->query("SELECT id, slug, title, excerpt, reading_time_minutes, published_at FROM blog_posts WHERE status = 'published' ORDER BY published_at DESC LIMIT 50");

        $articles = [];
        if ($res) {
            while ($r = $res->fetch_assoc()) {
                $articles[] = $r;
            }
        }

        echo json_encode([
            'success' => true,
            'count' => count($articles),
            'articles' => $articles
        ]);
        exit;
    }

    /**
     * POST /api/v1/inquiries
     */
    public function createInquiry(): void {
        header('Content-Type: application/json; charset=utf-8');
        $this->authenticate('inquiries:write');

        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        if (empty($input)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Empty request payload. Provide JSON with full_name, email, phone, etc.']);
            exit;
        }

        $input['source_page'] = $input['source_page'] ?? 'API v1 Intake';
        $contactModel = new ContactModel();
        $result = $contactModel->saveInquiry($input);

        if (!$result['success']) {
            http_response_code(400);
        }

        echo json_encode($result);
        exit;
    }
}
