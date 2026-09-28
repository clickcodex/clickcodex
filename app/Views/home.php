<?php
/**
 * ClickCodex Technologies - Dynamic Home Page View
 * Designed with 100% exact fidelity to storage/Frontend/index.html
 * Backed by clickcodex_db database records
 */
declare(strict_types=1);

include __DIR__ . '/layout/header.php';
?>

  <main>
    <!-- ==========================================================================
         2. HERO SECTION WITH 3D CANVAS & INTERACTIVE CARDS
         ========================================================================== -->
    <section class="hero-section" id="hero">
      <!-- 3D Halftone Wave Canvas Background (test10.html inspired) -->
      <canvas id="hero-wave-canvas"></canvas>
      
      <!-- Ambient Visual Glows -->
      <div class="ambient-glow-1"></div>
      <div class="ambient-glow-2"></div>

      <div class="container" style="position: relative; z-index: 2;">
        <div class="hero-grid">
          <!-- Hero Copywriting & CTAs -->
          <div class="hero-content">
            <div class="hero-badge-wrap">
              <span class="star-tag">Agile Startup</span>
              <span class="text"><?= htmlspecialchars($sections['hero']['badge_text'] ?? 'Early-Stage Technology & Creative Studio') ?></span>
            </div>

            <h1 class="hero-headline">
              Build. Grow.<br />
              <span class="animated-word-box" id="animatedHeroWord">Succeed.</span>
            </h1>

            <p class="hero-description">
              <?= htmlspecialchars($sections['hero']['subtitle'] ?? 'We design and develop clean responsive websites, practical web applications, and engaging short-form video reels that help growing businesses succeed online.') ?>
            </p>

            <div class="hero-cta-group">
              <button class="btn-primary" onclick="openConsultationModal('Hero Primary CTA')">
                <span><?= htmlspecialchars($sections['hero']['cta_primary_text'] ?? 'Start Your Project') ?></span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                  <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
              </button>

              <a href="<?= BASE_URL ?>/services" class="btn-outline">
                <span><?= htmlspecialchars($sections['hero']['cta_secondary_text'] ?? 'Explore Capabilities') ?></span>
              </a>
            </div>

            <!-- Startup Focus Strip -->
            <div class="hero-trust-row">
              <div class="trust-badge-icon" style="width: 42px; height: 42px; border-radius: 12px; background: rgba(0, 86, 214, 0.1); display: flex; align-items: center; justify-content: center; color: var(--brand-blue); flex-shrink: 0;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
              </div>
              <div class="trust-text">
                <strong>Focused 4-Member Collaborative Pod</strong>
                ~2 Years Hands-On Tech Experience • Direct Collaboration
              </div>
            </div>
          </div>

          <!-- Hero 3D Card Visual with 3D Tilt & Floating Badges -->
          <div class="hero-visual-3d" id="hero3DContainer">
            <!-- 3D Floating Badge 1 (Top Left) -->
            <div class="float-badge badge-top-left">
              <div class="badge-icon blue">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
              </div>
              <div class="badge-text">
                <h4>Clean Code & Design</h4>
                <p>100% Responsive & Modern</p>
              </div>
            </div>

            <!-- Main Interactive 3D Showcase Card -->
            <div class="main-3d-card" id="mainTiltCard">
              <div class="card-preview-window">
                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1200&auto=format&fit=crop" 
                     alt="Click Codex Digital Project Showcase" 
                     class="card-preview-img" 
                     id="heroDisplayImage" />
                <div class="card-preview-overlay">
                  <span class="preview-badge" id="heroBadgeLabel">Creative Experience</span>
                  <h3 class="preview-title" id="heroDisplayTitle">Practical Digital Solutions Crafted for Steady Business Growth</h3>
                </div>
              </div>
            </div>

            <!-- 3D Floating Badge 2 (Bottom Right) -->
            <div class="float-badge badge-bottom-right">
              <div class="badge-icon orange">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="12" y1="19" x2="12" y2="5"></line>
                  <polyline points="5 12 12 5 19 12"></polyline>
                </svg>
              </div>
              <div class="badge-text">
                <h4>Agile Delivery Pod</h4>
                <p>Direct Developer Access</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Hero 3-Step Interactive Mode Switcher -->
        <div class="hero-modes-wrapper">
          <div class="hero-modes-tabs">
            <div class="mode-tab active" data-mode="0" onclick="switchHeroMode(0)">
              <span class="mode-tab-num">01</span>
              <div class="mode-tab-info">
                <h4>Creative & UI/UX</h4>
                <p>Figma, Web Layouts & Brand Identity</p>
              </div>
            </div>

            <div class="mode-tab" data-mode="1" onclick="switchHeroMode(1)">
              <span class="mode-tab-num">02</span>
              <div class="mode-tab-info">
                <h4>Web & Full-Stack</h4>
                <p>Responsive Websites, PHP & MySQL</p>
              </div>
            </div>

            <div class="mode-tab" data-mode="2" onclick="switchHeroMode(2)">
              <span class="mode-tab-num">03</span>
              <div class="mode-tab-info">
                <h4>Media & Marketing</h4>
                <p>Reel Shooting, Video & Creatives</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         3. LOGO MARQUEE (CORE COMPETENCIES & TECH STACK)
         ========================================================================== -->
    <section class="brand-marquee-section">
      <div class="marquee-label"><?= htmlspecialchars($sections['brand_marquee']['title'] ?? 'OUR CORE CAPABILITIES & TECHNOLOGY STACK') ?></div>
      <div class="marquee-track">
        <?php 
        $capabilitiesList = [
            'FULL-STACK WEB DEVELOPMENT',
            'RESPONSIVE WEBSITES',
            'PHP & MYSQL',
            'MODERN JAVASCRIPT',
            'UI/UX & FIGMA DESIGN',
            'GRAPHIC & LOGO DESIGN',
            'DIGITAL MARKETING',
            'PROFESSIONAL REEL SHOOTING',
            'SHORT-FORM VIDEO PRODUCTION',
            '100% CODE OWNERSHIP'
        ];
        ?>
        <?php foreach ($capabilitiesList as $cap): ?>
          <div class="marquee-item"><span class="marquee-logo-badge"><?= htmlspecialchars($cap) ?></span></div>
        <?php endforeach; ?>
        <!-- Duplicated for seamless infinite loop -->
        <?php foreach ($capabilitiesList as $cap): ?>
          <div class="marquee-item"><span class="marquee-logo-badge"><?= htmlspecialchars($cap) ?></span></div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- ==========================================================================
         4. ABOUT US & CAPABILITIES SECTION (FROM TEST2.HTML)
         ========================================================================== -->
    <section class="about-section" id="about">
      <div class="watermark-bg">CLICKCODEX</div>
      <div class="container">
        <div class="section-header-center">
          <div class="section-pill">
            <span class="pulse-dot"></span>
            <span><?= htmlspecialchars($sections['about_pillars']['badge_text'] ?? 'About Click Codex') ?></span>
          </div>
          <h2 class="section-title"><?= htmlspecialchars($sections['about_pillars']['title'] ?? 'What Click Codex Brings To Your Table') ?></h2>
          <p class="section-subtitle">
            <?= htmlspecialchars($sections['about_pillars']['subtitle'] ?? 'We merge responsive design with clean development and video storytelling to help businesses build a credible digital presence.') ?>
          </p>
        </div>

        <div class="about-content-grid">
          <!-- Left Navigation Tabs -->
          <ul class="about-nav-list">
            <li class="about-nav-item active" data-tab="client" onclick="switchAboutTab('client')">
              <span>Client-First Focus</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </li>
            <li class="about-nav-item" data-tab="experience" onclick="switchAboutTab('experience')">
              <span>Practical Experience</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </li>
            <li class="about-nav-item" data-tab="team" onclick="switchAboutTab('team')">
              <span>Collaborative Team</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </li>
            <li class="about-nav-item" data-tab="showcase" onclick="switchAboutTab('showcase')">
              <span>Building Our Portfolio</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </li>
          </ul>

          <!-- Right Display Panel -->
          <div class="about-display-panel">
            <div class="about-text-wrap" id="aboutTextContainer">
              <span class="about-category-tag" id="aboutCategory">Client First Philosophy</span>
              <h3 class="about-title" id="aboutTitle">Dedicated Attention & Practical Digital Solutions</h3>
              <p class="about-desc" id="aboutDescription">
                As an early-stage startup, every single project receives our full dedication. We work closely with founders and business owners to design and build websites, apps, and digital campaigns that directly achieve your business goals.
              </p>
              <div class="about-metrics-row">
                <div class="metric-box">
                  <h3 id="aboutMetric1">100%</h3>
                  <p id="aboutMetric1Label">Dedicated Focus</p>
                </div>
                <div class="metric-box">
                  <h3 id="aboutMetric2">Direct</h3>
                  <p id="aboutMetric2Label">Team Collaboration</p>
                </div>
                <div class="metric-box">
                  <h3 id="aboutMetric3">Agile</h3>
                  <p id="aboutMetric3Label">Fast Sprints</p>
                </div>
              </div>
            </div>

            <div class="about-image-wrap">
              <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=800&q=80" 
                   alt="Click Codex Team Collaboration & Digital Engineering" 
                   loading="lazy"
                   decoding="async"
                   id="aboutDisplayImage" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         5. CORE SERVICES SECTION WITH 3D TILT
         ========================================================================== -->
    <section class="services-section" id="services">
      <div class="container">
        <div class="section-header-center">
          <div class="section-pill">
            <span class="pulse-dot"></span>
            <span><?= htmlspecialchars($sections['core_services']['badge_text'] ?? 'Comprehensive Solutions') ?></span>
          </div>
          <h2 class="section-title"><?= htmlspecialchars($sections['core_services']['title'] ?? 'End-to-End Digital Services') ?></h2>
          <p class="section-subtitle">
            <?= htmlspecialchars($sections['core_services']['subtitle'] ?? 'Whether launching from scratch or modernizing an existing enterprise, our full-stack service suite covers all technical and creative needs.') ?>
          </p>
        </div>

        <div class="services-grid">
          <?php 
          // Icon SVGs mapped by service index
          $serviceIcons = [
              0 => '<rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line>',
              1 => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>',
              2 => '<rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line>',
              3 => '<circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>',
              4 => '<circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39A2 2 0 0 0 9.62 16H19a2 2 0 0 0 1.97-1.64L23 6H6"></path>',
              5 => '<path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"></path>'
          ];
          
          foreach ($services as $idx => $s):
              $iconSvg = $serviceIcons[$idx] ?? $serviceIcons[0];
          ?>
          <div class="service-card-3d" data-tilt>
            <div class="service-icon-box">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <?= $iconSvg ?>
              </svg>
            </div>
            <h3 class="service-title"><?= htmlspecialchars($s['title']) ?></h3>
            <p class="service-desc">
              <?= htmlspecialchars($s['short_description']) ?>
            </p>
            <ul class="service-features-list">
              <?php if (!empty($s['key_deliverables'])): ?>
                <?php foreach ($s['key_deliverables'] as $deliv): ?>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg> <?= htmlspecialchars($deliv) ?></li>
                <?php endforeach; ?>
              <?php else: ?>
                <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg> Enterprise Grade Architecture</li>
                <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg> 99+ Core Web Vitals Guaranteed</li>
                <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg> 100% IP & Source Ownership</li>
              <?php endif; ?>
            </ul>
            <div class="service-card-footer">
              <a href="javascript:void(0)" class="service-link" onclick="openConsultationModal('<?= addslashes($s['title']) ?>')">
                <span>Request Details</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
              </a>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <div style="text-align: center; margin-top: 40px;">
          <button class="btn-primary" onclick="openConsultationModal('Full Services Suite')">
            <span>Explore Custom Package</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
          </button>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         6. STACKING PROCESS SECTION (5-STEP BLUEPRINT)
         ========================================================================== -->
    <section class="process-section" id="process">
      <div class="container">
        <div class="section-header-center">
          <div class="section-pill">
            <span class="pulse-dot"></span>
            <span><?= htmlspecialchars($sections['process_blueprint']['badge_text'] ?? 'How We Work') ?></span>
          </div>
          <h2 class="section-title"><?= htmlspecialchars($sections['process_blueprint']['title'] ?? 'Our 5-Step Execution Blueprint') ?></h2>
          <p class="section-subtitle">
            <?= htmlspecialchars($sections['process_blueprint']['subtitle'] ?? 'A transparent, agile workflow that ensures your project is delivered on schedule, within budget, and with zero guesswork.') ?>
          </p>
        </div>

        <div class="process-layout-grid">
          <!-- Sticky Navigation Indicator -->
          <nav class="process-sticky-nav">
            <div class="process-nav-list">
              <div class="process-step-nav-item active" data-step-id="process-card-1" onclick="scrollToStep('process-card-1')">
                1. Discovery & Needs
              </div>
              <div class="process-step-nav-item" data-step-id="process-card-2" onclick="scrollToStep('process-card-2')">
                2. Strategic Architecture
              </div>
              <div class="process-step-nav-item" data-step-id="process-card-3" onclick="scrollToStep('process-card-3')">
                3. Agile Development
              </div>
              <div class="process-step-nav-item" data-step-id="process-card-4" onclick="scrollToStep('process-card-4')">
                4. Quality & Launch
              </div>
              <div class="process-step-nav-item" data-step-id="process-card-5" onclick="scrollToStep('process-card-5')">
                5. 24/7 Support & Growth
              </div>
            </div>
          </nav>

          <!-- 3D Stacking Cards Container -->
          <div class="process-cards-stack">
            <!-- Step 1 -->
            <div class="stack-card" id="process-card-1">
              <div class="stack-step-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
              </div>
              <div class="stack-content">
                <span class="stack-number-badge">Step 01</span>
                <h3 class="stack-title">Discovery & Needs Analysis</h3>
                <p class="stack-desc">
                  We deep-dive into your business goals, target demographic, competitor landscape, and technical constraints to establish a bulletproof roadmap.
                </p>
              </div>
              <div class="stack-bg-watermark">01</div>
            </div>

            <!-- Step 2 -->
            <div class="stack-card" id="process-card-2">
              <div class="stack-step-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
              </div>
              <div class="stack-content">
                <span class="stack-number-badge">Step 02</span>
                <h3 class="stack-title">Strategic Architecture & UI/UX</h3>
                <p class="stack-desc">
                  We craft interactive wireframes, clickable user journeys, and technical database models, giving you a full visual preview before a single line of code is written.
                </p>
              </div>
              <div class="stack-bg-watermark">02</div>
            </div>

            <!-- Step 3 -->
            <div class="stack-card" id="process-card-3">
              <div class="stack-step-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
              </div>
              <div class="stack-content">
                <span class="stack-number-badge">Step 03</span>
                <h3 class="stack-title">Agile Full-Stack Development</h3>
                <p class="stack-desc">
                  Our engineering team constructs your solution with clean, documented code and modern frameworks. Bi-weekly demos keep you informed of real progress at all times.
                </p>
              </div>
              <div class="stack-bg-watermark">03</div>
            </div>

            <!-- Step 4 -->
            <div class="stack-card" id="process-card-4">
              <div class="stack-step-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 14 14"></polyline></svg>
              </div>
              <div class="stack-content">
                <span class="stack-number-badge">Step 04</span>
                <h3 class="stack-title">Rigorous QA & Production Launch</h3>
                <p class="stack-desc">
                  We conduct cross-device testing, security penetration audits, speed optimization, and SEO checklist validation before deploying seamlessly to your live domain.
                </p>
              </div>
              <div class="stack-bg-watermark">04</div>
            </div>

            <!-- Step 5 -->
            <div class="stack-card" id="process-card-5">
              <div class="stack-step-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
              </div>
              <div class="stack-content">
                <span class="stack-number-badge">Step 05</span>
                <h3 class="stack-title">24/7 Dedicated Support & Growth</h3>
                <p class="stack-desc">
                  We don't abandon you after launch. We provide ongoing security patches, server monitoring, feature updates, and digital marketing optimizations to scale your results.
                </p>
              </div>
              <div class="stack-bg-watermark">05</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         7. INTERACTIVE PORTFOLIO CANVAS (CASE STUDIES)
         ========================================================================== -->
    <section class="portfolio-section" id="portfolio">
      <div class="container">
        <div class="section-header-center">
          <div class="section-pill">
            <span class="pulse-dot"></span>
            <span><?= htmlspecialchars($sections['case_study_showcase']['badge_text'] ?? 'Our Showcase') ?></span>
          </div>
          <h2 class="section-title"><?= htmlspecialchars($sections['case_study_showcase']['title'] ?? 'Explore What We Have Built') ?></h2>
          <p class="section-subtitle">
            <?= htmlspecialchars($sections['case_study_showcase']['subtitle'] ?? 'Take a look at our featured showcase projects across website development, custom web applications, and creative digital media.') ?>
          </p>
        </div>

        <div class="portfolio-layout-grid">
          <!-- Left Navigation List -->
          <div class="portfolio-nav-list" id="portfolioNavList">
            <div class="portfolio-line-tracker" id="portfolioLineTracker"></div>

            <?php foreach ($caseStudies as $idx => $cs): 
              $isActive = ($idx === 0) ? 'active' : '';
              $resultLabel = $cs['result_badge'] ?? 'Showcase Project';
            ?>
            <div class="portfolio-item <?= $isActive ?>" 
                 data-img="<?= htmlspecialchars($cs['featured_image']) ?>"
                 data-title="<?= htmlspecialchars($cs['title']) ?>"
                 data-tag="<?= htmlspecialchars($cs['sector_industry']) ?>"
                 data-desc="<?= htmlspecialchars($cs['excerpt']) ?>"
                 data-result="<?= htmlspecialchars($resultLabel) ?>"
                 onmouseenter="activatePortfolioItem(this)">
              <div class="portfolio-item-tag"><?= htmlspecialchars($cs['sector_industry']) ?></div>
              <h3 class="portfolio-item-title"><?= htmlspecialchars($cs['client_name']) ?></h3>
              <p class="portfolio-item-desc">
                <?= htmlspecialchars($cs['excerpt']) ?>
              </p>
              <div class="portfolio-item-result">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                <span><?= htmlspecialchars($resultLabel) ?></span>
              </div>
            </div>
            <?php endforeach; ?>
          </div>

          <!-- Right Canvas Showcase Window -->
          <?php $firstCs = $caseStudies[0] ?? null; ?>
          <div class="portfolio-canvas-wrap">
            <img src="<?= htmlspecialchars($firstCs['featured_image'] ?? 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=1000&q=80') ?>" 
                 alt="<?= htmlspecialchars($firstCs['title'] ?? 'Click Codex Project Showcase') ?>" 
                 loading="lazy"
                 decoding="async"
                 class="portfolio-canvas-img active" 
                 id="portfolioCanvasImage" />
            <div class="portfolio-canvas-info">
              <span class="preview-badge" id="portfolioCanvasTag"><?= htmlspecialchars($firstCs['sector_industry'] ?? 'Website Development') ?></span>
              <h3 id="portfolioCanvasTitle"><?= htmlspecialchars($firstCs['title'] ?? 'Jewelry Business Website') ?></h3>
              <p id="portfolioCanvasDesc"><?= htmlspecialchars($firstCs['excerpt'] ?? 'An elegant, responsive showcase website crafted for a jewelry business, highlighting product collections, refined aesthetics, and mobile-friendly browsing.') ?></p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         8. WHY BUSINESSES CHOOSE CLICK CODEX & OUR COMMITMENTS
         ========================================================================== -->
    <section class="why-us-section" id="why-us">
      <div class="container">
        <div class="why-us-grid">
          <!-- Left Content: Trust Pillars from company_values -->
          <div>
            <div class="section-pill">
              <span class="pulse-dot"></span>
              <span><?= htmlspecialchars($sections['why_us_edge']['badge_text'] ?? 'The Click Codex Standard') ?></span>
            </div>
            <h2 class="section-title"><?= htmlspecialchars($sections['why_us_edge']['title'] ?? 'Why Work With Click Codex') ?></h2>
            <p class="section-subtitle">
              <?= htmlspecialchars($sections['why_us_edge']['subtitle'] ?? 'We eliminate the usual headaches of working with digital agencies. Direct collaboration, transparent milestones, clean code, and zero unnecessary overhead.') ?>
            </p>

            <div class="benefits-list">
              <div class="benefit-item">
                <div class="benefit-icon-badge">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </div>
                <div class="benefit-text">
                  <h4>Transparent Pricing & 100% IP Ownership</h4>
                  <p>Clear sprint milestones in INR & USD. You own 100% of your code, designs, and digital assets from day one.</p>
                </div>
              </div>

              <div class="benefit-item">
                <div class="benefit-icon-badge">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </div>
                <div class="benefit-text">
                  <h4>Practical Turnaround in Weeks</h4>
                  <p>Our agile sprint structure ensures working prototypes, clear review checkpoints, and prompt project completions.</p>
                </div>
              </div>

              <div class="benefit-item">
                <div class="benefit-icon-badge">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </div>
                <div class="benefit-text">
                  <h4>Direct Access to the 4-Member Team</h4>
                  <p>Direct communication via WhatsApp or Google Meet. No sales middlemen—speak directly with the builders.</p>
                </div>
              </div>

              <div class="benefit-item">
                <div class="benefit-icon-badge">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </div>
                <div class="benefit-text">
                  <h4>Building For Long-Term Partnership</h4>
                  <p>As a growing startup, we treat your project as our priority, focused on building our reputation through your success.</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Right Content: 3D Cylindrical Carousel (Client Testimonials or Core Philosophy) -->
          <div class="testimonial-carousel-wrap">
            <div class="carousel-3d-stage">
              <?php if (!empty($testimonials)): ?>
                <?php foreach ($testimonials as $t): ?>
                <div class="testimonial-3d-card">
                  <div class="testimonial-stars">★★★★★</div>
                  <p class="testimonial-quote">
                    "<?= htmlspecialchars($t['testimonial_quote']) ?>"
                  </p>
                  <div class="testimonial-user">
                    <img src="<?= htmlspecialchars($t['client_avatar']) ?>" alt="<?= htmlspecialchars($t['client_name']) ?> Avatar" loading="lazy" decoding="async" class="user-avatar" />
                    <div class="user-info">
                      <h5><?= htmlspecialchars($t['client_name']) ?></h5>
                      <p><?= htmlspecialchars($t['client_position']) ?>, <?= htmlspecialchars($t['client_company']) ?></p>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div class="testimonial-3d-card">
                  <div class="testimonial-stars" style="color: var(--brand-blue); font-size: 0.85rem; letter-spacing: 1px;">✦ DEDICATED FOCUS</div>
                  <p class="testimonial-quote">
                    "Every project is our top priority. We approach your requirements with meticulous craft, clean code, and fast communication."
                  </p>
                  <div class="testimonial-user">
                    <div class="user-avatar" style="background: var(--brand-blue); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; border-radius: 50%;">CC</div>
                    <div class="user-info">
                      <h5>Click Codex Promise</h5>
                      <p>Dedicated 4-Member Pod</p>
                    </div>
                  </div>
                </div>
                <div class="testimonial-3d-card">
                  <div class="testimonial-stars" style="color: var(--brand-orange); font-size: 0.85rem; letter-spacing: 1px;">✦ ASSET OWNERSHIP</div>
                  <p class="testimonial-quote">
                    "Zero lock-in. You receive full ownership of your source code, design master files, and project assets upon completion."
                  </p>
                  <div class="testimonial-user">
                    <div class="user-avatar" style="background: var(--brand-orange); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; border-radius: 50%;">IP</div>
                    <div class="user-info">
                      <h5>100% Client Owned</h5>
                      <p>Clean Code & Design Files</p>
                    </div>
                  </div>
                </div>
                <div class="testimonial-3d-card">
                  <div class="testimonial-stars" style="color: var(--brand-blue); font-size: 0.85rem; letter-spacing: 1px;">✦ PRACTICAL GROWTH</div>
                  <p class="testimonial-quote">
                    "We build solutions tailored to your real business needs—ensuring responsive speed, mobile clarity, and steady digital growth."
                  </p>
                  <div class="testimonial-user">
                    <div class="user-avatar" style="background: var(--brand-cyan); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; border-radius: 50%;">03</div>
                    <div class="user-info">
                      <h5>Practical Results</h5>
                      <p>Web, Design & Video Media</p>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         8.5 LATEST TECHNICAL INSIGHTS & BLOGS (LIGHT THEME)
         ========================================================================== -->
    <section class="home-insights-section" id="insights">
      <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto 50px;">
          <div class="preview-badge" style="margin-bottom: 16px;">
            <span class="preview-pulse"></span>
            <span><?= htmlspecialchars($sections['tech_dispatch']['badge_text'] ?? 'ClickCodex Tech Dispatch') ?></span>
          </div>
          <h2 style="font-family: var(--font-display); font-size: clamp(2rem, 3.5vw, 2.8rem); font-weight: 800; color: var(--text-dark); line-height: 1.2; margin-bottom: 16px;">
            Ideas, Research & <span style="background: var(--gradient-logo-ribbon); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Engineering Insights</span>
          </h2>
          <p style="font-size: 1.1rem; color: var(--text-muted); line-height: 1.7;">
            <?= htmlspecialchars($sections['tech_dispatch']['subtitle'] ?? 'Deep architectural breakdowns, benchmarks, AI systems engineering, and design system philosophy from the ClickCodex engineering team.') ?>
          </p>
        </div>

        <div class="home-blog-grid">
          <?php foreach ($latestPosts as $post): ?>
          <article class="home-blog-card">
            <div class="home-blog-top">
              <span class="home-blog-chip" style="color: <?= htmlspecialchars($post['badge_color'] ?? '#0056d6') ?>; background: <?= htmlspecialchars($post['badge_bg'] ?? 'rgba(0,86,214,0.08)') ?>; border: 1px solid rgba(0,86,214,0.2);">
                <?= htmlspecialchars($post['category_name']) ?>
              </span>
              <span class="home-blog-meta"><?= (int)$post['reading_time_minutes'] ?> min read • <?= date('M d, Y', strtotime($post['published_at'])) ?></span>
            </div>
            <h3 class="home-blog-title">
              <a href="<?= BASE_URL ?>/blogs/<?= htmlspecialchars($post['slug']) ?>"><?= htmlspecialchars($post['title']) ?></a>
            </h3>
            <p class="home-blog-summary">
              <?= htmlspecialchars($post['excerpt']) ?>
            </p>
            <div class="home-blog-footer">
              <div class="home-blog-author">
                <div class="home-author-avatar" style="background: <?= htmlspecialchars($post['badge_color'] ?? '#0056d6') ?>;"><?= htmlspecialchars($post['author_initials'] ?? 'CC') ?></div>
                <div class="home-author-info">
                  <strong><?= htmlspecialchars($post['author_name']) ?></strong>
                  <span><?= htmlspecialchars($post['author_role']) ?></span>
                </div>
              </div>
              <a href="<?= BASE_URL ?>/blogs/<?= htmlspecialchars($post['slug']) ?>" class="home-blog-read-btn">Read Deep Dive &rarr;</a>
            </div>
          </article>
          <?php endforeach; ?>
        </div>

        <div style="text-align: center; margin-top: 50px;">
          <a href="<?= BASE_URL ?>/blogs" class="btn-primary" style="padding: 16px 36px; font-size: 1.05rem;">
            <span>Explore All Engineering Articles & Research</span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
          </a>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         9. HIGH-CONVERTING CTA BANNER
         ========================================================================== -->
    <section class="cta-banner-section" id="contact">
      <div class="container">
        <div class="cta-banner-card">
          <div class="cta-ambient-blob"></div>

          <div class="cta-content-box">
            <span class="cta-badge"><?= htmlspecialchars($sections['cta_banner']['badge_text'] ?? "Let's Build Something Extraordinary") ?></span>
            <h2 class="cta-title"><?= htmlspecialchars($sections['cta_banner']['title'] ?? 'Ready To Turn Your Digital Vision Into Reality?') ?></h2>
            <p class="cta-subheading">
              <?= htmlspecialchars($sections['cta_banner']['subtitle'] ?? 'Talk directly with our lead architects today. Get a transparent scope, realistic timeline, and accurate cost estimate within 24 hours.') ?>
            </p>

            <div class="cta-btn-group">
              <button class="magnetic-btn light" onclick="openConsultationModal('CTA Banner')">
                <span><?= htmlspecialchars($sections['cta_banner']['cta_primary_text'] ?? 'Get a Free Project Quote') ?></span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
              </button>

              <?php 
                $ctaPhone = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '919876543210');
                $ctaMsg = urlencode($settings['whatsapp_default_message'] ?? "Hi ClickCodex, I'd like to discuss a new project");
              ?>
              <a href="https://wa.me/<?= $ctaPhone ?>?text=<?= $ctaMsg ?>" 
                 target="_blank" rel="noopener noreferrer" class="magnetic-btn whatsapp">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.698.077-1.118-.057-.26-.084-.589-.201-.989-.374-1.745-.758-2.887-2.531-2.975-2.648-.088-.116-.71-0.947-.71-1.807 0-.859.45-1.282.61-1.458.16-.176.35-.22.47-.22.12 0 .24.002.34.007.11.005.26-.042.41.319.15.362.51 1.242.55 1.33.04.088.07.191.01.308-.06.117-.09.19-.18.293-.09.103-.19.23-.27.309-.09.088-.19.183-.08.371.11.188.48.793 1.03 1.283.71.633 1.31.829 1.49.919.18.09.29.076.4-.047.11-.123.47-.549.6-.738.13-.189.26-.158.44-.092.18.066 1.14.537 1.34.636.2.099.33.147.38.232.05.085.05.495-.09.9z"/>
                </svg>
                <span><?= htmlspecialchars($sections['cta_banner']['cta_secondary_text'] ?? 'Instant WhatsApp Call') ?></span>
              </a>
            </div>

            <div class="cta-guarantee-text">
              <span>🔒 100% Confidential NDA</span>
              <span>⚡ Response under 2 hours</span>
              <span>💡 Free Initial Architecture Review</span>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- ==========================================================================
       HOMEPAGE SPECIFIC JAVASCRIPT
       ========================================================================== -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {

      // --- 3. DYNAMIC HERO WORD ROTATION ---
      const dynamicWords = ['Succeed.', 'Innovate.', 'Dominate.', 'Scale.'];
      let wordIndex = 0;
      const wordElement = document.getElementById('animatedHeroWord');

      if (wordElement) {
        setInterval(() => {
          wordIndex = (wordIndex + 1) % dynamicWords.length;
          wordElement.style.opacity = '0';
          wordElement.style.transform = 'translateY(15px)';

          setTimeout(() => {
            wordElement.textContent = dynamicWords[wordIndex];
            wordElement.style.opacity = '1';
            wordElement.style.transform = 'translateY(0)';
          }, 300);
        }, 3000);
      }

      // --- 4. HERO 3-STEP MODE SWITCHER ---
      const heroModes = [
        {
          badge: 'Creative Experience',
          title: 'High-Impact Digital Solutions Crafted for Rapid Market Growth',
          image: 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1200&auto=format&fit=crop'
        },
        {
          badge: 'Technology Made',
          title: 'Scalable Full-Stack Web & Mobile Architecture for High Volume',
          image: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1200&auto=format&fit=crop'
        },
        {
          badge: 'Hire Dedicated Team',
          title: 'Elite Indian Tech Talent Dedicated Exclusively to Your Project',
          image: 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1200&auto=format&fit=crop'
        }
      ];

      window.switchHeroMode = function(index) {
        document.querySelectorAll('.mode-tab').forEach((tab, i) => {
          tab.classList.toggle('active', i === index);
        });

        const heroImg = document.getElementById('heroDisplayImage');
        const heroBadge = document.getElementById('heroBadgeLabel');
        const heroTitle = document.getElementById('heroDisplayTitle');

        if (heroImg && heroBadge && heroTitle) {
          heroImg.style.opacity = '0.3';
          heroImg.style.transform = 'scale(0.97)';

          setTimeout(() => {
            const item = heroModes[index];
            heroImg.src = item.image;
            heroBadge.textContent = item.badge;
            heroTitle.textContent = item.title;
            heroImg.style.opacity = '1';
            heroImg.style.transform = 'scale(1)';
          }, 250);
        }
      };

      // --- 5. 3D CARD TILT INTERACTION ---
      const tiltCards = document.querySelectorAll('[data-tilt]');
      tiltCards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
          const rect = card.getBoundingClientRect();
          const x = e.clientX - rect.left;
          const y = e.clientY - rect.top;
          const centerX = rect.width / 2;
          const centerY = rect.height / 2;

          const rotateX = ((y - centerY) / centerY) * -8;
          const rotateY = ((x - centerX) / centerX) * 8;

          card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px)`;
        });

        card.addEventListener('mouseleave', () => {
          card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
        });
      });

      // Hero Main Tilt Container
      const heroTiltCard = document.getElementById('mainTiltCard');
      const heroContainer = document.getElementById('hero3DContainer');
      if (heroTiltCard && heroContainer) {
        heroContainer.addEventListener('mousemove', (e) => {
          const rect = heroContainer.getBoundingClientRect();
          const x = e.clientX - rect.left;
          const y = e.clientY - rect.top;
          const centerX = rect.width / 2;
          const centerY = rect.height / 2;

          const rotateX = ((y - centerY) / centerY) * -10;
          const rotateY = ((x - centerX) / centerX) * 10;

          heroTiltCard.style.transform = `rotateY(${rotateY}deg) rotateX(${rotateX}deg) translateY(-6px)`;
        });

        heroContainer.addEventListener('mouseleave', () => {
          heroTiltCard.style.transform = 'rotateY(-6deg) rotateX(4deg)';
        });
      }

      // --- 6. ABOUT US TABBED INTERACTION ---
      const aboutData = {
        client: {
          category: 'Client First Philosophy',
          title: 'Dedicated Attention & Practical Digital Solutions',
          desc: "As an early-stage startup, every single project is our top priority. We partner closely with founders and business owners to build websites, apps, and digital campaigns that directly achieve your business goals.",
          metric1: '100%', label1: 'Dedicated Focus',
          metric2: 'Direct', label2: 'Team Collaboration',
          metric3: 'Agile', label3: 'Fast Sprints',
          image: 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=800&q=80'
        },
        experience: {
          category: 'Practical Capability',
          title: '~2 Years of Hands-On Digital & Tech Experience',
          desc: "Our team brings roughly two years of focused, hands-on experience across full-stack web development, modern frameworks, database management, UI/UX design, and short-form video creation.",
          metric1: '~2 Yrs', label1: 'Hands-On Experience',
          metric2: 'Modern', label2: 'Tech Stack & Tools',
          metric3: 'Clean', label3: 'Code & Responsive UI',
          image: 'https://images.unsplash.com/photo-1521791136064-7986c2920216?w=800&q=80'
        },
        team: {
          category: 'Agile Core Team',
          title: 'A Focused 4-Member Collaborative Pod',
          desc: "We operate as a close-knit pod of 4 dedicated professionals covering full-stack development, user interface design, digital marketing, and multimedia production—ensuring direct communication with zero bureaucracy.",
          metric1: '4', label1: 'Core Team Members',
          metric2: '100%', label2: 'In-House Work',
          metric3: 'Direct', label3: 'Quick Communication',
          image: 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800&q=80'
        },
        showcase: {
          category: 'Growing Portfolio',
          title: 'Proven Showcase Projects & Long-Term Ambition',
          desc: "We are actively building our portfolio through real-world client projects and practical solutions—from custom websites and management portals to creative brand campaigns and video reels.",
          metric1: '5', label1: 'Showcase Projects',
          metric2: '12', label2: 'Digital Services',
          metric3: '100%', label3: 'Asset Ownership',
          image: 'https://images.unsplash.com/photo-1563242637-805177a35368?w=800&q=80'
        }
      };
      // Alias for backwards compatibility
      aboutData.awards = aboutData.showcase;

      window.switchAboutTab = function(key) {
        document.querySelectorAll('.about-nav-item').forEach(item => {
          item.classList.toggle('active', item.dataset.tab === key);
        });

        const textContainer = document.getElementById('aboutTextContainer');
        const img = document.getElementById('aboutDisplayImage');
        const data = aboutData[key];

        if (textContainer && img && data) {
          textContainer.classList.add('fade-out');
          img.style.opacity = '0.3';

          setTimeout(() => {
            document.getElementById('aboutCategory').textContent = data.category;
            document.getElementById('aboutTitle').textContent = data.title;
            document.getElementById('aboutDescription').textContent = data.desc;
            document.getElementById('aboutMetric1').textContent = data.metric1;
            document.getElementById('aboutMetric1Label').textContent = data.label1;
            document.getElementById('aboutMetric2').textContent = data.metric2;
            document.getElementById('aboutMetric2Label').textContent = data.label2;
            document.getElementById('aboutMetric3').textContent = data.metric3;
            document.getElementById('aboutMetric3Label').textContent = data.label3;
            img.src = data.image;

            textContainer.classList.remove('fade-out');
            img.style.opacity = '1';
          }, 300);
        }
      };

      // --- 7. STACKING PROCESS SCROLL OBSERVER ---
      const stackCards = document.querySelectorAll('.stack-card');
      const processNavItems = document.querySelectorAll('.process-step-nav-item');

      if ('IntersectionObserver' in window && stackCards.length) {
        const stackObserver = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              const id = entry.target.id;
              processNavItems.forEach(item => {
                item.classList.toggle('active', item.dataset.stepId === id);
              });
            }
          });
        }, { threshold: 0.5 });

        stackCards.forEach(card => stackObserver.observe(card));
      }

      window.scrollToStep = function(id) {
        const el = document.getElementById(id);
        if (el) {
          el.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      };

      // --- 8. PORTFOLIO INTERACTIVE CANVAS ---
      const lineTracker = document.getElementById('portfolioLineTracker');
      const canvasImg = document.getElementById('portfolioCanvasImage');
      const canvasTag = document.getElementById('portfolioCanvasTag');
      const canvasTitle = document.getElementById('portfolioCanvasTitle');
      const canvasDesc = document.getElementById('portfolioCanvasDesc');

      window.activatePortfolioItem = function(element) {
        document.querySelectorAll('.portfolio-item').forEach(item => item.classList.remove('active'));
        element.classList.add('active');

        // Move line tracker
        if (lineTracker) {
          lineTracker.style.top = `${element.offsetTop}px`;
          lineTracker.style.height = `${element.offsetHeight}px`;
        }

        // Cross-fade canvas
        if (canvasImg) {
          canvasImg.style.opacity = '0';
          setTimeout(() => {
            canvasImg.src = element.dataset.img;
            canvasTag.textContent = element.dataset.tag;
            canvasTitle.textContent = element.dataset.title;
            canvasDesc.textContent = element.dataset.desc;
            canvasImg.style.opacity = '1';
          }, 200);
        }
      };

      // Initialize line tracker on load
      const firstPortfolioItem = document.querySelector('.portfolio-item.active');
      if (firstPortfolioItem && lineTracker) {
        lineTracker.style.top = `${firstPortfolioItem.offsetTop}px`;
        lineTracker.style.height = `${firstPortfolioItem.offsetHeight}px`;
      }

      // --- 9. MAGNETIC BUTTONS ---
      const magneticBtns = document.querySelectorAll('.magnetic-btn');
      magneticBtns.forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
          const rect = btn.getBoundingClientRect();
          const x = e.clientX - rect.left - rect.width / 2;
          const y = e.clientY - rect.top - rect.height / 2;
          btn.style.transform = `translate(${x * 0.22}px, ${y * 0.35}px)`;
        });

        btn.addEventListener('mouseleave', () => {
          btn.style.transform = 'translate(0, 0)';
        });
      });

      // --- 11. 3D HALFTONE DEPTH WAVE CANVAS ---
      const canvas = document.getElementById('hero-wave-canvas');
      if (canvas) {
        const ctx = canvas.getContext('2d');
        let width = canvas.width = canvas.offsetWidth;
        let height = canvas.height = canvas.offsetHeight;

        let mouse = { x: width / 2, y: height / 2 };
        let tick = 0;
        const spacing = 36;

        function resizeCanvas() {
          width = canvas.width = canvas.offsetWidth;
          height = canvas.height = canvas.offsetHeight;
        }

        window.addEventListener('resize', resizeCanvas);

        document.addEventListener('mousemove', (e) => {
          const rect = canvas.getBoundingClientRect();
          mouse.x = e.clientX - rect.left;
          mouse.y = e.clientY - rect.top;
        });

        function renderWave() {
          ctx.clearRect(0, 0, width, height);
          tick += 0.025;

          const cols = Math.ceil(width / spacing);
          const rows = Math.ceil(height / spacing);
          const centerX = cols / 2;
          const centerY = rows / 2;

          for (let r = 0; r < rows; r++) {
            for (let c = 0; c < cols; c++) {
              const x = c * spacing;
              const y = r * spacing;

              const distCenter = Math.sqrt(Math.pow(c - centerX, 2) + Math.pow(r - centerY, 2));
              const waveVal = Math.sin(distCenter * 0.35 - tick);

              const distMouse = Math.sqrt(Math.pow(x - mouse.x, 2) + Math.pow(y - mouse.y, 2));
              const mouseRadius = 240;
              const mouseInfluence = Math.max(0, 1 - (distMouse / mouseRadius));

              const radius = Math.max(1, 1.8 + waveVal * 1.5 + mouseInfluence * 4.5);
              const opacity = Math.min(0.8, 0.12 + (waveVal + 1) * 0.15 + mouseInfluence * 0.5);

              // Use Brand Logo Colors in wave points
              ctx.beginPath();
              ctx.arc(x, y + waveVal * 8 * (1 + mouseInfluence), radius, 0, Math.PI * 2);

              if (c % 3 === 0) {
                ctx.fillStyle = `rgba(0, 86, 214, ${opacity})`; // Brand Blue
              } else if (c % 3 === 1) {
                ctx.fillStyle = `rgba(0, 162, 255, ${opacity * 0.9})`; // Cyan
              } else {
                ctx.fillStyle = `rgba(255, 106, 0, ${opacity * 0.8})`; // Orange
              }
              ctx.fill();
            }
          }

          requestAnimationFrame(renderWave);
        }

        requestAnimationFrame(renderWave);
      }

    });
  </script>

<?php
include __DIR__ . '/layout/footer.php';
?>