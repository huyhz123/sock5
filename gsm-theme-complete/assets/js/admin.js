/**
 * GSM Services - Admin JavaScript
 */

(function($) {
    'use strict';

    // Tab switching
    $('.nav-tab').on('click', function(e) {
        e.preventDefault();

        $('.nav-tab').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');

        var target = $(this).attr('href');
        $('.tab-content').hide();
        $(target).show();
    });

    // Color picker
    if ($.fn.wpColorPicker) {
        $('.color-picker').wpColorPicker();
    }

    // Image upload
    $('.upload-image-btn').on('click', function(e) {
        e.preventDefault();

        var button = $(this);
        var field = button.prev('input');

        var mediaUploader = wp.media({
            title: 'Select Image',
            button: { text: 'Use Image' },
            multiple: false
        });

        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            field.val(attachment.url);
            button.next('.image-preview').html('<img src="' + attachment.url + '" style="max-width:200px;">');
        });

        mediaUploader.open();
    });

    // Sortable lists
    if ($.fn.sortable) {
        $('.sortable-list').sortable({
            handle: '.handle',
            update: function() {
                // Save order via AJAX
                var order = $(this).sortable('toArray');
                console.log('New order:', order);
            }
        });
    }

    // Confirm delete
    $('.delete-btn').on('click', function() {
        return confirm('Are you sure you want to delete this item?');
    });

    // Toggle sections
    $('.section-toggle').on('click', function() {
        $(this).next('.section-content').slideToggle();
        $(this).toggleClass('active');
    });

    // Copy API keys
    $('.copy-api-key').on('click', function() {
        var $input = $(this).prev('input');
        $input.select();
        document.execCommand('copy');

        $(this).text('Copied!');
        setTimeout(() => {
            $(this).text('Copy');
        }, 2000);
    });

    // Test notification
    $('#test-notification').on('click', function(e) {
        e.preventDefault();

        var $btn = $(this);
        $btn.prop('disabled', true).text('Sending...');

        $.post(ajaxurl, {
            action: 'gsm_test_notification',
            nonce: gsmAdmin.nonce
        }, function(response) {
            if (response.success) {
                alert('Notification sent successfully!');
            } else {
                alert('Error: ' + response.data);
            }
            $btn.prop('disabled', false).text('Test Notification');
        });
    });

    // Auto-save settings
    var saveTimeout;
    $('.auto-save input, .auto-save textarea, .auto-save select').on('change', function() {
        clearTimeout(saveTimeout);
        saveTimeout = setTimeout(function() {
            $('#settings-form').submit();
        }, 1000);
    });

    // Character counter
    $('textarea[maxlength]').each(function() {
        var max = $(this).attr('maxlength');
        var $counter = $('<div class="char-counter">0 / ' + max + '</div>');
        $(this).after($counter);

        $(this).on('input', function() {
            var len = $(this).val().length;
            $counter.text(len + ' / ' + max);

            if (len > max * 0.9) {
                $counter.addClass('warning');
            } else {
                $counter.removeClass('warning');
            }
        });
    });

})(jQuery);
