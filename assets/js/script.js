jQuery(document).ready(function ($) {
    // alert('Fast Accordion Script Loaded'); // Debug alert to confirm loading

    // Event delegation for dynamically added elements and better reliability
    $(document).on('click', '.fast-accordion-item-header', function (e) {

        var $header = $(this);
        var $wrapper = $header.closest('.fast-accordion-wrapper');
        var animOpen = $wrapper.data('anim-open') || 'slide';
        var animClose = $wrapper.data('anim-close') || 'slide';

        // Check if we are in External Layout mode
        var $externalWrapper = $header.closest('.fast-accordion-layout-external');

        if ($externalWrapper.length > 0) {
            console.log('Fast Accordion: External Layout Clicked. Open:', animOpen, 'Close:', animClose);

            var index = $header.attr('data-index');
            if (typeof index === 'undefined' || index === false) {
                index = $header.closest('.fast-accordion-item').attr('data-index');
            }

            // Toggle Active Class
            $externalWrapper.find('.fast-accordion-item').removeClass('active');
            $header.closest('.fast-accordion-item').addClass('active');

            $externalWrapper.find('.fast-accordion-item-header').removeClass('active');
            $header.addClass('active');

            // Content Visibility Logic
            var $panels = $externalWrapper.find('.fast-accordion-content-panel');
            var $targetPanel = $externalWrapper.find('.fast-accordion-content-panel[data-index="' + index + '"]');

            if ($targetPanel.is(':visible')) {
                return; // Already open
            }

            // Close others
            var $visiblePanels = $panels.filter(':visible');
            if ($visiblePanels.length > 0) {
                if (animClose === 'fade') {
                    $visiblePanels.stop(true, true).fadeOut(200);
                } else if (animClose === 'none') {
                    $visiblePanels.hide();
                } else { // slide
                    $visiblePanels.stop(true, true).slideUp(300);
                }
            }

            // Open target
            // Use delay to ensure sequential animation for better visual clarity
            var delay = 0;
            if ($visiblePanels.length > 0) {
                if (animClose === 'fade') delay = 200;
                else if (animClose === 'slide') delay = 300; // Wait for slideUp to finish
            }

            setTimeout(function () {
                if ($targetPanel.length > 0) {
                    if (animOpen === 'fade') {
                        $targetPanel.stop(true, true).fadeIn(300);
                    } else if (animOpen === 'none') {
                        $targetPanel.show();
                    } else { // slide
                        $targetPanel.stop(true, true).slideDown(300);
                    }
                }
            }, delay);

        } else {
            // Default Accordion Layout
            console.log('Fast Accordion: Internal Layout Clicked. Open:', animOpen, 'Close:', animClose);

            var $item = $header.closest('.fast-accordion-item');
            var $content = $item.find('.fast-accordion-item-content');
            var isOpen = $item.hasClass('active');

            $item.toggleClass('active');

            if (isOpen) {
                // Closing
                if (animClose === 'fade') {
                    $content.stop(true, true).fadeOut(300);
                } else if (animClose === 'none') {
                    $content.hide();
                } else {
                    $content.stop(true, true).slideUp(300);
                }
            } else {
                // Opening
                if (animOpen === 'fade') {
                    $content.stop(true, true).fadeIn(300);
                } else if (animOpen === 'none') {
                    $content.show();
                } else {
                    $content.stop(true, true).slideDown(300);
                }
            }
        }
    });

    // Close Button Logic
    $(document).on('click', '.fast-accordion-close-btn', function (e) {
        e.stopPropagation();
        var $btn = $(this);
        var $wrapper = $btn.closest('.fast-accordion-wrapper');
        var animClose = $wrapper.data('anim-close') || 'slide';
        var $externalWrapper = $btn.closest('.fast-accordion-layout-external');

        console.log('Fast Accordion: Close Button Clicked. Close Animation:', animClose);

        if ($externalWrapper.length > 0) {
            // External Layout Close
            $externalWrapper.find('.fast-accordion-item').removeClass('active');
            $externalWrapper.find('.fast-accordion-item-header').removeClass('active');

            var $panel = $externalWrapper.find('.fast-accordion-content-panel');

            if (animClose === 'fade') {
                $panel.fadeOut(300);
            } else if (animClose === 'none') {
                $panel.hide();
            } else {
                $panel.slideUp(300);
            }

        } else {
            // Accordion Layout Close
            var $content = $btn.closest('.fast-accordion-item-content');
            var $item = $content.closest('.fast-accordion-item');
            $item.removeClass('active');

            if (animClose === 'fade') {
                $content.fadeOut(300);
            } else if (animClose === 'none') {
                $content.hide();
            } else {
                $content.slideUp(300);
            }
        }
    });
});
