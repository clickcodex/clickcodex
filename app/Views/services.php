<?php
/**
 * ClickCodex Technologies - Dynamic Services View
 * Designed with 100% exact fidelity to storage/Frontend/services.html
 * Backed by clickcodex_db database records
 */
declare(strict_types=1);

include __DIR__ . '/layout/header.php';
?>

  <main>
    <!-- ==========================================================================
         2. HERO SECTION WITH 3D INTERACTIVE CARD DECK
         ========================================================================== -->
    <section class="services-hero" id="hero">
      <div class="container">
        <div class="services-hero-grid">
          <div>
            <div class="section-pill">
              <span class="pulse-dot"></span>
              <span><?= htmlspecialchars($sections['services_hero']['badge_text'] ?? '12 Core Digital Services') ?></span>
            </div>

            <h1 class="services-hero-title">
              Practical Digital <span class="gradient-text">Solutions.</span><br />
              Built For Your Growth.
            </h1>

            <p class="services-hero-lead">
              <?= htmlspecialchars($sections['services_hero']['subtitle'] ?? 'From responsive websites and custom web applications to logo design, digital marketing, and professional reel shooting, Click Codex delivers practical digital assets tailored to your business needs.') ?>
            </p>

            <div style="display: flex; gap: 16px; flex-wrap: wrap;">
              <button class="btn-primary" onclick="openConsultationModal('Services Hero')">
                <span><?= htmlspecialchars($sections['services_hero']['cta_primary_text'] ?? 'Start Your Build') ?></span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
              </button>
              <a href="#catalog" class="btn-outline">
                <span><?= htmlspecialchars($sections['services_hero']['cta_secondary_text'] ?? 'Explore Capabilities') ?></span>
              </a>
            </div>
          </div>

          <!-- 3D Interactive Card Deck (from test.html elevated) -->
          <div>
            <div class="service-card-deck-wrap" id="deckContainer">
              <?php foreach ($cardDeck as $dIdx => $dCard): ?>
                <div class="deck-card" data-index="<?= $dIdx ?>" onclick="focusDeckCard(<?= $dIdx ?>)">
                  <div class="deck-card-banner">
                    <span class="deck-card-tag"><?= htmlspecialchars($dCard['tag']) ?></span>
                    <img src="<?= htmlspecialchars($dCard['image']) ?>" alt="<?= htmlspecialchars($dCard['title']) ?>" loading="lazy" decoding="async" />
                  </div>
                  <div class="deck-card-body">
                    <h3 class="deck-card-title"><?= htmlspecialchars($dCard['title']) ?></h3>
                    <p class="deck-card-desc"><?= htmlspecialchars($dCard['description']) ?></p>
                    <div class="deck-card-footer">
                      <span><?= htmlspecialchars($dCard['link_text']) ?></span>
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>

            <!-- Deck Controls -->
            <div class="deck-nav-controls">
              <span style="font-family: var(--font-mono); font-size: 0.78rem; color: var(--text-muted);">Card Deck 3D Controls:</span>
              <button class="deck-nav-btn" onclick="cycleDeck(-1)" aria-label="Previous service">◀</button>
              <button class="deck-nav-btn" onclick="cycleDeck(1)" aria-label="Next service">▶</button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         SOLUTION ADVISOR CALLOUT STRIP (INTERACTIVE ARCHITECTURE GUIDANCE)
         ========================================================================== -->
    <section class="advisor-callout-strip" style="background: linear-gradient(135deg, rgba(0, 86, 214, 0.04) 0%, rgba(255, 106, 0, 0.04) 100%); border-top: 1px solid rgba(0, 86, 214, 0.1); border-bottom: 1px solid rgba(0, 86, 214, 0.1); padding: 40px 0; position: relative; z-index: 10;">
      <div class="container" style="display: flex; align-items: center; justify-content: space-between; gap: 30px; flex-wrap: wrap;">
        <div style="display: flex; align-items: center; gap: 20px; max-width: 780px;">
          <div style="width: 58px; height: 58px; border-radius: 16px; background: linear-gradient(135deg, var(--brand-blue), var(--brand-cyan)); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 28px; box-shadow: 0 10px 25px rgba(0, 86, 214, 0.25); flex-shrink: 0;">
            🧭
          </div>
          <div>
            <div style="display: inline-block; font-family: 'Space Mono', monospace; font-size: 11px; text-transform: uppercase; color: var(--brand-blue); font-weight: 700; letter-spacing: 1.5px; background: rgba(0, 86, 214, 0.08); padding: 3px 10px; border-radius: 20px; margin-bottom: 6px;">
              <?= htmlspecialchars($sections['advisor_callout_strip']['badge_text'] ?? 'Not Sure What You Need?') ?>
            </div>
            <h3 style="font-family: 'Poppins', sans-serif; font-size: 1.35rem; font-weight: 700; color: #0f172a; margin: 0 0 6px 0; line-height: 1.3;">
              <?= htmlspecialchars($sections['advisor_callout_strip']['title'] ?? 'Which Website or Architecture Fits Your Business Goals?') ?>
            </h3>
            <p style="margin: 0; color: #64748b; font-size: 0.95rem; line-height: 1.5;">
              <?= htmlspecialchars($sections['advisor_callout_strip']['subtitle'] ?? 'Avoid over-engineering or under-building. Take our 60-second interactive Solution Advisor quiz to match your stage, budget, and traffic targets with the ideal technical blueprint.') ?>
            </p>
          </div>
        </div>
        <div style="display: flex; gap: 14px; align-items: center; flex-wrap: wrap;">
          <a href="<?= BASE_URL ?>/service-finder" class="btn-primary" style="display: inline-flex; align-items: center; gap: 10px; text-decoration: none; padding: 14px 28px; font-weight: 600; font-size: 0.95rem; border-radius: 100px; box-shadow: 0 10px 25px rgba(0, 86, 214, 0.3);">
            <span><?= htmlspecialchars($sections['advisor_callout_strip']['cta_primary_text'] ?? 'Launch Solution Advisor') ?></span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
          </a>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         3. FLAGSHIP CAPABILITIES CATALOG (6 CORE SERVICES)
         ========================================================================== -->
    <section class="services-breakdown-section" id="catalog">
      <div class="container">
        <div class="section-header-center">
          <div class="section-pill">
            <span class="pulse-dot"></span>
            <span><?= htmlspecialchars($sections['services_catalog']['badge_text'] ?? 'Our 12 Services') ?></span>
          </div>
          <h2 class="section-title">What We <span class="gradient-text">Deliver</span></h2>
          <p class="section-subtitle">
            <?= htmlspecialchars($sections['services_catalog']['subtitle'] ?? 'Every deliverable is crafted in-house by our dedicated 4-member team with clean code, modern designs, and direct collaboration.') ?>
          </p>
        </div>

        <div class="services-catalog-grid">
          <?php foreach ($services as $sIndex => $service): ?>
            <?php 
              $isWarm = ($sIndex % 2 === 1);
              $badgeNum = sprintf('%02d', $sIndex + 1);
            ?>
            <div class="service-catalog-card <?= $isWarm ? 'warm' : '' ?>">
              <div>
                <div class="service-icon-box">
                  <?php if (!empty($service['icon_svg'])): ?>
                    <?= $service['icon_svg'] ?>
                  <?php else: ?>
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                  <?php endif; ?>
                </div>

                <span class="service-num" style="<?= $isWarm ? 'color: var(--brand-orange);' : '' ?>">
                  <?= htmlspecialchars($service['badge_label'] ?? ($badgeNum . ' // ' . strtoupper($service['category_name'] ?? 'SERVICE'))) ?>
                </span>

                <h3 class="service-catalog-title">
                  <a href="<?= BASE_URL ?>/services/<?= $service['slug'] ?>" style="color: inherit; text-decoration: none;">
                    <?= htmlspecialchars($service['title']) ?>
                  </a>
                </h3>

                <p class="service-catalog-desc">
                  <?= htmlspecialchars($service['short_description'] ?? '') ?>
                </p>

                <!-- Key Deliverables -->
                <?php if (!empty($service['key_deliverables_arr'])): ?>
                  <div class="service-deliverables-list">
                    <?php foreach ($service['key_deliverables_arr'] as $dItem): ?>
                      <div class="deliverable-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span><?= htmlspecialchars($dItem) ?></span>
                      </div>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>

                <!-- Tech Stack Pills -->
                <?php if (!empty($service['tech_stack_arr'])): ?>
                  <div class="service-tech-pills">
                    <?php foreach ($service['tech_stack_arr'] as $tech): ?>
                      <span class="tech-badge"><?= htmlspecialchars($tech) ?></span>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              </div>

              <div style="display: flex; gap: 10px; margin-top: 20px; align-items: center; justify-content: space-between;">
                <a href="<?= BASE_URL ?>/services/<?= $service['slug'] ?>" class="channel-action-btn" style="padding: 9px 18px; font-size: 0.84rem; text-decoration: none;">
                  <span>Explore Dossier ↗</span>
                </a>

                <div class="service-card-action" style="margin-top: 0; padding: 9px 16px; cursor: pointer;" onclick="openConsultationModal('<?= htmlspecialchars($service['title']) ?>')">
                  <span>Get Quote</span>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
       4. WIREFRAME TO REALITY SPLIT SCANNER (test4 ELEVATED)
       ========================================================================== -->
    <section class="wireframe-reality-section" id="reality-scanner">
      <div class="container">
        <div class="section-header-center">
          <div class="section-pill" style="background: rgba(0, 162, 255, 0.1); border-color: rgba(0, 162, 255, 0.3); color: var(--brand-cyan);">
            <span class="pulse-dot"></span>
            <span>Interactive Architecture Scanner</span>
          </div>
          <h2 class="section-title">From Wireframe To <span class="gradient-warm-text">Production Reality</span></h2>
          <p class="section-subtitle">
            Drag the orange slider below to see how our engineering turns raw blueprint specifications into polished, production-grade applications.
          </p>
        </div>

        <div class="scanner-interface-container" id="scannerBox">
          <!-- 1. BASE LAYER: BLUEPRINT WIREFRAME -->
          <div class="scanner-layer-blueprint">
            <div class="scanner-app-screen blueprint-screen">
              <!-- Window Bar -->
              <div class="app-window-bar">
                <div class="window-dots">
                  <span></span><span></span><span></span>
                </div>
                <div class="window-url-box">
                  <code>[FRAMEWORK: NEXTJS_15] • /app/dashboard/analytics • // SKELETON_V3</code>
                </div>
                <div class="window-status-pill">[SCHEMA: SPEC_DRAFT]</div>
              </div>

              <!-- Top KPI Metrics -->
              <div class="app-kpi-row">
                <div class="app-kpi-card">
                  <div class="kpi-title">// PARAM_01: REVENUE_STREAM</div>
                  <div class="kpi-value">$148,920</div>
                  <div class="kpi-sub">[TARGET: $150K / MO]</div>
                </div>
                <div class="app-kpi-card">
                  <div class="kpi-title">// PARAM_02: CONCURRENT_SESSIONS</div>
                  <div class="kpi-value">124,500</div>
                  <div class="kpi-sub">[P99_LATENCY: 12MS_CDN]</div>
                </div>
                <div class="app-kpi-card">
                  <div class="kpi-title">// PARAM_03: CHECKOUT_CVR</div>
                  <div class="kpi-value">4.95%</div>
                  <div class="kpi-sub">[A/B_TEST: POD_B_WIN]</div>
                </div>
              </div>

              <!-- Main Grid (Chart + Activity) -->
              <div class="app-main-grid">
                <!-- Blueprint Chart Panel -->
                <div class="app-chart-panel">
                  <div class="chart-head-row">
                    <span style="font-size: 0.74rem;">// ANALYTICS_GRID [X: 30D, Y: 200K]</span>
                    <div class="chart-pills">
                      <span>24H</span>
                      <span>7D</span>
                      <span>30D</span>
                    </div>
                  </div>
                  <div class="graph-viewport">
                    <div class="blueprint-grid-lines"></div>
                    <svg viewBox="0 0 500 130" preserveAspectRatio="none">
                      <path d="M 0 115 Q 70 95, 140 75 T 270 50 T 390 30 T 500 12" fill="none" stroke="#00a2ff" stroke-width="2" stroke-dasharray="5,4" />
                      <circle cx="140" cy="75" r="4" fill="#00a2ff" />
                      <circle cx="270" cy="50" r="4" fill="#00a2ff" />
                      <circle cx="390" cy="30" r="4" fill="#00a2ff" />
                      <circle cx="500" cy="12" r="5" fill="#00a2ff" />
                    </svg>
                    <div class="chart-tooltip-bubble">
                      <div>// PEAK_NODE: $148,920</div>
                      <div style="font-size: 0.65rem; opacity: 0.8;">[TELEMETRY: VERIFIED]</div>
                    </div>
                  </div>
                </div>

                <!-- Blueprint Activity Panel -->
                <div class="app-activity-panel">
                  <div style="font-size: 0.74rem; margin-bottom: 8px;">// SYSTEM_LEDGER</div>
                  <div class="activity-list">
                    <div class="activity-row">
                      <span class="act-dot" style="border: 1px dashed #00a2ff; background: transparent;"></span>
                      <div class="wf-bar" style="width: 100%;"></div>
                    </div>
                    <div class="activity-row">
                      <span class="act-dot" style="border: 1px dashed #00a2ff; background: transparent;"></span>
                      <div class="wf-bar" style="width: 82%;"></div>
                    </div>
                    <div class="activity-row">
                      <span class="act-dot" style="border: 1px dashed #00a2ff; background: transparent;"></span>
                      <div class="wf-bar" style="width: 65%;"></div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Blueprint Bottom Tag -->
              <div class="scanner-mode-badge blueprint-badge">
                <span class="dot"></span>
                <span>STAGE 01: SKELETON WIREFRAME & ARCHITECTURE</span>
              </div>
            </div>
          </div>

          <!-- 2. REVEAL LAYER: LIVE PRODUCTION REALITY (CLIPPED) -->
          <div class="scanner-layer-reality" id="scannerReality">
            <div class="scanner-app-screen reality-screen">
              <!-- Window Bar -->
              <div class="app-window-bar">
                <div class="window-dots">
                  <span></span><span></span><span></span>
                </div>
                <div class="window-url-box">
                  <span style="color: #10b981; margin-right: 4px;">🔒</span>
                  <span>https://app.clickcodex.com/analytics</span>
                  <span style="margin-left: 8px; opacity: 0.5; font-size: 0.7rem; background: rgba(255,255,255,0.08); padding: 2px 6px; border-radius: 4px;">⌘K Quick Actions</span>
                </div>
                <div class="window-status-pill">● LIVE IN PRODUCTION</div>
              </div>

              <!-- Top KPI Metrics -->
              <div class="app-kpi-row">
                <div class="app-kpi-card">
                  <div class="kpi-title">Monthly Recurring Revenue</div>
                  <div class="kpi-value">$148,920</div>
                  <div class="kpi-sub kpi-green">▲ +34.2% <span style="opacity: 0.6; font-weight: normal;">vs last month</span></div>
                </div>
                <div class="app-kpi-card">
                  <div class="kpi-title">Concurrent Active Users</div>
                  <div class="kpi-value">124,500</div>
                  <div class="kpi-sub kpi-blue">● 12 Edge Regions <span style="opacity: 0.6; font-weight: normal;">(12ms)</span></div>
                </div>
                <div class="app-kpi-card">
                  <div class="kpi-title">Checkout Conversion Rate</div>
                  <div class="kpi-value">4.95%</div>
                  <div class="kpi-sub kpi-orange">★ 3.2x Above Benchmark</div>
                </div>
              </div>

              <!-- Main Grid (Chart + Activity) -->
              <div class="app-main-grid">
                <!-- Reality Chart Panel -->
                <div class="app-chart-panel">
                  <div class="chart-head-row">
                    <h4>Revenue & Conversion Velocity</h4>
                    <div class="chart-pills">
                      <span>24H</span>
                      <span class="active">7D</span>
                      <span>30D</span>
                      <span>ALL</span>
                    </div>
                  </div>
                  <div class="graph-viewport">
                    <svg viewBox="0 0 500 130" preserveAspectRatio="none">
                      <defs>
                        <linearGradient id="scannerGradFill" x1="0" y1="0" x2="0" y2="1">
                          <stop offset="0%" stop-color="#ff6a00" stop-opacity="0.4" />
                          <stop offset="60%" stop-color="#0056d6" stop-opacity="0.2" />
                          <stop offset="100%" stop-color="#0056d6" stop-opacity="0.0" />
                        </linearGradient>
                        <linearGradient id="scannerGradStroke" x1="0" y1="0" x2="1" y2="0">
                          <stop offset="0%" stop-color="#00a2ff" />
                          <stop offset="50%" stop-color="#ff6a00" />
                          <stop offset="100%" stop-color="#ffd200" />
                        </linearGradient>
                      </defs>
                      <path d="M 0 115 Q 70 95, 140 75 T 270 50 T 390 30 T 500 12 L 500 130 L 0 130 Z" fill="url(#scannerGradFill)" />
                      <path d="M 0 115 Q 70 95, 140 75 T 270 50 T 390 30 T 500 12" fill="none" stroke="url(#scannerGradStroke)" stroke-width="3" />
                      <circle cx="140" cy="75" r="4.5" fill="#ffffff" stroke="#00a2ff" stroke-width="2.5" />
                      <circle cx="270" cy="50" r="4.5" fill="#ffffff" stroke="#ff6a00" stroke-width="2.5" />
                      <circle cx="390" cy="30" r="4.5" fill="#ffffff" stroke="#ff6a00" stroke-width="2.5" />
                      <circle cx="500" cy="12" r="5" fill="#ffffff" stroke="#ffd200" stroke-width="3" />
                    </svg>
                    <div class="chart-tooltip-bubble">
                      <div style="font-weight: 700; color: #ffb300;">$148,920.00</div>
                      <div style="font-size: 0.65rem; opacity: 0.8;">Sept Peak • 124K Sessions</div>
                    </div>
                  </div>
                </div>

                <!-- Reality Activity Panel -->
                <div class="app-activity-panel">
                  <div style="font-size: 0.8rem; font-weight: 700; color: #ffffff; margin-bottom: 8px;">Live Infrastructure</div>
                  <div class="activity-list">
                    <div class="activity-row">
                      <span class="act-dot act-green"></span>
                      <div>
                        <strong>Auto-Scale Cluster</strong>
                        <p>12 Nodes • 0ms lag</p>
                      </div>
                    </div>
                    <div class="activity-row">
                      <span class="act-dot act-blue"></span>
                      <div>
                        <strong>Redis Edge Cache</strong>
                        <p>98.6% Hit Rate</p>
                      </div>
                    </div>
                    <div class="activity-row">
                      <span class="act-dot act-orange"></span>
                      <div>
                        <strong>SOC-2 Protected</strong>
                        <p>Zero vulnerabilities</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Reality Bottom Tag -->
              <div class="scanner-mode-badge reality-badge">
                <span class="dot"></span>
                <span>STAGE 02: HIGH-SCALE PRODUCTION REALITY</span>
              </div>
            </div>
          </div>

          <!-- 3. SLIDER DIVIDER LINE & HANDLE -->
          <div class="scanner-divider-line" id="scannerDivider">
            <div class="scanner-handle" id="scannerHandle" title="Drag to scan">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="15 18 9 12 15 6"></polyline></svg>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </div>
          </div>
        </div>

        <!-- Interactive Presets & Instructions -->
        <div class="scanner-control-bar">
          <button class="scanner-preset-btn" onclick="setScannerPct(0)">
            <span>📐 View Blueprint (0%)</span>
          </button>
          <button class="scanner-preset-btn active" id="btnPreset50" onclick="setScannerPct(50)">
            <span>⚡ Split 50/50 Scanner</span>
          </button>
          <button class="scanner-preset-btn" onclick="setScannerPct(100)">
            <span>🚀 View Production (100%)</span>
          </button>
        </div>
        <p class="scanner-helper-text">← DRAG SLIDER OR TAP PRESETS ABOVE TO REVEAL TRANSFORMATION →</p>
      </div>
    </section>

    <!-- ==========================================================================
       5. GROWTH & CONVERSION FUNNEL (test5 ELEVATED)
       ========================================================================== -->
    <section class="funnel-section" id="funnel">
      <div class="container">
        <div class="section-header-center">
          <div class="section-pill">
            <span class="pulse-dot"></span>
            <span>Commercial Science</span>
          </div>
          <h2 class="section-title">The High-Velocity <span class="gradient-text">Growth Funnel</span></h2>
          <p class="section-subtitle">
            Software is only as good as the revenue it generates. Click on each tier of our engineering funnel to see how we maximize visitor-to-customer conversion.
          </p>
        </div>

        <div class="funnel-layout-grid">
          <!-- Left: 4-Tier Funnel Stack -->
          <div class="funnel-tiers-wrap">
            <?php foreach ($growthFunnel as $fKey => $fTier): ?>
              <?php $isFirst = ($fKey === 'tier1'); ?>
              <div class="funnel-tier-card <?= $fKey === 'tier1' ? 'tier-1' : ($fKey === 'tier2' ? 'tier-2' : ($fKey === 'tier3' ? 'tier-3' : 'tier-4')) ?> <?= $isFirst ? 'active' : '' ?>" onclick="switchFunnelTier('<?= $fKey ?>')">
                <div class="funnel-tier-info">
                  <h4><?= htmlspecialchars($fTier['tab_num'] . '. ' . $fTier['tab_title']) ?></h4>
                  <p><?= htmlspecialchars($fTier['tab_desc']) ?></p>
                </div>
                <span class="funnel-tier-stat"><?= htmlspecialchars($fTier['tab_stat']) ?></span>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- Right: Interactive Deep-Dive Screen -->
          <div class="funnel-screen-display" id="funnelScreen">
            <span class="funnel-tag" id="funnelTag"><?= htmlspecialchars($growthFunnel['tier1']['tag']) ?></span>
            <h3 class="funnel-screen-title" id="funnelTitle"><?= htmlspecialchars($growthFunnel['tier1']['title']) ?></h3>
            <p class="funnel-screen-desc" id="funnelDesc">
              <?= htmlspecialchars($growthFunnel['tier1']['desc']) ?>
            </p>

            <div class="funnel-metrics-grid">
              <div class="funnel-metric-box">
                <strong id="funnelMetric1"><?= htmlspecialchars($growthFunnel['tier1']['m1']) ?></strong>
                <span id="funnelLabel1"><?= htmlspecialchars($growthFunnel['tier1']['l1']) ?></span>
              </div>
              <div class="funnel-metric-box">
                <strong id="funnelMetric2"><?= htmlspecialchars($growthFunnel['tier1']['m2']) ?></strong>
                <span id="funnelLabel2"><?= htmlspecialchars($growthFunnel['tier1']['l2']) ?></span>
              </div>
              <div class="funnel-metric-box">
                <strong id="funnelMetric3"><?= htmlspecialchars($growthFunnel['tier1']['m3']) ?></strong>
                <span id="funnelLabel3"><?= htmlspecialchars($growthFunnel['tier1']['l3']) ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
       6. THE DELIVERY DOSSIER: 4-PHASE PROCESS (test7 ELEVATED)
       ========================================================================== -->
    <section class="process-dossier-section" id="process">
      <div class="container">
        <div class="section-header-center">
          <div class="section-pill">
            <span class="pulse-dot"></span>
            <span>Rigorous Methodology</span>
          </div>
          <h2 class="section-title">The ClickCodex <span class="gradient-text">Delivery Dossier</span></h2>
          <p class="section-subtitle">
            How we take projects from napkin concepts to mission-critical deployments in 4 structured sprint phases.
          </p>
        </div>

        <div class="dossier-container">
          <!-- Sidebar Tabs -->
          <div class="dossier-nav-sidebar">
            <?php foreach ($deliveryDossier as $dKey => $dPhase): ?>
              <?php $isFirstPhase = ($dKey === 'phase1'); ?>
              <div class="dossier-tab-btn <?= $isFirstPhase ? 'active' : '' ?>" onclick="switchDossier('<?= $dKey ?>', this)">
                <span><?= htmlspecialchars($dPhase['label']) ?></span>
                <strong><?= htmlspecialchars($dPhase['tab_title']) ?></strong>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- Body Panel -->
          <div class="dossier-body-panel">
            <div>
              <h3 class="dossier-panel-title" id="dossierTitle"><?= htmlspecialchars($deliveryDossier['phase1']['title']) ?></h3>
              <p class="dossier-panel-desc" id="dossierDesc">
                <?= htmlspecialchars($deliveryDossier['phase1']['desc']) ?>
              </p>

              <div class="dossier-checkpoints-list" id="dossierCheckpoints">
                <?php foreach ($deliveryDossier['phase1']['points'] as $pItem): ?>
                  <div class="checkpoint-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span><?= htmlspecialchars($pItem) ?></span>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

            <div class="dossier-footer-badge" id="dossierBadge">
              <span><?= htmlspecialchars($deliveryDossier['phase1']['badge']) ?></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
       7. FLUID RIPPLE CTA & STRATEGY CONSULTATION
       ========================================================================== -->
    <section class="ripple-cta-section" id="contact">
      <div class="container">
        <div class="ripple-cta-card">
          <!-- Fluid Ripple Canvas -->
          <canvas id="ripple-canvas"></canvas>

          <div class="ripple-cta-content">
            <span class="ripple-badge">Let's Build Something Extraordinary</span>
            <h2 class="ripple-title">
              Ready To Engineer Your Next Competitive Advantage?
            </h2>
            <p class="ripple-subtitle">
              Speak directly with our technical leadership. Receive a transparent scope breakdown, timeline milestones, and an accurate estimate within 24 hours.
            </p>

            <div class="ripple-btn-group">
              <button class="btn-primary" onclick="openConsultationModal('Services CTA')">
                <span>Book Free Architecture Call</span>
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

      // --- 1. 3D CARD DECK INTERACTION ---
      const deckCards = document.querySelectorAll('.deck-card');
      let activeDeckIdx = 0;

      function renderDeck() {
        deckCards.forEach((card, i) => {
          const offset = (i - activeDeckIdx + deckCards.length) % deckCards.length;

          if (offset === 0) {
            card.style.transform = 'translateX(0) translateY(0) translateZ(60px) rotateY(0deg) scale(1)';
            card.style.zIndex = '5';
            card.style.opacity = '1';
          } else if (offset === 1) {
            card.style.transform = 'translateX(60px) translateY(-15px) translateZ(-40px) rotateY(-8deg) scale(0.92)';
            card.style.zIndex = '3';
            card.style.opacity = '0.85';
          } else {
            card.style.transform = 'translateX(-60px) translateY(-25px) translateZ(-100px) rotateY(8deg) scale(0.85)';
            card.style.zIndex = '1';
            card.style.opacity = '0.65';
          }
        });
      }

      window.cycleDeck = function(dir) {
        activeDeckIdx = (activeDeckIdx + dir + deckCards.length) % deckCards.length;
        renderDeck();
      };

      window.focusDeckCard = function(idx) {
        activeDeckIdx = idx;
        renderDeck();
      };

      renderDeck();

      // --- 2. WIREFRAME TO REALITY SPLIT SCANNER ---
      const scannerBox = document.getElementById('scannerBox');
      const scannerReality = document.getElementById('scannerReality');
      const scannerDivider = document.getElementById('scannerDivider');

      if (scannerBox && scannerReality && scannerDivider) {
        let isScanning = false;

        window.setScannerPct = function(pct) {
          pct = Math.max(0, Math.min(100, pct));
          scannerReality.style.clipPath = `polygon(0 0, ${pct}% 0, ${pct}% 100%, 0 100%)`;
          scannerDivider.style.left = `${pct}%`;

          const btns = document.querySelectorAll('.scanner-preset-btn');
          btns.forEach(b => b.classList.remove('active'));
          if (pct === 0 && btns[0]) btns[0].classList.add('active');
          else if (Math.abs(pct - 50) < 5 && btns[1]) btns[1].classList.add('active');
          else if (pct === 100 && btns[2]) btns[2].classList.add('active');
        };

        function updateScanner(clientX) {
          const rect = scannerBox.getBoundingClientRect();
          let posX = clientX - rect.left;
          posX = Math.max(0, Math.min(posX, rect.width));
          const pct = (posX / rect.width) * 100;
          setScannerPct(pct);
        }

        scannerBox.addEventListener('mousedown', (e) => {
          isScanning = true;
          updateScanner(e.clientX);
        });

        window.addEventListener('mouseup', () => { isScanning = false; });
        window.addEventListener('mousemove', (e) => {
          if (isScanning) {
            updateScanner(e.clientX);
          }
        });

        scannerBox.addEventListener('touchstart', (e) => {
          isScanning = true;
          if (e.touches && e.touches[0]) updateScanner(e.touches[0].clientX);
        }, { passive: true });

        window.addEventListener('touchend', () => { isScanning = false; });
        window.addEventListener('touchmove', (e) => {
          if (isScanning && e.touches && e.touches[0]) {
            updateScanner(e.touches[0].clientX);
          }
        }, { passive: true });

        setScannerPct(50);
      }

      // --- 3. FLUID RIPPLE CANVAS ---
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
            x: x, y: y, radius: 5,
            maxRadius: 180 + Math.random() * 80,
            opacity: 0.65, speed: 3 + Math.random() * 2,
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

    // --- 4. GROWTH FUNNEL TIER SWITCHER ---
    const funnelData = <?= json_encode($growthFunnel, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;

    window.switchFunnelTier = function(key) {
      document.querySelectorAll('.funnel-tier-card').forEach(c => c.classList.remove('active'));
      const activeCard = document.querySelector(`.${key === 'tier1' ? 'tier-1' : key === 'tier2' ? 'tier-2' : key === 'tier3' ? 'tier-3' : 'tier-4'}`);
      if (activeCard) activeCard.classList.add('active');

      const data = funnelData[key];
      if (!data) return;

      const screen = document.getElementById('funnelScreen');
      if (screen) {
        screen.style.opacity = '0.3';
        setTimeout(() => {
          document.getElementById('funnelTag').textContent = data.tag;
          document.getElementById('funnelTitle').textContent = data.title;
          document.getElementById('funnelDesc').textContent = data.desc;
          document.getElementById('funnelMetric1').textContent = data.m1;
          document.getElementById('funnelLabel1').textContent = data.l1;
          document.getElementById('funnelMetric2').textContent = data.m2;
          document.getElementById('funnelLabel2').textContent = data.l2;
          document.getElementById('funnelMetric3').textContent = data.m3;
          document.getElementById('funnelLabel3').textContent = data.l3;
          screen.style.opacity = '1';
        }, 200);
      }
    };

    // --- 5. DOSSIER PHASE SWITCHER ---
    const dossierData = <?= json_encode($deliveryDossier, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;

    window.switchDossier = function(key, targetEl) {
      document.querySelectorAll('.dossier-tab-btn').forEach(btn => btn.classList.remove('active'));
      if (targetEl) {
        targetEl.classList.add('active');
      } else if (window.event && (window.event.currentTarget || window.event.target)) {
        const btn = (window.event.currentTarget || window.event.target).closest('.dossier-tab-btn');
        if (btn) btn.classList.add('active');
      }

      const d = dossierData[key];
      if (!d) return;

      const bodyPanel = document.querySelector('.dossier-body-panel');
      if (bodyPanel) bodyPanel.style.opacity = '0.5';

      setTimeout(() => {
        document.getElementById('dossierTitle').textContent = d.title;
        document.getElementById('dossierDesc').textContent = d.desc;
        document.getElementById('dossierBadge').textContent = d.badge;

        const container = document.getElementById('dossierCheckpoints');
        if (container) {
          container.innerHTML = '';
          d.points.forEach(pt => {
            const item = document.createElement('div');
            item.className = 'checkpoint-item';
            item.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg><span>${pt}</span>`;
            container.appendChild(item);
          });
        }
        if (bodyPanel) bodyPanel.style.opacity = '1';
      }, 150);
    };
  </script>

<?php
include __DIR__ . '/layout/footer.php';
?>
