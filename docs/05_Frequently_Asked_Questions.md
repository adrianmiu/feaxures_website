* <a href="#why">Why Feaxures?</a>
* <a href="#other">What other problems does Feaxures solve?</a>
* <a href="#fouc">What about <abbr title="Flash Of Unstyled Content">FOUC</abbr>?</a>
* <a href="#no-jquery">What if I don't use jQuery?</a>
* <a href="#loaders">What loaders should I use?</a>
* <a href="#performance">What is the performance hit when using Feaxures?</a>
* <a href="#website">Why doesn't this page uses Feaxures?</a>
* <a href="#roadmap">What's on the roadmap?</a>


<h2 id="why">Why <em>Feaxures</em>?</h2>
<em>Feaxure</em> is a combination of <em>Feature</em> and <em><a href="http://en.wikipedia.org/wiki/Test_fixture">Fixture</a></em> which means "the fixed state used as a baseline" (with respect to unit testing). Plus, finding a domain these days is tough and when you find a name that has a domain name that is available you should stick with it. :) 

<h2 id="other">What other problems does Feaxures solve?</h2>
Besides placing the "progressive enhancement" responsibility to the browser, Feaxures can help with:

* <strong>Don't Repeat Yourself</strong>. Defining a feaxure is very easy and it takes very little space (99.99% of the time) and most of the times you're using the same libraries/plugins to enhance a page. This means that you can build a collection of feaxures, put all the required files in a folder that you copy from a project to the next and you're done. No more typing hundreds of times the <code>script</code> tag and <code>domReady</code> events. 
* <strong>Refactoring</strong>. By placing the feature's definition into an external file it means you only need to make one change for an entire project. Imagine you've been using jQuery UI tabs in many places in your app and you want to optimize by using a smaller plugin. Instead of going back to dozens of files to replace the <code>&lt;script&gt;</code> tags you only go to one place. Of course, each plugin may use different configuration options but you can convert from one set of options into another one right on your feaxures' definition file.
* <strong>A/B Testing</strong>. You can decide what features to be active on your feaxures' definition file. For example you can choose to test user's satisfaction for an ecommerce website by comparing a lightbox versus a magnifying glass as methods for viewing product details.
* <strong>AHAH</strong> (Asynchronous HTML over HTTP). Many times you're loading pieces of HTML content only when users performs an action (ie: load the content of a tab when the user clicks on a tab). That piece of HTML may contain elements that have features as well. If that's the case you would need to load those files in advance although the user might not ever view that tab.


<h2 id="fouc">What about <abbr title="Flash Of Unstyled Content">FOUC</abbr>?</h2>
Loading resources after the DOM is ready (eg: load <code>jquery.ui.tabs</code> after the page is displayed to the user) will definitely cause a <a href="http://www.bluerobot.com/web/css/fouc.asp/">flash of unstyled content</a>. This can be aleviated using different techniques, like <a href="http://www.learningjquery.com/2008/10/1-way-to-avoid-the-flash-of-unstyled-content">this one</a>. That's why Feaxures doesn't come with one but you can find an implementation on the <a href="example/">example</a>.

<h2 id="no-jquery">What if I don't use jQuery?</h2>
Feaxure's dependency on jQuery is abstracted away and you can replace the parts that depend on jQuery. The library works with Zepto to some extend but there are some limitations due to Zepto's <code>data()</code> implementation, which uses the <code>data-</code> attribute. I'm using this functionality to store which elements are enhanced or not. 

You can <a href="Examples/Custom_Feaxures_implementation">customize the Feaxures dependencies</a> to your liking so you're not required to use jQuery.

<h2 id="loaders">What loaders should I use?</h2>
In my projects I use <a href="https://github.com/cujojs/curl">curl.js</a> because of its small size. I've tested the library agains <a href="http://www.requirejs.org/">RequireJS</a> as well. For RequireJS you need to include the proper modules to load JS and CSS file. While RequireJS was build initially as an AMD loader, curl.js was build from get-go as a resource loader (curl stands for CUJO Resource Loader).

If you're using another resource loader all you need to <a href="Examples/Custom_Feaxures_implementation">customize your dependencies</a>. 

<h2 id="performance">What is the performance hit when using Feaxures?</h2>
Obviously Feaxures JS will take its toll with regard to performance but I think the advantages are bigger than the performance hit. I did a simple speed test (available on the Git repository) and there's a <strong>50 milliseconds</strong> delay when using Feaxures. Some of it is due to the loader's dependency solving. 

<h2 id="roadmap">What's on the roadmap?</h2>
I've tried to cover most of the use-cases with this script but there is at least one case that is not handled well by this script. For example if a user changes the orientation of her tablet from portrait to landscape your design may not require some feature to be active.
Other stuff that needs to be done include: improving the documentation, adding more examples and some new features... not feaxures :).
