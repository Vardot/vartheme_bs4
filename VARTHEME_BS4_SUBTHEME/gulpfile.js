let gulp = require('gulp'),
  sass = require('gulp-sass'),
  sourcemaps = require('gulp-sourcemaps'),
  postcss = require('gulp-postcss'),
  autoprefixer = require('autoprefixer'),
  browserSync = require('browser-sync').create()

const paths = {
  scss: {
    src: 'sass/**/*.scss',
    dest: 'css',
    watch: 'sass/**/*.scss'
  },
  js: {
    bootstrap: './node_modules/bootstrap/dist/js/bootstrap.min.js',
    popper: 'node_modules/popper.js/dist/umd/popper.min.js',
    dest: './js'
  }
}

// Compile sass into CSS & auto-inject into browsers
function styles () {
  return gulp.src([paths.scss.src])
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss([autoprefixer({
      browsers: [
        'Chrome >= 35',
        'Firefox >= 38',
        'Edge >= 12',
        'Explorer >= 10',
        'iOS >= 8',
        'Safari >= 8',
        'Android 2.3',
        'Android >= 4',
        'Opera >= 12']
    })]))
    .pipe(gulp.dest(paths.scss.dest))
    .pipe(browserSync.stream())
}

// Move the javascript files into our js folder
function js () {
  return gulp.src([paths.js.bootstrap, paths.js.popper])
    .pipe(gulp.dest(paths.js.dest))
    .pipe(browserSync.stream())
}

// Static Server + watching scss/html files
function serve () {
//  browserSync.init({
//    proxy: 'http://yourdomain.com',
//  })

  gulp.watch([paths.scss.watch], styles).on('change', browserSync.reload)
}

const build = gulp.series(styles, gulp.parallel(js, serve))

exports.styles = styles
exports.js = js
exports.serve = serve

exports.default = build
