(function($) {
    var GlobalTemplateAreaHandler = function($scope, $) {
        console.log('GlobalTemplateAreaHandler', $scope);
    };

    var WidgetTemplateAreaHandler = function($scope, $) {
        console.log($scope);
        console.log('template-area.default');
    };

    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/global', GlobalTemplateAreaHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/template-area.default', WidgetTemplateAreaHandler);
    });
})(jQuery);
