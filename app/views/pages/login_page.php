<h2 class="header_color">Login</h2>
<form id="login_form" method="POST" action="/main/login">
    <div> 
        <label>Username :</label>
        <input type="text" name="username">
    </div>
    <div> 
        <label>Password :</label>
        <input type="text" name="password">
        <input type="hidden" name="action" value="login">
    </div>
    <input id="login_submit" type="submit" value="Login">
</form>