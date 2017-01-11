


    function addCart(id)
    {
        $.ajax({
            type: 'POST',
            url: '/shop/web/add_cart?id=' + id,
            contentType: "application/json",
            dataType: "json",
            success: function(data){
                if(data['success']){
                    $('#cart_amount').html(data['amount']);
                    $(".delCart_"+id).show();
                    $(".addCart_"+id).hide();
                }
            }
        });
    }

    function delCart(id)
    {
        $.ajax({
            type: 'POST',
            url: '/shop/web/del_cart?id=' + id,
            contentType: "application/json",
            dataType: "json",
            success: function(data){
                if(data['success']){
                    $('#cart_amount').html(data['amount']);
                    $(".addCart_"+id).show();
                    $(".delCart_"+id).hide();
                }
            }
        });
    }

    function convPrice(id)
    {
        var countProd = $("#"+id).val();
        var rPrice = $("#price_"+id).attr('value');
        var rPnow = countProd * rPrice;
        $("#r_price_"+id).html(rPnow);
    }
    function getForm(id_form)
    {
        var fData = {};
        $('input,textarea', id_form).each(function () {
            if(this.name && this.name !='' && this.name !='reg'){
                fData[this.name] = this.value;

            }
            
        });
        return fData;
    }

    function regUser()
    {
        var postData = getForm(".reg");
        $.ajax({
            type: 'POST',
            url: '/shop/web/reg_user',
            data: postData,
            dataType: "json",
            success: function(data){
                switch (data) {
                    case "success":
                        $("#reg_f").hide();
                        location.reload();
                        break;
                    case "mail":
                        $("#msg").html("Неверный формат почтового ящика");
                        $("#msg").show(0).delay(3000).hide(0);
                        break;
                    case "already":
                        $("#msg").html("Такой  почтовый ящик уже зарегистрирован");
                        $("#msg").show(0).delay(3000).hide(0);
                        break;
                    case "length":
                        $("#msg").html("Введенный пароль должен быть > 6 символов");
                        $("#msg").show(0).delay(3000).hide(0);
                        break;
                    case "confirm":
                        $("#msg").html("Введенные пароли должны совпадать");
                        $("#msg").show(0).delay(3000).hide(0);
                        break;
                }
            }
        });
    }
    function authUser()
    {
        var postData = getForm(".auth");
        $.ajax({
            type: 'POST',
            url: '/shop/web/auth_user',
            data: postData,
            dataType: "json",
            success: function(data){
                switch (data) {
                    case "success":
                        $(".auth").hide();
                        location.reload();
                        break;
                    case "mail":
                        $("#msg_auth").html("Такой почтовый ящик не зарегистрирован");
                        $("#msg_auth").show(0).delay(3000).hide(0);
                        break;
                    case "pass":
                        $("#msg_auth").html("Неверный пароль");
                        $("#msg_auth").show(0).delay(3000).hide(0);
                        break;
                }
            }
        });
    }

    function authShow(){
        $(".reg").hide();
        $(".auth").show();
    }
    function regShow(){
        $(".auth").hide();
        $(".reg").show();

    }

    function logOut(){
        $.ajax({
            url: '/shop/web/log_out',
            success: function(){
              location.reload();
            }
        });
    }

    function upDateProfile()
    {

        var postData = {name: $("#prof input[id='name']").val(),
                        phone: $("#prof input[id='phone']").val(),
                        adress:  $("#prof textarea").val(),
                        pass1:  $("#prof input[name='pass1']").val(),
                        pass2:  $("#prof input[name='pass2']").val(),
                        current:  $("#prof input[name='current']").val()};
        $.ajax({
            type: 'POST',
            url: '/shop/web/update_prof',
            data: postData,
            dataType: "json",
            success: function(data){
                if(data == 'all'){
                    $("#mesg").html("Данные профиля, включая пароль, обновлены");
                    $("#mesg").show(0).delay(3000).hide(0);
                }
                else if(data == 'not_all'){
                    $("#mesg").html("Пароль не был обновлен");
                    $("#mesg").show(0).delay(3000).hide(0);
                }
            }
        });
    }

