<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Frequenly Asked Questions. Feaxures.</title>
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

      <?php $section = 'faq'; include('_header.php');?>

      <h1>Frequenly Asked Questions</h1>

      <hr>

      <div class="row-fluid marketing">
        <div class="span12">
          <ol>
            <li><a href="#why">Why Feaxures?</a></li>
            <li><a href="#other">What other problems does Feaxures solve?</a></li>
            <li><a href="#fouc">What about <abbr title="Flash Of Unstyled Content">FOUC</abbr>?</a></li>
            <li><a href="#no-jquery">What if I don't use jQuery?</a></li>
            <li><a href="#no-requirejs">What if I don't use RequireJS?</a></li>
            <li><a href="#website">Why doesn't this page uses Feaxures?</a></li>
            <li><a href="#roadmap">What's on the roadmap?</a></li>
          </ol>
          <h2 id="why">Why <em>Feaxures</em>?</h2>
          <p><em>Feaxure</em> is a combination of <em>Feature</em> and <em><a href="http://en.wikipedia.org/wiki/Test_fixture">Fixture</a></em> which means "the fixed state used as a baseline" (with respect to unit testing). Plus, finding a domain these days is tough and when you find a name that has a domain name that is available you should stick with it. :) </p>

          <h2 id="other">What other problems does Feaxures solve?</h2>
          <p>Besides placing the "progressive enhancement" responsibility to the browser, Feaxures can help with:</p>
          <ul>
            <li><strong>Don't Repeat Yourself</strong>. Defining a feaxure is very easy and it takes very little space (99.99% of the time) and most of the times you're using the same libraries/plugins to enhance a page. This means that you can build a collection of feaxures, put all the required files in a folder that you copy from a project to the next and you're done. No more typing hundreds of times the <code>script</code> tag and <code>domReady</code> events. </li>
            <li><strong>Responsive design</strong>. While making a webpage look good when you're resizing the browser window might impress the customer and land you the contract, that's only the tip of the iceberg. You definetely don't need to load a tooltip plugin for tablets and you probably don't need to load a lightbox plugin for smartphones. And if the user doesn't need it you should not load the files. <strong>Feaxures</strong> allows you to create the markup that is susceptible to enhancement but only apply the enhancement if the context requires it.</li>
            <li><strong>Refactoring</strong>. By placing the feature's definition into an external file it means you only need to make on change for an entire project. Imagine you've been using jQuery UI tabs in many places in your app and you want to optimize by using a smaller plugin. Instead of going back to dozens of files to replace the <code>&lt;script&gt;</code> tags you only go to one place. Of course, each plugin may use different configuration options but you can convert from one set of options into another one right on your feaxures' definition file.</li>
            <li><strong>A/B Testing</strong>. You can decide what features to be active on your feaxures' definition file. For example you can choose to test user's satisfaction for an ecommerce website by comparing a lightbox versus a magnifying glass as methods for viewing product details.</li>
            <li><strong>AHAH</strong> (Asynchronous HTML over HTTP). Many times you're loading pieces of HTML content only when users performs an action (ie: load the content of a tab when the user clicks on a tab). That piece of HTML may contain elements that have features as well. If that's the case you would need to load those files in advance although the user might not ever view that tab.</li>
          </ul>

          <h2 id="fouc">What about <abbr title="Flash Of Unstyled Content">FOUC</abbr>?</h2>
          <p>Loading resources after the DOM is ready (eg: load <code>jquery.ui.tabs</code> after the page is displayed to the user) will definetely cause a <a href="http://www.bluerobot.com/web/css/fouc.asp/">flash of unstyled content</a>. This can be aleviated using different techniques, like <a href="http://www.learningjquery.com/2008/10/1-way-to-avoid-the-flash-of-unstyled-content">this one</a>. That's why Feaxures doesn't come with one but you can find an implementation on the <a href="example/">example</a>.</p>

          <h2 id="no-jquery">What if I don't use jQuery?</h2>
          <p>The script is very much dependent on jQuery and I don't plan to create a non-jQuery version any time soon. You can use Zepto for mobiles though.</p>

          <h2 id="no-requirejs">What if I don't use RequireJS?</h2>
          <p><a href="http://www.requirejs.org/">RequireJS</a> is used to handle the process of loading asyncronously the JS/CSS files. It also helps with managing the depencies. For example if the <code>jquery.ui.tabs.js</code> file is dependent on <code>jquery.ui.widget.js</code> file, RequireJS will load that file first, assuming you have configured it properly using the <code>shim</code> option. </p>
          <p>When I started this project I used <a href="https://github.com/cujojs/curl">curl.js</a>, an amazing resource loaded which doesn't require you to define depencies as you can force the loaded scripts to be executed in a specific order (although they may be loaded in a different order). But because I couldn't make it work with Google Maps I decided to use RequireJS instead. In some respects <strong>curljs</strong> would be a better choice for Feaxures for loading resources (because it loads the files asyncronously and executes them in order) and I think I might create a version of the script that depends on curljs.</p>
          <p>After some investigation I found out a solution using the <code>async</code> plugin from RequireJS. I've implemented this solution in the <a href="example/curl">example using curl.js</a> page.</p>
          <p>If you're using another resource loader all you need to do to replace the RequireJS dependency is to replace the <code>_load()</code> function with your own. The implementation is as follows:</p>
          <pre class="prettyprint linenums lang-js">
_load = function(arrayOfFiles, callbackForWhenFilesAreLoaded, callbackForWhenThereAreErrorsWhileLoadingTheFiles) {
    /* your implementation goes here */
};</pre>

          <h2 id="website">Why doesn't this website use Feaxures?</h2>
          <p>Because I'm lazy. The same reason I've build Feaxures. Isn't it ironic?</p>

          <h2 id="roadmap">What's on the roadmap?</h2>
          <p>I've tried to cover most of the use-cases with this script but there is at least one case that is not handled well by this script. For example if a user changes the orientation of her tablet from portrait to landscape your design may not require some feature to be active.</p>
          <p>Other stuff that needs to be done include: improving the documentation, adding more examples and some new features... not feaxures :).</p>
        </div>

      </div>

      <?php include('_footer.php');?>


    </div> <!-- /container -->

  </body>
</html>
