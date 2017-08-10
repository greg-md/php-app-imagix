# PHP App Imagix

[![StyleCI](https://styleci.io/repos/99412510/shield?style=flat)](https://styleci.io/repos/99412510)
[![Build Status](https://travis-ci.org/greg-md/php-app-imagix.svg)](https://travis-ci.org/greg-md/php-app-imagix)
[![Total Downloads](https://poser.pugx.org/greg-md/php-app-imagix/d/total.svg)](https://packagist.org/packages/greg-md/php-app-imagix)
[![Latest Stable Version](https://poser.pugx.org/greg-md/php-app-imagix/v/stable.svg)](https://packagist.org/packages/greg-md/php-app-imagix)
[![Latest Unstable Version](https://poser.pugx.org/greg-md/php-app-imagix/v/unstable.svg)](https://packagist.org/packages/greg-md/php-app-imagix)
[![License](https://poser.pugx.org/greg-md/php-app-imagix/license.svg)](https://packagist.org/packages/greg-md/php-app-imagix)

Integration of [PHP Imagix](https://github.com/greg-md/php-imagix) in [Greg PHP Application](https://github.com/greg-md/php-app).

# Table of Contents

* [Requirements](#requirements)
* [Installation](#installation)
* [Configuration](#configuration)
* [License](#license)
* [Huuuge Quote](#huuuge-quote)

# Requirements

* [Greg PHP Application](https://github.com/greg-md/php-app)

# Installation

Download package:

`composer require greg-md/php-app-imagix`

Install package:

`./greg install greg-imagix`

# Configuration

**Nginx**

```nginxconfig
# Imagix
location ~* ^/imagix/.+ {
    # If images doesn't exists, send to PHP to create it.
    if (!-f $document_root$uri) {
        rewrite .+ /imagix.php last;
    }

    expires max;
    add_header Pragma public;
    add_header Cache-Control "public";
    add_header Vary "Accept-Encoding";
}
```

# License

MIT © [Grigorii Duca](http://greg.md)

# Huuuge Quote

![I fear not the man who has practiced 10,000 programming languages once, but I fear the man who has practiced one programming language 10,000 times. &copy; #horrorsquad](http://greg.md/huuuge-quote-fb.jpg)
