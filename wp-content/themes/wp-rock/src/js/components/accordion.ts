const initAccordion = () => {
    const accordions = document.querySelectorAll('.wrock-accordion');

    accordions &&
        accordions.forEach((item) => {
            item.addEventListener('click', (event) => {
                const target = event.target as HTMLElement;
                const btn = target.closest('.wrock-accordion__btn');
                if (!btn) return;

                const element = btn.parentElement as HTMLElement;
                const content = element.querySelector('.wrock-accordion__content') as HTMLElement;
                const openItem = item.querySelector('.wrock-accordion__item.open') as HTMLElement;

                // if (openItem && openItem !== item) {
                //     openItem.classList.remove('open');
                // }

                element.classList.toggle('open');
            });
        });
};

export default initAccordion;
