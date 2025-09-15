<?php
/**
 * Script to manually update the sitemap
 * Run this to regenerate sitemap.xml with all current articles
 */

require_once 'includes/sitemap-generator.php';

echo "Generating sitemap...\n";

if (generateSitemap()) {
    echo "✅ Sitemap generated successfully!\n";
    echo "📍 Location: sitemap.xml\n";

    // Count articles
    $articlesDir = __DIR__ . '/articles/';
    $articleCount = count(glob($articlesDir . '*.json'));

    echo "📝 Total articles indexed: " . $articleCount . "\n";
    echo "🔗 Sitemap URL: https://dollywoodnews.com/sitemap.xml\n";
} else {
    echo "❌ Error generating sitemap.\n";
}
?>