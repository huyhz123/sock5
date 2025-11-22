/**
 * GSM Ultimate v3.0 - Main JavaScript
 * Features: Multi-language, Multi-currency, UX enhancements, IMEI check
 * Contact: +84386355255 | @hzgsm
 */

(function($) {
    'use strict';

    /**
     * Language Switcher - AJAX Based with Immediate Reload
     */
    function initLanguageSwitcher() {
        $('.lang-btn').on('click', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var lang = $btn.data('lang');

            // Prevent double clicks
            if ($btn.hasClass('active')) {
                return;
            }

            // Set cookie immediately
            document.cookie = 'gsm_language=' + lang + '; path=/; max-age=31536000; SameSite=Lax';

            // Show loading state
            $btn.prop('disabled', true);
            $('.lang-btn').removeClass('active');
            $btn.addClass('active');
            $btn.html('<i class="fas fa-spinner fa-spin"></i>');

            // AJAX request to set language
            $.ajax({
                url: gsmData.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'gsm_set_language',
                    nonce: gsmData.nonce,
                    language: lang
                },
                success: function(response) {
                    // Reload page immediately
                    location.reload(true);
                },
                error: function() {
                    // Even on error, reload to apply cookie
                    location.reload(true);
                }
            });
        });
    }

    /**
     * Currency Switcher - AJAX Based with Immediate Reload
     */
    function initCurrencySwitcher() {
        $('.currency-btn').on('click', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var currency = $btn.data('currency');

            // Prevent double clicks
            if ($btn.hasClass('active')) {
                return;
            }

            // Set cookie immediately
            document.cookie = 'gsm_currency=' + currency + '; path=/; max-age=31536000; SameSite=Lax';

            // Show loading state
            $btn.prop('disabled', true);
            $('.currency-btn').removeClass('active');
            $btn.addClass('active');
            $btn.html('<i class="fas fa-spinner fa-spin"></i>');

            // AJAX request to set currency
            $.ajax({
                url: gsmData.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'gsm_set_currency',
                    nonce: gsmData.nonce,
                    currency: currency
                },
                success: function(response) {
                    // Reload page immediately
                    location.reload(true);
                },
                error: function() {
                    // Even on error, reload to apply cookie
                    location.reload(true);
                }
            });
        });
    }

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        $('.mobile-menu-toggle').on('click', function(e) {
            e.stopPropagation();
            $('.nav-menu').toggleClass('active');
            var $icon = $(this).find('i');
            $icon.toggleClass('fa-bars fa-times');
        });

        // Close menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.header-main').length) {
                $('.nav-menu').removeClass('active');
                $('.mobile-menu-toggle i').removeClass('fa-times').addClass('fa-bars');
            }
        });

        // Close menu when clicking a link
        $('.nav-menu a').on('click', function() {
            if ($(window).width() <= 768) {
                $('.nav-menu').removeClass('active');
                $('.mobile-menu-toggle i').removeClass('fa-times').addClass('fa-bars');
            }
        });
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').on('click', function(e) {
            var target = $(this.hash);

            if (target.length && this.pathname === location.pathname) {
                e.preventDefault();

                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 800, 'swing');
            }
        });
    }

    /**
     * Product Card Animations
     */
    function initProductCards() {
        $('.product-card, .blog-card').hover(
            function() {
                $(this).css('transform', 'translateY(-8px)');
            },
            function() {
                $(this).css('transform', 'translateY(0)');
            }
        );
    }

    /**
     * Floating Buttons Animation
     */
    function initFloatingButtons() {
        $('.floating-btn').each(function(index) {
            $(this).css({
                'animation-delay': (index * 0.1) + 's'
            });
        });
    }

    /**
     * Product Filters - WooCommerce Categories & Custom Post Types
     */
    function initProductFilters() {
        $('.filter-btn').on('click', function(e) {
            e.preventDefault();

            var filter = $(this).data('filter');
            var category = $(this).data('category');

            // Update active state
            $('.filter-btn').removeClass('active');
            $(this).addClass('active');

            // Filter products - supports both data-filter and data-category
            if (filter === 'all' || category === '*') {
                $('.product-card').fadeIn(300);
            } else if (category) {
                // WooCommerce category filtering (class-based)
                $('.product-card').hide();
                if (category === '*') {
                    $('.product-card').fadeIn(300);
                } else {
                    $('.product-card' + category).fadeIn(300);
                }
            } else if (filter) {
                // Custom post type filtering (data-category attribute)
                $('.product-card').hide();
                $('.product-card[data-category="' + filter + '"]').fadeIn(300);
            }
        });
    }

    /**
     * Back to Top Button
     */
    function initBackToTop() {
        // Create button if doesn't exist
        if ($('.back-to-top').length === 0) {
            $('body').append('<button class="back-to-top" style="display: none;" aria-label="Back to top"><i class="fas fa-arrow-up"></i></button>');
        }

        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                $('.back-to-top').fadeIn();
            } else {
                $('.back-to-top').fadeOut();
            }
        });

        $(document).on('click', '.back-to-top', function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });
    }

    /**
     * Form Validation
     */
    function initFormValidation() {
        $('form').on('submit', function(e) {
            var isValid = true;
            var $form = $(this);

            $form.find('[required]').each(function() {
                var $field = $(this);
                if (!$field.val() || $field.val().trim() === '') {
                    isValid = false;
                    $field.css('border-color', '#f44336');
                } else {
                    $field.css('border-color', '');
                }
            });

            if (!isValid) {
                e.preventDefault();

                var messages = {
                    'en': 'Please fill in all required fields!',
                    'vi': 'Vui lòng điền đầy đủ thông tin!',
                    'zh': '请填写所有必填字段！'
                };
                var lang = gsmData.language || 'vi';
                alert(messages[lang] || messages['vi']);
            }
        });

        // Remove error styling on input
        $('input, textarea, select').on('input change', function() {
            $(this).css('border-color', '');
        });
    }

    /**
     * Image Lazy Loading (native)
     */
    function initLazyLoading() {
        if ('loading' in HTMLImageElement.prototype) {
            $('img').attr('loading', 'lazy');
        }
    }

    /**
     * Click Tracking for Analytics
     */
    function initClickTracking() {
        // Track contact clicks
        $('a[href^="tel:"], a[href*="wa.me"], a[href*="zalo.me"], a[href*="t.me"]').on('click', function() {
            var type = 'unknown';
            var href = $(this).attr('href');

            if (href.indexOf('tel:') === 0) type = 'phone';
            else if (href.indexOf('wa.me') !== -1) type = 'whatsapp';
            else if (href.indexOf('zalo.me') !== -1) type = 'zalo';
            else if (href.indexOf('t.me') !== -1) type = 'telegram';

            console.log('Contact click:', type, href);

            // Google Analytics tracking (if available)
            if (typeof gtag !== 'undefined') {
                gtag('event', 'contact_click', {
                    'event_category': 'Contact',
                    'event_label': type
                });
            }
        });

        // Track product/blog clicks
        $('.product-card a, .blog-card a').on('click', function() {
            var title = $(this).closest('.product-card, .blog-card').find('.product-title, .blog-title').text();
            console.log('Content click:', title.trim());
        });

        // Track "Buy Now" clicks
        $('.btn-primary').on('click', function() {
            var context = $(this).closest('.product-card, .hero-banner').length > 0;
            console.log('CTA click:', $(this).text().trim(), context);
        });
    }

    /**
     * Scroll Reveal Animations
     */
    function initScrollAnimations() {
        function revealOnScroll() {
            $('.scroll-reveal').each(function() {
                var elementTop = $(this).offset().top;
                var elementBottom = elementTop + $(this).outerHeight();
                var viewportTop = $(window).scrollTop();
                var viewportBottom = viewportTop + $(window).height();

                if (elementBottom > viewportTop && elementTop < viewportBottom) {
                    $(this).addClass('revealed');
                }
            });
        }

        // Add scroll-reveal class to elements
        $('.product-card, .blog-card').addClass('scroll-reveal');

        // Initial check
        revealOnScroll();

        // Check on scroll
        $(window).on('scroll', revealOnScroll);
    }

    /**
     * Particles.js Initialization for Hero Banner
     */
    function initParticles() {
        if (typeof particlesJS !== 'undefined' && $('#particles-js').length) {
            particlesJS('particles-js', {
                particles: {
                    number: {
                        value: 80,
                        density: {
                            enable: true,
                            value_area: 800
                        }
                    },
                    color: {
                        value: '#ff9800'
                    },
                    shape: {
                        type: 'circle'
                    },
                    opacity: {
                        value: 0.5,
                        random: false
                    },
                    size: {
                        value: 3,
                        random: true
                    },
                    line_linked: {
                        enable: true,
                        distance: 150,
                        color: '#ff9800',
                        opacity: 0.4,
                        width: 1
                    },
                    move: {
                        enable: true,
                        speed: 2,
                        direction: 'none',
                        random: false,
                        straight: false,
                        out_mode: 'out',
                        bounce: false
                    }
                },
                interactivity: {
                    detect_on: 'canvas',
                    events: {
                        onhover: {
                            enable: true,
                            mode: 'grab'
                        },
                        onclick: {
                            enable: true,
                            mode: 'push'
                        },
                        resize: true
                    },
                    modes: {
                        grab: {
                            distance: 140,
                            line_linked: {
                                opacity: 1
                            }
                        },
                        push: {
                            particles_nb: 4
                        }
                    }
                },
                retina_detect: true
            });
        }
    }

    /**
     * Copy to Clipboard Functionality
     */
    function initCopyToClipboard() {
        $('.copy-text').on('click', function() {
            var text = $(this).data('copy') || $(this).text();
            var $this = $(this);

            // Create temporary input
            var $temp = $('<input>');
            $('body').append($temp);
            $temp.val(text).select();

            try {
                document.execCommand('copy');

                // Show success feedback
                var originalText = $this.html();
                var messages = {
                    'en': 'Copied!',
                    'vi': 'Đã sao chép!',
                    'zh': '已复制！'
                };
                var lang = gsmData.language || 'vi';

                $this.html('<i class="fas fa-check"></i> ' + messages[lang]);

                setTimeout(function() {
                    $this.html(originalText);
                }, 2000);
            } catch (err) {
                console.error('Failed to copy');
            }

            $temp.remove();
        });
    }

    /**
     * IMEI Checker Form
     */
    function initIMEIChecker() {
        $('#imei-check-form').on('submit', function(e) {
            e.preventDefault();

            var $form = $(this);
            var $btn = $form.find('button[type="submit"]');
            var $result = $('#imei-result');
            var imei = $form.find('input[name="imei"]').val();
            var provider = $form.find('select[name="provider"]').val();

            // Validate IMEI
            if (!imei || imei.length < 15) {
                alert('Please enter a valid IMEI (15 digits)');
                return;
            }

            // Show loading
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Checking...');
            $result.html('').hide();

            // AJAX request
            $.ajax({
                url: gsmData.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'gsm_check_imei',
                    nonce: gsmData.nonce,
                    imei: imei,
                    provider: provider
                },
                success: function(response) {
                    $btn.prop('disabled', false).html('Check IMEI');

                    if (response.success) {
                        $result.html('<div class="alert alert-success">' + JSON.stringify(response.data, null, 2) + '</div>').fadeIn();
                    } else {
                        $result.html('<div class="alert alert-danger">' + (response.data.message || 'Error checking IMEI') + '</div>').fadeIn();
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).html('Check IMEI');
                    $result.html('<div class="alert alert-danger">Connection error. Please try again.</div>').fadeIn();
                }
            });
        });
    }

    /**
     * Active Menu Item Highlight
     */
    function initActiveMenuHighlight() {
        var currentPath = window.location.pathname;
        $('.nav-menu a').each(function() {
            var linkPath = $(this).attr('href');
            if (linkPath && currentPath.indexOf(linkPath) !== -1 && linkPath !== '/') {
                $(this).addClass('active');
            }
        });

        // Home page special case
        if (currentPath === '/' || currentPath === '') {
            $('.nav-menu a[href="/"]').addClass('active');
        }
    }

    /**
     * Window Resize Handler
     */
    function handleResize() {
        if ($(window).width() > 768) {
            $('.nav-menu').removeClass('active');
            $('.mobile-menu-toggle i').removeClass('fa-times').addClass('fa-bars');
        }
    }

    /**
     * Initialize All Functions
     */
    $(document).ready(function() {
        // Core functionality
        initLanguageSwitcher();
        initCurrencySwitcher();
        initMobileMenu();
        initSmoothScroll();
        initActiveMenuHighlight();

        // UI enhancements
        initProductCards();
        initFloatingButtons();
        initProductFilters();
        initBackToTop();

        // Form handling
        initFormValidation();
        initIMEIChecker();
        initCopyToClipboard();

        // Analytics & performance
        initLazyLoading();
        initClickTracking();
        initScrollAnimations();

        // Effects
        initParticles();

        // Console branding
        console.log('%c GSM Ultimate v3.0 ', 'background: #ff9800; color: #000; font-weight: bold; padding: 10px; font-size: 16px;');
        console.log('%c Multi-language & Multi-currency enabled ', 'color: #ff9800; font-weight: bold; font-size: 14px;');
        console.log('%c Contact: +84386355255 | @hzgsm ', 'color: #ff9800; font-size: 12px;');
    });

    /**
     * Window Events
     */
    $(window).on('resize', handleResize);

    $(window).on('load', function() {
        // Trigger scroll animations on page load
        $(window).trigger('scroll');
    });

})(jQuery);
