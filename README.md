## This is development version yet so something may don't work

###CakePhp2 plugin that provides an ability of usage Twig template engine

- CakePHP: The Rapid Development Framework for PHP - http://cakephp.org
- Twig, the flexible, fast, and secure template language for PHP http://www.twig-project.org/

#### How to install

* Clone this repository to your plugins directory

```bash
$ cd app/plugins 
$ git clone git://github.com/Dmitry404/CakePhpTwig.git
```

* Add to your AppController this property

```php
public $viewClass = 'CakePhpTwig.Twig';
```

* Create your views with .htm (by default) extension
