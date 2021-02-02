<?php

function translateColor(string $word)
{
    if ($_SESSION['lang'] == 'ru')
        return $word;
    else {
        $colors = array();
        if ($_SESSION['lang'] == 'ukr') {
            $colors = array(
                "Желтый" => "Жовтий",
                "Красный" => "Червоний",
                "Синий" => "Синій",
                "Черный" => "Чорний",
                "Белый" => "Білий",
                "Зеленый" => "Зелений"
            );
        } else {
            $colors = array(
                "Желтый" => "Yellow",
                "Красный" => "Red",
                "Синий" => "Blue",
                "Черный" => "Black",
                "Белый" => "White",
                "Зеленый" => "Green"
            );
        }

        return $colors[$word];
    }
}

function translateAction(string $words)
{
    if ($_SESSION['lang'] == 'ru')
        return $words;
    else {
        $action = array();
        if ($_SESSION['lang'] == 'ukr') {
            $action = array(
                "Необходимо быть авторизорованым!" => "Необхідно буди зарєєстрованим!",
                "Вы уже заказывали тест драйв этой машини!" => "Вы вже замовляли тест драйв цього авто!",
                "Проверьте правильность данных!" => "Перевірте правильність даних!",
                "Ваш email был заблокирован!" => "Ваш email було заблоковано!",
                "Email уже используется!" => "Email вже використовується!",
                "Ваш ID не корректный!"=>"Ваш ID не коректний!",
                "Вы успешно авторизированы!"=>"Ви успішно авторизовані!",
                "Вы успешно вышли!"=>"Ви успішно вийшли!",
                "Действие выполнено!"=>"Дія виконана!",
                "Вы успешно добавили машину! С вами свяжется наш сотрудник."=>"Ви успішно додали авто! З вами зв'яжеться наш співробітник.",
                "Вы успешно зарегистрированы!"=>"Ви успішно зареєстровані!"
            );
        } else {
            $action = array(
                "Необходимо быть авторизорованым!" => "You must be logged in!",
                "Вы уже заказывали тест драйв этой машини!" => "You already ordered this car!",
                "Проверьте правильность данных!" => "Check correctness data!",
                "Email уже используется!" => "Email already using!",
                "Ваш ID не соответствует!"=>"Your ID not correct!",
                "Ваш email был заблокирован!" => "Your email has been blocked",
                "Вы успешно авторизированы!"=>"You success logged in!",
                "Вы успешно вышли!"=>"You succes logged out!",
                "Действие выполнено!"=>"Action complited!",
                "Вы успешно добавили машину! С вами свяжется наш сотрудник."=>"You have successfully added a car! Our employee will contact you.",
                "Вы успешно зарегистрированы!"=>"You are registered successfully!"
            );
        }

        return $action[$words];
    }
}

function translateCategory(string $word)
{
    if ($_SESSION['lang'] == 'ru')
        return $word;
    else {
        $cat = array();
        if ($_SESSION['lang'] == 'ukr') {
            $cat = array(
                "Для семьи" => "Для сім'ї",
                "Спорткар" => "Спорткар",
                "Внедорожник" => "Позашляховик",
                "Кроссовер" => "Кроссовер"
            );
        } else {
            $cat = array(
                "Для семьи" => "For family",
                "Спорткар" => "Sportcar",
                "Внедорожник" => "SUV",
                "Кроссовер" => "Crossover"
            );
        }

        return $cat[$word];
    }
}

function translateEq(string $word)
{
    if ($_SESSION['lang'] == 'ru')
        return $word;
    else {
        $eqcar = array();
        if ($_SESSION['lang'] == 'en') {
            $eqcar = array(
                "хетчбек" => "hatchback",
                "седан" => "sedan",
                "универсал" => "universal",
                "механика" => "mechanical",
                "автомат" => "automatical",
                "задний" => "rear",
                "передний" => "front",
                "полный" => "full",
                "газ" => "gaz",
                "бензин" => "benzine",
                "дизель" => "diasel",
                "бензин-газ" => "benzine-gaz",
                "электричество" => "electrical",
                "есть" => "yes",
                "нету" => "nope",
                "сигнализация" => "signaling",
                "gsm-сигнализация" => "gsm-signaling",
                "спереди" => "front",
                "сзади" => "rear",
                "комбинированое" => "combined"
            );
        } else {
            $eqcar = array(
                "хетчбек" => "хетчбек",
                "седан" => "седан",
                "универсал" => "універсал",
                "механика" => "механіка",
                "автомат" => "автомат",
                "задний" => "задній",
                "передний" => "передній",
                "полный" => "повний",
                "газ" => "газ",
                "бензин" => "бензин",
                "дизель" => "дизель",
                "бензин-газ" => "бензин-газ",
                "электричество" => "електрика",
                "есть" => "в наявності",
                "нету" => "немає",
                "сигнализация" => "сигналізація",
                "gsm-сигнализация" => "gsm-сигналізація",
                "спереди" => "спереду",
                "сзади" => "ззаду",
                "комбинированое" => "комбіноване"
            );
        }
        return $eqcar[$word];
    }
}

function translateEquip(string $word)
{
    if ($_SESSION['lang'] == 'ru')
        return $word;
    else {
        $equipments = array();

        if ($_SESSION['lang'] == 'en') {
            $equipments = array(
                "Эконом" => "Economy",
                "Эконом+" => "Economy+",
                "Бизнес" => "Business",
                "Элит" => "Elite"
            );
        } else {
            $equipments = array(
                "Эконом" => "Економ",
                "Эконом+" => "Економ+",
                "Бизнес" => "Бізнес",
                "Элит" => "Елітна"
            );
        }
        return $equipments[$word];
    }
}

function tranlateTestDrive(string $word)
{
    if ($_SESSION['lang'] == 'en')
        return $word;
    else {
        $status = array();

        if ($_SESSION['lang'] == 'ru') {
            $status = array(
                "Waiting" => "Ожидается",
                "Success" => "Подтверждено",
                "Denied" => "Отклонено"
            );
        } else {
            $status = array(
                "Waiting" => "Перевіряється",
                "Success" => "Підтверждено",
                "Denied" => "Відхиленено"
            );
        }
        return $status[$word];
    }
}
?>