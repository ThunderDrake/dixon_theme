<!DOCTYPE html>
<html lang="ru" class="page">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="theme-color" content="#111111">
  <link rel="preload" href="<?= ct()->get_static_url() ?>/fonts/circe-light.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?= ct()->get_static_url() ?>/fonts/circe-regular.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?= ct()->get_static_url() ?>/fonts/circe-bold.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?= ct()->get_static_url() ?>/fonts/circe-extrabold.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?= ct()->get_static_url() ?>/fonts/gilroy-regular.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?= ct()->get_static_url() ?>/fonts/gilroy-medium.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?= ct()->get_static_url() ?>/fonts/gilroy-extrabold.woff2" as="font" type="font/woff2" crossorigin>
  <?php wp_head(); ?>
</head>

<body class="page__body">
  <div class="site-container">
    <div class="visually-hidden">
     <svg width="0" height="0" style="position:absolute"><symbol fill="none" viewBox="0 0 16 22" id="adress" xmlns="http://www.w3.org/2000/svg"><path d="M13.555 11.92c-.699 1.416-1.646 2.827-2.614 4.093A41.963 41.963 0 018 19.44a41.968 41.968 0 01-2.941-3.427c-.968-1.266-1.915-2.677-2.614-4.093C1.74 10.49 1.333 9.15 1.333 8a6.667 6.667 0 0113.334 0c0 1.15-.407 2.49-1.112 3.92zM8 21.333S16 13.752 16 8A8 8 0 000 8c0 5.752 8 13.333 8 13.333z" fill="#3A4097"/><path d="M8 10.667a2.667 2.667 0 110-5.334 2.667 2.667 0 010 5.334zM8 12a4 4 0 100-8 4 4 0 000 8z" fill="#3A4097"/></symbol><symbol fill="none" viewBox="0 0 28 28" id="burger" xmlns="http://www.w3.org/2000/svg"><path stroke="#3A4097" stroke-width="4" stroke-linecap="round" d="M2 2h24M2 14h24M2 26h24"/></symbol><symbol fill="none" viewBox="0 0 26 27" id="cart" xmlns="http://www.w3.org/2000/svg"><path d="M22.386 20.197H6.354a1.676 1.676 0 01-1.605-1.739v0a1.695 1.695 0 011.423-1.728l16.296-2.018L25 3.742H9.77" stroke="#3A4097" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M1 1h2.446a1.033 1.033 0 01.987.84l3.236 14.53" stroke="#3A4097" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.85 25.134a1.371 1.371 0 100-2.743 1.371 1.371 0 000 2.743zm12.068 0a1.371 1.371 0 100-2.743 1.371 1.371 0 000 2.743z" stroke="#3A4097" stroke-width="2" stroke-linejoin="round"/></symbol><symbol fill="none" viewBox="0 0 22 23" id="cart-icon" xmlns="http://www.w3.org/2000/svg"><path d="M18.822 16.998H5.462a1.397 1.397 0 01-1.337-1.45v0a1.413 1.413 0 011.185-1.44l13.58-1.681L21 3.285H8.309" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M1 1h2.038a.86.86 0 01.823.7l2.697 12.108" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.71 21.112a1.143 1.143 0 100-2.286 1.143 1.143 0 000 2.286zm10.055 0a1.143 1.143 0 100-2.286 1.143 1.143 0 000 2.286z" stroke="#fff" stroke-width="2" stroke-linejoin="round"/></symbol><symbol fill="none" viewBox="0 0 20 24" id="delete-icon" xmlns="http://www.w3.org/2000/svg"><path d="M7.166 8.833h.667v9h-.667v-9zm5 0h.667v9h-.667v-9z" fill="#414146" stroke="#414146"/><path d="M2.167 5v-.5H.5v-.667h19V4.5h-1.667v17.167a1.167 1.167 0 01-1.166 1.166H3.333a1.167 1.167 0 01-1.166-1.166V5zm.666 16.667v.5h14.334V4.5H2.833v17.167zM7.166.5h5.667v.667H7.166V.5z" fill="#414146" stroke="#414146"/></symbol><symbol viewBox="0 0 20 19" id="favorite" xmlns="http://www.w3.org/2000/svg"><path d="M19.61 3.333c.909 2.806.149 5.662-1.453 7.814-1.058 1.46-2.322 2.717-3.614 3.816-1.188 1.107-3.848 3.296-4.554 3.357-.623-.119-1.322-.824-1.817-1.186C5.392 15.02 2.399 12.45.882 9.64c-1.273-2.698-1.275-6.035.705-8.103 2.568-2.315 6.439-1.863 8.402.555A5.683 5.683 0 0111.935.478c3.12-1.245 6.366.024 7.675 2.855z"/></symbol><symbol fill="none" viewBox="0 0 26 27" id="name-input-icon" xmlns="http://www.w3.org/2000/svg"><path d="M13 13.5c3.575 0 6.5-2.895 6.5-6.432C19.5 3.53 16.575.635 13 .635S6.5 3.53 6.5 7.068c0 3.537 2.925 6.432 6.5 6.432zm0 3.216c-4.306 0-13 2.171-13 6.432v3.217h26v-3.216c0-4.262-8.694-6.433-13-6.433z" fill="#ACACAC" fill-opacity=".4"/></symbol><symbol fill="none" viewBox="0 0 20 20" id="phone" xmlns="http://www.w3.org/2000/svg"><path d="M18.178 14.059c-.746-.767-2.868-2.204-4.259-2.204-.322 0-.603.071-.833.22-.68.434-1.222.772-1.483.772-.143 0-.297-.128-.634-.42l-.056-.05c-.936-.814-1.135-1.023-1.498-1.402l-.092-.097c-.067-.066-.123-.128-.18-.184-.316-.327-.547-.562-1.36-1.483l-.035-.04c-.389-.44-.645-.727-.66-.936-.015-.205.164-.537.619-1.156.552-.746.572-1.667.066-2.735C7.37 3.5 6.71 2.692 6.127 1.982l-.051-.062C5.575 1.307 4.992 1 4.342 1c-.72 0-1.319.389-1.636.593-.025.015-.05.036-.076.051-.711.45-1.227 1.069-1.422 1.698-.291.946-.485 2.173.91 4.724 1.207 2.209 2.301 3.692 4.04 5.476 1.636 1.677 2.362 2.22 3.988 3.395 1.81 1.309 3.548 2.06 4.765 2.06 1.13 0 2.02 0 3.288-1.528 1.329-1.606.777-2.587-.02-3.41z" stroke="currentColor" stroke-width="1.4"/></symbol><symbol fill="none" viewBox="0 0 24 24" id="phone-input-icon" xmlns="http://www.w3.org/2000/svg"><path d="M21.953 17.129c-.954-.97-3.666-2.787-5.443-2.787-.412 0-.771.09-1.065.278-.87.55-1.562.977-1.895.977-.183 0-.38-.162-.81-.53l-.072-.065c-1.196-1.028-1.45-1.293-1.915-1.772l-.117-.123c-.085-.084-.157-.162-.229-.233-.405-.414-.7-.71-1.738-1.875l-.046-.052c-.496-.556-.823-.918-.843-1.183-.02-.258.21-.679.79-1.461.707-.944.733-2.108.086-3.46-.516-1.066-1.36-2.088-2.104-2.987l-.065-.077C5.847 1.003 5.1.615 4.272.615c-.922 0-1.686.491-2.091.75-.033.02-.066.045-.098.064C1.174 2 .514 2.781.266 3.576c-.372 1.196-.62 2.748 1.163 5.975 1.542 2.793 2.94 4.668 5.162 6.925 2.091 2.12 3.019 2.806 5.097 4.293 2.313 1.656 4.534 2.606 6.09 2.606 1.444 0 2.58 0 4.2-1.933 1.7-2.03.994-3.272-.025-4.313z" fill="#ACACAC" fill-opacity=".4"/></symbol><symbol fill="none" viewBox="0 0 8 8" id="popup-close" xmlns="http://www.w3.org/2000/svg"><path d="M.536.464a.625.625 0 01.883 0l2.652 2.652L6.723.464a.625.625 0 11.884.884L4.955 4l2.652 2.652a.625.625 0 11-.884.884L4.07 4.884 1.42 7.536a.625.625 0 01-.883-.884L3.187 4 .536 1.348a.625.625 0 010-.884z" fill="#727385"/></symbol><symbol fill="none" viewBox="0 0 12 2" id="qty-minus" xmlns="http://www.w3.org/2000/svg"><path d="M.857 0h10.286S12 0 12 .8s-.857.8-.857.8H.857S0 1.6 0 .8.857 0 .857 0z" fill="#727385"/></symbol><symbol fill="none" viewBox="0 0 12 12" id="qty-plus" xmlns="http://www.w3.org/2000/svg"><path d="M6 0a.75.75 0 01.75.75v4.5h4.5a.75.75 0 110 1.5h-4.5v4.5a.75.75 0 11-1.5 0v-4.5H.75a.75.75 0 010-1.5h4.5V.75A.75.75 0 016 0z" fill="#727385"/></symbol><symbol fill="none" viewBox="0 0 20 21" id="search" xmlns="http://www.w3.org/2000/svg"><path d="M8.135 1.283a6.852 6.852 0 11-6.846 6.852 6.883 6.883 0 016.846-6.852zm0-1.283a8.135 8.135 0 100 16.27 8.135 8.135 0 000-16.27zm11.683 18.955l-4.612-4.644-.888.883 4.612 4.643a.626.626 0 10.888-.882z" fill="#A4A4A4"/></symbol><symbol fill="none" viewBox="0 0 20 18" id="sort" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.375 17.5a.625.625 0 00.625-.625V2.135l3.932 3.933a.626.626 0 10.885-.885l-5-5a.624.624 0 00-.885 0l-5 5a.626.626 0 00.886.885l3.932-3.933v14.74a.625.625 0 00.625.625zM5.625 0a.625.625 0 01.625.625v14.74l3.932-3.933a.626.626 0 01.885.885l-5 5a.625.625 0 01-.884 0l-5-5a.626.626 0 11.885-.885L5 15.366V.626a.625.625 0 01.625-.625z" fill="#414146"/></symbol><symbol fill="none" viewBox="0 0 6 4" id="submenu-marker" xmlns="http://www.w3.org/2000/svg"><path d="M5.514.387L2.757 3.415 0 .387h5.514z" fill="#727385"/></symbol><symbol fill="none" viewBox="0 0 30 29" id="tg-icon" xmlns="http://www.w3.org/2000/svg"><path d="M7.186 15.05l16.039-8.595-12.038 11.568-.567 5.292 3.279-3.172 10.708 8.71L30 0 0 12.482l7.186 2.568z" fill="currentColor"/></symbol><symbol fill="none" viewBox="0 0 30 30" id="viber-icon" xmlns="http://www.w3.org/2000/svg"><path d="M4.495.035a5.314 5.314 0 00-1.811.573C1.334 1.321.327 2.708.059 4.23 0 4.55 0 4.99 0 15.067v10.17c0 .223.025.445.075.662.46 2.09 1.94 3.563 4.029 4.024.217.05.439.075.662.075h20.468c.223 0 .445-.026.662-.075 2.09-.461 3.568-1.94 4.029-4.024.05-.217.075-.439.075-.662v-10.17c0-10.082-.005-10.516-.059-10.837a5.058 5.058 0 00-.487-1.425C28.693 1.273 27.166.217 25.446.03c-.39-.043-20.571-.038-20.951.005zM15.97 5.371a8.914 8.914 0 012.978.884c.965.471 1.58.916 2.395 1.73.766.766 1.19 1.345 1.64 2.25.626 1.259.98 2.754 1.044 4.398.021.563.005.686-.123.847-.247.31-.783.257-.965-.091-.059-.118-.075-.215-.09-.665a11.512 11.512 0 00-.178-1.666c-.38-2.089-1.382-3.755-2.978-4.95-1.334-1.001-2.71-1.489-4.516-1.596-.61-.038-.718-.06-.852-.166-.257-.204-.268-.675-.021-.9.15-.14.257-.156.782-.14.262.006.664.038.884.065zm-7.34.343c.113.037.284.128.386.192.61.402 2.309 2.577 2.866 3.66.316.62.423 1.076.327 1.42-.102.363-.273.556-1.034 1.172-.305.247-.59.498-.638.568-.117.166-.208.493-.208.723.005.536.348 1.506.808 2.256.354.578.986 1.323 1.613 1.896.734.675 1.382 1.13 2.116 1.495.943.466 1.516.589 1.94.39.107-.047.219-.112.251-.138.032-.027.279-.333.552-.665.52-.653.637-.76.996-.884.456-.155.916-.112 1.383.124.353.182 1.125.659 1.623 1.007.653.46 2.057 1.602 2.244 1.826.332.413.391.938.166 1.517-.235.61-1.162 1.762-1.81 2.25-.584.444-.997.61-1.543.637-.45.021-.638-.016-1.21-.252-4.512-1.859-8.112-4.628-10.972-8.432-1.495-1.987-2.63-4.05-3.407-6.187-.456-1.249-.477-1.79-.102-2.427.16-.268.846-.938 1.344-1.307.83-.616 1.211-.841 1.517-.906.198-.053.557-.016.792.065zm7.565 1.982c1.95.284 3.46 1.189 4.446 2.657.557.825.9 1.8 1.023 2.84.043.38.043 1.076-.005 1.194a.725.725 0 01-.295.316c-.123.064-.39.059-.54-.021-.247-.124-.322-.322-.322-.863 0-.83-.214-1.704-.59-2.384a4.84 4.84 0 00-1.794-1.864c-.648-.386-1.602-.67-2.47-.74-.316-.026-.487-.09-.605-.23a.581.581 0 01-.048-.723c.171-.257.428-.3 1.2-.182zm.68 2.421c.632.134 1.12.375 1.532.76.536.505.825 1.115.954 1.988.085.574.053.793-.15.98-.188.172-.541.183-.75.017-.156-.118-.204-.236-.236-.568-.043-.44-.118-.745-.252-1.034-.284-.605-.782-.921-1.623-1.023-.396-.048-.514-.091-.643-.241a.598.598 0 01.182-.9c.123-.06.172-.07.445-.054.166.016.412.043.541.075z" fill="currentColor"/></symbol><symbol fill="none" viewBox="0 0 44 26" id="vk-icon" xmlns="http://www.w3.org/2000/svg"><path d="M42.34 1.76C42.642.746 42.34 0 40.908 0h-4.742c-1.207 0-1.758.644-2.061 1.352 0 0-2.411 5.94-5.828 9.791-1.103 1.12-1.607 1.475-2.208 1.475-.3 0-.737-.354-.737-1.37V1.761C25.332.54 24.983 0 23.978 0h-7.452c-.753 0-1.207.564-1.207 1.101 0 1.153 1.709 1.42 1.884 4.67v7.052c0 1.544-.275 1.826-.88 1.826-1.607 0-5.517-5.961-7.837-12.786C8.034.537 7.577.003 6.366.003h-4.74C.27.002 0 .646 0 1.353c0 1.272 1.607 7.563 7.484 15.884C11.403 22.92 16.92 26 21.945 26c3.012 0 3.384-.684 3.384-1.863v-4.295c0-1.368.288-1.643 1.242-1.643.7 0 1.907.358 4.72 3.096 3.214 3.246 3.746 4.703 5.552 4.703h4.74c1.354 0 2.03-.684 1.641-2.034-.426-1.343-1.961-3.299-3.998-5.612-1.107-1.32-2.762-2.74-3.266-3.45-.702-.915-.5-1.319 0-2.131.002.002 5.779-8.216 6.38-11.01z" fill="currentColor"/></symbol><symbol fill="none" viewBox="0 0 30 30" id="whatsapp-icon" xmlns="http://www.w3.org/2000/svg"><path d="M22.38 0c.18 0 .54 0 .81.03.66 0 1.53.06 1.92.15.6.12 1.17.3 1.62.54.57.27 1.05.63 1.5 1.08.42.42.78.9 1.05 1.47.24.45.42 1.02.54 1.62.09.39.15 1.26.18 1.92v15.57c0 .18 0 .54-.03.81 0 .66-.06 1.53-.15 1.92-.12.6-.3 1.17-.54 1.62-.27.57-.63 1.05-1.08 1.5-.42.42-.9.78-1.47 1.05-.45.24-1.02.42-1.62.54-.39.09-1.26.15-1.92.18H7.62c-.18 0-.54 0-.81-.03-.66 0-1.53-.06-1.92-.15-.6-.12-1.17-.3-1.62-.54-.57-.27-1.05-.63-1.5-1.08-.42-.42-.78-.9-1.05-1.47-.24-.45-.42-1.02-.54-1.62-.09-.39-.15-1.26-.18-1.92V7.62c0-.18 0-.54.03-.81 0-.66.06-1.53.15-1.92.12-.6.3-1.17.54-1.62.27-.57.63-1.05 1.08-1.5.42-.42.9-.78 1.47-1.05C3.72.48 4.29.3 4.89.18 5.28.09 6.15.03 6.81 0h15.57zm.51 7.181a10.626 10.626 0 00-7.565-3.135c-5.894 0-10.692 4.796-10.694 10.69 0 1.884.492 3.723 1.427 5.344l-1.517 5.54 5.67-1.486c1.561.851 3.32 1.3 5.11 1.3h.004c5.894 0 10.691-4.795 10.694-10.69a10.624 10.624 0 00-3.13-7.563zM15.325 23.63h-.004a8.877 8.877 0 01-4.524-1.238l-.324-.193-3.364.882.898-3.278-.212-.337a8.864 8.864 0 01-1.358-4.728c.002-4.9 3.989-8.885 8.891-8.885a8.83 8.83 0 016.284 2.606 8.83 8.83 0 012.601 6.286c-.002 4.9-3.989 8.885-8.888 8.885zm4.875-6.654c-.267-.134-1.58-.78-1.825-.87-.245-.089-.424-.133-.602.134-.178.268-.69.87-.846 1.048-.155.178-.311.2-.579.066-.267-.133-1.128-.415-2.148-1.325-.795-.709-1.33-1.583-1.487-1.85-.156-.268-.016-.413.117-.546.12-.12.268-.312.401-.468.134-.156.178-.267.267-.446.09-.178.045-.334-.022-.468-.067-.133-.601-1.448-.824-1.983-.217-.52-.437-.45-.6-.458a10.43 10.43 0 00-.513-.01.982.982 0 00-.713.334c-.245.268-.935.914-.935 2.229s.958 2.585 1.091 2.763c.134.178 1.885 2.876 4.565 4.033.637.276 1.135.44 1.523.563.64.203 1.223.175 1.683.106.513-.077 1.581-.646 1.804-1.27.222-.624.222-1.159.155-1.27-.066-.112-.244-.179-.512-.312z" fill="currentColor"/></symbol></svg>
    </div>
    <header class="header">
  <div class="container header__container">

    <a class="logo header__logo" href="/">
      <picture>
        <source srcset="<?= ct()->get_static_url() ?>/img/logo.avif" type="image/avif">
        <source srcset="<?= ct()->get_static_url() ?>/img/logo.webp" type="image/webp">
        <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/logo.png" class="image" width="230" height="63"
          alt="Dixon — магазин мобильных телефонов">
      </picture>
    </a>

    <div class="header__search-block header__search-block--mobile submenu-search">
		<?php echo do_shortcode('[fibosearch]'); ?>
    </div>

    <div class="header__navigation-block" data-menu>

      <div class="header__search-block submenu-search">
		<?php echo do_shortcode('[fibosearch]'); ?>
      </div>

      <div class="header__adress-block adress">
        <svg class="adress__icon" width="16" height="21">
          <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#adress"></use>
        </svg>
        <div class="adress__text"><?= get_field('contact_address', 'option') ?></div>
      </div>

      <div class="header__nav main-nav">
        <nav class="main-nav__menu accordion navigation" data-accordion="parent" data-destroy="(max-width: 1024px)">
          <ul class="navigation__list list-reset">

            <li class="navigation__item" data-no-submenu>
              <a class="link navigation__link link--inline navigation__link--active" href="/">Главная</a>
            </li>

            <li class="navigation__item" data-has-submenu data-accordion="element">
              <div class="accordion__button" data-accordion="button" tabindex="0">
                <a class="link navigation__link" href="/catalog/">Магазин</a>
              </div>
              <div class="accordion__content" data-accordion="content">
                <div class="submenu shop-submenu" data-submenu>
                  <div class="container">
                    <div class="school-submenu__wrap">
                      <ul class="submenu__list">
                        <li class="submenu__item">
                          <a class="submenu__link" href="/catalog/telefony/">Телефоны</a>
                        </li>
                        <li class="submenu__item">
                          <a class="submenu__link" href="/catalog/accessories/">Аксессуары</a>
                        </li>
						<?php 
						$terms = get_terms( [
							'taxonomy' => 'product_tag',
							'hide_empty' => true,
						] );
						?>
						<?php foreach($terms as $term): ?>
						<li class="submenu__item">
                          <a class="submenu__link" href="/tag/<?= $term->slug ?>/"><?= $term->name ?></a>
                        </li>
						<?php endforeach; ?>
						<li class="submenu__item">
                          <a class="submenu__link" href="/payment-methods/">Оплата и доставка</a>
                        </li>
						<li class="submenu__item">
                          <a class="submenu__link" href="/oformit-v-kredit/">Оформление в кредит</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li class="navigation__item" data-has-submenu data-accordion="element">
              <div class="accordion__button" data-accordion="button" tabindex="0">
                <a class="link navigation__link" href="/pricelist/">Ремонт и сервис</a>
              </div>
              <div class="accordion__content" data-accordion="content">
                <div class="submenu shop-submenu" data-submenu>
                  <div class="container">
                    <div class="school-submenu__wrap">
                      <ul class="submenu__list">
                        <li class="submenu__item">
                          <a class="submenu__link" href="/pricelist/">Прайс</a>
                        </li>
                        <li class="submenu__item">
                          <a class="submenu__link" href="/repair/">Рассчитать стоимость</a>
                        </li>
                        <li class="submenu__item">
                          <a class="submenu__link" href="/work-status/">Узнать статус ремонта</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li class="navigation__item" data-has-submenu data-accordion="element">
              <div class="accordion__button" data-accordion="button" tabindex="0">
                <a class="link navigation__link" href="/o-kompanii/">О компании</a>
              </div>
              <div class="accordion__content" data-accordion="content">
                <div class="submenu shop-submenu" data-submenu>
                  <div class="container">
                    <div class="school-submenu__wrap">
                      <ul class="submenu__list">
                        <li class="submenu__item">
                          <a class="submenu__link" href="/o-kompanii/">О компании</a>
                        </li>
                        <li class="submenu__item">
                          <a class="submenu__link" href="/kontakty/">Контакты</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li class="navigation__item" data-no-submenu>
              <a class="link navigation__link link--inline" href="/vacancy/">Вакансии</a>
            </li>
          </ul>
        </nav>
      </div>

      <div class="header__contacts header__contacts--mobile">

        <div class="header__contacts-phone phone-number">
          <a class="phone-number__link" href="tel:<?= str_replace([' ', '(', ')', '-'], '', get_field('contact_phone', 'option')) ?>">
            <svg class="phone-number__icon" width="18" height="18">
              <use xlink:href="#phone"></use>
            </svg>
            <?= get_field('contact_phone', 'option') ?>
          </a>
          <span class="phone-number__text">Менеджер по продажам</span>
        </div>

        <div class="header__contacts-phone phone-number">
          <a class="phone-number__link" href="tel:<?= str_replace([' ', '(', ')', '-'], '', get_field('contact_phone_service', 'option')) ?>">
            <svg class="phone-number__icon" width="18" height="18">
              <use xlink:href="#phone"></use>
            </svg>
            <?= get_field('contact_phone_service', 'option') ?>
          </a>
          <span class="phone-number__text">Ремонт и сервис</span>
        </div>

      </div>
    </div>

    <div class="header__contacts">

      <div class="header__contacts-phone phone-number">
        <a class="phone-number__link" href="tel:<?= str_replace([' ', '(', ')', '-'], '', get_field('contact_phone', 'option')) ?>">
          <svg class="phone-number__icon" width="18" height="18">
            <use xlink:href="#phone"></use>
          </svg>
          <?= get_field('contact_phone', 'option') ?>
        </a>
        <span class="phone-number__text">Менеджер по продажам</span>
      </div>

      <div class="header__contacts-phone phone-number">
        <a class="phone-number__link" href="tel:<?= str_replace([' ', '(', ')', '-'], '', get_field('contact_phone_service', 'option')) ?>">
          <svg class="phone-number__icon" width="18" height="18">
            <use xlink:href="#phone"></use>
          </svg>
          <?= get_field('contact_phone_service', 'option') ?>
        </a>
        <span class="phone-number__text">Ремонт и сервис</span>
      </div>

    </div>

    <button class="header__burger burger" aria-label="Открыть меню" aria-expanded="false"  data-burger>
      <span class="burger__line"></span>
    </button>

    <div class="header__cart">
      <button class="btn-reset header__cart-link" data-graph-path="cart">
        <svg class="header__cart-icon" width="24" height="24">
          <use xlink:href="#cart"></use>
        </svg>
        <?php cart_link(); ?>
      </button>
	  <a class="wishlist__link" href="/wishlist/">
		<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M16.7243 2.5313C15.8738 1.7008 14.6987 1.28572 13.1985 1.28572C12.7834 1.28572 12.3597 1.3577 11.9279 1.5016C11.4959 1.6456 11.094 1.83987 10.7227 2.08428C10.3509 2.32862 10.0314 2.55808 9.76331 2.7723C9.49557 2.98659 9.24103 3.21432 9 3.45532C8.75886 3.21432 8.50439 2.98659 8.23662 2.7723C7.96868 2.55808 7.64901 2.32876 7.27728 2.08428C6.90562 1.83977 6.50381 1.64563 6.07191 1.5016C5.64005 1.35774 5.21643 1.28572 4.80128 1.28572C3.30123 1.28572 2.12608 1.7009 1.27566 2.5313C0.425244 3.36163 0 4.51335 0 5.98656C0 6.43523 0.0788076 6.89745 0.236106 7.37265C0.393405 7.8481 0.572657 8.25329 0.77351 8.58805C0.974329 8.92277 1.20206 9.24919 1.45653 9.5673C1.711 9.88538 1.89698 10.1046 2.01403 10.2251C2.13118 10.3457 2.22329 10.4328 2.29024 10.4864L8.55801 16.5333C8.67858 16.6539 8.82588 16.7143 8.99996 16.7143C9.17404 16.7143 9.32146 16.6539 9.44196 16.5333L15.6998 10.5063C17.2333 8.97308 18 7.46638 18 5.98642C18 4.5131 17.5748 3.36149 16.7243 2.5313ZM14.8258 9.56227L9 15.1772L3.16419 9.55214C1.91193 8.30019 1.2859 7.11143 1.2859 5.98642C1.2859 5.44409 1.35788 4.96522 1.50178 4.55015C1.64578 4.135 1.82992 3.8051 2.05424 3.56069C2.27859 3.31621 2.55143 3.11715 2.87285 2.96302C3.19445 2.80903 3.50915 2.70521 3.81714 2.65166C4.12512 2.59818 4.45319 2.57141 4.80146 2.57141C5.14962 2.57141 5.52469 2.65669 5.92647 2.8275C6.32818 2.99824 6.69815 3.21253 7.03628 3.47031C7.37449 3.72826 7.66411 3.96929 7.90528 4.19354C8.14631 4.418 8.34713 4.62378 8.50787 4.8113C8.62834 4.95868 8.79253 5.03235 9.00003 5.03235C9.20761 5.03235 9.37163 4.95868 9.49223 4.8113C9.65294 4.62378 9.8539 4.4179 10.0949 4.19354C10.336 3.96929 10.6257 3.72837 10.9637 3.47031C11.3019 3.21253 11.6719 2.99824 12.0738 2.8275C12.4754 2.65673 12.8506 2.57141 13.1988 2.57141C13.547 2.57141 13.875 2.59818 14.1831 2.65166C14.4912 2.70517 14.8059 2.80903 15.1274 2.96302C15.4489 3.11712 15.7217 3.31632 15.946 3.56069C16.1703 3.8051 16.3545 4.135 16.4985 4.55015C16.6423 4.96522 16.7142 5.44409 16.7142 5.98642C16.7142 7.11143 16.0848 8.3035 14.8258 9.56227Z" fill="#3A4097"/>
		</svg>
	  </a>
	  <a class="account_link" href="/my-account/">
	  	<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M15.8254 16.3504H2.17539C1.88559 16.3504 1.65039 16.1152 1.65039 15.8254C1.65039 15.8254 1.65039 15.3923 1.65039 14.7754C1.65039 12.1656 3.76562 10.0504 6.37539 10.0504H11.6254C14.2352 10.0504 16.3504 12.1656 16.3504 14.7754V15.8254C16.3504 15.86 16.347 16.0481 16.1948 16.1987C16.0451 16.3468 15.861 16.3504 15.8254 16.3504ZM15.3004 15.3004V14.7754C15.3004 12.7457 13.655 11.1004 11.6254 11.1004C9.95747 11.1004 8.04332 11.1004 6.37539 11.1004C4.34574 11.1004 2.70039 12.7457 2.70039 14.7754V15.3004H15.3004Z" fill="#3A4097"/>
			<path fill-rule="evenodd" clip-rule="evenodd" d="M9.00039 1.65039C6.97232 1.65039 5.32539 3.29732 5.32539 5.32539C5.32539 7.35347 6.97232 9.00039 9.00039 9.00039C11.0285 9.00039 12.6754 7.35347 12.6754 5.32539C12.6754 3.29732 11.0285 1.65039 9.00039 1.65039ZM9.00039 2.70039C10.4494 2.70039 11.6254 3.87639 11.6254 5.32539C11.6254 6.77439 10.4494 7.95039 9.00039 7.95039C7.55139 7.95039 6.37539 6.77439 6.37539 5.32539C6.37539 3.87639 7.55139 2.70039 9.00039 2.70039Z" fill="#3A4097"/>
		</svg>

	  </a>
    </div>
  </div>
</header>