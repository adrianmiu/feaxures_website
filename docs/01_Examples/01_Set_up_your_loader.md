## Curl.js

I like using [curl.js](https://github.com/cujojs/curl‎) because it's very small. I think 15kb gzipped will all the plugins (css loader, non-AMD js loader, async loader for google maps).

Although there are many options for configuring curl.js here's the minimum you must do
```js
curl({
  'baseUrl': '/', // where to start looking for files, path relative to your app
  'apiName': 'require' // this will make the curl to be registered as window.require
});
```

## RequireJS

[RequireJS](http://www.requirejs.org) offers lots of options for your files (maps, shims, packages, aliases). The minimum is:
```js
require.config({
    'baseUrl': '/', // where to start looking for files, path relative to your app
});
```

<div class="alert">Each loader has it's own particular look for files, so learn its details.</div>

### Getting it into your head

In the <code>head</code> of your document you should have something like the following
```html
<script src="/vendor/jquery/jquery.js"></script>
<script src="/vendor/curl/curl.js"></script>
<script>
curl({
  'baseUrl': '../js',
  'apiName': 'require'
});
</script>
<script src="/vendor/feaxures/feaxures.js"></script>
<script src="/js/my_feaxures_definitions.js"></script>
```

Niiiice!.... Now, go and [configure your first feaxure](Basic_feaxure)