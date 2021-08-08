$(".change").click(function(){
    var done

    var attr = $(this).attr('checked')
    if (typeof attr !== 'undefined' && attr !== false) {
        $(this).removeAttr('checked')
        var done = 'of'
    }else{
         var done = 'on'
    }
    var id = $(this).attr("data-id")
    var token = $(".token").val()
    console.log(done)

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
