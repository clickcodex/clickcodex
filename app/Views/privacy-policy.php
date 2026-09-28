<?php
/**
 * ClickCodex Technologies - Privacy Policy View
 */
declare(strict_types=1);

if (!defined('BASE_URL')) {
    define('BASE_URL', '');
}

require_once __DIR__ . '/layout/header.php';
?>

<main>
  <section class="legal-hero">
    <div class="container">
      <h1><?= htmlspecialchars($page['title'] ?? 'Privacy Policy') ?></h1>
      <p>Last Updated: <?= htmlspecialchars($settings['privacy_effective_date'] ?? 'September 2026') ?> • <?= htmlspecialchars($settings['site_name'] ?? 'ClickCodex Technologies') ?></p>
    </div>
  </section>

  <div class="legal-content">
    <div class="container">
      <h2>1. Commitment to Privacy</h2>
      <p><?= htmlspecialchars($settings['site_name'] ?? 'ClickCodex Technologies') ?> ("ClickCodex", "we", "us", or "our") respects your privacy and is dedicated to protecting the personal data of our website visitors, clients, and partners. This Privacy Policy outlines our practices regarding data collection, usage, and safeguarding in compliance with the Information Technology Act (India), the Digital Personal Data Protection Act (DPDP), and global privacy benchmarks including GDPR.</p>

      <h2>2. Information We Collect</h2>
      <p>When you interact with ClickCodex through our consultation forms, newsletter sign-ups, or direct correspondence, we may collect:</p>
      <ul>
        <li><strong>Personal & Contact Data:</strong> Full name, business email address, phone number, and WhatsApp contact.</li>
        <li><strong>Project Inquiries:</strong> Scope requirements, timelines, budget specifications, and technical preferences.</li>
        <li><strong>Technical Telemetry:</strong> Anonymized browser version, device category, IP address, and interaction analytics to improve website responsiveness.</li>
      </ul>

      <h2>3. How We Use Your Information</h2>
      <p>We process your information strictly for legitimate commercial and technical operations:</p>
      <ul>
        <li>To prepare project proposals, architecture estimates, and technical blueprints.</li>
        <li>To coordinate communications regarding scheduled strategy calls and development sprints.</li>
        <li>To send technical insights and architecture dispatch newsletters (only with explicit consent).</li>
        <li>We never sell, rent, or trade your personal or project data to third-party advertisers.</li>
      </ul>

      <h2>4. Data Security & Confidentiality</h2>
      <p>We implement enterprise-grade encryption (TLS 1.3 in transit and AES-256 at rest) across our servers and communication channels. Client project discussions are protected under standard non-disclosure agreements (NDAs).</p>

      <h2>5. Contact Us Regarding Privacy</h2>
      <p>If you have any questions or wish to exercise data access or deletion rights, please contact our Data Governance Officer at <strong><?= htmlspecialchars($settings['privacy_email'] ?? $settings['contact_email'] ?? 'privacy@clickcodex.com') ?></strong>.</p>
    </div>
  </div>
</main>

<?php require_once __DIR__ . '/layout/footer.php'; ?>
