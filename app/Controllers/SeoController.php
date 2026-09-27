<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Config\Database;
use mysqli;
use Exception;

class SeoController {
    private ?mysqli $db = null;

    public function __construct() {
        try {
            $this->db = Database::connect();
        } catch (Exception $e) {
            $this->db = null;
        }
    }

    /**
     * Generate dynamic XML Sitemap compliant with sitemaps.org schema
     */
    public function sitemap(): void {
        http_response_code(200);
        header('Content-Type: application/xml; charset=utf-8');
        header('X-Robots-Tag: noindex, follow');

        $baseUrl = defined('BASE_URL') && !empty(BASE_URL) ? rtrim(BASE_URL, '/') : 'https://clickcodex.com';

        $urls = [];

        // 1. Static Core Landing Pages
        $staticPages = [
            ['loc' => '/', 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => '/aboutus', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => '/services', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => '/service-finder', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => '/portfolio', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => '/pricing', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => '/blogs', 'priority' => '0.9', 'changefreq' => 'daily'],
            ['loc' => '/contactus', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => '/privacy-policy', 'priority' => '0.3', 'changefreq' => 'yearly'],
            ['loc' => '/terms-of-service', 'priority' => '0.3', 'changefreq' => 'yearly'],
        ];

        $today = date('Y-m-d');
        foreach ($staticPages as $page) {
            $urls[] = [
                'loc' => $baseUrl . $page['loc'],
                'lastmod' => $today,
                'changefreq' => $page['changefreq'],
                'priority' => $page['priority']
            ];
        }

        // 2. Dynamic Services
        if ($this->db) {
            $res = $this->db->query("SELECT slug, updated_at FROM services WHERE is_active = 1 ORDER BY order_num ASC");
            if ($res) {
                while ($row = $res->fetch_assoc()) {
                    $urls[] = [
                        'loc' => $baseUrl . '/services/' . urlencode($row['slug']),
                        'lastmod' => !empty($row['updated_at']) ? date('Y-m-d', strtotime($row['updated_at'])) : $today,
                        'changefreq' => 'weekly',
                        'priority' => '0.8'
                    ];
                }
            }

            // 3. Dynamic Blog Articles
            $res = $this->db->query("SELECT slug, updated_at, published_at FROM blog_posts WHERE is_published = 1 ORDER BY published_at DESC");
            if ($res) {
                while ($row = $res->fetch_assoc()) {
                    $mod = !empty($row['updated_at']) ? $row['updated_at'] : (!empty($row['published_at']) ? $row['published_at'] : $today);
                    $urls[] = [
                        'loc' => $baseUrl . '/blogs/' . urlencode($row['slug']),
                        'lastmod' => date('Y-m-d', strtotime($mod)),
                        'changefreq' => 'monthly',
                        'priority' => '0.7'
                    ];
                }
            }
        }

        // Generate XML output
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
        echo '        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n";
        echo '        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";

        foreach ($urls as $u) {
            echo "  <url>\n";
            echo "    <loc>" . htmlspecialchars($u['loc'], ENT_XML1, 'UTF-8') . "</loc>\n";
            echo "    <lastmod>" . $u['lastmod'] . "</lastmod>\n";
            echo "    <changefreq>" . $u['changefreq'] . "</changefreq>\n";
            echo "    <priority>" . $u['priority'] . "</priority>\n";
            echo "  </url>\n";
        }

        echo '</urlset>';
        exit;
    }

    /**
     * Generate dynamic robots.txt
     */
    public function robots(): void {
        http_response_code(200);
        header('Content-Type: text/plain; charset=utf-8');

        $baseUrl = defined('BASE_URL') && !empty(BASE_URL) ? rtrim(BASE_URL, '/') : 'https://clickcodex.com';

        echo "User-agent: *\n";
        echo "Allow: /\n";
        echo "Disallow: /admin/\n";
        echo "Disallow: /api/\n";
        echo "Disallow: /storage/\n";
        echo "Disallow: /app/\n";
        echo "Disallow: /vendor/\n";
        echo "Disallow: /database/\n";
        echo "Disallow: /tests/\n\n";
        echo "Sitemap: " . $baseUrl . "/sitemap.xml\n";
        exit;
    }
}
