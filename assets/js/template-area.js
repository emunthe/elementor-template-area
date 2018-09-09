(function($) {
    var WidgetTemplateAreaHandler = function($scope, $) {
        /*
        console.log('template-area.default', $scope[0].attributes);
        console.log('template-area.default', $scope[0].attributes['data-id']);
        console.log('template-area.default', $scope[0].attributes['data-id'].value);

        var thisElement = '.elementor-element-' + $scope[0].attributes['data-id'].value;
        var thisElementTitle = thisElement + ' .elementor-template-area-link'
        console.log(thisElementTitle);

        $(thisElementTitle).click(function(ev) {
          console.log( "Handler", ev);
          console.log( "data-value", ev.currentTarget);
          console.log( "data-value", ev.currentTarget.attributes);
          console.log( "data-value", ev.currentTarget.attributes['data-link'].value);
          var dataTabValue = ev.currentTarget.attributes['data-link'].value;
          var strJQ = '.elementor-template-area-content [data-content-link="' + dataTabValue + '"]';
          console.log(strJQ);
          $(strJQ).show();
        });

        */

    };

    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/template-area.default', WidgetTemplateAreaHandler);
    });

})(jQuery);
