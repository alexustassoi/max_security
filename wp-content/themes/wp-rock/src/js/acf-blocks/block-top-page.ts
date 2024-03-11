import Swiper, { EffectFade, Navigation } from 'swiper';

const initBlockExample = () => {
    const scrollBottom = document.querySelector('.js-scroll-bottom') as HTMLElement;
    const topPageSwiper = document.querySelector('.js-top-page-swiper') as HTMLElement;

    scrollBottom?.addEventListener('click', (event: MouseEvent) => {
        event.preventDefault();
        const target = event.target as HTMLElement;
        const parent: HTMLElement | null = target.closest('.js-top-block');

        if (parent) {
            const height: number = parent.offsetHeight;

            window.scrollBy({
                top: height - 50,
                behavior: 'smooth',
            });
        }
    });

    if( topPageSwiper ) {
        const swiper = new Swiper(topPageSwiper, {
            spaceBetween: 55,
            loop: true,
            slidesPerView: 'auto', // Автоматически определить количество слайдов в видимой области
            freeMode: true, // Отключить строгую фиксацию слайдов в центре
        });
    }
};

document.addEventListener('DOMContentLoaded', initBlockExample, false);

// Initialize dynamic block preview (editor).
if (window['acf']) {
    window['acf']?.addAction('render_block_preview', initBlockExample);
}

export {};
