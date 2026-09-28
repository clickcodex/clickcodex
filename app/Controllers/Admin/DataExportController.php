<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Models\Admin\AdminModel;
use App\Config\Database;
use App\Middleware\AuthMiddleware;

class DataExportController {
    /**
     * Render Data Export & System Snapshot Center
     */
    public function index(): void {
        AuthMiddleware::check();

        $db = Database::connect();
        $tables = [];

        $res = $db->query("
            SELECT 
                TABLE_NAME AS name, 
                TABLE_ROWS AS rows_count, 
                DATA_LENGTH AS data_size, 
                INDEX_LENGTH AS index_size,
                UPDATE_TIME AS updated_at
            FROM information_schema.TABLES 
            WHERE TABLE_SCHEMA = 'clickcodex_db'
            ORDER BY TABLE_NAME ASC
        ");

        $totalRows = 0;
        $totalBytes = 0;

        if ($res) {
            while ($row = $res->fetch_assoc()) {
                $bytes = (int)($row['data_size'] ?? 0) + (int)($row['index_size'] ?? 0);
                $totalRows += (int)($row['rows_count'] ?? 0);
                $totalBytes += $bytes;

                $tables[] = [
                    'name' => $row['name'],
                    'rows' => (int)$row['rows_count'],
                    'size_formatted' => $this->formatBytes($bytes),
                    'updated_at' => $row['updated_at'] ? date('M d, Y H:i', strtotime($row['updated_at'])) : 'Recent'
                ];
            }
        }

        $model = new AdminModel();
        $stats = $model->getDashboardStats();

        $currentUser = $_SESSION['admin_user'] ?? [
            'id' => 1,
            'name' => 'Lead Architect Admin',
            'role' => 'super_admin',
            'email' => 'admin@clickcodex.com',
            'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop&crop=face'
        ];

        $pageTitle = "Data Export & System Snapshots | ClickCodex Studio Console";
        $topbarTitle = "Data Export & System Backups";
        $activeNav = 'data_export';

        $totalSizeFormatted = $this->formatBytes($totalBytes);

        include __DIR__ . '/../../Views/admin/data-export.php';
    }

    /**
     * Download full database as SQL dump
     */
    public function downloadSql(): void {
        AuthMiddleware::check();

        $model = new AdminModel();
        $sql = $model->exportDatabaseSql();

        $filename = "clickcodex_backup_" . date('Ymd_His') . ".sql";
        header('Content-Type: application/sql; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($sql));

        echo $sql;
        exit;
    }

    /**
     * Download system snapshot as comprehensive JSON
     */
    public function downloadJson(): void {
        AuthMiddleware::check();

        $db = Database::connect();
        $tables = [
            'site_settings',
            'contact_inquiries',
            'services',
            'case_studies',
            'blog_posts',
            'faqs',
            'advisor_submissions',
            'webhook_integrations'
        ];

        $data = [
            'meta' => [
                'system' => 'ClickCodex Technologies Studio Console',
                'version' => '2.0.0',
                'exported_at' => date('c'),
                'author' => $_SESSION['admin_user']['name'] ?? 'Super Admin'
            ],
            'tables' => []
        ];

        foreach ($tables as $t) {
            $res = $db->query("SELECT * FROM `{$t}`");
            $rows = [];
            if ($res) {
                while ($r = $res->fetch_assoc()) {
                    $rows[] = $r;
                }
            }
            $data['tables'][$t] = $rows;
        }

        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $filename = "clickcodex_snapshot_" . date('Ymd_His') . ".json";

        header('Content-Type: application/json; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($json));

        echo $json;
        exit;
    }

    /**
     * Download individual table CSV
     */
    public function downloadCsv(): void {
        AuthMiddleware::check();

        $table = trim((string)($_GET['table'] ?? 'contact_inquiries'));
        $allowed = [
            'contact_inquiries',
            'services',
            'case_studies',
            'blog_posts',
            'site_settings',
            'audit_logs',
            'advisor_submissions'
        ];

        if (!in_array($table, $allowed, true)) {
            http_response_code(400);
            die("Table '{$table}' is not eligible for direct CSV export.");
        }

        $db = Database::connect();
        $res = $db->query("SELECT * FROM `{$table}`");

        $filename = "clickcodex_{$table}_" . date('Ymd_His') . ".csv";
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $out = fopen('php://output', 'w');

        if ($res && $res->num_rows > 0) {
            // Write column headers
            $first = $res->fetch_assoc();
            fputcsv($out, array_keys($first));
            fputcsv($out, array_values($first));

            while ($row = $res->fetch_assoc()) {
                fputcsv($out, array_values($row));
            }
        } else {
            fputcsv($out, ['No records found in table ' . $table]);
        }

        fclose($out);
        exit;
    }

    private function formatBytes(int $bytes): string {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        }
        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 1) . ' KB';
        }
        return $bytes . ' B';
    }
}
