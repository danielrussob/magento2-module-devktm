# DNAFactory DevKTM
## Magento 2 Code Generator and other stuff

### Install

`composer require --dev dnafactory/module-devktm`

`bin/magento setup:upgrade`
`bin/magento cache:clean`

### About DevKTM [Alpha Version]

Written for Magento >= 2.3
Default path are app/code but if module are installed, with VendorName_ModuleName syntax KTM will place generated code in base path of given module

### Ask for a meaning of life

`bin/magento dna:meaning-of-life`

and nothing else...

### Clean magento 2 folders

`bin/magento dna:clean:all-folders`
`bin/magento dna:clean:generated-folders`
`bin/magento dna:clean:static-folders`
`bin/magento dna:clean:var-folders`

According to: https://devdocs.magento.com/guides/v2.3/howdoi/php/php_clear-dirs.html

### Shortcode for deploy dev

`bin/magento dna:deploy:slow-coffee`

Shortcode for 
    dna:clean:all-folders + setup:upgrade + setup:di:compilec + cache:flush + dev:source-theme:deploy

### Generate a magento 2 module

`bin/magento dna:make:module VendorName_ModuleName`

eg.: bin/magento dna:make:module DNAFactory_Module001

### Generate a Command

`bin/magento dna:make:command VendorName_ModuleName`

eg.: 

bin/magento dna:make:command DNAFactory_Module001
FooCommand => DNAFactory\Module001\Command\FooCommand

eg.: 

bin/magento dna:make:command DNAFactory_Module001
Foo\BarCommand => DNAFactory\Module001\Command\Foo\BarCommand

... and so on!

### Generate an Observer

`bin/magento dna:make:observer VendorName_ModuleName`

eg.: 

bin/magento dna:make:observer DNAFactory_Module001
FooObserver => DNAFactory\Module001\Observer\FooObserver

eg.: 

bin/magento dna:make:observer DNAFactory_Module001
Foo\BarObserver => DNAFactory\Module001\Observer\Foo\BarObserver

... and so on!

### Generate a Data Object

`bin/magento dna:make:data-object VendorName_ModuleName`

eg.: 

bin/magento dna:make:data-object DNAFactory_Module001
Foo => DNAFactory\Module001\Api\Data\FooInterface
        DNAFactory\Module001\Data\Foo

eg.: 

bin/magento dna:make:data-object DNAFactory_Module001
Foo\Bar => DNAFactory\Module001\Api\Data\Foo\BarInterface
        DNAFactory\Module001\Data\Foo\Bar

... and so on!

### Generate a Db Schema (table in database)

`bin/magento dna:make:db-schema VendorName_ModuleName`

Insert a table name and nothing else

### Generate a Seeder (class that put stuff in table)

`bin/magento dna:make:seeder VendorName_ModuleName`

Insert a seeder name and nothing else

### Generate a Data Patch (class that modify stuff in database)

`bin/magento dna:make:data-patch VendorName_ModuleName`

Insert a data patch name and nothing else

### Generate a Management (or generic service)

`bin/magento dna:make:management VendorName_ModuleName`

Insert a Management name and nothing else

### Generate a Configuration

`bin/magento dna:make:configuration VendorName_ModuleName`

Insert a Configuration name and nothing else

Plus: service contrat + acl + config.xml
