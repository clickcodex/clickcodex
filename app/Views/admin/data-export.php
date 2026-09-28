<?php
/**
 * ClickCodex Technologies - Data Export & System Snapshot Center
 * One-click full database SQL backups, JSON system snapshots, and CSV datasets.
 */
declare(strict_types=1);

if (!defined('BASE_URL')) {
    define('BASE_URL', '');
}

$pageTitle = $pageTitle ?? 'Data Export & System Snapshots | ClickCodex Studio Console';
$topbarTitle = 'Data Export & System Backups';
$activeNav = 'data_export';

include __DIR__ . '/layout/header.php';

$tables = $tables ?? [];
$totalSizeFormatted = $totalSizeFormatted ?? '1.2 MB';
$totalRows = $totalRows ?? 0;
?>

<style>
:root {
  --exp-primary: #0056d6;
  --exp-accent: #00a2ff;
  --exp-green: #10b981;
  --exp-purple: #8b5cf6;
  --exp-amber: #f59e0b;
  --exp-border: #e2e8f0;
}

.exp-container {
  max-width: 1440px;
  margin: 0 auto;
  padding: 32px;
  width: 100%;
  box-sizing: border-box;
}

.exp-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 16px;
  margin-bottom: 28px;
}

.exp-title-block h1 {
  font-size: 1.6rem;
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 6px 0;
  display: flex;
  align-items: center;
  gap: 10px;
}

.exp-title-block p {
  color: #64748b;
  margin: 0;
  font-size: 0.9rem;
}

/* Master Export Cards */
.exp-cards-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 24px;
  margin-bottom: 32px;
}

.exp-card {
  background: #ffffff;
  border: 1px solid var(--exp-border);
  border-radius: 16px;
  padding: 26px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  box-shadow: 0 2px 8px rgba(0,0,0,0.02);
  transition: all 0.2s ease;
  position: relative;
  overflow: hidden;
}

.exp-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.05);
  border-color: #cbd5e1;
}

.exp-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: var(--card-color, var(--exp-primary));
}

.exp-card-header {
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 14px;
}

.exp-card-icon {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 800;
  font-size: 1.2rem;
}

.exp-card-title {
  font-size: 1.15rem;
  font-weight: 800;
  color: #0f172a;
}

.exp-card-desc {
  font-size: 0.86rem;
  color: #64748b;
  line-height: 1.6;
  margin-bottom: 22px;
}

.exp-card-btn {
  padding: 11px 20px;
  border-radius: 10px;
  font-size: 0.88rem;
  font-weight: 700;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  transition: all 0.2s ease;
  cursor: pointer;
  border: none;
}

.exp-btn-sql {
  background: linear-gradient(135deg, #0056d6, #00a2ff);
  color: #ffffff;
  box-shadow: 0 4px 12px rgba(0, 86, 214, 0.25);
}

.exp-btn-sql:hover {
  color: #fff;
  transform: translateY(-1px);
  box-shadow: 0 6px 16px rgba(0, 86, 214, 0.35);
}

.exp-btn-json {
  background: linear-gradient(135deg, #8b5cf6, #a855f7);
  color: #ffffff;
  box-shadow: 0 4px 12px rgba(139, 92, 246, 0.25);
}

.exp-btn-json:hover {
  color: #fff;
  transform: translateY(-1px);
  box-shadow: 0 6px 16px rgba(139, 92, 246, 0.35);
}

.exp-btn-csv {
  background: linear-gradient(135deg, #10b981, #059669);
  color: #ffffff;
  box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
}

.exp-btn-csv:hover {
  color: #fff;
  transform: translateY(-1px);
  box-shadow: 0 6px 16px rgba(16, 185, 129, 0.35);
}

/* Table Telemetry */
.exp-panel {
  background: #ffffff;
  border: 1px solid var(--exp-border);
  border-radius: 14px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.02);
  overflow: hidden;
  margin-bottom: 32px;
}

.exp-panel-header {
  padding: 20px 24px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #f1f5f9;
}

.exp-panel-title {
  font-size: 1.1rem;
  font-weight: 700;
  color: #0f172a;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 8px;
}

.exp-table {
  width: 100%;
  border-collapse: collapse;
}

.exp-table th {
  background: #f8fafc;
  padding: 12px 20px;
  text-align: left;
  font-size: 0.8rem;
  font-weight: 700;
  color: #475569;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  border-bottom: 1px solid var(--exp-border);
}

.exp-table td {
  padding: 14px 20px;
  font-size: 0.88rem;
  color: #1e293b;
  border-bottom: 1px solid #f1f5f9;
  vertical-align: middle;
}

.exp-table tr:hover td {
  background: #fbfcfe;
}

.exp-download-link {
  font-size: 0.78rem;
  font-weight: 700;
  color: var(--exp-primary);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 5px 10px;
  background: #f1f5f9;
  border-radius: 6px;
  transition: all 0.15s;
}

.exp-download-link:hover {
  background: rgba(0, 86, 214, 0.1);
  color: var(--exp-primary);
}

.exp-notice {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-left: 4px solid var(--exp-amber);
  border-radius: 10px;
  padding: 18px 22px;
  display: flex;
  align-items: flex-start;
  gap: 14px;
}
</style>

<div class="exp-container">

  <!-- Header -->
  <div class="exp-header">
    <div class="exp-title-block">
      <h1>
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="var(--exp-primary)" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
        Data Export & System Snapshots
      </h1>
      <p>Download cold-storage MySQL dumps, developer JSON snapshots, or modular CSV datasets.</p>
    </div>

    <div style="display: flex; gap: 12px;">
      <span style="font-size: 0.84rem; font-weight: 700; color: #475569; background: #f1f5f9; padding: 6px 14px; border-radius: 8px;">
        Database Size: <strong><?= $totalSizeFormatted ?></strong>
      </span>
      <span style="font-size: 0.84rem; font-weight: 700; color: #475569; background: #f1f5f9; padding: 6px 14px; border-radius: 8px;">
        Total Records: <strong><?= number_format($totalRows) ?></strong>
      </span>
    </div>
  </div>

  <!-- Master Export Cards -->
  <div class="exp-cards-grid">
    <!-- Card 1: Full SQL Dump -->
    <div class="exp-card" style="--card-color: var(--exp-primary);">
      <div>
        <div class="exp-card-header">
          <div class="exp-card-icon" style="background: rgba(0, 86, 214, 0.1); color: var(--exp-primary);">
            SQL
          </div>
          <div>
            <div class="exp-card-title">Full Database Dump</div>
            <div style="font-size: 0.74rem; color: #94a3b8;">Schema DDL + Data Inserts</div>
          </div>
        </div>
        <div class="exp-card-desc">
          Complete MySQL archive containing table creation statements and row inserts. Suitable for disaster recovery or database migrations.
        </div>
      </div>
      <a href="<?= BASE_URL ?>/admin/data-export/sql" class="exp-card-btn exp-btn-sql">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
        <span>Download .SQL Backup</span>
      </a>
    </div>

    <!-- Card 2: JSON Snapshot -->
    <div class="exp-card" style="--card-color: var(--exp-purple);">
      <div>
        <div class="exp-card-header">
          <div class="exp-card-icon" style="background: rgba(139, 92, 246, 0.1); color: var(--exp-purple);">
            JSON
          </div>
          <div>
            <div class="exp-card-title">RESTful JSON Snapshot</div>
            <div style="font-size: 0.74rem; color: #94a3b8;">Formatted Content Objects</div>
          </div>
        </div>
        <div class="exp-card-desc">
          Export full catalog of services, case studies, articles, and site settings into a structured JSON file for API synchronization or frontend testing.
        </div>
      </div>
      <a href="<?= BASE_URL ?>/admin/data-export/json" class="exp-card-btn exp-btn-json">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
        <span>Download .JSON Snapshot</span>
      </a>
    </div>

    <!-- Card 3: Inquiries CSV -->
    <div class="exp-card" style="--card-color: var(--exp-green);">
      <div>
        <div class="exp-card-header">
          <div class="exp-card-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--exp-green);">
            CSV
          </div>
          <div>
            <div class="exp-card-title">Commercial Leads (CSV)</div>
            <div style="font-size: 0.74rem; color: #94a3b8;">Inquiries & Contact Requests</div>
          </div>
        </div>
        <div class="exp-card-desc">
          Export client names, emails, phones, budget brackets, requested capabilities, and submission dates for import into Microsoft Excel or CRM tools.
        </div>
      </div>
      <a href="<?= BASE_URL ?>/admin/data-export/csv?table=contact_inquiries" class="exp-card-btn exp-btn-csv">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
        <span>Download Inquiries CSV</span>
      </a>
    </div>
  </div>

  <!-- Database Table Telemetry -->
  <div class="exp-panel">
    <div class="exp-panel-header">
      <h2 class="exp-panel-title">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--exp-primary)" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
        Database Table Breakdown & Modular CSVs
      </h2>
      <span style="font-size: 0.8rem; color: #64748b; font-weight: 600;"><?= count($tables) ?> tables inspected</span>
    </div>

    <div style="overflow-x: auto;">
      <table class="exp-table">
        <thead>
          <tr>
            <th>Table Name</th>
            <th>Total Records</th>
            <th>Size on Disk</th>
            <th>Last Updated</th>
            <th style="text-align: right;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($tables)): ?>
            <?php foreach ($tables as $tbl): ?>
              <tr>
                <td>
                  <span style="font-family: 'Space Mono', monospace; font-weight: 700; color: #0f172a;">
                    <?= htmlspecialchars($tbl['name']) ?>
                  </span>
                </td>
                <td><span style="font-weight: 700;"><?= number_format($tbl['rows']) ?></span> rows</td>
                <td><span style="color: #64748b; font-size: 0.84rem;"><?= htmlspecialchars($tbl['size_formatted']) ?></span></td>
                <td><span style="color: #94a3b8; font-size: 0.82rem;"><?= htmlspecialchars($tbl['updated_at']) ?></span></td>
                <td style="text-align: right;">
                  <a href="<?= BASE_URL ?>/admin/data-export/csv?table=<?= urlencode($tbl['name']) ?>" class="exp-download-link">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    <span>Export CSV</span>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Security Advisory Notice -->
  <div class="exp-notice">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--exp-amber)" stroke-width="2.5" style="flex-shrink: 0; margin-top: 2px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
    <div>
      <div style="font-weight: 700; color: #0f172a; font-size: 0.92rem; margin-bottom: 4px;">Security & Compliance Note</div>
      <div style="font-size: 0.84rem; color: #475569; line-height: 1.5;">
        Database backups contain confidential client contact information, security credentials, and system settings. Store downloaded SQL and JSON archives in an encrypted storage bucket or offline vault adhering to your organization’s data governance policy.
      </div>
    </div>
  </div>

</div>

<?php
include __DIR__ . '/layout/footer.php';
?>
