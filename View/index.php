<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>
                        id
                    </th>
                    <th>
                        parent id
                    </th>
                    <th>
                        libelle
                    </th>
                    <th>
                        description
                    </th>
                    <th>

                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($category as $value) {
                    ?>
                    <tr>
                        <td><?php echo $value["id"] ?></td>
                        <td><?php echo $value["parentId"] != 0 ?: "--" ?></td>
                        <td><?php echo $value["libelle"] ?></td>
                        <td><?php echo $value["description"] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>
