<?php
/**
 * ClickCodex Technologies - Terms of Service View
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
      <h1><?= htmlspecialchars($page['title'] ?? 'Terms of Service') ?></h1>
      <p>Effective Date: <?= htmlspecialchars($settings['terms_effective_date'] ?? 'September 2026') ?> • <?= htmlspecialchars($settings['site_name'] ?? 'ClickCodex Technologies') ?></p>
    </div>
  </section>

  <div class="legal-content">
    <div class="container">
      <h2>1. Scope & Acceptance</h2>
      <p>By accessing the ClickCodex website or engaging <?= htmlspecialchars($settings['site_name'] ?? 'ClickCodex Technologies') ?> for software engineering, design, or consulting services, you agree to comply with and be bound by these Terms of Service.</p>

      <h2>2. Intellectual Property & Ownership</h2>
      <p>ClickCodex operates on a strict "Client Owns All" model for custom client deliverables:</p>
      <ul>
        <li><strong>Assignment:</strong> Upon final milestone settlement, 100% of the intellectual property, source code, database architectures, and graphical design assets created for your engagement become your exclusive property.</li>
        <li><strong>Pre-Existing Tools:</strong> General-purpose open-source libraries or ClickCodex reusable boilerplate modules are provided under standard permissive licenses (MIT or Apache 2.0).</li>
      </ul>

      <h2>3. Sprints & Milestone Delivery</h2>
      <p>Projects are delivered in structured agile sprints with clear acceptance criteria. Each sprint includes staging server demonstrations, automated test coverage reports, and a formal review period prior to milestone sign-off.</p>

      <h2>4. Post-Launch Warranty & SLAs</h2>
      <p>Every fixed-scope engagement includes a complimentary 30-day post-launch warranty covering software defect resolution and cross-browser performance anomalies. Extended support SLAs are governed by mutual service contracts.</p>

      <h2>5. Governing Law</h2>
      <p>These terms shall be governed by and construed in accordance with the laws of India, with legal jurisdiction in the courts of Bangalore / Mumbai.</p>

      <h2>6. Inquiries & Legal Notices</h2>
      <p>Formal legal notices and inquiries regarding these terms may be directed to <strong><?= htmlspecialchars($settings['contact_email'] ?? 'hello@clickcodex.com') ?></strong>.</p>
    </div>
  </div>
</main>

<?php require_once __DIR__ . '/layout/footer.php'; ?>
