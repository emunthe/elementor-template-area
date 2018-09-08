(function($) {
    var WidgetCustomColumnHandler = function($scope, $) {
        console.log($scope);
    };

    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/template-area.default', WidgetCustomColumnHandler);
    });
})(jQuery);
