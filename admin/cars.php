<!DOCTYPE html>

<head>
    <?php require_once 'head.php' ?>
    <title>Автівки</title>
</head>

<body>
    <?php require_once 'header.php' ?>
    <section></section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 test">
                    <div class="top text-start">
                        <h2 class="m-0">Автівки</h2>
                    </div>
                    <div class="table-responsive">
                        <table id="data" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Зоображення</th>
                                    <th>Марка</th>
                                    <th>Модель</th>
                                    <th>Колір</th>
                                    <th>Рік</th>
                                    <th>Кількість</th>
                                    <th>Ціна за тест-драйв</th>
                                    <th>Ціна</th>
                                    <th>Зображення</th>
                                </tr>
                            </thead>
                            <tbody class="body"></tbody>
                        </table>
                        <h1 class="text-center error">Інформація відсутня</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require_once 'scripts.php' ?>
</body>

</html>