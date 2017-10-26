module.exports = function(grunt) {
    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        criticalcss: {
            home: {
                options: {
                    url: "http://ttfb.dev/",
                    width: 1200,
                    height: 800,
                    outputfile: "inc/performance/critical/landingpage.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.lg-col-12','.lg-col-6','.lg-col-4', '.center', '.mb4', '.weight100', 'h2'],
                    ignoreConsole: false
                }
            },
            doc_archive: {
                options: {
                    url: "http://ttfb.dev/docs/",
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
                    url: "http://ttfb.dev/doc/light-bold/how-to-automatically-update-our-themes/",
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
                    url: "http://ttfb.dev/blog/",
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
                    url: "http://ttfb.dev/speed-toolbox/",
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
                    url: "http://ttfb.dev/blog/speed-up-wordpress/",
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
                    url: "http://ttfb.dev/support/",
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
                    url: "http://ttfb.dev/abcdefgh/",
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
                    url: "http://ttfb.dev/themes/mano/",
                    width: 1200,
                    height: 1000,
                    outputfile: "inc/performance/critical/download.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: [],
                    ignoreConsole: false
                }
            },
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
                    cwd: 'inc/performance/critical/',
                    src: ['*.css', '!*.min.css'],
                    dest: 'inc/performance/critical/',
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
                src: ['build/*', '!build/ttfb.zip']
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
            acf_pro: {
                src: 'build/advanced-custom-fields-pro.zip',
                dest: 'inc/3rd-party/plugins/advanced-custom-fields-pro.zip'
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
                cwd: '../ttfb-child/',
                src: ['**/*'],
                dest: '<%= pkg.name %>-child/'
            },
            acf_pro: {
                options: {
                    archive: 'build/advanced-custom-fields-pro.zip'
                },
                expand: true,
                cwd: '../../plugins/advanced-custom-fields-pro/',
                src: ['**/*'],
                dest: 'advanced-custom-fields-pro/'
            },
            full: {
                options: {
                    archive: 'build/ttfb.zip'
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
    grunt.registerTask( 'build', ['clean:init', 'compress:acf_pro', 'copy:acf_pro', 'clean:init', 'copy:build', 'compress:parent', 'clean:first', 'compress:child', 'compress:full', 'clean:second']);

};