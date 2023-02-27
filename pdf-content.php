<?php
include_once "includes/header.php";
include_once "includes/navbar.php";
?>


<main class="container">
    <section class="row">
        <div class="col-12 my-3">

            <h1>liste des utilisateurs</h1>

            <table class="table table-hover mx-3">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nom</th>
                        <th>Courriel</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['nick'] ?></td>
                        <td><?= $user['email'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit">Télécharcher</button>
        </div>
    </section>
</main>

<?php
include_once "includes/footer.php"
?>