<!DOCTYPE html>

<head>
    <?php require_once 'head.php' ?>
    <title>Користувачі</title>
</head>

<body>
    <?php require_once 'header.php' ?>

    <section></section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 test">
                <div class="top text-start">
                        <h2 class="m-0">Користувачі</h2>
                    </div>
                    <div class="switch_test text-center"><button id="0" class="active btn">Користувачі</button><button style="margin-left: 10px;" class="btn" id="2">Заблоковані користувачі</button><button style="margin-left: 10px;" class="btn" id="1">Модераторы</button></div>
                    <div class="table-responsive data1">
                        <table id="data" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Ім'я</th>
                                    <th>Прізвище</th>
                                    <th>Пошта</th>
                                    <th>Пароль</th>
                                    <th>Телефон</th>
                                    <th>Стать</th>
                                    <th>Функція</th>
                                </tr>
                            </thead>
                            <tbody class="body"></tbody>
                        </table>
                        <h1 class="text-center error">Інформація відсутня</h1>
                    </div>
                    <div class="table-responsive data2">
                        <table id="data2" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Унікальний код</th>
                                    <th>Логін</th>
                                    <th>Пароль</th>
                                    <th>Функція</th>
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