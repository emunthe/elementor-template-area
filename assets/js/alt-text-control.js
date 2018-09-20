jQuery( window ).on( 'elementor:init', function() {
	//var initialize = elementor.modules.controls.BaseData.prototype.initialize;
	var ControlAltTextView = elementor.modules.controls.BaseData.extend( {
    	onBaseInputChange: function( event ) {
            console.log('INPUT EVENT', event);
            var input = event.currentTarget;
            console.log('value',this.getInputValue( input ));
        }
	} );
	elementor.addControlView( 'alttext', ControlAltTextView );

} );
