jQuery(document).ready(function ($) {
    // alert('Fast Accordion Script Loaded'); // Debug alert to confirm loading

    // Event delegation for dynamically added elements and better reliability
    $(document).on('click', '.fast-accordion-item-header', function (e) {

        var $header = $(this);
        var $wrapper = $header.closest('.fast-accordion-wrapper');
        var animation = $wrapper.data('animation') || 'slide'; // Default to slide if not set

        // Check if we are in External Layout mode
        var $externalWrapper = $header.closest('.fast-accordion-layout-external');

        if ($externalWrapper.length > 0) {
            console.log('Fast Accordion: External Layout Clicked. Animation: ', animation);

            // Robust index retrieval
            var index = $header.attr('data-index');
            if (typeof index === 'undefined' || index === false) {
                index = $header.closest('.fast-accordion-item').attr('data-index');
            }

            // Toggle Active Class on Items
            $externalWrapper.find('.fast-accordion-item').removeClass('active');
            $header.closest('.fast-accordion-item').addClass('active');

            // Toggle Active Class on Header itself
            $externalWrapper.find('.fast-accordion-item-header').removeClass('active');
            $header.addClass('active');

            // Content Visibility Logic
            var $panels = $externalWrapper.find('.fast-accordion-content-panel');
            var $targetPanel = $externalWrapper.find('.fast-accordion-content-panel[data-index="' + index + '"]');

            if ($targetPanel.is(':visible')) {
                return; // Already open
            }

            if (animation === 'fade') {
                $panels.stop(true, true).fadeOut(200);
                setTimeout(function () {
                    if ($targetPanel.length > 0) $targetPanel.stop(true, true).fadeIn(300);
                }, 200); // Wait for fade out
            } else if (animation === 'none') {
                $panels.hide();
                if ($targetPanel.length > 0) $targetPanel.show();
            } else {
                // True Slide Animation
                $panels.stop(true, true).not($targetPanel).slideUp(300);
                if ($targetPanel.length > 0) $targetPanel.stop(true, true).slideDown(300);
            }

        } else {
            // Default Accordion Layout
            console.log('Fast Accordion: Internal Layout Clicked. Animation: ', animation);

            var $item = $header.closest('.fast-accordion-item');
            var $content = $item.find('.fast-accordion-item-content');

            // Toggle Active Class
            $item.toggleClass('active');

            if (animation === 'fade') {
                $content.stop(true, true).fadeToggle(300);
            } else if (animation === 'none') {
                $content.toggle();
            } else {
                // Slide
                $content.stop(true, true).slideToggle(300);
            }
        }
    });

    // Close Button Logic
    $(document).on('click', '.fast-accordion-close-btn', function (e) {
        e.stopPropagation();
        var $btn = $(this);
        var $wrapper = $btn.closest('.fast-accordion-wrapper');
        var animation = $wrapper.data('animation') || 'slide';
        var $externalWrapper = $btn.closest('.fast-accordion-layout-external');

        console.log('Fast Accordion: Close Button Clicked. Animation: ', animation);

        if ($externalWrapper.length > 0) {
            // External Layout Close
            $externalWrapper.find('.fast-accordion-item').removeClass('active');
            $externalWrapper.find('.fast-accordion-item-header').removeClass('active');

            if (animation === 'fade') {
                $externalWrapper.find('.fast-accordion-content-panel').fadeOut(300);
            } else if (animation === 'none') {
                $externalWrapper.find('.fast-accordion-content-panel').hide();
            } else {
                $externalWrapper.find('.fast-accordion-content-panel').slideUp(300);
            }

        } else {
            // Accordion Layout Close
            var $content = $btn.closest('.fast-accordion-item-content');
            var $item = $content.closest('.fast-accordion-item');
            $item.removeClass('active');

            if (animation === 'fade') {
                $content.fadeOut(300);
            } else if (animation === 'none') {
                $content.hide();
            } else {
                $content.slideUp(300);
            }
        }
    });
});
