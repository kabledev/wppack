const packageJson = require("../package.json");
const banner_excerpt = `/**! WPPack ${packageJson.version} | https://github.com/kableDev/wppack | MIT */\n`;
const banner_full = `/**!
Theme Name: WPPack
Text Domain: wppack
Version: ${packageJson.version}

Theme URI: https://github.com/kableDev/wppack
Author: Kable
Author URI: https://kable.dev

Description: WordPress starter theme
Tags: blog, one-column, custom-background, custom-colors, custom-logo, custom-menu, editor-style, featured-images, footer-widgets, full-width-template, rtl-language-support, sticky-post, theme-options,   threaded-comments, translation-ready, block-styles, wide-blocks, accessibility-ready

Requires at least: 5.4
Tested up to: 5.9
Requires PHP: 7.0

License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/\n`;

//
const fs = require("fs"),
  path = require("path"),
  bs = require("browser-sync").create("WPPack"),
  sass = require("node-sass"),
  postcss = require("postcss"),
  sortmq = require("postcss-sort-media-queries"),
  autoprefixer = require("autoprefixer"),
  rollup = require("rollup"),
  { babel } = require("@rollup/plugin-babel"),
  commonjs = require("@rollup/plugin-commonjs"),
  { nodeResolve } = require("@rollup/plugin-node-resolve");

/* init */
bs.init({
  files: ["**/*.css", "**/*.js", "**/*.php", "**/*.html"],
  watch: true,
  ui: false,
  port: 9000,
  open: false,
  server: false,
  proxy: {
    target: "wppack.sw",
  },
});

// watch sass

render_scss = function (event, file, input, output, banner) {
  if (event == "change") {
    let source = input;
    let out = output;
    setTimeout(() => {
      sass.render(
        {
          file: source,
          sourceMap: false,
        },
        function (err, res) {
          if (err) console.log(err);
          else {
            postcss([autoprefixer, sortmq])
              .process(res.css, { from: "undefined" })
              .then((result) => {
                fs.writeFile(out, banner + result.css, () => true);
              });
          }
        }
      );
    }, 200);
  }
};
bs.watch(["assets/src/scss/**/*.scss"], function (event, file) {
  render_scss(
    event,
    file,
    "assets/src/scss/app.scss",
    "assets/dist/css/app.css",
    banner_excerpt
  );
});

bs.watch(["app/panel/assets/src/scss/**/*.scss"], function (event, file) {
  render_scss(
    event,
    file,
    "app/panel/assets/src/scss/app.panel.scss",
    "app/panel/assets/dist/css/app.panel.css",
    banner_excerpt
  );
});

// watch js

bs.watch("assets/src/js/**/*.js", function (event, file) {
  let inp = "assets/src/js/app.js";
  let out = "assets/dist/js/app.js";

  if (event == "change") {
    (async () => {
      const bundle = await rollup.rollup({
        input: `${inp}`,
        plugins: [
          nodeResolve(),
          commonjs(),
          babel({ babelHelpers: "bundled" }),
        ],
        // treeshake: false,
      });
      await bundle.write({
        file: `${out}`,
        format: "cjs",
        name: "App",
        banner: banner_excerpt,
      });
      await bundle.close();
      console.log(`${file} changed`);
    })();
  }
});

// panel js
bs.watch("app/panel/assets/src/js/**/*.js", function (event, file) {
  let inp = "app/panel/assets/src/js/app.panel.js";
  let out = "app/panel/assets/dist/js/app.panel.js";

  if (event == "change") {
    (async () => {
      const bundle = await rollup.rollup({
        input: `${inp}`,
        plugins: [
          nodeResolve(),
          commonjs(),
          babel({ babelHelpers: "bundled" }),
        ],
        // treeshake: false,
      });
      await bundle.write({
        file: `${out}`,
        format: "cjs",
        name: "AppPanel",
        banner: banner_excerpt,
      });
      await bundle.close();
      console.log(`${file} changed`);
    })();
  }
});
