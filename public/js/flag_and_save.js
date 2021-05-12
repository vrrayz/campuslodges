$("body").on("click", "#saveBtn", function () {
    var btn = $(this);
    $.ajax({
        url: '/user/lodge/save/' + $(this).attr('data-content'),
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            btn.children("i").first().toggleClass("far");
            btn.children("i").first().toggleClass("fas");
            btn.toggleClass("text-dark");
            btn.toggleClass("text-danger");
            // console.log(data.message);
        }
    })
})
$("body").on("click", "#flagBtn", function () {
    var btn = $(this);
    if (btn.hasClass('text-site')) {
        $.ajax({
            url: '/user/lodge/flag/' + $(this).attr('data-content'),
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
    }
})
$('.popup-div > .outside').click(function () {
    $('#reasonForFlagging').addClass('d-none');
})
$('#closeReason').click(function () {
    $('#reasonForFlagging').addClass('d-none');
})
$('textarea[name="reason_for_flag"]').next().click(function () {
    var reason = $('textarea[name="reason_for_flag"]');
    var id = reason.attr("id");
    // alert();
    var url = '';
    var btn = '';
    if(reason.attr('data-target') == 'property'){
        url = '/user/property/flag/' + reason.attr('id');
        btn = $('a[data-content=' + id + '][id="flagPropertyBtn"]');
    }else{
        url = '/user/lodge/flag/' + reason.attr('id');
        btn = $('a[data-content=' + id + '][id="flagBtn"]');

    }
    // var btn = $('a[data-content=' + id + '][id="flagBtn"]');
    $.ajax({
        url: url,
        type: 'POST',
        data: {reason: reason.val()},
        dataType: 'json',
        success: function (data) {
            if ($.isEmptyObject(data.error)) {
                btn.children("i").first().toggleClass("far");
                btn.children("i").first().toggleClass("fas");
                btn.toggleClass("text-dark");
                btn.toggleClass("text-site");
                reason.val('');
                $('#reasonCard').addClass('d-none');
                $('#successMessage').removeClass('d-none');
                // console.log(data.message);
            } else {
                printErrorMessage(data.error, reason.prev())
            }
        }
    })
})