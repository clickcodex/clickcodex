<?php
/**
 * ClickCodex Technologies - Portfolio & Client Case Studies View
 * Features Three.js 3D WebGL Lattice, Category & Keyword Live Filtering, and Dynamic Deep-Dive Modals.
 */
declare(strict_types=1);

if (!defined('BASE_URL')) {
    define('BASE_URL', '');
}

include __DIR__ . '/layout/header.php';

// Prepare JavaScript dataset for dynamic modal deep-dives
$caseStudiesJsData = [];
if (!empty($caseStudies)) {
    foreach ($caseStudies as $cs) {
        $slug = $cs['slug'];
        $itemData = [
            'title' => $cs['title'],
            'client' => ($cs['client_name'] ?? 'Confidential') . (!empty($cs['client_location']) ? ' (' . $cs['client_location'] . ')' : ''),
            'sector' => $cs['sector_industry'] ?? 'Enterprise Software',
            'timeline' => $cs['timeline_duration'] ?? '8 Weeks Sprint Cycle',
            'metrics' => $cs['key_metrics_array'] ?? [],
            'overview' => $cs['challenge_overview'] ?? $cs['excerpt'],
            'architecture' => $cs['architecture_solution'] ?? 'Decoupled modern microservices architecture with automated CI/CD pipelines, containerized orchestration, and sub-second global caching.',
            'stack' => $cs['technologies_array'] ?? []
        ];
        $caseStudiesJsData[$slug] = $itemData;
        $shortKey = explode('-', $slug)[0];
        if (!isset($caseStudiesJsData[$shortKey])) {
            $caseStudiesJsData[$shortKey] = $itemData;
        }
    }
}
?>

<main>
  <!-- ==========================================================================
       HERO SECTION WITH 3D WEBGL NODE SHOWCASE
       ========================================================================== -->
  <section class="portfolio-hero">
    <div class="container">
      <div class="portfolio-hero-grid">
        <div>
          <div class="section-pill">
            <span class="pulse-dot"></span>
            <span><?= htmlspecialchars($sections['portfolio_hero']['badge_text'] ?? 'Building Our Portfolio') ?></span>
          </div>
          <h1 class="portfolio-hero-title">
            Building Our Portfolio.<br />
            <span class="gradient-text">Practical Digital Solutions.</span>
          </h1>
          <p class="portfolio-hero-lead">
            <?= htmlspecialchars($sections['portfolio_hero']['subtitle'] ?? 'As a growing technology startup, we focus on building clean, practical, and responsive digital solutions. Explore our featured showcase projects across web development, custom applications, and creative media.') ?>
          </p>
          <div style="display: flex; gap: 16px; flex-wrap: wrap;">
            <a href="#gallery" class="btn-primary">
              <span><?= htmlspecialchars($sections['portfolio_hero']['cta_primary_text'] ?? 'Explore Showcase Projects') ?></span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </a>
            <button class="btn-outline" onclick="openConsultationModal('Portfolio Hero Estimation')">
              <span><?= htmlspecialchars($sections['portfolio_hero']['cta_secondary_text'] ?? 'Discuss Your Project') ?></span>
            </button>
          </div>
        </div>

        <!-- 3D Three.js Interactive WebGL Node Showcase -->
        <div class="hero-3d-wrap">
          <canvas id="portfolioCanvas"></canvas>
          <div class="hero-3d-overlay">
            <span>Interactive Architecture Lattice</span>
            <strong>DRAG TO ROTATE</strong>
          </div>
        </div>
      </div>

      <!-- Metrics Ribbon -->
      <div class="metrics-ribbon">
        <div class="metric-item">
          <span class="metric-num">5</span>
          <span class="metric-label">Showcase Projects</span>
        </div>
        <div class="metric-item">
          <span class="metric-num">100%</span>
          <span class="metric-label">Responsive Design</span>
        </div>
        <div class="metric-item">
          <span class="metric-num">4</span>
          <span class="metric-label">Core Team Members</span>
        </div>
        <div class="metric-item">
          <span class="metric-num">~2 Yrs</span>
          <span class="metric-label">Hands-On Experience</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       PORTFOLIO GALLERY & FILTER HUB
       ========================================================================== -->
  <section class="portfolio-gallery-section" id="gallery">
    <div class="container">
      <div class="section-header-center">
        <div class="section-pill">
          <span class="pulse-dot"></span>
          <span><?= htmlspecialchars($sections['portfolio_gallery']['badge_text'] ?? 'Our Project Showcase') ?></span>
        </div>
        <h2 class="section-title">Featured Work & <span class="gradient-text">Case Studies</span></h2>
        <p class="section-subtitle">
          <?= htmlspecialchars($sections['portfolio_gallery']['subtitle'] ?? 'Explore the projects we have built, showcasing our capabilities in custom web development, clean architecture, and creative media.') ?>
        </p>
      </div>

      <!-- Controls: Category Chips & Tech Search -->
      <div class="filter-controls-wrap">
        <div class="filter-chips-row" id="filterChips">
          <button class="filter-chip active" data-filter="all">All Projects</button>
          <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $cat): ?>
              <button class="filter-chip" data-filter="<?= htmlspecialchars($cat['slug']) ?>">
                <?= htmlspecialchars($cat['name']) ?>
              </button>
            <?php endforeach; ?>
          <?php else: ?>
            <button class="filter-chip" data-filter="web">Enterprise Web</button>
            <button class="filter-chip" data-filter="mobile">Mobile Apps</button>
            <button class="filter-chip" data-filter="ecommerce">E-Commerce</button>
            <button class="filter-chip" data-filter="fintech">Fintech & SaaS</button>
            <button class="filter-chip" data-filter="ai">AI & Cloud</button>
          <?php endif; ?>
        </div>

        <div class="search-input-wrap">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
          <input type="text" id="projectSearch" class="portfolio-search-input" placeholder="Search by tech: React, Flutter, Python, Node, Next.js..." />
        </div>
      </div>

      <!-- Projects Grid -->
      <div class="projects-grid" id="projectsGrid">
        <?php if (!empty($caseStudies)): ?>
          <?php foreach ($caseStudies as $cs): 
            $catSlug = htmlspecialchars($cs['category_slug'] ?? 'web');
            $catName = htmlspecialchars($cs['category_name'] ?? 'Enterprise Web');
            $searchTech = htmlspecialchars($cs['search_tech_keywords'] ?? '');
            $metrics = $cs['key_metrics_array'] ?? [];
            $technologies = $cs['technologies_array'] ?? [];
          ?>
            <div class="project-card" data-category="<?= $catSlug ?> all" data-tech="<?= $searchTech ?>" data-slug="<?= htmlspecialchars($cs['slug']) ?>">
              <div class="project-media-wrap">
                <img src="<?= htmlspecialchars($cs['featured_image']) ?>" alt="<?= htmlspecialchars($cs['title']) ?>" loading="lazy" decoding="async" />
                <span class="project-category-badge"><?= strtoupper($catName) ?></span>
                <?php if (!empty($cs['result_badge'])): ?>
                  <span class="project-result-tag"><?= htmlspecialchars($cs['result_badge']) ?></span>
                <?php endif; ?>
              </div>
              <div class="project-body">
                <div>
                  <h3 class="project-title"><?= htmlspecialchars($cs['title']) ?></h3>
                  <p class="project-excerpt">
                    <?= htmlspecialchars($cs['excerpt']) ?>
                  </p>
                  
                  <?php if (!empty($metrics)): ?>
                    <div class="project-specs-list">
                      <?php foreach (array_slice($metrics, 0, 2) as $m): ?>
                        <div class="spec-item">
                          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                          <span><?= htmlspecialchars(($m['val'] ?? '') . ' ' . ($m['lbl'] ?? '')) ?></span>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>

                  <?php if (!empty($technologies)): ?>
                    <div class="project-tech-pills">
                      <?php foreach (array_slice($technologies, 0, 5) as $tech): ?>
                        <span class="tech-pill"><?= htmlspecialchars($tech) ?></span>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                </div>

                <div class="project-cta-row">
                  <button class="btn-view-study" onclick="openCaseStudyModal('<?= htmlspecialchars($cs['slug']) ?>')">
                    <span>Explore Deep-Dive</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                  </button>
                  <button class="btn-outline" style="padding: 6px 14px; font-size: 0.8rem;" onclick="openConsultationModal('<?= htmlspecialchars(addslashes($cs['title'])) ?> Similar')">Build Similar</button>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       CLIENT IMPACT TESTIMONIALS
       ========================================================================== -->
  <section class="testimonials-section">
    <div class="container">
      <div class="section-header-center">
        <div class="section-pill" style="background: rgba(255, 106, 0, 0.15); border-color: rgba(255, 106, 0, 0.4); color: var(--brand-orange);">
          <span class="pulse-dot"></span>
          <span>Client Endorsements</span>
        </div>
        <h2 class="section-title">What Founders & CTOs Say</h2>
        <p class="section-subtitle">
          Reliability, transparent communication, and elite engineering velocity. Here is the feedback from teams we have built for.
        </p>
      </div>

      <div class="testimonials-grid">
        <?php if (!empty($testimonials)): ?>
          <?php foreach ($testimonials as $t): 
            $initials = '';
            $nameParts = explode(' ', trim($t['client_name'] ?? 'Client'));
            if (count($nameParts) >= 2) {
                $initials = strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1));
            } else {
                $initials = strtoupper(substr($nameParts[0], 0, 2));
            }
          ?>
            <div class="testimonial-card">
              <div>
                <div class="star-rating">★★★★★</div>
                <p class="testimonial-quote">
                  "<?= htmlspecialchars($t['testimonial_quote']) ?>"
                </p>
              </div>
              <div class="testimonial-author">
                <div class="author-avatar"><?= htmlspecialchars($initials) ?></div>
                <div class="author-info">
                  <strong><?= htmlspecialchars($t['client_name']) ?></strong>
                  <span><?= htmlspecialchars(($t['client_position'] ?? '') . (!empty($t['client_company']) ? ', ' . $t['client_company'] : '') . (!empty($t['client_location']) ? ' • ' . $t['client_location'] : '')) ?></span>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       BOTTOM CALL TO ACTION
       ========================================================================== -->
  <section class="portfolio-cta-section">
    <div class="container">
      <div class="portfolio-cta-card">
        <h2>Have an Ambitious Digital Product in Mind?</h2>
        <p>
          Let our senior systems architects review your technical requirements, wireframes, or legacy codebase and provide a transparent sprint roadmap.
        </p>
        <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
          <button class="btn-primary" onclick="openConsultationModal('Portfolio Bottom CTA')">
            <span>Book Architecture Call</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
          </button>
          <a href="<?= BASE_URL ?>/contactus" class="btn-outline" style="color: #ffffff; border-color: rgba(255,255,255,0.25);">
            <span>Visit Contact Hub</span>
          </a>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- ==========================================================================
     CASE STUDY DEEP DIVE MODAL
     ========================================================================== -->
<div class="case-modal-backdrop" id="caseModal" onclick="handleCaseBackdrop(event)">
  <div class="case-modal-dialog">
    <button class="case-modal-close" onclick="closeCaseStudyModal()">✕</button>
    <div id="caseModalContent">
      <!-- Injected via JavaScript dynamically -->
    </div>
  </div>
</div>

<!-- ==========================================================================
     SCRIPTS: THREE.JS 3D CANVAS, FILTERS & MODAL LOGIC
     ========================================================================== -->
<script>
  // Dynamic case studies dataset from database
  const caseStudiesData = <?= json_encode($caseStudiesJsData, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

  document.addEventListener('DOMContentLoaded', () => {
    // --- 1. THREE.JS 3D WEBGL LATTICE ANIMATION ---
    const canvas = document.getElementById('portfolioCanvas');
    if (canvas && typeof THREE !== 'undefined') {
      const renderer = new THREE.WebGLRenderer({ canvas: canvas, antialias: true, alpha: true });
      renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

      const scene = new THREE.Scene();
      const camera = new THREE.PerspectiveCamera(45, canvas.clientWidth / canvas.clientHeight, 0.1, 100);
      camera.position.z = 24;

      function resizeCanvas() {
        if (!canvas.parentElement) return;
        const w = canvas.parentElement.clientWidth;
        const h = canvas.parentElement.clientHeight;
        if (w === 0 || h === 0) return;
        renderer.setSize(w, h, false);
        camera.aspect = w / h;
        camera.updateProjectionMatrix();
      }
      resizeCanvas();
      window.addEventListener('resize', resizeCanvas);

      // Core Geometric Icosahedron Lattice
      const geo = new THREE.IcosahedronGeometry(7, 2);
      const wireMat = new THREE.MeshBasicMaterial({
        color: 0x00a2ff,
        wireframe: true,
        transparent: true,
        opacity: 0.28
      });
      const mesh = new THREE.Mesh(geo, wireMat);
      scene.add(mesh);

      // Outer Orbital Rings
      const ringGeo1 = new THREE.TorusGeometry(9.5, 0.05, 16, 100);
      const ringMat1 = new THREE.MeshBasicMaterial({ color: 0xff6a00, transparent: true, opacity: 0.65 });
      const ring1 = new THREE.Mesh(ringGeo1, ringMat1);
      ring1.rotation.x = Math.PI / 3;
      scene.add(ring1);

      const ringGeo2 = new THREE.TorusGeometry(11, 0.04, 16, 100);
      const ringMat2 = new THREE.MeshBasicMaterial({ color: 0x0056d6, transparent: true, opacity: 0.5 });
      const ring2 = new THREE.Mesh(ringGeo2, ringMat2);
      ring2.rotation.y = Math.PI / 4;
      scene.add(ring2);

      // Floating Particle Cloud
      const partCount = 200;
      const partGeo = new THREE.BufferGeometry();
      const posArr = new Float32Array(partCount * 3);
      const colorArr = new Float32Array(partCount * 3);

      for (let i = 0; i < partCount * 3; i += 3) {
        posArr[i] = (Math.random() - 0.5) * 22;
        posArr[i + 1] = (Math.random() - 0.5) * 22;
        posArr[i + 2] = (Math.random() - 0.5) * 22;

        if (Math.random() > 0.5) {
          colorArr[i] = 0; colorArr[i + 1] = 0.63; colorArr[i + 2] = 1; // cyan
        } else {
          colorArr[i] = 1; colorArr[i + 1] = 0.42; colorArr[i + 2] = 0; // orange
        }
      }
      partGeo.setAttribute('position', new THREE.BufferAttribute(posArr, 3));
      partGeo.setAttribute('color', new THREE.BufferAttribute(colorArr, 3));

      const partMat = new THREE.PointsMaterial({
        size: 0.25,
        vertexColors: true,
        transparent: true,
        opacity: 0.85
      });
      const particles = new THREE.Points(partGeo, partMat);
      scene.add(particles);

      // Mouse drag rotation interaction
      let isDragging = false;
      let prevMousePos = { x: 0, y: 0 };

      canvas.addEventListener('mousedown', (e) => {
        isDragging = true;
        prevMousePos = { x: e.clientX, y: e.clientY };
      });
      window.addEventListener('mouseup', () => { isDragging = false; });
      window.addEventListener('mousemove', (e) => {
        if (isDragging) {
          const deltaX = e.clientX - prevMousePos.x;
          const deltaY = e.clientY - prevMousePos.y;
          mesh.rotation.y += deltaX * 0.008;
          mesh.rotation.x += deltaY * 0.008;
          ring1.rotation.z += deltaX * 0.005;
          prevMousePos = { x: e.clientX, y: e.clientY };
        }
      });

      // Touch drag support
      canvas.addEventListener('touchstart', (e) => {
        if (e.touches[0]) {
          isDragging = true;
          prevMousePos = { x: e.touches[0].clientX, y: e.touches[0].clientY };
        }
      }, { passive: true });
      window.addEventListener('touchend', () => { isDragging = false; });
      window.addEventListener('touchmove', (e) => {
        if (isDragging && e.touches[0]) {
          const deltaX = e.touches[0].clientX - prevMousePos.x;
          const deltaY = e.touches[0].clientY - prevMousePos.y;
          mesh.rotation.y += deltaX * 0.008;
          mesh.rotation.x += deltaY * 0.008;
          prevMousePos = { x: e.touches[0].clientX, y: e.touches[0].clientY };
        }
      }, { passive: true });

      function animate() {
        requestAnimationFrame(animate);
        if (!isDragging) {
          mesh.rotation.y += 0.004;
          mesh.rotation.x += 0.002;
          ring1.rotation.y += 0.006;
          ring2.rotation.x += 0.005;
          particles.rotation.y += 0.001;
        }
        renderer.render(scene, camera);
      }
      animate();
    }

    // --- 2. CATEGORY FILTER & LIVE SEARCH ---
    const filterChips = document.querySelectorAll('.filter-chip');
    const projectCards = document.querySelectorAll('.project-card');
    const projectSearch = document.getElementById('projectSearch');

    let currentFilter = 'all';
    let currentSearch = '';

    function applyFilters() {
      projectCards.forEach(card => {
        const categories = (card.getAttribute('data-category') || '').toLowerCase();
        const tech = (card.getAttribute('data-tech') || '').toLowerCase();
        const text = card.textContent.toLowerCase();

        const matchCat = (currentFilter === 'all' || categories.includes(currentFilter));
        const matchSearch = (!currentSearch || tech.includes(currentSearch) || text.includes(currentSearch));

        if (matchCat && matchSearch) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    }

    filterChips.forEach(chip => {
      chip.addEventListener('click', () => {
        filterChips.forEach(c => c.classList.remove('active'));
        chip.classList.add('active');
        currentFilter = chip.getAttribute('data-filter');
        applyFilters();
      });
    });

    if (projectSearch) {
      projectSearch.addEventListener('input', (e) => {
        currentSearch = e.target.value.toLowerCase().trim();
        applyFilters();
      });
    }
  });

  // --- 3. CASE STUDY DEEP DIVE MODAL FUNCTIONS ---
  window.openCaseStudyModal = function(key) {
    const data = caseStudiesData[key];
    if (!data) return;

    const container = document.getElementById('caseModalContent');
    let stackHtml = '';
    if (Array.isArray(data.stack) && data.stack.length > 0) {
      stackHtml = data.stack.map(s => `<span class="tech-pill" style="font-size: 0.78rem; padding: 5px 12px; background: rgba(0,86,214,0.06); border-color: rgba(0,86,214,0.2); color: var(--brand-blue); font-weight: 600;">${s}</span>`).join('');
    }

    let metricsHtml = '';
    if (Array.isArray(data.metrics) && data.metrics.length > 0) {
      metricsHtml = data.metrics.map(m => `
        <div style="background: var(--bg-surface-light, #f8fafc); padding: 16px; border-radius: var(--radius-sm, 8px); border: 1px solid var(--border-light, #e2e8f0); text-align: center;">
          <div style="font-family: var(--font-display); font-size: 1.6rem; font-weight: 800; color: var(--brand-blue, #0056d6); margin-bottom: 4px;">${m.val || ''}</div>
          <div style="font-size: 0.8rem; font-weight: 600; color: var(--text-muted, #64748b);">${m.lbl || ''}</div>
        </div>
      `).join('');
    }

    container.innerHTML = `
      <div style="margin-bottom: 20px;">
        <span class="section-pill" style="font-size: 0.72rem; padding: 4px 12px; margin-bottom: 8px;">${data.sector || 'Flagship Deployment'}</span>
        <h2 style="font-family: var(--font-display); font-size: 1.85rem; font-weight: 800; color: var(--text-dark, #0f172a); margin-bottom: 6px;">${data.title}</h2>
        <p style="font-size: 0.92rem; color: var(--text-muted, #64748b);">Client: <strong>${data.client || 'Enterprise'}</strong> • Delivery: <strong>${data.timeline || 'Sprint Release'}</strong></p>
      </div>

      ${metricsHtml ? `<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap: 14px; margin-bottom: 26px;">${metricsHtml}</div>` : ''}

      <div style="margin-bottom: 22px;">
        <h4 style="font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; color: var(--text-dark, #0f172a); margin-bottom: 8px;">The Challenge & Objectives</h4>
        <p style="font-size: 0.95rem; color: var(--text-muted, #64748b); line-height: 1.7;">${data.overview || ''}</p>
      </div>

      <div style="margin-bottom: 26px;">
        <h4 style="font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; color: var(--text-dark, #0f172a); margin-bottom: 8px;">Architecture & Solution Delivered</h4>
        <p style="font-size: 0.95rem; color: var(--text-muted, #64748b); line-height: 1.7;">${data.architecture || ''}</p>
      </div>

      ${stackHtml ? `
        <div style="margin-bottom: 30px;">
          <h4 style="font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--text-dark, #0f172a); margin-bottom: 10px;">Technology Blueprint</h4>
          <div style="display: flex; flex-wrap: wrap; gap: 8px;">${stackHtml}</div>
        </div>
      ` : ''}

      <div style="display: flex; gap: 14px; flex-wrap: wrap;">
        <button class="btn-primary" style="flex: 1;" onclick="closeCaseStudyModal(); openConsultationModal('${data.title.replace(/'/g, "\\'")}');">
          <span>Build a Similar Product</span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>
        <a href="https://wa.me/919876543210?text=Hi%20ClickCodex,%20I%20am%20interested%20in%20a%20solution%20like%20${encodeURIComponent(data.title)}" 
           target="_blank" rel="noopener noreferrer" class="whatsapp-btn" style="padding: 12px 20px;">
          <span>WhatsApp Quick Discuss</span>
        </a>
      </div>
    `;

    const modal = document.getElementById('caseModal');
    if (modal) {
      modal.classList.add('open');
      document.body.style.overflow = 'hidden';
    }
  };

  window.closeCaseStudyModal = function() {
    const modal = document.getElementById('caseModal');
    if (modal) {
      modal.classList.remove('open');
      document.body.style.overflow = '';
    }
  };

  window.handleCaseBackdrop = function(e) {
    if (e.target.id === 'caseModal') {
      closeCaseStudyModal();
    }
  };
</script>

<?php include __DIR__ . '/layout/footer.php'; ?>
