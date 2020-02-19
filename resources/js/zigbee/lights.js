$(document).ready(function() {

    /* Load Light Table */
    $(".light-list").each(function (index) {
        let id = $(this).attr('data-id')

        $.get("/api/v1/light/" + id, function( data ) {
            if (data.state.on === true) {
                $("#light-state-" + id).addClass("text-warning")
                $("#light-button-" + id).html("<span></span>On").addClass("btn-success")
            } else {
                $("#light-button-" + id).html("<span></span>On")
            }
        }).fail(function() {
            new Noty({
                type: 'error',
                theme: 'mint',
                layout: 'topRight',
                text: "Unable to get light: #" + id,
                closeWith: ['click', 'button'],
                timeout: 3000
            }).show();
            $("#light-button-" + id).html('<span></span>Unable to connect').addClass("btn-danger").removeClass("btn-light-change-state");
            $("#light-state-" + id).addClass("text-danger")
        });
    })


    /* Light Switch Button */
    $('.btn-light-change-state').click(function () {
        let btn = $(this);
        let id = btn.attr('data-id')
        let classSuccess = 'btn-success'

        $.ajax({
            url: "/api/v1/light/" + id + "/state",
            type: 'get',
            beforeSend: function(){
                btn.find('span').html('<i class="fa fa-spinner fa-spin"></i>  ')
            },
            success: function(response){
                if (response.state) {
                    btn.html("<span></span>On")
                    $("#light-state-" + id).addClass("text-warning")
                    btn.addClass(classSuccess)
                } else {
                    btn.html("<span></span>On")
                    $("#light-state-" + id).removeClass("text-warning")
                    btn.removeClass(classSuccess)
                }
            },
            complete: function(data){
                btn.find('span').empty()
            }
        }).fail(function (response) {
            response.responseJSON.errors.forEach(function (item) {
                new Noty({
                    type: 'error',
                    theme: 'mint',
                    layout: 'topRight',
                    text: item,
                    closeWith: ['click', 'button'],
                    timeout: 3000
                }).show();
            })
        });

    });
});
