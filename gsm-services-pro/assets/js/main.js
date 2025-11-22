/**
 * GSM Services Pro - Main JavaScript
 * Contact: +84386355255 | Telegram: @hzgsm
 */

(function($) {
    'use strict';

    // Mobile Menu Toggle
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

    // Smooth Scroll
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

    // Sticky Header
    function initStickyHeader() {
        var header = $('.site-header');
        var headerOffset = header.offset().top;

        $(window).on('scroll', function() {
            if ($(window).scrollTop() > headerOffset) {
                header.addClass('sticky');
            } else {
                header.removeClass('sticky');
            }
        });
    }

    // Service Card Hover Effect
    function initServiceCards() {
        $('.service-card, .blog-card').on('mouseenter', function() {
            $(this).css('transform', 'translateY(-5px)');
        }).on('mouseleave', function() {
            $(this).css('transform', 'translateY(0)');
        });
    }

    // Floating Contact Buttons Animation
    function initFloatingButtons() {
        $('.floating-btn').each(function(index) {
            $(this).css({
                'animation': 'slideInRight 0.5s ease-out ' + (index * 0.1) + 's both'
            });
        });

        // Add pulse effect to phone button
        setInterval(function() {
            $('.floating-btn.phone').addClass('pulse-effect');
            setTimeout(function() {
                $('.floating-btn.phone').removeClass('pulse-effect');
            }, 1000);
        }, 3000);
    }

    // Click to Call Tracking
    function initCallTracking() {
        $('a[href^="tel:"]').on('click', function() {
            var phone = $(this).attr('href').replace('tel:', '');
            console.log('Call initiated:', phone);
            // Add analytics tracking here if needed
        });
    }

    // WhatsApp Click Tracking
    function initWhatsAppTracking() {
        $('a[href*="wa.me"]').on('click', function() {
            console.log('WhatsApp chat initiated');
            // Add analytics tracking here if needed
        });
    }

    // Telegram Click Tracking
    function initTelegramTracking() {
        $('a[href*="t.me"]').on('click', function() {
            console.log('Telegram chat initiated');
            // Add analytics tracking here if needed
        });
    }

    // Zalo Click Tracking
    function initZaloTracking() {
        $('a[href*="zalo.me"]').on('click', function() {
            console.log('Zalo chat initiated');
            // Add analytics tracking here if needed
        });
    }

    // Add loading state to buttons
    function initButtonLoading() {
        $('.btn').on('click', function(e) {
            var $btn = $(this);
            if (!$btn.hasClass('no-loading') && $btn.attr('type') === 'submit') {
                $btn.addClass('loading');
                $btn.prop('disabled', true);

                // Remove loading state after 2 seconds (for demo)
                setTimeout(function() {
                    $btn.removeClass('loading');
                    $btn.prop('disabled', false);
                }, 2000);
            }
        });
    }

    // Image Lazy Loading
    function initLazyLoading() {
        if ('loading' in HTMLImageElement.prototype) {
            $('img').attr('loading', 'lazy');
        }
    }

    // Copy to Clipboard
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
            $this.html('<i class="fas fa-check"></i> Đã copy!');
            setTimeout(function() {
                $this.html(originalText);
            }, 2000);
        });
    }

    // Add animation classes on scroll
    function initScrollAnimations() {
        $(window).on('scroll', function() {
            $('.service-card, .blog-card').each(function() {
                var elementTop = $(this).offset().top;
                var windowBottom = $(window).scrollTop() + $(window).height();

                if (elementTop < windowBottom - 100) {
                    $(this).addClass('animate-in');
                }
            });
        });
    }

    // Back to Top Button
    function initBackToTop() {
        // Create back to top button if it doesn't exist
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

        $('.back-to-top').on('click', function() {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });
    }

    // Form Validation Enhancement
    function initFormValidation() {
        $('form').on('submit', function(e) {
            var isValid = true;
            $(this).find('[required]').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('error');
                } else {
                    $(this).removeClass('error');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Vui lòng điền đầy đủ thông tin!');
            }
        });

        // Remove error class on input
        $('input, textarea, select').on('input change', function() {
            $(this).removeClass('error');
        });
    }

    // Initialize all functions
    $(document).ready(function() {
        initMobileMenu();
        initSmoothScroll();
        initStickyHeader();
        initServiceCards();
        initFloatingButtons();
        initCallTracking();
        initWhatsAppTracking();
        initTelegramTracking();
        initZaloTracking();
        initButtonLoading();
        initLazyLoading();
        initCopyToClipboard();
        initScrollAnimations();
        initBackToTop();
        initFormValidation();

        console.log('%c GSM Services Pro Theme Loaded ', 'background: #ff9800; color: #000; font-weight: bold; padding: 10px;');
        console.log('%c Contact: +84386355255 | Telegram: @hzgsm ', 'color: #ff9800; font-weight: bold;');
    });

    // Window resize handler
    $(window).on('resize', function() {
        if ($(window).width() > 768) {
            $('.nav-menu').removeClass('active');
            $('.mobile-menu-toggle i').removeClass('fa-times').addClass('fa-bars');
        }
    });

})(jQuery);

// Add CSS animations
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

    .animate-in {
        animation: fadeInUp 0.6s ease-out;
    }

    .pulse-effect {
        animation: pulse 1s ease-in-out !important;
    }

    .btn.loading {
        opacity: 0.6;
        pointer-events: none;
    }

    .btn.loading::after {
        content: '';
        display: inline-block;
        width: 14px;
        height: 14px;
        margin-left: 8px;
        border: 2px solid currentColor;
        border-top-color: transparent;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .back-to-top {
        position: fixed;
        bottom: 90px;
        right: 20px;
        z-index: 998;
        width: 50px;
        height: 50px;
        background: var(--gradient-secondary, linear-gradient(135deg, #ff9800 0%, #f57c00 100%));
        border: none;
        border-radius: 50%;
        color: #000;
        font-size: 20px;
        cursor: pointer;
        box-shadow: 0 4px 20px rgba(0,0,0,0.5);
        transition: all 0.3s ease;
    }

    .back-to-top:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 25px rgba(0,0,0,0.7);
    }

    .site-header.sticky {
        box-shadow: 0 4px 30px rgba(0,0,0,0.8);
    }

    input.error,
    textarea.error,
    select.error {
        border-color: #f44336 !important;
        box-shadow: 0 0 0 3px rgba(244, 67, 54, 0.2) !important;
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
