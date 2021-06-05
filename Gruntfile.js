module.exports = function(grunt) {

    grunt.initConfig({
        concat: {   
            dist: {
                src: [
                    'assets/vendor/jquery/jquery.min.js',
                    'assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
                    'assets/vendor/jquery-easing/jquery.easing.min.js',
                    'assets/js/sb-admin-2.min.js',
                    'assets/vendor/chart.js/Chart.min.js',
                ],
                dest: 'public/assets/admin/js/all-scripts.js',
            }
        },
        uglify: {
            options: {
                mangle: false,
                compress: {
                    warnings: false
                }
            },
            admin: {

                files: {
                    'public/assets/admin/js/all-scripts.min.js': [
                        'public/assets/admin/js/all-scripts.js',
                        'public/assets/admin/js/jquery.dataTables.min.js',
                        'assets/vendor/datatables/dataTables.bootstrap4.min.js',
                        'public/assets/admin/js/toastr.min.js',
                        'public/assets/admin/js/sweetalert2.all.min.js',
                    ]
                }
            },
            
        },
        cssmin: {
            options: {
              mergeIntoShorthands: false,
              roundingPrecision: -1,
            },
            client: {
              files: {
                'public/assets/admin/css/style.min.css' : [
                        'assets/vendor/fontawesome-free/css/all.min.css',
                        'assets/vendor/datatables/dataTables.bootstrap4.min.css',
                        'assets/css/sb-admin-2.min.css',
                        'assets/css/toastr.min.css',
                        'assets/css/sweetalert2.min.css',
                    ]
              }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify-es');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    // grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['concat','uglify','cssmin']);

};