<?php
/**
 * ClickCodex Technologies - Centralized Notifications Center
 * Unified dispatch stream for client inquiries, system telemetry, security audits, and milestones.
 */
declare(strict_types=1);

if (!defined('BASE_URL')) {
    define('BASE_URL', '');
}

$pageTitle = $pageTitle ?? 'Notifications Center | ClickCodex Studio Console';
$topbarTitle = 'Notifications Center';
$activeNav = 'notifications';

include __DIR__ . '/layout/header.php';

$category = $_GET['category'] ?? 'all';
$notifications = $notifications ?? [];
$unreadCount = $unreadCount ?? 0;
?>

<style>
:root {
  --notif-primary: #0056d6;
  --notif-accent: #00a2ff;
  --notif-green: #10b981;
  --notif-amber: #f59e0b;
  --notif-red: #ef4444;
  --notif-border: #e2e8f0;
}

.notif-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 32px;
  width: 100%;
  box-sizing: border-box;
}

.notif-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 16px;
  margin-bottom: 28px;
}

.notif-title-block h1 {
  font-size: 1.6rem;
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 6px 0;
  display: flex;
  align-items: center;
  gap: 10px;
}

.notif-title-block p {
  color: #64748b;
  margin: 0;
  font-size: 0.9rem;
}

/* Category Filter Bar */
.notif-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 14px;
  background: #ffffff;
  padding: 12px 18px;
  border-radius: 12px;
  border: 1px solid var(--notif-border);
  margin-bottom: 24px;
}

.notif-pills {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}

.notif-pill {
  padding: 6px 14px;
  border-radius: 8px;
  font-size: 0.82rem;
  font-weight: 700;
  color: #64748b;
  text-decoration: none;
  background: #f8fafc;
  border: 1px solid transparent;
  transition: all 0.2s ease;
}

.notif-pill:hover {
  color: var(--notif-primary);
  background: #f1f5f9;
}

.notif-pill.active {
  background: rgba(0, 86, 214, 0.1);
  color: var(--notif-primary);
  border-color: rgba(0, 86, 214, 0.2);
}

.notif-actions {
  display: flex;
  align-items: center;
  gap: 10px;
}

.notif-btn {
  padding: 7px 14px;
  border-radius: 8px;
  font-size: 0.8rem;
  font-weight: 700;
  cursor: pointer;
  border: 1px solid var(--notif-border);
  background: #ffffff;
  color: #334155;
  transition: all 0.15s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.notif-btn:hover {
  background: #f8fafc;
  color: var(--notif-primary);
  border-color: #cbd5e1;
}

/* Notification Stream Items */
.notif-feed {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.notif-card {
  background: #ffffff;
  border: 1px solid var(--notif-border);
  border-radius: 12px;
  padding: 18px 22px;
  display: flex;
  align-items: flex-start;
  gap: 16px;
  transition: all 0.2s ease;
  box-shadow: 0 1px 4px rgba(0,0,0,0.02);
  position: relative;
}

.notif-card.unread {
  background: #f8fafc;
  border-left: 4px solid var(--notif-primary);
}

.notif-icon-wrap {
  width: 40px;
  height: 40px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.notif-icon-inquiry {
  background: rgba(0, 86, 214, 0.1);
  color: var(--notif-primary);
}

.notif-icon-security {
  background: rgba(239, 68, 68, 0.1);
  color: var(--notif-red);
}

.notif-icon-system {
  background: rgba(139, 92, 246, 0.1);
  color: #8b5cf6;
}

.notif-icon-milestone {
  background: rgba(16, 185, 129, 0.1);
  color: var(--notif-green);
}

.notif-content {
  flex: 1;
}

.notif-top-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 4px;
}

.notif-card-title {
  font-size: 0.95rem;
  font-weight: 700;
  color: #0f172a;
}

.notif-time {
  font-size: 0.75rem;
  color: #94a3b8;
  font-weight: 600;
}

.notif-desc {
  font-size: 0.86rem;
  color: #475569;
  line-height: 1.5;
  margin-bottom: 10px;
}

.notif-card-actions {
  display: flex;
  align-items: center;
  gap: 12px;
}

.notif-link {
  font-size: 0.78rem;
  font-weight: 700;
  color: var(--notif-primary);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}

.notif-link:hover {
  text-decoration: underline;
}

.notif-read-btn {
  font-size: 0.76rem;
  font-weight: 600;
  color: #64748b;
  background: transparent;
  border: none;
  cursor: pointer;
  padding: 0;
}

.notif-read-btn:hover {
  color: #0f172a;
}
</style>

<div class="notif-container">

  <!-- Header -->
  <div class="notif-header">
    <div class="notif-title-block">
      <h1>
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="var(--notif-primary)" stroke-width="2.5"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
        Notifications Center
      </h1>
      <p>Centralized alert log for inbound proposals, security audits, and system runtime telemetry.</p>
    </div>

    <div>
      <span style="font-size: 0.84rem; font-weight: 700; color: #475569; background: #e2e8f0; padding: 6px 14px; border-radius: 99px;">
        <?= $unreadCount ?> Unread Alerts
      </span>
    </div>
  </div>

  <!-- Filter & Actions Bar -->
  <div class="notif-bar">
    <div class="notif-pills">
      <a href="<?= BASE_URL ?>/admin/notifications?category=all" class="notif-pill <?= $category === 'all' ? 'active' : '' ?>">All Notifications</a>
      <a href="<?= BASE_URL ?>/admin/notifications?category=inquiry" class="notif-pill <?= $category === 'inquiry' ? 'active' : '' ?>">Inquiries & Leads</a>
      <a href="<?= BASE_URL ?>/admin/notifications?category=security" class="notif-pill <?= $category === 'security' ? 'active' : '' ?>">Security & Audits</a>
      <a href="<?= BASE_URL ?>/admin/notifications?category=system" class="notif-pill <?= $category === 'system' ? 'active' : '' ?>">System & Crons</a>
      <a href="<?= BASE_URL ?>/admin/notifications?category=milestone" class="notif-pill <?= $category === 'milestone' ? 'active' : '' ?>">Milestones</a>
    </div>

    <div class="notif-actions">
      <?php if ($unreadCount > 0): ?>
        <button type="button" class="notif-btn" onclick="markAllRead()">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
          <span>Mark All Read</span>
        </button>
      <?php endif; ?>
      <button type="button" class="notif-btn" onclick="clearRead()">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
        <span>Clear Read</span>
      </button>
    </div>
  </div>

  <!-- Feed -->
  <div class="notif-feed">
    <?php if (!empty($notifications)): ?>
      <?php foreach ($notifications as $n): ?>
        <?php
          $isUnread = ((int)$n['is_read'] === 0);
          $cat = $n['category'] ?? 'system';
          $iconClass = "notif-icon-{$cat}";
        ?>
        <div class="notif-card <?= $isUnread ? 'unread' : '' ?>" id="notif-card-<?= (int)$n['id'] ?>">
          <div class="notif-icon-wrap <?= $iconClass ?>">
            <?php if ($cat === 'inquiry'): ?>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
            <?php elseif ($cat === 'security'): ?>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            <?php elseif ($cat === 'milestone'): ?>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
            <?php else: ?>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            <?php endif; ?>
          </div>

          <div class="notif-content">
            <div class="notif-top-row">
              <div class="notif-card-title"><?= htmlspecialchars($n['title']) ?></div>
              <div class="notif-time"><?= date('M d, Y • H:i', strtotime($n['created_at'])) ?></div>
            </div>

            <div class="notif-desc"><?= htmlspecialchars($n['message']) ?></div>

            <div class="notif-card-actions">
              <?php 
                $actionUrl = !empty($n['link']) ? $n['link'] : ($n['action_url'] ?? '');
                if (!empty($actionUrl)): 
              ?>
                <a href="<?= BASE_URL . htmlspecialchars($actionUrl) ?>" class="notif-link">
                  <span>View Details</span>
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
              <?php endif; ?>

              <?php if ($isUnread): ?>
                <button type="button" class="notif-read-btn" onclick="markSingleRead(<?= (int)$n['id'] ?>)">
                  ✓ Mark as read
                </button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div style="background: #ffffff; border: 1px solid var(--notif-border); border-radius: 12px; padding: 60px 20px; text-align: center; color: #94a3b8;">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" style="margin-bottom: 12px;"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
        <div style="font-weight: 700; color: #475569; font-size: 1.05rem;">All caught up!</div>
        <div style="font-size: 0.85rem; margin-top: 4px;">No notifications found under this category.</div>
      </div>
    <?php endif; ?>
  </div>

</div>

<script>
async function markSingleRead(id) {
  try {
    const res = await fetch('<?= BASE_URL ?>/admin/notifications/mark-read', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({ id: id })
    });
    const data = await res.json();
    if (data.success) {
      const card = document.getElementById('notif-card-' + id);
      if (card) {
        card.classList.remove('unread');
        const readBtn = card.querySelector('.notif-read-btn');
        if (readBtn) readBtn.remove();
      }
    }
  } catch (err) {
    console.error('Failed to mark read', err);
  }
}

async function markAllRead() {
  try {
    const res = await fetch('<?= BASE_URL ?>/admin/notifications/mark-all-read', {
      method: 'POST',
      headers: { 'Accept': 'application/json' }
    });
    const data = await res.json();
    if (data.success) {
      if (typeof window.showToast === 'function') {
        window.showToast('All notifications marked as read.', 'success');
      }
      setTimeout(() => location.reload(), 500);
    }
  } catch (err) {
    if (typeof window.showToast === 'function') {
      window.showToast('Network error while marking notifications as read.', 'error');
    }
  }
}

async function clearRead() {
  if (!confirm('Purge all notifications that have been marked as read?')) {
    return;
  }

  try {
    const res = await fetch('<?= BASE_URL ?>/admin/notifications/clear', {
      method: 'POST',
      headers: { 'Accept': 'application/json' }
    });
    const data = await res.json();
    if (data.success) {
      if (typeof window.showToast === 'function') {
        window.showToast(data.message || 'Read notifications cleared.', 'success');
      }
      setTimeout(() => location.reload(), 500);
    }
  } catch (err) {
    if (typeof window.showToast === 'function') {
      window.showToast('Network error while clearing notifications.', 'error');
    }
  }
}
</script>

<?php
include __DIR__ . '/layout/footer.php';
?>
