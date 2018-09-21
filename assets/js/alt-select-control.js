jQuery( window ).on( 'elementor:init', function() {
	//var initialize = elementor.modules.controls.BaseData.prototype.initialize;
	var ControlAltSelectView = elementor.modules.controls.BaseData.extend( {
    	onBaseInputChange: function( event ) {
            //console.log('INPUT EVENT', event, this);
            var input = event.currentTarget;
            //console.log('value',this.getInputValue( input ));
			//console.log('CHANNELS', elementor.channels.editor);

			window.ta_app.mainview.trigger('text-area-link:changed', this, this.options, this.getInputValue( input ));

			//this.triggerMethod('text-area-link:changed', input);
        }
	} );
	elementor.addControlView( 'altselect', ControlAltSelectView );
} );
