<?php
/**
 * ClickCodex Technologies - Executive Reporting Engine
 * Comprehensive business intelligence, pipeline forecasting, and revenue telemetry.
 */
declare(strict_types=1);

if (!defined('BASE_URL')) {
    define('BASE_URL', '');
}

$pageTitle = $pageTitle ?? 'Executive Reporting Engine | ClickCodex Studio Console';
$topbarTitle = 'Executive Reporting Engine';
$activeNav = 'reporting';

include __DIR__ . '/layout/header.php';

$range = $report['range'] ?? '30d';
$totalInquiries = (int)($report['total_inquiries'] ?? 0);
$pipelineValue = (float)($report['pipeline_value'] ?? 0);
$conversionRate = (float)($report['conversion_rate'] ?? 0);
$statusCounts = $report['status_counts'] ?? [];
$budgetBreakdown = $report['budget_breakdown'] ?? [];
$dailyTrends = $report['daily_trends'] ?? [];
$servicePopularity = $report['service_popularity'] ?? [];
$archetypeCount = (int)($report['archetype_count'] ?? 0);
?>

<style>
:root {
  --rep-primary: #0056d6;
  --rep-accent: #00a2ff;
  --rep-green: #10b981;
  --rep-amber: #f59e0b;
  --rep-purple: #8b5cf6;
  --rep-border: #e2e8f0;
}

.rep-container {
  max-width: 1440px;
  margin: 0 auto;
  padding: 32px;
  width: 100%;
  box-sizing: border-box;
}

/* Header & Control Bar */
.rep-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 16px;
  margin-bottom: 28px;
}

.rep-title-block h1 {
  font-size: 1.6rem;
  font-weight: 800;
  color: var(--text-dark, #0f172a);
  margin: 0 0 6px 0;
  display: flex;
  align-items: center;
  gap: 10px;
}

.rep-title-block p {
  color: var(--text-muted, #64748b);
  margin: 0;
  font-size: 0.9rem;
}

.rep-controls {
  display: flex;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
}

.rep-range-pills {
  display: inline-flex;
  background: #f1f5f9;
  padding: 4px;
  border-radius: 10px;
  border: 1px solid var(--rep-border);
}

.rep-range-btn {
  padding: 6px 14px;
  font-size: 0.8rem;
  font-weight: 700;
  color: #64748b;
  border: none;
  background: transparent;
  border-radius: 7px;
  cursor: pointer;
  transition: all 0.2s ease;
  text-decoration: none;
}

.rep-range-btn:hover {
  color: var(--rep-primary);
}

.rep-range-btn.active {
  background: #ffffff;
  color: var(--rep-primary);
  box-shadow: 0 2px 6px rgba(0,0,0,0.06);
}

.rep-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 16px;
  border-radius: 8px;
  font-size: 0.85rem;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.2s ease;
  text-decoration: none;
}

.rep-btn-primary {
  background: linear-gradient(135deg, var(--rep-primary), var(--rep-accent));
  color: #ffffff;
  border: none;
  box-shadow: 0 3px 10px rgba(0, 86, 214, 0.25);
}

.rep-btn-primary:hover {
  transform: translateY(-1px);
  box-shadow: 0 5px 15px rgba(0, 86, 214, 0.35);
  color: #fff;
}

.rep-btn-outline {
  background: #ffffff;
  color: #334155;
  border: 1px solid var(--rep-border);
}

.rep-btn-outline:hover {
  background: #f8fafc;
  color: var(--rep-primary);
}

/* KPI Summary Cards */
.rep-kpi-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin-bottom: 32px;
}

.rep-kpi-card {
  background: #ffffff;
  border: 1px solid var(--rep-border);
  border-radius: 14px;
  padding: 22px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0,0,0,0.02);
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.rep-kpi-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}

.rep-kpi-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: var(--card-accent, var(--rep-primary));
}

.rep-kpi-label {
  font-size: 0.8rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: #64748b;
  margin-bottom: 8px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.rep-kpi-val {
  font-size: 2rem;
  font-weight: 800;
  color: #0f172a;
  line-height: 1.2;
}

.rep-kpi-sub {
  font-size: 0.8rem;
  color: #64748b;
  margin-top: 8px;
}

/* 2-Column Section Grids */
.rep-grid-2 {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 24px;
  margin-bottom: 32px;
}

@media (max-width: 1024px) {
  .rep-grid-2 {
    grid-template-columns: 1fr;
  }
}

.rep-panel {
  background: #ffffff;
  border: 1px solid var(--rep-border);
  border-radius: 14px;
  padding: 24px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.02);
}

.rep-panel-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  border-bottom: 1px solid #f1f5f9;
  padding-bottom: 14px;
}

.rep-panel-title {
  font-size: 1.05rem;
  font-weight: 700;
  color: #0f172a;
  display: flex;
  align-items: center;
  gap: 8px;
  margin: 0;
}

.rep-panel-badge {
  font-size: 0.72rem;
  font-weight: 700;
  background: #e2e8f0;
  color: #475569;
  padding: 3px 8px;
  border-radius: 6px;
}

/* Trend Bar Chart */
.rep-trend-chart {
  display: flex;
  align-items: flex-end;
  gap: 8px;
  height: 220px;
  padding-top: 24px;
  overflow-x: auto;
}

.rep-trend-col {
  flex: 1;
  min-width: 28px;
  display: flex;
  flex-direction: column;
  align-items: center;
  height: 100%;
  justify-content: flex-end;
}

.rep-trend-bar {
  width: 100%;
  max-width: 24px;
  background: linear-gradient(180deg, var(--rep-primary), var(--rep-accent));
  border-radius: 4px 4px 0 0;
  min-height: 4px;
  transition: all 0.3s ease;
  position: relative;
  cursor: pointer;
}

.rep-trend-bar:hover {
  filter: brightness(1.15);
  box-shadow: 0 0 10px rgba(0, 86, 214, 0.4);
}

.rep-trend-tooltip {
  position: absolute;
  bottom: 100%;
  left: 50%;
  transform: translateX(-50%);
  background: #0f172a;
  color: #fff;
  padding: 4px 8px;
  font-size: 0.7rem;
  border-radius: 4px;
  white-space: nowrap;
  pointer-events: none;
  opacity: 0;
  transition: opacity 0.2s;
  margin-bottom: 6px;
}

.rep-trend-bar:hover .rep-trend-tooltip {
  opacity: 1;
}

.rep-trend-label {
  font-size: 0.68rem;
  color: #94a3b8;
  margin-top: 8px;
  text-align: center;
  writing-mode: horizontal-tb;
}

/* Progress Lists */
.rep-status-list {
  display: flex;
  flex-direction: column;
  gap: 14px;
}

.rep-status-row {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.rep-status-meta {
  display: flex;
  justify-content: space-between;
  font-size: 0.85rem;
}

.rep-status-name {
  font-weight: 600;
  color: #334155;
  display: flex;
  align-items: center;
  gap: 8px;
}

.rep-status-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
}

.rep-status-track {
  height: 7px;
  background: #f1f5f9;
  border-radius: 99px;
  overflow: hidden;
}

.rep-status-fill {
  height: 100%;
  border-radius: 99px;
  transition: width 0.6s ease;
}

/* Tables */
.rep-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 0.88rem;
}

.rep-table th {
  text-align: left;
  padding: 10px 14px;
  background: #f8fafc;
  color: #475569;
  font-weight: 700;
  border-bottom: 1px solid var(--rep-border);
}

.rep-table td {
  padding: 12px 14px;
  border-bottom: 1px solid #f1f5f9;
  color: #1e293b;
}

.rep-table tr:hover td {
  background: #fbfcfe;
}

/* Print Styles */
@media print {
  .admin-topbar, .admin-sidebar, .sidebar, .rep-controls, .toast-container {
    display: none !important;
  }
  .admin-main {
    margin-left: 0 !important;
    padding: 0 !important;
  }
  .rep-container {
    padding: 0 !important;
  }
  .rep-kpi-card, .rep-panel {
    border: 1px solid #ccc !important;
    box-shadow: none !important;
  }
}
</style>

<div class="rep-container">

  <!-- Header -->
  <div class="rep-header">
    <div class="rep-title-block">
      <h1>
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="var(--rep-primary)" stroke-width="2.5"><polygon points="3,3 21,3 21,21 3,21"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
        Executive Reporting Engine
      </h1>
      <p>Real-time commercial pipeline performance, conversion analytics, and portfolio yield telemetry.</p>
    </div>

    <div class="rep-controls">
      <div class="rep-range-pills">
        <a href="<?= BASE_URL ?>/admin/reporting?range=7d" class="rep-range-btn <?= $range === '7d' ? 'active' : '' ?>">7D</a>
        <a href="<?= BASE_URL ?>/admin/reporting?range=30d" class="rep-range-btn <?= $range === '30d' ? 'active' : '' ?>">30D</a>
        <a href="<?= BASE_URL ?>/admin/reporting?range=90d" class="rep-range-btn <?= $range === '90d' ? 'active' : '' ?>">90D</a>
        <a href="<?= BASE_URL ?>/admin/reporting?range=1y" class="rep-range-btn <?= $range === '1y' ? 'active' : '' ?>">1Y</a>
        <a href="<?= BASE_URL ?>/admin/reporting?range=all" class="rep-range-btn <?= $range === 'all' ? 'active' : '' ?>">ALL</a>
      </div>

      <button type="button" onclick="window.print()" class="rep-btn rep-btn-outline" title="Print Executive Summary">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
        <span>Print Report</span>
      </button>

      <a href="<?= BASE_URL ?>/admin/reporting/export?range=<?= urlencode($range) ?>" class="rep-btn rep-btn-primary">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
        <span>Export CSV</span>
      </a>
    </div>
  </div>

  <!-- KPI Cards -->
  <div class="rep-kpi-grid">
    <div class="rep-kpi-card" style="--card-accent: var(--rep-primary);">
      <div class="rep-kpi-label">
        <span>Inquiries in Window</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--rep-primary)" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path></svg>
      </div>
      <div class="rep-kpi-val"><?= number_format($totalInquiries) ?></div>
      <div class="rep-kpi-sub">Total commercial leads recorded</div>
    </div>

    <div class="rep-kpi-card" style="--card-accent: var(--rep-green);">
      <div class="rep-kpi-label">
        <span>Conversion Rate</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--rep-green)" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
      </div>
      <div class="rep-kpi-val"><?= $conversionRate ?>%</div>
      <div class="rep-kpi-sub"><?= (int)($statusCounts['won'] ?? 0) ?> converted client contracts</div>
    </div>

    <div class="rep-kpi-card" style="--card-accent: var(--rep-purple);">
      <div class="rep-kpi-label">
        <span>Pipeline Estimate</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--rep-purple)" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
      </div>
      <div class="rep-kpi-val">$<?= number_format($pipelineValue) ?></div>
      <div class="rep-kpi-sub">Aggregated budget bracket potential</div>
    </div>

    <div class="rep-kpi-card" style="--card-accent: var(--rep-amber);">
      <div class="rep-kpi-label">
        <span>Solution Archetypes</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--rep-amber)" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
      </div>
      <div class="rep-kpi-val"><?= number_format($archetypeCount) ?></div>
      <div class="rep-kpi-sub">Interactive advisor quiz sessions</div>
    </div>
  </div>

  <!-- Row 1: Daily Trends & Pipeline Funnel -->
  <div class="rep-grid-2">
    <!-- Daily Trend Chart -->
    <div class="rep-panel">
      <div class="rep-panel-header">
        <h2 class="rep-panel-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rep-primary)" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
          Inquiry Velocity Trend
        </h2>
        <span class="rep-panel-badge">Window: <?= strtoupper($range) ?></span>
      </div>

      <?php
        $maxCount = 1;
        foreach ($dailyTrends as $dt) {
            if ($dt['count'] > $maxCount) $maxCount = $dt['count'];
        }
      ?>

      <?php if (!empty($dailyTrends)): ?>
        <div class="rep-trend-chart">
          <?php foreach ($dailyTrends as $dt): ?>
            <?php 
              $hPct = max(8, round(($dt['count'] / $maxCount) * 100));
              $displayDate = date('M d', strtotime($dt['date']));
            ?>
            <div class="rep-trend-col">
              <div class="rep-trend-bar" style="height: <?= $hPct ?>%;">
                <div class="rep-trend-tooltip"><?= $displayDate ?>: <?= $dt['count'] ?> inquiries</div>
              </div>
              <span class="rep-trend-label"><?= $displayDate ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div style="padding: 48px; text-align: center; color: #94a3b8;">
          No inquiries recorded in this selected range.
        </div>
      <?php endif; ?>
    </div>

    <!-- Status Funnel -->
    <div class="rep-panel">
      <div class="rep-panel-header">
        <h2 class="rep-panel-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rep-green)" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
          Conversion Funnel
        </h2>
        <span class="rep-panel-badge">Status</span>
      </div>

      <div class="rep-status-list">
        <?php
          $statusColors = [
            'new' => '#f59e0b',
            'in_review' => '#00a2ff',
            'contacted' => '#8b5cf6',
            'quoted' => '#0056d6',
            'won' => '#10b981',
            'lost' => '#ef4444',
            'archived' => '#94a3b8'
          ];
          $tot = max(1, $totalInquiries);
        ?>
        <?php foreach ($statusColors as $st => $col): ?>
          <?php 
            $c = (int)($statusCounts[$st] ?? 0);
            $pct = round(($c / $tot) * 100, 1);
          ?>
          <div class="rep-status-row">
            <div class="rep-status-meta">
              <span class="rep-status-name">
                <span class="rep-status-dot" style="background: <?= $col ?>;"></span>
                <?= ucwords(str_replace('_', ' ', $st)) ?>
              </span>
              <span style="font-weight: 700; color: #0f172a;"><?= $c ?> (<?= $pct ?>%)</span>
            </div>
            <div class="rep-status-track">
              <div class="rep-status-fill" style="width: <?= $pct ?>%; background: <?= $col ?>;"></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Row 2: Budget Distribution & Capability Popularity -->
  <div class="rep-grid-2">
    <!-- Budget Tiers -->
    <div class="rep-panel">
      <div class="rep-panel-header">
        <h2 class="rep-panel-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rep-purple)" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
          Capital Allocation & Budget Brackets
        </h2>
        <span class="rep-panel-badge">Tiers</span>
      </div>

      <table class="rep-table">
        <thead>
          <tr>
            <th>Budget Tier</th>
            <th>Inquiries</th>
            <th>Share of Pipeline</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($budgetBreakdown)): ?>
            <?php foreach ($budgetBreakdown as $b): ?>
              <?php $share = round(($b['count'] / max(1, $totalInquiries)) * 100, 1); ?>
              <tr>
                <td style="font-weight: 700; color: #0f172a;"><?= htmlspecialchars($b['bracket']) ?></td>
                <td><span style="font-weight: 700;"><?= $b['count'] ?></span> leads</td>
                <td>
                  <div style="display: flex; align-items: center; gap: 8px;">
                    <div style="flex: 1; height: 6px; background: #f1f5f9; border-radius: 99px; overflow: hidden;">
                      <div style="height: 100%; width: <?= $share ?>%; background: var(--rep-purple); border-radius: 99px;"></div>
                    </div>
                    <span style="font-size: 0.78rem; font-weight: 700; min-width: 40px;"><?= $share ?>%</span>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="3" style="text-align: center; color: #94a3b8; padding: 24px;">No budget data recorded in this period.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Capability Demand -->
    <div class="rep-panel">
      <div class="rep-panel-header">
        <h2 class="rep-panel-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rep-primary)" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
          Demand by Capability
        </h2>
        <span class="rep-panel-badge">Top Services</span>
      </div>

      <div style="display: flex; flex-direction: column; gap: 12px;">
        <?php if (!empty($servicePopularity)): ?>
          <?php foreach ($servicePopularity as $svc => $cnt): ?>
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 14px; background: #f8fafc; border-radius: 8px; border: 1px solid #f1f5f9;">
              <span style="font-weight: 600; font-size: 0.88rem; color: #1e293b;"><?= htmlspecialchars((string)$svc) ?></span>
              <span style="font-size: 0.8rem; font-weight: 800; background: rgba(0, 86, 214, 0.1); color: var(--rep-primary); padding: 3px 9px; border-radius: 6px;">
                <?= $cnt ?> inquiries
              </span>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div style="text-align: center; color: #94a3b8; padding: 24px;">
            No service inquiry preferences recorded.
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

</div>

<?php
include __DIR__ . '/layout/footer.php';
?>
