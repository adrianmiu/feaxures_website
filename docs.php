<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Feaxures documentation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/prettify.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="favicon.ico">
  </head>

  <body>

    <div class="container-narrow">

      <?php $section = 'docs'; include('_header.php');?>

      <h1>Documentation</h1>

      <hr>

      <div class="row-fluid marketing">
        <div class="span12">
          <p>The best way to learn how to use Feaxures is to look at the source code of the <a href="example/">example page</a> as I tried to document it as much as possible. You can also check the <a href="howto.php">how to</a> page for special scenarios.</p>
          <p>To use Feaxures you must perform the following steps:</p>
          <h2>1. Load the files</h2>
          <p><strong>Feaxures JS</strong> depends on 2 libraries which need to be loaded beforehand:
          <ul>
            <li><a href="http://www.requirejs.org">RequireJS</a> or <a href="https://github.com/cujojs/curl">curl.js</a>. Although you can change it with your own (<a href="faq.php#no-requirejs">see FAQ</a>)</li>
            <li><a href="http://www.jquery.com">jQuery</a>. Although you can change it with your own (<a href="faq.php#no-jquery">see FAQ</a>)</li>
          </ul>
          <p><span class="label label-important">Important</span> Feaxures is defined as an AMD module so you only need to load <code>require.js</code> before using it. You may load jQuery as well just for optimization reasons.</p>
          <p>You also need to load your features' definition file (eg: <code>feaxures-def.js</code>). At this point you don't need to load <code>feaxures.js</code> as you will define it as a dependency within <code>feaxures-def.js</code> (at step 2)</p>

          <h2>2. Configure your loader </h2>
          <p>If you use RequireJS with FeaxuresJS you must first configure it. You can learn more about requireJS configuration options <a href="http://requirejs.org/docs/api.html#config">here</a>. <a href="https://github.com/cujojs/curl">curl.js</a> has different configuration options.</p>
          <pre class="prettyprint linenums lang-js">
require.config({
    // the main location of your JS files; everything else will be relative to this path
    'baseUrl': './js/',
    // requireJS uses plugins for loading files other than javascript (ie: CSS, text files)
    // and here is where you define the plugin's locations.
    // you may choose to concatenate require.js and the plugins you use
    'map': {
        '*': {
            'css': 'require.css'
        }
    },
    // you can define multiple locations for each file you need. 
    // if a file is not found in one location,
    // requireJS will try to load it from another place
    // you MUST NOT end your paths with .js or .css as requireJS will do that for you
    'paths': {
        'jquery': ['//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min', 'jquery'],
        // you can also define paths for folders. the line bellow tells requireJS
        // load everything that starts with 'jqueryui' from the folder '../jqueryui' relative to the baseUrl
        'jqueryui': '../jqueryui'
    },
    // this is how you must define your dependencies with requireJS
    // the lines bellow will instruct requireJS that before trying to load jquery.ui.tabs.js to load a list of files first
    'shim': {
        'jqueryui/jquery.ui.tabs': {
            // the css! prefix instructs requireJS to use the CSS plugin for loading that particular file
            deps: ['jquery', 'jqueryui/jquery.ui.core', 'jqueryui/jquery.ui.widget', 'css!jqueryui/css/jquery-ui-1.9.2.custom.min']
        },
        'jqueryui/jquery.ui.accordion': {
            deps: ['jquery', 'jqueryui/jquery.ui.core', 'jqueryui/jquery.ui.widget', 'css!jqueryui/css/jquery-ui-1.9.2.custom.min']
        },
        'jqueryui/jquery.ui.datepicker': {
            deps: ['jquery', 'jqueryui/jquery.ui.core', 'jqueryui/jquery.ui.widget', 'css!jqueryui/css/jquery-ui-1.9.2.custom.min']
        }
    }
});           </pre>
              
              <h2>3. Configure your feaxures</h2>
              <pre class="prettyprint linenums lang-js">
// since Feaxures is defined as AMD module and requireJS is also an module loader,
// we load it as an AMD module. If you don't want to do that you may skip
// embedding the script below in a require() call because Feaxures is available
// in the global name space as well.
require(['feaxures'], function(Feaxures) {
    // create an instance of the feaxures using a specific configuration
    var feaxures = new Feaxures({
      // activate the debug mode, which outputs various messages to the console
      'debug': true,
    });

    // minimum configuration options for a feature
    feaxures.register('accordion', {
        'files': ['jqueryui/jquery.ui.accordion'],
        'attach': function(element, options) {
            $(element).accordion(options);
        }
    }),

    // feature will full configuration options explained
    feaxures.register('tabs', {
        // auto-load the feature. true/false(default)
        // this will load the files as soon as feaxures is initialized 
        // and will NOT wait for the DOM to be ready and/or check 
        // if there are elements that have this feature
        'autoLoad'    : false,

        // the selector that will be used to query the DOM
        // for elements that will have this feature enabled.
        // by default it is constructed as '[data-fxr-{name-of-the-feature}]'
        // you can change it for optimization purposes with somethig like '.tabs'
        // (querying by class name is faster than by attribute name)
        'selector'    : '[data-fxr-tabs]',

        // 1. array of the files (resources) needed by this feature
        // 2. a function that returns an array
        // the files' representation should be in the format 
        // required by the loader (in this case requireJS)
        'files': ['jqueryui/jquery.ui.tabs'],

        // default configuration options for the feature
        // this object will be merged with the specific configuration options
        // that are applicable to each DOM element (see step 3)
        'defaults'    : {},

        // when to attach the feature to the elements
        // available options: 'domready' (default), 'click', 'hover', 'focus'
        // leave it empty if you want to attach the feature programatically
        'attachEvent' : 'domready',

        // callback to be executed after the feature's files are loaded
        'onLoad'      : null,

        // callback to be executed if there are errors while loading the files
        'onLoadError' : null,

        // callback to be executed after a feature is applied to a DOM element
        'onAttach'  : null,
        
        // callback to be executed after a feature is removed from a DOM element
        'onDetach'  : null,
        
        // a function to determine whether or not the element should be attached
        // to the DOM element. it will be used to check if the feature should
        // be detached from the element as well
        'attachCondition': function(element) {
            return $(window).width() > 500;
        }

        // function that contains the code to attach a feature to the element
        // requires 2 parameters:
        // el: the DOM element
        // options: a javascript object containing the options of the feature
        'attach': function(el, options) {
            $(el).tabs(options);
        }
    });

    // IMPORTANT! 
    feaxures.initialize();
});
              </pre>

              <h2>4. Add feaxures to your HTML markup</h2>
              <p>Feaxures uses attributes with the <code>data-fxr-</code> prefix to determine what features apply to a specific element. So, for an element with the 'tabs' feature the code looks like bellow</p>
<pre class="prettyprint numlines lang-html">
&lt;div data-fxr-tabs=""&gt;
  &lt;!-- rest of the mark up goes here --&gt;
&lt;/div&gt;
</pre>
              <p>The content of the <code>data-fxr-tabs</code> will determine the options that will be applied to that DOM element. Here Feaxures JS offers you lots of flexibility.</p>
              <ol>
                <li><strong>true</strong> or <strong>leave it empty</strong>. This means the feature will be applied using the default options</li>
                <li><strong>false</strong>. This means the feature will NOT be applied. I know it seems unnecessary but I use it to quickly test how the web page works/looks without the feature.</li>
                <li><strong>a URL query string</strong> like <code>key=value&amp;another_key=another_value</code>.</li>
                <li><strong>a JSON (not javascript object) string</strong> like <code>{"key": "value", "another_key": "another_value"}</code> (be carefull with the quotes though). To convert the string into a javascript object we use <code>eval()</code>.</li>
                <li><strong>an ID of a DOM element containing a javascript object</strong> which will point to a <code>script</code> element containing the options.
<pre class="prettyprint numlines lang-html">
&lt;div data-fxr-tabs="#tabConfig"&gt;&lt;/div&gt;  
&lt;script type="text/feaxures" id="tabConfig"&gt;
{
    "active": "1",
    "load": function(event, ui) {
        alert("tab content loaded");
    }
}
&lt;/script&gt;</pre>
                  <p>I chose to use the <code>script</code> tag for 2 reasons: it's not visible to the user and your code editor will highlight the syntax (if you configure it properly).</p>
                  <p><span class="label label-important">Important</span> You must use "text/feaxures", otherwise the browser will interpret the code.</p>
                  <p>The content of script block is eval()'ed into an object.</p>
                </li>
                <li><strong>an ID of a DOM element containing a function</strong>  if the data-fxr attribute or the DOM element that it points to starts with <code>function</code>.
<pre class="prettyprint numlines lang-html">
&lt;div data-fxr-tabs="#tabConfig"&gt;&lt;/div&gt;  
&lt;script type="text/feaxures" id="tabConfig"&gt;
function(element) {
  // do some expensive computation here
  // and then return an object or false
}
&lt;/script&gt;</pre>
                  <p>The function receives the DOM element as the only argument and returns an object or false (when you don't what to apply the feature to that element).</p>
                </li>
              </ol>

              <h2>5. Feaxures events</h2>
              <p>You can attach various callbacks on different events implemented on Feaxures (check out the <a href="example/js/example.js">example.js</a> source code).</p>
              <p>The events available on Feaxures are <code>load</code>, <code>loadError</code>, <code>onAttach</code>, <code>onDetach</code> and the callbacks you assign to each of them will be executed for each feaxure. If you want to attach an event to a specific feaxure you must use the suffix <code>:feaxureName</code> (eg: <code>loadError:tabs</code>)</p>
              <p>Some use cases for events are:</p>
              <ul>
                  <li>Notify the developers when a feaxure is not loaded.</li>
                  <li>Trigger an event in Google Analytics</li>
              </ul>

              <h1>Known issues</h1>
              <ul>
                  <li>
                      <strong>IE load errors</strong>. RequireJS has some has problems detecting load errors in IE (see <a href="http://requirejs.org/docs/api.html#ieloadfail">this explanation</a>).
                      <p>To handle this issue, in the feaxure's <code>attach</code> method check if the rest of the code can work (see the example for the <code>fake</code> feaxure)</p>
                  </li>
              </ul>
        </div>

      </div>

      <?php include('_footer.php');?>


    </div> <!-- /container -->

  </body>
</html>
