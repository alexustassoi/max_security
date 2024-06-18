const initBlockBenefts = () => {
    const customCheckboxes = document.querySelectorAll(`.js-custom-checkbox`);

    const scrollToElement = () => {
        const urlParams = new URLSearchParams(window.location.search);
        let fromParam = urlParams.get('from-page');
        fromParam = fromParam && fromParam.replace(/^\/+|\/+$/g, '');

        const accordionToOpen = document.querySelector(`#${fromParam}`) as HTMLElement;

        if (accordionToOpen) {
            accordionToOpen.classList.add('open');

            window.scrollTo({
                top: accordionToOpen.offsetTop - 100,
                behavior: 'smooth',
            });
        }
    };

    scrollToElement();

    const setHiddenInput = (e) => {
        if (!e.target.dataset.group) return;
        const groupType = e.target.dataset.group;
        const inputOther = document.querySelector(`input[name="${groupType}"]`) as HTMLInputElement;
        const allCheckedCheckboxes = [];
        const customCheckboxesGroup = document.querySelectorAll(`.js-custom-checkbox[data-group="${groupType}"]`);

        customCheckboxesGroup &&
            customCheckboxesGroup.forEach((el, index) => {
                const input = el as HTMLInputElement;
                if (input.checked) {
                    const val = input.value;
                    // @ts-ignore
                    allCheckedCheckboxes.push(val);
                }
            });

        if (inputOther) {
            inputOther.value = allCheckedCheckboxes.join(', ');
        }
    };

    customCheckboxes &&
        customCheckboxes.forEach((input) => {
            input.addEventListener('change', setHiddenInput);
        });
};

document.addEventListener('DOMContentLoaded', initBlockBenefts, false);

// Initialize dynamic block preview (editor).
// @ts-ignore
if (window?.acf) {
    // @ts-ignore
    window?.acf?.addAction('render_block_preview', initBlockBenefts);
}

export {};
