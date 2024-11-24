<?php
/**
 * @var array $users
 */
require("_partials/errors.php")
?>
<div class="row">
    <div class="col">
        <div class="h1 pt-2 pb-2 text-center">Liste des utilisateurs</div>
        <div class="row">
            <div class="mb-3 d-flex justify-content-end">
                <a href="index.php?component=user&action=create" type="button" class="btn btn-primary" ><i class="fa fa-plus me-2"></i>Ajouter</a>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Identifiant</th>
                <th scope="col">Actif</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <th scope="row"><?php echo $user->getId(); ?></th>
                    <td><?php echo $user->getUsername(); ?></td>
                    <td><?php echo $user->getEnabled() ? 'Oui' : 'Non'; ?></td>
                    <td>
                        <a href="index.php?component=user&action=edit&id=<?php  echo $user->getId(); ?>">
                            <i class="fa fa-edit text-success"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach;; ?>
            </tbody>
        </table>
    </div>
</div>