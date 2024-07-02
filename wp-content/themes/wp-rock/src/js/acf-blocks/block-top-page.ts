import Swiper, { Autoplay } from 'swiper';
import Popup from '../parts/popup-window';
import popupWarningTrigger from '../components/popup-warning';

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
            freeMode: true,
            speed: 11000,
            loop: true,
            slidesPerView: 'auto',
            modules: [Autoplay],
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
            },
        });

        // Stop autoscrolling when hovering over a slider.
        topPageSwiper.addEventListener('mouseenter', () => {
            swiper.autoplay.stop();
        });

        // Resume autoscrolling when the cursor leaves the slider.
        topPageSwiper.addEventListener('mouseleave', () => {
            swiper.autoplay.start();
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

                popupWarningTrigger(target);

                popupInstance.forceCloseAllPopup();
                // @ts-ignore
                popupInstance.openOnePopup('#popup-request-demo');

                break;
            }
            case 'load-content-demo-popup': {
                e.preventDefault();
                const targetPopup = window.document.getElementById('#popup-request-demo') as HTMLElement;

                if (!popupInstance && !targetPopup) return;

                popupWarningTrigger(target);
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
// @ts-ignore
if (window.acf) {
    // @ts-ignore
    window.acf?.addAction('render_block_preview', initBlockExample);
    // @ts-ignore
    window.acf?.addAction('render_block_preview', openRequestDemoPopup);
}

export {};
