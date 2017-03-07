var gulp = require('gulp');
var sass = require('gulp-sass');
var minify = require('gulp-minify');
var minifycss = require('gulp-minify-css');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var cleanCSS = require('gulp-clean-css');
var remoteSrc = require('gulp-remote-src');

var sassOptions = {
  errLogToConsole: true,
  outputStyle: 'expanded'
};

gulp.task('default', function() {
  gulp.start('minifycss');
  gulp.start('minifyjs');
});

gulp.task('watch', function() {
  gulp.watch(['assets/scss/**/*scss'], ['minifycss'])
    .on('change', function(event) {
      console.log('\u27A1 File ' + event.path + ' was ' + event.type + ', running tasks...');
    });

  gulp.watch(['assets/js/*.js', '!assets/js/analytics.js'], ['minifyjs'])
    .on('change', function(event) {
      console.log('\u27A1 File ' + event.path + ' was ' + event.type + ', running tasks...');
    });

  gulp.start('minifycss');
  gulp.start('minifyjs');
});

gulp.task('sass', function() {
  return gulp
    .src('assets/scss/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass(sassOptions).on('error', sass.logError))
    .pipe(autoprefixer({
      browsers: ['> 1%', 'last 3 version', 'ie 8', 'ie 9', 'Firefox ESR', 'opera 12.1', 'Android 3', 'Android 4']
    }))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./assets/compiled'));
});

// JS Task
gulp.task('analytics', function() {
    remoteSrc(['analytics.js'], {
        base: 'https://google-analytics.com/'
    })
    .pipe(gulp.dest('./assets/js/'));
});

gulp.task('js', ['analytics'], function() {
  return gulp
    .src(['assets/js/*.js'])
    .pipe(sourcemaps.init())
    .pipe(concat('script.js'))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./assets/compiled'));
});

gulp.task('minifyjs', ['js'], function() {
  return gulp
    .src('assets/compiled/script.js')
    .pipe(sourcemaps.init())
    .pipe(minify({ ext: {
      src: '.js',
      min: '.min.js'
    }}))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('assets/compiled'))
});

gulp.task('minifycss', ['sass'], function() {
  return gulp
    .src('assets/compiled/style.css')
    .pipe(sourcemaps.init())
    .pipe(cleanCSS())
    .pipe(rename({suffix: '.min'}))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('assets/compiled'))
});
