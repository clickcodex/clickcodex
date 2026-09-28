<?php

require_once __DIR__ . '/Router.php';

$router = new Router();

// =============================================================================
// PUBLIC ROUTES (No Authentication Required)
// =============================================================================

$router->get('/', 'HomeController@index');
$router->get('home', 'HomeController@index');
$router->get('index.html', 'HomeController@index');

$router->get('aboutus', 'AboutController@index');
$router->get('about-us', 'AboutController@index');
$router->get('about', 'AboutController@index');
$router->get('aboutus.html', 'AboutController@index');

$router->get('services', 'ServicesController@index');
$router->get('services.html', 'ServicesController@index');
$router->get('our-services', 'ServicesController@index');
$router->get('service-detail', 'ServicesController@detail');
$router->get('service-detail.html', 'ServicesController@detail');
$router->get('services/{slug}', 'ServicesController@detail');

$router->get('service-finder', 'AdvisorController@index');
$router->get('service-finder.html', 'AdvisorController@index');
$router->get('advisor', 'AdvisorController@index');
$router->get('solution-advisor', 'AdvisorController@index');

$router->get('portfolio', 'PortfolioController@index');
$router->get('portfolio.html', 'PortfolioController@index');
$router->get('case-studies', 'PortfolioController@index');

$router->get('pricing', 'PricingController@index');
$router->get('pricing.html', 'PricingController@index');
$router->get('packages', 'PricingController@index');
$router->get('plans', 'PricingController@index');

$router->get('blogs', 'BlogsController@index');
$router->get('blogs.html', 'BlogsController@index');
$router->get('blog', 'BlogsController@index');
$router->get('blog-detail', 'BlogsController@detail');
$router->get('blog-detail.html', 'BlogsController@detail');
$router->get('blogs/{slug}', 'BlogsController@detail');

$router->get('contactus', 'ContactController@index');
$router->get('contactus.html', 'ContactController@index');
$router->get('contact', 'ContactController@index');
$router->get('contact-us', 'ContactController@index');
$router->post('contact/submit', 'ContactController@submit');
$router->post('api/contact', 'ContactController@submit');

$router->get('privacy-policy', 'LegalController@privacy');
$router->get('privacy-policy.html', 'LegalController@privacy');
$router->get('privacy', 'LegalController@privacy');

$router->get('terms-of-service', 'LegalController@terms');
$router->get('terms-of-service.html', 'LegalController@terms');
$router->get('terms', 'LegalController@terms');

// =============================================================================
// SEARCH ENGINE OPTIMIZATION (SEO) & CRAWLER ROUTES
// =============================================================================
$router->get('sitemap.xml', 'SeoController@sitemap');
$router->get('sitemap', 'SeoController@sitemap');
$router->get('robots.txt', 'SeoController@robots');

// =============================================================================
// ADMIN AUTHENTICATION ROUTES
// =============================================================================
$router->get('admin', 'Admin/AuthController@login');
$router->get('admin/login', 'Admin/AuthController@login');
$router->post('admin/login', 'Admin/AuthController@authenticate');
$router->get('admin/logout', 'Admin/AuthController@logout');

// =============================================================================
// PROTECTED ADMIN CONSOLE (Authentication Required)
// =============================================================================
$router->group(fn() => \App\Middleware\AuthMiddleware::check(), function() use ($router) {
    $router->get('admin/dashboard', 'Admin/DashboardController@index');
    $router->post('admin/clear-cache', 'Admin/DashboardController@clearCache');

    // Inquiries & Leads CRM Routes
    $router->get('admin/inquiries', 'Admin/InquiriesController@index');
    $router->get('admin/leads', 'Admin/InquiriesController@index');
    $router->get('admin/inquiries/export', 'Admin/InquiriesController@exportCsv');
    $router->get('admin/inquiry/detail', 'Admin/InquiriesController@getDetail');
    $router->post('admin/inquiry/status', 'Admin/InquiriesController@updateStatus');
    $router->post('admin/inquiry/notes', 'Admin/InquiriesController@saveNotes');
    $router->post('admin/inquiry/create', 'Admin/InquiriesController@create');
    $router->post('admin/inquiry/delete', 'Admin/InquiriesController@delete');
    $router->post('admin/inquiry/bulk', 'Admin/InquiriesController@bulkAction');

    // Capabilities & Services System Routes
    $router->get('admin/capabilities', 'Admin/CapabilitiesController@index');
    $router->get('admin/services', 'Admin/CapabilitiesController@index');
    $router->get('admin/capability/detail', 'Admin/CapabilitiesController@getDetail');
    $router->post('admin/capability/save', 'Admin/CapabilitiesController@save');
    $router->post('admin/capability/toggle-status', 'Admin/CapabilitiesController@toggleStatus');
    $router->post('admin/capability/toggle-featured', 'Admin/CapabilitiesController@toggleFeatured');
    $router->post('admin/capability/duplicate', 'Admin/CapabilitiesController@duplicate');
    $router->post('admin/capability/delete', 'Admin/CapabilitiesController@delete');
    $router->get('admin/capabilities/export', 'Admin/CapabilitiesController@exportCsv');

    // Portfolio & Case Studies Management Routes
    $router->get('admin/portfolio', 'Admin/PortfolioController@index');
    $router->get('admin/case-studies', 'Admin/PortfolioController@index');
    $router->get('admin/portfolio/detail', 'Admin/PortfolioController@getDetail');
    $router->post('admin/portfolio/save', 'Admin/PortfolioController@save');
    $router->post('admin/portfolio/toggle-status', 'Admin/PortfolioController@toggleStatus');
    $router->post('admin/portfolio/toggle-featured', 'Admin/PortfolioController@toggleFeatured');
    $router->post('admin/portfolio/duplicate', 'Admin/PortfolioController@duplicate');
    $router->post('admin/portfolio/delete', 'Admin/PortfolioController@delete');
    $router->get('admin/portfolio/export', 'Admin/PortfolioController@exportCsv');

    // Technical Articles & Editorial Dispatch Management Routes
    $router->get('admin/articles', 'Admin/ArticlesController@index');
    $router->get('admin/posts', 'Admin/ArticlesController@index');
    $router->get('admin/blogs', 'Admin/ArticlesController@index');
    $router->get('admin/article/detail', 'Admin/ArticlesController@getDetail');
    $router->post('admin/article/save', 'Admin/ArticlesController@save');
    $router->post('admin/article/toggle-status', 'Admin/ArticlesController@toggleStatus');
    $router->post('admin/article/toggle-featured', 'Admin/ArticlesController@toggleFeatured');
    $router->post('admin/article/duplicate', 'Admin/ArticlesController@duplicate');
    $router->post('admin/article/delete', 'Admin/ArticlesController@delete');
    $router->get('admin/articles/export', 'Admin/ArticlesController@exportCsv');

    // Solution Advisor & Architecture Archetype Engine Routes
    $router->get('admin/solution-advisor', 'Admin/SolutionAdvisorController@index');
    $router->get('admin/advisor', 'Admin/SolutionAdvisorController@index');
    $router->get('admin/service-finder', 'Admin/SolutionAdvisorController@index');
    $router->get('admin/advisor/detail', 'Admin/SolutionAdvisorController@getDetail');
    $router->post('admin/advisor/save', 'Admin/SolutionAdvisorController@save');
    $router->post('admin/advisor/toggle-status', 'Admin/SolutionAdvisorController@toggleStatus');
    $router->post('admin/advisor/duplicate', 'Admin/SolutionAdvisorController@duplicate');
    $router->post('admin/advisor/delete', 'Admin/SolutionAdvisorController@delete');
    $router->get('admin/advisor/export', 'Admin/SolutionAdvisorController@exportCsv');

    // User Management & Role-Based Access Control (RBAC) Routes
    $router->get('admin/users', 'Admin/UsersController@index');
    $router->get('admin/team', 'Admin/UsersController@index');
    $router->get('admin/user/detail', 'Admin/UsersController@getDetail');
    $router->post('admin/user/save', 'Admin/UsersController@save');
    $router->post('admin/user/toggle-status', 'Admin/UsersController@toggleStatus');
    $router->post('admin/user/reset-password', 'Admin/UsersController@resetPassword');
    $router->post('admin/user/delete', 'Admin/UsersController@delete');
    $router->get('admin/users/export', 'Admin/UsersController@exportCsv');

    // Advanced Analytics & Growth Intelligence Dashboard Routes
    $router->get('admin/analytics', 'Admin/AnalyticsController@index');
    $router->get('admin/metrics', 'Admin/AnalyticsController@index');
    $router->get('admin/analytics/data', 'Admin/AnalyticsController@getData');
    $router->get('admin/analytics/export', 'Admin/AnalyticsController@exportCsv');

    // Global Site Settings & Studio Configuration Routes
    $router->get('admin/settings', 'Admin/SettingsController@index');
    $router->get('admin/site-settings', 'Admin/SettingsController@index');
    $router->get('admin/configuration', 'Admin/SettingsController@index');
    $router->post('admin/settings/save', 'Admin/SettingsController@saveBatch');
    $router->post('admin/settings/save-single', 'Admin/SettingsController@saveSingle');
    $router->post('admin/settings/create', 'Admin/SettingsController@create');
    $router->post('admin/settings/delete', 'Admin/SettingsController@delete');
    $router->get('admin/settings/export', 'Admin/SettingsController@export');
    $router->post('admin/settings/import', 'Admin/SettingsController@import');
    $router->post('admin/settings/clear-cache', 'Admin/SettingsController@clearCache');
    // Executive Reporting Engine Routes
    $router->get('admin/reporting', 'Admin/ReportingController@index');
    $router->get('admin/reports', 'Admin/ReportingController@index');
    $router->get('admin/reporting/data', 'Admin/ReportingController@getData');
    $router->get('admin/reporting/export', 'Admin/ReportingController@exportCsv');

    // Third-Party Webhook & CRM Integrations Routes
    $router->get('admin/integrations', 'Admin/IntegrationsController@index');
    $router->get('admin/webhooks', 'Admin/IntegrationsController@index');
    $router->post('admin/webhook/save', 'Admin/IntegrationsController@save');
    $router->post('admin/webhook/delete', 'Admin/IntegrationsController@delete');
    $router->post('admin/webhook/test', 'Admin/IntegrationsController@test');

    // Centralized Notifications Center Routes
    $router->get('admin/notifications', 'Admin/NotificationsController@index');
    $router->post('admin/notifications/mark-read', 'Admin/NotificationsController@markRead');
    $router->post('admin/notifications/mark-all-read', 'Admin/NotificationsController@markAllRead');
    $router->post('admin/notifications/clear', 'Admin/NotificationsController@clear');

    // Data Export & System Snapshot Center Routes
    $router->get('admin/data-export', 'Admin/DataExportController@index');
    $router->get('admin/backups', 'Admin/DataExportController@index');
    $router->get('admin/data-export/sql', 'Admin/DataExportController@downloadSql');
    $router->get('admin/data-export/json', 'Admin/DataExportController@downloadJson');
    $router->get('admin/data-export/csv', 'Admin/DataExportController@downloadCsv');

    // RESTful API Access & Secret Key Generator Routes
    $router->get('admin/api-access', 'Admin/ApiAccessController@index');
    $router->get('admin/api-keys', 'Admin/ApiAccessController@index');
    $router->post('admin/api-key/create', 'Admin/ApiAccessController@create');
    $router->post('admin/api-key/toggle', 'Admin/ApiAccessController@toggle');
    $router->post('admin/api-key/revoke', 'Admin/ApiAccessController@revoke');
});

// =============================================================================
// PUBLIC REST API v1 ENDPOINTS
// =============================================================================
$router->get('api/v1/status', 'ApiController@status');
$router->get('api/v1/services', 'ApiController@services');
$router->get('api/v1/articles', 'ApiController@articles');
$router->post('api/v1/inquiries', 'ApiController@createInquiry');

// =============================================================================
// RESOLVE ROUTE
// =============================================================================
$router->resolve();
