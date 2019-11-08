<div class="card-deck">
    <div class="card">
        <div class="card-header">Вариант 1 (PHP)</div>
        <div class="card-body">
            <?php echo $treePhp; ?>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Вариант 2 (CSS - лайф-хак)</div>
        <div class="card-body">
            <?php foreach ($treeCss as $item) : ?>
                <?php
                $position = $item['position'];
                $title = $item['title'];
                $value = $item['value'];
                $level = $item['level'];
                ?>
                <ul class="life-hack" style="margin-left: <?php echo $level * 30 ?>px">
                    <li><b><?php echo $position ?></b> - <i><?php echo $title ?></i> - <u><?php echo $value ?></u></li>
                </ul>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Вариант 3 (Javascript + Ajax)</div>
        <div class="card-body">
            <div class="form-group">
                <button type="button" class="btn btn-success button-get-data">
                    Получить данные из БД
                </button>
            </div>
            <div class="hummingbird-treeview-converter">
                <li>Warner Bros.</li>
                <li>-Goodfellas</li>
                <li>--Robert De Niro</li>
                <li>--Joe Pesci</li>
                <li>-The Shawshank Redemption</li>
                <li>--Tim Robbins</li>
                <li>--Morgan Freeman</li>
                <li>Paramount</li>
                <li>-The Untouchables</li>
                <li>--Robert De Niro</li>
                <li>--Kevin Costner</li>
                <li>-Forrest Gump</li>
                <li>--Tom Hanks</li>
                <li>--Robin Wright</li>
            </div>
        </div>
    </div>
</div>
