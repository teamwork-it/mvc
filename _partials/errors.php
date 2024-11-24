<?php
if(!empty($this->errors)) :
    foreach($this->errors as $error) :
        ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php
    endforeach;
endif;
?>