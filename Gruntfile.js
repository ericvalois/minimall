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
                    forceInclude: ['h1','.h1','.btn','p'],
                    ignoreConsole: false
                }
            },
            /*doc_archive: {
                options: {
                    url: "http://minimall.dev/docs/",
                    width: 1200,
                    height: 1000,
                    outputfile: "inc/performance/critical/doc.css",
                    filename: "style.css",
                    buffer: 1000*1024,
                    forceInclude: [],
                    ignoreConsole: true
                }
            },
            doc_single: {
                options: {
                    url: "http://minimall.dev/doc/light-bold/how-to-automatically-update-our-themes/",
                    width: 1200,
                    height: 1000,
                    outputfile: "inc/performance/critical/doc-single.css",
                    filename: "style.css",
                    buffer: 1000*1024,
                    forceInclude: ['.display-none'],
                    ignoreConsole: true
                }
            },
            archive: {
                options: {
                    url: "http://minimall.dev/blog/",
                    width: 1200,
                    height: 1000,
                    outputfile: "inc/performance/critical/archive.css",
                    filename: "style.css",
                    buffer: 1000*1024,
                    forceInclude: [],
                    ignoreConsole: false
                }
            },
            page: {
                options: {
                    url: "http://minimall.dev/speed-toolbox/",
                    width: 1200,
                    height: 1000,
                    outputfile: "inc/performance/critical/page.css",
                    filename: "style.css",
                    buffer: 1000*1024,
                    forceInclude: ['.display-none'],
                    ignoreConsole: false
                }
            },
            single: {
                options: {
                    url: "http://minimall.dev/blog/speed-up-wordpress/",
                    width: 1200,
                    height: 1000,
                    outputfile: "inc/performance/critical/single.css",
                    filename: "style.css",
                    buffer: 1000*1024,
                    forceInclude: ['.display-none','.lg-col-3','.lg-col-9'],
                    ignoreConsole: false
                }
            },
            contact: {
                options: {
                    url: "http://minimall.dev/support/",
                    width: 1200,
                    height: 1000,
                    outputfile: "inc/performance/critical/contact.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: [],
                    ignoreConsole: false
                }
            },
            page_404: {
                options: {
                    url: "http://minimall.dev/abcdefgh/",
                    width: 1200,
                    height: 1000,
                    outputfile: "inc/performance/critical/404.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: [],
                    ignoreConsole: false
                }
            },
            download: {
                options: {
                    url: "http://minimall.dev/themes/mano/",
                    width: 1200,
                    height: 1000,
                    outputfile: "inc/performance/critical/download.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: [],
                    ignoreConsole: false
                }
            },*/
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
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');

    grunt.registerTask('critical', ['criticalcss','cssmin']);
    grunt.registerTask('min', ['cssmin']);

    //grunt.registerTask('cleanstyle', ['clean:style']);
    grunt.registerTask( 'build', ['clean:init', 'clean:init', 'copy:build', 'compress:parent', 'clean:first', 'compress:child', 'compress:full', 'clean:second']);

};