(function($) {
    var WidgetTemplateAreaHandler = function($scope, $) {
        console.log('template-area.default', $scope);
    };

    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/template-area.default', WidgetTemplateAreaHandler);
    });
})(jQuery);
