-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: clickcodex_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `advisor_archetypes`
--

DROP TABLE IF EXISTS `advisor_archetypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advisor_archetypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `archetype_key` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `badge_text` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `best_for` varchar(255) NOT NULL,
  `checklists` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`checklists`)),
  `recommended_stack` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`recommended_stack`)),
  `time_to_market` varchar(50) NOT NULL,
  `investment_tier` varchar(50) NOT NULL,
  `scalability_ceiling` varchar(50) NOT NULL,
  `seo_dominance` varchar(50) NOT NULL,
  `maintenance_overhead` varchar(50) NOT NULL,
  `typical_team_pod` varchar(50) NOT NULL,
  `order_num` smallint(6) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `archetype_key` (`archetype_key`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advisor_archetypes`
--

LOCK TABLES `advisor_archetypes` WRITE;
/*!40000 ALTER TABLE `advisor_archetypes` DISABLE KEYS */;
INSERT INTO `advisor_archetypes` VALUES (1,'website_starter','Fast Business Website','Archetype 01','A clean, high-performance website tailored for businesses or personal brands wanting a credible online presence.','Startups, Local Businesses & Portfolios','[\"Mobile-first responsive design\",\"Fast load times & basic SEO\",\"Direct inquiry contact forms\"]','[\"HTML5\",\"CSS3\",\"JavaScript\",\"PHP\",\"Responsive Grid\"]','2 – 3 Weeks','Starter Tier','Standard Web','Targeted Local & Brand SEO','Minimal','Web Developer & Designer',1,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(2,'fullstack_solution','Custom Full-Stack Web App','Archetype 02','Dynamic web application with user logins, custom workflows, database operations, and API integrations.','Web Applications & Internal Systems','[\"Custom database schema design\",\"User authentication & access control\",\"Dynamic frontend interfaces\"]','[\"PHP\",\"MySQL\",\"JavaScript\",\"REST APIs\",\"Modular MVC\"]','4 – 6 Weeks','Custom Web Tier','High','Application Level','Moderate','Full-Stack Developer & Designer',2,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(3,'branding_creative','Brand Identity & Design Suite','Archetype 03','Complete visual identity overhaul including logo design, UI/UX screens, social media creatives, and marketing graphics.','New Ventures & Brand Refreshes','[\"Vector logo and brand guide\",\"Figma UI\\/UX wireframes and prototype\",\"Social media creative batch\"]','[\"Figma\",\"Vector Design\",\"Social Formatting\",\"Brand Typography\"]','1 – 3 Weeks','Design Sprint Tier','Universal Brand Assets','Visual Recognition','None','UI/UX & Graphic Designer',3,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(4,'video_reel_production','Video & Reel Production Package','Archetype 04','Dynamic short-form video content creation, professional on-location reel shooting, and engaging social video editing.','Instagram, YouTube Shorts & Viral Engagement','[\"On-location \\/ studio video capture\",\"Kinetic captions and trending audio sync\",\"Fast-paced hook-driven editing\"]','[\"4K Video Gear\",\"Mobile Rigs\",\"Vertical Video Suite\",\"Sound Sync\"]','1 – 2 Weeks','Media Production Tier','High Social Reach','Social Platform Algorithms','Per Campaign','Video Producer & Creator',4,1,'2026-09-25 13:26:44','2026-09-25 13:26:44');
/*!40000 ALTER TABLE `advisor_archetypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advisor_submissions`
--

DROP TABLE IF EXISTS `advisor_submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advisor_submissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(100) DEFAULT NULL,
  `goal_selection` varchar(50) DEFAULT NULL,
  `stage_selection` varchar(50) DEFAULT NULL,
  `features_selected` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features_selected`)),
  `timeline_selection` varchar(50) DEFAULT NULL,
  `recommended_archetype_id` int(10) unsigned DEFAULT NULL,
  `client_name` varchar(150) DEFAULT NULL,
  `client_email` varchar(150) DEFAULT NULL,
  `client_phone` varchar(50) DEFAULT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `status` enum('new','contacted','proposal_sent','closed') DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_sub_archetype` (`recommended_archetype_id`),
  KEY `idx_sub_status` (`status`),
  CONSTRAINT `fk_sub_archetype` FOREIGN KEY (`recommended_archetype_id`) REFERENCES `advisor_archetypes` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advisor_submissions`
--

LOCK TABLES `advisor_submissions` WRITE;
/*!40000 ALTER TABLE `advisor_submissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `advisor_submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `action` varchar(100) NOT NULL,
  `entity_type` varchar(80) NOT NULL,
  `entity_id` int(10) unsigned DEFAULT NULL,
  `old_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`old_values`)),
  `new_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`new_values`)),
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_audit_user` (`user_id`),
  KEY `idx_audit_entity` (`entity_type`,`entity_id`),
  CONSTRAINT `fk_audit_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_logs`
--

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;
INSERT INTO `audit_logs` VALUES (1,1,'database_reset_and_populate','database',1,NULL,'{\"event\":\"Complete database reset and population for Click Codex startup profile\",\"team_size\":4,\"team_experience\":\"~2 Years in development and digital tech\",\"services_count\":12,\"projects_count\":5,\"company\":\"Click Codex\"}','127.0.0.1','CLI-Migration-Engine','2026-09-25 13:26:44');
/*!40000 ALTER TABLE `audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_authors`
--

DROP TABLE IF EXISTS `blog_authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_authors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `role_title` varchar(150) NOT NULL,
  `initials` varchar(10) NOT NULL,
  `avatar_image` varchar(500) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  `order_num` smallint(6) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_authors`
--

LOCK TABLES `blog_authors` WRITE;
/*!40000 ALTER TABLE `blog_authors` DISABLE KEYS */;
INSERT INTO `blog_authors` VALUES (1,'Click Codex Editorial Team','click-codex-editorial','Engineering & Creative Collective','CC','assets/images/logo.png','The Click Codex team publishes practical articles and engineering notes covering web development, responsive design, UI/UX aesthetics, and creative short-form video production.',NULL,NULL,NULL,1,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(2,'Aarav Sharma','aarav-sharma','Lead Web Strategist & Tech Consultant','AS','assets/images/logo.png','Advises founders, entrepreneurs, and businesses on choosing optimal web platforms, custom architectures, and performance-first website frameworks.',NULL,NULL,NULL,2,1,'2026-09-25 13:44:03','2026-09-25 13:44:03'),(3,'Sneha Patel','sneha-patel','Head of Digital Marketing & Growth','SP','assets/images/logo.png','Specializes in multi-channel digital growth, search visibility, conversion-optimized funnels, and data-driven client acquisition campaigns.',NULL,NULL,NULL,3,1,'2026-09-25 13:44:03','2026-09-25 13:44:03'),(4,'Rohan Verma','rohan-verma','Principal Software & Systems Architect','RV','assets/images/logo.png','Over 5 years evaluating software tradeoffs between cloud web applications, native/cross-platform mobile apps, and custom operational software systems.',NULL,NULL,NULL,4,1,'2026-09-25 13:44:03','2026-09-25 13:44:03'),(5,'Priya Nair','priya-nair','Lead UI/UX & Brand Identity Designer','PN','assets/images/logo.png','Pioneers user-centric interface design, wireframing systems, and brand visual identities that build instant trust and elevate conversion rates.',NULL,NULL,NULL,5,1,'2026-09-25 13:44:03','2026-09-25 13:44:03'),(6,'Karan Kapoor','karan-kapoor','Creative Video Director & Reel Specialist','KK','assets/images/logo.png','Directs on-location reel shooting, short-form video narrative structure, hook-driven editing, and high-engagement social media media creation.',NULL,NULL,NULL,6,1,'2026-09-25 13:44:03','2026-09-25 13:44:03');
/*!40000 ALTER TABLE `blog_authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `badge_color` varchar(50) DEFAULT '#0056d6',
  `badge_bg` varchar(50) DEFAULT 'rgba(0,86,214,0.08)',
  `order_num` smallint(6) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_categories`
--

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` VALUES (1,'Web & Tech Insights','web-tech-insights','Practical guides and engineering notes on modern web and software development.','#0056d6','rgba(0,86,214,0.08)',1,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(2,'Design & UI/UX','design-ui-ux','Principles of user interface design, logo aesthetics, and visual brand identity.','#8b5cf6','rgba(139,92,246,0.08)',2,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(3,'Digital Marketing & Media','marketing-media','Social media creatives, vertical reel techniques, and digital growth approaches.','#00a2ff','rgba(0,162,255,0.08)',3,1,'2026-09-25 13:26:44','2026-09-25 13:26:44');
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_comments`
--

DROP TABLE IF EXISTS `blog_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `author_name` varchar(100) NOT NULL,
  `author_email` varchar(150) NOT NULL,
  `comment_text` text NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 1,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_comment_post` (`post_id`,`is_approved`),
  KEY `fk_comment_parent` (`parent_id`),
  CONSTRAINT `fk_comment_parent` FOREIGN KEY (`parent_id`) REFERENCES `blog_comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_comment_post` FOREIGN KEY (`post_id`) REFERENCES `blog_posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_comments`
--

LOCK TABLES `blog_comments` WRITE;
/*!40000 ALTER TABLE `blog_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_post_tags`
--

DROP TABLE IF EXISTS `blog_post_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_post_tags` (
  `post_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `fk_bpt_tag` (`tag_id`),
  CONSTRAINT `fk_bpt_post` FOREIGN KEY (`post_id`) REFERENCES `blog_posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_bpt_tag` FOREIGN KEY (`tag_id`) REFERENCES `blog_tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_post_tags`
--

LOCK TABLES `blog_post_tags` WRITE;
/*!40000 ALTER TABLE `blog_post_tags` DISABLE KEYS */;
INSERT INTO `blog_post_tags` VALUES (2,1),(2,5),(3,2),(3,5),(4,1),(4,6),(5,3),(5,5),(6,2),(6,4);
/*!40000 ALTER TABLE `blog_post_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `excerpt` text NOT NULL,
  `content` longtext NOT NULL,
  `reading_time_minutes` smallint(6) NOT NULL DEFAULT 8,
  `featured_badge` varchar(100) DEFAULT NULL,
  `search_keywords` text DEFAULT NULL,
  `featured_image` varchar(500) DEFAULT NULL,
  `views_count` int(10) unsigned NOT NULL DEFAULT 0,
  `likes_count` int(10) unsigned NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `published_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_blog_slug` (`slug`),
  KEY `idx_blog_published` (`is_published`,`published_at`),
  KEY `idx_blog_featured` (`is_featured`),
  KEY `fk_blog_cat` (`category_id`),
  KEY `fk_blog_author` (`author_id`),
  CONSTRAINT `fk_blog_author` FOREIGN KEY (`author_id`) REFERENCES `blog_authors` (`id`),
  CONSTRAINT `fk_blog_cat` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_posts`
--

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` VALUES (1,1,1,'Building Modern, High-Performance Websites: Key Foundations for New Startups','building-modern-high-performance-websites-startups','A walkthrough of essential web foundations every new business needs: responsive layout architecture, fast page load speeds, clean navigation, and accessible mobile experiences.','<h3>The Foundation of a High-Impact Digital Presence</h3><p>For modern startups and emerging businesses, a website is much more than a digital business card—it is the central hub where customer credibility, service clarity, and brand conversion intersect.</p><h4>1. Mobile-First Responsiveness</h4><p>With the vast majority of web traffic originating on smartphones, designing for mobile screens first is essential. Fluid typography, responsive grids, and touch-friendly navigation ensure that prospective clients experience zero friction when browsing your services.</p><h4>2. Performance & Speed Optimization</h4><p>Fast page load times dramatically improve visitor retention. By optimizing imagery formats, minimizing unnecessary scripts, and structuring semantic HTML, websites can achieve swift rendering speeds that keep users engaged.</p><h4>3. Clear Service Communication & Inquiries</h4><p>A successful website makes it immediately obvious what problems your business solves. Highlighting clear service categories, showcase projects, and straightforward contact pathways empowers interested visitors to reach out with confidence.</p>',4,'STUDIO DISPATCH','modern websites, startup web design, responsive development, click codex, web performance','assets/images/logo.png',120,18,0,1,'2026-09-25 18:56:44','2026-09-25 13:26:44','2026-09-25 13:44:03'),(2,1,2,'How to Choose the Right Type of Website for Your Business in 2026','how-to-choose-the-right-website-for-your-business','Choosing the right website type—whether a single-page landing page, a multi-page corporate website, or an e-commerce platform—is the most critical first step for any business. Here is how to make the right choice based on your goals, budget, and audience.','<h3>Why Your Website Type Dictates Your Digital Trajectory</h3>\n<p>In today\'s competitive landscape, your website is the digital storefront of your brand. Too often, business owners invest time and capital into building either an overly complex web application when all they needed was a high-speed landing page, or a fragile template site when their business model demanded a robust multi-page corporate engine.</p>\n<p>Making the right choice begins with diagnosing your primary commercial objective, your target customer persona, and your expected scale over the next 12 to 24 months.</p>\n\n<h4>1. The High-Converting Landing Page (Single-Page Site)</h4>\n<p>A landing page is a streamlined, single-scroll experience specifically engineered around a singular call-to-action (CTA). There are no secondary navigation distractions—every headline, testimonial, and visual section guides the visitor toward one specific outcome.</p>\n<ul>\n  <li><strong>Best Suited For:</strong> Early-stage startups validating an MVP, local service providers, product launches, event registrations, and dedicated Google/Meta ad campaigns.</li>\n  <li><strong>Core Advantages:</strong> Rapid turnaround (1 to 2 weeks), cost-effective development, sub-second load times, and laser-focused conversion tracking.</li>\n  <li><strong>Limitations:</strong> Limited organic SEO breadth since a single URL cannot target multiple distinct search queries.</li>\n</ul>\n\n<h4>2. The Multi-Page Corporate & Authority Website</h4>\n<p>A multi-page corporate website structures your brand into distinct dedicated URLs—such as Home, About Us, Individual Service Pages, Portfolio Case Studies, and Contact.</p>\n<ul>\n  <li><strong>Best Suited For:</strong> Professional consulting firms, B2B agencies, healthcare providers, construction, hospitality, and established businesses seeking organic Google search authority.</li>\n  <li><strong>Core Advantages:</strong> High SEO dominance with dedicated keyword landing pages, detailed trust-building, clear service breakdowns, and multi-touchpoint contact inquiries.</li>\n  <li><strong>Key Deliverables:</strong> Clean information architecture, mobile-responsive grids, schema structured data, and intuitive navigation.</li>\n</ul>\n\n<h4>3. The E-Commerce Storefront & Catalog</h4>\n<p>If your primary revenue stream involves selling physical products, merchandise, or digital downloads directly to consumers or wholesale buyers, an e-commerce website is required.</p>\n<ul>\n  <li><strong>Best Suited For:</strong> Retail brands, jewelry makers, fashion labels, electronics, and direct-to-consumer (D2C) manufacturers.</li>\n  <li><strong>Essential Requirements:</strong> High-resolution product image galleries, smooth category filtering, secure payment gateways (Razorpay, Stripe, UPI), automated order confirmation notifications, and mobile checkout optimization.</li>\n</ul>\n\n<h4>4. The Custom Dynamic Web Portal / Web Application</h4>\n<p>When your website requires customer logins, member dashboards, automated booking engines, or backend database management, it moves into the territory of custom web applications.</p>\n<ul>\n  <li><strong>Best Suited For:</strong> Membership clubs, patient booking portals, internal operations trackers, and subscription services.</li>\n</ul>\n\n<h4>The Decision Matrix: How to Choose in 3 Steps</h4>\n<blockquote>\n  <strong>Step 1:</strong> Identify your immediate primary goal: Leads, Direct Online Sales, or Brand Credibility?<br>\n  <strong>Step 2:</strong> Evaluate your content readiness: Do you have individual pages of content, or a single compelling offer?<br>\n  <strong>Step 3:</strong> Plan for longevity: Choose a clean-coded responsive foundation that can easily expand into additional pages as your business expands.\n</blockquote>\n<p>At Click Codex, we recommend starting with a clean, fast-loading responsive build that reflects your current business stage while leaving clear architectural pathways for future growth.</p>',7,'FOUNDER\'S GUIDE','choose website business, website types, landing page vs multi page, ecommerce website, startup web development, click codex','assets/images/logo.png',480,42,1,1,'2026-09-25 19:14:03','2026-09-25 13:44:03','2026-09-25 13:52:34'),(3,3,3,'Which Kind of Digital Marketing is Best for Your Business?','which-kind-of-digital-marketing-is-best-for-your-business','With dozens of digital marketing channels available—from SEO and Google Ads to Instagram Reels, LinkedIn B2B outreach, and influencer marketing—discover which channel delivers the highest return on investment for your specific business model.','<h3>Navigating the Digital Marketing Spectrum</h3>\n<p>One of the most frequent questions business owners ask is: <em>\"Should I invest in SEO, run paid ads, or focus entirely on Instagram and reels?\"</em> The truth is that there is no universal silver bullet. The most profitable marketing channel depends directly on your audience\'s intent, your price point, and your sales cycle length.</p>\n<p>Let\'s demystify the four primary marketing pillars and match them with the business types that benefit most from each.</p>\n\n<h4>1. Search Engine Optimization (SEO): The Compounding Engine</h4>\n<p>SEO is the art of structuring your website\'s content, technical speed, and authority so that Google ranks your pages when prospective clients search for your specific services.</p>\n<ul>\n  <li><strong>Audience Intent:</strong> High Commercial & Transactional Intent. When someone searches <em>\"commercial interior designer near me\"</em> or <em>\"custom jewelry website developer\"</em>, they have an active problem they want solved.</li>\n  <li><strong>Best For:</strong> B2B services, local contractors, healthcare clinics, hospitality, and businesses seeking sustainable, compounding customer acquisition without continuous ad spending.</li>\n  <li><strong>Timeline:</strong> Medium to long-term (3 to 6 months for solid ranking traction).</li>\n</ul>\n\n<h4>2. Social Media Creatives & Visual Brand Storytelling</h4>\n<p>Social media marketing on platforms like Instagram, LinkedIn, and Facebook is built around visual presence, community trust, and staying top-of-mind.</p>\n<ul>\n  <li><strong>Audience Intent:</strong> Discovery and Affinity. Users aren\'t necessarily looking to buy right this second, but high-impact visual design builds desire and brand familiarity.</li>\n  <li><strong>Best For:</strong> Lifestyle brands, creative studios, restaurants, fashion, wellness, and consumer products.</li>\n  <li><strong>Core Strategy:</strong> Consistent branded post templates, educational carousels, customer showcases, and aesthetic feed coherence.</li>\n</ul>\n\n<h4>3. Short-Form Video & Professional Reel Marketing</h4>\n<p>Reels and short vertical videos represent the single greatest organic reach opportunity on social platforms today. Instagram and YouTube algorithms prioritize engaging video content over static posts by a factor of 10 to 1.</p>\n<ul>\n  <li><strong>Audience Intent:</strong> Algorithmic Discovery. Quality reels are served to non-followers who are interested in your category.</li>\n  <li><strong>Best For:</strong> Any business with a visual component—food, real estate, hospitality, fashion, educational tips, and behind-the-scenes studio work.</li>\n  <li><strong>Key Factor:</strong> Professional hook framing, clear lighting, kinetic typography, and audio synchronization.</li>\n</ul>\n\n<h4>4. Targeted Paid Advertising (Google Search & Meta Ads)</h4>\n<p>Paid advertising delivers immediate traffic by bidding on search keywords (Google Ads) or targeting detailed audience demographics and interests (Meta Ads).</p>\n<ul>\n  <li><strong>Best For:</strong> Rapid product testing, seasonal promotions, flash sales, and businesses with a clearly calculated customer lifetime value (LTV).</li>\n  <li><strong>Trade-off:</strong> Highly effective for fast results, but traffic stops the moment ad spend ceases.</li>\n</ul>\n\n<h4>The Click Codex Hybrid Recommendation</h4>\n<p>For most emerging startups and growing businesses, the most resilient strategy is a <strong>Two-Pillar Hybrid Model</strong>:</p>\n<ol>\n  <li><strong>Foundation:</strong> A fast, SEO-optimized website that captures high-intent organic search traffic.</li>\n  <li><strong>Engagement:</strong> Regular short-form reels and cohesive social creatives that build social proof and community trust.</li>\n</ol>\n<p>By pairing search authority with active visual storytelling, your business captures both the clients who are searching for you today and the clients who will remember you tomorrow.</p>',8,'GROWTH BLUEPRINT','best digital marketing, digital marketing types, SEO vs social media, reel marketing, B2B marketing, marketing strategy 2026','assets/images/logo.png',395,35,0,1,'2026-09-25 19:14:03','2026-09-25 13:44:03','2026-09-25 13:52:34'),(4,1,4,'Software vs Web Application vs Mobile App: What is Best for You?','software-vs-web-app-vs-mobile-app-which-is-best','Should you build custom desktop software, a cloud-based responsive web application, or a native mobile app? We break down the technical trade-offs, development costs, user adoption hurdles, and maintenance factors to help you decide.','<h3>The Fundamental Technology Crossroads</h3>\n<p>When envisioning a new digital product or internal management system, founders and business leaders often grapple with a critical architectural question: <em>\"Should we develop a mobile application, a responsive web app, or dedicated desktop software?\"</em></p>\n<p>Selecting the wrong deployment form factor can result in bloated development costs, lengthy app store review delays, and sluggish user adoption. Here is an objective engineering teardown of each medium.</p>\n\n<h4>1. Responsive Web Applications: The Universal Standard</h4>\n<p>A modern web application runs inside the user\'s web browser across any device (desktop, tablet, smartphone) without requiring them to install any files from an app store.</p>\n<ul>\n  <li><strong>Key Advantages:</strong>\n    <ul>\n      <li><strong>Zero Friction Adoption:</strong> A prospective user simply clicks a link and is immediately using your platform.</li>\n      <li><strong>Cross-Device Compatibility:</strong> One codebase serves desktop monitors, laptops, and mobile screens seamlessly.</li>\n      <li><strong>Instant Deployment & Updates:</strong> Code fixes, new features, and security patches roll out immediately to 100% of users with no app store approvals.</li>\n      <li><strong>Lower Cost:</strong> Significantly more economical to develop and maintain compared to building two separate native mobile apps.</li>\n    </ul>\n  </li>\n  <li><strong>When to Choose:</strong> SaaS platforms, client portals, booking systems, inventory dashboards, e-commerce, and collaborative workflows.</li>\n</ul>\n\n<h4>2. Mobile Applications (iOS & Android)</h4>\n<p>Mobile applications are installed directly onto smartphones and tablets via the Apple App Store or Google Play Store.</p>\n<ul>\n  <li><strong>Key Advantages:</strong>\n    <ul>\n      <li><strong>Hardware Integration:</strong> Direct access to native camera, GPS location, push notifications, Bluetooth, and biometric face/fingerprint authentication.</li>\n      <li><strong>Offline Capabilities:</strong> Can be built to function seamlessly without continuous internet connectivity.</li>\n      <li><strong>Home Screen Real Estate:</strong> Your brand icon sits permanently on the user\'s phone, encouraging frequent daily sessions.</li>\n    </ul>\n  </li>\n  <li><strong>When to Choose:</strong> On-demand delivery apps, fitness trackers, real-time messaging, ride-sharing, and mobile gaming.</li>\n  <li><strong>Trade-offs:</strong> Higher initial development cost, 15%–30% platform store commissions on digital sales, and 24-to-72 hour delays for store update approvals.</li>\n</ul>\n\n<h4>3. Custom Software & Internal Management Tools</h4>\n<p>Custom software systems are engineered specifically for operational workflows, warehouse logistics, or proprietary organizational automation.</p>\n<ul>\n  <li><strong>Key Advantages:</strong> Tailored 100% to your exact operational procedures, high data throughput, customized role-based security, and seamless integration with existing local hardware (barcode scanners, thermal printers, sensors).</li>\n  <li><strong>When to Choose:</strong> Enterprise ERPs, hospital clinic management, specialized manufacturing tracking, and financial compliance engines.</li>\n</ul>\n\n<h4>Summary Recommendation for Founders</h4>\n<blockquote>\n  <strong>The Rule of Thumb:</strong> Unless your core product genuinely requires background location tracking, hardware peripherals, or offline-first sync, <strong>always start with a responsive web application first</strong>.\n</blockquote>\n<p>Building a responsive web app allows you to validate your workflow, gather user feedback, and reach customers across all devices at half the development cost and twice the speed.</p>',9,'TECH ARCHITECTURE','software vs web app vs mobile app, mobile app vs web app, custom software development, web app development, tech stack choice','assets/images/logo.png',320,28,0,1,'2026-09-25 19:14:03','2026-09-25 13:44:03','2026-09-25 13:52:34'),(5,2,5,'The Power of UI/UX & Logo Design: Why Visual Craftsmanship Drives Conversions','power-of-ui-ux-and-logo-design-for-business-growth','Users form an opinion about your business within 50 milliseconds of landing on your page. Discover why investing in professional UI/UX design, intuitive user flows, and memorable logo identity directly impacts your bottom line.','<h3>The 50-Millisecond First Impression</h3>\n<p>Cognitive psychology research shows that it takes a visitor approximately <strong>50 milliseconds</strong> (0.05 seconds) to form an emotional impression of your website. In that fractional blink of an eye, subconscious judgments regarding your credibility, professionalism, and reliability are cemented.</p>\n<p>Design is never merely visual decoration—it is the functional bridge between a visitor\'s hesitation and their decision to contact, trust, or purchase from you.</p>\n\n<h4>1. The Strategic Role of a Distinctive Logo</h4>\n<p>Your logo is the foundational anchor of your company\'s identity. A professional logo achieves three key objectives:</p>\n<ul>\n  <li><strong>Memorability:</strong> Distinctive shapes and balanced proportions make your brand instantly recognizable in social media profile pictures, app headers, and packaging.</li>\n  <li><strong>Versatility:</strong> A well-crafted logo scales flawlessly from a 16px browser favicon to a high-resolution outdoor billboard without losing clarity or legibility.</li>\n  <li><strong>Emotional Alignment:</strong> Colors and typography convey industry character—trustworthy blues for technology and finance, vibrant energetic hues for creative media, or refined neutrals for luxury and hospitality.</li>\n</ul>\n\n<h4>2. UI vs UX: Two Sides of the Same High-Performance Coin</h4>\n<p>While often grouped together, User Interface (UI) and User Experience (UX) solve distinct challenges:</p>\n<ul>\n  <li><strong>User Experience (UX):</strong> Focuses on the logic, structure, and emotional journey. Can a visitor find what they need in two clicks? Is the inquiry form intuitive? Is the mobile checkout frictionless?</li>\n  <li><strong>User Interface (UI):</strong> Focuses on aesthetic polish—consistent typographic scales, intentional whitespace, visual button hierarchy, and cohesive color palettes.</li>\n</ul>\n\n<h4>3. The Business ROI of Thoughtful Design</h4>\n<p>Investing in thoughtful design yields tangible business results:</p>\n<ol>\n  <li><strong>Lower Bounce Rates:</strong> Clean layouts and uncluttered typography invite users to stay, read, and explore your services.</li>\n  <li><strong>Higher Conversion Rates:</strong> Clear, prominent Call-to-Action buttons with high contrast make it effortless for users to initiate contact.</li>\n  <li><strong>Price Premium Perception:</strong> Premium visual presentation signals established authority, allowing businesses to command premium pricing over competitors with outdated visual collateral.</li>\n</ol>\n<p>At Click Codex, our design philosophy combines minimalist elegance with purposeful UX wireframing, ensuring every screen looks beautiful and performs with commercial intent.</p>',6,'DESIGN EXCELLENCE','UI UX design importance, logo design business, conversion rate optimization, brand identity, graphic design startup','assets/images/logo.png',415,39,0,1,'2026-09-25 19:14:03','2026-09-25 13:44:03','2026-09-25 13:52:34'),(6,3,6,'Short-Form Video & Reel Production: The Secret to High-Engagement Social Reach','short-form-video-and-reel-production-guide','Vertical short-form videos and reels have become the primary medium for organic algorithmic discovery on Instagram, YouTube, and Facebook. Learn the essentials of professional shooting, hooks, and video editing that capture immediate attention.','<h3>The Shift to Vertical Video Culture</h3>\n<p>Over the past three years, consumer attention has decisively shifted toward 9:16 vertical video formats. Platforms like Instagram Reels, YouTube Shorts, and Facebook Video are designed specifically to reward engaging video storytelling with massive organic discovery.</p>\n<p>While static image posts are shown primarily to your existing followers, algorithms actively distribute compelling reels to tens of thousands of potential customers who have never heard of your brand before.</p>\n\n<h4>1. The Critical 3-Second Hook Rule</h4>\n<p>In the fast-swiping vertical feed, viewer attention is won or lost in the first three seconds. If your reel begins with a slow fade-in, an irrelevant corporate logo, or quiet hesitation, the viewer has already scrolled away.</p>\n<ul>\n  <li><strong>Visual Hooks:</strong> Rapid motion, unexpected camera angles, or dynamic text overlays that immediately pose an intriguing question.</li>\n  <li><strong>Audio Hooks:</strong> Clear, confident voiceover delivery or rhythmically aligned trending audio cues.</li>\n  <li><strong>Curiosity Gap:</strong> Promise a specific transformation or insight: <em>\"Here is the single biggest mistake businesses make with their website...\"</em></li>\n</ul>\n\n<h4>2. The Production Elements of a Professional Reel</h4>\n<p>High-performing reels don\'t happen by accident. They are engineered through careful production planning:</p>\n<ul>\n  <li><strong>Intentional Lighting:</strong> Soft, directional key lighting ensures crisp subject definition, natural skin tones, and rich contrast even when viewed on small mobile screens.</li>\n  <li><strong>Camera Stabilization:</strong> Smooth gimbal moves, precise panning, and steady framing give footage an unmistakable cinematic polish.</li>\n  <li><strong>Pristine Audio Capture:</strong> Viewers will forgive slightly imperfect video, but poor, echoing audio causes instant abandonment. Dedicated lapel or shotgun microphones are essential.</li>\n</ul>\n\n<h4>3. Post-Production: Pacing, Kinetic Captions & Audio Sync</h4>\n<p>The magic of modern short-form video happens in the editing suite:</p>\n<ul>\n  <li><strong>Kinetic Animated Subtitles:</strong> Over 70% of social media users browse videos with sound turned off in public settings. Dynamic, beat-synced captions ensure 100% message retention.</li>\n  <li><strong>Micro-Cuts and Jump Cuts:</strong> Eliminating every pause and breath keeps energy tight and prevents cognitive drop-off.</li>\n  <li><strong>B-Roll Cutaways:</strong> Seamlessly interweaving product close-ups, behind-the-scenes clips, and screen interactions maintains high visual interest.</li>\n</ul>\n\n<h4>How Businesses Can Start Today</h4>\n<p>You don\'t need a Hollywood budget to succeed with video. Start by capturing the authentic reality of your craft: explain how you solve customer problems, demonstrate your products in real time, and share behind-the-scenes glimpses of your team in action.</p>\n<p>With Click Codex\'s dedicated reel shooting sessions and video production sprints, we handle concept development, on-location shooting, and high-energy editing to produce social video assets that convert viewers into loyal clients.</p>',7,'CREATIVE MEDIA','reel production, short form video, Instagram reels business, video content creation, professional reel shooting, viral video editing','assets/images/logo.png',560,51,0,1,'2026-09-25 19:14:03','2026-09-25 13:44:03','2026-09-25 13:52:34');
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_tags`
--

DROP TABLE IF EXISTS `blog_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_tags`
--

LOCK TABLES `blog_tags` WRITE;
/*!40000 ALTER TABLE `blog_tags` DISABLE KEYS */;
INSERT INTO `blog_tags` VALUES (1,'Web Development','web-development','2026-09-25 13:44:03'),(2,'Digital Marketing','digital-marketing','2026-09-25 13:44:03'),(3,'UI/UX Design','ui-ux-design','2026-09-25 13:44:03'),(4,'Reel Production','reel-production','2026-09-25 13:44:03'),(5,'Startup Guide','startup-guide','2026-09-25 13:44:03'),(6,'Software Architecture','software-architecture','2026-09-25 13:44:03');
/*!40000 ALTER TABLE `blog_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `case_studies`
--

DROP TABLE IF EXISTS `case_studies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `case_studies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned DEFAULT NULL,
  `slug` varchar(150) NOT NULL,
  `title` varchar(255) NOT NULL,
  `client_name` varchar(150) NOT NULL,
  `client_location` varchar(100) DEFAULT NULL,
  `sector_industry` varchar(150) NOT NULL,
  `timeline_duration` varchar(100) NOT NULL,
  `result_badge` varchar(100) NOT NULL,
  `excerpt` text NOT NULL,
  `challenge_overview` longtext NOT NULL,
  `architecture_solution` longtext NOT NULL,
  `key_metrics` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'Array of [{val, lbl}]' CHECK (json_valid(`key_metrics`)),
  `technologies` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'Array of technology strings' CHECK (json_valid(`technologies`)),
  `search_tech_keywords` text DEFAULT NULL,
  `featured_image` varchar(500) NOT NULL,
  `gallery_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery_images`)),
  `live_project_url` varchar(500) DEFAULT NULL,
  `github_url` varchar(500) DEFAULT NULL,
  `order_num` smallint(6) DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_cs_slug` (`slug`),
  KEY `idx_cs_active` (`is_active`,`is_featured`),
  KEY `fk_cs_cat` (`category_id`),
  CONSTRAINT `fk_cs_cat` FOREIGN KEY (`category_id`) REFERENCES `portfolio_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `case_studies`
--

LOCK TABLES `case_studies` WRITE;
/*!40000 ALTER TABLE `case_studies` DISABLE KEYS */;
INSERT INTO `case_studies` VALUES (1,1,'jewelry-website','Jewelry Business Website','Jewelry Business Showcase','India','Website Development / E-Commerce','3 Weeks','E-Commerce Showcase','An elegant, responsive showcase website crafted for a jewelry business, highlighting product collections, refined aesthetics, and mobile-friendly browsing.','The project required an upscale visual presentation capable of displaying intricate jewelry collections, gold and diamond ornaments, and artisanal accessories with high-clarity imagery while maintaining fast mobile load times and intuitive catalog navigation.','We designed a refined visual layout featuring rich imagery containers, smooth category filtering, detailed product showcase modals, and a direct inquiry flow allowing interested shoppers to connect seamlessly via contact forms and messaging.','[{\"val\":\"100%\",\"lbl\":\"Responsive Design\"},{\"val\":\"Sub-1.2s\",\"lbl\":\"Page Load Speed\"},{\"val\":\"Mobile-First\",\"lbl\":\"Catalog Navigation\"}]','[\"PHP\",\"JavaScript\",\"HTML5\",\"CSS3\",\"MySQL\",\"Responsive UI\"]','jewelry website, ecommerce website, jewelry catalog, responsive web development','assets/images/logo.png',NULL,NULL,NULL,1,1,1,'2026-09-25 18:56:44','2026-09-25 13:26:44','2026-09-25 13:26:44'),(2,1,'farmhouse-website','Farmhouse & Resort Website','Farmhouse Hospitality','India','Website Development / Hospitality','2 Weeks','Hospitality Showcase','A clean, visually engaging hospitality website showcasing farmhouse amenities, photo galleries, location information, and direct inquiry booking flows.','The goal was to present a tranquil getaway property online with inviting visuals, clear amenity breakdowns (swimming pool, event lawns, guest rooms), location guides, and a straightforward booking inquiry mechanism for guests.','Built with an open, nature-inspired visual aesthetic, integrated photo galleries with lightbox views, dynamic itinerary displays, Google Maps location integration, and direct booking inquiry forms optimized for mobile visitors.','[{\"val\":\"Clean UI\",\"lbl\":\"Nature-Inspired Palette\"},{\"val\":\"Direct Flow\",\"lbl\":\"Booking Inquiries\"},{\"val\":\"Optimized\",\"lbl\":\"Photo Galleries\"}]','[\"HTML5\",\"CSS3\",\"JavaScript\",\"PHP\",\"Gallery Lightbox\",\"Google Maps API\"]','farmhouse website, resort website, hospitality website, booking inquiry','assets/images/logo.png',NULL,NULL,NULL,2,1,1,'2026-09-25 18:56:44','2026-09-25 13:26:44','2026-09-25 13:26:44'),(3,1,'business-website','Professional Corporate Business Website','Corporate Business Solution','India','Website Development / Corporate','2 – 3 Weeks','Corporate Web Solution','A corporate digital presence built to communicate company services, brand credibility, core capabilities, and clear customer contact channels.','A commercial business needed an authoritative digital footprint to present its service offerings, company vision, leadership profile, and structured contact touchpoints for prospective commercial partners.','Engineered a modern multi-section corporate layout with clear typographic hierarchy, structured service cards, company profile sections, interactive contact forms, and structured schema data for local search visibility.','[{\"val\":\"Fast Load\",\"lbl\":\"Optimized Performance\"},{\"val\":\"Structured\",\"lbl\":\"Corporate Hierarchy\"},{\"val\":\"SEO Ready\",\"lbl\":\"Semantic Structure\"}]','[\"Modern Web Architecture\",\"CSS3\",\"JavaScript\",\"PHP\",\"SEO Structured Data\"]','business website, corporate website, company portal, responsive design','assets/images/logo.png',NULL,NULL,NULL,3,1,1,'2026-09-25 18:56:44','2026-09-25 13:26:44','2026-09-25 13:26:44'),(4,2,'web-development-project','Custom Web Application & Management Project','Custom Web Solution','India','Full-Stack Development','4 Weeks','Custom Web Application','A custom full-stack web application featuring modular components, dynamic content management, and streamlined database interactions.','Required developing a functional web application with custom user workflows, administrative data tables, dynamic form handling, and organized backend database processing beyond standard static pages.','Developed using a modular PHP and MySQL architecture with asynchronous form validations, structured database tables, secure session handling, and clean responsive dashboard views.','[{\"val\":\"Full-Stack\",\"lbl\":\"Integrated Architecture\"},{\"val\":\"Modular\",\"lbl\":\"Clean Code Base\"},{\"val\":\"Secure\",\"lbl\":\"Data Management\"}]','[\"Full-Stack Architecture\",\"PHP\",\"MySQL\",\"JavaScript\",\"RESTful Workflows\",\"Responsive CSS\"]','custom web application, full stack web project, php mysql app, dynamic web system','assets/images/logo.png',NULL,NULL,NULL,4,1,1,'2026-09-25 18:56:44','2026-09-25 13:26:44','2026-09-25 13:26:44'),(5,3,'digital-creative-project','Digital Creative & Social Media Campaign Project','Digital Creative Showcase','India','Design / Digital Marketing / Creative','2 Weeks Sprints','Creative Campaign Suite','A multi-faceted digital design and marketing campaign asset suite encompassing social media creatives, promotional reel styling, and brand identity materials.','Creating an integrated suite of creative digital assets including cohesive social media banners, promotional reels, and brand marketing collaterals to build visual recognition across digital channels.','Designed a coordinated visual kit containing high-contrast social media posts, carousel templates, motion reel concepts, and promotional graphics tailored to social platform algorithms and audience attention spans.','[{\"val\":\"Cohesive\",\"lbl\":\"Brand Identity Kit\"},{\"val\":\"Multi-Format\",\"lbl\":\"Posts, Reels & Stories\"},{\"val\":\"High-Impact\",\"lbl\":\"Visual Storytelling\"}]','[\"Visual Identity Design\",\"UI\\/UX Design\",\"Social Creatives\",\"Motion & Video Editing\",\"Typography\"]','digital creative project, social media design, reel production, visual branding','assets/images/logo.png',NULL,NULL,NULL,5,1,1,'2026-09-25 18:56:44','2026-09-25 13:26:44','2026-09-25 13:26:44');
/*!40000 ALTER TABLE `case_studies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_milestones`
--

DROP TABLE IF EXISTS `company_milestones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_milestones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year_label` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `order_num` smallint(6) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_milestones`
--

LOCK TABLES `company_milestones` WRITE;
/*!40000 ALTER TABLE `company_milestones` DISABLE KEYS */;
INSERT INTO `company_milestones` VALUES (1,'Phase 1','Founding & Team Synergy','A team of four skilled technologists and creators with collective experience across development, design, marketing, and media came together to build Click Codex.',1,1),(2,'Phase 2','Initial Projects & Portfolio Development','Developed our first five showcase projects across jewelry e-commerce, hospitality resorts, business portals, web apps, and creative marketing campaigns.',2,1),(3,'Phase 3','Service Architecture & Studio Tooling','Consolidated our twelve core offerings spanning full-stack development, mobile apps, graphic design, reel shooting, and social video production.',3,1),(4,'Phase 4','Official Launch Readiness','Deploying the Click Codex digital studio platform and preparing to officially begin commercial operations for clients and brand partners.',4,1);
/*!40000 ALTER TABLE `company_milestones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_values`
--

DROP TABLE IF EXISTS `company_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_values` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pillar_key` varchar(50) NOT NULL,
  `title` varchar(150) NOT NULL,
  `subtitle` varchar(150) NOT NULL,
  `metric_badge` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `stat1_val` varchar(50) NOT NULL,
  `stat1_lbl` varchar(100) NOT NULL,
  `stat2_val` varchar(50) NOT NULL,
  `stat2_lbl` varchar(100) NOT NULL,
  `stat3_val` varchar(50) NOT NULL,
  `stat3_lbl` varchar(100) NOT NULL,
  `order_num` smallint(6) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pillar_key` (`pillar_key`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_values`
--

LOCK TABLES `company_values` WRITE;
/*!40000 ALTER TABLE `company_values` DISABLE KEYS */;
INSERT INTO `company_values` VALUES (1,'craftsmanship','Technical Craftsmanship','Clean Code & Robust Design','STANDARD','We treat every website, application, and creative asset as a reflection of our dedication to quality, maintainable code, and modern aesthetics.','100%','Handcrafted Code','Modern','Tech Standards','Clean','Architecture',1,1),(2,'collaboration','Direct Collaboration','Transparent Communication','APPROACH','You communicate directly with the builders, designers, and creators working on your project, eliminating bureaucratic delays and miscommunication.','4-Member','Focused Core Team','Direct','Developer Access','Clear','Project Milestones',2,1),(3,'multidisciplinary','Multidisciplinary Synergy','Code, Design & Video Under One Roof','CAPABILITY','From full-stack development and graphic design to professional reel shooting and video production, our team covers the complete digital spectrum.','12','Service Areas','Unified','Creative Delivery','~2 Years','Tech Experience',3,1),(4,'agility','Agile Startup Velocity','Rapid Iteration & Delivery','EXECUTION','As an agile startup, we adapt quickly, iterate rapidly, and focus on delivering practical, working solutions that solve real business challenges.','Sprint-Based','Agile Delivery','Fast','Feedback Loops','High','Commitment Level',4,1);
/*!40000 ALTER TABLE `company_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_inquiries`
--

DROP TABLE IF EXISTS `contact_inquiries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_inquiries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `inquiry_type` enum('consultation_modal','discovery_form','service_request','custom_quote') NOT NULL DEFAULT 'consultation_modal',
  `full_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `interested_service` varchar(150) DEFAULT NULL,
  `selected_services` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`selected_services`)),
  `budget_bracket` varchar(100) DEFAULT NULL,
  `timeline` varchar(100) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `source_page` varchar(255) DEFAULT NULL,
  `utm_source` varchar(100) DEFAULT NULL,
  `utm_medium` varchar(100) DEFAULT NULL,
  `utm_campaign` varchar(100) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `status` enum('new','reviewing','contacted','proposal_sent','closed_won','closed_lost','spam') NOT NULL DEFAULT 'new',
  `internal_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_inq_status` (`status`),
  KEY `idx_inq_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_inquiries`
--

LOCK TABLES `contact_inquiries` WRITE;
/*!40000 ALTER TABLE `contact_inquiries` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_inquiries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` enum('general','services','advisor','pricing','technical') NOT NULL DEFAULT 'general',
  `question` varchar(500) NOT NULL,
  `answer` text NOT NULL,
  `order_num` smallint(6) DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idx_faq_category` (`category`,`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,'general','What is Click Codex and what stage is the company in?','Click Codex is a newly formed technology and creative startup preparing to officially begin its commercial operations. Our collaborative 4-member team brings approximately 2 years of collective experience across full-stack development, mobile apps, UI/UX, graphic design, and video production.',1,1,1),(2,'general','How does Click Codex work with clients on projects?','We work on an agile sprint model with direct communication. You speak directly with the team members building your project, receiving transparent milestone updates and code/design previews without bureaucratic layers.',2,1,1),(3,'services','What services does Click Codex provide?','We offer 12 comprehensive services across Web & Software (Full-Stack Web Development, Website Development, Mobile Apps, Custom Software), Creative Design (UI/UX Design, Graphic Design, Logo Design), and Marketing & Media (Digital Marketing, Social Media Creatives, Reel Shooting, Video Content Creation, Short-Form Reel Production).',3,1,1),(4,'pricing','Who owns the intellectual property and code upon project completion?','You do. Upon completion and settlement of the project sprint, you receive 100% full ownership of your source code, design files, vector assets, and video deliverables.',4,1,1),(5,'technical','What types of websites and projects can you build?','We specialize in responsive corporate websites, e-commerce storefronts, hospitality portals, custom web applications, and social media creative campaign assets, with a focus on speed, aesthetics, and reliability.',5,1,1);
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `growth_funnel_tiers`
--

DROP TABLE IF EXISTS `growth_funnel_tiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `growth_funnel_tiers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tier_code` varchar(50) NOT NULL,
  `tier_number` tinyint(4) NOT NULL,
  `title` varchar(200) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `stat_badge` varchar(50) NOT NULL,
  `metrics_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'Array of [{metric, label}]' CHECK (json_valid(`metrics_json`)),
  `order_num` smallint(6) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `tier_code` (`tier_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `growth_funnel_tiers`
--

LOCK TABLES `growth_funnel_tiers` WRITE;
/*!40000 ALTER TABLE `growth_funnel_tiers` DISABLE KEYS */;
/*!40000 ALTER TABLE `growth_funnel_tiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter_subscribers`
--

DROP TABLE IF EXISTS `newsletter_subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter_subscribers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `source_location` varchar(100) NOT NULL DEFAULT 'blogs_dispatch',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `ip_address` varchar(45) DEFAULT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `unsubscribed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_news_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter_subscribers`
--

LOCK TABLES `newsletter_subscribers` WRITE;
/*!40000 ALTER TABLE `newsletter_subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter_subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `not_found_logs`
--

DROP TABLE IF EXISTS `not_found_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `not_found_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url_path` varchar(500) NOT NULL,
  `referer_url` varchar(500) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `hit_count` int(10) unsigned DEFAULT 1,
  `resolved_to_redirect_id` int(10) unsigned DEFAULT NULL,
  `first_seen_at` datetime NOT NULL,
  `last_seen_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_not_found_url` (`url_path`(191)),
  KEY `idx_not_found_resolved` (`resolved_to_redirect_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `not_found_logs`
--

LOCK TABLES `not_found_logs` WRITE;
/*!40000 ALTER TABLE `not_found_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `not_found_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_sections`
--

DROP TABLE IF EXISTS `page_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL,
  `section_key` varchar(80) NOT NULL COMMENT 'hero, marquee, about_pillars, milestones, reactor_synergy, values_projector, constellation, wireframe_scanner, growth_funnel, delivery_dossier, cta_banner',
  `title` varchar(255) DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `badge_text` varchar(120) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `media_url` varchar(500) DEFAULT NULL,
  `cta_primary_text` varchar(100) DEFAULT NULL,
  `cta_primary_url` varchar(255) DEFAULT NULL,
  `cta_secondary_text` varchar(100) DEFAULT NULL,
  `cta_secondary_url` varchar(255) DEFAULT NULL,
  `settings_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Custom parameters like 3D model controls, stat counters, toggles' CHECK (json_valid(`settings_json`)),
  `order_num` smallint(6) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_page_section` (`page_id`,`section_key`),
  KEY `idx_section_order` (`order_num`),
  CONSTRAINT `fk_section_page` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_sections`
--

LOCK TABLES `page_sections` WRITE;
/*!40000 ALTER TABLE `page_sections` DISABLE KEYS */;
INSERT INTO `page_sections` VALUES (1,1,'hero','Digital Craftsmanship, Full-Stack Engineering & Creative Media','Click Codex is an agile technology and creative studio preparing to launch operations. Powered by a 4-member team with ~2 years of collective experience across web development, mobile apps, graphic design, and reel production.','EMERGING TECHNOLOGY STARTUP',NULL,'assets/images/logo.png','Explore Our 12 Services','services','View Projects','portfolio',NULL,1,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(2,1,'team_overview','A Focused 4-Member Collaborative Team','We unite hands-on engineering, creative UI/UX, digital marketing strategy, and short-form video production under one roof.','4-MEMBER CORE TEAM',NULL,'assets/images/logo.png','About Our Team','aboutus','Contact Us','contactus',NULL,2,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(3,1,'cta_banner','Ready to Discuss Your Next Digital Project?','Connect directly with the Click Codex team to discuss your website, design, or video production requirements.','START A PROJECT',NULL,'assets/images/logo.png','Start Conversation','contactus','Use Solution Advisor','service-finder',NULL,3,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(4,2,'hero','About Click Codex','An emerging technology startup built on close collaboration, modern technical skills, and practical creative delivery.','STARTUP PROFILE',NULL,'assets/images/logo.png','Explore Services','services','Get in Touch','contactus',NULL,1,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(5,2,'about_pillars','Our Core Foundations','How our 4-member team approaches code quality, design fidelity, and client transparency.','FOUNDATIONS',NULL,'assets/images/logo.png','View Projects','portfolio',NULL,NULL,NULL,2,1,'2026-09-25 13:26:44','2026-09-25 13:26:44');
/*!40000 ALTER TABLE `page_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_key` varchar(60) NOT NULL COMMENT 'home, about_us, services, service_finder, portfolio, pricing, blogs, contact_us, privacy_policy, terms_of_service',
  `title` varchar(150) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `headline` varchar(255) DEFAULT NULL,
  `subheadline` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `banner_image` varchar(500) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_key` (`page_key`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_page_slug` (`slug`),
  KEY `idx_page_active` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'home','Click Codex — Full-Stack Web Development, Design & Creative Studio','','Digital Craftsmanship, Full-Stack Engineering & Creative Media','Click Codex is a modern technology startup preparing to launch operations. Powered by a collaborative 4-member team with ~2 years of hands-on experience in web development, mobile apps, software, UI/UX, graphic design, and video production.',NULL,'assets/images/logo.png',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(2,'about_us','About Click Codex — Our Team & Story','aboutus','A Focused 4-Member Technology & Creative Startup','Meet Click Codex. We are an agile startup preparing to officially begin our operations, uniting ~2 years of collective experience across development, design, marketing, and media creation.',NULL,'assets/images/logo.png',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(3,'services','Our Services — Full-Stack Web, Design, Marketing & Video','services','12 Core Services Tailored for Digital Growth','From full-stack web and mobile apps to graphic design, logo creation, digital marketing, and professional reel shooting.',NULL,'assets/images/logo.png',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(4,'service_finder','Solution Advisor — Find the Right Service for Your Project','service-finder','Interactive Solution Advisor','Answer 3 quick questions about your project goals and timeline to receive tailored recommendations.',NULL,'assets/images/logo.png',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(5,'portfolio','Portfolio & Projects — Click Codex Showcase','portfolio','Our Showcase Projects','Explore 5 realistic projects developed by the Click Codex team across jewelry e-commerce, farmhouse hospitality, business websites, custom web apps, and creative marketing.',NULL,'assets/images/logo.png',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(6,'pricing','Transparent Pricing & Delivery Models — Click Codex','pricing','Transparent, Startup-Friendly Project Packages','Clear sprint pricing designed for businesses and startups, backed by 100% intellectual property ownership and direct developer collaboration.',NULL,'assets/images/logo.png',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(7,'blogs','Blogs & Technical Dispatch — Click Codex','blogs','Tech Insights, Design Principles & Studio Dispatch','Practical articles and updates on web development, UI/UX design, and short-form video content creation.',NULL,'assets/images/logo.png',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(8,'contact_us','Contact Us — Start a Project with Click Codex','contactus','Let’s Build Something Meaningful Together','Have a project in mind? Reach out directly to our 4-member team for website development, design, or video production requirements.',NULL,'assets/images/logo.png',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(9,'privacy_policy','Privacy Policy — Click Codex','privacy-policy','Privacy Policy','How Click Codex collects, utilizes, and protects information submitted via our website and inquiry forms.',NULL,'assets/images/logo.png',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(10,'terms_of_service','Terms of Service — Click Codex','terms-of-service','Terms of Service','Terms governing engagement, service delivery, intellectual property, and website usage with Click Codex.',NULL,'assets/images/logo.png',1,'2026-09-25 13:26:44','2026-09-25 13:26:44');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolio_categories`
--

DROP TABLE IF EXISTS `portfolio_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portfolio_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(60) NOT NULL,
  `name` varchar(100) NOT NULL,
  `order_num` smallint(6) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolio_categories`
--

LOCK TABLES `portfolio_categories` WRITE;
/*!40000 ALTER TABLE `portfolio_categories` DISABLE KEYS */;
INSERT INTO `portfolio_categories` VALUES (1,'website-development','Website Development',1,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(2,'full-stack-development','Full-Stack Development',2,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(3,'creative-marketing','Design & Creative Media',3,1,'2026-09-25 13:26:44','2026-09-25 13:26:44');
/*!40000 ALTER TABLE `portfolio_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricing_features`
--

DROP TABLE IF EXISTS `pricing_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricing_features` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` int(10) unsigned NOT NULL,
  `feature_text` varchar(255) NOT NULL,
  `is_included` tinyint(1) NOT NULL DEFAULT 1,
  `order_num` smallint(6) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_pfeat_plan` (`plan_id`,`order_num`),
  CONSTRAINT `fk_pfeat_plan` FOREIGN KEY (`plan_id`) REFERENCES `pricing_plans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricing_features`
--

LOCK TABLES `pricing_features` WRITE;
/*!40000 ALTER TABLE `pricing_features` DISABLE KEYS */;
INSERT INTO `pricing_features` VALUES (1,1,'Up to 5 Responsive Website Pages',1,1),(2,1,'Mobile-First & Tablet Optimized',1,2),(3,1,'Contact & Inquiry Forms Setup',1,3),(4,1,'Basic On-Page SEO Configuration',1,4),(5,1,'Social Media Links Integration',1,5),(6,1,'1 Month Deployment Support',1,6),(7,2,'Full Custom Website Development',1,1),(8,2,'UI/UX Design & Brand Asset Creation',1,2),(9,2,'Professional Logo Design & Guidelines',1,3),(10,2,'Social Media Creative Kit (Posts & Stories)',1,4),(11,2,'Short-Form Video / Reel Production Assets',1,5),(12,2,'Speed Optimization & Schema Setup',1,6),(13,3,'Dedicated 4-Member Click Codex Team',1,1),(14,3,'Full-Stack Web & Software Engineering',1,2),(15,3,'Mobile App Development Milestones',1,3),(16,3,'Custom Workflow Automation Tools',1,4),(17,3,'Professional Video & Reel Shooting Sessions',1,5),(18,3,'Continuous Priority Collaboration',1,6);
/*!40000 ALTER TABLE `pricing_features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricing_inclusions`
--

DROP TABLE IF EXISTS `pricing_inclusions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricing_inclusions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `icon_symbol` varchar(50) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `order_num` smallint(6) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricing_inclusions`
--

LOCK TABLES `pricing_inclusions` WRITE;
/*!40000 ALTER TABLE `pricing_inclusions` DISABLE KEYS */;
INSERT INTO `pricing_inclusions` VALUES (1,'layers','Transparent Communication','Direct communication with the team members working on your deliverables with regular milestone updates.',1,1),(2,'code','Clean & Modern Code','Structured, maintainable code standards that ensure longevity, easy updates, and fast page loading.',2,1),(3,'smartphone','Mobile Responsive by Default','Every single design, website, and digital layout is tested thoroughly across screen sizes.',3,1),(4,'shield','Client Code & Asset Ownership','You own 100% of your source code, design master files, videos, and project deliverables upon handover.',4,1);
/*!40000 ALTER TABLE `pricing_inclusions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricing_plans`
--

DROP TABLE IF EXISTS `pricing_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricing_plans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plan_code` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `badge_text` varchar(60) DEFAULT NULL,
  `short_desc` text NOT NULL,
  `price_inr` decimal(12,2) NOT NULL,
  `price_usd` decimal(10,2) NOT NULL,
  `period_label` varchar(60) NOT NULL,
  `estimated_duration` varchar(100) NOT NULL,
  `is_popular` tinyint(1) NOT NULL DEFAULT 0,
  `order_num` smallint(6) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `plan_code` (`plan_code`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_plan_active` (`is_active`,`order_num`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricing_plans`
--

LOCK TABLES `pricing_plans` WRITE;
/*!40000 ALTER TABLE `pricing_plans` DISABLE KEYS */;
INSERT INTO `pricing_plans` VALUES (1,'STARTER_WEB','Starter Website / MVP','starter-website-mvp','POPULAR','Ideal for businesses, startups, and personal brands seeking a modern, fast, and mobile-friendly digital presence.',24999.00,349.00,'/ project','Estimated: 2 – 3 Weeks',1,1,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(2,'GROWTH_CREATIVE','Growth & Creative Suite','growth-creative-suite','RECOMMENDED','Comprehensive package combining modern website development with creative branding, graphic design, and social media media.',49999.00,699.00,'/ project','Estimated: 3 – 5 Weeks',0,2,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(3,'CUSTOM_SPRINT','Custom Development Pod','custom-development-pod','TAILORED','Dedicated engineering and creative capacity tailored for custom web applications, mobile apps, or ongoing digital media production.',74999.00,999.00,'/ sprint','Flexible Sprints',0,3,1,'2026-09-25 13:26:44','2026-09-25 13:26:44');
/*!40000 ALTER TABLE `pricing_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `search_logs`
--

DROP TABLE IF EXISTS `search_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `search_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `query_term` varchar(255) NOT NULL,
  `section` varchar(50) DEFAULT 'blogs',
  `results_count` int(10) unsigned DEFAULT 0,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_search_query` (`query_term`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `search_logs`
--

LOCK TABLES `search_logs` WRITE;
/*!40000 ALTER TABLE `search_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `search_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seo_metadata`
--

DROP TABLE IF EXISTS `seo_metadata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seo_metadata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entity_type` varchar(60) NOT NULL COMMENT 'page, service, case_study, blog_post, blog_category, custom_route',
  `entity_id` int(10) unsigned DEFAULT NULL COMMENT 'Null for standalone routes / pages',
  `route_path` varchar(255) DEFAULT NULL COMMENT 'Clean relative URL e.g. /services or /blogs/sub-10ms-apis',
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `focus_keyword` varchar(150) DEFAULT NULL,
  `secondary_keywords` text DEFAULT NULL,
  `canonical_url` varchar(500) DEFAULT NULL,
  `robots_index` tinyint(1) NOT NULL DEFAULT 1,
  `robots_follow` tinyint(1) NOT NULL DEFAULT 1,
  `robots_advanced` varchar(255) DEFAULT 'max-snippet:-1, max-image-preview:large, max-video-preview:-1',
  `og_type` varchar(60) DEFAULT 'website',
  `og_title` varchar(255) DEFAULT NULL,
  `og_description` text DEFAULT NULL,
  `og_image` varchar(500) DEFAULT NULL,
  `og_image_alt` varchar(255) DEFAULT NULL,
  `twitter_card` enum('summary','summary_large_image','app','player') DEFAULT 'summary_large_image',
  `twitter_title` varchar(255) DEFAULT NULL,
  `twitter_description` text DEFAULT NULL,
  `twitter_image` varchar(500) DEFAULT NULL,
  `schema_type` varchar(100) DEFAULT 'WebPage',
  `schema_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`schema_json`)),
  `search_intent` enum('informational','navigational','commercial','transactional') DEFAULT 'commercial',
  `sitemap_priority` decimal(2,1) DEFAULT 0.8,
  `sitemap_changefreq` enum('always','hourly','daily','weekly','monthly','yearly','never') DEFAULT 'weekly',
  `is_in_sitemap` tinyint(1) NOT NULL DEFAULT 1,
  `seo_score` tinyint(3) unsigned DEFAULT 95,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_seo_polymorphic` (`entity_type`,`entity_id`),
  KEY `idx_seo_route` (`route_path`),
  KEY `idx_seo_sitemap` (`is_in_sitemap`,`sitemap_priority`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seo_metadata`
--

LOCK TABLES `seo_metadata` WRITE;
/*!40000 ALTER TABLE `seo_metadata` DISABLE KEYS */;
INSERT INTO `seo_metadata` VALUES (1,'page',1,'/','Click Codex — Technology & Creative Digital Startup','Click Codex is an agile technology startup offering Full-Stack Web Development, Mobile Apps, UI/UX Design, Graphic Design, Digital Marketing, and Professional Video/Reel Production.',NULL,'Click Codex, web development startup, mobile apps, UI UX, reel shooting',NULL,'/',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','Click Codex — Technology & Creative Digital Startup','Click Codex is an agile technology startup offering Full-Stack Web Development, Mobile Apps, UI/UX Design, Graphic Design, Digital Marketing, and Professional Video/Reel Production.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'WebPage',NULL,'commercial',1.0,'weekly',1,98,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(2,'page',2,'/aboutus','About Click Codex — Our Team & Story','Learn about Click Codex, an emerging digital technology startup powered by an experienced 4-member team with ~2 years collective tech experience.',NULL,'about Click Codex, startup team, technology experience',NULL,'/aboutus',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','About Click Codex — Our Team & Story','Learn about Click Codex, an emerging digital technology startup powered by an experienced 4-member team with ~2 years collective tech experience.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'WebPage',NULL,'commercial',0.9,'weekly',1,98,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(3,'page',3,'/services','Our Services — Full-Stack Web, Design & Media | Click Codex','Explore 12 core digital services offered by Click Codex: web development, mobile apps, software, UI/UX, graphic design, digital marketing, and reel production.',NULL,'web development services, mobile app development, graphic design, reel shooting',NULL,'/services',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','Our Services — Full-Stack Web, Design & Media | Click Codex','Explore 12 core digital services offered by Click Codex: web development, mobile apps, software, UI/UX, graphic design, digital marketing, and reel production.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'WebPage',NULL,'commercial',0.9,'weekly',1,98,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(4,'page',4,'/service-finder','Solution Advisor — Tailored Service Recommendation | Click Codex','Use the Click Codex interactive solution advisor to discover the optimal service and development roadmap for your project.',NULL,'solution advisor, service finder, web project planning',NULL,'/service-finder',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','Solution Advisor — Tailored Service Recommendation | Click Codex','Use the Click Codex interactive solution advisor to discover the optimal service and development roadmap for your project.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'WebPage',NULL,'commercial',0.8,'weekly',1,98,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(5,'page',5,'/portfolio','Portfolio & Projects — Click Codex Showcase','Explore realistic projects by Click Codex including jewelry websites, farmhouse hospitality portals, business websites, and creative media campaigns.',NULL,'Click Codex portfolio, web design projects, ecommerce website, case studies',NULL,'/portfolio',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','Portfolio & Projects — Click Codex Showcase','Explore realistic projects by Click Codex including jewelry websites, farmhouse hospitality portals, business websites, and creative media campaigns.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'WebPage',NULL,'commercial',0.9,'weekly',1,98,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(6,'page',6,'/pricing','Pricing & Delivery Models — Click Codex','Transparent, startup-friendly project packages for website development, branding, and dedicated full-stack development pods.',NULL,'website pricing, web development cost, startup pricing',NULL,'/pricing',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','Pricing & Delivery Models — Click Codex','Transparent, startup-friendly project packages for website development, branding, and dedicated full-stack development pods.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'WebPage',NULL,'commercial',0.8,'weekly',1,98,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(7,'page',7,'/blogs','Blogs & Tech Dispatch — Click Codex','Practical articles and technical notes on modern web architecture, responsive design, and creative short-form video production.',NULL,'tech blog, web development articles, design insights',NULL,'/blogs',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','Blogs & Tech Dispatch — Click Codex','Practical articles and technical notes on modern web architecture, responsive design, and creative short-form video production.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'WebPage',NULL,'commercial',0.8,'weekly',1,98,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(8,'page',8,'/contactus','Contact Us — Start a Project | Click Codex','Connect directly with the Click Codex 4-member team to discuss your website, mobile app, design, or video production requirements.',NULL,'contact Click Codex, hire web developers, startup contact',NULL,'/contactus',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','Contact Us — Start a Project | Click Codex','Connect directly with the Click Codex 4-member team to discuss your website, mobile app, design, or video production requirements.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'WebPage',NULL,'commercial',0.9,'weekly',1,98,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(9,'case_study',1,'/portfolio/jewelry-website','Jewelry Business Website Project — Click Codex','Showcase of an elegant, responsive e-commerce catalog website developed for a jewelry business with smooth mobile navigation.',NULL,'jewelry website, jewelry ecommerce, responsive catalog',NULL,'/portfolio/jewelry-website',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','Jewelry Business Website Project — Click Codex','Showcase of an elegant, responsive e-commerce catalog website developed for a jewelry business with smooth mobile navigation.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'WebPage',NULL,'commercial',0.8,'weekly',1,98,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(10,'case_study',2,'/portfolio/farmhouse-website','Farmhouse & Resort Website Project — Click Codex','Hospitality website built for a farmhouse getaway featuring photo galleries, amenity details, and direct booking inquiry flows.',NULL,'farmhouse website, resort website, hospitality web design',NULL,'/portfolio/farmhouse-website',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','Farmhouse & Resort Website Project — Click Codex','Hospitality website built for a farmhouse getaway featuring photo galleries, amenity details, and direct booking inquiry flows.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'WebPage',NULL,'commercial',0.8,'weekly',1,98,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(11,'case_study',3,'/portfolio/business-website','Corporate Business Website Project — Click Codex','Modern corporate website engineered to present company services, brand credibility, and structured client inquiry channels.',NULL,'business website, corporate web design, professional site',NULL,'/portfolio/business-website',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','Corporate Business Website Project — Click Codex','Modern corporate website engineered to present company services, brand credibility, and structured client inquiry channels.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'WebPage',NULL,'commercial',0.8,'weekly',1,98,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(12,'case_study',4,'/portfolio/web-development-project','Custom Web Application Project — Click Codex','A full-stack custom web development project featuring dynamic data handling, modular architecture, and responsive dashboard views.',NULL,'custom web app, full stack development, php mysql web app',NULL,'/portfolio/web-development-project',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','Custom Web Application Project — Click Codex','A full-stack custom web development project featuring dynamic data handling, modular architecture, and responsive dashboard views.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'WebPage',NULL,'commercial',0.8,'weekly',1,98,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(13,'case_study',5,'/portfolio/digital-creative-project','Digital Creative Campaign Project — Click Codex','Multi-faceted digital design and marketing campaign asset suite encompassing social media creatives and promotional reel styling.',NULL,'digital creative project, social media design, reel production',NULL,'/portfolio/digital-creative-project',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','Digital Creative Campaign Project — Click Codex','Multi-faceted digital design and marketing campaign asset suite encompassing social media creatives and promotional reel styling.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'WebPage',NULL,'commercial',0.8,'weekly',1,98,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(19,'blog_post',2,'/blogs/how-to-choose-the-right-website-for-your-business','How to Choose the Right Type of Website for Your Business in 2026','Choosing the right website type—whether a single-page landing page, a multi-page corporate website, or an e-commerce platform—is the most critical first step for any business. Here is how to make the right choice based on your goals, budget, and audience.',NULL,'FOUNDER\'S GUIDE',NULL,'/blogs/how-to-choose-the-right-website-for-your-business',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','How to Choose the Right Type of Website for Your Business in 2026','Choosing the right website type—whether a single-page landing page, a multi-page corporate website, or an e-commerce platform—is the most critical first step for any business. Here is how to make the right choice based on your goals, budget, and audience.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'Article',NULL,'commercial',0.8,'weekly',1,96,'2026-09-25 13:52:34','2026-09-25 13:52:34'),(20,'blog_post',3,'/blogs/which-kind-of-digital-marketing-is-best-for-your-business','Which Kind of Digital Marketing is Best for Your Business?','With dozens of digital marketing channels available—from SEO and Google Ads to Instagram Reels, LinkedIn B2B outreach, and influencer marketing—discover which channel delivers the highest return on investment for your specific business model.',NULL,'GROWTH BLUEPRINT',NULL,'/blogs/which-kind-of-digital-marketing-is-best-for-your-business',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','Which Kind of Digital Marketing is Best for Your Business?','With dozens of digital marketing channels available—from SEO and Google Ads to Instagram Reels, LinkedIn B2B outreach, and influencer marketing—discover which channel delivers the highest return on investment for your specific business model.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'Article',NULL,'commercial',0.8,'weekly',1,96,'2026-09-25 13:52:34','2026-09-25 13:52:34'),(21,'blog_post',4,'/blogs/software-vs-web-app-vs-mobile-app-which-is-best','Software vs Web Application vs Mobile App: What is Best for You?','Should you build custom desktop software, a cloud-based responsive web application, or a native mobile app? We break down the technical trade-offs, development costs, user adoption hurdles, and maintenance factors to help you decide.',NULL,'TECH ARCHITECTURE',NULL,'/blogs/software-vs-web-app-vs-mobile-app-which-is-best',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','Software vs Web Application vs Mobile App: What is Best for You?','Should you build custom desktop software, a cloud-based responsive web application, or a native mobile app? We break down the technical trade-offs, development costs, user adoption hurdles, and maintenance factors to help you decide.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'Article',NULL,'commercial',0.8,'weekly',1,96,'2026-09-25 13:52:34','2026-09-25 13:52:34'),(22,'blog_post',5,'/blogs/power-of-ui-ux-and-logo-design-for-business-growth','The Power of UI/UX & Logo Design: Why Visual Craftsmanship Drives Conversions','Users form an opinion about your business within 50 milliseconds of landing on your page. Discover why investing in professional UI/UX design, intuitive user flows, and memorable logo identity directly impacts your bottom line.',NULL,'DESIGN EXCELLENCE',NULL,'/blogs/power-of-ui-ux-and-logo-design-for-business-growth',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','The Power of UI/UX & Logo Design: Why Visual Craftsmanship Drives Conversions','Users form an opinion about your business within 50 milliseconds of landing on your page. Discover why investing in professional UI/UX design, intuitive user flows, and memorable logo identity directly impacts your bottom line.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'Article',NULL,'commercial',0.8,'weekly',1,96,'2026-09-25 13:52:34','2026-09-25 13:52:34'),(23,'blog_post',6,'/blogs/short-form-video-and-reel-production-guide','Short-Form Video & Reel Production: The Secret to High-Engagement Social Reach','Vertical short-form videos and reels have become the primary medium for organic algorithmic discovery on Instagram, YouTube, and Facebook. Learn the essentials of professional shooting, hooks, and video editing that capture immediate attention.',NULL,'CREATIVE MEDIA',NULL,'/blogs/short-form-video-and-reel-production-guide',1,1,'max-snippet:-1, max-image-preview:large, max-video-preview:-1','website','Short-Form Video & Reel Production: The Secret to High-Engagement Social Reach','Vertical short-form videos and reels have become the primary medium for organic algorithmic discovery on Instagram, YouTube, and Facebook. Learn the essentials of professional shooting, hooks, and video editing that capture immediate attention.','assets/images/logo.png',NULL,'summary_large_image',NULL,NULL,NULL,'Article',NULL,'commercial',0.8,'weekly',1,96,'2026-09-25 13:52:34','2026-09-25 13:52:34');
/*!40000 ALTER TABLE `seo_metadata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_categories`
--

DROP TABLE IF EXISTS `service_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `icon_svg` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `order_num` smallint(6) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_categories`
--

LOCK TABLES `service_categories` WRITE;
/*!40000 ALTER TABLE `service_categories` DISABLE KEYS */;
INSERT INTO `service_categories` VALUES (1,'Web & Software Engineering','web-software-engineering',NULL,'End-to-end website engineering, full-stack applications, mobile apps, and custom software.',1,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(2,'UI/UX & Creative Design','ui-ux-creative-design',NULL,'User experience architecture, modern graphic design, brand identities, and custom logo creation.',2,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(3,'Digital Marketing & Video Production','marketing-video-production',NULL,'Growth-driven digital marketing, social media creative design, professional reel shooting, and video content.',3,1,'2026-09-25 13:26:44','2026-09-25 13:26:44');
/*!40000 ALTER TABLE `service_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_dossier_steps`
--

DROP TABLE IF EXISTS `service_dossier_steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_dossier_steps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phase_code` varchar(50) NOT NULL,
  `phase_number` tinyint(4) NOT NULL,
  `phase_title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `typical_timeline` varchar(100) NOT NULL,
  `checkpoints` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'Array of milestone checkpoint items' CHECK (json_valid(`checkpoints`)),
  `order_num` smallint(6) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `phase_code` (`phase_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_dossier_steps`
--

LOCK TABLES `service_dossier_steps` WRITE;
/*!40000 ALTER TABLE `service_dossier_steps` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_dossier_steps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_faqs`
--

DROP TABLE IF EXISTS `service_faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_faqs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(10) unsigned NOT NULL,
  `question` varchar(500) NOT NULL,
  `answer` text NOT NULL,
  `order_num` smallint(6) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_sfaq_service` (`service_id`),
  CONSTRAINT `fk_sfaq_service` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_faqs`
--

LOCK TABLES `service_faqs` WRITE;
/*!40000 ALTER TABLE `service_faqs` DISABLE KEYS */;
INSERT INTO `service_faqs` VALUES (1,1,'What is your technology stack for full-stack web development?','We utilize robust, modern web technologies such as PHP, MySQL, JavaScript, HTML5/CSS3, and RESTful APIs, selecting the most reliable tools suited for your specific project requirements.',1,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(2,2,'Will my website be responsive on mobile devices?','Yes, every website we develop is built mobile-first, ensuring smooth navigation, fast loading, and visual clarity across smartphones, tablets, laptops, and desktop screens.',2,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(3,3,'Can you build apps for both iOS and Android?','Yes, we develop cross-platform mobile applications that run smoothly on both iOS and Android from a unified codebase, ensuring faster development and consistent user experience.',3,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(4,5,'What design deliverables do you provide in UI/UX projects?','Our UI/UX deliverables typically include user flow diagrams, interactive wireframes, full high-fidelity screen designs, a cohesive component style guide, and developer-ready design files in Figma.',4,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(5,7,'In what formats will I receive my final logo files?','You will receive vector master files (SVG, PDF) along with high-resolution PNG images with transparent backgrounds, optimized for both light and dark backgrounds and suitable for web and print.',5,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(6,10,'How do you plan professional reel shooting sessions?','We begin by establishing a shot list, defining the key visual angles, planning the lighting and framing, and shooting the footage on-location to capture authentic brand moments.',6,1,'2026-09-25 13:26:44','2026-09-25 13:26:44');
/*!40000 ALTER TABLE `service_faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned DEFAULT NULL,
  `service_code` varchar(60) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `title` varchar(200) NOT NULL,
  `short_description` varchar(500) NOT NULL,
  `full_description` longtext DEFAULT NULL,
  `badge_label` varchar(100) DEFAULT 'CORE SERVICE',
  `icon_svg` text DEFAULT NULL,
  `featured_image` varchar(500) DEFAULT NULL,
  `starting_price_inr` decimal(12,2) DEFAULT NULL,
  `starting_price_usd` decimal(10,2) DEFAULT NULL,
  `price_model` enum('fixed_sprint','hourly','monthly_pod','custom') DEFAULT 'fixed_sprint',
  `typical_timeline` varchar(100) DEFAULT NULL,
  `tech_stack` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Array of technologies e.g. ["Next.js 15", "Node.js", "PostgreSQL", "Redis"]' CHECK (json_valid(`tech_stack`)),
  `key_deliverables` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Array of deliverables e.g. ["Sub-0.3s Core Web Vitals", "Automated CI/CD"]' CHECK (json_valid(`key_deliverables`)),
  `performance_kpis` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Metrics and benchmark guarantees' CHECK (json_valid(`performance_kpis`)),
  `is_featured` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `order_num` smallint(6) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_code` (`service_code`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_service_slug` (`slug`),
  KEY `idx_service_active` (`is_active`,`is_featured`),
  KEY `fk_service_cat` (`category_id`),
  CONSTRAINT `fk_service_cat` FOREIGN KEY (`category_id`) REFERENCES `service_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,1,'FULL_STACK_DEV','full-stack-web-development','Full-Stack Web Development','Custom full-stack web applications built with modern frontend interfaces, secure backend services, and structured databases tailored to your business workflow.','Click Codex delivers end-to-end full-stack web development services. Our team builds responsive user interfaces combined with structured backend architecture, clean database schemas, and RESTful API integrations to bring custom digital products to life.','CORE SERVICE',NULL,'assets/images/logo.png',NULL,NULL,'fixed_sprint','3 – 6 Weeks','[\"PHP\",\"JavaScript\",\"HTML5\",\"CSS3\",\"MySQL\",\"REST APIs\",\"Git\"]','[\"Custom Web Application Architecture\",\"Interactive Frontend Interface\",\"Database Design & Integration\",\"API Integrations\",\"Cross-Device Responsiveness\"]',NULL,1,1,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(2,1,'WEBSITE_DEV','website-development','Website Development','High-performance, beautifully designed responsive websites for businesses, portfolios, and commercial organizations seeking a strong online presence.','We design and develop clean, modern, and mobile-friendly websites that showcase your business with clarity. Each website is engineered for fast loading speeds, seamless navigation, modern visual aesthetics, and search engine readiness.','POPULAR',NULL,'assets/images/logo.png',NULL,NULL,'fixed_sprint','2 – 4 Weeks','[\"HTML5\",\"CSS3\",\"JavaScript\",\"PHP\",\"SEO Semantic HTML\",\"Responsive Frameworks\"]','[\"Fully Responsive Layout\",\"Mobile & Tablet Optimization\",\"Contact & Inquiry Forms\",\"Speed Optimization\",\"Basic On-Page SEO Setup\"]',NULL,1,1,2,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(3,1,'MOBILE_APP_DEV','mobile-app-development','Mobile App Development','Cross-platform mobile applications for iOS and Android, focusing on intuitive user experience, reliable performance, and native device functionality.','Expand your brand reach with custom mobile application development. We build cross-platform mobile apps that combine fluid navigation, modern UI components, and dependable backend communication for a consistent user experience on both major platforms.','FEATURED',NULL,'assets/images/logo.png',NULL,NULL,'fixed_sprint','6 – 10 Weeks','[\"Cross-Platform Frameworks\",\"JavaScript\",\"REST APIs\",\"Mobile UI Libraries\",\"Firebase\\/Cloud\"]','[\"iOS & Android App Builds\",\"Intuitive UI\\/UX Flow\",\"Authentication & Profile Management\",\"Push Notifications Support\",\"Backend API Integration\"]',NULL,1,1,3,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(4,1,'SOFTWARE_DEV','software-development','Software Development','Custom software solutions and operational tools engineered to streamline business operations, data management, and specialized organizational workflows.','When off-the-shelf software falls short, Click Codex builds tailored software solutions designed around your exact operational needs. From internal management portals to data tracking utilities, we engineer reliable digital tools.','CUSTOM',NULL,'assets/images/logo.png',NULL,NULL,'custom','4 – 8 Weeks','[\"PHP\",\"MySQL\",\"JavaScript\",\"Custom MVC Architecture\",\"Role-Based Access Control\"]','[\"Custom Business Logic Modules\",\"Role-Based Access Control\",\"Reporting & Data Exports\",\"Secure Database Infrastructure\",\"User Documentation\"]',NULL,0,1,4,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(5,2,'UI_UX_DESIGN','ui-ux-design','UI/UX Design','User-centric interface and experience design, interactive wireframing, clickable prototypes, and modern design systems crafted for effortless navigation.','Great digital products begin with thoughtful design. Our UI/UX design process studies user behavior to create clear wireframes, intuitive navigation pathways, and aesthetically pleasing visual interfaces that elevate engagement and conversion.','DESIGN',NULL,'assets/images/logo.png',NULL,NULL,'fixed_sprint','1 – 3 Weeks','[\"Figma\",\"Interactive Wireframing\",\"Prototyping\",\"Design Systems\",\"User Journey Mapping\"]','[\"Information Architecture & Wireframes\",\"High-Fidelity UI Screens\",\"Interactive Clickable Prototype\",\"Component & Style Guide\",\"Developer Handoff Files\"]',NULL,1,1,5,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(6,2,'GRAPHIC_DESIGN','graphic-design','Graphic Design','Creative graphic design services including marketing banners, digital brochures, promotional collaterals, and branded visual materials for online and print media.','Communicate your brand message with compelling visual assets. Our graphic design services cover promotional banners, marketing materials, digital flyers, and presentation visuals designed to capture customer interest across multiple touchpoints.','CREATIVE',NULL,'assets/images/logo.png',NULL,NULL,'fixed_sprint','3 – 7 Days','[\"Digital Illustration\",\"Vector Graphics\",\"Typography\",\"Visual Composition\",\"Brand Palette\"]','[\"Digital Promotional Banners\",\"Marketing Collateral Designs\",\"High-Resolution Vector Files\",\"Print-Ready & Web Formats\"]',NULL,0,1,6,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(7,2,'LOGO_DESIGN','logo-design','Logo Design','Distinctive, memorable logo design and visual brand identities that define your company character and establish instant recognition.','Your logo is the foundation of your company image. We design modern, versatile logos that express your business personality, ensuring readability and visual impact across digital screens, business stationery, and promotional merchandise.','BRANDING',NULL,'assets/images/logo.png',NULL,NULL,'fixed_sprint','3 – 5 Days','[\"Vector Design\",\"Custom Typography\",\"Color Theory\",\"Iconography\",\"Brand Guidelines\"]','[\"Multiple Initial Logo Concepts\",\"Finalized Vector Master Files (SVG\\/PNG\\/PDF)\",\"Light & Dark Background Variants\",\"Color Palette & Typography Guide\"]',NULL,1,1,7,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(8,3,'DIGITAL_MARKETING','digital-marketing','Digital Marketing','Targeted digital marketing strategies designed to increase brand awareness, drive qualified online traffic, and generate prospective client leads.','Connect with your target audience through structured digital marketing campaigns. We help startups and businesses establish a consistent digital presence, utilize on-page search optimization, and execute strategic promotional efforts.','GROWTH',NULL,'assets/images/logo.png',NULL,NULL,'monthly_pod','Monthly Retainer','[\"Search Engine Optimization\",\"Social Media Marketing\",\"Audience Targeting\",\"Content Strategy\",\"Analytics\"]','[\"Marketing Strategy Roadmap\",\"Search Visibility Optimization\",\"Campaign Performance Reports\",\"Monthly Growth Recommendations\"]',NULL,0,1,8,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(9,3,'SOCIAL_MEDIA_CREATIVE','social-media-creative-design','Social Media Creative Design','Engaging, branded social media posts, multi-slide carousels, and story creatives crafted to keep your feed professional and visually cohesive.','Maintain an active and aesthetic social media presence with customized creative assets. We create cohesive post sets, informational carousels, and promotional graphics formatted specifically for Instagram, LinkedIn, and Facebook.','SOCIAL',NULL,'assets/images/logo.png',NULL,NULL,'monthly_pod','1 – 2 Weeks Sprints','[\"Visual Layouts\",\"Brand Typography\",\"Carousel Storyboarding\",\"Social Sizing Standards\"]','[\"Monthly Post Creative Batches\",\"Carousel Slide Decks\",\"Story & Highlight Graphics\",\"Ready-to-Publish Formats\"]',NULL,0,1,9,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(10,3,'REEL_SHOOTING','professional-reel-shooting','Professional Reel Shooting','On-location and planned visual capture dedicated to producing dynamic vertical video content and short-form engagement reels.','Bring dynamic video to your brand story with dedicated reel shooting sessions. We plan shot lists, lighting, and camera framing specifically configured for 9:16 vertical mobile consumption, capturing your products, locations, and brand moments.','PRODUCTION',NULL,'assets/images/logo.png',NULL,NULL,'fixed_sprint','Per Session / Project','[\"4K Mobile & Camera Gear\",\"Stabilization Rigs\",\"Studio & Location Lighting\",\"Audio Capture\"]','[\"Pre-Shoot Concept & Shot List\",\"On-Location Camera & Lighting Setup\",\"High-Definition Raw Footage Archival\",\"Edited Deliverable Reels\"]',NULL,1,1,10,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(11,3,'VIDEO_CONTENT_CREATION','video-content-creation','Video Content Creation','End-to-end promotional videos, company introductions, explainer videos, and product showcase clips with professional editing.','Visual video content is one of the most effective ways to communicate complex ideas quickly. Click Codex produces promotional videos, service walkthroughs, and product highlights that combine clear narration, graphics, and refined pacing.','MEDIA',NULL,'assets/images/logo.png',NULL,NULL,'fixed_sprint','1 – 3 Weeks','[\"Video Editing Suites\",\"Color Grading\",\"Sound Design & Mixing\",\"Motion Titles\"]','[\"Script & Storyboard Outline\",\"Professional Video Editing\",\"Title Animations & Motion Graphics\",\"Audio Mastering & Background Music\"]',NULL,0,1,11,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(12,3,'REEL_PRODUCTION','reel-short-form-video-production','Reel/Short-Form Video Production','Fast-paced, hook-driven short-form video editing with kinetic typography, seamless transitions, and trending audio synchronization for Instagram and YouTube Shorts.','Short-form vertical video is essential for modern social media growth. We transform footage into polished, engaging reels and shorts complete with attention-grabbing hooks, clean transitions, animated captions, and beat-matched pacing.','TRENDING',NULL,'assets/images/logo.png',NULL,NULL,'fixed_sprint','3 – 5 Days','[\"Vertical Video Editing\",\"Kinetic Subtitles & Captions\",\"Speed Ramps & Transitions\",\"Trending Sound Alignment\"]','[\"Hook-Driven Video Cuts\",\"Dynamic Animated Captions\",\"Color Correction & Sound Polish\",\"Optimized Vertical 9:16 Video Export\"]',NULL,1,1,12,'2026-09-25 13:26:44','2026-09-25 13:26:44');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` longtext DEFAULT NULL,
  `setting_group` enum('general','contact','branding','seo','social','analytics','scripts','legal') NOT NULL DEFAULT 'general',
  `value_type` enum('string','text','boolean','integer','json') NOT NULL DEFAULT 'string',
  `description` varchar(255) DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`),
  KEY `idx_settings_group` (`setting_group`),
  KEY `idx_settings_public` (`is_public`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'company_name','Click Codex','general','string','Official company name',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(2,'company_tagline','Digital Craftsmanship, Full-Stack Engineering & Creative Media','general','string','Brand headline',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(3,'company_status','Startup preparing to officially begin operations','general','string','Operational status',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(4,'company_overview','Click Codex is an emerging digital technology startup preparing to officially begin operations. Powered by a collaborative 4-member team with approximately 2 years of collective experience across development, design, marketing, and media creation.','general','text','Company description',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(5,'team_size','4 Members','general','string','Current team size',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(6,'team_experience','~2 Years in Development & Digital Technology','general','string','Collective team experience',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(7,'founding_year','2026','general','string','Year established / startup phase',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(8,'site_logo','assets/images/logo.png','branding','string','Primary website logo path',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(9,'site_logo_dark','assets/images/logo.png','branding','string','Dark mode logo path',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(10,'site_favicon','assets/images/logo.png','branding','string','Favicon image path',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(11,'brand_primary_color','#0056d6','branding','string','Primary brand color',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(12,'brand_accent_color','#00a2ff','branding','string','Accent cyan glow color',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(13,'contact_email','contact@clickcodex.com','contact','string','Primary public contact email',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(14,'support_email','support@clickcodex.com','contact','string','Customer support email',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(15,'contact_phone','+91 (Contact Available Upon Inquiry)','contact','string','Public contact phone placeholder',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(16,'contact_address','India','contact','string','Base operating region',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(17,'working_hours','Monday – Saturday: 9:30 AM – 6:30 PM IST','contact','string','Operating business hours',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(18,'social_linkedin','https://linkedin.com/company/clickcodex','social','string','LinkedIn company page',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(19,'social_instagram','https://instagram.com/clickcodex','social','string','Instagram official page',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(20,'social_youtube','https://youtube.com/@clickcodex','social','string','YouTube channel',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(21,'social_github','https://github.com/clickcodex','social','string','GitHub organization',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(22,'social_twitter','https://twitter.com/clickcodex','social','string','Twitter/X handle',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(23,'default_meta_title','Click Codex — Technology & Creative Digital Startup','seo','string','Default title tag',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(24,'default_meta_desc','Click Codex is a modern technology startup providing Full-Stack Web Development, Mobile Apps, UI/UX, Graphic Design, Digital Marketing, and Professional Video/Reel Production.','seo','text','Default meta description',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(25,'default_keywords','Click Codex, web development, website design, mobile apps, software development, UI UX design, graphic design, logo design, digital marketing, reel shooting, video production','seo','text','Default focus keywords',1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(26,'google_analytics_id','','analytics','string','GA4 Measurement ID (optional)',0,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(27,'cookie_consent_enabled','1','legal','boolean','Show cookie consent banner',1,'2026-09-25 13:26:44','2026-09-25 13:26:44');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solution_advisor_options`
--

DROP TABLE IF EXISTS `solution_advisor_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solution_advisor_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `option_key` varchar(50) NOT NULL,
  `icon_emoji` varchar(20) DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `description` varchar(500) NOT NULL,
  `order_num` smallint(6) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_opt_question` (`question_id`),
  CONSTRAINT `fk_opt_question` FOREIGN KEY (`question_id`) REFERENCES `solution_advisor_questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solution_advisor_options`
--

LOCK TABLES `solution_advisor_options` WRITE;
/*!40000 ALTER TABLE `solution_advisor_options` DISABLE KEYS */;
INSERT INTO `solution_advisor_options` VALUES (1,1,'build_website','🌐','Build or Redesign a Website','A clean, modern website to showcase your business, services, or personal brand.',1,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(2,1,'build_webapp','⚡','Custom Web or Software App','A tailored full-stack application or software tool with custom workflows.',2,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(3,1,'brand_design','🎨','Logo, UI/UX or Graphic Design','Memorable logo creation, UI/UX screens, or visual marketing collaterals.',3,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(4,1,'video_reels','🎬','Reel Shooting & Video Content','Professional short-form video shooting, editing, and dynamic social media reels.',4,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(5,2,'starting_out','🌱','Early Concept / Just Starting Out','We have an idea or requirement and need foundational guidance and building.',1,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(6,2,'need_upgrade','🚀','Existing Presence Needs an Upgrade','We have an existing website or assets that need redesigning or rebuilding.',2,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(7,2,'ready_to_build','📐','Clear Requirements, Ready to Execute','We have our content, requirements, or design ready to develop.',3,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(8,3,'fast_track','⚡','Fast-Track (1 – 2 Weeks)','Accelerated delivery for urgent launches or starter assets.',1,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(9,3,'standard_sprint','⏱️','Standard Sprint (2 – 4 Weeks)','Thorough development, design iterations, and quality checks.',2,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(10,3,'flexible','📅','Flexible / Phased Rollout','Milestone-based progress with iterative reviews and expansion.',3,1,'2026-09-25 13:26:44','2026-09-25 13:26:44');
/*!40000 ALTER TABLE `solution_advisor_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solution_advisor_questions`
--

DROP TABLE IF EXISTS `solution_advisor_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solution_advisor_questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `step_number` tinyint(4) NOT NULL,
  `step_label` varchar(100) NOT NULL,
  `category_key` varchar(50) NOT NULL COMMENT 'goal, stage, features, timeline',
  `question_text` varchar(255) NOT NULL,
  `question_subtitle` varchar(255) DEFAULT NULL,
  `is_multi_select` tinyint(1) NOT NULL DEFAULT 0,
  `order_num` smallint(6) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_key` (`category_key`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solution_advisor_questions`
--

LOCK TABLES `solution_advisor_questions` WRITE;
/*!40000 ALTER TABLE `solution_advisor_questions` DISABLE KEYS */;
INSERT INTO `solution_advisor_questions` VALUES (1,1,'Primary Goal','goal','What is the main objective you want to achieve?','Select the primary goal that best matches your immediate requirement.',0,1,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(2,2,'Current Stage','stage','Where are you currently in your project lifecycle?','This helps us scope the required milestones and support.',0,2,1,'2026-09-25 13:26:44','2026-09-25 13:26:44'),(3,3,'Desired Timeline','timeline','What is your preferred project completion timeline?','Helps us schedule our 4-member sprint capacity.',0,3,1,'2026-09-25 13:26:44','2026-09-25 13:26:44');
/*!40000 ALTER TABLE `solution_advisor_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `role_title` varchar(150) NOT NULL,
  `specialty` varchar(150) NOT NULL,
  `experience_years` varchar(50) NOT NULL,
  `avatar_image` varchar(500) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `skills` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`skills`)),
  `social_links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_links`)),
  `order_num` smallint(6) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_members`
--

LOCK TABLES `team_members` WRITE;
/*!40000 ALTER TABLE `team_members` DISABLE KEYS */;
INSERT INTO `team_members` VALUES (1,'Full-Stack Developer','full-stack-developer','Full-Stack Web & Software Developer','Web & Software Engineering','2 Years Experience','assets/images/logo.png','Focuses on responsive website development, custom web applications, robust database management, and scalable API integrations with modern clean-code standards.','[\"Full-Stack Web Development\",\"PHP\",\"JavaScript\",\"HTML5 & CSS3\",\"MySQL Databases\",\"RESTful APIs\",\"Git\"]','{\"linkedin\":\"https:\\/\\/linkedin.com\",\"github\":\"https:\\/\\/github.com\"}',1,1),(2,'UI/UX & Graphic Designer','ui-ux-graphic-designer','UI/UX & Visual Brand Designer','Interface, Logo & Graphic Design','2 Years Experience','assets/images/logo.png','Crafts user-friendly interface designs, modern brand aesthetics, impactful logos, and creative visual collaterals that bridge user intuition with brand identity.','[\"UI\\/UX Design\",\"Wireframing & Prototyping\",\"Logo Design\",\"Graphic Design\",\"Figma\",\"Visual Systems\"]','{\"linkedin\":\"https:\\/\\/linkedin.com\",\"behance\":\"https:\\/\\/behance.net\"}',2,1),(3,'Digital Marketing Specialist','digital-marketing-specialist','Digital Marketing & Social Media Strategist','Digital Growth & Social Creatives','2 Years Experience','assets/images/logo.png','Develops strategic digital marketing campaigns, social media creative concepts, audience engagement workflows, and search optimization fundamentals.','[\"Digital Marketing\",\"Social Media Strategy\",\"Creative Design Concepts\",\"Content Marketing\",\"SEO Fundamentals\",\"Campaign Analytics\"]','{\"linkedin\":\"https:\\/\\/linkedin.com\",\"instagram\":\"https:\\/\\/instagram.com\"}',3,1),(4,'Video & Content Creator','video-content-creator','Video Producer & Reel Specialist','Reel Shooting & Video Production','2 Years Experience','assets/images/logo.png','Specializes in professional reel shooting, short-form video production, promotional video editing, visual storytelling, and dynamic social media media assets.','[\"Professional Reel Shooting\",\"Short-Form Video Production\",\"Video Editing\",\"Motion Graphics\",\"Visual Storytelling\",\"Audio Sync\"]','{\"youtube\":\"https:\\/\\/youtube.com\",\"instagram\":\"https:\\/\\/instagram.com\"}',4,1);
/*!40000 ALTER TABLE `team_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_name` varchar(150) NOT NULL,
  `client_position` varchar(150) NOT NULL,
  `client_company` varchar(150) NOT NULL,
  `client_avatar` varchar(500) DEFAULT NULL,
  `rating_stars` decimal(2,1) NOT NULL DEFAULT 5.0,
  `testimonial_quote` text NOT NULL,
  `case_study_id` int(10) unsigned DEFAULT NULL,
  `is_featured_home` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `order_num` smallint(6) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_test_featured` (`is_featured_home`,`is_active`),
  KEY `fk_test_cs` (`case_study_id`),
  CONSTRAINT `fk_test_cs` FOREIGN KEY (`case_study_id`) REFERENCES `case_studies` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trusted_brands`
--

DROP TABLE IF EXISTS `trusted_brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trusted_brands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(100) NOT NULL,
  `badge_text` varchar(100) NOT NULL,
  `logo_image` varchar(500) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `order_num` smallint(6) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trusted_brands`
--

LOCK TABLES `trusted_brands` WRITE;
/*!40000 ALTER TABLE `trusted_brands` DISABLE KEYS */;
/*!40000 ALTER TABLE `trusted_brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `url_redirects`
--

DROP TABLE IF EXISTS `url_redirects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `url_redirects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `source_path` varchar(500) NOT NULL,
  `target_path` varchar(500) NOT NULL,
  `status_code` smallint(6) NOT NULL DEFAULT 301 COMMENT '301 Permanent, 302 Temporary, 307, 410 Gone',
  `hits_count` int(10) unsigned DEFAULT 0,
  `last_accessed_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `source_path` (`source_path`),
  KEY `idx_redirect_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `url_redirects`
--

LOCK TABLES `url_redirects` WRITE;
/*!40000 ALTER TABLE `url_redirects` DISABLE KEYS */;
/*!40000 ALTER TABLE `url_redirects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('super_admin','admin','editor','seo_specialist') NOT NULL DEFAULT 'admin',
  `avatar_url` varchar(500) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_login_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_users_role` (`role`),
  KEY `idx_users_active` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Click Codex Admin','admin@clickcodex.com','y$rE67mkqFE6YHZFAIAKZWKuYpgcYRG698unnkAQcFsp/8.Y3cUHYR.','super_admin','assets/images/logo.png','+91 0000000000',NULL,1,NULL,'2026-09-25 13:26:44','2026-09-25 13:26:44');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-25 19:22:34
