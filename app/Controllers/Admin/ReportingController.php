<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Models\Admin\AdminModel;
use App\Middleware\AuthMiddleware;

class ReportingController {
    /**
     * Render Executive Reporting Engine
     */
    public function index(): void {
        AuthMiddleware::check();

        $model = new AdminModel();
        $range = trim((string)($_GET['range'] ?? '30d'));
        if (!in_array($range, ['7d', '30d', '90d', '1y', 'all'], true)) {
            $range = '30d';
        }

        $report = $model->getReportingData($range);
        $stats = $model->getDashboardStats();

        $currentUser = $_SESSION['admin_user'] ?? [
            'id' => 1,
            'name' => 'Lead Architect Admin',
            'role' => 'super_admin',
            'email' => 'admin@clickcodex.com',
            'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop&crop=face'
        ];

        $pageTitle = "Executive Reporting Engine | ClickCodex Studio Console";
        $topbarTitle = "Executive Reporting Engine";
        $activeNav = 'reporting';

        include __DIR__ . '/../../Views/admin/reporting.php';
    }

    /**
     * Return JSON for dynamic range switcher
     */
    public function getData(): void {
        AuthMiddleware::check();
        header('Content-Type: application/json; charset=utf-8');

        $range = trim((string)($_GET['range'] ?? '30d'));
        if (!in_array($range, ['7d', '30d', '90d', '1y', 'all'], true)) {
            $range = '30d';
        }

        $model = new AdminModel();
        $report = $model->getReportingData($range);

        echo json_encode(['success' => true, 'report' => $report]);
        exit;
    }

    /**
     * Export complete business report to CSV
     */
    public function exportCsv(): void {
        AuthMiddleware::check();

        $range = trim((string)($_GET['range'] ?? '30d'));
        if (!in_array($range, ['7d', '30d', '90d', '1y', 'all'], true)) {
            $range = '30d';
        }

        $model = new AdminModel();
        $report = $model->getReportingData($range);

        $filename = "clickcodex_executive_report_{$range}_" . date('Ymd_His') . ".csv";
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $out = fopen('php://output', 'w');
        fputcsv($out, ['ClickCodex Executive Performance Report', 'Range: ' . strtoupper($range), 'Generated: ' . date('Y-m-d H:i:s')]);
        fputcsv($out, []);

        // Key Metrics Summary
        fputcsv($out, ['--- EXECUTIVE SUMMARY METRICS ---']);
        fputcsv($out, ['Metric', 'Value']);
        fputcsv($out, ['Total Inquiries', $report['total_inquiries']]);
        fputcsv($out, ['Conversion Rate', $report['conversion_rate'] . '%']);
        fputcsv($out, ['Estimated Revenue Pipeline', '$' . number_format($report['pipeline_value'], 2)]);
        fputcsv($out, ['Advisor Archetype Submissions', $report['archetype_count']]);
        fputcsv($out, []);

        // Status Breakdown
        fputcsv($out, ['--- INQUIRY STATUS BREAKDOWN ---']);
        fputcsv($out, ['Status', 'Count']);
        foreach ($report['status_counts'] as $st => $cnt) {
            fputcsv($out, [ucfirst((string)$st), $cnt]);
        }
        fputcsv($out, []);

        // Budget Breakdown
        fputcsv($out, ['--- BUDGET BRACKET DISTRIBUTION ---']);
        fputcsv($out, ['Budget Tier', 'Inquiries Count']);
        foreach ($report['budget_breakdown'] as $b) {
            fputcsv($out, [$b['bracket'], $b['count']]);
        }
        fputcsv($out, []);

        // Service Popularity
        fputcsv($out, ['--- CAPABILITY & SERVICE POPULARITY ---']);
        fputcsv($out, ['Service Name', 'Inquiry References']);
        foreach ($report['service_popularity'] as $svc => $cnt) {
            fputcsv($out, [$svc, $cnt]);
        }
        fputcsv($out, []);

        // Daily Trend
        fputcsv($out, ['--- DAILY SUBMISSION TRENDS ---']);
        fputcsv($out, ['Date', 'Inquiries Received']);
        foreach ($report['daily_trends'] as $day) {
            fputcsv($out, [$day['date'], $day['count']]);
        }

        fclose($out);
        exit;
    }
}
