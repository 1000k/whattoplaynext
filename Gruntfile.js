module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
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
      files: ['<%= jshint.files %>'],
      tasks: ['jshint', 'qunit']
    }
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-qunit');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');

  grunt.registerTask('test', ['jshint']);
  grunt.registerTask('default', ['jshint', 'concat', 'uglify']);
  grunt.registerTask('merge', ['concat', 'uglify']);

};
