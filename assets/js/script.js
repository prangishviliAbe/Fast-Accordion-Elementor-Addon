jQuery(document).ready(function ($) {
    $('.fast-accordion-item-header').on('click', function () {
        var $header = $(this);

        // Check if we are in External Layout mode
        if ($header.closest('.fast-accordion-layout-external').length > 0) {
            var $wrapper = $header.closest('.fast-accordion-wrapper');
            var index = $header.data('index');

            // Toggle Active Class on Headers
            $wrapper.find('.fast-accordion-block').removeClass('active');
            $header.addClass('active');

            // Show Corresponding Content
            $wrapper.find('.fast-accordion-content-panel').hide();
            $wrapper.find('.fast-accordion-content-panel[data-index="' + index + '"]').fadeIn();

        } else {
            // Default Accordion Behavior
            var $item = $(this).closest('.fast-accordion-item');
            var $content = $item.find('.fast-accordion-item-content');

            // Toggle the clicked item
            $content.slideToggle();
            $item.toggleClass('active');
        }
    });
});
