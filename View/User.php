<?php
/**
 * @var string $action
 * @var User $user
 */
require("_partials/errors.php")
?>
<div class="row">
    <div class="col">
        <div class="h1 pt-2 pb-2 text-center">Créer / Modifier un utilisateur</div>
        <form action="index.php?component=user&action=<?php   echo (!empty($_GET['id'])) ? "update&id={$_GET['id']}" : 'insert'?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Identifiant</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php  echo isset($user) ? $user->getUsername() : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="pass" name="pass" <?php  echo ('create' === $this->action) ? 'required' : ''; ?>>
            </div>
            <div class="mb-3">
                <label for="confirmation" class="form-label">Confirmation</label>
                <input type="password" class="form-control" id="confirmation" name="confirmation" <?php  echo ('create' === $this->action) ? 'required' : ''; ?> >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php  echo isset($user) ? $user->getEmail() : ''; ?>" required>
            </div>
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input
                            class="form-check-input"
                            type="checkbox"
                            role="switch"
                            id="enabled"
                            name="enabled"
                            <?php  echo (isset($user) && !empty($user->getEnabled())) ? 'checked' : null ; ?>
                    >
                    <label class="form-check-label" for="flexSwitchCheckChecked">Compte actif</label>
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" name="<?php echo $this->action; ?>_button">Enregistrer</button>
            </div>
        </form>
    </div>
</div>