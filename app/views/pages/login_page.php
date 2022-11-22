<h2 class="header_color">Login</h2>
<form id="login_form" method="POST" action="/main/login">
    <div> 
        <label>Username :</label>
        <input type="text" name="username" title="must be more 4 symbols, less then 20, contain at least 1 letter and 1 digit">
    </div>
    <div> 
        <label>Password :</label>
        <input type="password" name="password" title="must be more 7 symbols, contain at least 1 capital letter and 1 digit">
        <input type="hidden" name="action" value="login">
    </div>
    <input id="login_submit" type="submit" value="Login">
</form>