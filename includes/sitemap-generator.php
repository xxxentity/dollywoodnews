<?php
/**
 * Sitemap Generator for Dollywood News
 * Automatically generates and updates sitemap.xml when articles are added/modified
 */

function generateSitemap() {
    $domain = 'https://dollywoodnews.com';
    $articlesDir = __DIR__ . '/../articles/';

    // Start XML content
    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

    // Homepage
    $xml .= '    <!-- Homepage -->' . PHP_EOL;
    $xml .= '    <url>' . PHP_EOL;
    $xml .= '        <loc>' . $domain . '/</loc>' . PHP_EOL;
    $xml .= '        <lastmod>' . date('Y-m-d') . '</lastmod>' . PHP_EOL;
    $xml .= '        <changefreq>daily</changefreq>' . PHP_EOL;
    $xml .= '        <priority>1.0</priority>' . PHP_EOL;
    $xml .= '    </url>' . PHP_EOL;
    $xml .= PHP_EOL;

    // Static Pages
    $staticPages = [
        ['path' => '/about', 'changefreq' => 'monthly', 'priority' => '0.8'],
        ['path' => '/contact', 'changefreq' => 'monthly', 'priority' => '0.7'],
        ['path' => '/privacy', 'changefreq' => 'yearly', 'priority' => '0.5'],
        ['path' => '/terms', 'changefreq' => 'yearly', 'priority' => '0.5'],
        ['path' => '/sitemap', 'changefreq' => 'weekly', 'priority' => '0.4'],
        ['path' => '/admin.php', 'changefreq' => 'monthly', 'priority' => '0.3']
    ];

    $xml .= '    <!-- Static Pages -->' . PHP_EOL;
    foreach ($staticPages as $page) {
        $xml .= '    <url>' . PHP_EOL;
        $xml .= '        <loc>' . $domain . $page['path'] . '</loc>' . PHP_EOL;
        $xml .= '        <lastmod>' . date('Y-m-d') . '</lastmod>' . PHP_EOL;
        $xml .= '        <changefreq>' . $page['changefreq'] . '</changefreq>' . PHP_EOL;
        $xml .= '        <priority>' . $page['priority'] . '</priority>' . PHP_EOL;
        $xml .= '    </url>' . PHP_EOL;
        $xml .= PHP_EOL;
    }

    // Get all articles
    $articles = [];
    if (is_dir($articlesDir)) {
        $files = glob($articlesDir . '*.json');
        foreach ($files as $file) {
            $content = file_get_contents($file);
            $article = json_decode($content, true);
            if ($article) {
                // Convert date to proper format
                $dateObj = DateTime::createFromFormat('F j, Y', $article['date']);
                if ($dateObj) {
                    $article['formatted_date'] = $dateObj->format('Y-m-d');
                } else {
                    $article['formatted_date'] = date('Y-m-d');
                }
                $articles[] = $article;
            }
        }
    }

    // Sort articles by ID (newest first for priority calculation)
    usort($articles, function($a, $b) {
        return $b['id'] - $a['id'];
    });

    // Add articles to sitemap
    $xml .= '    <!-- Articles -->' . PHP_EOL;
    foreach ($articles as $index => $article) {
        // Calculate priority based on recency (newer articles get higher priority)
        $priority = max(0.4, 0.9 - ($index * 0.01));
        $priority = number_format($priority, 1);

        $xml .= '    <url>' . PHP_EOL;
        // Generate clean URL with slug
        require_once __DIR__ . '/functions.php';
        $slug = generateSlug($article['title']);
        $xml .= '        <loc>' . $domain . '/article/' . $article['id'] . '/' . $slug . '</loc>' . PHP_EOL;
        $xml .= '        <lastmod>' . $article['formatted_date'] . '</lastmod>' . PHP_EOL;
        $xml .= '        <changefreq>monthly</changefreq>' . PHP_EOL;
        $xml .= '        <priority>' . $priority . '</priority>' . PHP_EOL;
        $xml .= '    </url>' . PHP_EOL;

        if ($index < count($articles) - 1) {
            $xml .= PHP_EOL;
        }
    }

    $xml .= '</urlset>';

    // Save sitemap
    $sitemapPath = __DIR__ . '/../sitemap.xml';
    file_put_contents($sitemapPath, $xml);

    return true;
}

// Function to update sitemap after article operations
function updateSitemapAfterArticleChange() {
    generateSitemap();

    // Optionally ping search engines (uncomment when live)
    // pingSearchEngines();
}

// Function to ping search engines about sitemap update
function pingSearchEngines() {
    $sitemapUrl = urlencode('https://dollywoodnews.com/sitemap.xml');

    // Ping Google
    $googlePing = "https://www.google.com/ping?sitemap=" . $sitemapUrl;
    @file_get_contents($googlePing);

    // Ping Bing
    $bingPing = "https://www.bing.com/ping?sitemap=" . $sitemapUrl;
    @file_get_contents($bingPing);
}

// Generate sitemap if called directly
if (basename($_SERVER['PHP_SELF']) == 'sitemap-generator.php') {
    if (generateSitemap()) {
        echo "Sitemap generated successfully!\n";
    } else {
        echo "Error generating sitemap.\n";
    }
}
?>