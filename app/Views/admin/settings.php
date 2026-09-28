<?php
/**
 * ClickCodex Technologies - Global Site Settings & Studio Configuration Console
 * Enterprise Configuration Manager, Environment Tokens, Brand Identity, SEO & Script Injections.
 */
declare(strict_types=1);

if (!defined('BASE_URL')) {
    define('BASE_URL', '');
}

$pageTitle   = $pageTitle ?? 'Site Settings & Configuration | ClickCodex Studio Console';
$topbarTitle = 'Site Settings & Configuration';
$activeNav   = 'settings';

// Extract flat dictionary for form field access
$flatSettings = [];
foreach ($groups as $gName => $rows) {
    foreach ($rows as $r) {
        $flatSettings[$r['setting_key']] = $r['setting_value'] ?? '';
    }
}

// Current active tab (default: general)
$activeTab = $_GET['tab'] ?? 'general';
$validTabs = ['general', 'contact', 'branding', 'seo', 'social', 'analytics', 'scripts', 'legal', 'all'];
if (!in_array($activeTab, $validTabs, true)) {
    $activeTab = 'general';
}

include __DIR__ . '/layout/header.php';
?>

<!-- ========================================================================
     SITE SETTINGS CUSTOM STYLES (OPEN SANS UNIFIED & PREMIUM GLASS)
     ======================================================================== -->
<style>
:root {
  --cfg-primary: #0056d6;
  --cfg-primary-glow: rgba(0, 86, 214, 0.25);
  --cfg-cyan: #00a2ff;
  --cfg-cyan-glow: rgba(0, 162, 255, 0.2);
  --cfg-emerald: #10b981;
  --cfg-amber: #f59e0b;
  --cfg-purple: #8b5cf6;
  --cfg-red: #ef4444;
  --cfg-border: #e2e8f0;
  --cfg-bg-card: #ffffff;
  --cfg-bg-muted: #f8fafc;
}

.cfg-admin-content {
  font-family: 'Open Sans', var(--font-body), sans-serif;
  max-width: 1440px;
  margin: 0 auto;
  padding: 32px;
  width: 100%;
  box-sizing: border-box;
}

/* 1. Header Command Banner */
.cfg-hero-banner {
  background: linear-gradient(135deg, #070e1e 0%, #0d1a36 60%, #061128 100%);
  border-radius: 20px;
  padding: 36px 40px;
  margin-bottom: 28px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 16px 36px rgba(0, 15, 45, 0.28);
  border: 1px solid rgba(0, 162, 255, 0.15);
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 24px;
}
.cfg-hero-banner::before {
  content: '';
  position: absolute;
  top: -80px;
  right: -80px;
  width: 280px;
  height: 280px;
  background: radial-gradient(circle, rgba(0, 162, 255, 0.22) 0%, rgba(0, 86, 214, 0.05) 70%, transparent 100%);
  border-radius: 50%;
  pointer-events: none;
}
.cfg-hero-info {
  max-width: 650px;
  position: relative;
  z-index: 2;
}
.cfg-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 6px 14px;
  border-radius: 999px;
  background: rgba(0, 162, 255, 0.12);
  border: 1px solid rgba(0, 162, 255, 0.3);
  color: #7dd3fc;
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  margin-bottom: 12px;
}
.cfg-hero-title {
  font-size: 1.85rem;
  font-weight: 800;
  color: #ffffff;
  margin: 0 0 10px 0;
  letter-spacing: -0.02em;
  display: flex;
  align-items: center;
  gap: 12px;
}
.cfg-hero-subtitle {
  font-size: 0.94rem;
  color: #94a3b8;
  margin: 0;
  line-height: 1.6;
}

/* KPI Chips */
.cfg-kpi-row {
  display: flex;
  gap: 14px;
  flex-wrap: wrap;
  margin-top: 20px;
}
.cfg-kpi-chip {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(8px);
  padding: 8px 16px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  gap: 10px;
  color: #f1f5f9;
  font-size: 0.85rem;
}
.cfg-kpi-chip strong {
  font-weight: 800;
  color: #38bdf8;
}

/* Hero Controls */
.cfg-hero-actions {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
  position: relative;
  z-index: 2;
}

/* Buttons */
.cfg-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 18px;
  border-radius: 10px;
  font-size: 0.85rem;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.22s ease;
  border: 1px solid transparent;
  text-decoration: none;
}
.cfg-btn-primary {
  background: linear-gradient(135deg, var(--cfg-primary) 0%, #0077ff 100%);
  color: #ffffff;
  box-shadow: 0 4px 14px var(--cfg-primary-glow);
}
.cfg-btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0, 86, 214, 0.35);
  color: #ffffff;
}
.cfg-btn-glass {
  background: rgba(255, 255, 255, 0.08);
  color: #f8fafc;
  border-color: rgba(255, 255, 255, 0.18);
  backdrop-filter: blur(10px);
}
.cfg-btn-glass:hover {
  background: rgba(255, 255, 255, 0.15);
  border-color: rgba(255, 255, 255, 0.3);
  color: #ffffff;
}
.cfg-btn-emerald {
  background: #10b981;
  color: #ffffff;
}
.cfg-btn-emerald:hover {
  background: #059669;
}
.cfg-btn-sm {
  padding: 6px 12px;
  font-size: 0.78rem;
}

/* 2. Navigation Tabs Container */
.cfg-nav-tabs {
  display: flex;
  gap: 8px;
  overflow-x: auto;
  padding-bottom: 6px;
  margin-bottom: 24px;
  border-bottom: 2px solid #e2e8f0;
}
.cfg-tab-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 12px 20px;
  border-radius: 12px 12px 0 0;
  font-size: 0.9rem;
  font-weight: 700;
  color: #64748b;
  text-decoration: none;
  background: transparent;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease;
  white-space: nowrap;
  position: relative;
}
.cfg-tab-link:hover {
  color: var(--cfg-primary);
  background: rgba(0, 86, 214, 0.04);
}
.cfg-tab-link.active {
  color: var(--cfg-primary);
  background: #ffffff;
  box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.04);
}
.cfg-tab-link.active::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  right: 0;
  height: 3px;
  background: var(--cfg-primary);
  border-radius: 3px 3px 0 0;
}

/* 3. Settings Card & Forms */
.cfg-card {
  background: #ffffff;
  border: 1px solid var(--cfg-border);
  border-radius: 18px;
  padding: 32px;
  box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
  margin-bottom: 30px;
}
.cfg-card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
  padding-bottom: 18px;
  border-bottom: 1px solid #f1f5f9;
  flex-wrap: wrap;
  gap: 16px;
}
.cfg-card-title {
  font-size: 1.25rem;
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 6px 0;
  display: flex;
  align-items: center;
  gap: 10px;
}
.cfg-card-desc {
  font-size: 0.88rem;
  color: #64748b;
  margin: 0;
}

/* Grid Layouts */
.cfg-grid-2 {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
}
.cfg-grid-3 {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}
.cfg-col-span-2 {
  grid-column: span 2;
}
.cfg-col-span-3 {
  grid-column: span 3;
}

/* Form Controls */
.cfg-form-group {
  margin-bottom: 20px;
  display: flex;
  flex-direction: column;
}
.cfg-label {
  font-size: 0.82rem;
  font-weight: 700;
  color: #334155;
  margin-bottom: 6px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.cfg-label-tag {
  font-size: 0.72rem;
  font-family: monospace;
  color: #8b5cf6;
  background: #f5f3ff;
  padding: 2px 6px;
  border-radius: 4px;
}
.cfg-input, .cfg-select, .cfg-textarea {
  width: 100%;
  padding: 10px 14px;
  border: 1px solid #cbd5e1;
  border-radius: 10px;
  font-size: 0.9rem;
  color: #0f172a;
  background: #ffffff;
  transition: all 0.2s ease;
  box-sizing: border-box;
}
.cfg-input:focus, .cfg-select:focus, .cfg-textarea:focus {
  outline: none;
  border-color: var(--cfg-primary);
  box-shadow: 0 0 0 3px rgba(0, 86, 214, 0.12);
}
.cfg-textarea {
  font-family: inherit;
  resize: vertical;
  min-height: 90px;
  line-height: 1.5;
}
.cfg-code-area {
  font-family: 'Consolas', 'Monaco', monospace;
  background: #0f172a;
  color: #38bdf8;
  border: 1px solid #1e293b;
  min-height: 140px;
}
.cfg-help-text {
  font-size: 0.76rem;
  color: #64748b;
  margin-top: 5px;
}

/* Color Picker Row */
.cfg-color-wrap {
  display: flex;
  align-items: center;
  gap: 10px;
}
.cfg-color-input {
  width: 44px;
  height: 40px;
  padding: 0;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  cursor: pointer;
  background: transparent;
}

/* Toggle Switch */
.cfg-switch-wrap {
  display: flex;
  align-items: center;
  gap: 12px;
  cursor: pointer;
  user-select: none;
}
.cfg-switch {
  position: relative;
  width: 48px;
  height: 26px;
  background: #cbd5e1;
  border-radius: 999px;
  transition: background 0.24s ease;
  display: inline-block;
  cursor: pointer;
}
.cfg-switch-input {
  display: none;
}
.cfg-switch::after {
  content: '';
  position: absolute;
  top: 3px;
  left: 3px;
  width: 20px;
  height: 20px;
  background: #ffffff;
  border-radius: 50%;
  transition: transform 0.24s ease;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
}
.cfg-switch-input:checked + .cfg-switch {
  background: var(--cfg-emerald);
}
.cfg-switch-input:checked + .cfg-switch::after {
  transform: translateX(22px);
}

/* Google SERP Preview Card */
.cfg-serp-box {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 16px 20px;
  margin-top: 14px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}
.cfg-serp-url {
  font-size: 0.8rem;
  color: #202124;
  margin-bottom: 4px;
  display: flex;
  align-items: center;
  gap: 6px;
}
.cfg-serp-title {
  font-size: 1.15rem;
  color: #1a0dab;
  font-weight: 500;
  margin-bottom: 4px;
  line-height: 1.3;
}
.cfg-serp-desc {
  font-size: 0.85rem;
  color: #4d5156;
  line-height: 1.45;
}

/* Live Brand Mockup */
.cfg-brand-preview {
  background: #0b1329;
  border-radius: 14px;
  padding: 24px;
  color: #ffffff;
  border: 1px solid #1e293b;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 20px;
  margin-top: 16px;
}

/* Master Data Table */
.cfg-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 0.88rem;
}
.cfg-table th {
  background: #f8fafc;
  padding: 12px 16px;
  text-align: left;
  font-weight: 700;
  color: #475569;
  border-bottom: 2px solid #e2e8f0;
}
.cfg-table td {
  padding: 12px 16px;
  border-bottom: 1px solid #f1f5f9;
  color: #1e293b;
  vertical-align: middle;
}
.cfg-table tr:hover td {
  background: #f8fafc;
}

/* Modals */
.cfg-modal-backdrop {
  position: fixed;
  inset: 0;
  background: rgba(15, 23, 42, 0.6);
  backdrop-filter: blur(6px);
  z-index: 99999;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
}
.cfg-modal {
  background: #ffffff;
  border-radius: 18px;
  padding: 32px;
  width: 100%;
  max-width: 600px;
  box-shadow: 0 24px 48px rgba(0, 0, 0, 0.2);
  position: relative;
  max-height: 90vh;
  overflow-y: auto;
}
.cfg-modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  padding-bottom: 14px;
  border-bottom: 1px solid #e2e8f0;
}
.cfg-modal-close {
  background: transparent;
  border: none;
  font-size: 1.4rem;
  color: #94a3b8;
  cursor: pointer;
}
.cfg-modal-close:hover {
  color: #0f172a;
}

@media (max-width: 900px) {
  .cfg-grid-2, .cfg-grid-3 {
    grid-template-columns: 1fr;
  }
  .cfg-col-span-2, .cfg-col-span-3 {
    grid-column: span 1;
  }
  .cfg-hero-banner {
    padding: 24px;
  }
}
</style>

<!-- ========================================================================
     MAIN SETTINGS CONSOLE BODY
     ======================================================================== -->
<div class="admin-content cfg-admin-content">

  <!-- Flash Notifications -->
  <?php if (!empty($flashSuccess)): ?>
    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #065f46; font-weight: 600; margin-bottom: 20px; border-radius: 12px; padding: 14px 18px; display: flex; align-items: center; gap: 10px;">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
      <span><?= htmlspecialchars($flashSuccess) ?></span>
    </div>
  <?php endif; ?>

  <?php if (!empty($flashError)): ?>
    <div style="background: rgba(220, 38, 38, 0.1); border: 1px solid rgba(220, 38, 38, 0.3); color: #991b1b; font-weight: 600; margin-bottom: 20px; border-radius: 12px; padding: 14px 18px; display: flex; align-items: center; gap: 10px;">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
      <span><?= htmlspecialchars($flashError) ?></span>
    </div>
  <?php endif; ?>

  <!-- 1. Hero Command Header -->
  <div class="cfg-hero-banner">
    <div class="cfg-hero-info">
      <div class="cfg-hero-badge">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
        <span>Global Configuration Engine</span>
      </div>
      <h1 class="cfg-hero-title">Site Settings & Studio Parameters</h1>
      <p class="cfg-hero-subtitle">
        Centralized operational repository for ClickCodex brand assets, contact channels, SEO open-graph parameters, analytics tracking containers, and legal compliance.
      </p>

      <div class="cfg-kpi-row">
        <div class="cfg-kpi-chip">
          <span>Parameters:</span> <strong><?= (int)$settingsStats['total'] ?></strong>
        </div>
        <div class="cfg-kpi-chip">
          <span>Public Frontend:</span> <strong><?= (int)$settingsStats['public_count'] ?></strong>
        </div>
        <div class="cfg-kpi-chip">
          <span>Secure / Private:</span> <strong><?= (int)$settingsStats['private_count'] ?></strong>
        </div>
        <div class="cfg-kpi-chip">
          <span>Environment:</span> <strong><?= htmlspecialchars(strtoupper(getenv('APP_ENV') ?: ($_ENV['APP_ENV'] ?? 'local'))) ?></strong>
        </div>
      </div>
    </div>

    <!-- Actions -->
    <div class="cfg-hero-actions">
      <button type="button" class="cfg-btn cfg-btn-glass" onclick="triggerClearCache()" title="Purge runtime opcode & storage caches">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"></path></svg>
        <span>Flush Cache</span>
      </button>

      <a href="<?= BASE_URL ?>/admin/settings/export" class="cfg-btn cfg-btn-glass" title="Download backup of settings (JSON)">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
        <span>Export JSON</span>
      </a>

      <button type="button" class="cfg-btn cfg-btn-glass" onclick="openImportModal()">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
        <span>Import JSON</span>
      </button>

      <button type="button" class="cfg-btn cfg-btn-primary" onclick="openAddSettingModal()">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        <span>Add Key</span>
      </button>
    </div>
  </div>

  <!-- 2. Settings Domain Navigation Tabs -->
  <div class="cfg-nav-tabs">
    <button type="button" class="cfg-tab-link <?= $activeTab === 'general' ? 'active' : '' ?>" onclick="switchTab('general')">
      🏢 <span>Company & Overview</span>
    </button>
    <button type="button" class="cfg-tab-link <?= $activeTab === 'contact' ? 'active' : '' ?>" onclick="switchTab('contact')">
      📞 <span>Contact & Campuses</span>
    </button>
    <button type="button" class="cfg-tab-link <?= $activeTab === 'branding' ? 'active' : '' ?>" onclick="switchTab('branding')">
      🎨 <span>Branding & Tokens</span>
    </button>
    <button type="button" class="cfg-tab-link <?= $activeTab === 'seo' ? 'active' : '' ?>" onclick="switchTab('seo')">
      🔍 <span>SEO & OpenGraph</span>
    </button>
    <button type="button" class="cfg-tab-link <?= $activeTab === 'social' ? 'active' : '' ?>" onclick="switchTab('social')">
      🌐 <span>Social Networks</span>
    </button>
    <button type="button" class="cfg-tab-link <?= $activeTab === 'analytics' ? 'active' : '' ?>" onclick="switchTab('analytics')">
      📊 <span>Analytics & Telemetry</span>
    </button>
    <button type="button" class="cfg-tab-link <?= $activeTab === 'scripts' ? 'active' : '' ?>" onclick="switchTab('scripts')">
      💻 <span>Scripts & Embeds</span>
    </button>
    <button type="button" class="cfg-tab-link <?= $activeTab === 'legal' ? 'active' : '' ?>" onclick="switchTab('legal')">
      🛡️ <span>Legal & Maintenance</span>
    </button>
    <button type="button" class="cfg-tab-link <?= $activeTab === 'all' ? 'active' : '' ?>" onclick="switchTab('all')">
      📋 <span>Master Table</span>
    </button>
  </div>

  <!-- ========================================================================
       TAB 1: COMPANY PROFILE & GENERAL INFORMATION
       ======================================================================== -->
  <div id="tab-general" class="cfg-tab-content" style="<?= $activeTab === 'general' ? 'display: block;' : 'display: none;' ?>">
    <form action="<?= BASE_URL ?>/admin/settings/save" method="POST" onsubmit="handleTabSubmit(event, 'general')">
      <input type="hidden" name="current_group" value="general" />

      <div class="cfg-card">
        <div class="cfg-card-header">
          <div>
            <h2 class="cfg-card-title">🏢 Company Profile & Operational Overview</h2>
            <p class="cfg-card-desc">Configure official entity details, tagline, team size metrics, and overview copy displayed across public views.</p>
          </div>
          <button type="submit" class="cfg-btn cfg-btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
            <span>Save Company Profile</span>
          </button>
        </div>

        <div class="cfg-grid-2">
          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Company Legal Name</span>
              <span class="cfg-label-tag">company_name</span>
            </label>
            <input type="text" name="settings[company_name]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['company_name'] ?? 'Click Codex') ?>" required />
            <span class="cfg-help-text">Used on official contracts, legal headers, and footer branding.</span>
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Public Brand Title</span>
              <span class="cfg-label-tag">site_name</span>
            </label>
            <input type="text" name="settings[site_name]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['site_name'] ?? 'Click Codex Technologies') ?>" required />
            <span class="cfg-help-text">Header logo title and browser window title base.</span>
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Brand Tagline / Slogan</span>
              <span class="cfg-label-tag">company_tagline</span>
            </label>
            <input type="text" name="settings[company_tagline]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['company_tagline'] ?? '') ?>" />
            <span class="cfg-help-text">Short slogan shown beneath logo and hero headers.</span>
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Operational Stage / Status</span>
              <span class="cfg-label-tag">company_status</span>
            </label>
            <input type="text" name="settings[company_status]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['company_status'] ?? '') ?>" />
            <span class="cfg-help-text">E.g. "Startup preparing to officially begin operations"</span>
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Team Size</span>
              <span class="cfg-label-tag">team_size</span>
            </label>
            <input type="text" name="settings[team_size]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['team_size'] ?? '4 Members') ?>" />
            <span class="cfg-help-text">Displayed on About Us profile cards.</span>
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Collective Experience</span>
              <span class="cfg-label-tag">team_experience</span>
            </label>
            <input type="text" name="settings[team_experience]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['team_experience'] ?? '~2 Years') ?>" />
            <span class="cfg-help-text">Displayed in credibility badges.</span>
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Founding Year</span>
              <span class="cfg-label-tag">founding_year</span>
            </label>
            <input type="text" name="settings[founding_year]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['founding_year'] ?? '2026') ?>" />
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Footer Copyright Notice</span>
              <span class="cfg-label-tag">copyright_text</span>
            </label>
            <input type="text" name="settings[copyright_text]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['copyright_text'] ?? '') ?>" />
          </div>

          <div class="cfg-form-group cfg-col-span-2">
            <label class="cfg-label">
              <span>Company Executive Overview</span>
              <span class="cfg-label-tag">company_overview</span>
            </label>
            <textarea name="settings[company_overview]" class="cfg-textarea" rows="4"><?= htmlspecialchars($flatSettings['company_overview'] ?? '') ?></textarea>
            <span class="cfg-help-text">Used on About page, schema structured data Organization description, and company dossiers.</span>
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- ========================================================================
       TAB 2: CONTACT & OPERATING CHANNELS
       ======================================================================== -->
  <div id="tab-contact" class="cfg-tab-content" style="<?= $activeTab === 'contact' ? 'display: block;' : 'display: none;' ?>">
    <form action="<?= BASE_URL ?>/admin/settings/save" method="POST" onsubmit="handleTabSubmit(event, 'contact')">
      <input type="hidden" name="current_group" value="contact" />

      <div class="cfg-card">
        <div class="cfg-card-header">
          <div>
            <h2 class="cfg-card-title">📞 Contact Channels, Campuses & Operating Hours</h2>
            <p class="cfg-card-desc">Control public inquiry addresses, hotline numbers, WhatsApp live triggers, and studio campus addresses.</p>
          </div>
          <button type="submit" class="cfg-btn cfg-btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
            <span>Save Contact Settings</span>
          </button>
        </div>

        <div class="cfg-grid-2">
          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Primary Contact Email</span>
              <span class="cfg-label-tag">contact_email</span>
            </label>
            <input type="email" name="settings[contact_email]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['contact_email'] ?? 'contact@clickcodex.com') ?>" required />
            <span class="cfg-help-text">Displayed on the Contact Us page and footer inquiries.</span>
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Customer Support Email</span>
              <span class="cfg-label-tag">support_email</span>
            </label>
            <input type="email" name="settings[support_email]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['support_email'] ?? 'support@clickcodex.com') ?>" />
            <span class="cfg-help-text">Dedicated inbox for active client tickets.</span>
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Public Contact Phone Placeholder</span>
              <span class="cfg-label-tag">contact_phone</span>
            </label>
            <input type="text" name="settings[contact_phone]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['contact_phone'] ?? '') ?>" />
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>WhatsApp Direct Hotline (Digits with country code)</span>
              <span class="cfg-label-tag">whatsapp_number</span>
            </label>
            <input type="text" name="settings[whatsapp_number]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['whatsapp_number'] ?? '+919876543210') ?>" />
            <span class="cfg-help-text">Target number for one-click WhatsApp chat triggers.</span>
          </div>

          <div class="cfg-form-group cfg-col-span-2">
            <label class="cfg-label">
              <span>WhatsApp Pre-filled Greeting Prompt</span>
              <span class="cfg-label-tag">whatsapp_default_message</span>
            </label>
            <input type="text" name="settings[whatsapp_default_message]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['whatsapp_default_message'] ?? '') ?>" />
            <span class="cfg-help-text">Default message pre-typed when user clicks the WhatsApp button.</span>
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Operating Business Hours</span>
              <span class="cfg-label-tag">working_hours</span>
            </label>
            <input type="text" name="settings[working_hours]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['working_hours'] ?? 'Monday – Saturday: 9:30 AM – 6:30 PM IST') ?>" />
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Base Operating Region</span>
              <span class="cfg-label-tag">contact_address</span>
            </label>
            <input type="text" name="settings[contact_address]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['contact_address'] ?? 'India') ?>" />
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Bangalore Campus Address</span>
              <span class="cfg-label-tag">address_bangalore</span>
            </label>
            <textarea name="settings[address_bangalore]" class="cfg-textarea" rows="2"><?= htmlspecialchars($flatSettings['address_bangalore'] ?? '') ?></textarea>
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Mumbai Studio Address</span>
              <span class="cfg-label-tag">address_mumbai</span>
            </label>
            <textarea name="settings[address_mumbai]" class="cfg-textarea" rows="2"><?= htmlspecialchars($flatSettings['address_mumbai'] ?? '') ?></textarea>
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- ========================================================================
       TAB 3: BRANDING & VISUAL DESIGN TOKENS
       ======================================================================== -->
  <div id="tab-branding" class="cfg-tab-content" style="<?= $activeTab === 'branding' ? 'display: block;' : 'display: none;' ?>">
    <form action="<?= BASE_URL ?>/admin/settings/save" method="POST" onsubmit="handleTabSubmit(event, 'branding')">
      <input type="hidden" name="current_group" value="branding" />

      <div class="cfg-card">
        <div class="cfg-card-header">
          <div>
            <h2 class="cfg-card-title">🎨 Brand Identity & Visual Tokens</h2>
            <p class="cfg-card-desc">Set brand color palettes, browser toolbar accent tones, and logo asset filepaths.</p>
          </div>
          <button type="submit" class="cfg-btn cfg-btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
            <span>Save Branding</span>
          </button>
        </div>

        <div class="cfg-grid-3">
          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Primary Logo Path</span>
              <span class="cfg-label-tag">site_logo</span>
            </label>
            <input type="text" name="settings[site_logo]" id="cfgSiteLogo" class="cfg-input" value="<?= htmlspecialchars($flatSettings['site_logo'] ?? 'assets/images/logo.png') ?>" oninput="updateBrandPreview()" />
            <span class="cfg-help-text">Relative to root or public directory.</span>
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Dark Mode Logo Path</span>
              <span class="cfg-label-tag">site_logo_dark</span>
            </label>
            <input type="text" name="settings[site_logo_dark]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['site_logo_dark'] ?? 'assets/images/logo.png') ?>" />
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Browser Favicon Path</span>
              <span class="cfg-label-tag">site_favicon</span>
            </label>
            <input type="text" name="settings[site_favicon]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['site_favicon'] ?? 'assets/images/logo.png') ?>" />
          </div>

          <!-- Color Tokens with Bidirectional Pickers -->
          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Primary Brand Color</span>
              <span class="cfg-label-tag">brand_primary_color</span>
            </label>
            <div class="cfg-color-wrap">
              <input type="color" id="pickerBrandPrimary" value="<?= htmlspecialchars($flatSettings['brand_primary_color'] ?? '#0056d6') ?>" class="cfg-color-input" oninput="syncColorField('pickerBrandPrimary', 'inputBrandPrimary')" />
              <input type="text" name="settings[brand_primary_color]" id="inputBrandPrimary" class="cfg-input" value="<?= htmlspecialchars($flatSettings['brand_primary_color'] ?? '#0056d6') ?>" oninput="syncColorField('inputBrandPrimary', 'pickerBrandPrimary')" />
            </div>
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Accent Cyan Glow Color</span>
              <span class="cfg-label-tag">brand_accent_color</span>
            </label>
            <div class="cfg-color-wrap">
              <input type="color" id="pickerBrandAccent" value="<?= htmlspecialchars($flatSettings['brand_accent_color'] ?? '#00a2ff') ?>" class="cfg-color-input" oninput="syncColorField('pickerBrandAccent', 'inputBrandAccent')" />
              <input type="text" name="settings[brand_accent_color]" id="inputBrandAccent" class="cfg-input" value="<?= htmlspecialchars($flatSettings['brand_accent_color'] ?? '#00a2ff') ?>" oninput="syncColorField('inputBrandAccent', 'pickerBrandAccent')" />
            </div>
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Mobile Browser Theme Color</span>
              <span class="cfg-label-tag">theme_color</span>
            </label>
            <div class="cfg-color-wrap">
              <input type="color" id="pickerThemeColor" value="<?= htmlspecialchars($flatSettings['theme_color'] ?? '#0056d6') ?>" class="cfg-color-input" oninput="syncColorField('pickerThemeColor', 'inputThemeColor')" />
              <input type="text" name="settings[theme_color]" id="inputThemeColor" class="cfg-input" value="<?= htmlspecialchars($flatSettings['theme_color'] ?? '#0056d6') ?>" oninput="syncColorField('inputThemeColor', 'pickerThemeColor')" />
            </div>
          </div>
        </div>

        <!-- Live Visual Brand Token Demonstration Box -->
        <div class="cfg-brand-preview" id="brandLiveMockup">
          <div style="display: flex; align-items: center; gap: 16px;">
            <img src="<?= BASE_URL ?>/public/assets/images/logo.png" alt="Logo Preview" style="width: 48px; height: 48px; border-radius: 12px; background: rgba(255,255,255,0.1); padding: 4px;" />
            <div>
              <div style="font-size: 1.1rem; font-weight: 800; color: #ffffff;">
                <span id="previewBrandName"><?= htmlspecialchars($flatSettings['company_name'] ?? 'Click Codex') ?></span>
              </div>
              <div style="font-size: 0.8rem; color: #94a3b8;" id="previewBrandTagline">
                <?= htmlspecialchars($flatSettings['company_tagline'] ?? 'Digital Craftsmanship') ?>
              </div>
            </div>
          </div>

          <div style="display: flex; gap: 10px; align-items: center;">
            <button type="button" id="previewBtnPrimary" style="background: <?= htmlspecialchars($flatSettings['brand_primary_color'] ?? '#0056d6') ?>; color: #ffffff; border: none; padding: 8px 18px; border-radius: 8px; font-weight: 700; font-size: 0.82rem; cursor: pointer;">
              Interactive CTA
            </button>
            <span id="previewGlowBadge" style="background: rgba(0, 162, 255, 0.15); border: 1px solid <?= htmlspecialchars($flatSettings['brand_accent_color'] ?? '#00a2ff') ?>; color: #38bdf8; padding: 6px 12px; border-radius: 999px; font-size: 0.76rem; font-weight: 700;">
              Accent Glow
            </span>
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- ========================================================================
       TAB 4: SEO, METADATA & OPENGRAPH
       ======================================================================== -->
  <div id="tab-seo" class="cfg-tab-content" style="<?= $activeTab === 'seo' ? 'display: block;' : 'display: none;' ?>">
    <form action="<?= BASE_URL ?>/admin/settings/save" method="POST" onsubmit="handleTabSubmit(event, 'seo')">
      <input type="hidden" name="current_group" value="seo" />

      <div class="cfg-card">
        <div class="cfg-card-header">
          <div>
            <h2 class="cfg-card-title">🔍 Search Engine Optimization & Social Graph</h2>
            <p class="cfg-card-desc">Default meta title, keyword clusters, and meta descriptions fallback for pages without custom overrides.</p>
          </div>
          <button type="submit" class="cfg-btn cfg-btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
            <span>Save SEO Settings</span>
          </button>
        </div>

        <div class="cfg-grid-2">
          <div class="cfg-form-group cfg-col-span-2">
            <label class="cfg-label">
              <span>Default Title Tag (60–70 characters recommended)</span>
              <span class="cfg-label-tag">default_meta_title</span>
            </label>
            <input type="text" name="settings[default_meta_title]" id="cfgMetaTitle" class="cfg-input" value="<?= htmlspecialchars($flatSettings['default_meta_title'] ?? '') ?>" oninput="updateSerpPreview()" required />
          </div>

          <div class="cfg-form-group cfg-col-span-2">
            <label class="cfg-label">
              <span>Default Meta Description (140–160 characters recommended)</span>
              <span class="cfg-label-tag">default_meta_desc</span>
            </label>
            <textarea name="settings[default_meta_desc]" id="cfgMetaDesc" class="cfg-textarea" rows="3" oninput="updateSerpPreview()"><?= htmlspecialchars($flatSettings['default_meta_desc'] ?? '') ?></textarea>
            <div style="display: flex; justify-content: space-between; font-size: 0.74rem; color: #64748b; margin-top: 4px;">
              <span>Optimal length: 155 characters</span>
              <span id="metaDescCount">0 chars</span>
            </div>
          </div>

          <div class="cfg-form-group cfg-col-span-2">
            <label class="cfg-label">
              <span>Default Core Keyword Clusters (Comma-separated)</span>
              <span class="cfg-label-tag">default_keywords</span>
            </label>
            <textarea name="settings[default_keywords]" class="cfg-textarea" rows="2"><?= htmlspecialchars($flatSettings['default_keywords'] ?? '') ?></textarea>
          </div>
        </div>

        <!-- Google SERP Live Simulation -->
        <label class="cfg-label" style="margin-top: 14px;">Live Google Search Snippet Simulation</label>
        <div class="cfg-serp-box">
          <div class="cfg-serp-url">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#202124" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
            <span>https://clickcodex.com</span>
          </div>
          <div class="cfg-serp-title" id="serpPreviewTitle">Click Codex — Technology & Creative Digital Startup</div>
          <div class="cfg-serp-desc" id="serpPreviewDesc">Click Codex is a modern technology startup providing Full-Stack Web Development, Mobile Apps, UI/UX, Graphic Design, Digital Marketing, and Professional Video/Reel Production.</div>
        </div>
      </div>
    </form>
  </div>

  <!-- ========================================================================
       TAB 5: SOCIAL MEDIA CHANNELS
       ======================================================================== -->
  <div id="tab-social" class="cfg-tab-content" style="<?= $activeTab === 'social' ? 'display: block;' : 'display: none;' ?>">
    <form action="<?= BASE_URL ?>/admin/settings/save" method="POST" onsubmit="handleTabSubmit(event, 'social')">
      <input type="hidden" name="current_group" value="social" />

      <div class="cfg-card">
        <div class="cfg-card-header">
          <div>
            <h2 class="cfg-card-title">🌐 Official Social Media Profiles</h2>
            <p class="cfg-card-desc">Social URLs linked across header badges, footer ribbons, and schema structured data SameAs nodes.</p>
          </div>
          <button type="submit" class="cfg-btn cfg-btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
            <span>Save Social Links</span>
          </button>
        </div>

        <div class="cfg-grid-2">
          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>LinkedIn Company Page</span>
              <span class="cfg-label-tag">social_linkedin</span>
            </label>
            <input type="url" name="settings[social_linkedin]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['social_linkedin'] ?? '') ?>" placeholder="https://linkedin.com/company/clickcodex" />
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Instagram Official Handle</span>
              <span class="cfg-label-tag">social_instagram</span>
            </label>
            <input type="url" name="settings[social_instagram]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['social_instagram'] ?? '') ?>" placeholder="https://instagram.com/clickcodex" />
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>YouTube Channel URL</span>
              <span class="cfg-label-tag">social_youtube</span>
            </label>
            <input type="url" name="settings[social_youtube]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['social_youtube'] ?? '') ?>" placeholder="https://youtube.com/@clickcodex" />
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>GitHub Organization Profile</span>
              <span class="cfg-label-tag">social_github</span>
            </label>
            <input type="url" name="settings[social_github]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['social_github'] ?? '') ?>" placeholder="https://github.com/clickcodex" />
          </div>

          <div class="cfg-form-group cfg-col-span-2">
            <label class="cfg-label">
              <span>Twitter / X Profile</span>
              <span class="cfg-label-tag">social_twitter</span>
            </label>
            <input type="url" name="settings[social_twitter]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['social_twitter'] ?? '') ?>" placeholder="https://twitter.com/clickcodex" />
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- ========================================================================
       TAB 6: ANALYTICS & TELEMETRY
       ======================================================================== -->
  <div id="tab-analytics" class="cfg-tab-content" style="<?= $activeTab === 'analytics' ? 'display: block;' : 'display: none;' ?>">
    <form action="<?= BASE_URL ?>/admin/settings/save" method="POST" onsubmit="handleTabSubmit(event, 'analytics')">
      <input type="hidden" name="current_group" value="analytics" />

      <div class="cfg-card">
        <div class="cfg-card-header">
          <div>
            <h2 class="cfg-card-title">📊 Analytics Containers & Conversion Pixels</h2>
            <p class="cfg-card-desc">Inject official Google Tag Manager, Google Analytics 4, and Meta Pixel tracking containers without manual file edits.</p>
          </div>
          <button type="submit" class="cfg-btn cfg-btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
            <span>Save Tracking Containers</span>
          </button>
        </div>

        <div class="cfg-grid-3">
          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>GA4 Measurement ID</span>
              <span class="cfg-label-tag">google_analytics_id</span>
            </label>
            <input type="text" name="settings[google_analytics_id]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['google_analytics_id'] ?? '') ?>" placeholder="G-XXXXXXXXXX" />
            <span class="cfg-help-text">Leave blank to disable Google Analytics.</span>
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Google Tag Manager ID</span>
              <span class="cfg-label-tag">google_tag_manager_id</span>
            </label>
            <input type="text" name="settings[google_tag_manager_id]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['google_tag_manager_id'] ?? '') ?>" placeholder="GTM-XXXXXXX" />
            <span class="cfg-help-text">Loads head and noscript body tags.</span>
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Meta (Facebook) Pixel ID</span>
              <span class="cfg-label-tag">meta_pixel_id</span>
            </label>
            <input type="text" name="settings[meta_pixel_id]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['meta_pixel_id'] ?? '') ?>" placeholder="123456789012345" />
            <span class="cfg-help-text">For ad tracking and attribution.</span>
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- ========================================================================
       TAB 7: SCRIPTS & CUSTOM EMBED INJECTIONS
       ======================================================================== -->
  <div id="tab-scripts" class="cfg-tab-content" style="<?= $activeTab === 'scripts' ? 'display: block;' : 'display: none;' ?>">
    <form action="<?= BASE_URL ?>/admin/settings/save" method="POST" onsubmit="handleTabSubmit(event, 'scripts')">
      <input type="hidden" name="current_group" value="scripts" />

      <div class="cfg-card">
        <div class="cfg-card-header">
          <div>
            <h2 class="cfg-card-title">💻 Code Embeds & Script Injections</h2>
            <p class="cfg-card-desc">Inject custom HTML, CSS, JavaScript, or external chat widgets securely into public page templates.</p>
          </div>
          <button type="submit" class="cfg-btn cfg-btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
            <span>Save Custom Code</span>
          </button>
        </div>

        <div class="cfg-form-group">
          <label class="cfg-label">
            <span>Header Injections (Injected right before &lt;/head&gt;)</span>
            <span class="cfg-label-tag">custom_head_scripts</span>
          </label>
          <textarea name="settings[custom_head_scripts]" class="cfg-textarea cfg-code-area" placeholder="<!-- External meta verification, fonts, or tracking scripts -->"><?= htmlspecialchars($flatSettings['custom_head_scripts'] ?? '') ?></textarea>
          <span class="cfg-help-text">Ensure you include &lt;script&gt; or &lt;link&gt; tags if providing raw tags.</span>
        </div>

        <div class="cfg-form-group">
          <label class="cfg-label">
            <span>Footer Injections (Injected right before &lt;/body&gt;)</span>
            <span class="cfg-label-tag">custom_footer_scripts</span>
          </label>
          <textarea name="settings[custom_footer_scripts]" class="cfg-textarea cfg-code-area" placeholder="<!-- Chatbots, Hotjar, or custom analytics scripts -->"><?= htmlspecialchars($flatSettings['custom_footer_scripts'] ?? '') ?></textarea>
        </div>
      </div>
    </form>
  </div>

  <!-- ========================================================================
       TAB 8: LEGAL COMPLIANCE & MAINTENANCE
       ======================================================================== -->
  <div id="tab-legal" class="cfg-tab-content" style="<?= $activeTab === 'legal' ? 'display: block;' : 'display: none;' ?>">
    <form action="<?= BASE_URL ?>/admin/settings/save" method="POST" onsubmit="handleTabSubmit(event, 'legal')">
      <input type="hidden" name="current_group" value="legal" />

      <div class="cfg-card">
        <div class="cfg-card-header">
          <div>
            <h2 class="cfg-card-title">🛡️ Legal Governance & System State</h2>
            <p class="cfg-card-desc">Control emergency maintenance mode, GDPR cookie banner notices, and legal agreement dates.</p>
          </div>
          <button type="submit" class="cfg-btn cfg-btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
            <span>Save Governance</span>
          </button>
        </div>

        <div class="cfg-grid-2">
          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Enable Cookie Consent Banner</span>
              <span class="cfg-label-tag">cookie_consent_enabled</span>
            </label>
            <label class="cfg-switch-wrap">
              <input type="checkbox" name="settings[cookie_consent_enabled]" value="1" class="cfg-switch-input" <?= !empty($flatSettings['cookie_consent_enabled']) ? 'checked' : '' ?> />
              <span class="cfg-switch"></span>
              <span style="font-size: 0.85rem; font-weight: 600; color: #334155;">Show GDPR/Privacy floating notice</span>
            </label>
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Emergency Maintenance Mode</span>
              <span class="cfg-label-tag">maintenance_mode</span>
            </label>
            <label class="cfg-switch-wrap">
              <input type="checkbox" name="settings[maintenance_mode]" value="1" class="cfg-switch-input" <?= !empty($flatSettings['maintenance_mode']) ? 'checked' : '' ?> />
              <span class="cfg-switch"></span>
              <span style="font-size: 0.85rem; font-weight: 600; color: #ef4444;">Pause public access (Admin remains accessible)</span>
            </label>
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Terms of Service Effective Date</span>
              <span class="cfg-label-tag">terms_effective_date</span>
            </label>
            <input type="text" name="settings[terms_effective_date]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['terms_effective_date'] ?? 'September 2026') ?>" />
          </div>

          <div class="cfg-form-group">
            <label class="cfg-label">
              <span>Privacy Policy Effective Date</span>
              <span class="cfg-label-tag">privacy_effective_date</span>
            </label>
            <input type="text" name="settings[privacy_effective_date]" class="cfg-input" value="<?= htmlspecialchars($flatSettings['privacy_effective_date'] ?? 'September 2026') ?>" />
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- ========================================================================
       TAB 9: MASTER TABLE (ALL KEYS LIST)
       ======================================================================== -->
  <div id="tab-all" class="cfg-tab-content" style="<?= $activeTab === 'all' ? 'display: block;' : 'display: none;' ?>">
    <div class="cfg-card">
      <div class="cfg-card-header">
        <div>
          <h2 class="cfg-card-title">📋 Comprehensive Parameters Registry</h2>
          <p class="cfg-card-desc">Inspect, filter, modify, or delete all individual database keys registered in the system.</p>
        </div>
        <div style="display: flex; gap: 12px; align-items: center;">
          <input type="text" id="cfgSearchMaster" class="cfg-input" placeholder="Filter settings by key or group..." style="max-width: 280px;" oninput="filterMasterTable()" />
        </div>
      </div>

      <div style="overflow-x: auto;">
        <table class="cfg-table" id="masterSettingsTable">
          <thead>
            <tr>
              <th style="width: 50px;">ID</th>
              <th>Setting Key</th>
              <th>Domain</th>
              <th>Type</th>
              <th>Scope</th>
              <th>Value</th>
              <th style="text-align: right; width: 120px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($groups as $gName => $rows): ?>
              <?php foreach ($rows as $s): ?>
                <tr class="master-row" data-key="<?= strtolower(htmlspecialchars($s['setting_key'])) ?>" data-group="<?= strtolower(htmlspecialchars($s['setting_group'])) ?>">
                  <td style="color: #94a3b8; font-weight: 700;"><?= (int)$s['id'] ?></td>
                  <td>
                    <div style="font-weight: 700; color: #0f172a; font-family: monospace;"><?= htmlspecialchars($s['setting_key']) ?></div>
                    <div style="font-size: 0.76rem; color: #64748b;"><?= htmlspecialchars($s['description'] ?? '') ?></div>
                  </td>
                  <td>
                    <span style="font-size: 0.75rem; text-transform: uppercase; font-weight: 700; background: #e0f2fe; color: #0284c7; padding: 3px 8px; border-radius: 6px;">
                      <?= htmlspecialchars($s['setting_group']) ?>
                    </span>
                  </td>
                  <td style="font-family: monospace; color: #8b5cf6; font-size: 0.78rem;">
                    <?= htmlspecialchars($s['value_type']) ?>
                  </td>
                  <td>
                    <?php if (!empty($s['is_public'])): ?>
                      <span style="font-size: 0.72rem; font-weight: 700; background: rgba(16, 185, 129, 0.12); color: #059669; padding: 2px 7px; border-radius: 999px;">Public</span>
                    <?php else: ?>
                      <span style="font-size: 0.72rem; font-weight: 700; background: rgba(239, 68, 68, 0.12); color: #dc2626; padding: 2px 7px; border-radius: 999px;">Private</span>
                    <?php endif; ?>
                  </td>
                  <td style="max-width: 320px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 0.84rem; color: #334155;">
                    <?= htmlspecialchars(substr((string)$s['setting_value'], 0, 75)) ?>
                  </td>
                  <td style="text-align: right;">
                    <button type="button" class="cfg-btn cfg-btn-glass cfg-btn-sm" onclick='openEditSingleModal(<?= json_encode($s) ?>)' title="Quick Edit">
                      ✏️ Edit
                    </button>
                    <?php if (!in_array($s['setting_key'], ['company_name', 'site_name', 'contact_email', 'site_logo'], true)): ?>
                      <button type="button" class="cfg-btn cfg-btn-sm" style="color: #ef4444; background: rgba(239, 68, 68, 0.08); border: none;" onclick="deleteSettingKey('<?= htmlspecialchars($s['setting_key']) ?>')" title="Delete">
                        ✕
                      </button>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div><!-- /admin-content -->

<!-- ========================================================================
     MODAL 1: ADD CUSTOM SETTING KEY
     ======================================================================== -->
<div class="cfg-modal-backdrop" id="addSettingModal" style="display: none;" onclick="closeModalOnBackdrop(event, 'addSettingModal')">
  <div class="cfg-modal" onclick="event.stopPropagation()">
    <div class="cfg-modal-header">
      <h3 style="margin: 0; font-size: 1.2rem; font-weight: 800; color: #0f172a;">Register New Setting Parameter</h3>
      <button type="button" class="cfg-modal-close" onclick="closeModal('addSettingModal')">&times;</button>
    </div>

    <form onsubmit="submitNewSetting(event)">
      <div class="cfg-form-group">
        <label class="cfg-label">Setting Key (lowercase letters, numbers, underscores)</label>
        <input type="text" id="newSettingKey" class="cfg-input" placeholder="e.g. mobile_banner_cta" required pattern="[a-z0-9_]+" />
      </div>

      <div class="cfg-grid-2">
        <div class="cfg-form-group">
          <label class="cfg-label">Domain Group</label>
          <select id="newSettingGroup" class="cfg-select">
            <option value="general">general</option>
            <option value="contact">contact</option>
            <option value="branding">branding</option>
            <option value="seo">seo</option>
            <option value="social">social</option>
            <option value="analytics">analytics</option>
            <option value="scripts">scripts</option>
            <option value="legal">legal</option>
          </select>
        </div>

        <div class="cfg-form-group">
          <label class="cfg-label">Data Type</label>
          <select id="newSettingType" class="cfg-select">
            <option value="string">string</option>
            <option value="text">text</option>
            <option value="boolean">boolean (0 or 1)</option>
            <option value="integer">integer</option>
            <option value="json">json</option>
          </select>
        </div>
      </div>

      <div class="cfg-form-group">
        <label class="cfg-label">Initial Value</label>
        <textarea id="newSettingValue" class="cfg-textarea" rows="2" placeholder="Value for the setting"></textarea>
      </div>

      <div class="cfg-form-group">
        <label class="cfg-label">Internal Description / Documentation</label>
        <input type="text" id="newSettingDesc" class="cfg-input" placeholder="Explain how this parameter is consumed" />
      </div>

      <div class="cfg-form-group">
        <label class="cfg-switch-wrap">
          <input type="checkbox" id="newSettingPublic" value="1" class="cfg-switch-input" checked />
          <span class="cfg-switch"></span>
          <span style="font-size: 0.85rem; font-weight: 600;">Expose on public frontend API / queries</span>
        </label>
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px;">
        <button type="button" class="cfg-btn cfg-btn-glass" onclick="closeModal('addSettingModal')" style="color: #334155; border-color: #cbd5e1;">Cancel</button>
        <button type="submit" id="btnSubmitNewKey" class="cfg-btn cfg-btn-primary">Register Parameter</button>
      </div>
    </form>
  </div>
</div>

<!-- ========================================================================
     MODAL 2: QUICK EDIT SINGLE KEY
     ======================================================================== -->
<div class="cfg-modal-backdrop" id="editSingleModal" style="display: none;" onclick="closeModalOnBackdrop(event, 'editSingleModal')">
  <div class="cfg-modal" onclick="event.stopPropagation()">
    <div class="cfg-modal-header">
      <h3 style="margin: 0; font-size: 1.2rem; font-weight: 800; color: #0f172a;">
        Edit Parameter: <code id="editSingleKeyTitle" style="color: var(--cfg-primary);"></code>
      </h3>
      <button type="button" class="cfg-modal-close" onclick="closeModal('editSingleModal')">&times;</button>
    </div>

    <form onsubmit="submitEditSingle(event)">
      <input type="hidden" id="editSingleKey" />

      <div class="cfg-form-group">
        <label class="cfg-label">Parameter Value</label>
        <textarea id="editSingleValue" class="cfg-textarea" rows="4"></textarea>
      </div>

      <div class="cfg-form-group">
        <label class="cfg-label">Description</label>
        <input type="text" id="editSingleDesc" class="cfg-input" />
      </div>

      <div class="cfg-form-group">
        <label class="cfg-switch-wrap">
          <input type="checkbox" id="editSinglePublic" value="1" class="cfg-switch-input" />
          <span class="cfg-switch"></span>
          <span style="font-size: 0.85rem; font-weight: 600;">Public Frontend Visibility</span>
        </label>
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px;">
        <button type="button" class="cfg-btn cfg-btn-glass" onclick="closeModal('editSingleModal')" style="color: #334155; border-color: #cbd5e1;">Cancel</button>
        <button type="submit" id="btnSaveSingle" class="cfg-btn cfg-btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<!-- ========================================================================
     MODAL 3: IMPORT SETTINGS JSON
     ======================================================================== -->
<div class="cfg-modal-backdrop" id="importModal" style="display: none;" onclick="closeModalOnBackdrop(event, 'importModal')">
  <div class="cfg-modal" onclick="event.stopPropagation()">
    <div class="cfg-modal-header">
      <h3 style="margin: 0; font-size: 1.2rem; font-weight: 800; color: #0f172a;">Import Configuration Snapshot</h3>
      <button type="button" class="cfg-modal-close" onclick="closeModal('importModal')">&times;</button>
    </div>

    <form onsubmit="submitImport(event)">
      <p style="font-size: 0.85rem; color: #64748b; margin-top: 0;">Upload a JSON configuration file or paste JSON payload below.</p>

      <div class="cfg-form-group">
        <label class="cfg-label">Upload JSON File</label>
        <input type="file" id="importFileInput" accept=".json" class="cfg-input" />
      </div>

      <div class="cfg-form-group">
        <label class="cfg-label">Or Paste JSON Payload</label>
        <textarea id="importJsonText" class="cfg-textarea cfg-code-area" rows="6" placeholder='{"settings": [{"setting_key": "company_name", "setting_value": "Click Codex"}]}'></textarea>
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px;">
        <button type="button" class="cfg-btn cfg-btn-glass" onclick="closeModal('importModal')" style="color: #334155; border-color: #cbd5e1;">Cancel</button>
        <button type="submit" id="btnRunImport" class="cfg-btn cfg-btn-primary">Restore Settings</button>
      </div>
    </form>
  </div>
</div>

<!-- ========================================================================
     JAVASCRIPT LOGIC & INTERACTION ENGINE
     ======================================================================== -->
<script>
const BASE_URL = <?= json_encode(defined('BASE_URL') ? BASE_URL : '') ?>;

// 1. Tab Switching Engine
function switchTab(tabId) {
  document.querySelectorAll('.cfg-tab-content').forEach(el => el.style.display = 'none');
  document.querySelectorAll('.cfg-tab-link').forEach(el => el.classList.remove('active'));

  const target = document.getElementById('tab-' + tabId);
  if (target) {
    target.style.display = 'block';
  }

  // Highlight active button
  const links = document.querySelectorAll('.cfg-tab-link');
  links.forEach(link => {
    if (link.getAttribute('onclick') && link.getAttribute('onclick').includes(tabId)) {
      link.classList.add('active');
    }
  });

  // Update browser URL without reload
  const newUrl = new URL(window.location);
  newUrl.searchParams.set('tab', tabId);
  window.history.replaceState({}, '', newUrl);
}

// 2. Color Synchronizer
function syncColorField(sourceId, targetId) {
  const source = document.getElementById(sourceId);
  const target = document.getElementById(targetId);
  if (!source || !target) return;

  target.value = source.value;
  updateBrandPreview();
}

function updateBrandPreview() {
  const primary = document.getElementById('inputBrandPrimary')?.value || '#0056d6';
  const accent = document.getElementById('inputBrandAccent')?.value || '#00a2ff';
  const brandName = document.getElementById('previewBrandName');
  const btn = document.getElementById('previewBtnPrimary');
  const badge = document.getElementById('previewGlowBadge');

  if (btn) btn.style.backgroundColor = primary;
  if (badge) badge.style.borderColor = accent;
}

// 3. Google SERP Simulation Live Updates
function updateSerpPreview() {
  const title = document.getElementById('cfgMetaTitle')?.value || 'Click Codex — Technology & Creative Digital Startup';
  const desc = document.getElementById('cfgMetaDesc')?.value || 'Click Codex digital agency platform...';

  const serpTitle = document.getElementById('serpPreviewTitle');
  const serpDesc = document.getElementById('serpPreviewDesc');
  const count = document.getElementById('metaDescCount');

  if (serpTitle) serpTitle.textContent = title;
  if (serpDesc) serpDesc.textContent = desc;
  if (count) count.textContent = desc.length + ' chars';
}
document.addEventListener('DOMContentLoaded', updateSerpPreview);

// 4. AJAX Tab Submission Handler
async function handleTabSubmit(e, tabName) {
  e.preventDefault();
  const form = e.target;
  const btn = form.querySelector('button[type="submit"]');
  const originalText = btn ? btn.innerHTML : '';

  if (btn) {
    btn.disabled = true;
    btn.innerHTML = '<span>Saving Changes...</span>';
  }

  try {
    const formData = new FormData(form);
    const res = await fetch(form.action, {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: formData
    });

    const data = await res.json();

    if (res.ok && data.success) {
      if (window.showToast) {
        window.showToast(data.message || 'Settings successfully saved to database.', 'success', 'Saved');
      }
    } else {
      if (window.showToast) {
        window.showToast(data.error || 'Failed to save settings. Please verify inputs.', 'error');
      }
    }
  } catch (err) {
    if (window.showToast) {
      window.showToast('Network or server error while saving settings.', 'error');
    }
  } finally {
    if (btn) {
      btn.disabled = false;
      btn.innerHTML = originalText;
    }
  }
}

// 5. Cache Flush Trigger
async function triggerClearCache() {
  try {
    const res = await fetch(`${BASE_URL}/admin/settings/clear-cache`, { method: 'POST' });
    const data = await res.json();
    if (data.success) {
      if (window.showToast) {
        window.showToast(data.message || 'Cache cleared successfully.', 'success', 'Cache Cleared');
      }
    } else {
      if (window.showToast) {
        window.showToast(data.error || 'Failed to clear cache.', 'error');
      }
    }
  } catch (err) {
    if (window.showToast) {
      window.showToast('Network error triggering cache flush.', 'error');
    }
  }
}

// 6. Master Table Search Filter
function filterMasterTable() {
  const query = document.getElementById('cfgSearchMaster').value.toLowerCase().trim();
  const rows = document.querySelectorAll('.master-row');

  rows.forEach(row => {
    const key = row.getAttribute('data-key') || '';
    const grp = row.getAttribute('data-group') || '';
    const text = row.textContent.toLowerCase();

    if (key.includes(query) || grp.includes(query) || text.includes(query)) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
}

// 7. Modals Open/Close
function openAddSettingModal() {
  document.getElementById('addSettingModal').style.display = 'flex';
}
function openImportModal() {
  document.getElementById('importModal').style.display = 'flex';
}
function closeModal(id) {
  document.getElementById(id).style.display = 'none';
}
function closeModalOnBackdrop(e, id) {
  if (e.target.id === id) {
    closeModal(id);
  }
}

// 8. Register New Setting Key
async function submitNewSetting(e) {
  e.preventDefault();
  const key = document.getElementById('newSettingKey').value.trim();
  const val = document.getElementById('newSettingValue').value;
  const grp = document.getElementById('newSettingGroup').value;
  const typ = document.getElementById('newSettingType').value;
  const desc = document.getElementById('newSettingDesc').value;
  const isPublic = document.getElementById('newSettingPublic').checked ? 1 : 0;
  const btn = document.getElementById('btnSubmitNewKey');

  btn.disabled = true;
  btn.textContent = 'Registering...';

  try {
    const res = await fetch(`${BASE_URL}/admin/settings/create`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        setting_key: key,
        setting_value: val,
        setting_group: grp,
        value_type: typ,
        description: desc,
        is_public: isPublic
      })
    });
    const data = await res.json();

    if (data.success) {
      closeModal('addSettingModal');
      if (window.showToast) {
        window.showToast(`Parameter '${key}' created. Reloading...`, 'success');
      }
      setTimeout(() => window.location.reload(), 1200);
    } else {
      if (window.showToast) {
        window.showToast(data.error || 'Failed to create parameter.', 'error');
      }
    }
  } catch (err) {
    if (window.showToast) window.showToast('Network error during parameter creation.', 'error');
  } finally {
    btn.disabled = false;
    btn.textContent = 'Register Parameter';
  }
}

// 9. Quick Edit Single Parameter Modal
function openEditSingleModal(setting) {
  document.getElementById('editSingleKeyTitle').textContent = setting.setting_key;
  document.getElementById('editSingleKey').value = setting.setting_key;
  document.getElementById('editSingleValue').value = setting.setting_value || '';
  document.getElementById('editSingleDesc').value = setting.description || '';
  document.getElementById('editSinglePublic').checked = parseInt(setting.is_public, 10) === 1;

  document.getElementById('editSingleModal').style.display = 'flex';
}

async function submitEditSingle(e) {
  e.preventDefault();
  const key = document.getElementById('editSingleKey').value;
  const val = document.getElementById('editSingleValue').value;
  const isPublic = document.getElementById('editSinglePublic').checked ? 1 : 0;
  const btn = document.getElementById('btnSaveSingle');

  btn.disabled = true;
  btn.textContent = 'Saving...';

  try {
    const res = await fetch(`${BASE_URL}/admin/settings/save-single`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ key: key, value: val, is_public: isPublic })
    });
    const data = await res.json();

    if (data.success) {
      closeModal('editSingleModal');
      if (window.showToast) {
        window.showToast(`Parameter '${key}' updated successfully.`, 'success');
      }
      setTimeout(() => window.location.reload(), 900);
    } else {
      if (window.showToast) window.showToast(data.error || 'Failed to update parameter.', 'error');
    }
  } catch (err) {
    if (window.showToast) window.showToast('Network error during parameter save.', 'error');
  } finally {
    btn.disabled = false;
    btn.textContent = 'Save Changes';
  }
}

// 10. Delete Custom Key
async function deleteSettingKey(key) {
  if (!confirm(`Are you sure you want to delete parameter '${key}'? This cannot be undone.`)) {
    return;
  }

  try {
    const res = await fetch(`${BASE_URL}/admin/settings/delete`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ key: key })
    });
    const data = await res.json();

    if (data.success) {
      if (window.showToast) window.showToast(`Parameter '${key}' deleted.`, 'success');
      setTimeout(() => window.location.reload(), 900);
    } else {
      if (window.showToast) window.showToast(data.error || 'Failed to delete parameter.', 'error');
    }
  } catch (err) {
    if (window.showToast) window.showToast('Network error during deletion.', 'error');
  }
}

// 11. Import Snapshot
async function submitImport(e) {
  e.preventDefault();
  const fileInput = document.getElementById('importFileInput');
  const textInput = document.getElementById('importJsonText');
  const btn = document.getElementById('btnRunImport');

  let payload = textInput.value.trim();

  if (fileInput.files.length > 0) {
    const file = fileInput.files[0];
    const reader = new FileReader();
    reader.onload = async function(event) {
      runImportRequest(event.target.result);
    };
    reader.readAsText(file);
    return;
  }

  if (payload) {
    runImportRequest(payload);
  } else {
    alert('Please select a JSON file or paste JSON payload.');
  }
}

async function runImportRequest(jsonText) {
  const btn = document.getElementById('btnRunImport');
  btn.disabled = true;
  btn.textContent = 'Importing...';

  try {
    const res = await fetch(`${BASE_URL}/admin/settings/import`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ json_payload: jsonText })
    });
    const data = await res.json();

    if (data.success) {
      closeModal('importModal');
      if (window.showToast) {
        window.showToast(data.message || 'Settings imported successfully.', 'success');
      }
      setTimeout(() => window.location.reload(), 1200);
    } else {
      if (window.showToast) window.showToast(data.error || 'Import failed: invalid JSON.', 'error');
    }
  } catch (err) {
    if (window.showToast) window.showToast('Network error during import.', 'error');
  } finally {
    btn.disabled = false;
    btn.textContent = 'Restore Settings';
  }
}
</script>

<?php
include __DIR__ . '/layout/footer.php';
?>
