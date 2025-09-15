<?php
// Inline sitemap generator
$domain = 'https://dollywoodnews.com';
$articlesDir = __DIR__ . '/articles/';

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
    ['path' => '/about.php', 'changefreq' => 'monthly', 'priority' => '0.8'],
    ['path' => '/contact.php', 'changefreq' => 'monthly', 'priority' => '0.7'],
    ['path' => '/privacy.php', 'changefreq' => 'yearly', 'priority' => '0.5'],
    ['path' => '/terms.php', 'changefreq' => 'yearly', 'priority' => '0.5'],
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
            // Parse date - handle various formats
            $dateStr = $article['date'];
            // Try different date formats
            $dateObj = DateTime::createFromFormat('F j, Y', $dateStr);
            if (!$dateObj) {
                $dateObj = DateTime::createFromFormat('F d, Y', $dateStr);
            }
            if (!$dateObj) {
                $dateObj = new DateTime($dateStr);
            }

            if ($dateObj) {
                $article['formatted_date'] = $dateObj->format('Y-m-d');
            } else {
                $article['formatted_date'] = date('Y-m-d');
            }
            $articles[] = $article;
        }
    }
}

// Sort articles by ID (newest first)
usort($articles, function($a, $b) {
    return $b['id'] - $a['id'];
});

// Add articles to sitemap
$xml .= '    <!-- Articles (Total: ' . count($articles) . ') -->' . PHP_EOL;
foreach ($articles as $index => $article) {
    // Calculate priority based on recency
    $priority = max(0.4, 0.9 - ($index * 0.01));
    $priority = number_format($priority, 1);

    $xml .= '    <url>' . PHP_EOL;
    // Generate clean URL with slug
    function generateSlug($title) {
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');
        if (strlen($slug) > 60) {
            $slug = substr($slug, 0, 60);
            $slug = rtrim($slug, '-');
        }
        return $slug;
    }

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
file_put_contents(__DIR__ . '/sitemap.xml', $xml);

echo "Sitemap generated with " . count($articles) . " articles!\n";
?>