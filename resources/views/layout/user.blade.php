<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text-primary: #2d3748;
            --text-secondary: #718096;
            --shadow-soft: 0 20px 40px rgba(0, 0, 0, 0.1);
            --shadow-glass: 0 8px 32px rgba(31, 38, 135, 0.37);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.3) 0%, transparent 50%);
            z-index: -1;
            animation: backgroundShift 20s ease-in-out infinite;
        }

        @keyframes backgroundShift {

            0%,
            100% {
                opacity: 0.3;
            }

            50% {
                opacity: 0.6;
            }
        }

        main {
            flex: 1;
            position: relative;
            z-index: 1;
        }

        /* Modern Navbar */
        .navbar-modern {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            transition: all 0.3s ease;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .navbar-modern.scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            padding: 0.5rem 0;
        }

        .navbar-brand-modern {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.8rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            position: relative;
            transition: all 0.3s ease;
        }

        .navbar-brand-modern::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 3px;
            background: var(--primary-gradient);
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .navbar-brand-modern:hover::after {
            width: 100%;
        }

        .navbar-nav-modern .nav-link {
            color: var(--text-primary) !important;
            font-weight: 500;
            padding: 0.75rem 1.25rem !important;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            margin: 0 0.25rem;
        }

        .navbar-nav-modern .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--glass-bg);
            border-radius: 12px;
            opacity: 0;
            transition: all 0.3s ease;
            z-index: -1;
        }

        .navbar-nav-modern .nav-link:hover {
            color: #667eea !important;
            transform: translateY(-2px);
        }

        .navbar-nav-modern .nav-link:hover::before {
            opacity: 1;
            backdrop-filter: blur(10px);
        }

        .navbar-nav-modern .nav-link.active {
            background: var(--primary-gradient);
            color: white !important;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid transparent;
            background: var(--primary-gradient);
            padding: 2px;
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Mobile Menu Toggle */
        .navbar-toggler-modern {
            border: none;
            padding: 0.5rem;
            border-radius: 8px;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .navbar-toggler-modern:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: scale(1.05);
        }

        .navbar-toggler-modern .navbar-toggler-icon {
            background-image: none;
            width: 24px;
            height: 24px;
            position: relative;
        }

        .navbar-toggler-modern .navbar-toggler-icon::before,
        .navbar-toggler-modern .navbar-toggler-icon::after,
        .navbar-toggler-modern .navbar-toggler-icon {
            background: var(--text-primary);
            height: 2px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        /* Modern Footer */
        .footer-modern {
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
            color: white;
            position: relative;
            overflow: hidden;
            margin-top: auto;
        }

        .footer-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 20%, rgba(102, 126, 234, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(118, 75, 162, 0.1) 0%, transparent 50%);
            z-index: 0;
        }

        .footer-content {
            position: relative;
            z-index: 1;
            padding: 4rem 0 2rem;
        }

        .footer-section {
            margin-bottom: 2rem;
        }

        .footer-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #f093fb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            padding: 0.5rem 0;
            position: relative;
        }

        .footer-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-gradient);
            transition: width 0.3s ease;
        }

        .footer-link:hover {
            color: white;
            transform: translateX(5px);
        }

        .footer-link:hover::after {
            width: 100%;
        }

        .social-icons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .social-icon:hover {
            background: var(--primary-gradient);
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem 0 1rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
            position: relative;
            z-index: 1;
        }

        .footer-wave {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z' fill='%23f8fafc'%3E%3C/path%3E%3C/svg%3E") no-repeat;
            background-size: cover;
            z-index: 1;
        }

        /* Newsletter Section */
        .newsletter-section {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 2rem;
        }

        .newsletter-input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            padding: 0.75rem 1rem;
            backdrop-filter: blur(10px);
        }

        .newsletter-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .newsletter-input:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
            outline: none;
            color: white;
        }

        .btn-newsletter {
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-newsletter:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar-brand-modern {
                font-size: 1.5rem;
            }

            .footer-content {
                padding: 2rem 0 1rem;
            }

            .social-icons {
                justify-content: center;
            }

            .newsletter-section {
                padding: 1.5rem;
            }
        }

        /* Scroll Animations */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Loading Animation */
        .loading-dots {
            display: inline-block;
        }

        .loading-dots::after {
            content: '';
            animation: dots 2s infinite;
        }

        @keyframes dots {

            0%,
            20% {
                content: '';
            }

            40% {
                content: '.';
            }

            60% {
                content: '..';
            }

            80%,
            100% {
                content: '...';
            }
        }
    </style>
    @yield('styles')
</head>

<body>

    <!-- Modern Navbar -->
    <nav class="navbar navbar-expand-lg navbar-modern" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand navbar-brand-modern" href="{{ route('home') }}">
                <i class="fas fa-blog me-2"></i>MyBlog
            </a>

            <button class="navbar-toggler navbar-toggler-modern" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav navbar-nav-modern ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="fas fa-home me-2"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('postcreate-show') }}" class="nav-link">
                            <i class="fas fa-plus-circle me-2"></i>Create Post
                        </a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login.index') }}" class="nav-link">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar me-2">
                                    @if (Auth::user()->image)
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="User Avatar">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center h-100"
                                            style="background: var(--primary-gradient); border-radius: 50%;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                    @endif
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.show', Auth::user()->id) }}">
                                        <i class="fas fa-user me-2"></i>Profile
                                    </a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('user.logout') }}">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </a></li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Section -->
    <main>
        @yield('container')
    </main>

    <!-- Modern Footer -->
    <footer class="footer-modern">
        <div class="footer-wave"></div>
        <div class="footer-content">
            <div class="container">
                <div class="row">
                    <!-- About Section -->
                    <div class="col-lg-4 col-md-6 footer-section fade-in-up">
                        <h5 class="footer-title">
                            <i class="fas fa-blog me-2"></i>MyBlog
                        </h5>
                        <p class="mb-4" style="color: rgba(255, 255, 255, 0.8); line-height: 1.6;">
                            Your creative space to share stories, connect with readers, and build a community around
                            your passion for writing.
                        </p>
                        <div class="social-icons">
                            <a href="#" class="social-icon" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-icon" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-icon" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-icon" title="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="social-icon" title="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-lg-2 col-md-6 footer-section fade-in-up">
                        <h5 class="footer-title">Quick Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('home') }}" class="footer-link">
                                    <i class="fas fa-home me-2"></i>Home
                                </a></li>
                            <li><a href="{{ route('postcreate-show') }}" class="footer-link">
                                    <i class="fas fa-plus me-2"></i>Create Post
                                </a></li>
                            <li><a href="#" class="footer-link">
                                    <i class="fas fa-search me-2"></i>Browse Posts
                                </a></li>
                            <li><a href="#" class="footer-link">
                                    <i class="fas fa-users me-2"></i>Community
                                </a></li>
                        </ul>
                    </div>

                    <!-- Support -->
                    <div class="col-lg-2 col-md-6 footer-section fade-in-up">
                        <h5 class="footer-title">Support</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="footer-link">
                                    <i class="fas fa-question-circle me-2"></i>Help Center
                                </a></li>
                            <li><a href="#" class="footer-link">
                                    <i class="fas fa-envelope me-2"></i>Contact Us
                                </a></li>
                            <li><a href="#" class="footer-link">
                                    <i class="fas fa-shield-alt me-2"></i>Privacy Policy
                                </a></li>
                            <li><a href="#" class="footer-link">
                                    <i class="fas fa-file-contract me-2"></i>Terms of Service
                                </a></li>
                        </ul>
                    </div>

                    <!-- Newsletter -->
                    <div class="col-lg-4 col-md-6 footer-section fade-in-up">
                        <h5 class="footer-title">Stay Updated</h5>
                        <p style="color: rgba(255, 255, 255, 0.8); margin-bottom: 1.5rem;">
                            Subscribe to our newsletter for the latest posts and updates.
                        </p>
                        <div class="newsletter-section">
                            <form class="d-flex flex-column gap-3" id="newsletterForm">
                                <input type="email" class="form-control newsletter-input"
                                    placeholder="Enter your email address" required>
                                <button type="submit" class="btn btn-newsletter">
                                    <i class="fas fa-paper-plane me-2"></i>Subscribe
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">
                            &copy; 2025 MyBlog. All rights reserved. Made with
                            <i class="fas fa-heart text-danger mx-1"></i>
                            for writers everywhere.
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-0">
                            <a href="#" class="footer-link me-3">Privacy</a>
                            <a href="#" class="footer-link me-3">Terms</a>
                            <a href="#" class="footer-link">Cookies</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Fade In Animation on Scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in-up').forEach(el => {
            observer.observe(el);
        });

        // Newsletter Form
        document.getElementById('newsletterForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const button = this.querySelector('button');
            const originalText = button.innerHTML;

            button.innerHTML =
                '<i class="fas fa-spinner fa-spin me-2"></i>Subscribing<span class="loading-dots"></span>';
            button.disabled = true;

            setTimeout(() => {
                button.innerHTML = '<i class="fas fa-check me-2"></i>Subscribed!';
                button.style.background = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';

                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.disabled = false;
                    button.style.background = '';
                    this.reset();
                }, 2000);
            }, 1500);
        });

        // Active Navigation Link
        const currentLocation = location.pathname;
        const navLinks = document.querySelectorAll('.navbar-nav-modern .nav-link');

        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentLocation) {
                link.classList.add('active');
            }
        });

        // Smooth Scrolling for Anchor Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Social Icon Hover Effects
        document.querySelectorAll('.social-icon').forEach(icon => {
            icon.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.1) rotate(5deg)';
            });

            icon.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1) rotate(0deg)';
            });
        });

        // Navbar Brand Animation
        const navbarBrand = document.querySelector('.navbar-brand-modern');
        navbarBrand.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });

        navbarBrand.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    </script>

    @yield('scripts')
</body>

</html>
