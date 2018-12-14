
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


$(document).ready(function () {
    $('.sort-container').sortable({
        placeholder: "ui-state-highlight",
        handle: ".dragdrop-handle",
        opacity: 0.5,
        cursor: "move",
        update: function (event, ui) {
            $('.sort-order-value').each(function (index, value) {
                console.log(index);
                if (0 == index) {
                    $(value).parent().find('.delete-handle').hide();
                } else {
                    $(value).parent().find('.delete-handle').show();
                }
                $(value).val(index + 1);
            });
        }
    });
    $('.sort-container').disableSelection();
});
