
PLUGIN USES THESE ELEMENTOR FILES

plugins/elementor/includes/widgets/tabs.php


plugins/elementor/includes/plugin.php
/plugins/elementor/includes/frontend.php - builer save and get

STUDY
https://developers.elementor.com/creating-a-new-control/


INVESTIGATION

use messages to intra com




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
