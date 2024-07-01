export {};

const initBlockExample = () => {

    const scrollBottom = document.querySelector('.js-scroll-bottom') as HTMLElement;

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
};

document.addEventListener('DOMContentLoaded', initBlockExample, false);
