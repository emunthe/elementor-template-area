(function($) {
    var WidgetTemplateAreaAreaHandler = function($scope, $) {

        console.log('template-area-area.default', $scope);
        //console.log('template-area-area.default', $scope[0].attributes['data-id']);
        //console.log('template-area-area.default', $scope[0].attributes['data-id'].value);

    };

    var WidgetTemplateAreaLinksHandler = function($scope, $) {

        console.log('template-area-links.default', $scope);
        //console.log('template-area-links.default', $scope[0].attributes['data-id']);
        //console.log('template-area-links.default', $scope[0].attributes['data-id'].value);

        var thisElement = '.elementor-element-' + $scope[0].attributes['data-id'].value;
        var thisElementTitle = thisElement + ' .elementor-template-area-link';
        //console.log(thisElementTitle);

        $(thisElementTitle).click(function(ev) {
          console.log( "Handler", ev);
          //console.log( "data-value", ev.currentTarget);
          //console.log( "data-value", ev.currentTarget.attributes);
        });

    };


    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/template-area-area.default', WidgetTemplateAreaAreaHandler);

        elementorFrontend.hooks.addAction('frontend/element_ready/template-area-links.default', WidgetTemplateAreaLinksHandler);
    });

})(jQuery);
