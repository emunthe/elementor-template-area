jQuery( window ).on( 'elementor:init', function() {
	var initialize = elementor.modules.controls.BaseData.prototype.initialize;
	var ControlTemplateAreaSelectView = elementor.modules.controls.BaseData.extend( {
		initialize: function(){
			initialize.apply( this, arguments );

			window.ta_app.mainview.trigger('text-area-link:control:areaselect:register', this.cid);
			this.getAreaArray();
		},
		getAreaArray: function(){
			var areaArray = window.ta_app.mainview.getAreaArray();
			console.log('ControlTemplateAreaSelectView getAreaArray',areaArray);
		},
		setAreaEditSettings: function(){
			// 1 get current area selected.
			// 2 get this current settings
			// 3 set area edit settings

		}
	} );
	elementor.addControlView( 'templateareaselect', ControlTemplateAreaSelectView );


} );
