<?php
   require("_partials/errors.php")
?>
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="row justify-content-center w-100">
        <div class="col-3">
            <form method="POST" autocomplete="off">
                <div class="mb-3">
                    <label for="username" class="form-label">Identifiant</label>
                    <input type="text" class="form-control" id="username" name="username" required  autocomplete="off" >
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="pass" name="pass" required  autocomplete="off" >
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="valid_login">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
