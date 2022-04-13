# WPPack

WPPack is a starter library for develop WordPress themes

## İnstall

1. clone `git clone https://github.com/kableDev/wppack.git .`
2. install packages `npm install`
3. `composer install`
4. Update `build/build.js`
5. start `npm start`

```
npm install
composer install
npm start
```

## Usage

source dir `assets/src/`

- for development mode use `npm start`
- for production use `npm run build`

## Configuration

- Customize the theme:

  - Change the theme-name line from the `build/build.js`
  - Customize the static pages, theme starter settings, menus and others in the `app/app.setup.php`

- Configure the browser-sync:

  - use the `build/server.js` file for the configuration

## Features

- Custom Post types
- Theme Options Panel
- Post Meta Boxes
- SCSS support
- ES Modules
- Browser Sync
-

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
