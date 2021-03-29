# Laravel Package Struture

## Introduction
Another simple, opinionated structure for scaffolding laravel packages

## Setup

1. Install fresh laravel or use an old app
```bash
$ laravel new my-app
```

2. Clone this repo into you application `packages` directory
```bash
$ cd ./my-app
$ mkdir packages
$ cd ./packages
$ git clone https://github.com/isaiahiroko/lvr-stucture [my-package-name]
```

3. Update `./my-app/packages/[my-package-name]/composer.json` to suite your need, especially the following segment.
```json
{
    "name": "[username]/[my-package-name]",
    "version": "0.0.0-dev",
    ...
    "autoload": {
        "psr-4": {
            "[Username]\\[PackageName]\\": "src"
        }
    },
    "extra": {
        "laravel": {
            "providers": [
                "[Username]\\[PackageName]\\ServiceProvider"
            ]
        }
    }
    ...
}
```

4. Update `./my-app/composer.json` with local repository path. This force composer to install your package from your computer and not packagist server
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
$ composer require [username]/lvr-structure
```

5. You can create you services in the package and use them in your app just like any other composer library

## Publish
1. Create a git repo for your package
2. Initialise git at the root of your package `./my-app/packages/[my-package-name]`
3. Commit and push your package to the new git repo
4. Register at https://packagist.org and submit your package repo url
5. You can now `composer require [username]/lvr-structure` from any app

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).