I will let you in a little secret: you can feaxurize everything!

While the ability to load files in paralel is one of the greatest aspects of Feaxures, your feaxures doesn't have to depend on files.

In your app, you can have an element like this:
```html
<a href="/cart/add?id=10" data-fxr-ajaxcart="product_id=10"></a>
```

And your feaxure can look like this
```js
myFeaxures.register('ajaxcart', {
	files: [], // look, mom! no files
	attach: function(el, opts) {
		$(el).on('click', function() {
			// make an ajax call
		});
	}
});
```

<div class="alert">Yes, you are correct! You achieve the same with <code>$('body').on('click', 'a.addToCart', function() {})</code></div>