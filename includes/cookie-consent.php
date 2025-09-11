<div id="cookie-consent" style="position: fixed; bottom: 0; left: 0; right: 0; background: #000; color: #fff; padding: 20px; text-align: center; z-index: 9999; display: none; border-top: 2px solid #d4af37;">
    <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
        <p style="margin: 0; flex: 1;">
            We use cookies to enhance your experience and serve personalized ads. By continuing to use this site, you agree to our 
            <a href="/privacy.php" style="color: #d4af37;">Privacy Policy</a> and cookie usage.
        </p>
        <div style="display: flex; gap: 10px;">
            <button onclick="acceptCookies()" style="background: #d4af37; color: #000; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold;">Accept</button>
            <button onclick="rejectCookies()" style="background: transparent; color: #d4af37; border: 1px solid #d4af37; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Reject</button>
        </div>
    </div>
</div>

<script>
// Check if user has already made a choice
if (!localStorage.getItem('cookieConsent')) {
    document.getElementById('cookie-consent').style.display = 'block';
}

function acceptCookies() {
    localStorage.setItem('cookieConsent', 'accepted');
    document.getElementById('cookie-consent').style.display = 'none';
    // Enable Google Analytics and AdSense here
    loadGoogleAdsense();
}

function rejectCookies() {
    localStorage.setItem('cookieConsent', 'rejected');
    document.getElementById('cookie-consent').style.display = 'none';
    disableGoogleAnalytics();
}

function loadGoogleAdsense() {
    // Initialize Google Analytics tracking
    if (typeof gtag !== 'undefined') {
        gtag('consent', 'update', {
            'analytics_storage': 'granted'
        });
    }
    // Add your Google AdSense initialization code here when you get approved
}

function disableGoogleAnalytics() {
    // Disable Google Analytics
    if (typeof gtag !== 'undefined') {
        gtag('consent', 'update', {
            'analytics_storage': 'denied'
        });
    }
}

// Check consent on page load
if (localStorage.getItem('cookieConsent') === 'accepted') {
    loadGoogleAdsense();
} else if (localStorage.getItem('cookieConsent') === 'rejected') {
    disableGoogleAnalytics();
}
</script>