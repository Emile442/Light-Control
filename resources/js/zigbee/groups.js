$(document).ready(function() {
    $('.btn-group-change-state').click(function () {
        let btn = $(this);
        $.ajax({
            url: "/api/v1/group/" + $(this).attr("data-id") + "/state/" + $(this).attr("data-state"),
            type: 'get',
            beforeSend: function(){
                btn.find('span').html('<i class="fa fa-spinner fa-spin"></i>  ')
            },
            complete: function(data){
                btn.find('span').html("")
            }
        }).fail(function (response) {
            if (response.status === 500) {
                new Noty({
                    type: 'error',
                    theme: 'mint',
                    layout: 'topRight',
                    text: "Unable to get the bridge",
                    closeWith: ['click', 'button'],
                    timeout: 3000
                }).show();
            } else {
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
            }
        });

    });
});
