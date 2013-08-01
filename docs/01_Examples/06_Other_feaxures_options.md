WTF, can Feaxures do more than this? Of course! Here are the other options that you can use for your feaxures:

### autoLoad

Assuming you know an enhancement is very used you dan auto-load it (so you don't have to write <code>script</code>s in the <code>head</code>)
```js
myFeaxures.register('tabs', {
	'autoLoad: true,
	'files' : ['/vendor/tabs/tabs.css!css', '/vendor/tabs/tabs.js!js'],
	'attach': function(element, options) {
		$(element).tabs(options);
	}
});
```

### selector

Do you worry about the performance of the <code>[data-fxr-tabs]</code> selector? Use a class based selector instead
```js
myFeaxures.register('tabs', {
	'selector': '.tabs',
	'files' : ['/vendor/tabs/tabs.css!css', '/vendor/tabs/tabs.js!js'],
	'attach': function(element, options) {
		$(element).tabs(options);
	}
});
```
<div class="alert">The <code>data-fxr-tabs</code> attribute must be there as well.</div>

## Event callbacks

### onLoad

```js
myFeaxures.register('tabs', {
	'onLoad': function(data) {
		// the feaxures files were loaded, maybe some parts of the application
		// must be notified about this
	},
	'files' : ['/vendor/tabs/tabs.css!css', '/vendor/tabs/tabs.js!js'],
	'attach': function(element, options) {
		$(element).tabs(options);
	}
});
```

### onLoadError

```js
myFeaxures.register('tabs', {
	'onLoadError': function(data) {
		// send a message to the webmaster. some files are probably missing
	},
	'files' : ['/vendor/tabs/tabs.css!css', '/vendor/tabs/tabs.js!js'],
	'attach': function(element, options) {
		$(element).tabs(options);
	}
});
```

The <code>data</code> sent to the <strong>onLoad</strong> and <strong>onLoadError</strong> events is an object
```js
{
	feature: "tabs"
}
```

### onAttach

```js
myFeaxures.register('tabs', {
	'onAttach': function(data) {
		// tell Google Analytics that users are using this feaxure
	},
	'files' : ['/vendor/tabs/tabs.css!css', '/vendor/tabs/tabs.js!js'],
	'attach': function(element, options) {
		$(element).tabs(options);
	}
});
```

The <code>data</code> sent to this event contains the <strong>element</strong> and <strong>options</strong> used for the initialization.
```js
{
	feature: "tabs",
	element: domElementHere,
	options: {
		the: 'computed options for this element',
	}
}
```

### onDetach

```js
myFeaxures.register('tabs', {
	'onDetach': function(data) {
		// tell Google Analytics that users have done something
		// that resulting in the feaxure being removed
	},
	'files' : ['/vendor/tabs/tabs.css!css', '/vendor/tabs/tabs.js!js'],
	'attach': function(element, options) {
		$(element).tabs(options);
	}
});
```
## Tired of writting all those callbacks?
I feel you, bro/sis! Here's what you can do:
```js
myFeaxures.on('load', function(data){
	// do whatever you want here
});
```
The same goes for the <strong>loadError</strong>, <strong>attach</strong>, <strong>detach</strong> events.

