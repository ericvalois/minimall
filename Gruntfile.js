module.exports = function(grunt) {
    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        critical: {
            home: {
                options: {
                    base: '',
                    css: [
                        'style.css',
                        'assets/css/basscss.css',
                    ],
                    width: 1200,
                    height: 1200,
                    include: ['.hide', '.justify-end','.justify-start','.justify-between','.justify-center'],
                    ignore: ['.screen-reader-text', '.btn'],
                    minify: false,
                    timeout: 100000,
                },
                src: 'http://minimall.local/',
                dest: 'includes/compatibility/autoptimize/critical/home.css'
            },
            archive: {
                options: {
                    base: '',
                    css: [
                        'style.css',
                        'assets/css/basscss.css',
                    ],
                    width: 1200,
                    height: 1000,
                    include: ['.hide', '.justify-end','.justify-start','.justify-between','.justify-center'],
                    ignore: ['.screen-reader-text', '.btn'],
                    minify: false,
                    timeout: 100000,
                },
                src: 'http://minimall.local/blog/',
                dest: 'includes/compatibility/autoptimize/critical/archive.css'
            },
            page: {
                options: {
                    base: '',
                    css: [
                        'style.css',
                        'assets/css/basscss.css',
                    ],
                    width: 1200,
                    height: 1000,
                    include: ['.hide', '.justify-end','.justify-start','.justify-between','.justify-center'],
                    ignore: ['.screen-reader-text', '.btn'],
                    minify: false,
                    timeout: 100000,
                },
                src: 'http://minimall.local/style-guide/',
                dest: 'includes/compatibility/autoptimize/critical/page.css'
            },
            single: {
                options: {
                    base: '',
                    css: [
                        'style.css',
                        'assets/css/basscss.css',
                    ],
                    width: 1200,
                    height: 1000,
                    include: ['.hide', '.justify-end','.justify-start','.justify-between','.justify-center'],
                    ignore: ['.screen-reader-text', '.btn'],
                    minify: false,
                    timeout: 100000,
                },
                src: 'http://minimall.local/style-guide/',
                dest: 'includes/compatibility/autoptimize/critical/single.css'
            },
            page_404: {
                options: {
                    base: '',
                    css: [
                        'style.css',
                        'assets/css/basscss.css',
                    ],
                    width: 1200,
                    height: 1000,
                    include: ['.hide', '.justify-end','.justify-start','.justify-between','.justify-center'],
                    ignore: ['.screen-reader-text', '.btn'],
                    minify: false,
                    timeout: 100000,
                },
                src: 'http://minimall.local/abcdefgh/',
                dest: 'includes/compatibility/autoptimize/critical/404.css'
            },
            edd_single: {
                options: {
                    base: '',
                    css: [
                        'style.css',
                        'assets/css/basscss.css',
                    ],
                    width: 1200,
                    height: 1000,
                    include: ['.hide', '.justify-end','.justify-start','.justify-between','.justify-center','.lg-col-4','.lg-col-8','.lg-col-6','.lg-col-12'],
                    ignore: ['.screen-reader-text', '.btn'],
                    minify: false,
                    timeout: 100000,
                },
                src: 'http://minimall.local/downloads/light-bold/',
                dest: 'includes/compatibility/autoptimize/critical/edd-single.css'
            },
            edd_archive: {
                options: {
                    base: '',
                    css: [
                        'style.css',
                        'assets/css/basscss.css',
                    ],
                    width: 1200,
                    height: 1000,
                    include: ['.hide', '.justify-end','.justify-start','.justify-between','.justify-center','.lg-col-4','.lg-col-8','.lg-col-6','.lg-col-12'],
                    ignore: ['.screen-reader-text', '.btn'],
                    minify: false,
                    timeout: 100000,
                },
                src: 'http://minimall.local/shop/',
                dest: 'includes/compatibility/autoptimize/critical/edd-archive.css' 
            },
            edd_checkout: {
                options: {
                    base: '',
                    css: [
                        'style.css',
                        'assets/css/basscss.css',
                    ],
                    width: 1200,
                    height: 1000,
                    include: ['.hide', '.justify-end','.justify-start','.justify-between','.justify-center','.lg-col-4','.lg-col-8','.lg-col-6','.lg-col-12'],
                    ignore: ['.screen-reader-text', '.btn'],
                    minify: false,
                    timeout: 100000,
                },
                src: 'http://minimall.local/checkout/',
                dest: 'includes/compatibility/autoptimize/critical/edd-checkout.css'   
            },
            full_width: {
                options: {
                    base: '',
                    css: [
                        'style.css',
                        'assets/css/basscss.css',
                    ],
                    width: 1200,
                    height: 1000,
                    include: ['.hide', '.justify-end','.justify-start','.justify-between','.justify-center','.lg-col-4','.lg-col-8','.lg-col-6','.lg-col-12'],
                    ignore: ['.screen-reader-text', '.btn'],
                    minify: false,
                    timeout: 100000,
                },
                src: 'http://minimall.local/full-width/',
                dest: 'includes/compatibility/autoptimize/critical/full-width.css'
            },
            dashboard: {
                options: {
                    base: '',
                    css: [
                        'style.css',
                        'assets/css/basscss.css',
                    ],
                    width: 1200,
                    height: 1000,
                    include: ['.hide', '.justify-end','.justify-start','.justify-between','.justify-center','.lg-col-4','.lg-col-8','.lg-col-6','.lg-col-12'],
                    ignore: ['.screen-reader-text', '.btn'],
                    minify: false,
                    timeout: 100000,
                },
                src: 'http://minimall.local/subscriptions/',
                dest: 'includes/compatibility/autoptimize/critical/dashboard.css'
            },
            empty_template: {
                options: {
                    base: '',
                    css: [
                        'style.css',
                        'assets/css/basscss.css',
                    ],
                    width: 1200,
                    height: 1000,
                    include: ['.hide', '.justify-end','.justify-start','.justify-between','.justify-center'],
                    ignore: ['.screen-reader-text', '.btn'],
                    minify: false,
                    timeout: 100000,
                },
                src: 'http://minimall.local/pillar-post-block/',
                dest: 'includes/compatibility/autoptimize/critical/empty.css'
            }
        },

        cssmin: {
            critical: {
                options: {
                    aggressiveMerging: true,
                    level: {
                        2: {
                          all: true,
                        }
                    }
                },
                files: [{
                    expand: true,
                    cwd: 'includes/compatibility/autoptimize/critical/',
                    src: ['*.css', '!*.min.css'],
                    dest: 'includes/compatibility/autoptimize/critical/',
                    ext: '.min.css'
                }]
            }
        },

        clean: {
            init: {
                src: ['build/']
            },
            first: {
                src: ['build/*', '!build/<%= pkg.name %>-<%= pkg.version %>.zip']
            },
            second: {
                src: ['build/*', '!build/minimall-package-<%= pkg.version %>.zip']
            },
            style: {
                src: ['style-*']
            },
            temp: {
                src: ['temp.css']
            },
        },

        copy: {
            readme: {
                src: 'readme.md',
                dest: 'build/readme.txt'
            },
            build: {
                expand: true,
                src: ['**', '!node_modules/**', '!build/**', '!readme.md', '!Gruntfile.js', '!package.json', '!.gitignore','!config.codekit3' ],
                dest: 'build/'
            },


        },

        compress: {
            parent: {
                options: {
                    archive: 'build/<%= pkg.name %>-<%= pkg.version %>.zip'
                },
                expand: true,
                cwd: 'build/',
                src: ['**/*'],
                dest: '<%= pkg.name %>/'
            },
            child: {
                options: {
                    archive: 'build/<%= pkg.name %>-child.zip'
                },
                expand: true,
                cwd: '../<%= pkg.name %>-child/',
                src: ['**/*'],
                dest: '<%= pkg.name %>-child/'
            },
            full: {
                options: {
                    archive: 'build/<%= pkg.name %>-package-<%= pkg.version %>.zip'
                },
                expand: true,
                cwd: 'build/',
                src: ['**/*'],
                dest: '<%= pkg.name %>-package-<%= pkg.version %>/'
            }
        },


        


    });

    //grunt.loadNpmTasks('grunt-criticalcss');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-critical');

    //grunt.registerTask('critical', ['criticalcss','cssmin']);

    
    grunt.registerTask('criticalgenerate', ['critical','cssmin']);

    //grunt.registerTask('critical', ['critical','cssmin']);
    grunt.registerTask('min', ['cssmin']);

    //grunt.registerTask('cleanstyle', ['clean:style']);
    grunt.registerTask( 'build', ['clean:init', 'clean:init', 'copy:build', 'compress:parent', 'clean:first', 'compress:child', 'compress:full', 'clean:second']);

};