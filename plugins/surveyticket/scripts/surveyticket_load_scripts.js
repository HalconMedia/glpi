
/** 
 *  Load plugin scripts on page start
 */
(function ($) {
    $.fn.surveyticket_load_scripts = function () {

        init();

        // Start the plugin
        function init() {

            var path = 'plugins/surveyticket/';
            var url = window.location.href.replace(/front\/.*/, path);
            if (window.location.href.indexOf('plugins') > 0) {
                url = window.location.href.replace(/plugins\/.*/, path);
            }
            // Send data
            $.ajax({
                url: url + 'ajax/loadscripts.php',
                    type: "POST",
                    dataType: "html",
                    data: 'action=load',
                    success: function (response, opts) {
                        var scripts, scriptsFinder = /<script[^>]*>([\s\S]+?)<\/script>/gi;
                        while (scripts = scriptsFinder.exec(response)) {
                            eval(scripts[1]);
                        }
                    }
                });
        }

        return this;
    }
}(jQuery));

$(document).surveyticket_load_scripts();
