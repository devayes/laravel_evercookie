Evercookie routes for Laravel 4
==================

### Description:
Evercookie is a javascript API available that produces extremely persistent cookies in a browser. Its goal is to identify a client even after they've removed standard cookies, Flash cookies (Local Shared Objects or LSOs), and others. [Read more &raquo;](http://samy.pl/evercookie)

### Requirements:
- [Evercookie](https://github.com/samyk/evercookie)
- [Laravel](http://laravel.com)
- [PHP GD Module with PNG Support](http://www.php.net/manual/en/book.image.php)

### Install:
- Copy contents of *routes.php* into *app/routes.php*
- Install [Evercookie](https://github.com/samyk/evercookie)
- Use the below example, flavor to taste.

### Example:

```javascript
<script src="{{ asset('js/evercookie.js') }}"></script>
<script>
  // See line 147 in evercookie.js for options list.
  var ec = new evercookie({
    history: false, // network intensive
    java: false, // Java applet on/off... may prompt users for permission to run.
    tests: 10,  // 1000 what is it, actually?
    silverlight: false, // you might want to turn it off https://github.com/samyk/evercookie/issues/45
    baseurl: '', // base url mydomain.com/foo = /foo
    asseturi: '/assets', // assets = .fla, .jar, etc
    phpuri: '/ec', // php file path or route
    authPath: false,  // set to false to disable Basic Authentication cache
    pngCookieName: 'ec_png',
    pngPath: '/png',
    etagCookieName: 'ec_etag',
    etagPath: '/etag',
    cacheCookieName: 'ec_cache',
    cachePath: '/cache'
  });
  if (typeof ec.get('example') == 'undefined') {
    ec.set('example', 'Hello.');
  } else {
    ec.get('example', function(response){ 
      console.log(response);
    });
  }
</script>
```

#### Notes:
- If you change cookie names, paths, or `phpuri` you'll need to update the routes.

**All thanks to [Samy Kamkar - Evercookie, never forget.](http://samy.pl/evercookie)**
