var gulp = require('gulp');
var sass = require('gulp-sass');
var minify = require('gulp-minify');
var minifycss = require('gulp-minify-css');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');

var sassOptions = {
  errLogToConsole: true,
  outputStyle: 'expanded'
};

gulp.task('default', function() {
  gulp.start('sass');
  gulp.start('js');
});

// Sass task for development
gulp.task('sass', function() {
  return gulp
    .src('assets/scss/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass(sassOptions).on('error', sass.logError))
    .pipe(autoprefixer({
      browsers: ['> 1%', 'last 3 version', 'ie 8', 'ie 9', 'Firefox ESR', 'opera 12.1', 'Android 3', 'Android 4']
    }))
    .pipe(minify({ ext: {
      src: '.test.css',
      min: '.min.css'
    }}))
    .pipe(gulp.dest('./assets/compiled'));
});

// JS Task
gulp.task('js', function() {
  return gulp
    .src('assets/js/*.js')
    .pipe(sourcemaps.init())
    .pipe(concat('script.js'))
    .pipe(minify({ ext: {
      src: '.js',
      min: '.min.js'
    }}))
    .pipe(gulp.dest('./assets/compiled'));
});

gulp.task('watch', function() {
  return gulp
    .watch([
      'assets/js/*.js',
      'assets/scss/**/*scss'
    ],
    [
      'js',
      'sass'
    ])
    .on('change', function(event) {
      console.log('\u27A1 File ' + event.path + ' was ' + event.type + ', running tasks...');
    });
});

gulp.task('minifycss', function() {
  return gulp
    .src('assets/compiled/style.css')
    .pipe(sourcemaps.init())
    .pipe(minify())
    .pipe(gulp.dest('assets/compiled'));
});

gulp.task('production', function() {
  return gulp
    .src('assets/scss/**/*.scss')
    .pipe(sass(sassOptions).on('error', sass.logError))
    .pipe(autoprefixer({
      browsers: ['> 1%', 'last 3 version', 'ie 8', 'ie 9', 'Firefox ESR', 'opera 12.1', 'Android 3', 'Android 4']
    }))
    .pipe(rename({suffix: '.min'}))
    .pipe(minifycss())
    .pipe(gulp.dest('assets/compiled'));
});
