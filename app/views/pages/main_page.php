<h1>Phonebook</h1>
<div id="menu">
    <?php if($_SESSION['login']) { ?>
        <form method="POST">
            <input type="hidden" name="action" value="logout">
            <input type="submit" value="Logout">
        </form>
        <button id="public">Public Phonebook</button>
        <button id="contact">My Contact</button>
    <?php } else { ?>
        <button id="login" onclick="showLoginPage()">Login</button>
        <button id="public">Public Phonebook</button>
    <?php } ?>
</div>
<div id="content">
    <?php if($_SESSION['message']) echo $_SESSION['message'] ?>
</div>