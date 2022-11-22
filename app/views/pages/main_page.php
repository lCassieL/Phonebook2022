<h1 class="header_color">Phonebook</h1>
<div id="menu">
    <?php if($_SESSION['login']) { ?>
        <form method="POST" action="/main/logout">
            <input type="hidden" name="action" value="logout">
            <input type="submit" class="menu_button" value="Logout">
        </form>
        <button id="public" onclick="showPhonebook()">Public Phonebook</button>
        <button id="mycontact" onclick="showMyContact()">My Contact</button>
    <?php } else { ?>
        <button id="login" onclick="showLoginPage()">Login</button>
        <button id="public" onclick="showPhonebook()">Public Phonebook</button>
    <?php } ?>
</div>
<div id="content">
    <?php if($_SESSION['message']) echo $_SESSION['message'] ?>
</div>