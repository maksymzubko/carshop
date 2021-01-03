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
?>
