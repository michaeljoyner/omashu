var menuManager = {

    menuList: document.querySelector('.contents-top-level'),
    topBtn: null,

    init: function () {
        var elems = document.querySelectorAll('.content-menu-item');
        var mainMenu = document.querySelector('.contents-top-level');
        menuManager.topBtn = document.querySelector('.back-to-top-btn');
        var i = 0, l = elems.length;
        for (i; i < l; i++) {
            elems[i].addEventListener('click', menuManager.scrollTo, false);
        }
        window.addEventListener('scroll', menuManager.handleScroll, false);
        menuManager.topBtn.addEventListener('click', menuManager.scrollToTop, false);
    },

    scrollTo: function (ev) {
        var target = document.querySelector(ev.target.getAttribute('href'));
        Velocity(target, "scroll", 500);
    },

    scrollToTop: function () {
        var target = document.querySelector('.front-nav');
        Velocity(target, "scroll", 500);
    },

    handleScroll: function (ev) {
        if (window.innerWidth > 610) {
            if (document.body.scrollTop > 400) {
                menuManager.menuList.style.position = "fixed";
                menuManager.menuList.style.top = "40px";
                menuManager.menuList.style.width = "25%";
            } else {
                menuManager.menuList.style.position = "relative";
                menuManager.menuList.style.top = "40px";
                menuManager.menuList.style.width = "100%";
            }
        }


        if (document.body.scrollTop > 600 && menuManager.topBtn) {
            menuManager.topBtn.style.display = "block";
        } else {
            menuManager.topBtn.style.display = "none";
        }
    }
}