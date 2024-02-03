<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/grid.css">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Отправка заявки</title>
</head>

<body>
    <?php require_once("../connections/db.php") ?>
    <?php require("../templates/header.php") ?>

    <hr />

    <div class="container">
        <h1 style="text-align: center">Наши услуги</h1>

        <a style="text-align: center;" href="#orderh1">Перейти к оформлению заявки</a>

        <div class="row">
            <div class="col-md-4 review">
                <div class="review-inside">
                    <div style="height: 240px">
                        <h2>Замена масла</h2>
                        <img src="/img/0807b544169e5fdae31db9fbeaaabcf4.jpeg" style="max-height: 64px;"> <br>
                        <p style="max-height: 96px; overflow-y: auto;">Высокое качество масла от ведущих производителей.</p>
                    </div>
                    <span>Цена 100 рублей</span>
                </div>
            </div>
            <div class="col-md-4 review">
                <div class="review-inside">
                    <div style="height: 240px">
                        <h2>Ремонт двигателя</h2>
                        <img src="/img/kapitalniy-remont-dvs.jpg" style="max-height: 64px;"> <br>
                        <p style="max-height: 96px; overflow-y: auto;">Капитальный ремонт двигателя в кратчайшие сроки, используя высококачественные запчасти.</p>
                    </div>
                    <span>Цена от 5000 рублей</span>
                </div>
            </div>
            <div class="col-md-4 review">
                <div class="review-inside">
                    <div style="height: 240px">
                        <h2>Работа с колёсами</h2>
                        <img src="/img/zamena_kolesa.jpg" style="max-height: 64px;"> <br>
                        <p style="max-height: 96px; overflow-y: auto;">Установка новых колёс, замена дисков, заклейка, смена сезона, восстановление протекторов и т.п.</p>
                    </div>
                    <span>Цена 1000 рублей</span>
                </div>
            </div>
        </div>

        <h1 style="text-align: center" id="orderh1">Отправить заявку</h1>

        <form class="row" action="send.php" method="POST">
            <div>
                <span>Имя и Фамилия*:</span> <input name="firstName" type="text" required placeholder="Имя"> <input name="lastName" type="text" required placeholder="Фамилия">
            </div>
            <div>
                <span>Номер телефона*:</span> <input name="phoneNumber" type="tel" required>
            </div>
            <div>
                <span>Электронная почта:</span> <input name="email" type="email">
            </div>
            <div>
                <span>Модель автомобиля*:</span> <input type="text" name="carMark" required placeholder="Модель"> <input type="number" name="carYear" required placeholder="Год выпуска">
            </div>
            <div>
                <span>Опишите проблему*:</span> <br> <textarea name="problem" type="text" required></textarea>
            </div>
            <span>* - поля, обязательные для заполнения</span>
            <input type="submit" value="Отправить">
        </form>
    </div>

    <hr />

    <?php require("../templates/footer.php") ?>

    <script src="/js/order.js"></script>
</body>

</html>