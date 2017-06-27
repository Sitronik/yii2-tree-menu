yii2-tree-menu
=================

![Treemenu](/screenshots/02.png?raw=true)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require sitronik/yii2-tree-menu "@dev"
```

or add

```
"sitronik/yii2-tree-menu": "@dev"
```

to the ```require``` section of your `composer.json` file.

## Usage

### Step 1: Prepare Database

Create your database table to store the tree structure. You can do it in this way:

#### Run DB Migrations

You can run the migrations script provided to create the database structure from your yii programming console:

```
php yii migrate/up --migrationPath=@vendor/sitronik/yii2-tree-menu/migrations
```

### Step 2: Setup Module

Configure the module named `treemenu` in the modules section of your Yii configuration file.

```php
'modules' => [
   'treemenu' =>  [
        'class' => 'sitronik\treemenu\Module',
    ]
]
```

### Step 3: Using Tree Widget

In your view files, you can now use the tree widget directly to manage tree data as shown below:

```php
echo sitronik\treemenu\Tree::widget();
```

### Step 4: Manage Tree Widget

Go to `/treemenu` and manage your tree

![Manage Tree](/screenshots/01.png?raw=true)

## License

**yii2-tree-menu** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.