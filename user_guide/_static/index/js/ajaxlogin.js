
$(function  () {

    $('#login').click(function(event) {
        formdata = $('#loginform').serialize();

        console.log(formdata);
        $.ajax({
            url:'./checkLogin.php',
            type :'post',
            dataType :'json',
            data : formdata
        })
            .done(function (res) {
                if(res.error==0){
                    console.log(res.info);
                    alert(res.info)
                    location.reload();
                }else{
                    console.log(res.info);
                    alert(res.info)
                }

            })
            .fail(function () {
                console.log('error');
            })
    });
});
