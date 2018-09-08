(function($) {
    var WidgetTemplateAreaHandler = function($scope, $) {
        console.log('template-area.default', $scope[0].attributes);

        //var thisElement = 'elementor-element-' + $scope.attributes['data-id'];

        //console.log(thisElement);
        //$( "#target" ).click(function() {
          //alert( "Handler for .click() called." );
        //});

    };

    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/template-area.default', WidgetTemplateAreaHandler);
    });

})(jQuery);
