(function ($, undefined) {

    $.nette.ext('spinner', {
        init: function (x) {
            this.spinner = this.createSpinner();
            this.spinner.appendTo('body');
        },
        start: function (jqXHR, settings) {
            this.spinner.css({
                left: 'calc(50% - 74px)',
                top: '30%'
            });
            this.spinner.show(this.speed);
        },
        complete: function () {
            this.spinner.hide(this.speed);
        }
    }, {
        createSpinner: function () {
            var spinner = $('<div>', {
                id: 'ajax-spinner',
                css: {
                    display: 'none'
                }
            });

            return spinner;
        },
        spinner: null,
        speed: undefined
    });

})(jQuery);