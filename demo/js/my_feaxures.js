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


(function(){
	var myFx = new Feaxures();

	myFx.register('tabs', {
		files: [
			'js!assets/jqueryui/jquery.ui.core.min.js!order',
			'js!assets/jqueryui/jquery.ui.widget.min.js!order',
			'js!assets/jqueryui/jquery.ui.tabs.min.js!order',
			'css!assets/jqueryuibootstrap/jquery-ui-1.10.3.custom.css'
		],
		attach: function(el, opts) {
			$(el).tabs(opts);
		}
	});

	myFx.register('accordion', {
		files: [
			'js!assets/jqueryui/jquery.ui.core.min.js!order',
			'js!assets/jqueryui/jquery.ui.widget.min.js!order',
			'js!assets/jqueryui/jquery.ui.accordion.min.js!order',
			'css!assets/jqueryuibootstrap/jquery-ui-1.10.3.custom.css'
		],
		attach: function(el, opts) {
			$(el).accordion(opts);
		}
	});

	myFx.register('buttonset', {
		files: [
			'js!assets/jqueryui/jquery.ui.core.min.js!order',
			'js!assets/jqueryui/jquery.ui.widget.min.js!order',
			'js!assets/jqueryui/jquery.ui.button.min.js!order',
			'css!assets/jqueryuibootstrap/jquery-ui-1.10.3.custom.css'
		],
		attach: function(el, opts) {
			$(el).buttonset(opts);
		}
	});

	myFx.register('button', {
		files: [
			'js!assets/jqueryui/jquery.ui.core.min.js!order',
			'js!assets/jqueryui/jquery.ui.widget.min.js!order',
			'js!assets/jqueryui/jquery.ui.button.min.js!order',
			'css!assets/jqueryuibootstrap/jquery-ui-1.10.3.custom.css'
		],
		attach: function(el, opts) {
			$(el).button(opts);
		}
	});

	myFx.register('dialog', {
		files: [
			'js!assets/jqueryui/jquery.ui.core.min.js!order',
			'js!assets/jqueryui/jquery.ui.widget.min.js!order',
			'js!assets/jqueryui/jquery.ui.draggable.min.js!order',
			'js!assets/jqueryui/jquery.ui.position.min.js!order',
			'js!assets/jqueryui/jquery.ui.resizable.min.js!order',
			'js!assets/jqueryui/jquery.ui.dialog.min.js!order',
			'css!assets/jqueryuibootstrap/jquery-ui-1.10.3.custom.css'
		],
		attach: function(el, opts) {
			$(el).dialog(opts);
		}
	});

	myFx.register('autocomplete', {
		attachEvent: "focus",
		files: [
			'js!assets/jqueryui/jquery.ui.core.min.js!order',
			'js!assets/jqueryui/jquery.ui.widget.min.js!order',
			'js!assets/jqueryui/jquery.ui.position.min.js!order',
			'js!assets/jqueryui/jquery.ui.menu.min.js!order',
			'js!assets/jqueryui/jquery.ui.autocomplete.min.js!order',
			'css!assets/jqueryuibootstrap/jquery-ui-1.10.3.custom.css'
		],
		attach: function(el, opts) {
			$(el).autocomplete(opts);
		}
	});

	myFx.register('slider', {
		files: [
			'js!assets/jqueryui/jquery.ui.core.min.js!order',
			'js!assets/jqueryui/jquery.ui.mouse.min.js!order',
			'js!assets/jqueryui/jquery.ui.widget.min.js!order',
			'js!assets/jqueryui/jquery.ui.slider.min.js!order',
			'css!assets/jqueryuibootstrap/jquery-ui-1.10.3.custom.css'
		],
		attach: function(el, opts) {
			$(el).slider(opts);
		}
	});

	myFx.register('vslider', {
		files: [
			'js!assets/jqueryui/jquery.ui.core.min.js!order',
			'js!assets/jqueryui/jquery.ui.mouse.min.js!order',
			'js!assets/jqueryui/jquery.ui.widget.min.js!order',
			'js!assets/jqueryui/jquery.ui.slider.min.js!order',
			'css!assets/jqueryuibootstrap/jquery-ui-1.10.3.custom.css'
		],
		attach: function(el, opts) {
			opts.orientation = 'vertical';
			$(el).slider(opts);
		}
	});

	// we load the datepicker only on focus
	myFx.register('datepicker', {
		attachEvent: "focus",
		files: [
			'js!assets/jqueryui/jquery.ui.core.min.js!order',
			'js!assets/jqueryui/jquery.ui.datepicker.min.js!order',
			'css!assets/jqueryuibootstrap/jquery-ui-1.10.3.custom.css'
		],
		attach: function(el, opts) {
			$(el).datepicker(opts);
		}
	});

	myFx.register('menu', {
		files: [
			'js!assets/jqueryui/jquery.ui.core.min.js!order',
			'js!assets/jqueryui/jquery.ui.widget.min.js!order',
			'js!assets/jqueryui/jquery.ui.position.min.js!order',
			'js!assets/jqueryui/jquery.ui.menu.min.js!order',
			'css!assets/jqueryuibootstrap/jquery-ui-1.10.3.custom.css'
		],
		attach: function(el, opts) {
			$(el).menu(opts);
		}
	});

	// custom feaxure, baby! groovy!
	myFx.register('opendialog', {
		files: [],
		attach: function(el, opts) {
			$(el).on('click', function() {
				$('#' + opts.container).dialog('open');
				return false;
			});
		}
	});

	// we load the datepicker only on focus
	myFx.register('lightbox', {
		attachEvent: "click",
		files: [
			'js!assets/fancybox/jquery.fancybox.pack.js',
			'css!assets/fancybox/jquery.fancybox.css'
		],
		attach: function(el, opts) {
			$(el).fancybox(opts);
		}
	});

    myFx.register('maps', {
        defaults: {
            map:{
                options:{
                    zoom: 8
                }
            }
        },
        files: ['google!//maps.google.com/maps/api/js?v=3&sensor=true'],
        attach: function(el, options) {
            // we need to make sure the google files are already loaded
            // and this is the only way because the google plugin doesn't hander the !order
            curl(['js!assets/gmap3/gmap3.js'], function() {
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


})();