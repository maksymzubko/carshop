<html>

<head style="height: 120vh;">
    <?php require_once 'head.php' ?>
    <title>Налаштування відображення</title>
</head>

<body style="height: auto;">
    <?php require_once 'header.php' ?>
    <section></section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 test">
                <div class="top text-start">
                        <h2 class="m-0">Налаштування відображення</h2>
                    </div>
                            <div class="buttons-shown">
                                <button class="btn" id="shownall">Показати усі</button> <button class="btn" id="hideall">Сховати усі</button>
                            </div> 
                            <div class="table-responsive">
                                <table id="data" class="table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Зоображення</th>
                                            <th>Відображення</th>
                                        </tr>
                                    </thead>
                                    <tbody class="body"></tbody>
                                </table>
                                <h1 class="text-center error">Інформація відсутня</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require_once 'scripts.php' ?>
</body>

</html>
