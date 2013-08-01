Let's imagine your application contains 
1. a set of thumbnails that, <strong>when clicked</strong>, must open a bigger version of the file in a pop-up.
2. an input field that, <strong>when focused</strong>, opens a datepicker widget
3. an image that, <strong>when hovered</strong>, shows a magnifying glass.
The question is:
<blockquote>Do you need to load the lightbox, datepicker and zoom-in files before the user performs those actions?</blockquote>

Yes, the correct answer is <strong>No</strong>!

```js
myFeaxures.register('datepicker', {
	'attachEvent': 'focus'
	'files' : ['/vendor/datepicker/datepicker.css!css', '/vendor/datepicker/datepicker.js!js'],
	'attach': function(element, options) {
		$(element).datepicker(options);
	}
});
```

Other options for the <code>attachEvent</code> attribute are, as you probably have guessed, <strong>click</strong> and <strong>hover</strong>. The default value is <strong>domReady</strong>.

### Are you a control freak?
If you want to decide exactly (to the milisecond) when an enhancement should be applied to an element you can do that too.

```js
myFeaxures._attachToElement('datepicker', $('#my-birth-date'));
```
This will load the files, check if the element is a viable candidate for the enhancement and, most likely, nourish your god complex.