

## Progressive enhancement? Done!

Progressive enhancement is about adding new layers of functionality (slideshows, tabs, accordions are examples of such enhancements) to webpage elements <em>according to the capabilities of the user's browser</em>. This means the the only valid authority that must dictate what enhancements are to be added to a webpage is... <strong>the browser</strong>.

A "<em>Progressive enhacement done right</em>" solution must acknowledge that the browser's capabilities (canvas support, CSS3 support, screen width etc) dictates what enhancements can be added to elements on a page. Thus, the decision about what resources (CSS/JS files) to be loaded for enhancing a page should be happen in... <strong>the browser</strong>.

Too many times, though, we include all the files we need in the <code>&lt;head&gt;</code> of a template file, just "in case we need them" and then we forget about them. Other times we "optimize" by concatenating lots of files into fewer files. Be honest, how many times have you included the entire jQuery UI in all your website although you only needed the datepicker in a page and the tabs functionality in another?

And that only half of the problem. The advancement of "responsive design" brings a new problem to the table: under certain conditions you may want to enable/disable some enhancements (for example you want to have a tabs-widget for mobiles on landscape-mode and revert it when the mobile is in portrait-mode). 

While deciding if that enhancement should be applied to an element is easy on the client-side, deciding to include the necessary JS/CSS files on the server-side is almost impossible. So, even if you manage to do progressive enhancement, the right way, on the client side you are still left with a bunch of files loaded for no reason.

## Demos

Check out the full featured [demo page](/demos). And if you want to fell in love, look at the source code.

## Examples

The pages below contain examples of code for using Feaxures
* [Setting up your loader](Examples/Set_up_your_loader) - example for curljs and RequireJS
* [The simplest feaxure](Examples/Basic_feaxure) - minimal implementation of a feaxure
* [Options for enhancing elements](Examples/Element_options) - options for customizing the enhancements
* [Active feaxures](Examples/Active_feaxures) - feaxures that are enable/disabled automatically
* [Lazy loaded feaxures](Examples/Lazy_loaded_feaxures) - feaxures that are activated upon user action (click, hover)
* [Custom Feaxures implementation](Examples/Custom_Feaxures_implementation) - how to use Feaxures without curljs or jQuery
