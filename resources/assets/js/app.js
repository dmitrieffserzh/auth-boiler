
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window._ = require('lodash');
window.Popper = require('popper.js').default;

window.$ = window.jQuery = require('jquery');

// BOOTSTRAP COMPONENTS
// require('./_bootstrap/index.js');
require('./_bootstrap/util.js');
require('./_bootstrap/modal.js');
require('./_bootstrap/dropdown.js');


// LIKE SYSTEM
$(document).on('click', '.component-likes__button', function () {
    var that_main = $(this).parent();
    var data      = $(this).data();
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: data,
        type: 'POST',
        url: '/like_handler',
        success: function (result) {
            that_main.find('.component-likes__count').text(result.like_count);
            if (result.liked === true) {
                that_main.find('.component-likes__button').removeClass('like--false').addClass('like--true');
            } else {
                that_main.find('.component-likes__button').removeClass('like--true').addClass('like--false');
            }
        }
    });
    event.preventDefault();
});


// MODAL WINDOW
$(function () {
    $('.ajax').on('click', function (event) {

        event.preventDefault();

        // MODAL
        var modal_window    = $('.modal');
        var modal_container = $('.modal-dialog');
        var modal_content   = '.modal-body';

        // DATA
        var data_url        = $(this).data('url');
        var data_name       = $(this).data('name');
        var data_content    = $(this).data('content');
        var modal_size      = $(this).data('modal-size');

        if(modal_size) modal_window.find(modal_container).addClass(modal_size);

        modal_window.find(modal_container).append(
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<h6 class="modal-title">' + data_name + '</h6>' +
            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '</div>' +
            '<div class="modal-body">' +
            '</div>' +
            '</div>');

        if(data_url === '#') {
            modal_window.find(modal_content).append(data_content);
            modal_window.modal('show');
        } else {
            $.ajax({
                url: data_url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                success: function (data) {
                    modal_window.find(modal_content).append(data.html);
                },
                complete: function () {
                    modal_window.modal('show');
                }
            });
        }

        if(data_content) {
            modal_window.find(modal_content).append(data_content);
        }

        // CLEAR MODAL CONTENT
        modal_window.on('hidden.bs.modal', function () {
            $(this).find(modal_container).children().remove();
            if(modal_size) modal_window.find(modal_container).removeClass(modal_size);
        });
    });
});
