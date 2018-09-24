(function($) {
    if ( typeof window.ta_app === 'undefined' && typeof window.Marionette !== 'undefined') {

        /*
            Make array of template areas at elementor init
        */
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



        const TAMainView = window.Marionette.Application.extend( {
            initialize: function(){
                this.areaViews = [];
                console.log('Initialize TAMainView');
                this.on('text-area-link:control:areaselect:register', this.linkAreaSelectControlRegister);
                this.on('text-area-link:control:linksselect:register', this.linkLinkSelectControlRegister);

                this.on('text-area-link:control:linksselect:register', this.linkTemplateLinksControlRegister);
                this.on('text-area-link:control:linksselect:changed', this.linkTemplateLinksControlChanged);

                this.on('text-area-area:control:register', this.areaControlRegister);
                this.on('text-area-area:control:change:name', this.areaNameChange);

                this.on('text-area:widget:register', this.areaWidgetRegister);
            },
            addAreaView: function(areaView){
                this.areaViews.push(areaView);
            },
            setAreaViewTemplates( cid, template_id_array ) {
                //find cid in this.areaViews
                var view = this.areaViews[0];
                //var these_settings = view.get('settings');
                //console.log( 'get(settings)',  these_settings );
                view.setSetting( 'template_area_templates', template_id_array );
                console.log( 'setSetting',  view.get('settings') );
            },
            getAreaArray: function(){
                return this.areaViews;
            },
            linkTemplateLinksControlRegister: function(view){
                console.log('TEMPLATE LINKS CONTROL REGISTER', view);
            },
            linkTemplateLinksControlChanged: function(view){
                console.log('TEMPLATE LINKS CHANGED', view);
                var array_templ = [];
                view.models.forEach( function(model){
                    array_templ.push( Number( model.get('template_id') ) );
                });
                console.log('THIS ARRAY',array_templ);
                this.setAreaViewTemplates(0,array_templ);
            },
            linkAreaSelectControlRegister: function(view){
                console.log('TEMPLATE AREA SELECT CONTROL REGISTER', view);
            },
            linkLinkSelectControlRegister: function(collection){
                console.log('LINK LINK SELECT CONTROL REGISTER', collection);
                collection.models.forEach( function( model ){
                    console.log('SET TEMPLATE',model.attributes.template_id);
                });

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





})(jQuery);
