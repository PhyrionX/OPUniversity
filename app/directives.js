angular.module('FinalApp')

    .directive('footer', function(){
        return {
            restrict: 'E',
            templateUrl: 'partials/layout/footer.html'
        }
    })
    
    .directive('navbar', function(){
        return {
            restrict: 'E',
            templateUrl: 'templates/layout/navbar.html'
            //controller: 'NavbarController'
        }
    })

    .directive('sidebar', function(){
        return {
            restrict: 'E',
            templateUrl: 'partials/layout/sidebar.html',
            controller: 'SidebarCtrl'
        }
        
    })
    .directive('fileModel', ['$parse', function ($parse) {
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                var model = $parse(attrs.fileModel);
                var modelSetter = model.assign;
                
                element.bind('change', function(){
                    scope.$apply(function(){
                        modelSetter(scope, element[0].files[0]);
                    });
                });
            }
        };
    }]);