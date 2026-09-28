<?php
/**
 * ClickCodex Technologies - RESTful API Access & Secret Key Generator
 * Enterprise developer tokens, scoped access control, and endpoint reference documentation.
 */
declare(strict_types=1);

if (!defined('BASE_URL')) {
    define('BASE_URL', '');
}

$pageTitle = $pageTitle ?? 'API Access & Secret Key Generator | ClickCodex Studio Console';
$topbarTitle = 'REST API Access & Keys';
$activeNav = 'api_access';

include __DIR__ . '/layout/header.php';
$apiKeys = $apiKeys ?? [];
?>

<style>
:root {
  --api-primary: #0056d6;
  --api-accent: #00a2ff;
  --api-green: #10b981;
  --api-purple: #8b5cf6;
  --api-border: #e2e8f0;
}

.api-container {
  max-width: 1440px;
  margin: 0 auto;
  padding: 32px;
  width: 100%;
  box-sizing: border-box;
}

.api-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 16px;
  margin-bottom: 28px;
}

.api-title-block h1 {
  font-size: 1.6rem;
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 6px 0;
  display: flex;
  align-items: center;
  gap: 10px;
}

.api-title-block p {
  color: #64748b;
  margin: 0;
  font-size: 0.9rem;
}

.api-btn-primary {
  background: linear-gradient(135deg, var(--api-primary), var(--api-accent));
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

.api-btn-primary:hover {
  transform: translateY(-1px);
  box-shadow: 0 5px 15px rgba(0, 86, 214, 0.35);
}

/* Panel */
.api-panel {
  background: #ffffff;
  border: 1px solid var(--api-border);
  border-radius: 14px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.02);
  overflow: hidden;
  margin-bottom: 32px;
}

.api-panel-header {
  padding: 20px 24px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #f1f5f9;
}

.api-panel-title {
  font-size: 1.1rem;
  font-weight: 700;
  color: #0f172a;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 8px;
}

.api-table {
  width: 100%;
  border-collapse: collapse;
}

.api-table th {
  background: #f8fafc;
  padding: 12px 20px;
  text-align: left;
  font-size: 0.8rem;
  font-weight: 700;
  color: #475569;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  border-bottom: 1px solid var(--api-border);
}

.api-table td {
  padding: 16px 20px;
  font-size: 0.88rem;
  color: #1e293b;
  border-bottom: 1px solid #f1f5f9;
  vertical-align: middle;
}

.api-table tr:hover td {
  background: #fbfcfe;
}

.api-key-code {
  font-family: 'Space Mono', monospace;
  font-size: 0.82rem;
  background: #f1f5f9;
  padding: 4px 8px;
  border-radius: 6px;
  color: #0f172a;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.api-copy-btn {
  background: transparent;
  border: none;
  cursor: pointer;
  color: #64748b;
  padding: 2px;
  display: flex;
}

.api-copy-btn:hover {
  color: var(--api-primary);
}

.api-scope-badge {
  font-size: 0.72rem;
  font-weight: 700;
  background: rgba(0, 86, 214, 0.08);
  color: var(--api-primary);
  padding: 2px 7px;
  border-radius: 4px;
  display: inline-block;
  margin: 2px;
}

.api-btn-action {
  padding: 5px 10px;
  border-radius: 6px;
  font-size: 0.76rem;
  font-weight: 700;
  border: 1px solid var(--api-border);
  background: #ffffff;
  color: #334155;
  cursor: pointer;
  transition: all 0.15s;
}

.api-btn-action:hover {
  background: #f1f5f9;
  color: var(--api-primary);
}

.api-btn-action.btn-revoke:hover {
  background: rgba(239, 68, 68, 0.08);
  color: #ef4444;
  border-color: #ef4444;
}

/* Docs Section */
.api-docs-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 24px;
}

@media (max-width: 1024px) {
  .api-docs-grid {
    grid-template-columns: 1fr;
  }
}

.api-code-block {
  background: #0f172a;
  color: #e2e8f0;
  border-radius: 12px;
  padding: 20px;
  font-family: 'Space Mono', monospace;
  font-size: 0.8rem;
  line-height: 1.6;
  overflow-x: auto;
  position: relative;
}

.api-tabs {
  display: flex;
  gap: 8px;
  margin-bottom: 12px;
}

.api-tab-btn {
  padding: 6px 14px;
  font-size: 0.8rem;
  font-weight: 700;
  color: #64748b;
  background: #f1f5f9;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.15s;
}

.api-tab-btn.active {
  background: var(--api-primary);
  color: #ffffff;
}

/* Modals */
.api-modal-backdrop {
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

.api-modal {
  background: #ffffff;
  width: 100%;
  max-width: 540px;
  border-radius: 16px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.2);
  overflow: hidden;
  animation: modalSlideUp 0.25s ease-out;
}

.api-modal-header {
  padding: 20px 24px;
  background: #f8fafc;
  border-bottom: 1px solid var(--api-border);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.api-modal-title {
  font-size: 1.15rem;
  font-weight: 800;
  color: #0f172a;
  margin: 0;
}

.api-modal-close {
  background: transparent;
  border: none;
  font-size: 1.3rem;
  cursor: pointer;
  color: #64748b;
}

.api-modal-body {
  padding: 24px;
  display: flex;
  flex-direction: column;
  gap: 18px;
}

.api-modal-footer {
  padding: 16px 24px;
  background: #f8fafc;
  border-top: 1px solid var(--api-border);
  display: flex;
  justify-content: flex-end;
  gap: 12px;
}
</style>

<div class="api-container">

  <!-- Header -->
  <div class="api-header">
    <div class="api-title-block">
      <h1>
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="var(--api-primary)" stroke-width="2.5"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
        RESTful API Access & Secret Key Generator
      </h1>
      <p>Issue scoped API keys to authenticate headless frontends, mobile clients, and CRM ingest pipelines.</p>
    </div>

    <button type="button" class="api-btn-primary" onclick="openKeyModal()">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
      <span>Generate API Key</span>
    </button>
  </div>

  <!-- API Keys Table Panel -->
  <div class="api-panel">
    <div class="api-panel-header">
      <h2 class="api-panel-title">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--api-primary)" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
        Active Application Keys
      </h2>
      <span style="font-size: 0.8rem; color: #64748b; font-weight: 600;"><?= count($apiKeys) ?> keys provisioned</span>
    </div>

    <div style="overflow-x: auto;">
      <table class="api-table">
        <thead>
          <tr>
            <th>Application / Key Name</th>
            <th>API Key</th>
            <th>Permission Scopes</th>
            <th>Status</th>
            <th>Last Used</th>
            <th style="text-align: right;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($apiKeys)): ?>
            <?php foreach ($apiKeys as $k): ?>
              <tr id="key-row-<?= (int)$k['id'] ?>">
                <td>
                  <div style="font-weight: 700; color: #0f172a;"><?= htmlspecialchars($k['key_name']) ?></div>
                  <div style="font-size: 0.72rem; color: #94a3b8;">Created <?= date('M d, Y', strtotime($k['created_at'])) ?></div>
                </td>
                <td>
                  <div class="api-key-code">
                    <span><?= htmlspecialchars(substr($k['api_key'], 0, 10)) ?>••••••••••••</span>
                    <button type="button" class="api-copy-btn" onclick="copyText('<?= htmlspecialchars($k['api_key']) ?>', this)" title="Copy API Key">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                    </button>
                  </div>
                </td>
                <td>
                  <?php 
                    $scopes = explode(',', (string)$k['scopes']);
                    foreach ($scopes as $s):
                  ?>
                    <span class="api-scope-badge"><?= htmlspecialchars(trim($s)) ?></span>
                  <?php endforeach; ?>
                </td>
                <td>
                  <?php if ((int)$k['is_active'] === 1): ?>
                    <span style="font-size: 0.75rem; font-weight: 700; color: var(--api-green);">● Active</span>
                  <?php else: ?>
                    <span style="font-size: 0.75rem; font-weight: 700; color: #64748b;">○ Revoked / Inactive</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if (!empty($k['last_used_at'])): ?>
                    <span style="font-size: 0.8rem; color: #475569;"><?= date('M d, H:i', strtotime($k['last_used_at'])) ?></span>
                  <?php else: ?>
                    <span style="font-size: 0.78rem; color: #94a3b8;">Never</span>
                  <?php endif; ?>
                </td>
                <td style="text-align: right;">
                  <div style="display: flex; gap: 6px; justify-content: flex-end;">
                    <button type="button" class="api-btn-action" onclick="toggleApiKey(<?= (int)$k['id'] ?>)">
                      <?= (int)$k['is_active'] === 1 ? 'Disable' : 'Enable' ?>
                    </button>
                    <button type="button" class="api-btn-action btn-revoke" onclick="revokeApiKey(<?= (int)$k['id'] ?>)">
                      Revoke
                    </button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" style="text-align: center; padding: 48px; color: #94a3b8;">
                No API keys generated yet. Click "Generate API Key" to provision your first token.
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- REST API Documentation & Code Examples -->
  <div class="api-docs-grid">
    <!-- Available Endpoints -->
    <div class="api-panel" style="margin-bottom: 0;">
      <div class="api-panel-header">
        <h2 class="api-panel-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--api-primary)" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
          API v1 Endpoints
        </h2>
        <span style="font-size: 0.75rem; font-weight: 700; color: var(--api-green); background: rgba(16, 185, 129, 0.1); padding: 3px 8px; border-radius: 6px;">v1.0 Live</span>
      </div>

      <div style="padding: 20px; display: flex; flex-direction: column; gap: 16px;">
        <div style="border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
          <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
            <span style="background: #e0f2fe; color: #0284c7; font-weight: 800; font-size: 0.72rem; padding: 2px 6px; border-radius: 4px;">GET</span>
            <span style="font-family: 'Space Mono', monospace; font-size: 0.85rem; font-weight: 700;">/api/v1/status</span>
          </div>
          <div style="font-size: 0.82rem; color: #64748b;">System health, server status, and timestamp. Public.</div>
        </div>

        <div style="border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
          <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
            <span style="background: #e0f2fe; color: #0284c7; font-weight: 800; font-size: 0.72rem; padding: 2px 6px; border-radius: 4px;">GET</span>
            <span style="font-family: 'Space Mono', monospace; font-size: 0.85rem; font-weight: 700;">/api/v1/services</span>
          </div>
          <div style="font-size: 0.82rem; color: #64748b;">Active technical capabilities & service catalog. Scope: <code>services:read</code>.</div>
        </div>

        <div style="border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
          <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
            <span style="background: #e0f2fe; color: #0284c7; font-weight: 800; font-size: 0.72rem; padding: 2px 6px; border-radius: 4px;">GET</span>
            <span style="font-family: 'Space Mono', monospace; font-size: 0.85rem; font-weight: 700;">/api/v1/articles</span>
          </div>
          <div style="font-size: 0.82rem; color: #64748b;">Published technical blogs and architecture guides. Scope: <code>articles:read</code>.</div>
        </div>

        <div>
          <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
            <span style="background: #dcfce7; color: #16a34a; font-weight: 800; font-size: 0.72rem; padding: 2px 6px; border-radius: 4px;">POST</span>
            <span style="font-family: 'Space Mono', monospace; font-size: 0.85rem; font-weight: 700;">/api/v1/inquiries</span>
          </div>
          <div style="font-size: 0.82rem; color: #64748b;">Create inbound proposal requests with JSON body. Scope: <code>inquiries:write</code>.</div>
        </div>
      </div>
    </div>

    <!-- Code Integration Examples -->
    <div class="api-panel" style="margin-bottom: 0;">
      <div class="api-panel-header">
        <h2 class="api-panel-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--api-primary)" stroke-width="2"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
          Implementation Quickstart
        </h2>
        <div class="api-tabs">
          <button type="button" class="api-tab-btn active" onclick="switchTab('curl', this)">cURL</button>
          <button type="button" class="api-tab-btn" onclick="switchTab('js', this)">JavaScript</button>
          <button type="button" class="api-tab-btn" onclick="switchTab('python', this)">Python</button>
        </div>
      </div>

      <div style="padding: 20px;">
        <div id="code-curl" class="api-code-block">
# Ingest inquiry via cURL
curl -X POST "<?= BASE_URL ?>/api/v1/inquiries" \
  -H "X-API-Key: cck_live_YOUR_KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "full_name": "Jane Doe",
    "email": "jane@enterprise.com",
    "phone": "+14155552671",
    "company_name": "Acme Global",
    "interested_service": "Cloud Architecture",
    "budget_bracket": "$25k - $50k",
    "message": "Interested in infrastructure migration."
  }'
        </div>

        <div id="code-js" class="api-code-block" style="display: none;">
// Ingest inquiry via JavaScript Fetch
const response = await fetch('<?= BASE_URL ?>/api/v1/inquiries', {
  method: 'POST',
  headers: {
    'X-API-Key': 'cck_live_YOUR_KEY',
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    full_name: 'Jane Doe',
    email: 'jane@enterprise.com',
    phone: '+14155552671',
    company_name: 'Acme Global',
    interested_service: 'Cloud Architecture',
    budget_bracket: '$25k - $50k',
    message: 'Interested in infrastructure migration.'
  })
});

const data = await response.json();
console.log(data);
        </div>

        <div id="code-python" class="api-code-block" style="display: none;">
# Ingest inquiry via Python Requests
import requests

url = "<?= BASE_URL ?>/api/v1/inquiries"
headers = {
    "X-API-Key": "cck_live_YOUR_KEY",
    "Content-Type": "application/json"
}
payload = {
    "full_name": "Jane Doe",
    "email": "jane@enterprise.com",
    "phone": "+14155552671",
    "company_name": "Acme Global",
    "interested_service": "Cloud Architecture",
    "budget_bracket": "$25k - $50k",
    "message": "Interested in infrastructure migration."
}

res = requests.post(url, json=payload, headers=headers)
print(res.json())
        </div>
      </div>
    </div>
  </div>

</div>

<!-- Create API Key Modal -->
<div class="api-modal-backdrop" id="createKeyModal">
  <div class="api-modal">
    <div class="api-modal-header">
      <h3 class="api-modal-title">Generate New API Key</h3>
      <button type="button" class="api-modal-close" onclick="closeKeyModal()">&times;</button>
    </div>

    <form id="keyForm" onsubmit="handleCreateKeySubmit(event)">
      <div class="api-modal-body">
        <div style="display: flex; flex-direction: column; gap: 6px;">
          <label style="font-size: 0.82rem; font-weight: 700; color: #334155;">Application / Client Name *</label>
          <input type="text" name="name" id="keyNameInput" class="int-form-input" style="padding: 10px 14px; border: 1px solid var(--api-border); border-radius: 8px;" placeholder="e.g. Mobile iOS Client or HubSpot Sync" required />
        </div>

        <div style="display: flex; flex-direction: column; gap: 10px;">
          <label style="font-size: 0.82rem; font-weight: 700; color: #334155;">Permission Scopes</label>
          <label style="display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #1e293b; cursor: pointer;">
            <input type="checkbox" name="scopes[]" value="services:read" checked />
            <span><code>services:read</code> - Read published services catalog</span>
          </label>
          <label style="display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #1e293b; cursor: pointer;">
            <input type="checkbox" name="scopes[]" value="articles:read" checked />
            <span><code>articles:read</code> - Read published articles & blogs</span>
          </label>
          <label style="display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #1e293b; cursor: pointer;">
            <input type="checkbox" name="scopes[]" value="inquiries:write" checked />
            <span><code>inquiries:write</code> - Submit new client inquiries</span>
          </label>
          <label style="display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #1e293b; cursor: pointer;">
            <input type="checkbox" name="scopes[]" value="inquiries:read" />
            <span><code>inquiries:read</code> - Read inbound client leads</span>
          </label>
          <label style="display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #1e293b; cursor: pointer;">
            <input type="checkbox" name="scopes[]" value="*" />
            <span><code>*</code> - Full administrative privileges</span>
          </label>
        </div>
      </div>

      <div class="api-modal-footer">
        <button type="button" class="api-btn-action" onclick="closeKeyModal()">Cancel</button>
        <button type="submit" class="api-btn-primary" id="createKeyBtn">Generate Credentials</button>
      </div>
    </form>
  </div>
</div>

<!-- Key Generated Success Modal -->
<div class="api-modal-backdrop" id="keySuccessModal">
  <div class="api-modal">
    <div class="api-modal-header" style="background: rgba(16, 185, 129, 0.08);">
      <h3 class="api-modal-title" style="color: var(--api-green); display: flex; align-items: center; gap: 8px;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        API Key Generated
      </h3>
      <button type="button" class="api-modal-close" onclick="closeSuccessModal()">&times;</button>
    </div>

    <div class="api-modal-body">
      <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px; font-size: 0.84rem; color: #475569;">
        Please copy your API Key and Secret Token now. For security purposes, the secret key cannot be recovered once this window is closed.
      </div>

      <div style="display: flex; flex-direction: column; gap: 6px;">
        <label style="font-size: 0.8rem; font-weight: 700; color: #334155;">API Key (Public Identifier)</label>
        <div class="api-key-code" style="width: 100%; justify-content: space-between; box-sizing: border-box;">
          <span id="genApiKey" style="font-weight: 700;"></span>
          <button type="button" class="api-copy-btn" onclick="copyText(document.getElementById('genApiKey').textContent, this)">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
          </button>
        </div>
      </div>

      <div style="display: flex; flex-direction: column; gap: 6px;">
        <label style="font-size: 0.8rem; font-weight: 700; color: #334155;">API Secret Token</label>
        <div class="api-key-code" style="width: 100%; justify-content: space-between; box-sizing: border-box;">
          <span id="genApiSecret" style="font-weight: 700; color: var(--api-green);"></span>
          <button type="button" class="api-copy-btn" onclick="copyText(document.getElementById('genApiSecret').textContent, this)">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
          </button>
        </div>
      </div>
    </div>

    <div class="api-modal-footer">
      <button type="button" class="api-btn-primary" onclick="closeSuccessModal()">I Have Saved My Secret</button>
    </div>
  </div>
</div>

<script>
function openKeyModal() {
  document.getElementById('keyNameInput').value = '';
  document.getElementById('createKeyModal').style.display = 'flex';
}

function closeKeyModal() {
  document.getElementById('createKeyModal').style.display = 'none';
}

function closeSuccessModal() {
  document.getElementById('keySuccessModal').style.display = 'none';
  location.reload();
}

function switchTab(lang, btn) {
  document.querySelectorAll('.api-tab-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('code-curl').style.display = lang === 'curl' ? 'block' : 'none';
  document.getElementById('code-js').style.display = lang === 'js' ? 'block' : 'none';
  document.getElementById('code-python').style.display = lang === 'python' ? 'block' : 'none';
}

function copyText(txt, btn) {
  navigator.clipboard.writeText(txt).then(() => {
    if (typeof window.showToast === 'function') {
      window.showToast('Copied to clipboard!', 'success');
    }
  });
}

async function handleCreateKeySubmit(e) {
  e.preventDefault();
  const form = document.getElementById('keyForm');
  const btn = document.getElementById('createKeyBtn');
  btn.disabled = true;
  btn.textContent = 'Generating...';

  const formData = new FormData(form);
  const scopes = formData.getAll('scopes[]');

  try {
    const res = await fetch('<?= BASE_URL ?>/admin/api-key/create', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        name: formData.get('name'),
        scopes: scopes
      })
    });
    const data = await res.json();

    if (data.success) {
      closeKeyModal();
      document.getElementById('genApiKey').textContent = data.api_key;
      document.getElementById('genApiSecret').textContent = data.api_secret;
      document.getElementById('keySuccessModal').style.display = 'flex';
    } else {
      if (typeof window.showToast === 'function') {
        window.showToast(data.error || 'Failed to generate key.', 'error');
      }
    }
  } catch (err) {
    if (typeof window.showToast === 'function') {
      window.showToast('Network error while generating API key.', 'error');
    }
  } finally {
    btn.disabled = false;
    btn.textContent = 'Generate Credentials';
  }
}

async function toggleApiKey(id) {
  try {
    const res = await fetch('<?= BASE_URL ?>/admin/api-key/toggle', {
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
        window.showToast(data.message || 'Status updated.', 'success');
      }
      setTimeout(() => location.reload(), 500);
    }
  } catch (err) {
    console.error(err);
  }
}

async function revokeApiKey(id) {
  if (!confirm('Are you sure you want to permanently revoke this API key? Applications using it will immediately be rejected.')) {
    return;
  }

  try {
    const res = await fetch('<?= BASE_URL ?>/admin/api-key/revoke', {
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
        window.showToast('API key revoked.', 'success');
      }
      const row = document.getElementById('key-row-' + id);
      if (row) row.remove();
    }
  } catch (err) {
    console.error(err);
  }
}
</script>

<?php
include __DIR__ . '/layout/footer.php';
?>
