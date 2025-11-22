/**
 * GSM Pro Ultimate - Main JavaScript
 * Features: Multi-language, Multi-currency, UX enhancements
 * Contact: +84386355255 | @hzgsm
 */

(function($) {
    'use strict';

    /**
     * Language Switcher
     */
    function initLanguageSwitcher() {
        $('.lang-btn').on('click', function() {
            var lang = $(this).data('lang');

            // Set cookie and reload
            document.cookie = 'gsm_language=' + lang + '; path=/; max-age=31536000';

            // Update active state
            $('.lang-btn').removeClass('active');
            $(this).addClass('active');

            // Reload page to apply language
            setTimeout(function() {
                location.reload();
            }, 200);
        });
    }

    /**
     * Currency Switcher
     */
    function initCurrencySwitcher() {
        $('.currency-btn').on('click', function() {
            var currency = $(this).data('currency');

            // Set cookie and reload
            document.cookie = 'gsm_currency=' + currency + '; path=/; max-age=31536000';

            // Update active state
            $('.currency-btn').removeClass('active');
            $(this).addClass('active');

            // Reload page to apply currency
            setTimeout(function() {
                location.reload();
            }, 200);
        });
    }

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        $('.mobile-menu-toggle').on('click', function() {
            $('.nav-menu').toggleClass('active');
            $(this).find('i').toggleClass('fa-bars fa-times');
        });

        // Close menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.main-navigation').length) {
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
     * Smooth Scroll
     */
    function initSmoothScroll() {
        $('a[href*="#"]').on('click', function(e) {
            var target = $(this.hash);
            if (target.length && this.pathname === location.pathname) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 800);
            }
        });
    }

    /**
     * Product Card Hover Effects
     */
    function initProductCards() {
        $('.product-card, .blog-card').hover(
            function() {
                $(this).css('transform', 'translateY(-2px)');
            },
            function() {
                $(this).css('transform', 'translateY(0)');
            }
        );
    }

    /**
     * Floating Contact Buttons Animation
     */
    function initFloatingButtons() {
        $('.floating-btn').each(function(index) {
            $(this).css({
                'animation': 'slideInRight 0.5s ease-out ' + (index * 0.1) + 's both'
            });
        });
    }

    /**
     * Product Filters
     */
    function initProductFilters() {
        $('.filter-btn').on('click', function(e) {
            if ($(this).data('filter') === 'all') {
                e.preventDefault();

                // Remove active from all
                $('.filter-btn').removeClass('active');
                $(this).addClass('active');

                // Show all products
                $('.product-card').fadeIn(300);
            }
        });
    }

    /**
     * Back to Top Button
     */
    function initBackToTop() {
        // Create button if doesn't exist
        if ($('.back-to-top').length === 0) {
            $('body').append('<button class="back-to-top" style="display: none;"><i class="fas fa-arrow-up"></i></button>');
        }

        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                $('.back-to-top').fadeIn();
            } else {
                $('.back-to-top').fadeOut();
            }
        });

        $(document).on('click', '.back-to-top', function() {
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
            $(this).find('[required]').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).css('border-color', '#f44336');
                } else {
                    $(this).css('border-color', '');
                }
            });

            if (!isValid) {
                e.preventDefault();
                var lang = gsmData.language || 'vi';
                var messages = {
                    'en': 'Please fill in all required fields!',
                    'vi': 'Vui lòng điền đầy đủ thông tin!',
                    'zh': '请填写所有必填字段！'
                };
                alert(messages[lang] || messages['vi']);
            }
        });

        // Remove error on input
        $('input, textarea, select').on('input change', function() {
            $(this).css('border-color', '');
        });
    }

    /**
     * Image Lazy Loading
     */
    function initLazyLoading() {
        if ('loading' in HTMLImageElement.prototype) {
            $('img').attr('loading', 'lazy');
        }
    }

    /**
     * Click Tracking
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

            // Add your analytics tracking here
            if (typeof gtag !== 'undefined') {
                gtag('event', 'contact_click', {
                    'event_category': 'Contact',
                    'event_label': type
                });
            }
        });

        // Track product clicks
        $('.product-card a, .blog-card a').on('click', function() {
            var title = $(this).closest('.product-card, .blog-card').find('.product-title, .blog-title').text();
            console.log('Content click:', title);
        });
    }

    /**
     * Scroll Animations
     */
    function initScrollAnimations() {
        $(window).on('scroll', function() {
            $('.product-card, .blog-card').each(function() {
                var elementTop = $(this).offset().top;
                var windowBottom = $(window).scrollTop() + $(window).height();

                if (elementTop < windowBottom - 100) {
                    $(this).css({
                        'opacity': '1',
                        'transform': 'translateY(0)'
                    });
                }
            });
        });

        // Initial state
        $('.product-card, .blog-card').css({
            'opacity': '0',
            'transform': 'translateY(30px)',
            'transition': 'all 0.6s ease-out'
        });
    }

    /**
     * Copy to Clipboard
     */
    function initCopyToClipboard() {
        $('.copy-text').on('click', function() {
            var text = $(this).data('copy') || $(this).text();
            var $temp = $('<input>');
            $('body').append($temp);
            $temp.val(text).select();
            document.execCommand('copy');
            $temp.remove();

            // Show feedback
            var $this = $(this);
            var originalText = $this.html();
            var lang = gsmData.language || 'vi';
            var messages = {
                'en': 'Copied!',
                'vi': 'Đã copy!',
                'zh': '已复制！'
            };

            $this.html('<i class="fas fa-check"></i> ' + messages[lang]);
            setTimeout(function() {
                $this.html(originalText);
            }, 2000);
        });
    }

    /**
     * Initialize All Functions
     */
    $(document).ready(function() {
        initLanguageSwitcher();
        initCurrencySwitcher();
        initMobileMenu();
        initSmoothScroll();
        initProductCards();
        initFloatingButtons();
        initProductFilters();
        initBackToTop();
        initFormValidation();
        initLazyLoading();
        initClickTracking();
        initScrollAnimations();
        initCopyToClipboard();

        console.log('%c GSM Pro Ultimate v2.0 ', 'background: #ff9800; color: #000; font-weight: bold; padding: 10px;');
        console.log('%c Multi-language & Multi-currency enabled ', 'color: #ff9800; font-weight: bold;');
        console.log('%c Contact: +84386355255 | @hzgsm ', 'color: #ff9800;');
    });

    /**
     * Window Resize Handler
     */
    $(window).on('resize', function() {
        if ($(window).width() > 768) {
            $('.nav-menu').removeClass('active');
            $('.mobile-menu-toggle i').removeClass('fa-times').addClass('fa-bars');
        }
    });

    /**
     * Add CSS Animations
     */
    var style = document.createElement('style');
    style.innerHTML = `
        @keyframes slideInRight {
            from {
                transform: translateX(100px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .back-to-top {
            position: fixed;
            bottom: 90px;
            right: 20px;
            z-index: 998;
            width: 50px;
            height: 50px;
            background: var(--gradient-primary, linear-gradient(135deg, #ff9800 0%, #f57c00 100%));
            border: none;
            color: #000;
            font-size: 20px;
            cursor: pointer;
            transition: var(--transition, all 0.3s ease);
        }

        .back-to-top:hover {
            transform: translateY(-5px);
        }

        @media (max-width: 768px) {
            .back-to-top {
                bottom: 80px;
                right: 10px;
                width: 45px;
                height: 45px;
                font-size: 18px;
            }
        }
    `;
    document.head.appendChild(style);

})(jQuery);
