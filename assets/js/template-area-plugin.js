(function($) {
    if ( typeof window.ta_app === 'undefined' && typeof window.Marionette !== 'undefined') {

        const TAMainView = window.Marionette.Application.extend( {
            initialize: function(){
                this.areaViews = [];
                console.log('Initialize TAMainView');
                this.on('text-area-link:control:register', this.linkControlRegister);

                this.on('text-area-area:control:register', this.areaControlRegister);
                this.on('text-area-area:control:change:name', this.areaNameChange);

                this.on('text-area:widget:register', this.areaWidgetRegister);
            },
            addAreaView: function(areaView){
                this.areaViews.push(areaView);
            },
            linkControlRegister: function(view){
                console.log('LINK CONTROL REGISTER', view);
            },
            areaControlRegister: function(view){
                console.log('AREA CONTROL REGISTER', view);
            },
            areaWidgetRegister: function(view){
                console.log('AREA WIGET REGISTER', view);
                console.log('Element view.get(widgetType)', view.get('widgetType'));
                if ( view.get( 'widgetType' ) == 'template-area-area' ) {
                    this.addAreaView(view);
                }
            },
            areaNameChange: function(view){
                console.log('AREA NAME CHANGE', view);
            }
        } );

        const TAApp = window.Marionette.Application.extend( {
            initialize(options) {
              console.log('Initialize TA_APP');
            },

        } );
        window.ta_app = new TAApp();
        window.ta_app.mainview = new TAMainView();
        window.ta_app.start();
    }


    jQuery( window ).on( 'elementor:init', function() {
        var orig_Element = elementor.modules.elements.models.Element.prototype;
        var orig_Element_initialize = elementor.modules.elements.models.Element.prototype.initialize;
        jQuery.extend( orig_Element, {
            initialize: function(){
                //console.log('Element initialize');
                //console.log('Element cid', this.cid);
                //console.log('Element this', this);
                if( typeof this.get('widgetType') !== 'undefined') {
                    window.ta_app.mainview.trigger('text-area:widget:register', this);
                }
                orig_Element_initialize.apply( this, arguments );
            }
        });

    });


})(jQuery);
