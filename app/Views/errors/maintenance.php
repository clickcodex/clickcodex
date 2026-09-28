<?php
/**
 * ClickCodex Technologies - Scheduled Maintenance Mode View
 */
declare(strict_types=1);

if (!defined('BASE_URL')) {
    define('BASE_URL', '');
}

$siteName = 'Click Codex Technologies';
$contactEmail = 'contact@clickcodex.com';
$waNumber = '+919876543210';
$waMsg = urlencode("Hello ClickCodex, reaching out while site is in scheduled maintenance.");

try {
    $db = \App\Config\Database::connect();
    $res = $db->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key IN ('site_name', 'contact_email', 'whatsapp_number', 'whatsapp_default_message')");
    if ($res) {
        while ($r = $res->fetch_assoc()) {
            if ($r['setting_key'] === 'site_name' && !empty($r['setting_value'])) $siteName = $r['setting_value'];
            if ($r['setting_key'] === 'contact_email' && !empty($r['setting_value'])) $contactEmail = $r['setting_value'];
            if ($r['setting_key'] === 'whatsapp_number' && !empty($r['setting_value'])) $waNumber = $r['setting_value'];
        }
    }
} catch (\Throwable $t) {}

$waClean = preg_replace('/[^0-9]/', '', $waNumber);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Scheduled System Maintenance | <?= htmlspecialchars($siteName) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="icon" type="image/png" href="<?= BASE_URL ?>/public/assets/images/logo.png" />
  <style>
    :root {
      --bg: #090d16;
      --card-bg: rgba(15, 23, 42, 0.75);
      --border: rgba(255, 255, 255, 0.1);
      --primary: #0056d6;
      --cyan: #00a2ff;
      --emerald: #10b981;
      --text: #f8fafc;
      --text-muted: #94a3b8;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Plus Jakarta Sans', -apple-system, sans-serif;
      background: radial-gradient(circle at 50% 20%, #111e38 0%, #090d16 80%);
      color: var(--text);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
      position: relative;
      overflow-x: hidden;
    }
    .m-card {
      max-width: 620px;
      width: 100%;
      background: var(--card-bg);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid var(--border);
      border-radius: 28px;
      padding: 48px 40px;
      text-align: center;
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5), 0 0 80px rgba(0, 86, 214, 0.15);
      position: relative;
      z-index: 10;
    }
    .m-logo {
      height: 52px;
      width: auto;
      margin-bottom: 24px;
    }
    .m-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(0, 162, 255, 0.12);
      border: 1px solid rgba(0, 162, 255, 0.25);
      color: var(--cyan);
      padding: 6px 14px;
      border-radius: 9999px;
      font-size: 0.82rem;
      font-weight: 700;
      letter-spacing: 0.5px;
      margin-bottom: 20px;
      text-transform: uppercase;
    }
    .pulse-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: var(--cyan);
      box-shadow: 0 0 10px var(--cyan);
      animation: pulse 1.5s infinite;
    }
    @keyframes pulse {
      0%, 100% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.4; transform: scale(0.85); }
    }
    h1 {
      font-size: 2.2rem;
      font-weight: 800;
      letter-spacing: -0.5px;
      line-height: 1.25;
      margin-bottom: 16px;
      background: linear-gradient(135deg, #ffffff 0%, #cbd5e1 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    p {
      color: var(--text-muted);
      font-size: 1.02rem;
      line-height: 1.65;
      margin-bottom: 32px;
    }
    .btn-group {
      display: flex;
      gap: 14px;
      justify-content: center;
      flex-wrap: wrap;
      margin-bottom: 32px;
    }
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 24px;
      border-radius: 12px;
      font-size: 0.95rem;
      font-weight: 700;
      text-decoration: none;
      transition: all 0.2s ease;
    }
    .btn-whatsapp {
      background: #10b981;
      color: #ffffff;
      box-shadow: 0 8px 24px rgba(16, 185, 129, 0.3);
    }
    .btn-whatsapp:hover {
      background: #059669;
      transform: translateY(-2px);
    }
    .btn-email {
      background: rgba(255, 255, 255, 0.08);
      color: #ffffff;
      border: 1px solid var(--border);
    }
    .btn-email:hover {
      background: rgba(255, 255, 255, 0.14);
      transform: translateY(-2px);
    }
    .m-footer {
      font-size: 0.8rem;
      color: #64748b;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
      padding-top: 20px;
    }
    .m-footer a {
      color: var(--cyan);
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="m-card">
    <img src="<?= BASE_URL ?>/public/assets/images/logo.png" alt="ClickCodex" class="m-logo" />
    
    <div>
      <span class="m-badge">
        <span class="pulse-dot"></span>
        <span>Infrastructure Upgrade</span>
      </span>
    </div>

    <h1>Upgrading Systems For Faster Speed</h1>
    <p>
      <?= htmlspecialchars($siteName) ?> is temporarily undergoing scheduled maintenance to deploy performance enhancements. Our engineering team is currently available directly via WhatsApp and email.
    </p>

    <div class="btn-group">
      <a href="https://wa.me/<?= $waClean ?>?text=<?= $waMsg ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.698.077-1.118-.057-.26-.084-.589-.201-.989-.374-1.745-.758-2.887-2.531-2.975-2.648-.088-.116-.71-0.947-.71-1.807 0-.859.45-1.282.61-1.458.16-.176.35-.22.47-.22.12 0 .24.002.34.007.11.005.26-.042.41.319.15.362.51 1.242.55 1.33.04.088.07.191.01.308-.06.117-.09.19-.18.293-.09.103-.19.23-.27.309-.09.088-.19.183-.08.371.11.188.48.793 1.03 1.283.71.633 1.31.829 1.49.919.18.09.29.076.4-.047.11-.123.47-.549.6-.738.13-.189.26-.158.44-.092.18.066 1.14.537 1.34.636.2.099.33.147.38.232.05.085.05.495-.09.9z"/></svg>
        <span>Instant WhatsApp Chat</span>
      </a>
      <a href="mailto:<?= htmlspecialchars($contactEmail) ?>" class="btn btn-email">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
        <span>Email Us</span>
      </a>
    </div>

    <div class="m-footer">
      <span>Authorized administrators can log in via <a href="<?= BASE_URL ?>/admin/login">Studio Admin Console &rarr;</a></span>
    </div>
  </div>
</body>
</html>
