<?php
/**
 * ClickCodex Technologies - Admin Sidebar Navigation Component
 * Reusable layout component included across all admin panel views.
 */
declare(strict_types=1);

if (defined('CC_ADMIN_SIDEBAR_RENDERED')) {
    return;
}
define('CC_ADMIN_SIDEBAR_RENDERED', true);

if (!defined('BASE_URL')) {
    define('BASE_URL', '');
}

$currentUser = $currentUser ?? ($_SESSION['admin_user'] ?? [
    'name' => 'Lead Architect Admin',
    'role' => 'super_admin',
    'email' => 'admin@clickcodex.com',
    'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop&crop=face'
]);
$userDisplayName = $currentUser['name'] ?? 'Admin';
$activeNav = $activeNav ?? 'dashboard';
?>
<!-- ========================================================================
     ADMIN SIDEBAR NAVIGATION
     ======================================================================== -->
<aside class="admin-sidebar" id="adminSidebar">
  <div class="sidebar-top">
    <!-- Brand Identity -->
    <a href="<?= BASE_URL ?>/admin/dashboard" class="sidebar-brand">
      <img src="<?= BASE_URL ?>/public/assets/images/logo.png" alt="ClickCodex" class="sidebar-brand-img" />
      <div>
        <div class="sidebar-brand-title">Click<span>codex</span></div>
        <span class="sidebar-brand-tag">Studio Console</span>
      </div>
    </a>

    <!-- Main Navigation Links -->
    <nav class="sidebar-nav">
      <a href="<?= BASE_URL ?>/admin/dashboard" class="sidebar-nav-item <?= $activeNav === 'dashboard' ? 'active' : '' ?>">
        <div class="sidebar-nav-item-left">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
          <span>Dashboard</span>
        </div>
      </a>

      <a href="<?= BASE_URL ?>/admin/dashboard#inquiries-panel" class="sidebar-nav-item <?= $activeNav === 'inquiries' ? 'active' : '' ?>">
        <div class="sidebar-nav-item-left">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
          <span>Inquiries & Leads</span>
        </div>
        <?php if (!empty($stats['new_inquiries'])): ?>
          <span class="nav-counter-badge" id="sidebarLeadBadge"><?= (int)$stats['new_inquiries'] ?></span>
        <?php endif; ?>
      </a>

      <a href="<?= BASE_URL ?>/admin/capabilities" class="sidebar-nav-item <?= $activeNav === 'capabilities' ? 'active' : '' ?>">
        <div class="sidebar-nav-item-left">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
          <span>Capabilities</span>
        </div>
        <span class="nav-counter-badge" style="background: rgba(0, 86, 214, 0.1); color: var(--admin-blue); font-weight: 700;"><?= (int)($stats['total_services'] ?? 6) ?></span>
      </a>

      <a href="<?= BASE_URL ?>/admin/portfolio" class="sidebar-nav-item <?= $activeNav === 'portfolio' ? 'active' : '' ?>">
        <div class="sidebar-nav-item-left">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
          <span>Portfolio Showroom</span>
        </div>
        <span class="nav-counter-badge" style="background: rgba(0, 86, 214, 0.1); color: var(--admin-blue); font-weight: 700;"><?= (int)($stats['total_case_studies'] ?? 10) ?></span>
      </a>

      <a href="<?= BASE_URL ?>/admin/articles" class="sidebar-nav-item <?= $activeNav === 'articles' ? 'active' : '' ?>">
        <div class="sidebar-nav-item-left">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
          <span>Articles (<?= (int)($stats['total_blog_posts'] ?? 7) ?>)</span>
        </div>
        <span class="nav-counter-badge" style="background: rgba(16, 185, 129, 0.12); color: var(--admin-green); font-weight: 700;"><?= (int)($stats['total_blog_posts'] ?? 7) ?></span>
      </a>

      <a href="<?= BASE_URL ?>/admin/solution-advisor" class="sidebar-nav-item <?= $activeNav === 'solution_advisor' ? 'active' : '' ?>">
        <div class="sidebar-nav-item-left">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
          <span>Solution Advisor (6)</span>
        </div>
        <span class="nav-counter-badge" style="background: rgba(0, 162, 255, 0.12); color: var(--admin-cyan); font-weight: 700;">6</span>
      </a>

      <a href="<?= BASE_URL ?>/admin/users" class="sidebar-nav-item <?= $activeNav === 'users' ? 'active' : '' ?>">
        <div class="sidebar-nav-item-left">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
          <span>User Management</span>
        </div>
        <span class="nav-counter-badge" style="background: rgba(139, 92, 246, 0.12); color: #8b5cf6; font-weight: 700;"><?= (int)($stats['total_users'] ?? 5) ?></span>
      </a>

      <a href="<?= BASE_URL ?>/admin/analytics" class="sidebar-nav-item <?= $activeNav === 'analytics' ? 'active' : '' ?>">
        <div class="sidebar-nav-item-left">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
          <span>Analytics & Telemetry</span>
        </div>
        <span class="nav-counter-badge" style="background: rgba(0, 162, 255, 0.12); color: var(--admin-cyan); font-weight: 700;">Live</span>
      </a>

      <a href="<?= BASE_URL ?>/admin/settings" class="sidebar-nav-item <?= $activeNav === 'settings' ? 'active' : '' ?>">
        <div class="sidebar-nav-item-left">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
          <span>Site Settings</span>
        </div>
        <span class="nav-counter-badge" style="background: rgba(16, 185, 129, 0.12); color: var(--admin-green); font-weight: 700;">Config</span>
      </a>

      <!-- Executive Systems & Modules -->
      <div class="sidebar-section-label">Executive & Systems</div>

      <a href="<?= BASE_URL ?>/admin/reporting" class="sidebar-nav-item <?= $activeNav === 'reporting' ? 'active' : '' ?>">
        <div class="sidebar-nav-item-left">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3,3 21,3 21,21 3,21"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
          <span>Executive Reporting</span>
        </div>
        <span class="nav-counter-badge" style="background: rgba(0, 86, 214, 0.1); color: var(--admin-blue); font-weight: 700;">BI</span>
      </a>

      <a href="<?= BASE_URL ?>/admin/integrations" class="sidebar-nav-item <?= $activeNav === 'integrations' ? 'active' : '' ?>">
        <div class="sidebar-nav-item-left">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5v14"/><circle cx="12" cy="12" r="9"/></svg>
          <span>Integrations & Hooks</span>
        </div>
        <span class="nav-counter-badge" style="background: rgba(16, 185, 129, 0.12); color: var(--admin-green); font-weight: 700;">Sync</span>
      </a>

      <a href="<?= BASE_URL ?>/admin/notifications" class="sidebar-nav-item <?= $activeNav === 'notifications' ? 'active' : '' ?>">
        <div class="sidebar-nav-item-left">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
          <span>Notifications Center</span>
        </div>
        <span class="nav-counter-badge" style="background: rgba(245, 158, 11, 0.12); color: #f59e0b; font-weight: 700;">Live</span>
      </a>

      <a href="<?= BASE_URL ?>/admin/data-export" class="sidebar-nav-item <?= $activeNav === 'data_export' ? 'active' : '' ?>">
        <div class="sidebar-nav-item-left">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
          <span>Data Export & Sync</span>
        </div>
        <span class="nav-counter-badge" style="background: rgba(139, 92, 246, 0.12); color: #8b5cf6; font-weight: 700;">Dump</span>
      </a>

      <a href="<?= BASE_URL ?>/admin/api-access" class="sidebar-nav-item <?= $activeNav === 'api_access' ? 'active' : '' ?>">
        <div class="sidebar-nav-item-left">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
          <span>REST API & Keys</span>
        </div>
        <span class="nav-counter-badge" style="background: rgba(0, 162, 255, 0.12); color: var(--admin-cyan); font-weight: 700;">v1</span>
      </a>
    </nav>
  </div>

  <!-- User Profile & Logout -->
  <div class="sidebar-footer">
    <div class="sidebar-user-block">
      <img src="<?= htmlspecialchars($currentUser['avatar_url'] ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop&crop=face') ?>" alt="Admin" class="sidebar-user-avatar" />
      <div>
        <div class="sidebar-user-name"><?= htmlspecialchars($userDisplayName) ?></div>
        <div class="sidebar-user-role"><?= htmlspecialchars(strtoupper((string)($currentUser['role'] ?? 'super_admin'))) ?></div>
      </div>
    </div>

    <a href="<?= BASE_URL ?>/admin/logout" class="sidebar-logout-btn" title="Sign Out">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
    </a>
  </div>
</aside>
