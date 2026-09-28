<?php
/**
 * ClickCodex Technologies - Third-Party Webhooks & CRM Integrations Hub
 * Real-time event streaming for Slack, Discord, Zapier, Make, and Custom REST endpoints.
 */
declare(strict_types=1);

if (!defined('BASE_URL')) {
    define('BASE_URL', '');
}

$pageTitle = $pageTitle ?? 'Third-Party Webhooks & Integrations | ClickCodex Studio Console';
$topbarTitle = 'Third-Party Integrations';
$activeNav = 'integrations';

include __DIR__ . '/layout/header.php';
$webhooks = $webhooks ?? [];
?>

<style>
:root {
  --int-primary: #0056d6;
  --int-accent: #00a2ff;
  --int-green: #10b981;
  --int-border: #e2e8f0;
}

.int-container {
  max-width: 1440px;
  margin: 0 auto;
  padding: 32px;
  width: 100%;
  box-sizing: border-box;
}

.int-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 16px;
  margin-bottom: 28px;
}

.int-title-block h1 {
  font-size: 1.6rem;
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 6px 0;
  display: flex;
  align-items: center;
  gap: 10px;
}

.int-title-block p {
  color: #64748b;
  margin: 0;
  font-size: 0.9rem;
}

/* Preset Cards */
.int-presets-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 20px;
  margin-bottom: 32px;
}

.int-preset-card {
  background: #ffffff;
  border: 1px solid var(--int-border);
  border-radius: 14px;
  padding: 22px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition: all 0.2s ease;
  box-shadow: 0 2px 8px rgba(0,0,0,0.02);
}

.int-preset-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(0,0,0,0.06);
  border-color: #cbd5e1;
}

.int-preset-top {
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 12px;
}

.int-preset-icon {
  width: 44px;
  height: 44px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 800;
  font-size: 1.1rem;
}

.int-preset-name {
  font-size: 1.05rem;
  font-weight: 700;
  color: #0f172a;
}

.int-preset-desc {
  font-size: 0.84rem;
  color: #64748b;
  line-height: 1.5;
  margin-bottom: 18px;
}

.int-preset-btn {
  padding: 8px 14px;
  background: #f8fafc;
  border: 1px solid var(--int-border);
  border-radius: 8px;
  font-size: 0.8rem;
  font-weight: 700;
  color: #334155;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  transition: all 0.2s;
}

.int-preset-btn:hover {
  background: var(--int-primary);
  color: #ffffff;
  border-color: var(--int-primary);
}

/* Webhooks Table Panel */
.int-panel {
  background: #ffffff;
  border: 1px solid var(--int-border);
  border-radius: 14px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.02);
  overflow: hidden;
}

.int-panel-header {
  padding: 20px 24px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #f1f5f9;
}

.int-panel-title {
  font-size: 1.1rem;
  font-weight: 700;
  color: #0f172a;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 8px;
}

.int-btn-primary {
  background: linear-gradient(135deg, var(--int-primary), var(--int-accent));
  color: #ffffff;
  border: none;
  border-radius: 8px;
  padding: 9px 18px;
  font-size: 0.85rem;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  box-shadow: 0 3px 10px rgba(0, 86, 214, 0.25);
  transition: all 0.2s ease;
}

.int-btn-primary:hover {
  transform: translateY(-1px);
  box-shadow: 0 5px 15px rgba(0, 86, 214, 0.35);
}

.int-table {
  width: 100%;
  border-collapse: collapse;
}

.int-table th {
  background: #f8fafc;
  padding: 12px 20px;
  text-align: left;
  font-size: 0.8rem;
  font-weight: 700;
  color: #475569;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  border-bottom: 1px solid var(--int-border);
}

.int-table td {
  padding: 16px 20px;
  font-size: 0.88rem;
  color: #1e293b;
  border-bottom: 1px solid #f1f5f9;
  vertical-align: middle;
}

.int-table tr:hover td {
  background: #fbfcfe;
}

.int-badge {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 3px 8px;
  border-radius: 6px;
  font-size: 0.72rem;
  font-weight: 700;
}

.int-badge-active {
  background: rgba(16, 185, 129, 0.12);
  color: var(--int-green);
}

.int-badge-inactive {
  background: rgba(100, 116, 139, 0.12);
  color: #64748b;
}

.int-code {
  font-family: 'Space Mono', monospace;
  font-size: 0.78rem;
  background: #f1f5f9;
  padding: 3px 6px;
  border-radius: 4px;
  color: #0f172a;
  max-width: 320px;
  display: inline-block;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

/* Action Buttons */
.int-actions {
  display: flex;
  align-items: center;
  gap: 8px;
}

.int-action-btn {
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 0.76rem;
  font-weight: 700;
  border: 1px solid var(--int-border);
  background: #ffffff;
  color: #334155;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  transition: all 0.15s ease;
}

.int-action-btn:hover {
  background: #f1f5f9;
  color: var(--int-primary);
  border-color: #cbd5e1;
}

.int-action-btn.btn-test:hover {
  background: rgba(0, 86, 214, 0.08);
  color: var(--int-primary);
  border-color: var(--int-primary);
}

.int-action-btn.btn-del:hover {
  background: rgba(239, 68, 68, 0.08);
  color: #ef4444;
  border-color: #ef4444;
}

/* Modal */
.int-modal-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(15, 23, 42, 0.6);
  backdrop-filter: blur(4px);
  z-index: 1000;
  display: none;
  align-items: center;
  justify-content: center;
  padding: 20px;
}

.int-modal {
  background: #ffffff;
  width: 100%;
  max-width: 580px;
  border-radius: 16px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.2);
  overflow: hidden;
  animation: modalSlideUp 0.25s ease-out;
}

@keyframes modalSlideUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

.int-modal-header {
  padding: 20px 24px;
  background: #f8fafc;
  border-bottom: 1px solid var(--int-border);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.int-modal-title {
  font-size: 1.15rem;
  font-weight: 800;
  color: #0f172a;
  margin: 0;
}

.int-modal-close {
  background: transparent;
  border: none;
  font-size: 1.3rem;
  cursor: pointer;
  color: #64748b;
  padding: 4px;
  line-height: 1;
}

.int-modal-body {
  padding: 24px;
  display: flex;
  flex-direction: column;
  gap: 18px;
}

.int-form-group {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.int-form-label {
  font-size: 0.82rem;
  font-weight: 700;
  color: #334155;
}

.int-form-input, .int-form-select {
  padding: 10px 14px;
  border: 1px solid var(--int-border);
  border-radius: 8px;
  font-size: 0.88rem;
  outline: none;
  transition: border-color 0.2s;
  font-family: inherit;
}

.int-form-input:focus, .int-form-select:focus {
  border-color: var(--int-primary);
  box-shadow: 0 0 0 3px rgba(0, 86, 214, 0.1);
}

.int-modal-footer {
  padding: 16px 24px;
  background: #f8fafc;
  border-top: 1px solid var(--int-border);
  display: flex;
  justify-content: flex-end;
  gap: 12px;
}
</style>

<div class="int-container">

  <!-- Header -->
  <div class="int-header">
    <div class="int-title-block">
      <h1>
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="var(--int-primary)" stroke-width="2.5"><path d="M5 12h14"/><path d="M12 5v14"/><circle cx="12" cy="12" r="9"/></svg>
        Third-Party Webhooks & Integrations
      </h1>
      <p>Stream real-time project inquiries, consultation briefs, and system events to external platforms.</p>
    </div>

    <button type="button" class="int-btn-primary" onclick="openWebhookModal()">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
      <span>Configure Webhook</span>
    </button>
  </div>

  <!-- Integration Presets -->
  <div class="int-presets-grid">
    <!-- Slack -->
    <div class="int-preset-card">
      <div>
        <div class="int-preset-top">
          <div class="int-preset-icon" style="background: rgba(74, 21, 75, 0.1); color: #4a154b;">
            #
          </div>
          <div>
            <div class="int-preset-name">Slack Incoming Webhook</div>
            <div style="font-size: 0.72rem; color: #94a3b8;">Channel Notifications</div>
          </div>
        </div>
        <div class="int-preset-desc">
          Push instant lead alerts and consultation summaries straight into your executive or sales Slack channel.
        </div>
      </div>
      <button type="button" class="int-preset-btn" onclick="presetWebhook('Slack Alert Channel', 'https://hooks.slack.com/services/...')">
        <span>+ Connect Slack</span>
      </button>
    </div>

    <!-- Discord -->
    <div class="int-preset-card">
      <div>
        <div class="int-preset-top">
          <div class="int-preset-icon" style="background: rgba(88, 101, 242, 0.1); color: #5865f2;">
            D
          </div>
          <div>
            <div class="int-preset-name">Discord Channel Webhook</div>
            <div style="font-size: 0.72rem; color: #94a3b8;">Bot Alerts</div>
          </div>
        </div>
        <div class="int-preset-desc">
          Post formatted embeds for inbound proposals and discovery calls directly into your private Discord developer room.
        </div>
      </div>
      <button type="button" class="int-preset-btn" onclick="presetWebhook('Discord Inbound Channel', 'https://discord.com/api/webhooks/...')">
        <span>+ Connect Discord</span>
      </button>
    </div>

    <!-- Zapier / Make -->
    <div class="int-preset-card">
      <div>
        <div class="int-preset-top">
          <div class="int-preset-icon" style="background: rgba(255, 74, 0, 0.1); color: #ff4a00;">
            Z
          </div>
          <div>
            <div class="int-preset-name">Zapier & Make Automation</div>
            <div style="font-size: 0.72rem; color: #94a3b8;">HubSpot / Salesforce Sync</div>
          </div>
        </div>
        <div class="int-preset-desc">
          Trigger multi-step automations to sync client contact details directly into HubSpot, Salesforce, Notion, or Airtable.
        </div>
      </div>
      <button type="button" class="int-preset-btn" onclick="presetWebhook('Zapier Catch Hook', 'https://hooks.zapier.com/hooks/catch/...')">
        <span>+ Connect Zapier</span>
      </button>
    </div>

    <!-- Custom HTTP Endpoint -->
    <div class="int-preset-card">
      <div>
        <div class="int-preset-top">
          <div class="int-preset-icon" style="background: rgba(0, 86, 214, 0.1); color: var(--int-primary);">
            API
          </div>
          <div>
            <div class="int-preset-name">Custom REST Endpoint</div>
            <div style="font-size: 0.72rem; color: #94a3b8;">HMAC Secured</div>
          </div>
        </div>
        <div class="int-preset-desc">
          Post signed JSON payloads to your own internal microservice with SHA256 HMAC verification.
        </div>
      </div>
      <button type="button" class="int-preset-btn" onclick="openWebhookModal()">
        <span>+ Custom Endpoint</span>
      </button>
    </div>
  </div>

  <!-- Webhooks Table Panel -->
  <div class="int-panel">
    <div class="int-panel-header">
      <h2 class="int-panel-title">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--int-primary)" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
        Active Webhook Endpoints
      </h2>
      <span style="font-size: 0.8rem; color: #64748b; font-weight: 600;"><?= count($webhooks) ?> endpoints configured</span>
    </div>

    <div style="overflow-x: auto;">
      <table class="int-table">
        <thead>
          <tr>
            <th>Integration</th>
            <th>Target URL</th>
            <th>Event Trigger</th>
            <th>Status</th>
            <th>Last Ping / Response</th>
            <th style="text-align: right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($webhooks)): ?>
            <?php foreach ($webhooks as $w): ?>
              <tr id="webhook-row-<?= (int)$w['id'] ?>">
                <td>
                  <div style="font-weight: 700; color: #0f172a;"><?= htmlspecialchars($w['name']) ?></div>
                  <?php if (!empty($w['secret_token'])): ?>
                    <span style="font-size: 0.7rem; color: var(--int-primary); font-weight: 700;">• HMAC Secured</span>
                  <?php endif; ?>
                </td>
                <td>
                  <span class="int-code" title="<?= htmlspecialchars($w['target_url']) ?>">
                    <?= htmlspecialchars($w['target_url']) ?>
                  </span>
                </td>
                <td>
                  <span style="font-weight: 600; font-size: 0.82rem; background: #e2e8f0; color: #334155; padding: 2px 7px; border-radius: 4px;">
                    <?= htmlspecialchars($w['event_type']) ?>
                  </span>
                </td>
                <td>
                  <?php if ((int)$w['is_active'] === 1): ?>
                    <span class="int-badge int-badge-active">● Active</span>
                  <?php else: ?>
                    <span class="int-badge int-badge-inactive">○ Paused</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if (!empty($w['last_triggered_at'])): ?>
                    <div style="font-size: 0.78rem; color: #475569;">
                      <?= date('M d, H:i', strtotime($w['last_triggered_at'])) ?>
                    </div>
                    <?php 
                      $code = (int)($w['last_response_code'] ?? 0);
                      $codeColor = ($code >= 200 && $code < 300) ? 'var(--int-green)' : '#ef4444';
                    ?>
                    <span style="font-size: 0.72rem; font-weight: 800; color: <?= $codeColor ?>;">
                      HTTP <?= $code ?: 'ERR' ?>
                    </span>
                  <?php else: ?>
                    <span style="color: #94a3b8; font-size: 0.78rem;">Never triggered</span>
                  <?php endif; ?>
                </td>
                <td style="text-align: right;">
                  <div class="int-actions" style="justify-content: flex-end;">
                    <button type="button" class="int-action-btn btn-test" onclick="testPingWebhook(<?= (int)$w['id'] ?>, this)">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                      <span>Ping</span>
                    </button>
                    <button type="button" class="int-action-btn" onclick='editWebhook(<?= json_encode($w, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) ?>)'>
                      <span>Edit</span>
                    </button>
                    <button type="button" class="int-action-btn btn-del" onclick="deleteWebhook(<?= (int)$w['id'] ?>)">
                      <span>Delete</span>
                    </button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" style="text-align: center; padding: 48px; color: #94a3b8;">
                No webhooks configured yet. Connect Slack, Discord, or your custom endpoint above.
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<!-- Webhook Modal -->
<div class="int-modal-backdrop" id="webhookModal">
  <div class="int-modal">
    <div class="int-modal-header">
      <h3 class="int-modal-title" id="webhookModalTitle">Configure Webhook</h3>
      <button type="button" class="int-modal-close" onclick="closeWebhookModal()">&times;</button>
    </div>

    <form id="webhookForm" onsubmit="handleWebhookSubmit(event)">
      <input type="hidden" name="id" id="webhookId" value="" />

      <div class="int-modal-body">
        <div class="int-form-group">
          <label class="int-form-label">Integration Name *</label>
          <input type="text" name="name" id="webhookName" class="int-form-input" placeholder="e.g. Sales Team Slack Channel" required />
        </div>

        <div class="int-form-group">
          <label class="int-form-label">Destination URL *</label>
          <input type="url" name="target_url" id="webhookUrl" class="int-form-input" placeholder="https://hooks.slack.com/services/..." required />
        </div>

        <div class="int-form-group">
          <label class="int-form-label">Event Subscription *</label>
          <select name="event_type" id="webhookEvent" class="int-form-select">
            <option value="inquiry.created">inquiry.created (New consultation / discovery submission)</option>
            <option value="advisor.submitted">advisor.submitted (Solution Advisor architectural quiz completed)</option>
            <option value="*">* (All events)</option>
          </select>
        </div>

        <div class="int-form-group">
          <label class="int-form-label">HMAC Secret Token (Optional)</label>
          <input type="text" name="secret_token" id="webhookSecret" class="int-form-input" placeholder="Leave empty or enter a secret for SHA256 signature verification" />
        </div>

        <div class="int-form-group" style="flex-direction: row; align-items: center; gap: 8px;">
          <input type="checkbox" name="is_active" id="webhookActive" value="1" checked style="width: 16px; height: 16px;" />
          <label for="webhookActive" class="int-form-label" style="cursor: pointer; margin: 0;">Webhook Active & Dispatching</label>
        </div>
      </div>

      <div class="int-modal-footer">
        <button type="button" class="int-action-btn" onclick="closeWebhookModal()">Cancel</button>
        <button type="submit" class="int-btn-primary" id="webhookSaveBtn">Save Integration</button>
      </div>
    </form>
  </div>
</div>

<script>
function openWebhookModal() {
  document.getElementById('webhookModalTitle').textContent = 'Configure Webhook';
  document.getElementById('webhookId').value = '';
  document.getElementById('webhookName').value = '';
  document.getElementById('webhookUrl').value = '';
  document.getElementById('webhookEvent').value = 'inquiry.created';
  document.getElementById('webhookSecret').value = '';
  document.getElementById('webhookActive').checked = true;
  document.getElementById('webhookModal').style.display = 'flex';
}

function presetWebhook(name, url) {
  openWebhookModal();
  document.getElementById('webhookName').value = name;
  document.getElementById('webhookUrl').value = url;
  document.getElementById('webhookUrl').focus();
}

function editWebhook(data) {
  openWebhookModal();
  document.getElementById('webhookModalTitle').textContent = 'Edit Webhook Integration';
  document.getElementById('webhookId').value = data.id || '';
  document.getElementById('webhookName').value = data.name || '';
  document.getElementById('webhookUrl').value = data.target_url || '';
  document.getElementById('webhookEvent').value = data.event_type || 'inquiry.created';
  document.getElementById('webhookSecret').value = data.secret_token || '';
  document.getElementById('webhookActive').checked = (parseInt(data.is_active, 10) === 1);
}

function closeWebhookModal() {
  document.getElementById('webhookModal').style.display = 'none';
}

async function handleWebhookSubmit(e) {
  e.preventDefault();
  const form = document.getElementById('webhookForm');
  const btn = document.getElementById('webhookSaveBtn');
  btn.disabled = true;
  btn.textContent = 'Saving...';

  const formData = new FormData(form);
  const payload = {
    id: formData.get('id'),
    name: formData.get('name'),
    target_url: formData.get('target_url'),
    event_type: formData.get('event_type'),
    secret_token: formData.get('secret_token'),
    is_active: formData.get('is_active') ? 1 : 0
  };

  try {
    const res = await fetch('<?= BASE_URL ?>/admin/webhook/save', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify(payload)
    });
    const data = await res.json();

    if (data.success) {
      if (typeof window.showToast === 'function') {
        window.showToast(data.message || 'Webhook saved successfully.', 'success');
      }
      closeWebhookModal();
      setTimeout(() => location.reload(), 600);
    } else {
      if (typeof window.showToast === 'function') {
        window.showToast(data.error || 'Failed to save webhook.', 'error');
      }
    }
  } catch (err) {
    if (typeof window.showToast === 'function') {
      window.showToast('Network error while saving webhook.', 'error');
    }
  } finally {
    btn.disabled = false;
    btn.textContent = 'Save Integration';
  }
}

async function testPingWebhook(id, btn) {
  const origText = btn.innerHTML;
  btn.disabled = true;
  btn.innerHTML = '<span>Pinging...</span>';

  try {
    const res = await fetch('<?= BASE_URL ?>/admin/webhook/test', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({ id: id })
    });
    const data = await res.json();

    if (data.success) {
      if (typeof window.showToast === 'function') {
        window.showToast(`Ping Success: HTTP ${data.http_code} (${data.latency_ms}ms)`, 'success', 'Webhook Ping');
      }
      setTimeout(() => location.reload(), 1200);
    } else {
      if (typeof window.showToast === 'function') {
        window.showToast(data.error || `HTTP ${data.http_code || 'Error'}: Destination failed`, 'error', 'Ping Failed');
      }
    }
  } catch (err) {
    if (typeof window.showToast === 'function') {
      window.showToast('Network error while testing webhook.', 'error');
    }
  } finally {
    btn.disabled = false;
    btn.innerHTML = origText;
  }
}

async function deleteWebhook(id) {
  if (!confirm('Are you sure you want to remove this webhook endpoint? Event dispatches to this URL will cease.')) {
    return;
  }

  try {
    const res = await fetch('<?= BASE_URL ?>/admin/webhook/delete', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({ id: id })
    });
    const data = await res.json();

    if (data.success) {
      if (typeof window.showToast === 'function') {
        window.showToast(data.message || 'Webhook deleted.', 'success');
      }
      const row = document.getElementById('webhook-row-' + id);
      if (row) row.remove();
    } else {
      if (typeof window.showToast === 'function') {
        window.showToast(data.error || 'Failed to delete webhook.', 'error');
      }
    }
  } catch (err) {
    if (typeof window.showToast === 'function') {
      window.showToast('Network error while deleting webhook.', 'error');
    }
  }
}
</script>

<?php
include __DIR__ . '/layout/footer.php';
?>
