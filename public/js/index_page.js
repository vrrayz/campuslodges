$(".price").on("keyup", function (event) {
    // alert($(this).val());
    var selection = window.getSelection().toString();
    if (selection !== '') {
        return;
    }
    if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {
        return;
    }
    var input = $(this).val().replace(/[\D\s\._\-]+/g, "");
    input = input ? parseInt(input, 10) : 0;

    $(this).val(function () {
        return (input === 0) ? "" : input.toLocaleString("en-Us");
    });
})
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
$("body").on("click", "#savePropertyBtn", function () {
    var btn = $(this);
    $.ajax({
        url: '/user/property/save/' + $(this).attr('data-content'),
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            btn.children("i").first().toggleClass("far");
            btn.children("i").first().toggleClass("fas");
            btn.toggleClass("text-dark");
            btn.toggleClass("text-danger");
            console.log(data.message);
        }
    })
})
$("body").on("click", "#flagPropertyBtn", function () {
    var btn = $(this);
    if (btn.hasClass('text-site')) {
        $.ajax({
            url: '/user/property/flag/' + $(this).attr('data-content'),
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                btn.children("i").first().toggleClass("far");
                btn.children("i").first().toggleClass("fas");
                btn.toggleClass("text-dark");
                btn.toggleClass("text-site");
                // console.log(data.message);
            }
        })
    } else {
        $('#reasonForFlagging').removeClass('d-none');
        $('#reasonCard').removeClass('d-none');
        $('#successMessage').addClass('d-none');
        $('textarea[name="reason_for_flag"]').attr('id', btn.attr('data-content'));
        $('textarea[name="reason_for_flag"]').attr('data-target', 'property');
    }
})
function printErrorMessage(error, error_tag) {
    $.each(error, function (key, value) {
        error_tag.text(value);
    })
}