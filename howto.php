<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Feaxures How to</title>
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

      <?php $section = 'howto'; include('_header.php');?>

      <h1>How to use Feaxures</h1>

      <hr>

      <h2>How to disable a feaxure for mobiles</h2>
      <p>For example you would not want to activate a 'tabbed navigation' feature for mobiles phones.The best way is not to register the feaxure for screens bellow a certain width.</p>
      <pre class="prettyprint linenums lang-js">
if ($(window).width() > 400) {
    feaxures.register('tabs', {
        // feature's configuration here
    })
}</pre>
      <p>You can also use <a href="http://modernizr.com">Modernizr</a>'s tests to check when to load certain feaxures.</p>
      <p>Once a feaxure is not registered, it remained unregistered. In the example above, if the user rotates its phone and his screen width changes to 640 the feaxure will remain unregistered, thus not accesible to the feaxures instance.</p>

      <h2>How to detach feaxure for mobiles</h2>
      <p>Feaxures cannot be detached (at least not yet). Very few progressive enhancement plugins (eg: jQuery plugins) have a <code>destroy()</code> method.</p>
      <p>But sometimes you may want to detach a feaxure based on the context. For example if a 'tabbed navigation' feaxure is attached when the user's phone is on lanscape-mode and you want to dettach it when it's on portrait mode.</p>
      <pre class="prettyprint linenums lang-js">
feaxures.register('tabs', {
    // rest of the feaxure's configuration goes here
    attach: function(el, options) {
        $(el).tabs(options);
        $(window).on('resize', function(){
            if ($(window).width() &lt; 320) {
                $(el).tabs('destroy');
            } else {
                // in case the feaxure is detached you may want to attach it again
                $(el).tabs(options);
            }
        });
    }
});</pre>
      <p><span class="label label-warning">Warning!</span> The code above is for demonstration purposes only as it is prone to memory leaks. If you remove the said element from the DOM that event callback will still be there.</p>
      <p>I will find a better solution for these scenarios. That's a <code>$.Deferred</code> promise ;)</p>

      <h2>How to augment an HTML fragment loaded using AHAH</h2>
      <p>Probably your application/website is using the jQuery's <code>load()</code> method to inject HTML from other sources. This method is pretty good as it detects the scripts and tries to load them and execute them in order. But if you're using Feaxures for progressive enhancement you'll want to ditch the "old way" of doing it.</p>
      <p>Since the resources are loaded asyncronously (most of the times) Feaxures returns promises for almost all methods (like <code>load()</code> or <code>attach()</code>). This way you can create your function that returns an already enhanced HTML fragment</p>
<pre class="prettyprint linenums lang-js">
var loadEnhanceAndInject = function(url, selector) {
  $('&lt;div style="height: 0;" /&gt;').appendTo('body').load(url, function() {
    var self = this,
        fxrPromise = feaxures.discover($(this));
    fxrPromise.done(function() {
      $(self).children().fadeIn('slow').appendTo($(selector).empty());
    });
  });
}</pre>
      <p>This is not the only way to do it and you have to test your plugins/libraries for any possible "malfunctioning". I have attempted different methods for asyncronously loading and enhancing HTML fragments before injecting them into the DOM not all of them worked. For example, for the jQuery UI's accordion widget, there were issues with the accordion panels height due to the fact that the augmentation happens in an element detached from the DOM (or hidden).</p>

      <h2>How to load a feaxure that is not bound to a particular element</h2>
      <p>The easiest way would be to add a tag to your HTML that would trigger that feaxure to be loaded. This way you would know where that feaxure came from just by looking at your source code.</p>
      <p>Another way is to do this is to attach the feaxure on a non-DOM element like so.</p>
<pre class="prettyprint linenums lang-js">
feaxures.attach('whatever', $('&lt;div /&gt;'));</pre>
      <p><span class="label label-warning">Warning!</span> You have to make sure that the <code>attach</code> property of the feaxure will not depend on the existence of a DOM element.</p>

      <h2>How to load a feaxure and execute a callback</h2>
      <p>Sometimes you may want to programmatically load a feaxure and execute a callback when the feaxure's files are loaded.</p>
      <p>The <code>Feaxures.load()</code> method returns a <a href="http://api.jquery.com/category/deferred-object/">jQuery promise</a> so you can use that to your advantage.</p>
<pre class="prettyprint linenums lang-js">
// at this point the feaxure is registered 
feaxures.load('tabs').done(function() {
    console.log('I manually loaded the "tabs" feaxure');
});</pre>
      <p>Obviously you can attach a callback to the <code>fail()</code> method of the promise.</p>
      <p>If you just want to execute a callback when a feaxure is loaded you can leverage the <code>events</code></p>
<pre class="prettyprint linenums lang-js">
feaxures.on('load', function(feature) {
    console.log('The feaxure named "' + feature + '" was loaded');
});</pre>


      <?php include('_footer.php');?>


    </div> <!-- /container -->

  </body>
</html>
