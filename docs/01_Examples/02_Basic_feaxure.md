One of the simplest progressive enhancement is a tabs widget. I will use the example from the [jQuery UI page](http://jqueryui.com/tabs/)

```html
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Nunc tincidunt</a></li>
    <li><a href="#tabs-2">Proin dolor</a></li>
    <li><a href="#tabs-3">Aenean lacinia</a></li>
  </ul>
  <div id="tabs-1">
    <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. ...</p>
  </div>
  <div id="tabs-2">
    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. ...</p>
  </div>
  <div id="tabs-3">
    <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. ...</p>
  </div>
</div>
```

Your application will have a "main" script file. Here you'll put the following code to initialize Feaxures JS.

```js
var myFeaxures = new Feaxures();
myFeaxures.register(
	// the name of the feaxure
	// will be used to identify which elements are candidate for enhancement
	'tabs',

	// options for the feaxure
	{
		// the files to be loaded in order to apply this enhancement on elements
		'files' : ['/vendor/tabs/tabs.css!css', '/vendor/tabs/tabs.js!js'],

		// the function that will apply this feaxure onto an element
		// must receive the 'element' and 'options' parameter
		'attach': function(element, options) {
			$(element).tabs(options);
		}
	});
```

After the feaxure is configured you must only one change to your HTML.

```html
<!--- replace this line-->
<div id="tabs">
<!-- with this line -->
<div id="tabs" data-fxr-tabs="">
```

That's it! A few notes though:

* the format in which you provide the files must be compatible with your loader (<a href="Set_up_your_loader">more here</a>).
* the function for attaching an feaxure onto an element can take only 2 parameters: the element and the options for initializing the feaxure.

As you can see the element now has the <code>data-fxr-tabs</code> attribute with is obtained by adding the name of the feaxure to the <code>data-fxr-</code> prefix. This is how all feaxures are treated so make sure you <strong>do not use spaces in your feaxure's name</strong>.

Learn the ways you can tell Feaxures <a href="Element_options">how to customize a particular enhancement</a>.