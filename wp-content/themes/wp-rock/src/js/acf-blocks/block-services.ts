import Swiper, { Autoplay } from 'swiper';

const initBlockServices = () => {
    const servicesSwiper = document.querySelector('.js-services-slider') as HTMLElement;
    if (servicesSwiper) {
        const clientSlider = new Swiper(servicesSwiper, {
            spaceBetween: 42,
            slidesPerView: 4,
            // freeMode: true,
            breakpoints: {
                320: {
                    loop: true,
                    slidesPerView: 'auto',
                    centeredSlides: true,
                    spaceBetween: 18,
                },
                769: {
                    loop: true,
                    slidesPerView: 'auto',
                    centeredSlides: true,
                    spaceBetween: 15,
                },
                993: {
                    slidesPerView: 4,
                    spaceBetween: 15,
                    loop: false,
                    centeredSlides: false,
                },
                1200: {
                    spaceBetween: 32,
                    slidesPerView: 4,
                },
            },
        });
    }
};

document.addEventListener('DOMContentLoaded', initBlockServices, false);

// Initialize dynamic block preview (editor).
if (window['acf']) {
    window['acf']?.addAction('render_block_preview', initBlockServices);
}

export {};
