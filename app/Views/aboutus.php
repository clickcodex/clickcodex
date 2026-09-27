<?php
/**
 * ClickCodex Technologies - Dynamic About Us View
 * Designed with 100% exact fidelity to storage/Frontend/aboutus.html
 * Backed by clickcodex_db database records
 */
declare(strict_types=1);

include __DIR__ . '/layout/header.php';

// Prepare Hero Stats
$heroStats = $sections['hero_about']['settings']['stats'] ?? [
    ['num' => '4', 'lbl' => 'Core Team Members'],
    ['num' => '~2 Yrs', 'lbl' => 'Tech Experience', 'warm' => true],
    ['num' => '5', 'lbl' => 'Showcase Projects'],
    ['num' => '12', 'lbl' => 'Digital Services', 'warm' => true]
];

// Prepare Pillars JSON for Javascript
$jsPillars = [];
$defaultPillars = [
    'transparency' => [
        'tag' => 'CORE PILLAR 01',
        'metric' => '✓ 100% Codebase Ownership',
        'title' => 'Radical Transparency In Every Single Sprint.',
        'desc' => 'No hidden agendas, no inflated estimates, and no proprietary vendor lock-in. You get direct access to our Git repositories, milestone updates, and staging environments. We deliver what we promise, with clean code and open communication.',
        'stat1' => 'Milestone', 'stat1Label' => 'Demo & Staging Pushes',
        'stat2' => '100%', 'stat2Label' => 'IP & Source Ownership',
        'stat3' => 'Direct', 'stat3Label' => 'Developer Access'
    ],
    'velocity' => [
        'tag' => 'CORE PILLAR 02',
        'metric' => '⚡ Agile Delivery Sprints',
        'title' => 'Agile Sprints Focused On Working Solutions.',
        'desc' => 'We focus on practical execution without bureaucratic delays. By utilizing modern web frameworks, component architectures, and iterative sprints, we build and deploy functional websites and applications efficiently.',
        'stat1' => '2-4 Wks', 'stat1Label' => 'Fast MVP Turnaround',
        'stat2' => 'Modern', 'stat2Label' => 'Framework Standards',
        'stat3' => 'Direct', 'stat3Label' => 'Sprint Communication'
    ],
    'craft' => [
        'tag' => 'CORE PILLAR 03',
        'metric' => '🛡️ Clean Code & Security',
        'title' => 'Maintainable Code & Modern Architecture.',
        'desc' => 'We build digital products designed for stability and clarity. Every route, database query, and responsive UI component is written following modern coding conventions and standard security guidelines.',
        'stat1' => 'Mobile', 'stat1Label' => 'First Responsive Design',
        'stat2' => 'Clean', 'stat2Label' => 'Modular Architecture',
        'stat3' => 'Standard', 'stat3Label' => 'Security Practices'
    ],
    'client' => [
        'tag' => 'CORE PILLAR 04',
        'metric' => '🎯 Practical Business Outcomes',
        'title' => 'Direct Strategic Alignment With Founder Goals.',
        'desc' => 'We measure success by building practical digital assets that serve your real business needs. Clean websites, seamless user experiences, and direct communication ensure your investments create lasting digital value.',
        'stat1' => '100%', 'stat1Label' => 'Dedicated Commitment',
        'stat2' => '5', 'stat2Label' => 'Showcase Projects',
        'stat3' => 'Direct', 'stat3Label' => 'Team Collaboration'
    ]
];

$pillarIndex = 1;
foreach (['transparency', 'velocity', 'craft', 'client'] as $pkey) {
    if (isset($companyValues[$pkey])) {
        $v = $companyValues[$pkey];
        $jsPillars[$pkey] = [
            'tag' => 'CORE PILLAR 0' . $pillarIndex,
            'metric' => $v['metric_badge'] ?? $defaultPillars[$pkey]['metric'],
            'title' => ($v['title'] ?? '') . ' In Every Single Sprint.',
            'desc' => $v['description'] ?? $defaultPillars[$pkey]['desc'],
            'stat1' => $v['stat1_val'] ?? $defaultPillars[$pkey]['stat1'],
            'stat1Label' => $v['stat1_lbl'] ?? $defaultPillars[$pkey]['stat1Label'],
            'stat2' => $v['stat2_val'] ?? $defaultPillars[$pkey]['stat2'],
            'stat2Label' => $v['stat2_lbl'] ?? $defaultPillars[$pkey]['stat2Label'],
            'stat3' => $v['stat3_val'] ?? $defaultPillars[$pkey]['stat3'],
            'stat3Label' => $v['stat3_lbl'] ?? $defaultPillars[$pkey]['stat3Label']
        ];
    } else {
        $jsPillars[$pkey] = $defaultPillars[$pkey];
    }
    $pillarIndex++;
}

// Prepare Team Members for Constellation Canvas
$jsTeam = [];
foreach ($teamMembers as $m) {
    $jsTeam[] = [
        'title' => $m['role_title'] ?? 'Full-Stack Developer',
        'specialty' => $m['specialty'] ?? 'Full-Stack & Web Technologies',
        'exp' => $m['experience_years'] ?? '~2 Yrs',
        'avatar' => !empty($m['avatar_image']) ? $m['avatar_image'] : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=120&h=120&fit=crop&crop=face'
    ];
}
?>

  <main>
    <!-- ==========================================================================
         2. HERO SECTION WITH THREE.JS 3D CODEX CORE
         ========================================================================== -->
    <section class="about-hero" id="hero">
      <!-- 3D Three.js WebGL Canvas for Interactive Floating Core -->
      <canvas id="hero-3d-canvas"></canvas>

      <!-- Interactive Helper Pill -->
      <div class="canvas-hint-pill">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2v20M2 12h20"/></svg>
        <span>Drag 3D Codex Core • Click to Pulse</span>
      </div>

      <div class="container">
        <div class="about-hero-grid">
          <div class="hero-content">
            <!-- Badge -->
            <div class="hero-badge-wrap">
              <span class="hero-badge-tag">Who We Are</span>
              <span class="hero-badge-text"><?= htmlspecialchars($sections['hero_about']['badge_text'] ?? 'Early-Stage Technology & Creative Studio') ?></span>
            </div>

            <h1 class="about-hero-title">
              Building Practical Digital Solutions.<br />
              <span class="gradient-text">Crafted With Care.</span>
            </h1>

            <p class="hero-lead-text">
              <?= htmlspecialchars($sections['hero_about']['subtitle'] ?? 'Click Codex is an early-stage technology startup dedicated to delivering high-performance websites, custom web applications, creative branding, and short-form video content that help businesses grow.') ?>
            </p>

            <div class="hero-cta-row">
              <button class="btn-primary" onclick="openConsultationModal('Hero About')">
                <span><?= htmlspecialchars($sections['hero_about']['cta_primary_text'] ?? 'Partner With Us') ?></span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                  <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
              </button>

              <a href="#story" class="btn-outline">
                <span><?= htmlspecialchars($sections['hero_about']['cta_secondary_text'] ?? 'Explore Our Journey') ?></span>
              </a>
            </div>

            <!-- 3D Floating Stats Overlay Band -->
            <div class="hero-stats-band">
              <?php foreach ($heroStats as $idx => $st): ?>
                <?php $isWarm = (!empty($st['warm']) || $idx % 2 === 1); ?>
                <div class="hero-stat-card">
                  <span class="stat-number <?= $isWarm ? 'warm' : '' ?>"><?= htmlspecialchars($st['num'] ?? '') ?></span>
                  <span class="stat-label"><?= htmlspecialchars($st['lbl'] ?? '') ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         3. OUR STORY: INTERACTIVE 3D MILESTONE JOURNEY
         ========================================================================== -->
    <section class="story-section" id="story">
      <div class="container">
        <div class="section-header-center">
          <div class="section-pill">
            <span class="pulse-dot"></span>
            <span><?= htmlspecialchars($sections['story_evolution']['badge_text'] ?? 'Our Story & Ethos') ?></span>
          </div>
          <h2 class="section-title">The Click Codex <span class="gradient-text">Journey</span></h2>
          <p class="section-subtitle">
            <?= htmlspecialchars($sections['story_evolution']['subtitle'] ?? 'From a dedicated 4-member pod building practical digital assets to an emerging studio focused on long-term client success.') ?>
          </p>
        </div>

        <div class="story-grid">
          <!-- Left: Narrative Card -->
          <div class="story-narrative-card">
            <span class="story-tagline">// 01. The Founding Ethos</span>
            <h3 class="story-lead">
              "We realized businesses didn't need complicated agency layers. They needed an agile, focused team that builds practical digital solutions with care and transparency."
            </h3>
            <p class="story-paragraph">
              Click Codex was founded with a singular conviction: businesses of all sizes need responsive, accessible technology partners who write clean code, create modern designs, and communicate openly without bloated agency markups.
            </p>
            <p class="story-paragraph">
              Operating as a focused 4-member collaborative team with roughly two years of hands-on experience across full-stack development, UI/UX, and digital media, we work directly alongside founders and business owners from concept to launch.
            </p>
            <div class="story-quote-box">
              "Practical execution and clean digital craft. At Click Codex, we turn your bold ideas into reliable digital realities."
            </div>
          </div>

          <!-- Right: Interactive Milestone Stepper -->
          <div class="timeline-container">
            <?php foreach ($milestones as $mIndex => $m): ?>
              <div class="milestone-item <?= $mIndex === 0 ? 'active' : '' ?>" onclick="activateMilestone(this)">
                <div class="milestone-node"></div>
                <div class="milestone-card">
                  <div class="milestone-header">
                    <span class="milestone-year"><?= htmlspecialchars($m['year_label'] ?? (($m['year'] ?? '') . ' • ' . ($m['milestone_tag'] ?? 'Milestone'))) ?></span>
                  </div>
                  <h4 class="milestone-title"><?= htmlspecialchars($m['title']) ?></h4>
                  <p class="milestone-desc">
                    <?= htmlspecialchars($m['description']) ?>
                  </p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         4. CONVERGING REALITIES: MISSION & VISION 3D REACTOR
         ========================================================================== -->
    <section class="converging-section" id="mission">
      <div class="container">
        <div class="section-header-center">
          <div class="section-pill">
            <span class="pulse-dot"></span>
            <span><?= htmlspecialchars($sections['converging_realities']['badge_text'] ?? 'Synergy in Action') ?></span>
          </div>
          <h2 class="section-title">Converging <span class="gradient-warm-text">Realities</span></h2>
          <p class="section-subtitle">
            <?= htmlspecialchars($sections['converging_realities']['subtitle'] ?? 'Two distinct forces powering ClickCodex. Move the reactor slider or interact with the singularity orb to observe how Technical Mastery and Commercial Vision fuse together.') ?>
          </p>
        </div>

        <div class="reactor-stage">
          <!-- Orbital Laser Rings -->
          <div class="reactor-energy-ring"></div>
          <div class="reactor-energy-ring-2"></div>

          <div class="reactor-grid">
            <!-- Left: Our Mission (Technical Precision) -->
            <div class="reactor-panel mission-panel" id="missionPanel">
              <span class="reactor-panel-tag">// 01. OUR MISSION</span>
              <h3 class="reactor-panel-title">Engineering Precision & Zero Technical Debt</h3>
              <p class="reactor-panel-desc">
                To build unshakeable, enterprise-grade software foundations that scale frictionlessly from day one. We eradicate code bloat, enforce rigid security, and build digital assets that endure.
              </p>
              <div class="reactor-features">
                <div class="reactor-feat-item">
                  <svg viewBox="0 0 24 24" fill="none" stroke="#00a2ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                  <span>Microsecond Response Time Benchmarks</span>
                </div>
                <div class="reactor-feat-item">
                  <svg viewBox="0 0 24 24" fill="none" stroke="#00a2ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                  <span>Rigid OWASP Enterprise Security Compliance</span>
                </div>
                <div class="reactor-feat-item">
                  <svg viewBox="0 0 24 24" fill="none" stroke="#00a2ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                  <span>Modular Clean-Code Architecture</span>
                </div>
              </div>
            </div>

            <!-- Center: The Convergence Singularity Orb -->
            <div class="convergence-core-wrap">
              <div class="convergence-core-orb" id="convergenceOrb" title="Click to trigger convergence surge!">
                <svg viewBox="0 0 24 24">
                  <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
              </div>
              <span class="core-caption">CLICKCODEX SYNERGY</span>
              <span class="core-subcaption"><?= htmlspecialchars($settings['site_tagline'] ?? 'Ideas To Solutions') ?></span>
            </div>

            <!-- Right: Our Vision (Commercial Dominance) -->
            <div class="reactor-panel vision-panel" id="visionPanel">
              <span class="reactor-panel-tag">// 02. OUR VISION</span>
              <h3 class="reactor-panel-title">Empowering Visionaries To Dominate Markets</h3>
              <p class="reactor-panel-desc">
                To serve as the strategic digital weapon for forward-thinking brands. We merge emotional design, high-converting buyer journeys, and data intelligence so our clients lead their industries.
              </p>
              <div class="reactor-features">
                <div class="reactor-feat-item">
                  <svg viewBox="0 0 24 24" fill="none" stroke="#ff6a00" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                  <span>Exponential Conversion Rate Optimization</span>
                </div>
                <div class="reactor-feat-item">
                  <svg viewBox="0 0 24 24" fill="none" stroke="#ff6a00" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                  <span>Global Brand Authority & UI/UX Immersion</span>
                </div>
                <div class="reactor-feat-item">
                  <svg viewBox="0 0 24 24" fill="none" stroke="#ff6a00" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                  <span>Measurable ROI On Every Single Project</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Interactive Slider Control -->
          <div class="reactor-slider-wrap">
            <div class="reactor-slider-label">
              <span>← Precision Code Focus</span>
              <strong>Dynamic Equilibrium</strong>
              <span>Growth Vision Focus →</span>
            </div>
            <input type="range" min="0" max="100" value="50" class="custom-range-slider" id="reactorSlider" aria-label="Dynamic Equilibrium Slider" />
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
       5. HOLOGRAPHIC PROJECTOR: CORE VALUES
       ========================================================================== -->
    <section class="projector-section" id="values">
      <div class="container">
        <div class="section-header-center">
          <div class="section-pill">
            <span class="pulse-dot"></span>
            <span><?= htmlspecialchars($sections['values_projector']['badge_text'] ?? 'Non-Negotiable Standards') ?></span>
          </div>
          <h2 class="section-title">The ClickCodex <span class="gradient-text">DNA</span></h2>
          <p class="section-subtitle">
            <?= htmlspecialchars($sections['values_projector']['subtitle'] ?? "Our values aren't marketing slogans. They are algorithmic rules that guide every sprint, commit, and client interaction.") ?>
          </p>
        </div>

        <div class="projector-interface">
          <!-- Left Value Selectors -->
          <div class="projector-selector-list">
            <!-- Pillar 1: Transparency -->
            <div class="projector-btn active" data-pillar="transparency" onclick="switchProjectorPillar('transparency')">
              <div class="projector-btn-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
              </div>
              <div class="projector-btn-text">
                <h4><?= htmlspecialchars($companyValues['transparency']['title'] ?? 'Radical Transparency') ?></h4>
                <p><?= htmlspecialchars($companyValues['transparency']['subtitle'] ?? 'Zero surprises, daily visibility') ?></p>
              </div>
            </div>

            <!-- Pillar 2: Velocity -->
            <div class="projector-btn" data-pillar="velocity" onclick="switchProjectorPillar('velocity')">
              <div class="projector-btn-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
              </div>
              <div class="projector-btn-text">
                <h4><?= htmlspecialchars($companyValues['velocity']['title'] ?? 'Relentless Velocity') ?></h4>
                <p><?= htmlspecialchars($companyValues['velocity']['subtitle'] ?? 'Speed without corner-cutting') ?></p>
              </div>
            </div>

            <!-- Pillar 3: Craft / Zero Tech Debt -->
            <div class="projector-btn" data-pillar="craft" onclick="switchProjectorPillar('craft')">
              <div class="projector-btn-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
              </div>
              <div class="projector-btn-text">
                <h4><?= htmlspecialchars($companyValues['craft']['title'] ?? 'Zero Tech Debt') ?></h4>
                <p><?= htmlspecialchars($companyValues['craft']['subtitle'] ?? 'Code that survives market shifts') ?></p>
              </div>
            </div>

            <!-- Pillar 4: Founder Alignment -->
            <div class="projector-btn" data-pillar="client" onclick="switchProjectorPillar('client')">
              <div class="projector-btn-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
              </div>
              <div class="projector-btn-text">
                <h4><?= htmlspecialchars($companyValues['client']['title'] ?? 'Founder Alignment') ?></h4>
                <p><?= htmlspecialchars($companyValues['client']['subtitle'] ?? 'Your ROI is our ultimate metric') ?></p>
              </div>
            </div>
          </div>

          <!-- Right Hologram Display Screen -->
          <div class="projector-hologram-screen" id="hologramScreen">
            <div class="projector-light-emitter"></div>

            <div class="holo-content-box" id="holoContent">
              <div class="holo-header-row">
                <span class="holo-tag" id="holoTag"><?= htmlspecialchars($jsPillars['transparency']['tag']) ?></span>
                <span class="holo-metric-badge" id="holoMetric"><?= htmlspecialchars($jsPillars['transparency']['metric']) ?></span>
              </div>

              <h3 class="holo-title" id="holoTitle">
                <?= htmlspecialchars($jsPillars['transparency']['title']) ?>
              </h3>

              <p class="holo-description" id="holoDesc">
                <?= htmlspecialchars($jsPillars['transparency']['desc']) ?>
              </p>

              <div class="holo-stats-grid">
                <div class="holo-stat-item">
                  <strong id="holoStat1"><?= htmlspecialchars($jsPillars['transparency']['stat1']) ?></strong>
                  <span id="holoStat1Label"><?= htmlspecialchars($jsPillars['transparency']['stat1Label']) ?></span>
                </div>
                <div class="holo-stat-item">
                  <strong id="holoStat2"><?= htmlspecialchars($jsPillars['transparency']['stat2']) ?></strong>
                  <span id="holoStat2Label"><?= htmlspecialchars($jsPillars['transparency']['stat2Label']) ?></span>
                </div>
                <div class="holo-stat-item">
                  <strong id="holoStat3"><?= htmlspecialchars($jsPillars['transparency']['stat3']) ?></strong>
                  <span id="holoStat3Label"><?= htmlspecialchars($jsPillars['transparency']['stat3Label']) ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
       6. TEAM CONSTELLATION: INTERACTIVE 3D ORBITAL ROLES
       ========================================================================== -->
    <section class="team-section" id="team">
      <div class="container">
        <div class="section-header-center">
          <div class="section-pill">
            <span class="pulse-dot"></span>
            <span><?= htmlspecialchars($sections['team_constellation']['badge_text'] ?? 'The 4-Member Pod') ?></span>
          </div>
          <h2 class="section-title">The Click Codex <span class="gradient-warm-text">Team</span></h2>
          <p class="section-subtitle">
            <?= htmlspecialchars($sections['team_constellation']['subtitle'] ?? 'A focused 4-member collaborative team combining full-stack web development, UI/UX design, digital marketing strategy, and short-form video production.') ?>
          </p>
        </div>

        <div class="team-layout-grid">
          <!-- Left Intro Panel -->
          <div class="team-intro-card">
            <span class="team-tagline">// INTERACTIVE TALENT MAP</span>
            <h3 class="team-heading">
              Move Your Cursor Across The Star Grid To Connect Nodes.
            </h3>
            <p class="team-body-text">
              We believe in agile collaboration and direct access. Click Codex is powered by an active 4-member team with ~2 years of hands-on experience in modern web architecture, responsive layouts, creative UI/UX, and video production.
            </p>

            <div class="team-pills-row">
              <span class="tech-pill">PHP & MySQL</span>
              <span class="tech-pill">JavaScript & HTML5</span>
              <span class="tech-pill">Responsive CSS</span>
              <span class="tech-pill">UI/UX & Figma</span>
              <span class="tech-pill">Short-Form Video</span>
              <span class="tech-pill">Digital Marketing</span>
            </div>

            <button class="btn-primary" onclick="openConsultationModal('Dedicated Team')">
              <span><?= htmlspecialchars($sections['team_constellation']['cta_primary_text'] ?? 'Work With Our Team') ?></span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>
          </div>

          <!-- Right Constellation Interactive Canvas -->
          <div class="constellation-canvas-box">
            <canvas id="constellation-canvas"></canvas>

            <!-- Active Hover Preview Node -->
            <div class="constellation-active-preview" id="constellationPreview">
              <div class="preview-avatar-group">
                <img src="<?= htmlspecialchars($jsTeam[0]['avatar'] ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=120&h=120&fit=crop&crop=face') ?>" 
                     alt="Click Codex Team Member Avatar" 
                     loading="lazy"
                     decoding="async"
                     class="preview-avatar-img" 
                     id="nodeAvatar" />
                <div class="preview-text">
                  <h4 id="nodeTitle"><?= htmlspecialchars($jsTeam[0]['title'] ?? 'Full-Stack Developer') ?></h4>
                  <p id="nodeSpecialty"><?= htmlspecialchars($jsTeam[0]['specialty'] ?? 'Full-Stack Web Development') ?></p>
                </div>
              </div>
              <div class="preview-stat">
                <strong id="nodeExperience"><?= htmlspecialchars($jsTeam[0]['exp'] ?? '~2 Yrs') ?></strong>
                <span>Hands-On Exp</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
       7. FOCUS ACCORDION: 3D EXPANDING VALUES
       ========================================================================== -->
    <section class="focus-section" id="focus">
      <div class="container">
        <div class="section-header-center">
          <div class="section-pill">
            <span class="pulse-dot"></span>
            <span><?= htmlspecialchars($sections['focus_areas']['badge_text'] ?? 'Why Ambitious Brands Choose Us') ?></span>
          </div>
          <h2 class="section-title">Engineered for <span class="gradient-text">Impact</span></h2>
          <p class="section-subtitle">
            <?= htmlspecialchars($sections['focus_areas']['subtitle'] ?? 'Hover or click across our focus areas to explore the tangible differences our methodology brings to every deployment.') ?>
          </p>
        </div>

        <div class="focus-gallery-wrap">
          <?php foreach ($focusAreas as $fIndex => $fc): ?>
            <div class="focus-card <?= $fIndex === 0 ? 'active' : '' ?>" 
                 style="background-image: url('<?= htmlspecialchars($fc['image']) ?>');" 
                 onclick="activateFocusCard(this)">
              <div class="focus-card-overlay"></div>
              <div class="focus-card-content">
                <span class="focus-card-num"><?= htmlspecialchars($fc['number']) ?></span>
                <h3 class="focus-card-title"><?= htmlspecialchars($fc['title']) ?></h3>
                <p class="focus-card-desc">
                  <?= htmlspecialchars($fc['description']) ?>
                </p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
       8. FLUID RIPPLE CTA & STRATEGY CONSULTATION
       ========================================================================== -->
    <section class="ripple-cta-section" id="contact">
      <div class="container">
        <div class="ripple-cta-card">
          <!-- Interactive Fluid Ripple Canvas -->
          <canvas id="ripple-canvas"></canvas>

          <div class="ripple-cta-content">
            <span class="ripple-badge">Let's Build Something Extraordinary</span>
            <h2 class="ripple-title">
              Ready To Turn Your Boldest Ideas Into Unstoppable Reality?
            </h2>
            <p class="ripple-subtitle">
              Speak directly with our technical leadership. Get a comprehensive architecture evaluation, realistic timelines, and an accurate estimate within 24 hours.
            </p>

            <div class="ripple-btn-group">
              <button class="btn-primary" onclick="openConsultationModal('CTA Banner')">
                <span>Book Free Strategy Call</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
              </button>

              <?php
                $cleanPhone = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '919876543210');
                $waText = urlencode($settings['whatsapp_default_message'] ?? "Hi ClickCodex, I'd like to discuss a new project");
              ?>
              <a href="https://wa.me/<?= $cleanPhone ?>?text=<?= $waText ?>" 
                 target="_blank" rel="noopener noreferrer" class="whatsapp-btn" style="padding: 13px 26px; font-size: 0.95rem;">
                <svg viewBox="0 0 24 24" style="width: 20px; height: 20px;"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.698.077-1.118-.057-.26-.084-.589-.201-.989-.374-1.745-.758-2.887-2.531-2.975-2.648-.088-.116-.71-0.947-.71-1.807 0-.859.45-1.282.61-1.458.16-.176.35-.22.47-.22.12 0 .24.002.34.007.11.005.26-.042.41.319.15.362.51 1.242.55 1.33.04.088.07.191.01.308-.06.117-.09.19-.18.293-.09.103-.19.23-.27.309-.09.088-.19.183-.08.371.11.188.48.793 1.03 1.283.71.633 1.31.829 1.49.919.18.09.29.076.4-.047.11-.123.47-.549.6-.738.13-.189.26-.158.44-.092.18.066 1.14.537 1.34.636.2.099.33.147.38.232.05.085.05.495-.09.9z"/></svg>
                <span>Instant WhatsApp Inquiry</span>
              </a>
            </div>

            <div class="ripple-guarantees">
              <span>🔒 100% Confidential NDA</span>
              <span>⚡ Fast 2-Hour Response Time</span>
              <span>💡 Free Initial Architecture Plan</span>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', () => {

      // --- 1. THREE.JS 3D HERO CODEX CORE WEBGL ---
      const heroCanvas = document.getElementById('hero-3d-canvas');
      if (heroCanvas && typeof THREE !== 'undefined') {
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(45, heroCanvas.clientWidth / heroCanvas.clientHeight, 0.1, 1000);
        camera.position.z = 7;

        const renderer = new THREE.WebGLRenderer({ canvas: heroCanvas, alpha: true, antialias: true });
        renderer.setSize(heroCanvas.clientWidth, heroCanvas.clientHeight);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

        // Group container for mouse tilt & user dragging
        const codexGroup = new THREE.Group();
        scene.add(codexGroup);

        // Core 3D Geometry: Floating Crystalline Icosahedron / Codex Gem
        const coreGeo = new THREE.IcosahedronGeometry(1.6, 0);
        const coreMat = new THREE.MeshPhysicalMaterial({
          color: 0x0056d6,
          emissive: 0x003896,
          roughness: 0.15,
          metalness: 0.85,
          reflectivity: 1,
          clearcoat: 1.0,
          clearcoatRoughness: 0.1,
          wireframe: false
        });
        const coreMesh = new THREE.Mesh(coreGeo, coreMat);
        codexGroup.add(coreMesh);

        // Wireframe cage around core
        const wireGeo = new THREE.IcosahedronGeometry(1.65, 1);
        const wireMat = new THREE.MeshBasicMaterial({
          color: 0x00a2ff,
          wireframe: true,
          transparent: true,
          opacity: 0.45
        });
        const wireMesh = new THREE.Mesh(wireGeo, wireMat);
        codexGroup.add(wireMesh);

        // Outer Kinetic Orbital Rings (Brand Orange & Cyan)
        const ringGeo1 = new THREE.TorusGeometry(2.3, 0.035, 16, 100);
        const ringMat1 = new THREE.MeshStandardMaterial({
          color: 0xff6a00,
          emissive: 0xff6a00,
          emissiveIntensity: 0.5,
          roughness: 0.2
        });
        const ringMesh1 = new THREE.Mesh(ringGeo1, ringMat1);
        ringMesh1.rotation.x = Math.PI / 3;
        ringMesh1.rotation.y = Math.PI / 6;
        codexGroup.add(ringMesh1);

        const ringGeo2 = new THREE.TorusGeometry(2.6, 0.025, 16, 100);
        const ringMat2 = new THREE.MeshStandardMaterial({
          color: 0x00a2ff,
          emissive: 0x00a2ff,
          emissiveIntensity: 0.5,
          roughness: 0.2
        });
        const ringMesh2 = new THREE.Mesh(ringGeo2, ringMat2);
        ringMesh2.rotation.x = -Math.PI / 4;
        ringMesh2.rotation.z = Math.PI / 4;
        codexGroup.add(ringMesh2);

        // Swarm of Brand Particles (Blue, Cyan, Orange, Red)
        const particleCount = 240;
        const particleGeo = new THREE.BufferGeometry();
        const positions = new Float32Array(particleCount * 3);
        const colors = new Float32Array(particleCount * 3);

        const brandColors = [
          new THREE.Color(0x0056d6), // Brand Blue
          new THREE.Color(0x00a2ff), // Cyan
          new THREE.Color(0xff6a00), // Orange
          new THREE.Color(0xe61e2b)  // Crimson
        ];

        for (let i = 0; i < particleCount; i++) {
          const r = 2.2 + Math.random() * 2.8;
          const theta = Math.random() * Math.PI * 2;
          const phi = Math.acos((Math.random() * 2) - 1);

          positions[i * 3] = r * Math.sin(phi) * Math.cos(theta);
          positions[i * 3 + 1] = r * Math.sin(phi) * Math.sin(theta);
          positions[i * 3 + 2] = r * Math.cos(phi);

          const c = brandColors[i % brandColors.length];
          colors[i * 3] = c.r;
          colors[i * 3 + 1] = c.g;
          colors[i * 3 + 2] = c.b;
        }

        particleGeo.setAttribute('position', new THREE.BufferAttribute(positions, 3));
        particleGeo.setAttribute('color', new THREE.BufferAttribute(colors, 3));

        const particleMat = new THREE.PointsMaterial({
          size: 0.07,
          vertexColors: true,
          transparent: true,
          opacity: 0.85
        });
        const particleSystem = new THREE.Points(particleGeo, particleMat);
        codexGroup.add(particleSystem);

        // Lighting
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.7);
        scene.add(ambientLight);

        const pointLight1 = new THREE.PointLight(0x00a2ff, 2.5, 50);
        pointLight1.position.set(5, 5, 5);
        scene.add(pointLight1);

        const pointLight2 = new THREE.PointLight(0xff6a00, 2.0, 50);
        pointLight2.position.set(-5, -4, 3);
        scene.add(pointLight2);

        // Interactive Mouse Dragging & Hover
        let isDragging = false;
        let previousMousePosition = { x: 0, y: 0 };
        let mouseX = 0, mouseY = 0;

        heroCanvas.addEventListener('mousedown', (e) => {
          isDragging = true;
          previousMousePosition = { x: e.clientX, y: e.clientY };
        });

        window.addEventListener('mouseup', () => { isDragging = false; });

        window.addEventListener('mousemove', (e) => {
          const rect = heroCanvas.getBoundingClientRect();
          if (isDragging) {
            const deltaX = e.clientX - previousMousePosition.x;
            const deltaY = e.clientY - previousMousePosition.y;

            codexGroup.rotation.y += deltaX * 0.008;
            codexGroup.rotation.x += deltaY * 0.008;

            previousMousePosition = { x: e.clientX, y: e.clientY };
          } else {
            mouseX = (e.clientX - (rect.left + rect.width / 2)) * 0.0005;
            mouseY = (e.clientY - (rect.top + rect.height / 2)) * 0.0005;
          }
        });

        // Click-to-pulse wave animation
        heroCanvas.addEventListener('click', () => {
          coreMesh.scale.set(1.25, 1.25, 1.25);
          ringMesh1.scale.set(1.2, 1.2, 1.2);
          ringMesh2.scale.set(1.2, 1.2, 1.2);
        });

        // Resize handler
        window.addEventListener('resize', () => {
          if (heroCanvas.clientWidth && heroCanvas.clientHeight) {
            camera.aspect = heroCanvas.clientWidth / heroCanvas.clientHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(heroCanvas.clientWidth, heroCanvas.clientHeight);
          }
        });

        // Render Loop
        function animate() {
          requestAnimationFrame(animate);

          // Continuous graceful spin
          coreMesh.rotation.y += 0.006;
          coreMesh.rotation.x += 0.004;

          wireMesh.rotation.y -= 0.003;
          wireMesh.rotation.z += 0.004;

          ringMesh1.rotation.z += 0.012;
          ringMesh2.rotation.z -= 0.009;

          particleSystem.rotation.y += 0.002;
          particleSystem.rotation.x += 0.001;

          // Elastic recoil after click pulse
          coreMesh.scale.lerp(new THREE.Vector3(1, 1, 1), 0.08);
          ringMesh1.scale.lerp(new THREE.Vector3(1, 1, 1), 0.08);
          ringMesh2.scale.lerp(new THREE.Vector3(1, 1, 1), 0.08);

          // Mouse parallax tilt
          if (!isDragging) {
            codexGroup.rotation.y += (mouseX - codexGroup.rotation.y * 0.05) * 0.05;
            codexGroup.rotation.x += (mouseY - codexGroup.rotation.x * 0.05) * 0.05;
          }

          renderer.render(scene, camera);
        }
        animate();
      }

      // --- 2. MILESTONE STEPPER INTERACTION ---
      window.activateMilestone = function(element) {
        document.querySelectorAll('.milestone-item').forEach(item => item.classList.remove('active'));
        element.classList.add('active');
      };

      // --- 3. CONVERGING REACTOR SLIDER & CORE ---
      const reactorSlider = document.getElementById('reactorSlider');
      const missionPanel = document.getElementById('missionPanel');
      const visionPanel = document.getElementById('visionPanel');
      const convergenceOrb = document.getElementById('convergenceOrb');

      if (reactorSlider && missionPanel && visionPanel) {
        reactorSlider.addEventListener('input', (e) => {
          const val = parseInt(e.target.value, 10);
          const missionWeight = 1 - (val / 100);
          const visionWeight = val / 100;

          missionPanel.style.transform = `scale(${0.92 + missionWeight * 0.16}) translateX(${(1 - missionWeight) * 15}px)`;
          visionPanel.style.transform = `scale(${0.92 + visionWeight * 0.16}) translateX(${(1 - visionWeight) * -15}px)`;

          missionPanel.style.borderColor = `rgba(0, 162, 255, ${0.2 + missionWeight * 0.6})`;
          visionPanel.style.borderColor = `rgba(255, 106, 0, ${0.2 + visionWeight * 0.6})`;
        });
      }

      if (convergenceOrb && missionPanel && visionPanel) {
        convergenceOrb.addEventListener('click', () => {
          convergenceOrb.style.transform = 'scale(1.35) rotate(180deg)';
          missionPanel.style.transform = 'translateX(25px) scale(1.05)';
          visionPanel.style.transform = 'translateX(-25px) scale(1.05)';

          setTimeout(() => {
            convergenceOrb.style.transform = '';
            missionPanel.style.transform = '';
            visionPanel.style.transform = '';
          }, 600);
        });
      }

      // --- 4. HOLOGRAPHIC PROJECTOR PILLARS ---
      const pillarData = <?= json_encode($jsPillars, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;

      window.switchProjectorPillar = function(key) {
        if (!pillarData[key]) return;

        document.querySelectorAll('.projector-btn').forEach(btn => {
          btn.classList.toggle('active', btn.dataset.pillar === key);
        });

        const content = document.getElementById('holoContent');
        const data = pillarData[key];

        if (content) {
          content.classList.add('fading');

          setTimeout(() => {
            document.getElementById('holoTag').textContent = data.tag;
            document.getElementById('holoMetric').textContent = data.metric;
            document.getElementById('holoTitle').textContent = data.title;
            document.getElementById('holoDesc').textContent = data.desc;
            document.getElementById('holoStat1').textContent = data.stat1;
            document.getElementById('holoStat1Label').textContent = data.stat1Label;
            document.getElementById('holoStat2').textContent = data.stat2;
            document.getElementById('holoStat2Label').textContent = data.stat2Label;
            document.getElementById('holoStat3').textContent = data.stat3;
            document.getElementById('holoStat3Label').textContent = data.stat3Label;

            content.classList.remove('fading');
          }, 250);
        }
      };

      // --- 5. TEAM CONSTELLATION 2D/3D CANVAS ---
      const constCanvas = document.getElementById('constellation-canvas');
      if (constCanvas) {
        const ctx = constCanvas.getContext('2d');
        let width = constCanvas.width = constCanvas.offsetWidth;
        let height = constCanvas.height = constCanvas.offsetHeight;

        window.addEventListener('resize', () => {
          width = constCanvas.width = constCanvas.offsetWidth;
          height = constCanvas.height = constCanvas.offsetHeight;
        });

        const rawTeam = <?= json_encode($jsTeam, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
        const defaultPositions = [
          { rx: 0.28, ry: 0.35, vx: 0.3,  vy: -0.2,  radius: 10 },
          { rx: 0.65, ry: 0.25, vx: -0.25, vy: 0.35, radius: 9 },
          { rx: 0.78, ry: 0.68, vx: 0.2,  vy: -0.25, radius: 8 },
          { rx: 0.35, ry: 0.75, vx: -0.3,  vy: 0.2,   radius: 9 },
          { rx: 0.52, ry: 0.52, vx: 0.15, vy: 0.15,  radius: 12 }
        ];

        const teamNodes = [];
        const count = Math.max(rawTeam.length, defaultPositions.length);
        for (let i = 0; i < count; i++) {
          const tInfo = rawTeam[i] || rawTeam[i % rawTeam.length] || {};
          const pos = defaultPositions[i % defaultPositions.length];
          teamNodes.push({
            x: width * pos.rx,
            y: height * pos.ry,
            vx: pos.vx,
            vy: pos.vy,
            radius: pos.radius,
            title: tInfo.title || 'Technical Leader',
            specialty: tInfo.specialty || 'Engineering & Design',
            exp: tInfo.exp || '8+ Yrs',
            avatar: tInfo.avatar || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=120&h=120&fit=crop&crop=face'
          });
        }

        let mouse = { x: -1000, y: -1000 };

        constCanvas.addEventListener('mousemove', (e) => {
          const rect = constCanvas.getBoundingClientRect();
          mouse.x = e.clientX - rect.left;
          mouse.y = e.clientY - rect.top;

          teamNodes.forEach(node => {
            const dist = Math.hypot(node.x - mouse.x, node.y - mouse.y);
            if (dist < 40) {
              const titleEl = document.getElementById('nodeTitle');
              const specEl = document.getElementById('nodeSpecialty');
              const expEl = document.getElementById('nodeExperience');
              const avEl = document.getElementById('nodeAvatar');
              if (titleEl) titleEl.textContent = node.title;
              if (specEl) specEl.textContent = node.specialty;
              if (expEl) expEl.textContent = node.exp;
              if (avEl) avEl.src = node.avatar;
            }
          });
        });

        constCanvas.addEventListener('mouseleave', () => {
          mouse.x = -1000;
          mouse.y = -1000;
        });

        function renderConstellation() {
          ctx.clearRect(0, 0, width, height);

          teamNodes.forEach((node, i) => {
            node.x += node.vx;
            node.y += node.vy;

            if (node.x < 30 || node.x > width - 30) node.vx *= -1;
            if (node.y < 30 || node.y > height - 30) node.vy *= -1;

            for (let j = i + 1; j < teamNodes.length; j++) {
              const nodeB = teamNodes[j];
              const dist = Math.hypot(node.x - nodeB.x, node.y - nodeB.y);
              if (dist < 220) {
                const alpha = (1 - (dist / 220)) * 0.45;
                ctx.beginPath();
                ctx.moveTo(node.x, node.y);
                ctx.lineTo(nodeB.x, nodeB.y);
                ctx.strokeStyle = `rgba(0, 162, 255, ${alpha})`;
                ctx.lineWidth = 1.5;
                ctx.stroke();
              }
            }

            const mouseDist = Math.hypot(node.x - mouse.x, node.y - mouse.y);
            if (mouseDist < 180) {
              ctx.beginPath();
              ctx.moveTo(node.x, node.y);
              ctx.lineTo(mouse.x, mouse.y);
              ctx.strokeStyle = `rgba(255, 106, 0, ${(1 - mouseDist / 180) * 0.7})`;
              ctx.lineWidth = 2;
              ctx.stroke();
            }

            ctx.beginPath();
            ctx.arc(node.x, node.y, node.radius + (mouseDist < 40 ? 4 : 0), 0, Math.PI * 2);
            ctx.fillStyle = i === teamNodes.length - 1 ? '#ff6a00' : '#00a2ff';
            ctx.shadowColor = i === teamNodes.length - 1 ? '#ff6a00' : '#00a2ff';
            ctx.shadowBlur = 15;
            ctx.fill();
            ctx.shadowBlur = 0;
          });

          requestAnimationFrame(renderConstellation);
        }
        renderConstellation();
      }

      // --- 6. FOCUS ACCORDION CARDS ---
      window.activateFocusCard = function(element) {
        document.querySelectorAll('.focus-card').forEach(card => card.classList.remove('active'));
        element.classList.add('active');
      };

      // --- 7. FLUID RIPPLE CANVAS ---
      const rippleCanvas = document.getElementById('ripple-canvas');
      if (rippleCanvas) {
        const rCtx = rippleCanvas.getContext('2d');
        let rWidth = rippleCanvas.width = rippleCanvas.offsetWidth;
        let rHeight = rippleCanvas.height = rippleCanvas.offsetHeight;

        window.addEventListener('resize', () => {
          rWidth = rippleCanvas.width = rippleCanvas.offsetWidth;
          rHeight = rippleCanvas.height = rippleCanvas.offsetHeight;
        });

        const ripples = [];

        function createRipple(x, y) {
          ripples.push({
            x: x,
            y: y,
            radius: 5,
            maxRadius: 180 + Math.random() * 80,
            opacity: 0.65,
            speed: 3 + Math.random() * 2,
            color: Math.random() > 0.5 ? '0, 86, 214' : '255, 106, 0'
          });
        }

        rippleCanvas.addEventListener('mousemove', (e) => {
          if (Math.random() < 0.25) {
            const rect = rippleCanvas.getBoundingClientRect();
            createRipple(e.clientX - rect.left, e.clientY - rect.top);
          }
        });

        rippleCanvas.addEventListener('click', (e) => {
          const rect = rippleCanvas.getBoundingClientRect();
          createRipple(e.clientX - rect.left, e.clientY - rect.top);
          createRipple(e.clientX - rect.left, e.clientY - rect.top);
        });

        function animateRipples() {
          rCtx.clearRect(0, 0, rWidth, rHeight);

          for (let i = ripples.length - 1; i >= 0; i--) {
            const r = ripples[i];
            r.radius += r.speed;
            r.opacity -= 0.012;

            if (r.opacity <= 0 || r.radius >= r.maxRadius) {
              ripples.splice(i, 1);
              continue;
            }

            rCtx.beginPath();
            rCtx.arc(r.x, r.y, r.radius, 0, Math.PI * 2);
            rCtx.strokeStyle = `rgba(${r.color}, ${r.opacity})`;
            rCtx.lineWidth = 2.2;
            rCtx.stroke();
          }

          requestAnimationFrame(animateRipples);
        }
        animateRipples();
      }

    });
  </script>

<?php
include __DIR__ . '/layout/footer.php';
?>
