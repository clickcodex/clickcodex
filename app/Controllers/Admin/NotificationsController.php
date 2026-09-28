<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Models\Admin\AdminModel;
use App\Middleware\AuthMiddleware;

class NotificationsController {
    /**
     * Render Centralized Notifications Center
     */
    public function index(): void {
        AuthMiddleware::check();

        $category = trim((string)($_GET['category'] ?? 'all'));
        if (!in_array($category, ['all', 'inquiry', 'security', 'system', 'milestone'], true)) {
            $category = 'all';
        }

        $model = new AdminModel();
        $notifications = $model->getSystemNotifications($category, 100);
        $stats = $model->getDashboardStats();

        // Calculate unread count
        $unreadCount = 0;
        foreach ($notifications as $n) {
            if ((int)$n['is_read'] === 0) {
                $unreadCount++;
            }
        }

        $currentUser = $_SESSION['admin_user'] ?? [
            'id' => 1,
            'name' => 'Lead Architect Admin',
            'role' => 'super_admin',
            'email' => 'admin@clickcodex.com',
            'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop&crop=face'
        ];

        $pageTitle = "Notifications Center | ClickCodex Studio Console";
        $topbarTitle = "Notifications Center";
        $activeNav = 'notifications';

        include __DIR__ . '/../../Views/admin/notifications.php';
    }

    /**
     * Mark single notification as read
     */
    public function markRead(): void {
        AuthMiddleware::check();
        header('Content-Type: application/json; charset=utf-8');

        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $id = (int)($input['id'] ?? 0);

        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Invalid notification ID.']);
            exit;
        }

        $model = new AdminModel();
        $result = $model->markNotificationRead($id);

        echo json_encode($result);
        exit;
    }

    /**
     * Mark all notifications as read
     */
    public function markAllRead(): void {
        AuthMiddleware::check();
        header('Content-Type: application/json; charset=utf-8');

        $model = new AdminModel();
        $result = $model->markAllNotificationsRead();

        echo json_encode($result);
        exit;
    }

    /**
     * Clear all read notifications
     */
    public function clear(): void {
        AuthMiddleware::check();
        header('Content-Type: application/json; charset=utf-8');

        $model = new AdminModel();
        $result = $model->clearReadNotifications();

        echo json_encode($result);
        exit;
    }
}
