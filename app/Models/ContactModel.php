<?php
declare(strict_types=1);

namespace App\Models;

use App\Config\Database;
use mysqli;

class ContactModel {
    private mysqli $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Retrieve all active public site settings
     */
    public function getSettings(): array {
        $settings = [];
        $res = $this->db->query("SELECT setting_key, setting_value FROM site_settings WHERE is_public = 1");
        if ($res) {
            while ($row = $res->fetch_assoc()) {
                $settings[$row['setting_key']] = $row['setting_value'];
            }
        }

        $defaults = [
            'site_name' => 'ClickCodex',
            'site_tagline' => 'Ideas To Solutions',
            'site_title' => 'Contact Us | Start Your Project Consultation - ClickCodex',
            'meta_description' => 'Get in touch with ClickCodex tech architects. Request a project proposal, explore custom engineering packages, or schedule a free 30-minute technical discovery call.',
            'whatsapp_number' => '+919876543210',
            'contact_phone' => '+91 (987) 654-3210',
            'contact_email' => 'hello@clickcodex.com',
            'social_linkedin' => 'https://linkedin.com',
            'social_twitter' => 'https://twitter.com',
            'social_instagram' => 'https://instagram.com',
            'social_youtube' => 'https://youtube.com',
            'office_bangalore_title' => 'Bangalore Engineering Center',
            'office_bangalore_address' => 'Tech Innovation Park, Whitefield, Bangalore, Karnataka, India - 560066',
            'office_bangalore_map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d124419.64553259835!2d77.62534575!3d12.96962255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1670c9b44e6d%3A0xf8dfc3e8517e4fe0!2sBengaluru%2C%20Karnataka!5e0!3m2!1sen!2sin!4v1675882877123',
            'office_mumbai_title' => 'Mumbai Product & Growth Lab',
            'office_mumbai_address' => 'Bandra Kurla Complex (BKC), G Block, Mumbai, Maharashtra, India - 400051',
            'office_mumbai_map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d120638.16335967007!2d72.825838!3d19.0657!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c8e123f135b1%3A0x6b29f95d8787f0b8!2sBandra%20Kurla%20Complex!5e0!3m2!1sen!2sin!4v1675882899000',
            'theme_color' => '#0056d6'
        ];

        return array_merge($defaults, $settings);
    }

    /**
     * Retrieve SEO metadata for Contact Us page
     */
    public function getSeoMetadata(): array {
        $stmt = $this->db->prepare("SELECT * FROM seo_metadata WHERE (entity_type = 'page' AND entity_id = 8) OR route_path IN ('/contactus', 'contactus', '/contact') LIMIT 1");
        if ($stmt) {
            $stmt->execute();
            $res = $stmt->get_result();
            $seo = $res->fetch_assoc();
            if ($seo) {
                return $seo;
            }
        }

        return [
            'meta_title' => 'Contact Us | Start Your Project Consultation - ClickCodex',
            'meta_description' => 'Get in touch with ClickCodex tech architects. Request a project proposal, explore custom engineering packages, or schedule a free 30-minute technical discovery call.',
            'meta_keywords' => 'Contact ClickCodex, hire web developers India, software development quote, Bangalore tech agency, Mumbai web agency, digital marketing consultation',
            'canonical_url' => (defined('BASE_URL') ? BASE_URL : '') . '/contactus',
            'og_title' => 'Contact Us | Start Your Project Consultation - ClickCodex',
            'og_description' => 'Get in touch with ClickCodex tech architects. Request a project proposal, explore custom engineering packages, or schedule a free 30-minute technical discovery call.',
            'og_image' => (defined('BASE_URL') ? BASE_URL : '') . '/public/assets/images/logo.png',
            'og_type' => 'website',
            'twitter_card' => 'summary_large_image',
            'twitter_title' => 'Contact Us | Start Your Project Consultation - ClickCodex',
            'twitter_description' => 'Fast 2-hour response SLA. Direct access to lead architects from day one.',
            'twitter_image' => (defined('BASE_URL') ? BASE_URL : '') . '/public/assets/images/logo.png',
            'robots_index' => 1,
            'robots_follow' => 1
        ];
    }

    /**
     * Retrieve base page details for Contact Us
     */
    public function getPageData(): array {
        $stmt = $this->db->prepare("SELECT * FROM pages WHERE id = 8 OR slug = 'contactus' LIMIT 1");
        if ($stmt) {
            $stmt->execute();
            $res = $stmt->get_result();
            $page = $res->fetch_assoc();
            if ($page) {
                return $page;
            }
        }

        return [
            'id' => 8,
            'slug' => 'contactus',
            'title' => 'Contact & Inquiries',
            'subtitle' => 'Let\'s Discuss Your Next Strategic Milestone'
        ];
    }

    /**
     * Retrieve page sections for Contact Us
     */
    public function getPageSections(): array {
        $sections = [];
        $stmt = $this->db->prepare("SELECT * FROM page_sections WHERE page_id = 8 AND is_active = 1 ORDER BY order_num ASC");
        if ($stmt) {
            $stmt->execute();
            $res = $stmt->get_result();
            while ($row = $res->fetch_assoc()) {
                $sections[$row['section_key']] = $row;
            }
        }

        return $sections;
    }

    /**
     * Retrieve General FAQs for Contact Page
     */
    public function getFaqs(): array {
        $faqs = [];
        $res = $this->db->query("SELECT * FROM faqs WHERE category IN ('general', 'contact') AND is_active = 1 ORDER BY order_num ASC");
        if ($res) {
            while ($row = $res->fetch_assoc()) {
                $faqs[] = $row;
            }
        }

        return $faqs;
    }

    /**
     * Retrieve Campus & Location Configurations
     */
    public function getCampuses(): array {
        $settings = $this->getSettings();

        return [
            'bangalore' => [
                'key' => 'bangalore',
                'tab_name' => 'Bangalore HQ',
                'title' => $settings['office_bangalore_title'] ?? 'Bangalore Engineering Center',
                'address' => $settings['office_bangalore_address'] ?? 'Tech Innovation Park, Whitefield, Bangalore, Karnataka, India - 560066',
                'map_url' => $settings['office_bangalore_map_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d124419.64553259835!2d77.62534575!3d12.96962255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1670c9b44e6d%3A0xf8dfc3e8517e4fe0!2sBengaluru%2C%20Karnataka!5e0!3m2!1sen!2sin!4v1675882877123',
                'timezone' => 'IST (UTC+5:30)',
                'working_hours' => 'Mon - Sat (9:30 AM - 7:00 PM)'
            ],
            'mumbai' => [
                'key' => 'mumbai',
                'tab_name' => 'Mumbai Studio',
                'title' => $settings['office_mumbai_title'] ?? 'Mumbai Product & Growth Lab',
                'address' => $settings['office_mumbai_address'] ?? 'Bandra Kurla Complex (BKC), G Block, Mumbai, Maharashtra, India - 400051',
                'map_url' => $settings['office_mumbai_map_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d120638.16335967007!2d72.825838!3d19.0657!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c8e123f135b1%3A0x6b29f95d8787f0b8!2sBandra%20Kurla%20Complex!5e0!3m2!1sen!2sin!4v1675882899000',
                'timezone' => 'IST (UTC+5:30)',
                'working_hours' => 'Mon - Sat (10:00 AM - 7:30 PM)'
            ]
        ];
    }

    /**
     * Save incoming project inquiry or consultation modal request
     */
    public function saveInquiry(array $data): array {
        $inquiryType = in_array($data['inquiry_type'] ?? '', ['consultation_modal', 'discovery_form', 'service_request', 'custom_quote'], true) 
            ? $data['inquiry_type'] 
            : 'discovery_form';

        $fullName = trim((string)($data['full_name'] ?? ''));
        $email = trim((string)($data['email'] ?? ''));
        $phone = trim((string)($data['phone'] ?? ''));
        $companyName = trim((string)($data['company_name'] ?? ''));
        $interestedService = trim((string)($data['interested_service'] ?? ''));
        if (is_array($data['selected_services'] ?? null)) {
            $selectedServices = json_encode(array_values($data['selected_services']), JSON_UNESCAPED_UNICODE);
        } elseif (!empty($data['selected_services'])) {
            $val = (string)$data['selected_services'];
            $decoded = json_decode($val, true);
            $selectedServices = (json_last_error() === JSON_ERROR_NONE && is_array($decoded))
                ? $val
                : json_encode([$val], JSON_UNESCAPED_UNICODE);
        } else {
            $selectedServices = '[]';
        }
        $budgetBracket = trim((string)($data['budget_bracket'] ?? ''));
        $timeline = trim((string)($data['timeline'] ?? ''));
        $message = trim((string)($data['message'] ?? ''));
        $sourcePage = trim((string)($data['source_page'] ?? '/contactus'));
        $ipAddress = substr((string)($_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'), 0, 45);
        $userAgent = substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255);
        $status = 'new';

        // Basic validation
        if (empty($fullName)) {
            return ['success' => false, 'error' => 'Please provide your full name.'];
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'error' => 'Please provide a valid email address.'];
        }
        if (empty($phone)) {
            return ['success' => false, 'error' => 'Please provide your contact phone or WhatsApp number.'];
        }

        $sql = "INSERT INTO contact_inquiries (
            inquiry_type, full_name, email, phone, company_name, 
            interested_service, selected_services, budget_bracket, timeline, 
            message, source_page, ip_address, user_agent, status, created_at, updated_at
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            return ['success' => false, 'error' => 'Database error: ' . $this->db->error];
        }

        $stmt->bind_param(
            'ssssssssssssss',
            $inquiryType,
            $fullName,
            $email,
            $phone,
            $companyName,
            $interestedService,
            $selectedServices,
            $budgetBracket,
            $timeline,
            $message,
            $sourcePage,
            $ipAddress,
            $userAgent,
            $status
        );

        if ($stmt->execute()) {
            $inquiryId = (int)$stmt->insert_id;

            // Dispatch to real-time notification hub & webhooks
            try {
                $adminModel = new \App\Models\Admin\AdminModel();
                $adminModel->addSystemNotification(
                    'inquiry',
                    'New Inquiry: ' . $fullName,
                    "Commercial lead from {$fullName}" . ($companyName ? " ({$companyName})" : "") . " regarding " . ($interestedService ?: "custom solution") . ". Budget: " . ($budgetBracket ?: "Not specified"),
                    '/admin/inquiries?id=' . $inquiryId
                );

                $adminModel->triggerWebhooks('inquiry.created', [
                    'inquiry_id' => $inquiryId,
                    'inquiry_type' => $inquiryType,
                    'full_name' => $fullName,
                    'email' => $email,
                    'phone' => $phone,
                    'company_name' => $companyName,
                    'interested_service' => $interestedService,
                    'budget_bracket' => $budgetBracket,
                    'timeline' => $timeline,
                    'message' => $message,
                    'source_page' => $sourcePage,
                    'timestamp' => date('c')
                ]);
            } catch (\Throwable $e) {
                error_log("Webhook/Notification dispatch notice: " . $e->getMessage());
            }

            return [
                'success' => true,
                'inquiry_id' => $inquiryId,
                'message' => 'Thank you! Your requirements have been submitted under mutual NDA. A ClickCodex technical director will reach out to you within 2 hours.'
            ];
        }

        return ['success' => false, 'error' => 'Failed to record your inquiry: ' . $stmt->error];
    }
}
