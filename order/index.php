<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/grid.css">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Отправка заявки | Автосервис "HappyCar"</title>
</head>

<body>
    <?php require_once("../connections/db.php") ?>
    <?php require("../templates/header.php") ?>

    <main>

        <div class="container">
            <h2 style="text-align: center" id="orderh1">Отправить заявку</h2>

            <form class="row section-card" action="send.php" method="POST">
                <div>
                    <span>Имя и Фамилия*:</span> <input name="firstName" type="text" required placeholder="Имя"> <input name="lastName" type="text" required placeholder="Фамилия">
                </div>
                <div>
                    <span>Номер телефона*:</span> <input name="phoneNumber" type="tel" placeholder="+7 (___) __-__-__" required>
                </div>
                <div>
                    <span>Электронная почта:</span> <input name="email" type="email" placeholder="example@mail.com">
                </div>
                <div>
                    <span>Модель автомобиля*:</span> <input type="text" name="carMark" required placeholder="Модель"> <input type="number" name="carYear" required placeholder="Год выпуска">
                </div>
                <div>
                    <span>Опишите проблему*:</span> <br> <textarea name="problem" type="text" required></textarea>
                </div>
                <span>* - поля, обязательные для заполнения</span>
                <button type="submit" class="primary-button">Отправить</button>
            </form>

            <h2 style="text-align: center">Наши услуги</h2>

            <div class="row section-cards">
                <div class="col-md-4 section-card-outer">
                    <div class="section-card">
                        <div style="height: 300px">
                            <h4>Замена масла</h2>
                                <img src="/img/0807b544169e5fdae31db9fbeaaabcf4.jpeg" style="max-height: 64px;"> <br>
                                <p style="overflow-y: auto;">Высокое качество масла от ведущих производителей.</p>
                        </div>
                        <span>Цена 100 рублей</span>
                    </div>
                </div>
                <div class="col-md-4 section-card-outer">
                    <div class="section-card">
                        <div style="height: 300px">
                            <h4>Ремонт двигателя</h2>
                                <img src="/img/kapitalniy-remont-dvs.jpg" style="max-height: 64px;"> <br>
                                <p style="overflow-y: auto;">Капитальный ремонт двигателя в кратчайшие сроки, используя высококачественные запчасти.</p>
                        </div>
                        <span>Цена от 5000 рублей</span>
                    </div>
                </div>
                <div class="col-md-4 section-card-outer">
                    <div class="section-card">
                        <div style="height: 300px">
                            <h4>Работа с колёсами</h2>
                                <img src="/img/zamena_kolesa.jpg" style="max-height: 64px;"> <br>
                                <p style="overflow-y: auto;">Установка новых колёс, замена дисков, заклейка, смена сезона, восстановление протекторов и т.п.</p>
                        </div>
                        <span>Цена 1000 рублей</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require("../templates/footer.php") ?>

    <script src="/js/order.js"></script>
</body>

</html>