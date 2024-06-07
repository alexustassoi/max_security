import Swiper, { Autoplay, EffectCreative } from 'swiper';
import Popup from "../parts/popup-window";

const initBlockExample = () => {
    const scrollBottom = document.querySelector('.js-scroll-bottom') as HTMLElement;
    const topPageSwiper = document.querySelector('.js-top-page-swiper') as HTMLElement;
    const topPageTitles = document.querySelector('.js-top-page-titles') as HTMLElement;

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

    if (topPageTitles) {
        const swiperTitles = new Swiper(topPageTitles, {
            slidesPerView: 1,
            loop: true,
            direction: 'vertical',
            modules: [Autoplay],
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
        });
    }

    if (topPageSwiper) {
        const swiper = new Swiper(topPageSwiper, {
            spaceBetween: 55,
            loop: true,
            slidesPerView: 'auto',
            freeMode: true,
        });
    }
};

const openRequestDemoPopup = () => {
    const popupInstance = new Popup();

    document.body.addEventListener('click', (e) => {
        const target = e.target as HTMLElement;
        const { role } = target.dataset;

        if (!role) return;

        switch (role) {
            case 'open-request-demo-popup': {
                e.preventDefault();
                const targetPopup = window.document.getElementById('#popup-request-demo') as HTMLElement;

                if (!popupInstance && !targetPopup) return;
                popupInstance.forceCloseAllPopup();
                // @ts-ignore
                popupInstance.openOnePopup('#popup-request-demo');

                break;
            }
            default:
                break;
        }
    });
    // popupInstance.openOnePopup('#popup-request-demo');
};

document.addEventListener('DOMContentLoaded', initBlockExample, false);
document.addEventListener('DOMContentLoaded', openRequestDemoPopup, false);

// Initialize dynamic block preview (editor).
if (window['acf']) {
    window['acf']?.addAction('render_block_preview', initBlockExample);
    window['acf']?.addAction('render_block_preview', openRequestDemoPopup);
}

export {};
