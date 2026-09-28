<?php
/**
 * ClickCodex Technologies - Global Header Layout
 * Reusable across all pages: Home, About Us, Services, Portfolio, Pricing, Blogs, Contact Us, Legal
 */
declare(strict_types=1);

if (!defined('BASE_URL')) {
    define('BASE_URL', '');
}
?>
<?php
$siteRoot = defined('BASE_URL') && !empty(BASE_URL) ? rtrim(BASE_URL, '/') : 'https://clickcodex.com';

// 1. Build canonical absolute URL
$rawCanonical = $seo['canonical_url'] ?? '';
if (!empty($rawCanonical) && (str_starts_with($rawCanonical, 'http://') || str_starts_with($rawCanonical, 'https://'))) {
    $canonicalUrl = $rawCanonical;
} elseif (!empty($rawCanonical)) {
    $canonicalUrl = $siteRoot . '/' . ltrim($rawCanonical, '/');
} else {
    $currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
    if ($scriptDir !== '/' && str_starts_with($currentPath, $scriptDir)) {
        $currentPath = substr($currentPath, strlen($scriptDir));
    }
    $canonicalUrl = $siteRoot . ($currentPath === '' ? '/' : $currentPath);
}

// 2. Fallback social images & robots indexing
$ogImage = !empty($seo['og_image']) ? $seo['og_image'] : ($siteRoot . '/public/assets/images/logo.png');
$twitterImage = !empty($seo['twitter_image']) ? $seo['twitter_image'] : $ogImage;
$robotsIndex = (!isset($seo['robots_index']) || $seo['robots_index']) ? 'index' : 'noindex';
$robotsFollow = (!isset($seo['robots_follow']) || $seo['robots_follow']) ? 'follow' : 'nofollow';

// 3. Prepare Schema Graph
$schemaGraph = [
    [
        "@type" => "Organization",
        "@id" => $siteRoot . "/#organization",
        "name" => $settings['site_name'] ?? 'Click Codex Technologies',
        "alternateName" => "ClickCodex",
        "url" => $siteRoot,
        "logo" => [
            "@type" => "ImageObject",
            "url" => $siteRoot . "/public/assets/images/logo.png",
            "width" => 512,
            "height" => 512
        ],
        "email" => $settings['contact_email'] ?? 'hello@clickcodex.com',
        "telephone" => $settings['contact_phone'] ?? '+919876543210',
        "description" => $settings['meta_description'] ?? 'Click Codex is an agile technology startup and creative studio providing practical web development, mobile apps, software solutions, UI/UX design, and short-form video production.',
        "address" => [
            "@type" => "PostalAddress",
            "addressLocality" => "Bangalore",
            "addressRegion" => "Karnataka",
            "addressCountry" => "IN"
        ],
        "sameAs" => array_values(array_filter([
            $settings['social_linkedin'] ?? 'https://linkedin.com',
            $settings['social_twitter'] ?? 'https://twitter.com',
            $settings['social_instagram'] ?? 'https://instagram.com',
            $settings['social_youtube'] ?? 'https://youtube.com'
        ]))
    ],
    [
        "@type" => "WebSite",
        "@id" => $siteRoot . "/#website",
        "url" => $siteRoot,
        "name" => "Click Codex",
        "publisher" => [
            "@id" => $siteRoot . "/#organization"
        ],
        "potentialAction" => [
            "@type" => "SearchAction",
            "target" => $siteRoot . "/blogs?q={search_term_string}",
            "query-input" => "required name=search_term_string"
        ]
    ],
    [
        "@type" => "WebPage",
        "@id" => $canonicalUrl . "#webpage",
        "url" => $canonicalUrl,
        "name" => $seo['meta_title'] ?? 'Click Codex | Ideas to Solutions - Technology & Creative Studio',
        "description" => $seo['meta_description'] ?? 'Click Codex is an agile technology startup providing practical web development, custom software, UI/UX design, and creative media production.',
        "isPartOf" => [
            "@id" => $siteRoot . "/#website"
        ],
        "breadcrumb" => [
            "@id" => $canonicalUrl . "#breadcrumb"
        ]
    ]
];

// Breadcrumbs Schema
$breadcrumbItems = [
    [
        "@type" => "ListItem",
        "position" => 1,
        "name" => "Home",
        "item" => $siteRoot . "/"
    ]
];
if (!empty($breadcrumbs)) {
    foreach ($breadcrumbs as $bPos => $bItem) {
        $breadcrumbItems[] = [
            "@type" => "ListItem",
            "position" => $bPos + 2,
            "name" => $bItem['name'],
            "item" => (str_starts_with($bItem['url'], 'http') ? $bItem['url'] : ($siteRoot . '/' . ltrim($bItem['url'], '/')))
        ];
    }
}
$schemaGraph[] = [
    "@type" => "BreadcrumbList",
    "@id" => $canonicalUrl . "#breadcrumb",
    "itemListElement" => $breadcrumbItems
];

// FAQ Schema if FAQs exist on page
if (!empty($faqs) && is_array($faqs)) {
    $faqEntities = [];
    foreach ($faqs as $f) {
        if (!empty($f['question']) && !empty($f['answer'])) {
            $faqEntities[] = [
                "@type" => "Question",
                "name" => strip_tags($f['question']),
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => strip_tags($f['answer'])
                ]
            ];
        }
    }
    if (!empty($faqEntities)) {
        $schemaGraph[] = [
            "@type" => "FAQPage",
            "mainEntity" => $faqEntities
        ];
    }
}

// Blog Article Schema if single post
if (!empty($post) && !empty($post['title'])) {
    $schemaGraph[] = [
        "@type" => "BlogPosting",
        "@id" => $canonicalUrl . "#article",
        "isPartOf" => [
            "@id" => $canonicalUrl . "#webpage"
        ],
        "headline" => $post['title'],
        "description" => $post['excerpt'] ?? '',
        "inLanguage" => "en-US",
        "mainEntityOfPage" => $canonicalUrl,
        "datePublished" => !empty($post['published_at']) ? date('c', strtotime($post['published_at'])) : date('c'),
        "dateModified" => !empty($post['updated_at']) ? date('c', strtotime($post['updated_at'])) : date('c'),
        "author" => [
            "@type" => "Person",
            "name" => $post['author_name'] ?? 'Click Codex Editorial Team'
        ],
        "publisher" => [
            "@id" => $siteRoot . "/#organization"
        ],
        "image" => !empty($post['featured_image']) ? $post['featured_image'] : $ogImage
    ];
}

// Service Schema if single service detail
if (!empty($service) && !empty($service['title'])) {
    $schemaGraph[] = [
        "@type" => "Service",
        "@id" => $canonicalUrl . "#service",
        "name" => $service['title'],
        "serviceType" => $service['badge_label'] ?? $service['title'],
        "description" => $service['short_description'] ?? '',
        "provider" => [
            "@id" => $siteRoot . "/#organization"
        ],
        "areaServed" => ["IN", "US", "AE", "GB", "Global"]
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Advanced SEO Meta Tags -->
  <title><?= htmlspecialchars($seo['meta_title'] ?? 'Click Codex | Ideas to Solutions - Technology & Creative Studio') ?></title>
  <meta name="description" content="<?= htmlspecialchars($seo['meta_description'] ?? 'Click Codex is an agile technology startup and creative studio providing practical web development, mobile apps, software solutions, UI/UX design, and short-form video production.') ?>" />
  <meta name="keywords" content="<?= htmlspecialchars($seo['meta_keywords'] ?? 'Click Codex, web development startup, mobile app development, UI UX design, digital marketing, website development India, custom software') ?>" />
  <meta name="author" content="<?= htmlspecialchars($settings['site_name'] ?? 'Click Codex Technologies') ?>" />
  <meta name="robots" content="<?= $robotsIndex ?>, <?= $robotsFollow ?>, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
  <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>" />
  <meta name="theme-color" content="<?= htmlspecialchars($settings['theme_color'] ?? '#0056d6') ?>" />

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="<?= htmlspecialchars($seo['og_type'] ?? (!empty($post) ? 'article' : 'website')) ?>" />
  <meta property="og:site_name" content="<?= htmlspecialchars($settings['site_name'] ?? 'Click Codex Technologies') ?>" />
  <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>" />
  <meta property="og:title" content="<?= htmlspecialchars($seo['og_title'] ?? $seo['meta_title'] ?? 'Click Codex | Ideas to Solutions - Technology & Creative Studio') ?>" />
  <meta property="og:description" content="<?= htmlspecialchars($seo['og_description'] ?? $seo['meta_description'] ?? '') ?>" />
  <meta property="og:image" content="<?= htmlspecialchars($ogImage) ?>" />
  <meta property="og:image:alt" content="<?= htmlspecialchars($settings['site_name'] ?? 'Click Codex') ?> Digital Solutions" />
  <meta property="og:locale" content="en_US" />

  <!-- Twitter / X Cards -->
  <meta name="twitter:card" content="<?= htmlspecialchars($seo['twitter_card'] ?? 'summary_large_image') ?>" />
  <meta name="twitter:site" content="@ClickCodex" />
  <meta name="twitter:creator" content="@ClickCodex" />
  <meta name="twitter:title" content="<?= htmlspecialchars($seo['twitter_title'] ?? $seo['meta_title'] ?? 'Click Codex | Ideas to Solutions') ?>" />
  <meta name="twitter:description" content="<?= htmlspecialchars($seo['twitter_description'] ?? $seo['meta_description'] ?? '') ?>" />
  <meta name="twitter:image" content="<?= htmlspecialchars($twitterImage) ?>" />

  <!-- Favicon, App Icons & Web Manifest -->
  <?php 
    $faviconUrl = !empty($settings['site_favicon']) 
      ? ((str_starts_with($settings['site_favicon'], 'http') || str_starts_with($settings['site_favicon'], '/')) ? $settings['site_favicon'] : (BASE_URL . '/' . ltrim($settings['site_favicon'], '/'))) 
      : (BASE_URL . '/public/assets/images/logo.png');
  ?>
  <link rel="icon" type="image/png" href="<?= htmlspecialchars($faviconUrl) ?>" />
  <link rel="apple-touch-icon" href="<?= htmlspecialchars($faviconUrl) ?>" />
  <link rel="manifest" href="<?= BASE_URL ?>/public/site.webmanifest" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

  <!-- Google Fonts: Plus Jakarta Sans, Poppins & Space Mono -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800;900&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet" />

  <!-- Dynamic Brand Color Overrides (site_settings: brand_primary_color, brand_accent_color) -->
  <style>
    :root {
      <?php if (!empty($settings['brand_primary_color'])): ?>
        --brand-blue: <?= htmlspecialchars($settings['brand_primary_color']) ?>;
        --brand-blue-hover: <?= htmlspecialchars($settings['brand_primary_color']) ?>;
      <?php endif; ?>
      <?php if (!empty($settings['brand_accent_color'])): ?>
        --brand-cyan: <?= htmlspecialchars($settings['brand_accent_color']) ?>;
        --brand-cyan-glow: <?= htmlspecialchars($settings['brand_accent_color']) ?>40;
      <?php endif; ?>
    }
  </style>

  <!-- Google Analytics 4 (Dynamic via site_settings: google_analytics_id) -->
  <?php if (!empty($settings['google_analytics_id'])): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= htmlspecialchars($settings['google_analytics_id']) ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '<?= htmlspecialchars($settings['google_analytics_id']) ?>');
    </script>
  <?php endif; ?>

  <!-- Google Tag Manager (Dynamic via site_settings: google_tag_manager_id) -->
  <?php if (!empty($settings['google_tag_manager_id'])): ?>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?= htmlspecialchars($settings['google_tag_manager_id']) ?>');</script>
  <?php endif; ?>

  <!-- Meta Pixel (Dynamic via site_settings: meta_pixel_id) -->
  <?php if (!empty($settings['meta_pixel_id'])): ?>
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '<?= htmlspecialchars($settings['meta_pixel_id']) ?>');
      fbq('track', 'PageView');
    </script>
  <?php endif; ?>

  <!-- Schema.org JSON-LD Structured Data Graph -->
  <script type="application/ld+json">
  <?= json_encode(["@context" => "https://schema.org", "@graph" => $schemaGraph], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
  </script>

  <!-- Complete Exact Stylesheet -->
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/style.css" />
  <?php if (!empty($extraCss)): ?>
    <link rel="stylesheet" href="<?= $extraCss ?>" />
  <?php endif; ?>
  <?php if (!empty($extraHead)): ?>
    <?= $extraHead ?>
  <?php endif; ?>

  <!-- Universal Navbar Responsive Action Controls (WhatsApp Icon & Talk To Us Button) -->
  <style>
    /* Brand Logo Only (Header) */
    .brand-logo-wrap {
      display: inline-flex !important;
      align-items: center !important;
      text-decoration: none !important;
      flex-shrink: 0 !important;
    }

    .brand-logo-img {
      height: 48px !important;
      max-height: 48px !important;
      width: auto !important;
      object-fit: contain !important;
      transition: transform 0.25s ease !important;
      display: block !important;
    }

    .brand-logo-wrap:hover .brand-logo-img {
      transform: scale(1.04) !important;
    }

    /* Completely hide text name/tagline in header */
    .site-nav .brand-name-group {
      display: none !important;
    }

    /* Nav Action Container */
    .nav-actions {
      display: inline-flex !important;
      align-items: center !important;
      gap: 12px !important;
      flex-shrink: 0 !important;
    }

    /* WhatsApp Icon-Only Action Button */
    .whatsapp-btn {
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      width: 40px !important;
      height: 40px !important;
      min-width: 40px !important;
      min-height: 40px !important;
      padding: 0 !important;
      border-radius: 50% !important;
      background: #25D366 !important;
      color: #ffffff !important;
      box-shadow: 0 4px 14px rgba(37, 211, 102, 0.38) !important;
      transition: transform 0.25s cubic-bezier(0.23, 1, 0.32, 1), box-shadow 0.25s ease, background 0.2s ease !important;
      flex-shrink: 0 !important;
      text-decoration: none !important;
      border: none !important;
    }

    .whatsapp-btn:hover {
      background: #20ba59 !important;
      transform: scale(1.08) translateY(-1px) !important;
      box-shadow: 0 6px 20px rgba(37, 211, 102, 0.55) !important;
      color: #ffffff !important;
    }

    .whatsapp-btn:active {
      transform: scale(0.95) !important;
    }

    .whatsapp-btn svg {
      width: 21px !important;
      height: 21px !important;
      fill: #ffffff !important;
      display: block !important;
      margin: 0 !important;
    }

    /* Talk To Us Action Button */
    .nav-talk-btn {
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      padding: 10px 22px !important;
      border-radius: 9999px !important;
      background: var(--gradient-blue-cyan, linear-gradient(135deg, #0056d6 0%, #00a2ff 100%)) !important;
      color: #ffffff !important;
      font-family: var(--font-display, inherit) !important;
      font-size: 0.88rem !important;
      font-weight: 700 !important;
      white-space: nowrap !important;
      text-decoration: none !important;
      border: none !important;
      cursor: pointer !important;
      box-shadow: 0 4px 16px rgba(0, 86, 214, 0.3) !important;
      transition: transform 0.25s ease, box-shadow 0.25s ease !important;
      flex-shrink: 0 !important;
      line-height: 1 !important;
    }

    .nav-talk-btn:hover {
      transform: translateY(-2px) !important;
      box-shadow: 0 8px 24px rgba(0, 86, 214, 0.45) !important;
      color: #ffffff !important;
    }

    .nav-talk-btn:active {
      transform: translateY(0) scale(0.98) !important;
    }

    /* Mobile & Tablet Responsiveness */
    @media (max-width: 991px) {
      .nav-actions {
        gap: 10px !important;
      }
      .whatsapp-btn {
        width: 38px !important;
        height: 38px !important;
        min-width: 38px !important;
        min-height: 38px !important;
      }
      .whatsapp-btn svg {
        width: 19px !important;
        height: 19px !important;
      }
      .nav-talk-btn {
        padding: 9px 18px !important;
        font-size: 0.84rem !important;
      }
    }

    @media (max-width: 768px) {
      .nav-actions {
        gap: 8px !important;
      }
      .whatsapp-btn {
        width: 36px !important;
        height: 36px !important;
        min-width: 36px !important;
        min-height: 36px !important;
      }
      .whatsapp-btn svg {
        width: 18px !important;
        height: 18px !important;
      }
      .nav-talk-btn {
        padding: 8px 14px !important;
        font-size: 0.8rem !important;
      }
      .brand-logo-img {
        height: 40px !important;
        max-height: 40px !important;
        width: auto !important;
      }
    }

    @media (max-width: 480px) {
      .nav-actions {
        gap: 6px !important;
      }
      .whatsapp-btn {
        width: 34px !important;
        height: 34px !important;
        min-width: 34px !important;
        min-height: 34px !important;
      }
      .whatsapp-btn svg {
        width: 17px !important;
        height: 17px !important;
      }
      .nav-talk-btn {
        padding: 7px 11px !important;
        font-size: 0.76rem !important;
      }
      .brand-logo-img {
        height: 35px !important;
        max-height: 35px !important;
        width: auto !important;
      }
      .mobile-menu-toggle {
        width: 34px !important;
        height: 34px !important;
        padding: 6px !important;
      }
    }

    @media (max-width: 360px) {
      .nav-actions {
        gap: 5px !important;
      }
      .nav-talk-btn {
        padding: 6px 9px !important;
        font-size: 0.72rem !important;
      }
      .whatsapp-btn {
        width: 32px !important;
        height: 32px !important;
        min-width: 32px !important;
        min-height: 32px !important;
      }
      .whatsapp-btn svg {
        width: 16px !important;
        height: 16px !important;
      }
      .brand-logo-img {
        height: 30px !important;
        max-height: 30px !important;
        width: auto !important;
      }
    }
  </style>

  <!-- Custom Injected Head Scripts (Configurable in Admin Settings) -->
  <?php if (!empty($settings['custom_head_scripts'])): ?>
    <?= $settings['custom_head_scripts'] ?>
  <?php endif; ?>
</head>
<body>
  <?php if (!empty($settings['google_tag_manager_id'])): ?>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= htmlspecialchars($settings['google_tag_manager_id']) ?>"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <?php endif; ?>

  <!-- Ambient Cursor Spotlight (active on hover across site) -->
  <div class="cursor-spotlight-orb" id="cursorSpotlight"></div>

  <!-- ==========================================================================
       1. NAVIGATION BAR (STICKY & GLASSMORPHIC)
       ========================================================================== -->
  <nav class="site-nav" id="siteNav">
    <div class="container nav-container">
      <!-- ClickCodex Logo (Dynamic via site_settings: site_logo) -->
      <?php 
        $navLogo = !empty($settings['site_logo']) 
          ? ((str_starts_with($settings['site_logo'], 'http') || str_starts_with($settings['site_logo'], '/')) ? $settings['site_logo'] : (BASE_URL . '/' . ltrim($settings['site_logo'], '/'))) 
          : (BASE_URL . '/public/assets/images/logo.png');
      ?>
      <a href="<?= BASE_URL ?>/" class="brand-logo-wrap" aria-label="ClickCodex Home">
        <img src="<?= htmlspecialchars($navLogo) ?>" alt="ClickCodex" class="brand-logo-img" />
      </a>

      <!-- Desktop Navigation Links -->
      <ul class="nav-menu">
        <li><a href="<?= BASE_URL ?>/" class="nav-link <?= ($activeNav ?? '') === 'home' ? 'active' : '' ?>">Home</a></li>
        <li><a href="<?= BASE_URL ?>/aboutus" class="nav-link <?= ($activeNav ?? '') === 'aboutus' ? 'active' : '' ?>">About</a></li>
        <li><a href="<?= BASE_URL ?>/services" class="nav-link <?= ($activeNav ?? '') === 'services' ? 'active' : '' ?>">Services</a></li>
        <li><a href="<?= BASE_URL ?>/service-finder" class="nav-link <?= ($activeNav ?? '') === 'service-finder' ? 'active' : '' ?>">Advisor</a></li>
        <li><a href="<?= BASE_URL ?>/portfolio" class="nav-link <?= ($activeNav ?? '') === 'portfolio' ? 'active' : '' ?>">Portfolio</a></li>
        <li><a href="<?= BASE_URL ?>/pricing" class="nav-link <?= ($activeNav ?? '') === 'pricing' ? 'active' : '' ?>">Pricing</a></li>
        <li><a href="<?= BASE_URL ?>/blogs" class="nav-link <?= ($activeNav ?? '') === 'blogs' ? 'active' : '' ?>">Blogs</a></li>
        <li><a href="<?= BASE_URL ?>/contactus" class="nav-link <?= ($activeNav ?? '') === 'contactus' ? 'active' : '' ?>">Contact</a></li>
      </ul>

      <!-- Action Buttons -->
      <div class="nav-actions">
        <!-- WhatsApp Quick Chat (Icon Only) -->
        <?php 
          $rawPhone = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '919876543210');
          $waMsg = urlencode($settings['whatsapp_default_message'] ?? 'Hi ClickCodex, I would like to inquire about a project');
        ?>
        <a href="https://wa.me/<?= $rawPhone ?>?text=<?= $waMsg ?>" 
           target="_blank" rel="noopener noreferrer" class="whatsapp-btn" title="Quick Chat on WhatsApp" aria-label="Quick Chat on WhatsApp">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
          </svg>
        </a>

        <!-- Talk to Us CTA (Visible & Responsive across Desktop, Tablet & Mobile) -->
        <button type="button" class="btn-primary nav-talk-btn" onclick="openConsultationModal()">Talk To Us</button>

        <!-- Mobile Menu Toggle Button -->
        <button class="mobile-menu-toggle" id="mobileToggle" aria-label="Toggle Navigation">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
    </div>
  </nav>

  <!-- Mobile Drawer Menu -->
  <div class="mobile-drawer" id="mobileDrawer">
    <a href="<?= BASE_URL ?>/" class="nav-link <?= ($activeNav ?? '') === 'home' ? 'active' : '' ?>" onclick="closeMobileDrawer()">Home</a>
    <a href="<?= BASE_URL ?>/aboutus" class="nav-link <?= ($activeNav ?? '') === 'aboutus' ? 'active' : '' ?>" onclick="closeMobileDrawer()">About Click Codex</a>
    <a href="<?= BASE_URL ?>/services" class="nav-link <?= ($activeNav ?? '') === 'services' ? 'active' : '' ?>" onclick="closeMobileDrawer()">Our Services</a>
    <a href="<?= BASE_URL ?>/service-finder" class="nav-link <?= ($activeNav ?? '') === 'service-finder' ? 'active' : '' ?>" onclick="closeMobileDrawer()">Solution Advisor</a>
    <a href="<?= BASE_URL ?>/portfolio" class="nav-link <?= ($activeNav ?? '') === 'portfolio' ? 'active' : '' ?>" onclick="closeMobileDrawer()">Portfolio & Showcase</a>
    <a href="<?= BASE_URL ?>/pricing" class="nav-link <?= ($activeNav ?? '') === 'pricing' ? 'active' : '' ?>" onclick="closeMobileDrawer()">Pricing & Models</a>
    <a href="<?= BASE_URL ?>/blogs" class="nav-link <?= ($activeNav ?? '') === 'blogs' ? 'active' : '' ?>" onclick="closeMobileDrawer()">Blogs & Guides</a>
    <a href="<?= BASE_URL ?>/contactus" class="nav-link <?= ($activeNav ?? '') === 'contactus' ? 'active' : '' ?>" onclick="closeMobileDrawer()">Contact & Inquiries</a>
    <button class="btn-primary" style="width: 100%; margin-top: 15px;" onclick="closeMobileDrawer(); openConsultationModal();">Book Free Consultation</button>
  </div>
