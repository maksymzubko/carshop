<!DOCTYPE html>

<head>
    <?php require_once 'head.php' ?>
    <title>Shown cars</title>
</head>

<body style="height: auto;">
    <?php require_once 'header.php' ?>
    <section></section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 test">
                <div class="top text-start">
                        <h2 class="m-0">Тест-драйви</h2>
                    </div>
                    <div class="switch_test text-center"><button id=0 class="btn">Архів</button><button style="margin-left: 10px;" class="btn" id=1>Закінчені</button><button id=2 style="margin-left: 10px;" class="btn active">Незакінчені</button></div>
                    <div class="table-responsive">
                        <table id="data" class="table table-bordered table-striped" style="width:100%">
                            <thead class="table-dark">
                                <tr>
                                    <th>#ID</th>
                                    <th>#ID Користувача</th>
                                    <th>Прізвище</th>
                                    <th>Ім'я</th>
                                    <th>#ID Авто</th>
                                    <th>Марка</th>
                                    <th>Модель</th>
                                    <th>Дата</th>
                                    <th>Час</th>
                                    <th>Статус</th>
                                    <th>Прибув?</th>
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