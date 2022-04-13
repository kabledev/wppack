file_basename = "App";
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

const fs = require("fs"),
  path = require("path"),
  sass = require("node-sass"),
  postcss = require("postcss"),
  autoprefixer = require("autoprefixer"),
  cssnano = require("cssnano"),
  sortmq = require("postcss-sort-media-queries"),
  rollup = require("rollup"),
  { terser, minify } = require("terser"),
  comonjs = require("@rollup/plugin-commonjs"),
  { babel } = require("@rollup/plugin-babel"),
  { nodeResolve } = require("@rollup/plugin-node-resolve");

//terser
const TerserConf = {
  compress: {
    dead_code: true,
    drop_console: false,
    drop_debugger: true,
    keep_classnames: false,
    keep_fargs: true,
    keep_fnames: false,
    keep_infinity: false,
  },
  mangle: {
    eval: false,
    keep_classnames: false,
    keep_fnames: false,
    toplevel: false,
    safari10: false,
  },
  module: false,
  sourceMap: false,
  output: {},
};

fs.writeFile("style.css", banner_full, () => true);

function css_conf(plugins, filename, rescss) {
  postcss(plugins)
    .process(rescss.css, { from: "undefined" })
    .then((result) => {
      fs.writeFile(
        `assets/dist/css/${filename}`,
        `${banner_excerpt}\n${result.css}`,
        (err) => {
          if (err) console.log(err);
          else console.log(`${filename} changed`);
        }
      );
    });
}

sass.render(
  {
    file: "assets/src/scss/app.scss",
    outputStyle: "expanded",
  },
  function (err, res) {
    if (err) console.log(err);
    else {
      css_conf([autoprefixer, sortmq], "app.css", res);
      css_conf([autoprefixer, sortmq, cssnano], "app.min.css", res);
    }
  }
);

/**
 * @javascript
 *
 */

async function js_fi(inputDir, outDir, tag) {
  const bundle = await rollup.rollup({
    input: `${inputDir}${tag}.js`,
    plugins: [nodeResolve(), babel({ babelHelpers: "bundled" }), comonjs()],
  });
  await bundle.write({
    file: `${outDir}${tag}.js`,
    format: "cjs",
    name: file_basename,
    banner: banner_excerpt,
  });
  await bundle.close();

  const getcode = fs.readFileSync(`${outDir + tag}.js`, "utf8");
  const minifiedjs = await minify(getcode, TerserConf);
  fs.writeFileSync(`${outDir}${tag}.min.js`, minifiedjs.code);
  console.log(`${outDir} changed`);
}

js_fi("assets/src/js/", "assets/dist/js/", "app");
