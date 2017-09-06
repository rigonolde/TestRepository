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
            <?php foreach ($categories as $category) {
                ?>
                <tr>
                    <td><?php echo $category->getId(); ?></td>
                    <td><?php echo $category->getParentId() != 0 ?: "--"; ?></td>
                    <td><?php echo $category->getLibelle(); ?></td>
                    <td><?php echo $category->getDescription(); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
