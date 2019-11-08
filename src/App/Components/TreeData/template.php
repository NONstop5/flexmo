<div class="container-fluid">
    <div class="form-group">
        <button type="button" class="btn btn-success button-db-save">
            Сохранить данные в БД в полях
        </button>
        <button type="button" class="btn btn-success button-db-save_json">
            Сохранить данные в БД в поле JSON
        </button>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>position</th>
            <th>title</th>
            <th>value</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($treeData as $item) : ?>
            <tr>
                <td><?php echo $item['position'] ?></td>
                <td><?php echo $item['title'] ?></td>
                <td><?php echo $item['value'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
