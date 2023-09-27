(function($) {
    var $adminNotice = $(
        '.wdcl-review-deserve, .wdcl-review-later, .wdcl-review-done'
    );
    $adminNotice.on('click', function(e) {
        var btn = $(this),
            notice = btn.closest('.wdcl-notice');

        if (!btn.hasClass('wdcl-review-deserve')) {
            e.preventDefault();
        }

        $.ajax({
            url: dismissible_notice.ajaxUrl,
            type: 'POST',
            data: {
                action: 'wdcl-dismiss-notice',
                nonce: dismissible_notice.nonce,
                repeat: !!btn.hasClass('wdcl-review-later'),
            },
        });

        notice.animate(
            {
                opacity: '-=1',
            },
            1000,
            function() {
                notice.remove();
            }
        );
    });
})(jQuery);
