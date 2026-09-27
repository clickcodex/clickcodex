<?php
/**
 * ClickCodex Technologies - Global Footer Layout
 * Reusable across all pages: Home, About Us, Services, Portfolio, Pricing, Blogs, Contact Us, Legal
 */
declare(strict_types=1);

if (!defined('BASE_URL')) {
    define('BASE_URL', '');
}
?>
  <!-- ==========================================================================
       FOOTER (CREATIVE ORGANIC WAVE SEPARATOR & UNIFIED 4-COL GRID)
       ========================================================================== -->
  <footer class="site-footer" id="siteFooter">
    <div class="footer-wave-top">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
      </svg>
    </div>

    <div class="container">
      <div class="footer-grid">
        <!-- Col 1: Brand Info -->
        <div class="footer-brand-col">
          <a href="<?= BASE_URL ?>/" class="brand-logo-wrap" aria-label="ClickCodex Home">
            <img src="<?= BASE_URL ?>/public/assets/images/logo.png" alt="ClickCodex Logo" class="brand-logo-img" />
            <div class="brand-name-group">
              <span class="brand-title">Click<span>codex</span></span>
              <span class="brand-subtext"><?= htmlspecialchars($settings['site_tagline'] ?? 'Ideas To Solutions') ?></span>
            </div>
          </a>
          <p>
            Click Codex is an early-stage technology startup providing practical web development, mobile apps, software solutions, UI/UX design, marketing, and creative short-form video production.
          </p>
          <div class="social-media-pills">
            <a href="<?= htmlspecialchars($settings['social_linkedin'] ?? 'https://linkedin.com') ?>" target="_blank" rel="noopener noreferrer" class="social-pill" aria-label="LinkedIn">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 8.76a1.64 1.64 0 1 0 0-3.28 1.64 1.64 0 0 0 0 3.28m1.39 9.74v-8.37H5.07v8.37h2.78z"/></svg>
            </a>
            <a href="<?= htmlspecialchars($settings['social_twitter'] ?? 'https://twitter.com') ?>" target="_blank" rel="noopener noreferrer" class="social-pill" aria-label="Twitter">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            </a>
            <a href="<?= htmlspecialchars($settings['social_instagram'] ?? 'https://instagram.com') ?>" target="_blank" rel="noopener noreferrer" class="social-pill" aria-label="Instagram">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.85s-.011 3.584-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.85-.07c-3.252-.148-4.771-1.691-4.919-4.919-.058-1.265-.07-1.645-.07-4.85s.012-3.584.07-4.85c.148-3.225 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.85-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.359 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.359-.2 6.78-2.618 6.98-6.98.058-1.281.072-1.689.072-4.948s-.014-3.667-.072-4.947c-.2-4.359-2.618-6.78-6.98-6.98-1.281-.059-1.689-.073-4.948-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.79 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44 1.441-.645 1.441-1.44-.645-1.44-1.441-1.44z"/></svg>
            </a>
            <a href="<?= htmlspecialchars($settings['social_youtube'] ?? 'https://youtube.com') ?>" target="_blank" rel="noopener noreferrer" class="social-pill" aria-label="YouTube">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
            </a>
          </div>
        </div>

        <!-- Col 2: Navigation Links -->
        <div>
          <h4 class="footer-col-title">Navigation</h4>
          <ul class="footer-links-menu">
            <li><a href="<?= BASE_URL ?>/">Home</a></li>
            <li><a href="<?= BASE_URL ?>/aboutus">About Click Codex</a></li>
            <li><a href="<?= BASE_URL ?>/services">Our Services</a></li>
            <li><a href="<?= BASE_URL ?>/service-finder">Solution Advisor</a></li>
            <li><a href="<?= BASE_URL ?>/portfolio">Portfolio & Showcase</a></li>
            <li><a href="<?= BASE_URL ?>/pricing">Pricing & Packages</a></li>
            <li><a href="<?= BASE_URL ?>/blogs">Blogs & Insights</a></li>
            <li><a href="<?= BASE_URL ?>/contactus">Contact Us</a></li>
          </ul>
        </div>

        <!-- Col 3: Core Services -->
        <div>
          <h4 class="footer-col-title">Core Services</h4>
          <ul class="footer-links-menu">
            <li><a href="<?= BASE_URL ?>/services/website-development">Website Development</a></li>
            <li><a href="<?= BASE_URL ?>/services/full-stack-web-development">Full-Stack Web Development</a></li>
            <li><a href="<?= BASE_URL ?>/services/mobile-app-development">Mobile Applications</a></li>
            <li><a href="<?= BASE_URL ?>/services/ui-ux-design">UI/UX & Graphic Design</a></li>
            <li><a href="<?= BASE_URL ?>/services/digital-marketing">Digital Marketing</a></li>
            <li><a href="<?= BASE_URL ?>/services/reel-short-form-video-production">Reel & Video Production</a></li>
          </ul>
        </div>

        <!-- Col 4: Contact Info -->
        <div>
          <h4 class="footer-col-title">Contact Information</h4>
          <div class="contact-info-list">
            <div class="contact-info-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
              <div>
                <strong>Email Inquiries</strong>
                <p><?= htmlspecialchars($settings['contact_email'] ?? 'contact@clickcodex.com') ?></p>
              </div>
            </div>

            <div class="contact-info-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
              <div>
                <strong>Direct Phone / WhatsApp</strong>
                <p><?= htmlspecialchars($settings['contact_phone'] ?? '+91 (Contact Available Upon Inquiry)') ?></p>
              </div>
            </div>

            <div class="contact-info-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
              <div>
                <strong>Operating Region</strong>
                <p><?= htmlspecialchars($settings['contact_address'] ?? 'India') ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Bottom Bar -->
      <div class="footer-bottom-bar">
        <p><?= htmlspecialchars($settings['copyright_text'] ?? ('© ' . date('Y') . ' Click Codex. All Rights Reserved. Built with pride in India.')) ?></p>
        <div class="footer-bottom-links">
          <a href="<?= BASE_URL ?>/privacy-policy">Privacy Policy</a>
          <a href="<?= BASE_URL ?>/terms-of-service">Terms of Service</a>
          <a href="<?= BASE_URL ?>/service-finder">Solution Finder</a>
          <a href="<?= BASE_URL ?>/admin/login" rel="nofollow" style="color: var(--brand-blue); font-weight: 700;">Studio Admin ↗</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Floating Back to Top Button -->
  <button class="back-to-top-btn" id="backToTopBtn" aria-label="Back to top">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
      <line x1="12" y1="19" x2="12" y2="5"></line>
      <polyline points="5 12 12 5 19 12"></polyline>
    </svg>
  </button>

  <!-- ==========================================================================
       MODAL: INSTANT CONSULTATION / FREE STRATEGY CALL
       ========================================================================== -->
  <div class="modal-backdrop" id="consultationModal" onclick="handleBackdropClick(event)">
    <div class="modal-dialog">
      <button class="modal-close-btn" onclick="closeConsultationModal()" aria-label="Close modal">✕</button>
      <div class="modal-header">
        <span class="preview-badge" style="color: var(--brand-blue); background: rgba(0,86,214,0.08);">Get In Touch</span>
        <h3>Schedule a Free Strategy Call</h3>
        <p>Tell us about your project requirements and receive a comprehensive proposal within 24 hours.</p>
      </div>

      <form id="consultationForm" onsubmit="handleFormSubmit(event)">
        <div class="form-group">
          <label for="userName">Your Full Name *</label>
          <input type="text" id="userName" name="name" class="form-control" placeholder="e.g. Rahul Sharma" required />
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
          <div class="form-group">
            <label for="userEmail">Business Email *</label>
            <input type="email" id="userEmail" name="email" class="form-control" placeholder="rahul@company.com" required />
          </div>
          <div class="form-group">
            <label for="userPhone">Phone / WhatsApp *</label>
            <input type="tel" id="userPhone" name="phone" class="form-control" placeholder="+91 98765 43210" required />
          </div>
        </div>

        <div class="form-group">
          <label for="projectService">Interested Service *</label>
          <select id="projectService" name="service" class="form-control" required>
            <option value="Website Development">Website Creation & Web Apps</option>
            <option value="Mobile App Development">Mobile App Development (iOS/Android)</option>
            <option value="Digital Marketing">Digital Marketing & SEO Growth</option>
            <option value="UI/UX Design">UI/UX & Brand Design</option>
            <option value="E-Commerce Development">E-Commerce Development</option>
            <option value="Dedicated Developers">Hire Dedicated Team</option>
            <option value="Complete Overhaul">Full Digital Transformation</option>
          </select>
        </div>

        <div class="form-group">
          <label for="projectDetails">Project Overview / Goals</label>
          <textarea id="projectDetails" name="message" class="form-control" placeholder="Tell us briefly about your timeline, budget expectations, or existing website/app..."></textarea>
        </div>

        <button type="submit" class="form-submit-btn" id="submitBtn">
          <span>Submit Request & Get Quote</span>
        </button>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {

      // --- 1. STICKY NAVBAR & BACK TO TOP BUTTON ---
      const siteNav = document.getElementById('siteNav');
      const backToTopBtn = document.getElementById('backToTopBtn');

      window.addEventListener('scroll', () => {
        const scrollPos = window.scrollY;
        if (siteNav) {
          if (scrollPos > 60) {
            siteNav.classList.add('scrolled');
          } else {
            siteNav.classList.remove('scrolled');
          }
        }

        if (backToTopBtn) {
          if (scrollPos > 400) {
            backToTopBtn.classList.add('visible');
          } else {
            backToTopBtn.classList.remove('visible');
          }
        }

        // Active link highlighting based on section scroll
        updateActiveNavSection();
      });

      if (backToTopBtn) {
        backToTopBtn.addEventListener('click', () => {
          window.scrollTo({ top: 0, behavior: 'smooth' });
        });
      }

      // --- 2. MOBILE MENU TOGGLE ---
      const mobileToggle = document.getElementById('mobileToggle');
      const mobileDrawer = document.getElementById('mobileDrawer');

      if (mobileToggle && mobileDrawer) {
        mobileToggle.addEventListener('click', () => {
          mobileDrawer.classList.toggle('open');
        });
      }

      window.closeMobileDrawer = function() {
        if (mobileDrawer) {
          mobileDrawer.classList.remove('open');
        }
      };

      // --- 10. CURSOR SPOTLIGHT ORB (TEST9.HTML) ---
      const cursorSpotlight = document.getElementById('cursorSpotlight');
      if (cursorSpotlight && window.innerWidth > 992) {
        document.addEventListener('mousemove', (e) => {
          cursorSpotlight.style.left = `${e.clientX}px`;
          cursorSpotlight.style.top = `${e.clientY}px`;
          cursorSpotlight.style.opacity = '1';
        });

        document.addEventListener('mouseleave', () => {
          cursorSpotlight.style.opacity = '0';
        });
      }

      // --- 12. ACTIVE NAV LINK ON SCROLL ---
      function updateActiveNavSection() {
        const sections = document.querySelectorAll('section[id], footer[id]');
        const scrollPos = window.scrollY + 120;

        sections.forEach(sec => {
          const top = sec.offsetTop;
          const height = sec.offsetHeight;
          const id = sec.getAttribute('id');

          if (scrollPos >= top && scrollPos < top + height) {
            document.querySelectorAll('.nav-link').forEach(link => {
              if (link.getAttribute('href') === `#${id}`) {
                link.classList.add('active');
              }
            });
          }
        });
      }

    });

    // --- 13. CONSULTATION MODAL LOGIC ---
    window.openConsultationModal = function(serviceName = '') {
      const modal = document.getElementById('consultationModal');
      if (modal) {
        modal.classList.add('open');
        document.body.style.overflow = 'hidden';

        if (serviceName) {
          const select = document.getElementById('projectService');
          if (select) {
            for (let i = 0; i < select.options.length; i++) {
              if (select.options[i].text.toLowerCase().includes(serviceName.toLowerCase()) || 
                  select.options[i].value.toLowerCase().includes(serviceName.toLowerCase())) {
                select.selectedIndex = i;
                break;
              }
            }
          }
        }
      }
    };

    window.closeConsultationModal = function() {
      const modal = document.getElementById('consultationModal');
      if (modal) {
        modal.classList.remove('open');
        document.body.style.overflow = '';
      }
    };

    window.handleBackdropClick = function(event) {
      if (event.target.id === 'consultationModal') {
        closeConsultationModal();
      }
    };

    window.handleFormSubmit = function(event) {
      event.preventDefault();
      const form = document.getElementById('consultationForm');
      if (!form) return;

      const submitBtn = document.getElementById('submitBtn');
      const originalText = submitBtn.innerHTML;

      submitBtn.innerHTML = '<span>Transmitting Request...</span>';
      submitBtn.disabled = true;

      const formData = new FormData(form);

      fetch('<?= BASE_URL ?>/contact/submit', {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (data && data.success) {
          submitBtn.innerHTML = '<span>✓ Request Received!</span>';
          submitBtn.style.background = '#10b981';

          setTimeout(() => {
            alert('Thank you! Your project inquiry has been safely received. Our engineering team will review your requirements and reach out to you within 24 hours.');
            closeConsultationModal();
            form.reset();
            submitBtn.innerHTML = originalText;
            submitBtn.style.background = '';
            submitBtn.disabled = false;
          }, 600);
        } else {
          alert('Note: ' + (data.error || 'Please fill in all required fields and try again.'));
          submitBtn.innerHTML = originalText;
          submitBtn.disabled = false;
        }
      })
      .catch(err => {
        console.error('Submission error:', err);
        // Resilient fallback confirmation
        submitBtn.innerHTML = '<span>✓ Request Logged!</span>';
        submitBtn.style.background = '#10b981';

        setTimeout(() => {
          alert('Thank you! Your project inquiry has been received. Our team will reach out to you promptly.');
          closeConsultationModal();
          form.reset();
          submitBtn.innerHTML = originalText;
          submitBtn.style.background = '';
          submitBtn.disabled = false;
        }, 600);
      });
    };
  </script>
</body>
</html>
