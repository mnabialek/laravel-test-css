## Laravel test CSS

This package allows you to easily add custom CSS style when running PhpUnit tests. This is especially useful when running Laravel Dusk tests when you use remote fonts (for example from Google) and your screenshots will contain blank space instead of font in case of failure. You can also hide some elements if they are not needed for site functionality and you don't want to display them on screenshots when running Dusk tests.

### Installation
 
1. Run
   ```php   
   composer require mnabialek/laravel-test-css --dev
   ```
   
   in console to install this module (Notice `--dev` flag - it's recommended to use this package only for development). 
 
2. If you use Laravel < 5.5 open `config/app.php` and in `providers` section add:
 
   ```php
   Mnabialek\LaravelTestCss\Providers\LaravelTestCss::class,
   ```
     
   Laravel 5.5 and later uses Package Auto-Discovery and it will automatically load this service provider so you don't need to add anything into above file.
    
3. **Optional step:** If you need to adjust style rule you can add `LARAVEL_TEST_CSS_STYLE=` in your `.env` file or publish configuration file. By default style rule looks like this:

   ```css
   html * { font-family: sans-serif !important; }
   ```
   
   so default font will be used for all HTML elements to display valid texts when running Laravel Dusk tests and taking screenshots in case of failure

### Usage
   
This package will automatically add custom styles just before `</head>` HTMl tag. Be aware this package add stylesheets only when environment is set to `testing` and when response is in `text/html` format.   