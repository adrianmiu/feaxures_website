Read <a href="Basic_feaxure">how to configure a basic feaxure</a> first.

## Default feaxures parameters
Sometimes your application may have set of requirements that must be met. For example, all your tabs in your app must have the "[heightStyle](http://api.jqueryui.com/tabs/#option-heightStyle)" set to "auto".

For these situations you can use the <code>defaults</code> options of the feaxure

```js
myFeaxures.register('tabs', {
	'defaults': {
		heightStyle: "auto"
	},
	'files' : ['/vendor/tabs/tabs.css!css', '/vendor/tabs/tabs.js!js'],
	'attach': function(element, options) {
		$(element).tabs(options);
	}
});
```
What is really awesome about the <code>defaults</code> option is that it can be a <strong>function</strong>. Your defaults may be retrieved from a cookie, a global user preferences object or whatever you can think of (it must be a synchronous operation though).

## Feaxures parameters per element
At this point you may as yourself: "How can I pass parameters to initialize an enhancement for each element?". There are a few ways that give you full flexibility.

### FALSE

To disable applying the enhancement on an element (eg: for testing purposes or whatever) make the data attribute equal to "false"
```html
<div data-fxr-tabs="false">
```

### A query string

If you're confortable writting query strings you can do that
```html
<div data-fxr-tabs="active=1&show=slideDown">
```

### A javascript object

<div class="alert">Be careful with the quotes, though!</div>
```html
<div data-fxr-tabs='{"active":1,"show": "slideDown"}'>
```

### A reference to a container

When your options for a particular enhancement are very big or complex the above options are not enough. You can point to a container if it starts with <code>#</code>
```html
<div data-fxr-tabs="#myTabOptions">
```
And somewhere in the document you can have the following
```html
<script type="text/feaxures" id="myTabOptions">
{
	here: "you",
	can: "have",
	a: function() {
		return "very long";
	},
	javascript: "object",
	not: "necesarily a JSON"
}
</script>
```

You can even have a function that returns an object. The container must start with the word <code>function</code>
```html
<script type="text/feaxures" id="myTabOptions">
function(element) {
	if ($(element).is(':visible')) {
		return {
			my: "very",
			complex: "options"
		};
	}
	return false;
}
</script>
```
Yes, the function receives the <code>element</code> parameter so you can perform some operations.

<div class="alert">Your container has to have a type that is not interpreted by the browser (like <code>text/feaxures</code>, but this is not mandatory).</div>
<div class="alert">If your options container is a function it has to run syncronously. Don't do fancy ajax stuff in there!</div>