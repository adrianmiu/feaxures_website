You want responsiveness with that? Gotcha!

Imagine that the user started browsing your website having the phone in landscape mode and changed its mind. Your manager is the user and he wants to disable the tabs when that happen. So you need to be able to say to Feaxures the following command:

<blockquote>apply the tabs feaxure ONLY when the screen width is above 400 pixels, disable it otherwise</blockquote>.

This is easier done than said:
```js
myFeaxures.register('tabs', {
	'files' : ['/vendor/tabs/tabs.css!css', '/vendor/tabs/tabs.js!js'],
	'attach': function(element, options) {
		$(element).tabs(options);
	},
	'attachCondition': function(element) {
		return $(window).width() > 400;
	},
	'detach': function(element) {
		$(element).tabs("destroy");
	}
}
});
```
<div class="alert">This works for the tabs widget because the jQuery UI library allows for this possibility. Your particular tabs library may not have this option</div>