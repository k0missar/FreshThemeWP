// МОБИЛЬНОЕ МЕНЮ
let nav = document.querySelector('.nav__list');

function mainMenu() {
    let btn = document.querySelector('.nav__btn');
    const subMenu = document.querySelectorAll(
        '.nav__list .menu-item-has-children'
    );
    const subMenuList = document.querySelectorAll('.sub-menu');

    // Если ширина больше 980 отображать мобильное меню, меньше - не отображать
    if (window.innerWidth < 980) {
        nav.classList.add('nav__list--close');
    } else {
        nav.classList.remove('nav__list--close');
    }

    // Открываем/скрываем мобильное меню, класс isOpenMenu - флаг открытого меню
    btn.addEventListener('click', () => {
        nav.classList.toggle('nav__list--close');
        nav.classList.toggle('isOpenMenu');
    });

    // Если мобильное меню было открыто и ширина экрана была больше 980
    // то при возвращении ширина экрана меньше 980 мобильное меню останется открытым
    // Когда ширина экрана достигает 980 то мобильное меню становится десктопным,
    // всегда открытым
    const windowWidth = window;
    windowWidth.addEventListener('resize', () => {
        //console.log(window.innerWidth);
        if (window.innerWidth < 980) {
            if (!nav.classList.contains('isOpenMenu')) {
                nav.classList.add('nav__list--close');
            }
        } else {
            nav.classList.remove('nav__list--close');
            if (subMenu) {
                subMenuList.forEach((item) => {
                    if (item.classList.contains('isOpenMenu')) {
                        item.classList.add('nav__list--close');
                        item.classList.remove('isOpenMenu');
                    }
                });
            }
        }
    });

    //Sub menu

    if (subMenu) {
        subMenu.forEach((item) => {
            item.classList.add('menu-item-has-children--close');
        });
        subMenuList.forEach((item) => {
            item.classList.toggle('nav__list--close');
        });
        subMenu.forEach((item) => {
            item.addEventListener('click', () => {
                item.classList.toggle('menu-item-has-children--close');
                item.classList.toggle('menu-item-has-children--open');
                item.childNodes[2].classList.toggle('nav__list--close');
                item.childNodes[2].classList.toggle('isOpenMenu');
            });
        });
    }
}

if (nav.classList.contains('nav__list')) {
    mainMenu();
}

//Галерея

const galleryList = Array.from(
    document.querySelectorAll(
        '.woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image'
    )
);

if (galleryList) {
    galleryList[0].classList.add('woocommerce-product-gallery__image--isOpen');
    galleryList.forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            galleryList.forEach((item) => {
                item.classList.remove(
                    'woocommerce-product-gallery__image--isOpen'
                );
            });
            element = e.target.parentElement.parentElement;
            element.classList.add('woocommerce-product-gallery__image--isOpen');
        });
    });
}

// Табы в товарах
const wooTabsList = document.querySelectorAll('.woocommerce-Tabs-panel');
const wooTabsButtonList = Array.from(
    document.querySelector('.single-product__container .tabs').children
);

if (wooTabsList) {
    wooTabsList.forEach((item) => {
        item.classList.add('woocommerce-Tabs-panel--close');
    });
    wooTabsList[0].classList.remove('woocommerce-Tabs-panel--close');
    wooTabsButtonList[0].children[0].classList.add('tabs-link--current');

    wooTabsButtonList.forEach((item, index) => {
        item.addEventListener('click', () => {
            wooTabsList.forEach((item) => {
                item.classList.add('woocommerce-Tabs-panel--close');
            });
            wooTabsButtonList.forEach((item) => {
                item.children[0].classList.remove('tabs-link--current');
            });
            wooTabsList[index].classList.remove(
                'woocommerce-Tabs-panel--close'
            );
            item.children[0].classList.add('tabs-link--current');
        });
    });
    console.dir(wooTabsButtonList[0]);
}
