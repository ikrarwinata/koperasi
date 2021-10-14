$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 20) {
            $('#toTopBtn').fadeIn();
        } else {
            $('#toTopBtn').fadeOut();
        }
    });

    $("#sidebar-togle").click();


    if ($('.select2').length >= 1) $('.select2').select2();

    if ($('.select2bs4').length >= 1) {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    };
});
var CURRENT_URL = window.location.href.split('#')[0].split('?')[0],
    $SIDEBAR_MENU = $('.main-sidebar');

$SIDEBAR_MENU.find('a').filter(function() {
    return this.href == CURRENT_URL;
}).parent('li').parents('ul').parent('li').addClass('menu-is-opening menu-open');

$SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').addClass('active');

if ($('.bs-stepper').length >= 1) {
    document.addEventListener('DOMContentLoaded', function() {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'), {
            animation: true
        });
    });
};

$("input[data-bootstrap-switch]").each(function() {
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
    $(this).bootstrapSwitch('size', 'mini');
})

$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})

$("a.toggle-detail").click(function(e) {
    e.preventDefault();
    if ($("#" + $(this).attr("data-toggle"))) {
        if ($("#" + $(this).attr("data-toggle")).hasClass("d-none")) {
            $(this).find("i").removeClass("fa-chevron-down");
            $(this).find("i").addClass("fa-chevron-up");
        } else {
            $(this).find("i").removeClass("fa-chevron-up");
            $(this).find("i").addClass("fa-chevron-down");
        }
        $(this).find("i").toggleClass("text-success");
        $("#" + $(this).attr("data-toggle")).toggleClass("d-none");
        $(this).closest("tr").toggleClass("active selected table-dark");
    }
    return false;
});

$(".table-parent-checkbox").change(function() {
    var p = this
    $(".child-table-checkbox").each(function() {
        var c = this;
        c.checked = p.checked
    })
})

var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

function copy(that) {
    var inp = document.createElement('input');
    document.body.appendChild(inp)
    inp.value = that.textContent
    inp.select();
    document.execCommand('copy', false);
    inp.remove();
    Toast.fire({
        icon: 'success',
        title: '&nbsp;Text berhasil disalin.'
    })
    return false;
}