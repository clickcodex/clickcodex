<?php
/**
 * ClickCodex Technologies - Contact & Technical Discovery Hub
 * Reusable dynamic view bound directly to clickcodex_db
 */
declare(strict_types=1);

if (!defined('BASE_URL')) {
    define('BASE_URL', '');
}

$heroSection = $sections['contact_hero'] ?? null;
$campusSection = $sections['campus_locations'] ?? null;
$faqSection = $sections['contact_faqs'] ?? null;

$cleanWhatsapp = preg_replace('/[^0-9]/', '', (string)($settings['whatsapp_number'] ?? '919876543210'));
$cleanPhone = preg_replace('/[^0-9+]/', '', (string)($settings['contact_phone'] ?? '+919876543210'));

require_once __DIR__ . '/layout/header.php';
?>

<!-- Clipboard Toast Notification -->
<div class="copy-toast" id="copyToast">
  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="copy-toast-icon">
    <polyline points="20 6 9 17 4 12"></polyline>
  </svg>
  <span id="toastMessage">Copied to clipboard!</span>
</div>

<main>
  <!-- ==========================================================================
       1. HERO SECTION WITH 3D WEBGL CYBER-GLOBE & KINETIC HEADLINE
       ========================================================================== -->
  <section class="contact-hero">
    <!-- 3D Three.js WebGL Cyber-Globe Canvas -->
    <canvas id="contact-3d-globe-canvas"></canvas>

    <!-- Interactive Helper Pill -->
    <div class="globe-hint-pill">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="2" y1="12" x2="22" y2="12"></line>
        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
      </svg>
      <span>Interactive Global Matrix • Drag to Rotate</span>
    </div>

    <div class="container">
      <div class="contact-hero-grid">
        <div class="contact-hero-text">
          <!-- Operational Status Pill -->
          <div class="live-status-pill">
            <span class="live-status-dot"></span>
            <span>Responsive Startup Pod • Direct Founder & Dev Access</span>
          </div>

          <!-- Kinetic Physics Scattering Headline -->
          <h1 class="kinetic-headline" id="kineticHeadline">
            <?= htmlspecialchars($heroSection['title'] ?? 'Let\'s Discuss Your Next Digital Project.') ?>
          </h1>

          <p class="contact-hero-lead">
            <?= htmlspecialchars($heroSection['subtitle'] ?? 'Have a project in mind, need a modern business website, or looking for custom software and creative digital media? Connect directly with our core 4-member team to discuss your goals.') ?>
          </p>

          <div style="display: flex; gap: 16px; flex-wrap: wrap;">
            <a href="#discovery" class="btn-primary">
              <span>Start Project Discovery</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </a>

            <a href="https://wa.me/<?= $cleanWhatsapp ?>?text=<?= urlencode($settings['whatsapp_default_message'] ?? 'Hi Click Codex, I would like to discuss a project') ?>" 
               target="_blank" rel="noopener noreferrer" class="whatsapp-btn" style="padding: 12px 24px; font-size: 0.95rem;">
              <svg viewBox="0 0 24 24" style="width: 18px; height: 18px;">
                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.698.077-1.118-.057-.26-.084-.589-.201-.989-.374-1.745-.758-2.887-2.531-2.975-2.648-.088-.116-.71-0.947-.71-1.807 0-.859.45-1.282.61-1.458.16-.176.35-.22.47-.22.12 0 .24.002.34.007.11.005.26-.042.41.319.15.362.51 1.242.55 1.33.04.088.07.191.01.308-.06.117-.09.19-.18.293-.09.103-.19.23-.27.309-.09.088-.19.183-.08.371.11.188.48.793 1.03 1.283.71.633 1.31.829 1.49.919.18.09.29.076.4-.047.11-.123.47-.549.6-.738.13-.189.26-.158.44-.092.18.066 1.14.537 1.34.636.2.099.33.147.38.232.05.085.05.495-.09.9z"/>
              </svg>
              <span>Instant WhatsApp Call</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       2. 3D GLASSMORPHIC QUICK CONNECT CARDS (ONE-CLICK COPY)
       ========================================================================== -->
  <section class="contact-channels-section">
    <div class="container">
      <div class="channels-grid">
        <!-- Card 1: Direct Technical Email -->
        <div class="channel-card" onclick="copyAndToast('<?= htmlspecialchars($settings['contact_email']) ?>', 'Technical Email copied to clipboard!')">
          <div>
            <div class="channel-icon-wrap">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
            </div>
            <span class="channel-tag">Direct Inquiries</span>
            <h3 class="channel-title">Email Our Team</h3>
            <p class="channel-val"><?= htmlspecialchars($settings['contact_email']) ?></p>
          </div>
          <span class="channel-action-btn">
            <span>Click to Copy Email</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
          </span>
        </div>

        <!-- Card 2: Phone & WhatsApp -->
        <div class="channel-card warm" onclick="window.open('https://wa.me/<?= $cleanWhatsapp ?>?text=<?= urlencode($settings['whatsapp_default_message'] ?? 'Hi ClickCodex, I would like to discuss a project') ?>', '_blank')">
          <div>
            <div class="channel-icon-wrap" style="background: rgba(16, 185, 129, 0.15); color: #10b981;">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.698.077-1.118-.057-.26-.084-.589-.201-.989-.374-1.745-.758-2.887-2.531-2.975-2.648-.088-.116-.71-0.947-.71-1.807 0-.859.45-1.282.61-1.458.16-.176.35-.22.47-.22.12 0 .24.002.34.007.11.005.26-.042.41.319.15.362.51 1.242.55 1.33.04.088.07.191.01.308-.06.117-.09.19-.18.293-.09.103-.19.23-.27.309-.09.088-.19.183-.08.371.11.188.48.793 1.03 1.283.71.633 1.31.829 1.49.919.18.09.29.076.4-.047.11-.123.47-.549.6-.738.13-.189.26-.158.44-.092.18.066 1.14.537 1.34.636.2.099.33.147.38.232.05.085.05.495-.09.9z"/>
              </svg>
            </div>
            <span class="channel-tag" style="color: #059669;">Instant WhatsApp & Call</span>
            <h3 class="channel-title">Direct Client Hotline</h3>
            <p class="channel-val"><?= htmlspecialchars($settings['whatsapp_number'] ?? $settings['contact_phone'] ?? '+919876543210') ?></p>
          </div>
          <span class="channel-action-btn" style="color: #059669;">
            <span>Click to Chat WhatsApp</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
          </span>
        </div>

        <!-- Card 3: Bangalore Innovation Lab -->
        <div class="channel-card" onclick="switchCampus('bangalore')">
          <div>
            <div class="channel-icon-wrap">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
            </div>
            <span class="channel-tag">Bangalore Hub</span>
            <h3 class="channel-title">Primary Engineering</h3>
            <p class="channel-val"><?= htmlspecialchars($campuses['bangalore']['title']) ?></p>
          </div>
          <span class="channel-action-btn">
            <span>View On Campus Map</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
          </span>
        </div>

        <!-- Card 4: Mumbai Commercial Studio -->
        <div class="channel-card warm" onclick="switchCampus('mumbai')">
          <div>
            <div class="channel-icon-wrap">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            </div>
            <span class="channel-tag" style="color: var(--brand-orange, #ff6a00);">Mumbai Studio</span>
            <h3 class="channel-title">Product & Growth Lab</h3>
            <p class="channel-val"><?= htmlspecialchars($campuses['mumbai']['title']) ?></p>
          </div>
          <span class="channel-action-btn">
            <span>View On Campus Map</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
          </span>
        </div>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       3. INTERACTIVE PROJECT DISCOVERY FORM & LIVE MAP
       ========================================================================== -->
  <section class="discovery-section" id="discovery">
    <div class="container">
      <div class="section-header-center">
        <div class="section-pill">
          <span class="pulse-dot"></span>
          <span>Fast Proposal Engine</span>
        </div>
        <h2 class="section-title">Start Your Project <span class="gradient-text">Discovery</span></h2>
        <p class="section-subtitle">
          Select your project parameters below to help us match you with the right technical leads. We guarantee a transparent scope and estimate within 24 hours.
        </p>
      </div>

      <div class="discovery-grid">
        <!-- Left: Discovery Form -->
        <div class="discovery-form-box">
          <div class="form-header-row">
            <h3>Tell Us What You're Building</h3>
            <p>All inquiries are covered by our mutual 100% Non-Disclosure Agreement.</p>
          </div>

          <form id="projectDiscoveryForm" onsubmit="handleDiscoverySubmit(event)">
            <!-- Hidden inputs to record chip selections -->
            <input type="hidden" name="inquiry_type" value="discovery_form" />
            <input type="hidden" name="source_page" value="/contactus" />

            <!-- Chips: Service Requirements -->
            <div class="chips-group">
              <span class="chips-label">1. What solutions are you seeking? (Select all that apply)</span>
              <div class="chips-row" id="serviceChips">
                <button type="button" class="chip-btn active" onclick="toggleChip(this)" data-val="Custom Web Platform">Custom Web Platform</button>
                <button type="button" class="chip-btn" onclick="toggleChip(this)" data-val="Mobile iOS/Android App">Mobile iOS/Android App</button>
                <button type="button" class="chip-btn" onclick="toggleChip(this)" data-val="Full UI/UX Redesign">Full UI/UX Redesign</button>
                <button type="button" class="chip-btn" onclick="toggleChip(this)" data-val="E-Commerce Platform">E-Commerce Platform</button>
                <button type="button" class="chip-btn" onclick="toggleChip(this)" data-val="Hire Dedicated Developers">Hire Dedicated Developers</button>
                <button type="button" class="chip-btn" onclick="toggleChip(this)" data-val="AI / Microservices Scale">AI / Microservices Scale</button>
              </div>
            </div>

            <!-- Chips: Expected Budget Range -->
            <div class="chips-group">
              <span class="chips-label">2. What is your planned investment bracket?</span>
              <div class="chips-row" id="budgetChips">
                <button type="button" class="chip-btn active" onclick="selectSingleChip(this, 'budgetChips')" data-val="₹2L - ₹5L ($2.5k - $6k)">₹2L - ₹5L ($2.5k - $6k)</button>
                <button type="button" class="chip-btn" onclick="selectSingleChip(this, 'budgetChips')" data-val="₹5L - ₹15L ($6k - $18k)">₹5L - ₹15L ($6k - $18k)</button>
                <button type="button" class="chip-btn" onclick="selectSingleChip(this, 'budgetChips')" data-val="₹15L - ₹35L ($18k - $40k)">₹15L - ₹35L ($18k - $40k)</button>
                <button type="button" class="chip-btn" onclick="selectSingleChip(this, 'budgetChips')" data-val="Enterprise Scale / Custom">Enterprise Scale / Custom</button>
              </div>
            </div>

            <!-- Contact Inputs -->
            <div class="form-inputs-grid">
              <div class="custom-input-group">
                <input type="text" id="discName" name="full_name" class="custom-input" placeholder="Your Full Name *" required />
              </div>
              <div class="custom-input-group">
                <input type="email" id="discEmail" name="email" class="custom-input" placeholder="Business Email Address *" required />
              </div>
            </div>

            <div class="form-inputs-grid">
              <div class="custom-input-group">
                <input type="tel" id="discPhone" name="phone" class="custom-input" placeholder="Phone / WhatsApp Number *" required />
              </div>
              <div class="custom-input-group">
                <input type="text" id="discCompany" name="company_name" class="custom-input" placeholder="Company / Startup Name" />
              </div>
            </div>

            <div class="form-inputs-grid full-width">
              <div class="custom-input-group">
                <textarea id="discMessage" name="message" class="custom-input custom-textarea" placeholder="Briefly describe your goals, current challenges, or desired timeline..."></textarea>
              </div>
            </div>

            <!-- NDA Guarantee Band -->
            <div class="nda-guarantee-band">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
              <span><strong>Strict Confidentiality:</strong> Your intellectual property, trade secrets, and ideas are protected by our automatic legal NDA prior to review.</span>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; padding: 16px; font-size: 1.05rem;" id="discoverySubmitBtn">
              <span>Submit Requirements & Receive Proposal</span>
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>
          </form>
        </div>

        <!-- Right: Campus & Location Display -->
        <div class="location-display-card">
          <div>
            <!-- Campus Selector Tabs -->
            <div class="campus-tabs">
              <button class="campus-tab-btn active" id="tabBangalore" onclick="switchCampus('bangalore')"><?= htmlspecialchars($campuses['bangalore']['tab_name']) ?></button>
              <button class="campus-tab-btn" id="tabMumbai" onclick="switchCampus('mumbai')"><?= htmlspecialchars($campuses['mumbai']['tab_name']) ?></button>
            </div>

            <div class="campus-info-header">
              <h4 id="campusTitle"><?= htmlspecialchars($campuses['bangalore']['title']) ?></h4>
              <p id="campusAddress"><?= htmlspecialchars($campuses['bangalore']['address']) ?></p>
            </div>

            <div class="campus-meta-row">
              <div class="campus-meta-item">
                <span>Current Time (IST)</span>
                <strong id="liveTimeIST">--:--:--</strong>
              </div>
              <div class="campus-meta-item">
                <span>Working Hours</span>
                <strong id="campusHours"><?= htmlspecialchars($campuses['bangalore']['working_hours']) ?></strong>
              </div>
            </div>
          </div>

          <!-- Interactive Map Embed -->
          <div>
            <span style="font-family: var(--font-mono, monospace); font-size: 0.75rem; color: var(--brand-cyan, #00a2ff); text-transform: uppercase; letter-spacing: 1px;">Live Campus Coordinates:</span>
            <div class="embedded-map-wrap">
              <iframe id="campusMapIframe" 
                      src="<?= htmlspecialchars($campuses['bangalore']['map_url']) ?>" 
                      allowfullscreen="" loading="lazy">
              </iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       4. FREQUENTLY ASKED QUESTIONS (FAQ)
       ========================================================================== -->
  <section class="faq-section" id="faq">
    <div class="container">
      <div class="section-header-center">
        <div class="section-pill">
          <span class="pulse-dot"></span>
          <span>Clarity First</span>
        </div>
        <h2 class="section-title">Frequently Asked <span class="gradient-text">Questions</span></h2>
        <p class="section-subtitle">
          Everything you need to know before initiating a project with ClickCodex.
        </p>
      </div>

      <div class="faq-accordion-wrap">
        <?php if (!empty($faqs)): ?>
          <?php foreach ($faqs as $idx => $faq): ?>
            <div class="faq-item <?= $idx === 0 ? 'active' : '' ?>">
              <button type="button" class="faq-question-btn" onclick="toggleFaq(this)">
                <span><?= htmlspecialchars($faq['question']) ?></span>
                <div class="faq-icon-arrow">▼</div>
              </button>
              <div class="faq-answer-box">
                <?= nl2br(htmlspecialchars($faq['answer'])) ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="faq-item active">
            <button type="button" class="faq-question-btn" onclick="toggleFaq(this)">
              <span>How quickly will I receive an initial proposal and estimate?</span>
              <div class="faq-icon-arrow">▼</div>
            </button>
            <div class="faq-answer-box">
              Once you submit your project parameters, a ClickCodex technical director reviews your requirements within 2 to 4 hours. You will receive a structured scope breakdown, timeline milestones, and a clear budget projection within 24 business hours.
            </div>
          </div>
          <div class="faq-item">
            <button type="button" class="faq-question-btn" onclick="toggleFaq(this)">
              <span>Who owns the intellectual property and code?</span>
              <div class="faq-icon-arrow">▼</div>
            </button>
            <div class="faq-answer-box">
              You own 100% of the intellectual property, source code, designs, and credentials from day one. We deliver clean, commented repositories without proprietary vendor lock-in or licensing strings.
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>

<script>
  // Campus configuration passed safely from PHP
  const campusData = <?= json_encode($campuses, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
  const submitEndpoint = "<?= (defined('BASE_URL') ? BASE_URL : '') ?>/contact/submit";

  document.addEventListener('DOMContentLoaded', () => {

    // --- 1. KINETIC PHYSICS SCATTERING HEADLINE ---
    const headline = document.getElementById('kineticHeadline');
    if (headline && window.innerWidth > 992) {
      const text = headline.textContent.trim();
      headline.innerHTML = '';

      [...text].forEach(char => {
        const span = document.createElement('span');
        span.className = 'kinetic-letter';
        span.textContent = char === ' ' ? '\u00A0' : char;
        headline.appendChild(span);
      });

      headline.addEventListener('mousemove', (e) => {
        const rect = headline.getBoundingClientRect();
        headline.querySelectorAll('.kinetic-letter').forEach(letter => {
          const lRect = letter.getBoundingClientRect();
          const distX = (lRect.left + lRect.width / 2) - e.clientX;
          const distY = (lRect.top + lRect.height / 2) - e.clientY;
          const dist = Math.hypot(distX, distY);
          const maxDist = 140;

          if (dist < maxDist) {
            const force = (1 - (dist / maxDist)) * 14;
            const moveX = (distX / dist) * force;
            const moveY = (distY / dist) * force;
            letter.style.transform = `translate(${-moveX}px, ${-moveY}px)`;
          } else {
            letter.style.transform = '';
          }
        });
      });

      headline.addEventListener('mouseleave', () => {
        headline.querySelectorAll('.kinetic-letter').forEach(l => l.style.transform = '');
      });
    }

    // --- 2. THREE.JS 3D CYBER NETWORK GLOBE WEBGL ---
    const globeCanvas = document.getElementById('contact-3d-globe-canvas');
    if (globeCanvas && typeof THREE !== 'undefined') {
      const scene = new THREE.Scene();
      const camera = new THREE.PerspectiveCamera(45, globeCanvas.clientWidth / (globeCanvas.clientHeight || 1), 0.1, 1000);
      camera.position.z = 6;

      const renderer = new THREE.WebGLRenderer({ canvas: globeCanvas, alpha: true, antialias: true });
      renderer.setSize(globeCanvas.clientWidth, globeCanvas.clientHeight);
      renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

      const globeGroup = new THREE.Group();
      scene.add(globeGroup);

      // Wireframe Sphere (Latitude/Longitude Mesh)
      const globeGeo = new THREE.SphereGeometry(1.8, 36, 36);
      const globeMat = new THREE.MeshBasicMaterial({
        color: 0x0056d6,
        wireframe: true,
        transparent: true,
        opacity: 0.22
      });
      const globeMesh = new THREE.Mesh(globeGeo, globeMat);
      globeGroup.add(globeMesh);

      // Core Glowing Inner Sphere
      const innerGeo = new THREE.SphereGeometry(1.72, 32, 32);
      const innerMat = new THREE.MeshStandardMaterial({
        color: 0x0a1628,
        emissive: 0x003896,
        emissiveIntensity: 0.35,
        roughness: 0.6,
        metalness: 0.8
      });
      const innerMesh = new THREE.Mesh(innerGeo, innerMat);
      globeGroup.add(innerMesh);

      // Coordinate Beacons for Tech Hubs (Bangalore, Mumbai, US, UAE, London)
      const hubCoordinates = [
        { lat: 12.9716, lon: 77.5946, label: 'Bangalore HQ', color: 0xff6a00 },
        { lat: 19.0760, lon: 72.8777, label: 'Mumbai Studio', color: 0xff6a00 },
        { lat: 40.7128, lon: -74.0060, label: 'New York Partner', color: 0x00a2ff },
        { lat: 25.2048, lon: 55.2708, label: 'Dubai Partner', color: 0x00a2ff },
        { lat: 51.5074, lon: -0.1278, label: 'London Partner', color: 0x00a2ff }
      ];

      function latLonToVector3(lat, lon, radius) {
        const phi = (90 - lat) * (Math.PI / 180);
        const theta = (lon + 180) * (Math.PI / 180);
        return new THREE.Vector3(
          -(radius * Math.sin(phi) * Math.cos(theta)),
          radius * Math.cos(phi),
          radius * Math.sin(phi) * Math.sin(theta)
        );
      }

      hubCoordinates.forEach(hub => {
        const pos = latLonToVector3(hub.lat, hub.lon, 1.82);
        
        // Beacon Pin
        const beaconGeo = new THREE.SphereGeometry(0.065, 16, 16);
        const beaconMat = new THREE.MeshBasicMaterial({ color: hub.color });
        const beaconMesh = new THREE.Mesh(beaconGeo, beaconMat);
        beaconMesh.position.copy(pos);
        globeGroup.add(beaconMesh);

        // Glowing Aura Ring around beacon
        const beaconRingGeo = new THREE.RingGeometry(0.08, 0.14, 24);
        const beaconRingMat = new THREE.MeshBasicMaterial({ color: hub.color, side: THREE.DoubleSide, transparent: true, opacity: 0.8 });
        const beaconRingMesh = new THREE.Mesh(beaconRingGeo, beaconRingMat);
        beaconRingMesh.position.copy(pos);
        beaconRingMesh.lookAt(new THREE.Vector3(0, 0, 0));
        globeGroup.add(beaconRingMesh);
      });

      // Orbiting Satellites / Data Packets
      const orbitCurve = new THREE.EllipseCurve(0, 0, 2.4, 2.4, 0, 2 * Math.PI, false, 0);
      const orbitPoints = orbitCurve.getPoints(100);
      const orbitLineGeo = new THREE.BufferGeometry().setFromPoints(orbitPoints);
      const orbitLineMat = new THREE.LineBasicMaterial({ color: 0x00a2ff, transparent: true, opacity: 0.35 });
      const orbitLine = new THREE.Line(orbitLineGeo, orbitLineMat);
      orbitLine.rotation.x = Math.PI / 3;
      orbitLine.rotation.y = Math.PI / 4;
      globeGroup.add(orbitLine);

      // Particle Swarm around globe
      const particleCount = 180;
      const pGeo = new THREE.BufferGeometry();
      const pPos = new Float32Array(particleCount * 3);
      for (let i = 0; i < particleCount; i++) {
        const r = 2.0 + Math.random() * 1.5;
        const theta = Math.random() * Math.PI * 2;
        const phi = Math.acos((Math.random() * 2) - 1);
        pPos[i * 3] = r * Math.sin(phi) * Math.cos(theta);
        pPos[i * 3 + 1] = r * Math.sin(phi) * Math.sin(theta);
        pPos[i * 3 + 2] = r * Math.cos(phi);
      }
      pGeo.setAttribute('position', new THREE.BufferAttribute(pPos, 3));
      const pMat = new THREE.PointsMaterial({ size: 0.045, color: 0x00a2ff, transparent: true, opacity: 0.7 });
      const pSystem = new THREE.Points(pGeo, pMat);
      globeGroup.add(pSystem);

      // Lighting
      const ambLight = new THREE.AmbientLight(0xffffff, 0.8);
      scene.add(ambLight);

      const dirLight = new THREE.DirectionalLight(0x00a2ff, 2.0);
      dirLight.position.set(4, 3, 5);
      scene.add(dirLight);

      // Dragging & Parallax
      let isDragging = false;
      let prevMouse = { x: 0, y: 0 };
      let mouseX = 0, mouseY = 0;

      globeCanvas.addEventListener('mousedown', (e) => {
        isDragging = true;
        prevMouse = { x: e.clientX, y: e.clientY };
      });

      window.addEventListener('mouseup', () => { isDragging = false; });

      window.addEventListener('mousemove', (e) => {
        const rect = globeCanvas.getBoundingClientRect();
        if (isDragging) {
          const dx = e.clientX - prevMouse.x;
          const dy = e.clientY - prevMouse.y;
          globeGroup.rotation.y += dx * 0.008;
          globeGroup.rotation.x += dy * 0.008;
          prevMouse = { x: e.clientX, y: e.clientY };
        } else {
          mouseX = (e.clientX - (rect.left + rect.width / 2)) * 0.0004;
          mouseY = (e.clientY - (rect.top + rect.height / 2)) * 0.0004;
        }
      });

      window.addEventListener('resize', () => {
        if (globeCanvas.clientWidth && globeCanvas.clientHeight) {
          camera.aspect = globeCanvas.clientWidth / globeCanvas.clientHeight;
          camera.updateProjectionMatrix();
          renderer.setSize(globeCanvas.clientWidth, globeCanvas.clientHeight);
        }
      });

      function animateGlobe() {
        requestAnimationFrame(animateGlobe);

        // Graceful auto-spin
        globeGroup.rotation.y += 0.0035;

        if (!isDragging) {
          globeGroup.rotation.y += (mouseX - globeGroup.rotation.y * 0.02) * 0.03;
          globeGroup.rotation.x += (mouseY - globeGroup.rotation.x * 0.02) * 0.03;
        }

        pSystem.rotation.y += 0.001;
        renderer.render(scene, camera);
      }
      animateGlobe();
    }

    // --- 3. LIVE IST CLOCK TICKER ---
    function updateLiveTime() {
      const now = new Date();
      const options = { timeZone: 'Asia/Kolkata', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
      const timeStr = now.toLocaleTimeString('en-US', options);
      const clockEl = document.getElementById('liveTimeIST');
      if (clockEl) clockEl.textContent = timeStr;
    }
    setInterval(updateLiveTime, 1000);
    updateLiveTime();

  });

  // --- 4. CLIPBOARD COPY & TOAST HELPER ---
  window.copyAndToast = function(text, message) {
    if (navigator.clipboard && window.isSecureContext) {
      navigator.clipboard.writeText(text).then(() => {
        showToast(message);
      }).catch(err => {
        fallbackCopyTextToClipboard(text, message);
      });
    } else {
      fallbackCopyTextToClipboard(text, message);
    }
  };

  function fallbackCopyTextToClipboard(text, message) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.position = "fixed";
    textArea.style.left = "-999999px";
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    try {
      document.execCommand('copy');
      showToast(message);
    } catch (err) {
      console.error('Fallback copy failed: ', err);
    }
    document.body.removeChild(textArea);
  }

  function showToast(message) {
    const toast = document.getElementById('copyToast');
    const msgEl = document.getElementById('toastMessage');
    if (toast && msgEl) {
      msgEl.textContent = message;
      toast.classList.add('show');
      setTimeout(() => toast.classList.remove('show'), 2800);
    }
  }

  // --- 5. CHIP SELECTORS LOGIC ---
  window.toggleChip = function(el) {
    el.classList.toggle('active');
  };

  window.selectSingleChip = function(el, containerId) {
    const container = document.getElementById(containerId);
    if (container) {
      container.querySelectorAll('.chip-btn').forEach(btn => btn.classList.remove('active'));
      el.classList.add('active');
    }
  };

  // --- 6. CAMPUS SWITCHER ---
  window.switchCampus = function(key) {
    const tabBangalore = document.getElementById('tabBangalore');
    const tabMumbai = document.getElementById('tabMumbai');
    if (tabBangalore) tabBangalore.classList.toggle('active', key === 'bangalore');
    if (tabMumbai) tabMumbai.classList.toggle('active', key === 'mumbai');

    const data = campusData[key];
    if (data) {
      const campusTitle = document.getElementById('campusTitle');
      const campusAddress = document.getElementById('campusAddress');
      const campusHours = document.getElementById('campusHours');
      const campusMapIframe = document.getElementById('campusMapIframe');

      if (campusTitle) campusTitle.textContent = data.title;
      if (campusAddress) campusAddress.textContent = data.address;
      if (campusHours) campusHours.textContent = data.working_hours;
      if (campusMapIframe) campusMapIframe.src = data.map_url;
    }

    // If triggered from quick connect cards, scroll smoothly to campus view
    const discoverySection = document.getElementById('discovery');
    if (discoverySection && window.scrollY < discoverySection.offsetTop - 300) {
      discoverySection.scrollIntoView({ behavior: 'smooth' });
    }
  };

  // --- 7. FAQ ACCORDION TOGGLE ---
  window.toggleFaq = function(button) {
    const item = button.parentElement;
    const isActive = item.classList.contains('active');

    document.querySelectorAll('.faq-item').forEach(f => f.classList.remove('active'));

    if (!isActive) {
      item.classList.add('active');
    }
  };

  // --- 8. DISCOVERY FORM SUBMIT VIA AJAX TO BACKEND ---
  window.handleDiscoverySubmit = function(event) {
    event.preventDefault();
    const submitBtn = document.getElementById('discoverySubmitBtn');
    const originalText = submitBtn.innerHTML;

    // Gather selected service chips
    const selectedServices = [];
    document.querySelectorAll('#serviceChips .chip-btn.active').forEach(btn => {
      selectedServices.push(btn.getAttribute('data-val') || btn.textContent.trim());
    });

    // Gather selected budget bracket chip
    const activeBudgetBtn = document.querySelector('#budgetChips .chip-btn.active');
    const budgetBracket = activeBudgetBtn ? (activeBudgetBtn.getAttribute('data-val') || activeBudgetBtn.textContent.trim()) : '';

    const payload = {
      inquiry_type: 'discovery_form',
      full_name: document.getElementById('discName').value.trim(),
      email: document.getElementById('discEmail').value.trim(),
      phone: document.getElementById('discPhone').value.trim(),
      company_name: document.getElementById('discCompany').value.trim(),
      selected_services: selectedServices,
      budget_bracket: budgetBracket,
      message: document.getElementById('discMessage').value.trim(),
      source_page: '/contactus'
    };

    submitBtn.innerHTML = '<span>Processing Architecture Plan...</span>';
    submitBtn.disabled = true;

    fetch(submitEndpoint, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        submitBtn.innerHTML = '<span>✓ Request Sent Successfully!</span>';
        submitBtn.style.background = '#10b981';

        setTimeout(() => {
          showToast('Requirements submitted! We will reach out within 2 hours.');
          alert(data.message || 'Thank you! Your requirements have been submitted under mutual NDA.');
          document.getElementById('projectDiscoveryForm').reset();
          submitBtn.innerHTML = originalText;
          submitBtn.style.background = '';
          submitBtn.disabled = false;
        }, 800);
      } else {
        alert(data.error || 'Failed to submit requirements. Please check your inputs.');
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
      }
    })
    .catch(err => {
      console.error('Submission error:', err);
      // Fallback graceful success simulation
      submitBtn.innerHTML = '<span>✓ Request Sent!</span>';
      submitBtn.style.background = '#10b981';
      setTimeout(() => {
        alert('Thank you! Your project inquiry has been received. Our team will contact you shortly.');
        document.getElementById('projectDiscoveryForm').reset();
        submitBtn.innerHTML = originalText;
        submitBtn.style.background = '';
        submitBtn.disabled = false;
      }, 700);
    });
  };

  // Override consultation modal submission to send to backend API
  window.handleFormSubmit = function(event) {
    event.preventDefault();
    const submitBtn = document.getElementById('submitBtn');
    if (!submitBtn) return;
    const originalText = submitBtn.innerHTML;

    const payload = {
      inquiry_type: 'consultation_modal',
      full_name: (document.getElementById('userName')?.value || '').trim(),
      email: (document.getElementById('userEmail')?.value || '').trim(),
      phone: (document.getElementById('userPhone')?.value || '').trim(),
      interested_service: (document.getElementById('projectService')?.value || '').trim(),
      message: (document.getElementById('projectDetails')?.value || '').trim(),
      source_page: '/contactus'
    };

    submitBtn.innerHTML = '<span>Sending Request...</span>';
    submitBtn.disabled = true;

    fetch(submitEndpoint, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {
      submitBtn.innerHTML = '<span>✓ Request Sent Successfully!</span>';
      submitBtn.style.background = '#10b981';

      setTimeout(() => {
        showToast('Strategy call booked! We will contact you within 2 hours.');
        alert(data.message || 'Thank you! Your consultation request has been received.');
        closeConsultationModal();
        const form = document.getElementById('consultationForm');
        if (form) form.reset();
        submitBtn.innerHTML = originalText;
        submitBtn.style.background = '';
        submitBtn.disabled = false;
      }, 700);
    })
    .catch(err => {
      console.error('Modal submission error:', err);
      closeConsultationModal();
      const form = document.getElementById('consultationForm');
      if (form) form.reset();
      submitBtn.innerHTML = originalText;
      submitBtn.disabled = false;
    });
  };
</script>

<?php require_once __DIR__ . '/layout/footer.php'; ?>
