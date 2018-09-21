(function($) {
    if ( typeof window.ta_app === 'undefined' && typeof window.Marionette !== 'undefined') {

        const TAMainView = window.Marionette.Application.extend( {
            initialize: function(){
                console.log('Initialize TAMainView');
                this.on('text-area-link:register', this.linkRegister);
                this.on('text-area-area:register', this.areaRegister);
                this.on('text-area-area:change:name', this.areaNameChange);
            },
            linkRegister: function(view){
                console.log('LINK REGISTER', view, view.cid);

            },
            areaRegister: function(view){
                console.log('AREA REGISTER', view, view.model.cid);

                console.log( 'view.get( settings )', view.model.get( 'settings' ) );
                //view.updateElementModel( value, input );

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


    /*
    setTimeout(function () {
        elementor.hooks.addAction( 'panel/open_editor/widget/template-area-area', function( panel, model, view ) {

            console.log('panel/open_editor/widget/template-area-area',panel,model,view);

            console.log('elementor.modules.controls.BaseData', elementor.modules.controls.BaseData);

            var TemplateAreaControlHook = elementor.modules.controls.BaseData.extend( {
                onBaseInputChange: function( event ) {
            		elementor.modules.controls.BaseData.prototype.onBaseInputChange.apply( this, arguments );

            		console.log('INPUT CHANGE', event);
                },
        	} );
            elementor.addControlView( 'emojionearea', ControlEmojiOneAreaItemView );

        } );
    }, 2000);
    */
    /*
    var TemplateAreaControlHook = elementor.modules.controls.BaseData.extend( {
        initialize: function( options ) {
    		elementor.modules.controls.BaseData.prototype.initialize.apply( this, arguments );
            console.log('HERE');
        },
	} );
    */

    /*
    setTimeout(function () {
        $(window).elementor.channel.editor.on('status', function(arg) {
            console.log('status', arg);
        });
    }, 7000);


    setSettingsModel: function( value ) {
		ControlBaseView.prototype.setSettingsModel.apply( this, arguments );

		console.log('setSettingsModel', this.model.get( 'name' ));
	},



    */

})(jQuery);
