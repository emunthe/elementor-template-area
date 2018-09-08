(function($) {
    var WidgetTemplateAreaHandler = function($scope, $) {
        console.log($scope);
        console.log('here');
    };

    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/templatearea.default', WidgetTemplateAreaHandler);
    });
})(jQuery);
