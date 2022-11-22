<!-- <div class="showInfo"> -->
    <div class="details_column">
        <a href="javascript:void(0)" role="button" class="like_header">Address</a>
        <div class="details_wrapper_data">
            <div><?= $this->user[0]['address'] ?></div>
            <div><?= $this->user[0]['city'] ?></div>
            <div><?= $this->user[0]['country'] ?></div>
        </div>
    </div>
    <div class="details_column">
        <a href="javascript:void(0)" role="button" class="like_header">Phone numbers</a>
        <div>
            <?php foreach($this->phones as $phone) { ?>
                <div><?= $phone['number'] ?></div>
            <?php } ?>
        </div>
    </div>
    <div class="details_column">
        <a href="javascript:void(0)" role="button" class="like_header">Emails</a>
        <div>
            <?php foreach($this->emails as $email) { ?>
                <div><?= $email['email'] ?></div>
            <?php } ?>
        </div>
    </div>
<!-- </div> -->