const imagemin = require("imagemin");
const imageminJpegtran = require("imagemin-jpegtran");
const imageminPngquant = require("imagemin-pngquant");
const imageminMozjpeg = require("imagemin-mozjpeg");
const imageminSvgo = require("imagemin-svgo");

const plgs = [
  imageminPngquant({
    quality: [0.1, 0.3],
  }),
  imageminSvgo({
    plugins: [{ removeViewBox: false }],
  }),
  imageminMozjpeg({ quality: 70 }),
];

(async () => {
  await imagemin(["assets/src/img/*.{jpg,JPG,png,svg}"], {
    destination: "assets/dist/img/",
    plugins: plgs,
  });
})();
