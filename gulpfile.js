'use strict';
const { src, dest } = require('gulp');
const gulp = require('gulp');

const plumber = require('gulp-plumber');
const browserSync = require('browser-sync').create();
const del = require('del');
const less = require('gulp-less');
const autoprefixer = require('gulp-autoprefixer');
//const postcss = require('gulp-postcss');
//const sourcemaps = require('gulp-sourcemaps');

const path = {
    build: {
        php: '///OSPanel/domains/freshtheme.loc/wp-content/themes/freshtheme',
        css: '///OSPanel/domains/freshtheme.loc/wp-content/themes/freshtheme/css',
        js: '///OSPanel/domains/freshtheme.loc/wp-content/themes/freshtheme/js',
        url: 'freshtheme.loc',
    },
    src: {
        php: 'source/**/*.php',
        less: 'source/less/**/*.less',
        css: 'source/css/**/*.css',
        js: 'source/js/**/*.js',
    },
    watch: {
        php: 'source/**/*.php',
        css: 'source/less/**/*.less',
        js: 'source/js/**/*.js',
    },
    clean: 'c://ospanel/domains/php.loc/*.php',
};

function server(done) {
    browserSync.init({
        proxy: path.build.url,
    });
    done();
}

function deletedFile() {
    return del([path.clean], { force: true });
}

function php() {
    return src(path.src.php)
        .pipe(plumber())
        .pipe(dest(path.build.php))
        .pipe(browserSync.reload({ stream: true }));
}

function js() {
    return src(path.src.js)
        .pipe(plumber())
        .pipe(dest(path.build.js))
        .pipe(browserSync.stream());
}

function css() {
    return src(path.src.less)
        .pipe(
            plumber({
                errorHandler: function (err) {
                    console.log(err);
                    this.emit('end');
                },
            })
        )
        .pipe(less())
        .pipe(autoprefixer())
        .pipe(gulp.dest(path.build.css))
        .pipe(browserSync.stream());
}

function watchFiles() {
    gulp.watch([path.watch.php], php);
    gulp.watch([path.watch.css], css);
    gulp.watch([path.watch.js], js);
}

const watch = gulp.parallel(watchFiles, server);

exports.php = php;
exports.del = deletedFile;
exports.watch = watch;
exports.css = css;
