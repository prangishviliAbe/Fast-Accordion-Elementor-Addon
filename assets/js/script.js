jQuery(document).ready(function ($) {
    // alert('Fast Accordion Script Loaded'); // Debug alert to confirm loading

    // Event delegation for dynamically added elements and better reliability
    $(document).on('click', '.fast-accordion-item-header', function (e) {
        // e.preventDefault(); // Sometimes prevents default behavior if it's a link, but here it's a div. 
        // If it was inside <a> tag, we might need it. For now, let's leave it out or keep it if issues arise.

        var $header = $(this);

        // Check if we are in External Layout mode
        var $externalWrapper = $header.closest('.fast-accordion-layout-external');

        if ($externalWrapper.length > 0) {
            console.log('Fast Accordion: External Layout Clicked');

            // Robust index retrieval: try header first, then parent item
            var index = $header.attr('data-index');
            if (typeof index === 'undefined' || index === false) {
                index = $header.closest('.fast-accordion-item').attr('data-index');
            }

            console.log('Fast Accordion: Target Index:', index);

            // Toggle Active Class on Items (for visual styling like borders)
            $externalWrapper.find('.fast-accordion-item').removeClass('active');
            $header.closest('.fast-accordion-item').addClass('active'); // Wrapper around header

            // Toggle Active Class on Header itself
            $externalWrapper.find('.fast-accordion-item-header').removeClass('active');
            $header.addClass('active');

            // Content Visibility
            var $panels = $externalWrapper.find('.fast-accordion-content-panel');
            $panels.hide(); // Hide all first

            var $targetPanel = $externalWrapper.find('.fast-accordion-content-panel[data-index="' + index + '"]');

            if ($targetPanel.length > 0) {
                console.log('Fast Accordion: Found panel, showing.');
                $targetPanel.stop(true, true).fadeIn(300);
            } else {
                console.error('Fast Accordion: Panel not found for index ' + index);
            }

        } else {
            // Default Accordion Behavior
            var $item = $header.closest('.fast-accordion-item');
            var $content = $item.find('.fast-accordion-item-content');

            // Toggle the clicked item
            $content.slideToggle();
            $item.toggleClass('active');
        }
    });

    // Close Button Logic
    $(document).on('click', '.fast-accordion-close-btn', function (e) {
        e.stopPropagation(); // Prevent bubbling to header click if nested (unlikely but safe)
        var $btn = $(this);
        var $externalWrapper = $btn.closest('.fast-accordion-layout-external');

        console.log('Fast Accordion: Close Button Clicked');

        if ($externalWrapper.length > 0) {
            // External Layout Close
            $externalWrapper.find('.fast-accordion-content-panel').fadeOut(300);
            $externalWrapper.find('.fast-accordion-item').removeClass('active');
            $externalWrapper.find('.fast-accordion-item-header').removeClass('active');
        } else {
            // Accordion Layout Close
            var $content = $btn.closest('.fast-accordion-item-content');
            var $item = $content.closest('.fast-accordion-item');
            $item.removeClass('active');
            $content.slideUp();
        }
    });
});
