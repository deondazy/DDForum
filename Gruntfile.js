module.exports = function(grunt) {

    require('jit-grunt')(grunt);

    // 1. All configuration goes here
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        concat: {
            js: {
                src: [ 'inc/js/*.js' ],
                dest: 'inc/js/dist/production.js',

                options: {
                    separator: ';'
                }
            },

            css: {
                src: ['inc/css/*.css', '!*.min.css'],
                dest: 'inc/css/dist/production.css'
            }
        },

        uglify: {
            build: {
                src: 'inc/js/dist/production.js',
                dest: 'inc/js/dist/production.min.js'
            }
        },

        cssmin: {
            target: {
                files: [{
                    expand: true,
                    cwd: 'inc/css/dist',
                    src: ['*.css', '!*.min.css'],
                    dest: 'inc/css/dist',
                    ext: '.min.css'
                }]
            }
        },

        less: {
            development: {
                options: {
                    compress: true,
                    yuicompress: true,
                    optimization: 2
                },

                files: {
                    "css/less/main.css": "css/less/main.less" // destination file and source file
                }
            }
        },

        imagemin: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: 'inc/images/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'inc/images/dist/'
                }]
            }
        },

        watch: {
            js: {
                files: ['inc/js/*.js'],
                tasks: ['concat', 'uglify'],
                options: {
                    spawn: false,
                }
            },

            css: {
                files: ['inc/css/*.css'],
                tasks: ['concat', 'cssmin'],
                options: {
                    spawn: false,
                }
            },

            images: {
                files: ['img/*.{png,jpg,gif}'],
                tasks: ['imagemin'],
                options: {
                    spawn: false,
                }
            }
        }
    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['watch']);

};
