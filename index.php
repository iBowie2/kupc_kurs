<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="/css/grid.css" />
	<link rel="stylesheet" href="/css/styles.css" />
	<title>Главная | Автосервис "HappyCar"</title>
</head>

<body>
	<!--Шапка-->
	<?php require("templates/header.php") ?>

	<main>
		<div class="container">
			<!--Код раздела слайдер-->
			<div class="row slideshow-container">
				<div class="mySlides fade">
					<div class="numbertext">1 / 3</div>
					<img src="img/original_54102e8940c0886c078b60fd_5760017e27acd.jpg" style="width: 100%" />
					<div class="text" style="color: #fff;">АКЦИЯ! Скидка 20% на заказ, оформленный через наш веб-сайт!</div>
				</div>

				<div class="mySlides fade">
					<div class="numbertext">2 / 3</div>
					<img src="img/Снимок экрана 2023-04-24 114943.png" style="width: 100%" />
					<div class="text">caption two</div>
				</div>

				<div class="mySlides fade">
					<div class="numbertext">3 / 3</div>
					<img src="img/Снимок экрана 2023-04-24 114943.png" style="width: 100%" />
					<div class="text">caption three</div>
				</div>

				<div>
					<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
					<a class="next" onclick="plusSlides(1)">&#10095;</a>
				</div>
			</div>

			<div style="text-align: center">
				<span class="dot" onclick="currentSlide(1)"></span>
				<span class="dot" onclick="currentSlide(2)"></span>
				<span class="dot" onclick="currentSlide(3)"></span>
			</div>

			<!--Раздел услуги-->
			<h2 style="text-align: center">Наши услуги</h2>

			<div class="row section-cards">
				<div class="col-md-4 section-card-outer">
					<div class="section-card">
						<div>
							<h4>Замена масла</h2>
								<img src="/img/0807b544169e5fdae31db9fbeaaabcf4.jpeg" style="max-height: 64px;"> <br>
								<p>Высокое качество масла от ведущих производителей.</p>
						</div>
						<span>Цена 100 рублей</span>
					</div>
				</div>
				<div class="col-md-4 section-card-outer">
					<div class="section-card">
						<div>
							<h4>Ремонт двигателя</h2>
								<img src="/img/kapitalniy-remont-dvs.jpg" style="max-height: 64px;"> <br>
								<p>Капитальный ремонт двигателя в кратчайшие сроки,
									используя высококачественные запчасти.</p>
						</div>
						<span>Цена от 5000 рублей</span>
					</div>
				</div>
				<div class="col-md-4 section-card-outer">
					<div class="section-card">
						<div>
							<h4>Работа с колёсами</h2>
								<img src="/img/zamena_kolesa.jpg" style="max-height: 64px;"> <br>
								<p>Установка новых колёс, замена дисков, заклейка,
									смена сезона, восстановление протекторов и т.п.</p>
						</div>
						<span>Цена 1000 рублей</span>
					</div>
				</div>
			</div>

			<!--first button-->
			<a class="primary-button row" href="/order/index.php"><span style="text-align: center">Перейти к услугам</span></a>

			<!--раздел отзывы-->
			<h2 style="text-align: center">Отзывы</h2>

			<div class="row section-cards">
				<div class="col-md-4 section-card-outer">
					<div class="section-card">
						<div style="height: 300px">
							<h2>Отличное качество!</h2>
							<span>Свой авто доверяем этому сервису! Качество на высоте!</span>
						</div>
						<div>
							<span>Иван Иванов</span>
							<span style="float: right">⭐⭐⭐⭐⭐</span>
						</div>
					</div>
				</div>
				<div class="col-md-4 section-card-outer">
					<div class="section-card">
						<div style="height: 300px">
							<h2>Быстрая работа!</h2>
							<span>Сделали ремонт двигателя максимально быстро, большое спасибо!</span>
						</div>
						<div>
							<span>Сергей Сергеев</span>
							<span style="float: right">⭐⭐⭐⭐⭐</span>
						</div>
					</div>
				</div>
				<div class="col-md-4 section-card-outer">
					<div class="section-card">
						<div style="height: 300px">
							<h2>Хорошая цена!</h2>
							<span>Приезжал на замену масла. Быстро, качественно, недорого!</span>
						</div>
						<div>
							<span>Алексей Алексеев</span>
							<span style="float: right">⭐⭐⭐⭐</span>
						</div>
					</div>
				</div>
			</div>

			<h2 style="text-align: center">Мы на карте</h2>

			<!--карта-->
			<div style="position:relative;overflow:hidden;">
				<a href="https://yandex.ru/maps/54/yekaterinburg/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">
					Екатеринбург</a>
				<a href="https://yandex.ru/maps/geo/yekaterinburg/53166537/?ll=60.607511%2C56.745518&utm_medium=mapframe&utm_source=maps&z=10.26" style="color:#eee;font-size:12px;position:absolute;top:14px;">
					Екатеринбург — Яндекс Карты
				</a>
				<iframe src="https://yandex.ru/map-widget/v1/?ll=60.607511%2C56.745518&mode=poi&poi%5Bpoint%5D=60.597393%2C56.837993&poi%5Buri%5D=ymapsbm1%3A%2F%2Fgeo%3Fdata%3DCgg1MzE2NjUzNxJP0KDQvtGB0YHQuNGPLCDQodCy0LXRgNC00LvQvtCy0YHQutCw0Y8g0L7QsdC70LDRgdGC0YwsINCV0LrQsNGC0LXRgNC40L3QsdGD0YDQsyIKDdBjckIVIFpjQg%2C%2C&z=10.26" width="99.5%" height="400" frameborder="1" allowfullscreen="true" style="position:relative;">
				</iframe>
			</div>

			<a class="primary-button row" href="order"><span style="text-align: center">Перейти к услугам</span></a>
		</div>
	</main>

	<?php require("templates/footer.php") ?>

	<script src="js/index.js"></script>
</body>

</html>