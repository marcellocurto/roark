// Load Gulp
let gulp = require('gulp');

// CSS related plugins
let sass = require('gulp-sass'),
  autoprefixer = require('gulp-autoprefixer');

// JS related plugins
let concat = require('gulp-concat'),
  uglify = require('gulp-uglify'),
  stripDebug = require('gulp-strip-debug');

// Utility plugins
// gulp --production for production ready JS, without console log
let rename = require('gulp-rename'),
  sourcemaps = require('gulp-sourcemaps'),
  options = require('gulp-options'),
  gulpif = require('gulp-if');

// Project related variables
let dist = './assets/',
  production = '/Users/marcello/Local\ Sites/roark/app/public/wp-content/themes/roark/',
  phpSRC = './**/*.php',
  styleSRC = './src/scss/style.scss',
  styleSRCEditor = './src/scss/editor-style.scss',
  scriptPath = './src/js/',
  scriptSRC = [
    scriptPath + 'google_analytics.js'
  ],
  styleWatch = './src/scss/**/*.scss',
  scriptWatch = './src/js/**/*.js',
  phpWatch = './**/*.php';

function css(cb) {
  gulp.src(styleSRC)
    .pipe(sourcemaps.init())
    .pipe(sass({
      errorLogToConsole: true,
    }))
    .on('error', console.error.bind(console))
    .pipe(autoprefixer({
      cascade: false,
    }))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./'))
    .pipe(gulp.dest(production));
  cb();
};

function css_editor(cb) {
  gulp.src(styleSRCEditor)
    .pipe(sourcemaps.init())
    .pipe(sass({
      errorLogToConsole: true,
    }))
    .on('error', console.error.bind(console))
    .pipe(autoprefixer({
      cascade: false,
    }))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./assets/'))
    .pipe(gulp.dest(production + 'assets/'));
  cb();
};

function javascript(cb) {
  gulp.src(scriptSRC)
    .pipe(concat('roark.js'))
    .pipe(gulpif(options.has('production'), stripDebug()))
    .pipe(gulp.dest(dist))
    .pipe(gulp.dest(production + 'assets/'));
  cb();
};

function php(cb) {
  gulp.src(phpSRC)
    .pipe(gulp.dest(production));
  cb();
};

function deploy(cb) {
    gulp.src('./icons/**')
    .pipe(gulp.dest(production + 'icons/'));
    gulp.src('./inc/**')
    .pipe(gulp.dest(production + 'inc/'));
    gulp.src('./screenshot.png')
    .pipe(gulp.dest(production));
    cb();
};


function watch(cb) {
  gulp.watch(styleWatch, css);
  gulp.watch(scriptWatch, javascript);
  gulp.watch(phpWatch, php);
  cb();
};

exports.css = css;
exports.javascript = javascript;
exports.php = php;
exports.watch = watch;

let build = gulp.parallel([watch, css, css_editor, javascript, php, deploy]);
gulp.task('default', build);
