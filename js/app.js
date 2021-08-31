window.addEventListener('load', () => {
    let header = document.querySelector('.header');
    let overlay = document.querySelector('.overlay');
    let headerSearchBtn = header.querySelector('#header-search');
    let searchWrap = header.querySelector('.header-search-wrap');
    let searchField = searchWrap.querySelector('#blog-search');

    headerSearchBtn.addEventListener('click', evt => {
        evt.preventDefault();
        headerSearchBtn.classList.toggle('close-btn');
        if (headerSearchBtn.classList.contains('close-btn')) {
            searchWrap.style.display = 'block';
            overlay.style.display = 'block';
            searchField.focus();
        } else {
            searchWrap.style.display = 'none';
            overlay.style.display = 'none';
        }
    });

    let closeMobileMenu = header.querySelector('#close-mobile-menu');
    let openMobileMenu = header.querySelector('#open-mobile-menu');
    let mobileMenu = header.querySelector('.mobile-menu');

    openMobileMenu.addEventListener('click', evt => {
        evt.preventDefault();
        mobileMenu.style.display = 'block';
    });
    closeMobileMenu.addEventListener('click', evt => {
        evt.preventDefault();
        mobileMenu.style.display = 'none';
    });

    let userMenuBtn = header.querySelector('#user-menu');
    let userMenuBtnIcon = userMenuBtn.querySelector('i');
    let userMenu = header.querySelector('.header-user-menu');

    userMenuBtn.addEventListener('click', evt => {
        evt.preventDefault();
        openUserMenu(userMenuBtnIcon, userMenu);
    });

    let mobileMenuUserInfoBtn = header.querySelector('#mobile-user-btn');
    let mobileMenuUserWrap = header.querySelector('.mobile-menu-user');
    let mobileMenuIcon = mobileMenuUserInfoBtn.querySelector('i');
    let mobileUserProps = header.querySelector('.mobile-menu-user-props');
    mobileMenuUserInfoBtn.addEventListener('click', evt => {
        evt.preventDefault();
        mobileMenuUserWrap.classList.toggle('menu-active');
        openUserMenu(mobileMenuIcon, mobileUserProps);
    });
    function openUserMenu (btn, menu) {
        btn.classList.toggle('rotate');
        if(menu.style.display == 'none') {
            menu.style.display = 'block';
        } else {
            menu.style.display = 'none';
        }
    }
});

let lazyLoadInstance = new LazyLoad({
    elements_selector: ".lazy"
});