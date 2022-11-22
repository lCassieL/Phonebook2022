<form method="POST" action="/main/editcontact" onsubmit="return validateForm()" id="mycontact_form">
    <div id="my_title"><h2 class="header_color">My Contact<h2></div>
    <div id="my_publish">
        <label>Publish my contact</label>
        <input type="hidden" name="publish_contact" value="0">
        <input type="checkbox" name="publish_contact" value="1" <?= (int)$this->user[0]['publish'] ? 'checked' : '' ?>>
    </div>
    <div id="my_contacts">
        <a href="javascript:void(0)" role="button" class="like_header">Contact</a>
        <div>
            <label>Firstname:</label>
            <input type="text" name="firstname" value="<?= $this->user[0]['firstname'] ?>">
        </div>
        <div>
            <label>Lastname:</label>
            <input type="text" name="lastname" value="<?= $this->user[0]['lastname'] ?>">
        </div>
        <div>
            <label>Address:</label>
            <input type="text" name="address" value="<?= $this->user[0]['address'] ?>">
        </div>
        <div>
            <label>ZIP/City:</label>
            <input type="text" name="city" value="<?= $this->user[0]['city'] ?>">
        </div>
        <div>
            <label>Country:</label>
            <select name="country">
                <?php foreach($this->countries as $country){ ?>
                    <option value="<?= $country['id'] ?>" <?= (int)$this->user[0]['country_id'] == (int)$country['id'] ? 'selected' : '' ?>><?= $country['name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div id="my_phones">
        <a href="javascript:void(0)" role="button" class="like_header">Phones</a>
        <?php foreach($this->phones as $phone) { ?>
            <div>
                <input type="tel" name="phones[]" value="<?= $phone['number'] ?>" pattern="[\+][0-9]{12}" placeholder="+380000000000">
                <input type="hidden" name="phones_id[]" value="<?= $phone['id'] ?>">
                <input type="hidden" name="phones_checkbox[]" value="0">
                <input type="checkbox" name="phones_checkbox[]" value="1" <?= (int)$phone['publish'] ? 'checked' : '' ?>>
            </div>
        <?php } ?>
        <a href="javascript:void(0)" role="button" onclick="addPhone(this)" class="like_block">add</a>
    </div>
    <div id="my_emails">
        <a href="javascript:void(0)" role="button" class="like_header">Emails</a>
        <?php foreach($this->emails as $email) { ?>
            <div>
                <input type="email" name="emails[]" value="<?= $email['email'] ?>">
                <input type="hidden" name="emails_id[]" value="<?= $email['id'] ?>">
                <input type="hidden" name="emails_checkbox[]" value="0">
                <input type="checkbox" name="emails_checkbox[]" value="1" <?= (int)$email['publish'] ? 'checked' : '' ?>>
            </div>
        <?php } ?>
        <a href="javascript:void(0)" role="button" onclick="addEmail(this)" class="like_block">add</a>
    </div>
    <div id="my_submit"><input type="submit" value="save"></div>
</form>