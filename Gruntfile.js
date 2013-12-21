module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    // Note: gem sass 3.2.11 & 3.2.12 is broken so you should use
    // SASS 3.2.10 with `sudo gem install sass -v 3.2.10`
    compass: {
      dist: {
        options: {
          sassDir: 'app/webroot/sass',
          cssDir: 'app/webroot/css'
        }
      }
    },
    cssmin: {
      add_banner: {
        options: {
          banner: '/* What to Play Next? - screen CSS */'
        },
        files: {
          'app/webroot/css/wpn.min.css': ['app/webroot/css/wpn.css']
        }
      },
      minify: {
        expand: true,
        cwd: 'app/webroot/css/',
        src: ['*.css', '!*.min.css'],
        dest: 'app/webroot/css/',
        ext: '.min.css',
      }
    },
    concat: {
      options: {
        separator: ';'
      },
      dist: {
        src: [
          'app/webroot/js/vendor/jquery/jquery.js',
          'app/webroot/js/vendor/jquery-mousewheel/jquery.mousewheel.js',
          'app/webroot/js/vendor/underscore/underscore.js',
          'app/webroot/js/vendor/backbone/backbone.js',
          'app/webroot/js/vendor/backbone.localStorage/backbone.localStorage.js',
          'app/webroot/js/vendor/hook/hook.js',
          'app/webroot/js/vendor/mobify-modules/carousel/src/carousel.js',
          'app/webroot/js/vendor/html5lightbox.js',
          'app/webroot/js/vendor/snap/snap.js',
          'app/webroot/js/app.js'
        ],
        dest: 'app/webroot/js/wpn.js'
      }
    },
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
      },
      dist: {
        files: {
          'app/webroot/js/wpn.min.js': ['<%= concat.dist.dest %>']
        }
      }
    },
    jshint: {
      files: ['gruntfile.js', 'app/webroot/js/**/*.js'],
      options: {
        // options here to override JSHint defaults
        globals: {
          jQuery: true,
          console: true,
          module: true,
          document: true
        }
      }
    },
    watch: {
      options: {
        spawn: false
      },
      scripts: {
        files: ['<%= jshint.files %>'],
        tasks: ['concat', 'uglify']
      },
      css: {
        files: ['app/webroot/sass/*.scss'],
        tasks: ['compass', 'cssmin']
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-qunit');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');

  grunt.registerTask('test', ['jshint']);
  grunt.registerTask('default', ['jshint', 'concat', 'uglify']);
  grunt.registerTask('merge', ['concat', 'uglify']);

};
