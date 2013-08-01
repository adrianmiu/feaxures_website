By default Feaxures uses a lot of jQuery's capabilities. I'm talking here about [Callbacks](http://api.jquery.com/jQuery.Callbacks/‎), [Deferreds](http://api.jquery.com/jQuery.Deferred/‎), event delegation, dom manipulation etc. Also the default loader is <code>window.require</code>. But you can change all that by setting a global object called <code>FeaxuresDependencies</code>

## Use your preferred loader

```js
FeaxuresDependencies.loader = function(files, onSuccess, onError) {
	// write your own implementation or use some other library
};
```
<code>onSuccess</code> and <code>onError</code> are function that are executed when the files are finished loading or if there's an error during loading.

## Hate jQuery?

Here's what your <code>FeaxureDependencies</code> object must contain:

#### Deferred
```js
FeaxuresDependencies.Deferred = DeferredImplementation;
```
Like [when.js](https://github.com/cujojs/when), [rsvp.js](https://github.com/tildeio/rsvp.js) or [tiny promise.js](https://gist.github.com/814052/690a6b41dc8445479676b347f1ed49f4fd0b1637)

### Callbacks
```js
FeaxuresDependencies.EventManager = EventBehaviourImplementation;
```
A functional mixin that alows for <code>on</code>, <code>off</code>, <code>trigger</code> methods. Like the one from my [Callbacks library](https://github.com/adrianmiu/callbacks)

### Selector
```js
FeaxuresDependencies.selector = Sizzle || Ender || Zepto;
```

### Dom manipulation
```js
FeaxuresDependencies.getAttr = function(domElement, attributeName) {
	// write your own implementation
};
FeaxuresDependencies.getData = function(domElement, key) {
	// write your own implementation
};
FeaxuresDependencies.setData = function(domElement, key, value) {
	// write your own implementation
};
```

### Event binding
```js
FeaxuresDependencies.bindEvent = function(domElement, eventName, callback) {
	// write your own implementation
};
FeaxuresDependencies.unbindEvent = function(domElement, eventName, callback) {
	// write your own implementation
};
FeaxuresDependencies.triggerEvent = function(domElement, eventName, data) {
	// write your own implementation
};
```

### Event delegation
If you want to have [lazy loaded feaxures](Lazy_loaded_feaxures) you must have event delegation, otherwise you can leave without
```js
FeaxuresDependencies.delegateEvent = function(domElement, selector, eventName, callback) {
	// write your own implementation
};
FeaxuresDependencies.undelegateEvent = function(domElement, selector, eventName, callback) {
	// write your own implementation
};
```
