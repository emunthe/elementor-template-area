jQuery( window ).on( 'elementor:init', function() {
	var initialize = elementor.modules.controls.BaseData.prototype.initialize;
	var ControlTemplateAreaNameView = elementor.modules.controls.BaseData.extend( {
		initialize: function(){
			initialize.apply( this, arguments );
			window.ta_app.mainview.trigger('text-area-area:control:register', this);
		},
    	onBaseInputChange: function( event ) {
            //console.log('INPUT EVENT', event);
            var input = event.currentTarget;
            //console.log('value',this.getInputValue( input ));
			//console.log('view',this);
			window.ta_app.mainview.trigger('text-area-area:control:change:name', this, this.options, this.getInputValue( input ));
        }
	} );
	elementor.addControlView( 'template_area_name', ControlTemplateAreaNameView );


} );
