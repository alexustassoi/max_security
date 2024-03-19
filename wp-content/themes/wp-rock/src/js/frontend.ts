/**
 * SASS
 */
import '../scss/frontend.scss';
/**
 * JavaScript
 */
import Sliders from './components/swiper-init';
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

    openMobileMenu &&
        openMobileMenu.addEventListener('click', (event) => {
            if (mobileMenu) {
                mobileMenu.classList.add('open');
            }
        });

    closeMenu &&
        closeMenu.addEventListener('click', (event) => {
            if (mobileMenu) {
                mobileMenu.classList.remove('open');
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
}

window.document.addEventListener('DOMContentLoaded', ready);
