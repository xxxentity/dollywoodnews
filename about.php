<?php
require_once 'includes/security.php';
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Dollywood News - Your Premier Theme Park News Source</title>
    <meta name="description" content="Learn about Dollywood News, your trusted source for theme park updates, attraction news, and exclusive coverage from Pigeon Forge, Tennessee.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://dollywoodnews.com/about">
    
    <link rel="icon" type="image/png" href="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png">
    <link rel="shortcut icon" type="image/png" href="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png">
    
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5K01EEMBBN"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-5K01EEMBBN');
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --gold: #d4af37;
            --gold-light: #f4d03f;
            --dark: #000000;
            --dark-gray: #1a1a1a;
            --text-light: #ffffff;
            --text-gray: #cccccc;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: var(--text-light);
            background: linear-gradient(135deg, var(--dark) 0%, var(--dark-gray) 50%, var(--dark) 100%);
            min-height: 100vh;
        }
        
        /* Header - Same as index */
        header {
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(20px);
            position: sticky;
            top: 0;
            z-index: 9999;
            border-bottom: 2px solid var(--gold);
            box-shadow: 0 4px 30px rgba(212, 175, 55, 0.3);
            animation: slideDown 0.6s ease;
        }
        
        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            transition: transform 0.3s ease;
        }
        
        .logo-section:hover {
            transform: scale(1.05);
        }
        
        .logo-img {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            border: 2px solid var(--gold);
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.5);
            animation: glow 2s ease-in-out infinite;
        }
        
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(212, 175, 55, 0.5); }
            50% { box-shadow: 0 0 30px rgba(212, 175, 55, 0.8); }
        }
        
        .logo-text h1 {
            color: var(--gold);
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .logo-text .tagline {
            color: var(--text-gray);
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            margin-top: -2px;
        }
        
        nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-link {
            color: var(--text-light);
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.3), transparent);
            transition: left 0.6s ease;
        }
        
        .nav-link:hover::before {
            left: 100%;
        }
        
        .nav-link:hover {
            color: var(--gold);
            transform: translateY(-2px);
        }
        
        .nav-link.active {
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            color: var(--dark);
        }
        
        /* About Hero Section */
        .about-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.8)), 
                        url('https://images.unsplash.com/photo-1544306094-3e8dc1778d4e?ixlib=rb-4.0.3') center/cover;
            padding: 5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .about-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(212, 175, 55, 0.1);
            animation: pulse 3s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 0.1; }
            50% { opacity: 0.2; }
        }
        
        .about-hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.8s ease;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .about-hero h1 {
            font-size: 3rem;
            color: var(--gold);
            margin-bottom: 1rem;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.7);
            animation: slideInFromLeft 0.8s ease;
        }
        
        @keyframes slideInFromLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .about-hero p {
            font-size: 1.3rem;
            color: var(--text-light);
            line-height: 1.8;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        /* About Content */
        .about-content {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 0 2rem;
        }
        
        .about-section {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 15px;
            padding: 3rem;
            margin-bottom: 3rem;
            animation: fadeIn 0.8s ease backwards;
        }
        
        .about-section:nth-child(2) { animation-delay: 0.2s; }
        .about-section:nth-child(3) { animation-delay: 0.4s; }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .about-section h2 {
            color: var(--gold);
            font-size: 2rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            position: relative;
            padding-left: 20px;
        }
        
        .about-section h2::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, var(--gold), var(--gold-light));
        }
        
        .about-section p {
            color: var(--text-gray);
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }
        
        .about-section ul {
            list-style: none;
            padding: 0;
        }
        
        .about-section ul li {
            color: var(--text-gray);
            font-size: 1.1rem;
            padding: 0.8rem 0;
            padding-left: 30px;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .about-section ul li::before {
            content: '✨';
            position: absolute;
            left: 0;
            color: var(--gold);
        }
        
        .about-section ul li:hover {
            color: var(--text-light);
            transform: translateX(5px);
        }
        
        /* Stats Section */
        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }
        
        .stat-card {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), rgba(212, 175, 55, 0.05));
            border: 1px solid var(--gold);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            animation: fadeInScale 0.6s ease backwards;
        }
        
        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }
        
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
        }
        
        .stat-number {
            font-size: 2.5rem;
            color: var(--gold);
            font-weight: bold;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .stat-label {
            color: var(--text-gray);
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        /* Footer */
        footer {
            background: rgba(0, 0, 0, 0.95);
            border-top: 2px solid var(--gold);
            margin-top: 4rem;
            padding: 2rem 0;
            text-align: center;
        }
        
        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        .footer-logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
            border-radius: 50%;
            border: 2px solid var(--gold);
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.5);
        }
        
        .footer-text {
            color: var(--text-gray);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        
        .footer-copyright {
            color: var(--gold);
            font-size: 0.85rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .about-hero h1 {
                font-size: 2rem;
            }
            
            .about-hero p {
                font-size: 1.1rem;
            }
            
            .about-section {
                padding: 2rem 1.5rem;
            }
            
            .stats-section {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <a href="/" class="logo-section">
                <img src="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png" alt="Dollywood News" class="logo-img">
                <div class="logo-text">
                    <h1>Dollywood News</h1>
                    <div class="tagline">Your Source for Dollywood Updates</div>
                </div>
            </a>
            <nav>
                <a href="/" class="nav-link">Home</a>
                <a href="/history" class="nav-link">History</a>
                <a href="/about" class="nav-link active">About</a>
                <a href="/contact" class="nav-link">Contact</a>
            </nav>
        </div>
    </header>

    <!-- About Hero -->
    <section class="about-hero">
        <div class="about-hero-content">
            <h1>About Dollywood News</h1>
            <p>Your trusted source for the latest news, updates, and magical moments from America's most beloved theme park.</p>
        </div>
    </section>

    <!-- About Content -->
    <div class="about-content">
        <!-- Mission Section -->
        <section class="about-section">
            <h2>Our Mission</h2>
            <p>At Dollywood News, we are dedicated to bringing you comprehensive coverage of everything happening at Dollywood Theme Park. From thrilling new attractions to heartwarming stories, seasonal events to behind-the-scenes insights, we're your premier destination for all things Dollywood.</p>
            <p>Founded by passionate theme park enthusiasts, our team works tirelessly to deliver timely, accurate, and engaging content that captures the magic and excitement of this iconic Tennessee destination.</p>
        </section>


        <!-- What We Cover Section -->
        <section class="about-section">
            <h2>What We Cover</h2>
            <ul>
                <li>Breaking news and announcements from Dollywood</li>
                <li>New attraction reveals and construction updates</li>
                <li>Seasonal festival coverage and event highlights</li>
                <li>Exclusive interviews and behind-the-scenes content</li>
                <li>Park tips, tricks, and visitor guides</li>
                <li>Historical features and nostalgic lookbacks</li>
                <li>Dolly Parton's charitable initiatives and appearances</li>
            </ul>
        </section>

        <!-- Why Choose Us Section -->
        <section class="about-section">
            <h2>Why Choose Dollywood News?</h2>
            <p><strong>Timely Updates:</strong> We're always first with breaking news from the park, ensuring you never miss an important announcement or exciting development.</p>
            <p><strong>In-Depth Coverage:</strong> Our articles go beyond surface-level reporting to provide context, analysis, and insider perspectives that enhance your understanding and appreciation of Dollywood.</p>
            <p><strong>Community Focus:</strong> We celebrate not just the park itself, but the vibrant community of fans, employees, and local residents who make Dollywood special.</p>
            <p><strong>Authentic Voice:</strong> Our team's genuine passion for Dollywood shines through in every article, bringing you coverage that's both professional and personal.</p>
        </section>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <img src="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png" alt="Dollywood News" class="footer-logo">
            <p class="footer-text">Your trusted source for all things Dollywood</p>
            <p class="footer-copyright">© 2025 Dollywood News. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Add parallax effect to hero
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.about-hero');
            if (hero) {
                hero.style.backgroundPositionY = `${scrolled * 0.5}px`;
            }
        });

        // Animate stats on scroll
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && entry.target.classList.contains('stat-card')) {
                    const statNumber = entry.target.querySelector('.stat-number');
                    if (statNumber && !statNumber.classList.contains('animated')) {
                        statNumber.classList.add('animated');
                        animateValue(statNumber);
                    }
                }
            });
        }, observerOptions);

        document.querySelectorAll('.stat-card').forEach(card => {
            observer.observe(card);
        });

        function animateValue(element) {
            const text = element.textContent;
            const number = parseInt(text.replace(/\D/g, ''));
            if (!isNaN(number)) {
                const duration = 2000;
                const start = 0;
                const increment = number / (duration / 16);
                let current = start;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= number) {
                        current = number;
                        clearInterval(timer);
                    }
                    element.textContent = text.replace(number, Math.floor(current));
                }, 16);
            }
        }
    </script>
    
    <?php include 'includes/cookie-consent.php'; ?>
</body>
</html>