const initBlockBenefts = () => {
    const beneftsTitle = document.querySelectorAll('.js-benefts-title') as NodeListOf<Element>;

    beneftsTitle &&
        beneftsTitle.forEach((item) => {
            item.addEventListener('click', (event) => {
                const screenWidth = window.innerWidth;
                const clickElem = event.target as HTMLElement;

                clickElem.classList.toggle('open');

                if (screenWidth <= 768) {
                    const parent = clickElem.closest('.js-benefts-item') as HTMLElement;
                    parent.querySelector('.js-benefts-content')?.classList.toggle('open');
                }
            });
        });
};

document.addEventListener('DOMContentLoaded', initBlockBenefts, false);

// Initialize dynamic block preview (editor).
if (window['acf']) {
    window['acf']?.addAction('render_block_preview', initBlockBenefts);
}

export {};
