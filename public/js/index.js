$(".change").click(function(){
    var id = $(this).attr("data-id")
    var done = $(this).val()
    var token = $(".token").val()
    $.ajax({
        url: "/changedone",
        type:"put",
        data:{
            id:id,
            done:done,
            _token: token
        },
        error: function (err) {
            window.location.href = "/login"
        }
    });

})
