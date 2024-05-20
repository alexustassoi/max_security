const initBlockBenefts = () => {
    const customCheckboxes = document.querySelectorAll('.js-custom-checkbox');

    const scrollToElement = () => {
        const urlParams = new URLSearchParams(window.location.search);
        console.log(urlParams.get('from-page'));

        const accrodionToOpen = document.querySelector(`#${urlParams.get('from-page')}`) as HTMLElement;


        if (accrodionToOpen) {

            accrodionToOpen.classList.add('open');

            window.scrollTo({
                top: accrodionToOpen.offsetTop - 100,
                behavior: 'smooth',
            });
        }
    }

    scrollToElement();

    const setHiddenInput = () => {
        const inputOther = document.querySelector('input[name="other"]') as HTMLInputElement;
        let allCheckedCheckboxes = '';


        customCheckboxes &&
            customCheckboxes.forEach((el, index) => {
                const input = el as HTMLInputElement;
                if (input.checked) {
                    const coma = index + 1 === allCheckedCheckboxes.split(',').length ? '' : ', ';
                    allCheckedCheckboxes += `${coma}${input.value}`
                }
            });

        if (inputOther) {
            inputOther.value = allCheckedCheckboxes
        }
    }

    customCheckboxes &&
        customCheckboxes.forEach((input) => {
            input.addEventListener('change', setHiddenInput);
        })
};

document.addEventListener('DOMContentLoaded', initBlockBenefts, false);

// Initialize dynamic block preview (editor).
if (window['acf']) {
    window['acf']?.addAction('render_block_preview', initBlockBenefts);
}

export { };
