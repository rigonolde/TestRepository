<h2>List des categories</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Parent</th>
                <th>Libellé</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fiches as $fiche) {
                ?>
                <tr>
                    <td><?php echo $fiche->getId(); ?></td>
                    <td><?php echo $fiche->getCategoryId() != 0 ?: "--"; ?></td>
                    <td><?php echo $fiche->getLibelle(); ?></td>
                    <td><?php echo $fiche->getDescription(); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
