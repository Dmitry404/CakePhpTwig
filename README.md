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

### Simple example of usage

* layout (View/Layouts/default.htm)

```html
<html>
<head>
    {{ Html.charset() }}
    <title>{% block title %}{% endblock %}</title>

    {{ Html.css('cake.generic') }}

    {% block scripts %}{% endblock %}
</head>
<body>
    <div id="container">
        <div id="header">
            <h1>Test Page</h1>
        </div>
        <div id="content">
            {% block content %}{% endblock %}
        </div>
        <div id="footer"></div>
    </div>
</body>
</html>
```

* any view file (for example View/Pages/index.htm)

```html
{% extends "/View/Layouts/default.htm" %}

{% block scripts %}
  <script>
    console.log('hello console');
  </script>
{% endblock %}

{% block content %}
    <span class="notice">
        Hello World
    </span>
{% endblock %}
```