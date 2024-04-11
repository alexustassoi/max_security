/**
 * SASS
 */
import '../scss/frontend.scss';
import initAccordion from './components/accordion';
/**
 * JavaScript
 */
import Sliders from './components/swiper-init';
import initAnimation from './parts/animation';
import tabsNavigation from './parts/navi-tabs';
import Popup from './parts/popup-window';

function ready() {
    const popupInstance = new Popup();
    const header = document.querySelector('.site-header') as HTMLElement;
    const maxWords = document.querySelectorAll('.js-max-words');
    const headerMaxWords = document.querySelector('.js-header-max-words') as HTMLElement;
    const closeMenu = document.querySelector('.js-close-menu') as HTMLElement;
    const mobileMenu = document.querySelector('.js-mobile-menu') as HTMLElement;
    const openMobileMenu = document.querySelector('.js-open-mobile-menu') as HTMLElement;
    const openSubmenu = document.querySelectorAll('.js-open-submenu > a') as NodeListOf<Element>;

    tabsNavigation('.js-tab-block-link', '.js-tab-block-panel');
    initAnimation();
    initAccordion();

    openMobileMenu &&
        openMobileMenu.addEventListener('click', (event) => {
            if (mobileMenu) {
                mobileMenu.classList.add('open');
                document.body.classList.add('no-scroll');
            }
        });

    closeMenu &&
        closeMenu.addEventListener('click', (event) => {
            if (mobileMenu) {
                mobileMenu.classList.remove('open');
                document.body.classList.remove('no-scroll');
            }
        });

    openSubmenu &&
        openSubmenu.forEach((item) => {
            item.addEventListener('click', (event) => {
                event.preventDefault();
                const clickElem = event.target;
                // @ts-ignore
                const parent = clickElem.closest('.js-open-submenu');
                parent.querySelector('.sub-menu')?.classList.toggle('open');
                // @ts-ignore
                clickElem.classList.toggle('open');
            });
        });

    maxWords &&
        maxWords.forEach((item) => {
            item.addEventListener('mouseenter', (event) => {
                event.preventDefault();
                if (headerMaxWords) {
                    headerMaxWords.classList.add('open');
                }
            });
        });

    maxWords &&
        maxWords.forEach((item) => {
            item.addEventListener('mouseleave', (event) => {
                event.preventDefault();
                if (headerMaxWords) {
                    headerMaxWords.classList.remove('open');
                }
            });
        });

    popupInstance.init();

    window.document.addEventListener('scroll', () => {
        const operationType = header && Math.floor(window.scrollY) > 100 ? 'add' : 'remove';
        header.classList[operationType]('scroll-header');
    });

    {
        // Detect Initial scroll of page
        const operationType = header && Math.floor(window.scrollY) > 100 ? 'add' : 'remove';
        header.classList[operationType]('scroll-header');
    }

    document.body.addEventListener('click', (e) => {
        const target = e.target as HTMLElement;

        const hoverQuery = window.matchMedia('(hover: hover)');

        if (target.classList.contains('menu-item-has-children') && !hoverQuery.matches) {
            target.classList.toggle('opened');
        }
    });

    document.addEventListener('wpcf7mailsent', (event) => {
        const form = event.target as HTMLFormElement;
        const isRedirect = form?.id && form.id === 'redirect-to-thank';
        const header = document.querySelector('#site-header')as HTMLElement;
        const pageToRedirect = header && header?.dataset.redirect_to ? header.dataset.redirect_to : false;

        if (isRedirect && pageToRedirect) {
            window.location.replace(pageToRedirect);
        }

    });
}

window.document.addEventListener('DOMContentLoaded', ready);
