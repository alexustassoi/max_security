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
