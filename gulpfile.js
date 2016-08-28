var gulp = require('gulp');
var sass = require('gulp-sass');
var minifycss = require('gulp-minify-css');
var rename = require('gulp-rename');
var autoprefixer = require('gulp-autoprefixer');

var sassOptions = {
  errLogToConsole: true,
  outputStyle: 'expanded'
};

gulp.task('default', function() {
  gulp.start('sass');
});

// Sass task for development
gulp.task('sass', function() {
  return gulp
    .src('assets/scss/**/*.scss')
    .pipe(sass(sassOptions).on('error', sass.logError))
    .pipe(autoprefixer({
      browsers: ['> 1%', 'last 3 version', 'ie 8', 'ie 9', 'Firefox ESR', 'opera 12.1', 'Android 3', 'Android 4']
    }))
    .pipe(gulp.dest('assets/css'));
});

gulp.task('watch', function() {
  return gulp
    .watch('assets/scss/**/*.scss', ['sass'])
    .on('change', function(event) {
      console.log('\u27A1 File ' + event.path + ' was ' + event.type + ', running tasks...');
    });
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
    .pipe(gulp.dest('assets/css'));
});
