/**
 * GSM Services - Main JavaScript
 */

(function($) {
    'use strict';

    // Mobile menu toggle
    $('.mobile-menu-toggle').on('click', function() {
        $('.main-navigation').toggleClass('active');
        $(this).toggleClass('active');
    });

    // Close alerts
    $('.alert-close').on('click', function() {
        $(this).closest('.alert').fadeOut();
    });

    // Form validation
    $('form').on('submit', function(e) {
        var hasError = false;

        $(this).find('[required]').each(function() {
            if (!$(this).val()) {
                $(this).addClass('error');
                hasError = true;
            } else {
                $(this).removeClass('error');
            }
        });

        if (hasError) {
            e.preventDefault();
            alert('Please fill in all required fields');
        }
    });

    // IMEI validation
    $('input[name="imei"]').on('input', function() {
        var val = $(this).val().replace(/\D/g, '');
        $(this).val(val);

        if (val.length === 15) {
            $(this).removeClass('error').addClass('success');
        }
    });

    // Smooth scroll
    $('a[href^="#"]').on('click', function(e) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 500);
        }
    });

    // Copy to clipboard
    $('.copy-btn').on('click', function() {
        var text = $(this).data('text');
        var $temp = $('<input>');
        $('body').append($temp);
        $temp.val(text).select();
        document.execCommand('copy');
        $temp.remove();

        $(this).text('✓ Copied').addClass('success');
        setTimeout(() => {
            $(this).text('Copy').removeClass('success');
        }, 2000);
    });

    // Confirm actions
    $('[data-confirm]').on('click', function(e) {
        if (!confirm($(this).data('confirm'))) {
            e.preventDefault();
            return false;
        }
    });

    // Auto-hide alerts
    setTimeout(function() {
        $('.alert').not('.alert-permanent').fadeOut();
    }, 5000);

    // Number formatting
    $('.format-price').each(function() {
        var num = parseFloat($(this).text());
        if (!isNaN(num)) {
            $(this).text('$' + num.toFixed(2));
        }
    });

    // Loading state for buttons
    $('form').on('submit', function() {
        var $btn = $(this).find('button[type="submit"]');
        $btn.prop('disabled', true).html('<span class="spinner"></span> Processing...');
    });

})(jQuery);
