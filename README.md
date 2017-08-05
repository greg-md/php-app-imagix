# PHP App Static Image

[![StyleCI](https://styleci.io/repos/00000000/shield?style=flat)](https://styleci.io/repos/00000000)
[![Build Status](https://travis-ci.org/greg-md/php-app-static-image.svg)](https://travis-ci.org/greg-md/php-app-static-image)
[![Total Downloads](https://poser.pugx.org/greg-md/php-app-static-image/d/total.svg)](https://packagist.org/packages/greg-md/php-app-static-image)
[![Latest Stable Version](https://poser.pugx.org/greg-md/php-app-static-image/v/stable.svg)](https://packagist.org/packages/greg-md/php-app-static-image)
[![Latest Unstable Version](https://poser.pugx.org/greg-md/php-app-static-image/v/unstable.svg)](https://packagist.org/packages/greg-md/php-app-static-image)
[![License](https://poser.pugx.org/greg-md/php-app-static-image/license.svg)](https://packagist.org/packages/greg-md/php-app-static-image)

Integration of [PHP Static Image](https://github.com/greg-md/php-static-image) in [Greg PHP Application](https://github.com/greg-md/php-app).

# Table of Contents

* [Requirements](#requirements)
* [Installation](#installation)
* [Configuration](#configuration)
* [License](#license)
* [Huuuge Quote](#huuuge-quote)

# Requirements

* [Greg PHP Application](https://github.com/greg-md/php-app)

# Installation

`composer require greg-md/php-app-static-image`

# Configuration

**Nginx**

```nginx
# Static Image
location ~* @.+\.(png|jpe?g|gif)$ {
    if (!-f \$document_root\$uri) {
        rewrite ^/static(/.+) /image.php?static=\$1 last;
    }

    expires max;
    add_header Cache-Control \"public\";
    add_header Vary \"Accept-Encoding\";
}
```

# License

MIT © [Grigorii Duca](http://greg.md)

# Huuuge Quote

![I fear not the man who has practiced 10,000 programming languages once, but I fear the man who has practiced one programming language 10,000 times. &copy; #horrorsquad](http://greg.md/huuuge-quote-fb.jpg)
