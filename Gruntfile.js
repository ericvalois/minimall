module.exports = function(grunt) {
    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        criticalcss: {
            home: {
                options: {
                    url: "http://minimall.dev",
                    width: 1200,
                    height: 1200,
                    outputfile: "includes/performance/critical/home.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.justify-end','.justify-start','.justify-between','.justify-center'],
                    ignoreConsole: false
                }
            },
            
            archive: {
                options: {
                    url: "http://minimall.dev/blog/",
                    width: 1200,
                    height: 1000,
                    outputfile: "includes/performance/critical/archive.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: [],
                    ignoreConsole: false
                }
            },
            page: {
                options: {
                    url: "http://minimall.dev/style-guide/",
                    width: 1200,
                    height: 1000,
                    outputfile: "includes/performance/critical/page.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.justify-end','.justify-start','.justify-between','.justify-center'],
                    ignoreConsole: false
                }
            },
            single: {
                options: {
                    url: "http://minimall.dev/style-guide/",
                    width: 1200,
                    height: 1000,
                    outputfile: "includes/performance/critical/single.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.justify-end','.justify-start','.justify-between','.justify-center'],
                    ignoreConsole: false
                }
            },
            page_404: {
                options: {
                    url: "http://minimall.dev/abcdefgh/",
                    width: 1200,
                    height: 1000,
                    outputfile: "includes/performance/critical/404.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.justify-end','.justify-start','.justify-between','.justify-center'],
                    ignoreConsole: false
                }
            },
            edd_single: {
                options: {
                    url: "http://minimall.dev/downloads/minimall/",
                    width: 1200,
                    height: 1000,
                    outputfile: "includes/performance/critical/edd-single.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.justify-end','.justify-start','.justify-between','.justify-center','.lg-col-4','.lg-col-8','.lg-col-6','.lg-col-12'],
                    ignoreConsole: false
                }
            },
            edd_archive: {
                options: {
                    url: "http://minimall.dev/shop/",
                    width: 1200,
                    height: 1000,
                    outputfile: "includes/performance/critical/edd-archive.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.justify-end','.justify-start','.justify-between','.justify-center','.lg-col-3','.lg-col-4','.lg-col-6','.lg-col-12'],
                    ignoreConsole: false
                }
            },
            edd_checkout: {
                options: {
                    url: "http://minimall.dev/checkout/",
                    width: 1200,
                    height: 1000,
                    outputfile: "includes/performance/critical/edd-checkout.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.justify-end','.justify-start','.justify-between','.justify-center'],
                    ignoreConsole: false
                }
            },
            full_width: {
                options: {
                    url: "http://minimall.dev/knowledge-base/",
                    width: 1200,
                    height: 1000,
                    outputfile: "includes/performance/critical/full-width.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.justify-end','.justify-start','.justify-between','.justify-center'],
                    ignoreConsole: false
                }
            },
            dashboard: {
                options: {
                    url: "http://minimall.dev/dashboard/",
                    width: 1200,
                    height: 1000,
                    outputfile: "includes/performance/critical/dashboard.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.justify-end','.justify-start','.justify-between','.justify-center'],
                    ignoreConsole: false
                }
            },
            
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
                    cwd: 'includes/performance/critical/',
                    src: ['*.css', '!*.min.css'],
                    dest: 'includes/performance/critical/',
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
                src: ['**', '!node_modules/**', '!build/**', '!readme.md', '!Gruntfile.js', '!package.json', '!.gitignore','!.codekit3' ],
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

    grunt.loadNpmTasks('grunt-criticalcss');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');

    grunt.registerTask('critical', ['criticalcss','cssmin']);
    //grunt.registerTask('critical', ['critical','cssmin']);
    grunt.registerTask('min', ['cssmin']);

    //grunt.registerTask('cleanstyle', ['clean:style']);
    grunt.registerTask( 'build', ['clean:init', 'clean:init', 'copy:build', 'compress:parent', 'clean:first', 'compress:child', 'compress:full', 'clean:second']);

};