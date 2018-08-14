
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window._ = require('lodash');
window.Popper = require('popper.js').default;

window.$ = window.jQuery = require('jquery');






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