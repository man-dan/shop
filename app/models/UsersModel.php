<?php


function newUser($email, $pass, $pass2)
{
    $email = trim(htmlspecialchars(pg_escape_string($email)));
    $pass = trim(htmlspecialchars(pg_escape_string($pass)));
    $pass2 = trim(htmlspecialchars(pg_escape_string($pass2)));
    $pass_bd = password_hash($pass, PASSWORD_BCRYPT, ['salt'=>SALT ] );
    $ver = verification($email,$pass, $pass2);
    if( $ver == "success"){
        pg_query(db(),"INSERT INTO users (email,pass) VALUES ('$email','$pass_bd') ");
        $_SESSION['email'] = $email;
    }
    ob_end_clean();
    echo json_encode($ver);
}

function checkOnExistingMail($email){
    $res = pg_query(db(), "SELECT email FROM users WHERE email = '$email'");
    return pg_num_rows($res);
}

function authUser($email,$pass){
    $email = trim(htmlspecialchars(pg_escape_string($email)));
    $pass = trim(htmlspecialchars(pg_escape_string($pass)));
    $res = pg_query(db(), "SELECT * FROM users WHERE  email = '$email'");
    if(pg_num_rows($res) == 1 ){
        $row = pg_fetch_assoc($res);
        if(password_verify($pass, $row["pass"])){
            $_SESSION['email'] = $email;
            return "success";
        }
        else{
            return "pass";
        }
    }
    else{
        return "mail";
    }
}

function userIn($email, $pass){
    ob_end_clean();
    echo json_encode(authUser($email, $pass));
}

function verification($email, $pass, $pass2){

    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    {   if(checkOnExistingMail($email) > 0) return "already";
        if(mb_strlen($pass) >6)
        {
            if($pass === $pass2)
            {
                return "success";
            }
            else
            {
                return "confirm";
            }
        }
        else
        {
            return "length";
        }
    }
    else
    {
        return "mail";
    }
}

function selectProfile($email){
    $res =  pg_query(db(), "SELECT * FROM users WHERE email = '$email'");
    return pg_fetch_assoc($res);
}

function userProfile($email){
    $row = selectProfile($email);
    echo "<br><div id='profile'>Ваш профиль:<div id='mesg'></div>";
    echo "<form id='prof'><label>Email:</label>{$email}<br><label>Name</label><input type='text' value= '{$row["name"]}' id='name' /><br>
    <label>Phone</label><input type='text' id='phone' value='{$row["phone"]}'/><br>
    <label id='adr'>Adress</label><textarea id='adress'>{$row['adress']}</textarea><br>
    <label>Новый пароль:</label><input type='password' name='pass1'/><br>
    <label>Повторите пароль</label>    <input type='password' name='pass2'/><br>
    <label>Введите текущий пароль что бы изменить пароль</label><input type='password' name='current'/><br>
    <input type='button' value='Сохранить изминения' style='margin-left: 15%;' onClick='upDateProfile();'/>
    </form></div>";

}

function updateProfile($email)
{
    $row = selectProfile($email);
    $current = trim(htmlspecialchars(pg_escape_string($_POST['current'])));
    $pass1 = trim(htmlspecialchars(pg_escape_string($_POST['pass1'])));
    $pass_bd_new = password_hash($pass1, PASSWORD_BCRYPT, ['salt'=>SALT ] );
    $name = htmlspecialchars(pg_escape_string($_POST['name']));
    $adress = htmlspecialchars(pg_escape_string($_POST['adress']));
    $phone = htmlspecialchars(pg_escape_string($_POST['phone']));

    if(password_verify($current, $row["pass"]) && $pass1 == trim(htmlspecialchars(pg_escape_string($_POST['pass2']))))
    {
        pg_query(db(), "UPDATE users SET name = '$name', phone = '$phone', adress = '$adress', pass = '$pass_bd_new' WHERE email = '$email' ");
        ob_end_clean();
        echo json_encode('all');
    }
    else{
        pg_query(db(), "UPDATE users SET name = '$name', phone = '$phone', adress = '$adress' WHERE email = '$email' ");
        ob_end_clean();
        echo json_encode('not_all');
    }
}

