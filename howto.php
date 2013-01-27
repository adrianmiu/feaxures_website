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
      <p>Obviously, once a feaxure is not registered, it remained unregistered. In the example above, if the user rotates its phone and his screen width changes to 640 the feaxure will remain unregistered.</p>

      <h2>How to detach feaxure for mobiles</h2>
      <p>Feaxures cannot be detached. Very few progressive enhancement plugins (eg: jQuery plugins) have a <code>destroy()</code> method.</p>
      <p>But sometimes you may want to detach a feaxure based on the context. For example if a 'tabbed navigation' feaxure is attached when the user's phone is on lanscape-mode and you want to dettach it when it's on portrait mode.</p>
      <pre class="prettyprint linenums lang-js">
feaxures.register('tabs', {
    // rest of the feaxure's configuration goes here
    attach: function(el, options) {
        $(el).tabs(options);
        $(window).on('resize', function(){
            if ($(window).width() < 320) {
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
<pre class="prettyprint linenums lang-js">
$('select').load(pathToFragment, function() {
    feaxures.discover($(this));
});
}</pre>
      <p>This method is not perfect as it injects the HTML fragment into the DOM before it is augmented.</p>
      <p>I plan to introduce the jQuery's Deferred into the attaching of feaxures to make possible to determine when a set of feaxures was done being attached to a DOM element</p>

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
