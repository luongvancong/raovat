var gulp = require('gulp');
var concat = require('gulp-concat');
var csso = require('gulp-csso');
var sourcemaps = require('gulp-sourcemaps');
var jsmin = require('gulp-jsmin');
var rename = require('gulp-rename');
var debug = require('gulp-debug');

gulp.task('concatCss', function() {

    var cssFiles = [
        'bs3/css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'bower_components/owl.carousel/dist/assets/owl.carousel.min.css',
        'css/common.css',
        'css/frontend.css',
        'css/rating.css',
        'less/all.css',
        'bower_components/bxslider-4/dist/jquery.bxslider.css',
        'js/fancybox/source/jquery.fancybox.css',
        'js/fancybox/source/helpers/jquery.fancybox-buttons.css',
        'js/fancybox/source/helpers/jquery.fancybox-thumbs.css',
        'bower_components/flexslider/flexslider.css',
        'bower_components/select2/dist/css/select2.min.css',
        'css/account.css',
        'css/build/price_history.css'
    ];

    return gulp.src(cssFiles)
        .pipe(sourcemaps.init())
        .pipe(concat('all.css'))
        .pipe(sourcemaps.write('../maps'))
        .pipe(gulp.dest('css/build'));
});


gulp.task('minifyCss', ['concatCss'] ,function() {

    var cssFiles = ['css/build/all.css']

    return gulp.src(cssFiles)
        .pipe(csso())
        .pipe(gulp.dest('css'));

});


gulp.task('sourcemaps', ['concatCss', 'minifyCss'] ,function() {
    var cssFiles = [
        'css/all.css',
        'css/maps/url.txt'
    ];

    return gulp.src(cssFiles)
        .pipe(concat('all.css'))
        .pipe(gulp.dest('css'));
});

gulp.task('concatJs', function() {
    var files = [
        'js/jquery.js',
        'bs3/js/bootstrap.min.js',
        'bower_components/owl.carousel/dist/owl.carousel.min.js',
        'js/functions.js',
        'bower_components/typeahead.js/dist/typeahead.bundle.min.js',
        'bower_components/handlebars/handlebars.min.js',
        'js/main.js',
        'bower_components/isMobile/isMobile.min.js',
        'bower_components/bxslider-4/dist/jquery.bxslider.js',
        'bower_components/flexslider/jquery.flexslider-min.js',
        'bower_components/select2/dist/js/select2.min.js',
        // 'js/jquery_scroll_pagination.js'
    ];

    return gulp.src(files)
        .pipe(sourcemaps.init())
        .pipe(concat('all.js'))
        .pipe(sourcemaps.write('../maps'))
        .pipe(gulp.dest('js/min'));
});

gulp.task('minifyJs', ['concatJs'] ,function() {
    var files = ['js/min/all.js'];
    return gulp.src(files)
        .pipe(jsmin())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('js/min'));
});


gulp.task('default', ['concatCss', 'minifyCss', 'sourcemaps']);

gulp.task('js', ['concatJs', 'minifyJs']);