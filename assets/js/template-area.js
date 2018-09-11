(function($) {
    console.log( 'HandlerModule', HandlerModule);

    var WidgetTemplateAreaAreaHandler = function($scope, $) {

        //console.log('template-area-area.default', $scope);
        //console.log('template-area-area.default', $scope[0].attributes['data-id']);
        //console.log('template-area-area.default', $scope[0].attributes['data-id'].value);

    };

    var WidgetTemplateAreaLinksHandler = function($scope, $) {

        console.log('template-area-links.default $scope', $scope);
        console.log('template-area-links.default $', $);
        if ( window.elementorFrontend ) {
            console.log('window.elementorFrontend',window.elementorFrontend);
            console.log('window.elementorFrontend.getGeneralSettings()',window.elementorFrontend.getGeneralSettings());
            console.log('window.elementorFrontend.getElements()',window.elementorFrontend.getElements());
        }

        /*
        var LinksModule = HandlerModule.extend({
       	$activeContent: null,

       	getDefaultSettings: function getDefaultSettings() {
       		return {
       			selectors: {
       				tabTitle: '.elementor-tab-title',
       				tabContent: '.elementor-tab-content'
       			},
       			classes: {
       				active: 'elementor-active'
       			},
       			showTabFn: 'show',
       			hideTabFn: 'hide',
       			toggleSelf: true,
       			hidePrevious: true,
       			autoExpand: true
       		};
       	},

       	getDefaultElements: function getDefaultElements() {
       		var selectors = this.getSettings('selectors');

       		return {
       			$tabTitles: this.findElement(selectors.tabTitle),
       			$tabContents: this.findElement(selectors.tabContent)
       		};
       	},

       	activateDefaultTab: function activateDefaultTab() {
       		var settings = this.getSettings();

       		if (!settings.autoExpand || 'editor' === settings.autoExpand && !this.isEdit) {
       			return;
       		}

       		var defaultActiveTab = this.getEditSettings('activeItemIndex') || 1,
       		    originalToggleMethods = {
       			showTabFn: settings.showTabFn,
       			hideTabFn: settings.hideTabFn
       		};

       		// Toggle tabs without animation to avoid jumping
       		this.setSettings({
       			showTabFn: 'show',
       			hideTabFn: 'hide'
       		});

       		this.changeActiveTab(defaultActiveTab);

       		// Return back original toggle effects
       		this.setSettings(originalToggleMethods);
       	},

       	deactivateActiveTab: function deactivateActiveTab(tabIndex) {
       		var settings = this.getSettings(),
       		    activeClass = settings.classes.active,
       		    activeFilter = tabIndex ? '[data-tab="' + tabIndex + '"]' : '.' + activeClass,
       		    $activeTitle = this.elements.$tabTitles.filter(activeFilter),
       		    $activeContent = this.elements.$tabContents.filter(activeFilter);

       		$activeTitle.add($activeContent).removeClass(activeClass);

       		$activeContent[settings.hideTabFn]();
       	},

       	activateTab: function activateTab(tabIndex) {
       		var settings = this.getSettings(),
       		    activeClass = settings.classes.active,
       		    $requestedTitle = this.elements.$tabTitles.filter('[data-tab="' + tabIndex + '"]'),
       		    $requestedContent = this.elements.$tabContents.filter('[data-tab="' + tabIndex + '"]');

       		$requestedTitle.add($requestedContent).addClass(activeClass);

       		$requestedContent[settings.showTabFn]();
       	},

       	isActiveTab: function isActiveTab(tabIndex) {
       		return this.elements.$tabTitles.filter('[data-tab="' + tabIndex + '"]').hasClass(this.getSettings('classes.active'));
       	},

       	bindEvents: function bindEvents() {
       		var self = this;

       		self.elements.$tabTitles.on('focus', function (event) {
       			self.changeActiveTab(event.currentTarget.dataset.tab);
       		});

       		if (self.getSettings('toggleSelf')) {
       			self.elements.$tabTitles.on('mousedown', function (event) {
       				if (jQuery(event.currentTarget).is(':focus')) {
       					self.changeActiveTab(event.currentTarget.dataset.tab);
       				}
       			});
       		}
       	},

       	onInit: function onInit() {
       		HandlerModule.prototype.onInit.apply(this, arguments);

       		this.activateDefaultTab();
       	},

       	onEditSettingsChange: function onEditSettingsChange(propertyName) {
       		if ('activeItemIndex' === propertyName) {
       			this.activateDefaultTab();
       		}
       	},

       	changeActiveTab: function changeActiveTab(tabIndex) {
       		var isActiveTab = this.isActiveTab(tabIndex),
       		    settings = this.getSettings();

       		if ((settings.toggleSelf || !isActiveTab) && settings.hidePrevious) {
       			this.deactivateActiveTab();
       		}

       		if (!settings.hidePrevious && isActiveTab) {
       			this.deactivateActiveTab(tabIndex);
       		}

       		if (!isActiveTab) {
       			this.activateTab(tabIndex);
       		}
       	}
       });
       */

    };


    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/template-area-area.default', WidgetTemplateAreaAreaHandler);

        elementorFrontend.hooks.addAction('frontend/element_ready/template-area-links.default', WidgetTemplateAreaLinksHandler);
    });

})(jQuery);
