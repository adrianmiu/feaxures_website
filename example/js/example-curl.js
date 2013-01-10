curl({
    'baseUrl': './js/',
    'paths': {
        'jqueryui': '../jqueryui'
    },
    'apiName': 'require'
});

/**
 * curljs async! plugin doesn't work properly with google maps so we need to define it here
 * @license
 * RequireJS plugin for async dependency load like JSONP and Google Maps
 * Author: Miller Medeiros
 * Version: 0.1.1 (2011/11/17)
 * Released under the MIT license
 */
define('curl/plugin/google', function(){

    var DEFAULT_PARAM_NAME = 'callback',
        _uid = 0;

    function injectScript(src){
        var s, t;
        s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = src;
        t = document.getElementsByTagName('script')[0]; t.parentNode.insertBefore(s,t);
    }

    function formatUrl(name, id){
        var paramRegex = /!(.+)/,
            url = name.replace(paramRegex, ''),
            param = (paramRegex.test(name))? name.replace(/.+!/, '') : DEFAULT_PARAM_NAME;
        url += (url.indexOf('?') < 0)? '?' : '&';
        return url + param +'='+ id;
    }

    function uid() {
        _uid += 1;
        return '__async_req_'+ _uid +'__';
    }

    return{
        load : function(name, req, onLoad, config){
            if(config.isBuild){
                onLoad(null); //avoid errors on the optimizer
            }else{
                var id = uid();
                window[id] = onLoad; //create a global variable that stores onLoad so callback function can define new module after async load
                injectScript(formatUrl(name, id));
            }
        }
    };
});


require(['feaxures'], function(Feaxures) {
    var feaxures = new Feaxures();

    /**
     * You can attach events to the feaxures instance similar to jQuery
     * You have: on(), one() and off() or adding/removing callbacks
     * Available events are:
     * - load: when a feaxure's files are loaded
     * - loadError: when a feaxure's files are not loaded
     * - onBeforeAttach: before attaching a feaxure to an element (if it returns false, the feaxure will not be attached anymore)
     * - onAfterAttach: after attaching a feaxure to an element
     * You can also attach events for specific feaxures by adding the ':[feaxureName]' suffix to the event. 
     * For exmple the 'load:tabs' will be triggered only when the files for the 'tabs' feaxure are loaded
     */

    // callback executed once the first feaxure gets it's files loaded
    feaxures.one('load', function(event, feature) {
        $('#logger').append('<p class="alert alert-info">First feaxure was loaded</p>');
    });

    // callback executed each time a feaxure's files are loaded
    feaxures.on('load', function(event, feature) {
        $('#logger').append('<p class=alert alert-success">Feaxure "'+feature+'" was loaded</p>');
    });

    // callback executed when the 'tabs' feaxure's file are loaded
    feaxures.on('load:tabs', function(event, feature) {
        $('#logger').append('<p class="alert alert-success">The "tabs" feaxure was loaded</p>');
    });

    // callback executed each time a feaxure's file fail to load
    feaxures.on('loadError', function(event, feature) {
        $('#logger').append('<p class="alert alert-error">Feaxure "'+feature+'" was NOT loaded</p>');
    });

    // other events
    feaxures.on('onBeforeAttach', function(event) {
        $('#logger').append('<p class="alert alert-success">Feaxure "'+event.feature+'" to be attached on #'+$(event.target).attr('id')+'</p>');
    });
    feaxures.on('onAfterAttach:accordion', function(event) {
        $('#logger').append('<p class="alert alert-success">"Accordion" was attached on #'+$(event.target).attr('id')+'</p>');
    });

    /**
     * this function is to prevent FOUC (flash of unstyled content)
     * we are using Modernizr to add the 'js' class to the HTML tag
     * so, if the element matches the '.js .fouc' selector it's hidden by default
     */
    feaxures.on('onAfterAttach', function(event) {
        if ($(event.target).hasClass('fouc')) {
            $(event.target).css({display: 'none'}).removeClass('fouc').fadeIn(1000);
        }
    });

    // the minimum requirements to register a feaxure are the 'files' array and 'attach' callback
    feaxures.register('tabs', {
        files: ['js!jqueryui/jquery.ui.core.js!order', 'js!jqueryui/jquery.ui.widget.js!order', 'js!jqueryui/jquery.ui.tabs.js!order', 'css!jqueryui/css/jquery-ui-1.9.2.custom.min.css'],
        attach: function(el, options) {
            $(el).tabs(options);
        }
    });

    feaxures.register('fake', {
        files: ['js!fake'],
        attach: function(el, options) {
            /* this is required by some issues with IE see http://requirejs.org/docs/api.html#ieloadfail */
            if (!jQuery.fn.fake) { return; }
            $(el).fake(options);
        }
    });

    // you can add some optimizations using the 'autoLoad' and 'selector' options
    feaxures.register('accordion', {
        // the files for this feaxure will start loading as soon as the instance is initialized
        // this can be usefull for feaxures that are heavily used
        autoLoad: true,

        // you can changed the selector for the elements containing the feaxure
        // CSS class-based selectors are faster than attribute name-based selectors
        selector: '.accordion[data-fxr-accordion]',

        // you can set default configuration options for the feaxure
        defaults:  {
            collapsible: true
        },

        files: ['js!jqueryui/jquery.ui.core.js!order', 'js!jqueryui/jquery.ui.widget.js!order', 'js!jqueryui/jquery.ui.accordion.js!order', 'css!jqueryui/css/jquery-ui-1.9.2.custom.min.css'],
        attach: function(el, options) {
            $(el).accordion(options);
        }
    });

    feaxures.register('datepicker', {
        // the feaxure will be attached on the element on the focus event
        // (obviously there is no point in doing that if you have auto-loaded the feature)
        attachEvent: 'focus',

        files: ['js!jqueryui/jquery.ui.core.js!order', 'js!jqueryui/jquery.ui.widget.js!order', 'js!jqueryui/jquery.ui.datepicker.js!order', 'css!jqueryui/css/jquery-ui-1.9.2.custom.min.css'],

        // setting the 'onBeforeAttach' property here is the same as doing feaxures.on('onBeforeAttach:datepicker', function(event){})
        // the function bellow will prevent the feaxures to be added to #anotherday
        onBeforeAttach: function(event) {
            if ($(event.target).attr('id') === 'anotherday') {
                event.result = false;
            }
        },
        onAfterAttach: function(event) {
           $('#logger').append('<p class="alert">"Datepicker" was attached on #'+$(event.target).attr('id')+'</p>');
        },
        attach: function(el, options) {
            console.log(options);
            $(el).datepicker(options);
        }
    });

    feaxures.register('lightbox', {
        attachEvent: 'click',
        defaults: {
            keys: {
                next : {
                    13 : 'left', // enter
                    34 : 'up',   // page down
                    39 : 'left', // right arrow
                    40 : 'up'    // down arrow
                },
                prev : {
                    8  : 'right',  // backspace
                    33 : 'down',   // page up
                    37 : 'right',  // left arrow
                    38 : 'down'    // up arrow
                },
                close  : [27], // escape key
                play   : [32], // space - start/stop slideshow
                toggle : [70]  // letter "f" - toggle fullscreen
            },
            openEffect: 'none',
            closeEffect: 'none'
        },
        files: ['js!../fancybox/jquery.fancybox.js', 'css!../fancybox/jquery.fancybox.css'],
        attach: function(el, options) {
            $('.fancybox').fancybox(options);
        }
    });
    // we can disable the lightbox feaxure if the screen is too small by calling register() again
    if ($(window).width() < 400) {
        feaxures.register('lightbox', false);
    }

    feaxures.register('maps', {
        defaults: {
            map:{
                options:{
                    zoom: 8
                }
            }
        },
        files: ['google!//maps.google.com/maps/api/js?v=3&sensor=true'],
        attach: function(el, options) {
            curl(['js!../gmap3/gmap3'], function() {
                /**
                 * on the attach() function you can mess around with the options
                 * for example, if you're changing a jquery plugin with another one that has different configuration
                 * options, you can leave your mark-up intact and perform the configuration mapping here
                 */
                $(el).width(options.width);
                $(el).height(options.height);

                if (!options.map.options.center) {
                    options.map.options.center = [options.lat, options.lng];
                }
                $(el).gmap3({
                    map: options.map,
                    marker: {
                        latLng: [options.lat, options.lng]
                    }
                });
            });
        }
    });

    feaxures.initialize();
});
