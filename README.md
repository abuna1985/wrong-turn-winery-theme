# Wrong Turn Winery

![alt text](./images/screenshot.png "Wrong Turn Winery")

A theme that features a fully functional site for a fictional winery. I took a simple bootstrap theme and dynamically added custom posts (Wines, Events, Locations, Staff, Notes). I also built a filtered live search function utilizing the WP REST API and ES6 Object Orriented JavaScript.

## Demo

You can find a demo of Wrong Turn Winery [here](https://adama.sgedu.site)

## Prerequisites

**Requires at least:** WordPress 4.4

**Tested up to:** WordPress 5.1

Please make sure you have Node.js installed. You can find the link to download [Node.js here](https://nodejs.org/en/) and [WordPress here](https://wordpress.org) 

```javascript
// Verify Node was installed by running this command in your terminal
node -v
// You should get something like...
v12.8.1 // it may be a higher version number than this
```

## Getting Started

After downloading this repo, go to your terminal in the project root directory and install all the npm dependencies first.

```
npm install
```

## Running a Build
**Compiles and hot-reloads in a development environment**
```
npm run gulpwatch
```

**Compiles and minifies CSS for a production environment**
```
npm run gulpstyles
```


**Compiles and minifies JavaScript for a production environment**
```
npm run gulpscripts
```

## Built With

* [WordPress](https://wordpress.org) - content management system used
* [Gulp](https://gulpjs.com) - Automating the CSS builds
* [Webpack](https://webpack.js.org) - Automating the JavaScript builds
* [Vagrant](https://www.vagrantup.com) - Development Server

## Versioning

**Stable tag:** 1.0

**Version:** 1.0

## Authors

* [**Adam Abundis**](https://adamabundis.xyz) - *Initial work* - [Abuna1985](https://github.com/abuna1985)

## License

This project is licensed under GPLv2 or later - see the [license link](http://www.gnu.org/licenses/gpl-2.0.html) for details

## Acknowledgments

* [LearnWebCode](https://github.com/LearnWebCode) - [Vagrant-LAMP dev environment](https://github.com/LearnWebCode/vagrant-lamp)

