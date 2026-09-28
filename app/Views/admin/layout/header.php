<?php
/**
 * ClickCodex Technologies - Admin Topbar & Page Header Layout
 * Reusable layout component included across all admin panel views.
 */
declare(strict_types=1);

if (!defined('BASE_URL')) {
    define('BASE_URL', '');
}

// Compute dynamic time-of-day greeting
$currentHour = (int)date('H');
if ($currentHour < 12) {
    $timeGreeting = 'Good morning';
} elseif ($currentHour < 17) {
    $timeGreeting = 'Good afternoon';
} else {
    $timeGreeting = 'Good evening';
}

$currentUser = $currentUser ?? ($_SESSION['admin_user'] ?? [
    'name' => 'Lead Architect Admin',
    'role' => 'super_admin',
    'email' => 'admin@clickcodex.com',
    'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop&crop=face'
]);
$userDisplayName = $currentUser['name'] ?? 'Admin';
$stats = $stats ?? ['new_inquiries' => 0, 'total_inquiries' => 0, 'total_services' => 6, 'total_case_studies' => 4, 'total_blog_posts' => 4];
$recentInquiries = $recentInquiries ?? [];
$pageTitle = $pageTitle ?? 'Executive Studio Console | ClickCodex Admin';
$topbarTitle = $topbarTitle ?? 'Studio Console';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="robots" content="noindex, nofollow" />

  <!-- Google Fonts: Open Sans, Space Mono -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet" />

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?= BASE_URL ?>/public/assets/images/logo.png" />

  <!-- Admin Stylesheet -->
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/admin.css" />
</head>
<body>

  <!-- Universal Toast Notification Container -->
  <div id="toastContainer" class="toast-container" aria-live="polite"></div>

  <!-- Admin Shell -->
  <div class="admin-shell">

    <!-- Reusable Sidebar -->
    <?php include __DIR__ . '/sidebar.php'; ?>

    <!-- Main Viewport -->
    <main class="admin-main">

      <!-- ========================================================================
           ADMIN TOPBAR HEADER
           ======================================================================== -->
      <header class="admin-topbar">
        <!-- Left: Brand / Title -->
        <div class="topbar-left">
          <button type="button" class="sidebar-toggle-btn" id="sidebarToggle" aria-label="Toggle Navigation">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="3" y1="12" x2="21" y2="12"></line>
              <line x1="3" y1="6" x2="21" y2="6"></line>
              <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
          </button>

          <h2 class="topbar-title"><?= htmlspecialchars($topbarTitle) ?></h2>
        </div>

        <!-- Center: Omni Search Bar with Ctrl+K shortcut -->
        <div class="topbar-center">
          <div class="topbar-search-wrap">
            <svg class="topbar-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input type="text" id="omniSearchInput" class="topbar-search-input" placeholder="Search inquiries, services, clients..." autocomplete="off" />
            <kbd class="topbar-search-kbd">Ctrl+K</kbd>
          </div>
        </div>

        <!-- Right: Actions, Notifications, Profile -->
        <div class="topbar-right">

          <!-- + Quick Actions Dropdown -->
          <div class="topbar-dropdown-wrap">
            <button type="button" class="topbar-quick-action-btn" id="quickActionBtn" onclick="toggleDropdown('quickActionMenu', event)">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
              <span>Quick Action</span>
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </button>

            <div class="topbar-menu" id="quickActionMenu">
              <div class="menu-header">
                <div class="menu-header-title">Executive Shortcuts</div>
                <div class="menu-header-subtitle">Administrative triggers & sync</div>
              </div>
              <button type="button" class="menu-item" onclick="triggerClearCache()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"></polyline><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path></svg>
                <span>Flush System Cache</span>
              </button>
              <a href="<?= BASE_URL ?>/admin/capabilities" class="menu-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                <span>Manage Capabilities</span>
              </a>
              <a href="<?= BASE_URL ?>/admin/portfolio" class="menu-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                <span>Manage Portfolio</span>
              </a>
              <button type="button" class="menu-item" onclick="exportInquiriesCSV()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                <span>Export Inquiries (CSV)</span>
              </button>
              <a href="<?= BASE_URL ?>/admin/articles" class="menu-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                <span>Manage Articles (7)</span>
              </a>
              <a href="<?= BASE_URL ?>/admin/solution-advisor" class="menu-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                <span>Solution Advisor (6)</span>
              </a>
              <a href="<?= BASE_URL ?>/admin/users" class="menu-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                <span>User Management & RBAC</span>
              </a>
              <a href="<?= BASE_URL ?>/admin/analytics" class="menu-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                <span>Analytics & Telemetry</span>
              </a>
            </div>
          </div>

          <!-- Notification Center Bell -->
          <div class="topbar-dropdown-wrap">
            <button type="button" class="topbar-icon-btn" id="notifBellBtn" onclick="toggleDropdown('notificationMenu', event)" title="Notifications Center">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
              <?php if (!empty($stats['new_inquiries'])): ?>
                <span class="topbar-badge-counter" id="notifBadge"><?= (int)$stats['new_inquiries'] ?></span>
              <?php endif; ?>
            </button>

            <div class="topbar-menu notification-menu" id="notificationMenu">
              <div class="menu-header" style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                  <div class="menu-header-title">Notification Center</div>
                  <div class="menu-header-subtitle"><?= (int)($stats['new_inquiries'] ?? 0) ?> new inquiries pending</div>
                </div>
                <button type="button" onclick="markAllNotificationsRead()" style="font-size: 0.72rem; color: var(--admin-blue); font-weight: 700; cursor: pointer; background: transparent; border: none;">
                  Mark all read
                </button>
              </div>
              <div class="notification-list">
                <?php if (!empty($recentInquiries)): ?>
                  <?php foreach ($recentInquiries as $nInq): ?>
                    <div class="notification-item <?= ($nInq['status'] ?? '') === 'new' ? 'unread' : '' ?>" onclick="scrollToInquiry(<?= (int)$nInq['id'] ?>)">
                      <span class="notification-dot" style="<?= ($nInq['status'] ?? '') === 'new' ? 'background: var(--admin-orange);' : 'background: #cbd5e1;' ?>"></span>
                      <div>
                        <div class="notification-title"><?= htmlspecialchars($nInq['full_name'] ?? 'Client') ?> (<?= htmlspecialchars($nInq['company_name'] ?: 'Direct Inquiry') ?>)</div>
                        <div class="notification-desc"><?= htmlspecialchars($nInq['budget_bracket'] ?: 'Custom Scope') ?> • <?= htmlspecialchars(implode(', ', array_slice($nInq['services_list'] ?? [], 0, 2)) ?: 'Full Solution') ?></div>
                        <div class="notification-time"><?= date('M d, H:i', strtotime($nInq['created_at'] ?? 'now')) ?> • Status: <?= htmlspecialchars(strtoupper((string)($nInq['status'] ?? 'NEW'))) ?></div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php else: ?>
                  <div style="padding: 24px; text-align: center; color: var(--text-muted); font-size: 0.82rem;">
                    No new activity alerts.
                  </div>
                <?php endif; ?>
              </div>
              <div style="padding: 10px 16px; background: #f8fafc; border-top: 1px solid var(--border-color, #e2e8f0); text-align: center;">
                <a href="<?= BASE_URL ?>/admin/notifications" style="font-size: 0.78rem; font-weight: 700; color: var(--admin-blue, #0056d6); text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 6px;">
                  <span>Open Notifications Center</span>
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
              </div>
            </div>
          </div>

          <!-- Public Site Link -->
          <a href="<?= BASE_URL ?>/" target="_blank" rel="noopener noreferrer" class="topbar-live-site-btn" title="Open Public Website">
            <span>Public Site</span>
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
          </a>

          <div class="topbar-divider"></div>

          <!-- User Profile Dropdown Pill -->
          <div class="topbar-dropdown-wrap">
            <div class="topbar-profile-pill" id="profilePill" onclick="toggleDropdown('profileMenu', event)">
              <img src="<?= htmlspecialchars($currentUser['avatar_url'] ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop&crop=face') ?>" alt="Admin" class="topbar-profile-avatar" style="width: 30px; height: 30px; min-width: 30px; min-height: 30px; border-radius: 50%; object-fit: cover; border: 1.5px solid var(--admin-cyan); display: block; flex-shrink: 0;" />
              <div class="topbar-profile-info">
                <span class="topbar-profile-name"><?= htmlspecialchars($userDisplayName) ?></span>
                <span class="topbar-profile-role"><?= htmlspecialchars(strtoupper((string)($currentUser['role'] ?? 'super_admin'))) ?></span>
              </div>
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--text-muted); flex-shrink: 0;"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </div>

            <div class="topbar-menu" id="profileMenu">
              <div class="menu-header">
                <div class="menu-header-title"><?= htmlspecialchars($currentUser['email'] ?? 'admin@clickcodex.com') ?></div>
                <div class="menu-header-subtitle"><?= htmlspecialchars(strtoupper((string)($currentUser['role'] ?? 'super_admin'))) ?> Role • Production Access</div>
              </div>
              <button type="button" class="menu-item" onclick="triggerClearCache()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"></polyline><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path></svg>
                <span>Clear System Cache</span>
              </button>
              <button type="button" class="menu-item" onclick="testDatabaseLatency()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>
                <span>System Telemetry Check</span>
              </button>
              <a href="<?= BASE_URL ?>/admin/users" class="menu-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                <span>Team & User Directory</span>
              </a>
              <div class="menu-divider"></div>
              <a href="<?= BASE_URL ?>/admin/logout" class="menu-item danger">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                <span>Sign Out Securely</span>
              </a>
            </div>
          </div>
        </div>
      </header>
