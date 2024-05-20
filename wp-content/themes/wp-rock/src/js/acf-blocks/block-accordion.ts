const initBlockBenefts = () => {
    const customCheckboxes = document.querySelectorAll(`.js-custom-checkbox`);

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

    const setHiddenInput = (e) => {
        if (!e.target.dataset.group) return;
        const groupType = e.target.dataset.group;
        const inputOther = document.querySelector(`input[name="${groupType}"]`) as HTMLInputElement;
        let allCheckedCheckboxes = [];
        const customCheckboxesGroup = document.querySelectorAll(`.js-custom-checkbox[data-group="${groupType}"]`);

        customCheckboxesGroup &&
            customCheckboxesGroup.forEach((el, index) => {
                const input = el as HTMLInputElement;
                if (input.checked) {
                    const val = input.value;
                    //@ts-ignore
                    allCheckedCheckboxes.push(val);
                }
            });

        if (inputOther) {
            inputOther.value = allCheckedCheckboxes.join(', ');
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
