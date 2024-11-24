<?php
/**
 * @var array $posts
 */
require("_partials/errors.php")
?>
<div class="row">
    <div class="col">
        <div class="h1 pt-2 pb-2 text-center">Liste des Posts</div>
        <div class="row">
            <div class="mb-3 d-flex justify-content-end">
                <a href="index.php?component=user" type="button" class="btn btn-primary" ><i class="fa fa-plus me-2"></i>Ajouter</a>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titre</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <th scope="row"><?php echo $post->id ?></th>
                    <td><?php echo $post->title; ?></td>
                    <td>
                        <a href="index.php?component=post&id=<?php echo $post->id ?>">
                            <i class="fa fa-edit text-success"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach;; ?>
            </tbody>
        </table>
    </div>
</div>