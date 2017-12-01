module.exports = function(grunt) {
    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        criticalcss: {
            home: {
                options: {
                    url: "http://minimall.dev/",
                    width: 1200,
                    height: 1200,
                    outputfile: "includes/performance/critical/home.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['h1','.h1','p'],
                    ignoreConsole: false
                }
            },
            /*
            archive: {
                options: {
                    url: "http://minimall.dev/blog/",
                    width: 1200,
                    height: 1000,
                    outputfile: "includes/performance/critical/archive.css",
                    filename: "style.css",
                    buffer: 1000*1024,
                    forceInclude: ['h1','.h1','.btn','p','h2','.h2','h3','.h3','h4','.h4','h5','.h6','.lg-col-8','.lg-col-4'],
                    ignoreConsole: false
                }
            },
            /*page: {
                options: {
                    url: "http://minimall.dev/style-guide/",
                    width: 1200,
                    height: 1000,
                    outputfile: "includes/performance/critical/page.css",
                    filename: "style.css",
                    buffer: 1000*1024,
                    forceInclude: ['h1','.h1','.btn','p'],
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
                    buffer: 1000*1024,
                    forceInclude: ['h1','.h1','.btn','p'],
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
                    forceInclude: ['h1','.h1','.btn','p'],
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
                    forceInclude: ['h1','.h1','.btn','p'],
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
                    forceInclude: ['h1','.h1','.btn','p'],
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
                    forceInclude: ['h1','.h1','.btn','p'],
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
                    forceInclude: ['h1','.h1','.btn','p'],
                    ignoreConsole: false
                }
            },*/
        },

        critical: {
            home: {
                options: {
                    base: '',
                    css: [
                        'style.css'
                    ],
                    width: 1200,
                    height: 1200
                },
                src: 'http://minimall.dev/',
                dest: 'includes/performance/critical/home.css',
                
                // ignore CSS rules
                ignore: ['font-face'],
            }
        },

        cssmin: {
            critical: {
                options: {
                    aggressiveMerging: true,
                    level: {
                        1: {
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
                src: ['build/*', '!build/<%= pkg.name %>-parent.zip']
            },
            second: {
                src: ['build/*', '!build/minimall.zip']
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
                src: ['**', '!node_modules/**', '!build/**', '!readme.md', '!Gruntfile.js', '!package.json', '!.gitignore' ],
                dest: 'build/'
            },


        },

        compress: {
            parent: {
                options: {
                    archive: 'build/<%= pkg.name %>-parent.zip'
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
                cwd: '../minimall-child/',
                src: ['**/*'],
                dest: '<%= pkg.name %>-child/'
            },
            full: {
                options: {
                    archive: 'build/minimall.zip'
                },
                expand: true,
                cwd: 'build/',
                src: ['**/*'],
                dest: '<%= pkg.name %>/'
            }
        },
    });

    grunt.loadNpmTasks('grunt-criticalcss');
    grunt.loadNpmTasks('grunt-critical');
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