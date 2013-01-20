<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Feaxures. Progressive enhancement, done right!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="favicon.ico">
  </head>

  <body>

    <div class="container-narrow">

      <?php $section = 'home'; include('_header.php');?>

      <div class="jumbotron">
        <h1>Got Feaxures?</h1>
        <p class="lead">Progressive enhancement, done right!</p>
        <p>
            <a class="btn btn-large btn-warning" href="example/">Check out the example</a>
            <a class="btn btn-large btn-inverse" href="https://github.com/adrianmiu/feaxures/archive/master.zip">Download .zip</a>
            <a href="https://github.com/adrianmiu/feaxures" class="btn btn-success">GitHub</a>
        </p>
      </div>

      <hr>

      <div class="row-fluid marketing">
        <div class="span12">
          <h2>What problem does "Feaxures" solve?</h2>
          <p><a href="http://en.wikipedia.org/wiki/Progressive_enhancement">Progressive enhancement</a> is about adding new layers of functionality  (slideshows, tabs, accordions are examples of such enhancements) to webpage elements according to the capabilities of the user's browser. This means the the only <strong>valid</strong> authority that must dictate what enhancements are to be added to a webpage is... <strong>the browser</strong>.</p>

          <p>Progressive enhacement done right would mean that, since the client (ie: the browser) decides what features (slideshows, tabs, datepickers) are to be added to a page, the client should be in charge of asking for the right javascript and CSS files needed by a feature. But far too often the server is dictating what files to be included.</p>

          <p>Most of the times we include all the files we need in the <code>&lt;head&gt;</code> of a template file, just <em>"in case we need them"</em> and than we forget about them. Other times we <em>"optimize"</em> by concatenating lots of files into fewer files. Be honest, how many times have you included the entire jQuery UI although you only needed one or 2 widgets?</p>

          <p>And that only half of the problem. The advancement of "responsive design" brings a new problem to the table: sometimes you don't want to feature to an element that exists in a specific context (for example you may want to add tabs to a piece of content only for desktops not mobiles). While deciding if that feature should be applied to an element is easy on the client-side, deciding to include the necessary JS/CSS files on the server-side is almost impossible.</p>

          <p><strong>Feaxures</strong> attempts to solve these problems (and <a href="faq.php#other">a few others</a>) by recognizing that any feature that is part of a progressive enhancement strategy has the following charateristics:</p>
          <ul>
            <li><strong>Dependencies</strong>: JS/CSS files that are required by that feature to function.</li>
            <li><strong>Configuration</strong>: a bunch of options that will determine how that feature will behave (eg: the pause interval between slides or the transition effect for a slideshow)</li>
            <li><strong>Instanciation</strong>: the code that is run when the feature is applied to an element. It can be as simple as <code>$(this).tabs();</code> or as complex as you can imagine.
          </ul>

          <h2>Did I caught your attention?</h2>
          <p>If you want to add <strong>Feaxures</strong> to your toolkit, check out the <a href="example/">example</a> and read the <a href="docs.php">documentation</a>. The <a href="faq.php">FAQ</a> page will answer you questions ranging from "why Feaxures?" to "How can I use Feaxures without RequireJS?"</p>

          <p class="alert alert-info">Feaxures JS is MIT licenced... in case you're interested :)</p>
        </div>

      </div>

      <?php include('_footer.php');?>


    </div> <!-- /container -->

  </body>
</html>
