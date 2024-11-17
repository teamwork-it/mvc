<?php
if(!empty($errors)) :
    foreach($errors as $error) :
        ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php
    endforeach;
endif;
?>