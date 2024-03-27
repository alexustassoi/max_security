import Swiper, { Autoplay } from 'swiper';
import { setHeightEqualToWidth } from '../parts/helpers';

const initBlockClients = () => {
    const tabsSwiper = document.querySelector('.js-tabs-swiper') as HTMLElement;
    if (tabsSwiper) {
        const tabsSlider = new Swiper(tabsSwiper, {
            spaceBetween: 16,
            slidesPerView: 2,
            breakpoints: {
                991: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                375: {
                    slidesPerView: 3,
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
