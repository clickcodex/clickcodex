<?php
declare(strict_types=1);

if (!defined('BASE_URL')) {
    define('BASE_URL', '');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>500 - Server Error | Click Codex</title>
  <meta name="robots" content="noindex, nofollow" />
  <meta name="theme-color" content="#0056d6" />
  <link rel="icon" type="image/png" href="<?= BASE_URL ?>/public/assets/images/logo.png" />
  
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Poppins:wght@600;700;800&family=Space+Mono:wght@700&display=swap" rel="stylesheet" />
  
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/style.css" />
  <style>
    .error-page-wrapper {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 60px 24px;
      position: relative;
      background: radial-gradient(circle at 50% 30%, rgba(239, 68, 68, 0.12) 0%, rgba(6, 9, 19, 0.98) 70%);
    }
    .error-code {
      font-family: 'Space Mono', monospace;
      font-size: clamp(5rem, 15vw, 10rem);
      font-weight: 900;
      line-height: 1;
      background: linear-gradient(135deg, #ef4444 0%, #f97316 50%, #facc15 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 12px;
      letter-spacing: -4px;
      text-shadow: 0 0 80px rgba(239, 68, 68, 0.4);
    }
    .error-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 6px 16px;
      border-radius: 9999px;
      background: rgba(239, 68, 68, 0.12);
      border: 1px solid rgba(239, 68, 68, 0.3);
      color: #f87171;
      font-size: 0.85rem;
      font-weight: 600;
      margin-bottom: 20px;
    }
    .error-title {
      font-family: 'Poppins', sans-serif;
      font-size: clamp(1.8rem, 4vw, 2.8rem);
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 16px;
    }
    .error-desc {
      font-size: 1.1rem;
      color: #94a3b8;
      max-width: 540px;
      margin: 0 auto 36px auto;
      line-height: 1.6;
    }
    .error-actions {
      display: flex;
      gap: 16px;
      justify-content: center;
      flex-wrap: wrap;
    }
  </style>
</head>
<body>
  <div class="error-page-wrapper">
    <div class="error-badge">
      <span>●</span> Error 500: Internal Processing Failure
    </div>
    <div class="error-code">500</div>
    <h1 class="error-title">Our System Encountered an Anomaly</h1>
    <p class="error-desc">
      We apologize for the inconvenience. Our engineering telemetry has logged this incident and our team is already reviewing it. Please try reloading or head back to the home page.
    </p>

    <div class="error-actions">
      <a href="<?= BASE_URL ?>/" class="btn-primary" style="padding: 14px 28px;">
        <span>Return to Safety</span>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
      </a>
      <a href="<?= BASE_URL ?>/contactus" class="btn-outline" style="padding: 14px 28px; border: 1px solid rgba(255,255,255,0.15); color: #fff; border-radius: 9999px; text-decoration: none; font-weight: 600;">
        Report Incident
      </a>
    </div>
  </div>
</body>
</html>
