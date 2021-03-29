# Lvr Struture

## Introduction
A simple, opinionated structure for scaffolding laravel packages

## Setup

1. Install fresh laravel or use and old app
```bash
$ laravel new my-app
```

2. Clone this repo
```bash
$ cd ./my-app
$ mkdir packages
$ cd ./packages
$ git clone https://github.com/isaiahiroko/lvr-stucture [my-package-name]
```

3. Update `./my-app/packages/[my-package-name]/composer.json` to suite your need, especially the following segment.
```json
{
    "name": "isaiahiroko/lvr-structure", // Your package would be installed using: composer require isaiahiroko/lvr-structure
    "version": "0.0.0-dev",
    ...
    "autoload": {
        "psr-4": {
            "Isaiahiroko\\Structure\\": "src" // This configures the namespace to your package as: Isaiahiroko/Structure/...
        }
    },
    "extra": {
        "laravel": {
            "providers": [
                "Isaiahiroko\\Structure\\ServiceProvider" // Autoload service provider, remove if you choose not to autoload service provider
            ]
        }
    }
    ...
}
```

4. Update ./my-app/composer.json with local repository path. This force composer to install your package from your computer and not the packagist server
```json
    ...
    "repositories": [
        {
            "type": "path",
            "url": "./packages/*",
            "options": {
                "symlink": true
            }
        }
    ], 
    ...
``` 

4. Install the package to make it available to your app
```bash
$ composer require isaiahiroko/lvr-structure
```

5. You can create you services in the package and use them in your app just like any other composer library

## Installation (Manual)
```
// Create a new laravel project
$ laravel new [packageName]

// Move to app directory
$ cd ./[packageName]

// Create package directory
$ mkdir [username] // usualy github user name

// Move to package user directory
$ cd [username]

$ git clone https://github.com/Isaiahiroko/lvr-structure [packageName]
```

## Setup
Update package composer.json 
```
// update the official package name
"name": "[username]/[packageName]",
```

Update root composer.json 
```
// so that the package is autoloaded when you need to test
"psr-4": {
    "App\\": "app/",
    "[Username]\\[PackageName]\\": "packages/[username]/[packageName]/src/"
},
```

## Customize
Run a search and replace in the package directory for the following:

```
isaiahiroko => [username]
Isaiahiroko => [Username]
structure => [packageName]
Structure => [PackageName]
```

Rename files:
```
- Controllers\Api\Struture => 
- Controllers\Web\Struture => 
- Controllers\Api\Struture
```

## Available commands
```
// Publish assets
$ php artisan vendor:publish --tag=[Username]\[PackageName]\[PackageName]ServiceProvider  

// Or Init Package
$ php artisan [packageName]:install
```

## [License](./LICENSE.md)
