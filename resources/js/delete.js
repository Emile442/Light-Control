'use strict';

let laravel = {
    initialize: function() {
        this.methodLinks = $('a[data-method]');

        this.registerEvents();
    },

    registerEvents: function() {
        this.methodLinks.on('click', this.handleMethod);
    },

    handleMethod: function(e) {
        let link = $(this);
        let httpMethod = link.data('method').toUpperCase();
        let form;

        if ( $.inArray(httpMethod, ['PUT', 'DELETE', 'POST']) === - 1 ) {
            return;
        }

        if ( link.data('confirm') ) {
            if ( ! laravel.verifyConfirm(link) ) {
                return false;
            }
        }

        form = laravel.createForm(link);
        form.submit();

        e.preventDefault();
    },

    verifyConfirm: function(link) {
        return confirm(link.data('confirm'));
    },

    createForm: function(link) {
        let form =
            $('<form>', {
                'method': 'POST',
                'action': link.attr('href')
            });

        let token =
            $('<input>', {
                'type': 'hidden',
                'name': '_token',
                'value': $('meta[name=csrf-token]').attr('content')
            });

        let hiddenInput =
            $('<input>', {
                'name': '_method',
                'type': 'hidden',
                'value': link.data('method')
            });

        if (link.data('method').toUpperCase() === 'POST')
            return form.append(token).appendTo('body');

        return form.append(token, hiddenInput).appendTo('body');
    }
};

laravel.initialize();
