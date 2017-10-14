# Design into HTML converter
Convert your Design into HTML / PUG with Bootstrap fast and easy with this project.

## Requirements 

* apache / nginx - [Install apache](https://www.maketecheasier.com/setup-local-web-server-all-platforms/), [Install nginx](https://www.nginx.com/resources/wiki/start/topics/tutorials/install/)
* php * php-cli  - [Install php](http://php.net/manual/en/install.php)
* git            - [Install git](https://www.atlassian.com/git/tutorials/install-git)
* composer       - [Install composer](https://getcomposer.org/doc/00-intro.md)
* yarn           - [Install yarn](https://yarnpkg.com/en/docs/install)
* compass        - [Install compass](http://compass-style.org/install/)


## Knowledge requirements

* sass            - [Sass language - make your CSS with no pain](http://sass-lang.com)
* bootstrap 4+    - [Bootstrap - most popular HTML/CSS/JavasScript framework](https://getbootstrap.com)
* pugjs           - [Pug - sexiest HTML coding ever](https://pugjs.org/)
* javascript/ES6  - [JavaScript/ECMAScript - most popular scripting language](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
* jquery 3+       - [Most popular JavaScript library](https://jquery.com/)

### Better to know how to use

* webpack  - [Bundle assets with dependencies into static assets](https://webpack.js.org)
* php      - [PHP - popular scripting language for web-development](http://php.net)

## Project structure

```
|-- assets                // static assets
|  |-- css                
|    |-- bundle.css       // compiled css file for development use
|    |-- bundle.min.css   // compiled css file for production
|  |-- icon               // folder for favicons & mobile application icons
|  |-- img                // static images of design
|  |-- js                 
|     |-- bundle.js       // compiled javascript files for deverlopment use
|     |-- bundle.min.js   // compiled javascript files for production
|-- cli                   
|  |-- compile.php        // php compiler file to convert all pages & assets into HTML files & static assets
|-- compiled              // folder with compiled HTML files & static assets
|-- node_modules          // npm modules - created automatically after yarn install use
|-- src                   
|  |-- js                 // javascript source files
|  |-- sass               // sass source files
|-- templates             // pug templates
|-- vendor                // php modules - created automatically after composer install
|-- .gitignore            
|-- .htaccess             // apache configuration file to handle redirects/urls for webpages
|-- composer.json         // composer config file
|-- composer.lock         // composer system file
|-- index.php             // index php file which handles
|-- package.json          // yarn configuration file
|-- webpack.config.js     // webpack configuration file
|-- yarn.lock             // yarn system file
|-- README.md             // readme file with documentation
```

## Setup project

Clone this project into your local website directory.

	git clone https://github.com/glodov/design-into-html.git .

Install yarn (npm) packages with yarn

	yarn install

Install php packages with composer

	composer install
	

## Setup bootstrap

Change basic variables such colours, margins, gutters, etc. in file:

```
src/sass/bootstrap/_custom.scss
```

If there is some variables you want to use are missing, copy them from 

```
node_modules/bootstrap/scss/_variables.scss
```

paste, change and remove !default option to make it work.


## Work with PUG templates

All PUG templates are stored in 

```
templates/
```

Pages/files you want to include and don't want to compile into HTML products name with first character "_" (underscore). For instance __templates/_blocks__ where you can save blocks you need to include.
If you want to access the file from browser and compile in production just save it as file with same url. For instance for url: 
```
/faq/how-to-compile-project
```
you need to have file:
```
templates/faq/how-to-compile-project.pug
```