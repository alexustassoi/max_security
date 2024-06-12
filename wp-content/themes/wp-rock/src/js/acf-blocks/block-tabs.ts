import Swiper, { Autoplay } from 'swiper';
import { setHeightEqualToWidth } from '../parts/helpers';

const initBlockClients = () => {
    const tabsSwiper = document.querySelector('.js-tabs-swiper') as HTMLElement;
    if (tabsSwiper) {
        const tabsSlider = new Swiper(tabsSwiper, {
            spaceBetween: 25,
            slidesPerView: 4,
            breakpoints: {
                1920: {
                    spaceBetween: 25,
                    slidesPerView: 4,
                },
                481: {
                    slidesPerView: 4,
                    spaceBetween: 15,
                },
                415: {
                    slidesPerView: 3,
                    spaceBetween: 15,
                },
                376: {
                    slidesPerView: 2.5,
                    spaceBetween: 25,
                },
                320: {
                    slidesPerView: 2.1,
                    spaceBetween: 10,
                },
            },
        });
    }
};

document.addEventListener('DOMContentLoaded', initBlockClients, false);

// Initialize dynamic block preview (editor).
if (window['acf']) {
    window['acf']?.addAction('render_block_preview', initBlockClients);
}
