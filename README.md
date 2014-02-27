Literate Routes Builder
---

This package allows you to write Literate routes files for Laravel and build them using an artisan command.

Installation
===

To install this package require `"rtablada/literate-routes": "dev-master"`.
Then add `'Rtablada\LiterateRoutes\LiterateRoutesServiceProvider'` to your `app/config/app.php` file.

Use
===

To write literate PHP files, you need to need to create files with the extension `.php.md` or `.litphp`.
Then when you want to compile your literate PHP files, run `php artisan literate:build`.

Literate PHP Syntax
===

For the most part, Literate PHP is just markdown files allowing you to write user stories, to do lists, and more.

Then code blocks are parsed into PHP.
Currently, Literate PHP only supports a blade-like syntax for defining routes and comments.

### Routes

Routes can be defined using the following syntax:

```
	@get('item', 'ItemsController@index')
```

And will output:

```
Route::get('item', 'ItemsController@index');
```

### Comments

Comments can be included by using markdown H1 tags using the following syntax:

```
# Items
```

And will output:

```
// Items
```

## Bleeding Edge Syntax

This syntax isn't quite tested as strongly.

### Setting Variables

The parser will keep up with a set controller and namespace to use when creating shorthand routes.
To take advantage of this, use the syntax:

```
@setController('Items', 'items')
```

### Auto Variables

When you create comment block from above, we will use the comment string to set the controller and namespace automatically.
So to recreate the `setController` from above, just use the following:

```
# Items
```

### Shorthand Routes

To quickly create routes use the following syntax:

```
	get-> 'test', 'index'
```

And this will create:

```
Route::get('test', array('uses' => 'Items@index', 'as' => 'items.index'));
```
