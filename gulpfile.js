var gulp = require('gulp');

var sass = require('gulp-sass');

// var rename = require('gulp-rename');
var webserver = require('gulp-webserver');


/*
 *  ['jade'] ... Compile jade files.
 */

gulp.task('jade', function() {
  gulp.src(['./app/jade/**/*.jade', '!./app/jade/inc/**/*.jade'])
    .pipe(jade())
    .pipe(gulp.dest('./dist/'))
});


/*
 *  ['sass'] ... Compile sass files.
 */

gulp.task('sass', function(){
  gulp.src('./app/sass/**/*.scss')
    .pipe(sass({outputStyle: 'compressed'}))
    .pipe(gulp.dest('./dist/assets/css/'));
});


/*
 *  ['webserver'] ... Make server.
 *
 *  http://localhost:8080
 */

gulp.task('webserver', function () {
  gulp.src('./dist')
    .pipe(webserver({
      host: 'localhost',
      port: 8080,
      livereload: true
    }));
});





/*
 *  ['dev'] ... Develop mode.
 */

gulp.task('dev', ['webserver'], function(){
//  gulp.watch('./app/jade/**/*.jade', ['jade']);
  gulp.watch('./app/sass/**/*.scss', ['sass']);
});


/*
 *  ['install'] ... Install modules.
 */

gulp.task('install', function () {
//  gulp.src('./node_modules/sanitize.css/lib/sanitize.scss')
//    .pipe(rename("./_sanitize.scss"))
//    .pipe(gulp.dest('./app/sass/lib/'));
//  gulp.src(['./node_modules/bulma/bulma.sass', './node_modules/bulma/bulma/**'], { base: './node_modules/bulma'} )
//    .pipe(gulp.dest('./app/sass/lib/'));
  gulp.src('./node_modules/vue/dist/vue.min.js')
    .pipe(gulp.dest('./app/assets/js/lib/'));
  gulp.src('./node_modules/vue-resource/dist/vue-resource.min.js')
    .pipe(gulp.dest('./app/assets/js/lib/'));
});
