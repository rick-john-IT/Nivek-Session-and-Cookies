const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('navbar');

if (bar) {
    bar.addEventListener('click', () => {
        nav.classList.add('active');
    })
}

if (close) {
    close.addEventListener('click', () => {
        nav.classList.remove('active');
    })
}

  /* Login*/

  $(function(){
    $('#create_account').click(function(){
        uni_modal("","registration.php","mid-large")
    })
    $('#login-form').submit(function(e){
        e.preventDefault();
        start_loader()
        if($('.err-msg').length > 0)
            $('.err-msg').remove();
        $.ajax({
            url:_base_url_+"classes/Login.php?f=login_user",
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("an error occured",'error')
                end_loader()
            },
            success:function(resp){
                if(typeof resp == 'object' && resp.status == 'success'){
                    alert_toast("Login Successfully",'success')
                    setTimeout(function(){
                        location.reload()
                    },2000)
                }else if(resp.status == 'incorrect'){
                    var _err_el = $('<div>')
                        _err_el.addClass("alert alert-danger err-msg").text("Incorrect Credentials.")
                    $('#login-form').prepend(_err_el)
                    end_loader()
                    
                }else{
                    console.log(resp)
                    alert_toast("an error occured",'error')
                    end_loader()
                }
            }
        })
    })
})