
PLUGIN USES THESE ELEMENTOR FILES

plugins/elementor/includes/widgets/tabs.php


plugins/elementor/includes/plugin.php
/plugins/elementor/includes/frontend.php - builer save and get

STUDY
https://developers.elementor.com/creating-a-new-control/


INVESTIGATION

BASE VIEW IS PARENT OF WIDGET VIEW - AND CONTAINS LISTENER FOR CHANGE ON SETTING
elementor-git/assets/dev/js/editor/elements/views/base.js
var editModel = this.getEditModel();  // This is this.model in BaseElementView -
this.listenTo( editModel.get( 'settings' ), 'change', this.onSettingsChanged )

INTERESTING - LISTENTO model.get('settings') - 'change'

IN elementor-git/assets/dev/js/editor/controls/base-data.js

setSettingsModel: function( value ) {
    this.elementSettingsModel.set( this.model.get( 'name' ), value );

    this.triggerMethod( 'settings:change' );
},

SO CONTROLL TRIGGERS SETTINGS:CHANGE - DOES IT AFTER settings change is detected!

renderOnChange - MODEL MAKES RENDER REQUEST !
DOES renderRemoteServer in elementor-git/assets/dev/js/editor/elements/models/element.js -
    HAS DEFERED VARUABLE FOR RENDER:
    onRemoteGetHtml: function( data ) {
        this.setHtmlCache( data.render );
        this.trigger( 'remote:render' );




sends ajax - action 'elementor_ajax'      (with id and data)

RECVIEVER: elementor-git/core/ajax-manager.php

RECIEVER: elementor-git/includes/managers/widgets.php line 283
Widgets_Manager::ajax_render_widget( $request )  
 * Ajax render widget.
 * Ajax handler for Elementor render_widget.
 * Fired by `wp_ajax_elementor_render_widget` action.

DOCUMENTS IS CLASS INSTANCE ARRAY  
$document = Plugin::$instance->documents->get( $request['editor_post_id'] );

THIS REPLYIES TO AJAX REQUEST WITH RENDERED CONTENT TO MARIONETTE !!

OM RECIEPT OF RENDER HTML renderRemoteServer in elementor-git/assets/dev/js/editor/elements/models/element.js -
    HAS DEFERED VARUABLE FOR RENDER:
    onRemoteGetHtml: function( data ) {
        this.setHtmlCache( data.render );
        this.trigger( 'remote:render' );

SETS CACHE IN MODEL and triggers remote:render

WidgetView listens to remote render - elementor-git/assets/dev/js/editor/elements/views/widget.js
'remote:render': this.onModelRemoteRender.bind( this )
AND REPLACES ELEMENT IN DOM
this.$el.removeClass( 'elementor-loading' );
this.render();



AHA - REMOTE RENDER = CLASSES GENEREATE HTML on request through AJAX
      LOCAL RENDER IS FOR SERVER SIDE = FRONTEND ??


STILL CANT FIND JS FOR EXECUTION OF TEMPLATE AREA VIEW
$template_id = $this->get_settings( 'template_id' ); is this incorporated ?







2) Make options - save/update for plugin.   ( Find where this is done in elelemtor)

2) Get Event from plugin controll - register event channel

3) send events on
    Register Area Name - get event in plugin main js and save options

SET TEMPLATE ID = 1955 plugins/elementor/assets/js/editor.js





1) Template Area

    QUESTION:   HOW IS CONTROLL BOUND TO SETTING (not updating via template) (marionette model binding?)
        Where?
        settings are updated for backend (editor frontend)



    Make new controll:  Template_Area_Name
    Controll must update Area Array on save ( update );

    Render Template links


2) Template link_setting

    1) Control of Template area

        On update link => Render page or render template-area

    2) List of templates

        default - yes

TODO:

1) Make Template widget into
    repeater is for:
        Name (ID)
        Parent - ( Level )
        Template ( Select )

    Make accessable globally

    ADD AREA - TO TREE
    GIVE NAME TO AREA



2) Link repeater.

    SELECT WHICH AREA TO CONTROLL - SHOW WHICH TEMPLATE ON CLICK
    Select from Template Widget repeater
