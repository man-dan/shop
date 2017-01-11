
<div id="left_side">
<div class="lft"><a href='cart' title='Перейти в карзину'><h2>Корзина</h2></a>&nbsp;&nbsp;В корзине
        <span id="cart_amount">
        <?php  if(count($_SESSION['cart']) == 0) echo "пусто";
               else echo count($_SESSION['cart']); ?>
    </span></div>
<?php get_cats(); ?>
    <?php if(!isset($_SESSION['email'])){ ?>
    <div id="reg_f" class="auth" ><a href='#' title='Авторизация'><h2>Авторизация</h2></a>
        <div id="t_reg"> <div id="msg_auth" ></div>
            <label>Email </label><br>
            <input type="email" name="mail" id='in' placeholder="Enter your email" required/><br>
            <label>Password</label><br>
            <input type="password" name="pass1" id='in' placeholder="Enter password" required  minlength='7'/><br><br>
            <div id="bt"><input type="submit" name="reg" value="Log in" class="btn btn-success" id="btnflg" style="font-weight: bold;" onClick="authUser();"/></div>
            <div id="reg_link"><a href="#" onClick="regShow(); return false;">Не зарегистрированы?</a></div></div>
    </div>
<div id="reg_f" class="reg" style="display: none;"><a href='#' title='Регистрация'><h2>Регистрация</h2></a>
       <div id="t_reg"><div id="msg" ></div>
        <label>Email </label><br>
        <input type="email" name="mail" id='in' placeholder="Enter your email" required/><br>
        <label>Password</label><br>
        <input type="password" name="pass1" id='in' placeholder="Password > 6 символов" required  minlength='7'/><br>
        <label>Confirm Password</label><br>
        <input type="password" name="pass2" id='in' placeholder="Confirm password" required  minlength='7'/><br><br>
        <div id="bt"><input type="submit" name="reg" value="Reg in" class="btn btn-success" id="btnflg" style="font-weight: bold;" onClick="regUser();"/></div>
        <div id="reg_link"><a href="#" onClick="authShow(); return false;">Уже зарегистрированы?</a></div></div>
    </div>

<?php }
    else{
        echo "<a href='#' title='User'><h2>Вы зашли<br>как:</h2></a><a href='user' style='color:black;'>{$_SESSION['email']}</a><p><a href='#' onClick='logOut(); return false;'>Выйти</a></p>";
    }
?>


</div>