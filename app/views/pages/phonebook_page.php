<h2 class="header_color">Public Phonebook</h2>
<div id="phonebook_list">
    <?php foreach($this->users as $key=>$user) { ?>
        <?php if(!(int)$user['publish']) continue; ?>
        <div class="phonebook_item">
            <div class="contact"><?= $key + 1 ?>. <?= $user['firstname'] ?> <?= $user['lastname'] ?></div> 
            <a href="javascript:void(0)" role="button" onclick="showDetails(this, <?= $user['id'] ?>)">view details</a>
            <div class="details_wrapper" id="details<?= $user['id'] ?>"></div>
        </div>
    <?php } ?>
</div>