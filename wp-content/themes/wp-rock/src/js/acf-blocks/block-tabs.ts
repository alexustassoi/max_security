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
                991: {
                    slidesPerView: 3,
                    spaceBetween: 15,
                },
                375: {
                    slidesPerView: 3,
                    spaceBetween: 15,
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
