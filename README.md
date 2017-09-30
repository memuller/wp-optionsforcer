# OptionsForcer

A Wordpress plugin that allows you to override WP-Options values with your own, specified with global variables. You'll usually want to define those global variables within the `wp-config.php` file.

## Usage

Create a `$wp_options` array within global scope. This array should contain a map of the options you want to override and their values.

For example, in your `wp-config.php`:

```php
$wp_options = [
  'blogname'  => 'TESTING ENV',

];
```
### What's this for?

#### Hard-coded options

Defining a few frequently used options here may slightly increase performance, given that a database lookup won't be necessary for them.

It may also provide a security benefit, given that if the database is compromised and the options changed there, it'll have no effect as they'll be overridden by this plugin.

#### Environment-specific options

You can use this to define a few options that have environment-specific values. This is great for staging and development.

Specifically, this may allow you to load a database dump straight from production into other envs; overriding the options as needed so that it works.

## Installation

It's recommended to install this plugin in the `wp-content/mu-plugins` directory. Plugins there will be **loaded automatically**; so you won't need to enable it at the admin.

Create the `mu-plugins` folder if it doesn't exist, and move the `optionsforcer.php` file there. _Move the file, not the director; as the mu-plugins folder does not load plugins that uses folders._

Alternatively, just move the folder to your _plugins_ folder and enable the plugin, as usual.

## Todo

* use pre-get-option hook instead; to avoid hitting the database.
* multisite mode: array w/ site ids
* find a way to override _bloghome_ and _siteurl_ without breaking database connection
