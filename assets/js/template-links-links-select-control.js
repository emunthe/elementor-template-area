jQuery( window ).on( 'elementor:init', function() {
	var initialize = elementor.modules.controls.BaseData.prototype.initialize;
	var ControlTemplateAreaLinksSelectView = elementor.modules.controls.BaseData.extend( {
		initialize: function(){
			initialize.apply( this, arguments );

			window.ta_app.mainview.trigger('text-area-link:control:linksselect:register', this.elementSettingsModel.collection);
		},
		onBaseInputChange: function( event ) {
            console.log('INPUT EVENT', event);
            var input = event.currentTarget;
            console.log('value',this.getInputValue( input ));
			//console.log('view',this);
			window.ta_app.mainview.trigger('text-area-link:control:linksselect:changed', this.elementSettingsModel, this.getInputValue( input ));
        },
		setAreaEditSettings: function(){
			// 1 get current area selected.
			// 2 get this current settings
			// 3 set area edit settings

		}
	} );
	elementor.addControlView( 'templatearealinksselect', ControlTemplateAreaLinksSelectView );


} );
