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

	const setHiddenInput = (e) => {
		const input = e.target as HTMLInputElement;

		if (input.checked) {
			// Set hidden input inside form
			const hiddenInput = document.createElement('input');
			const form = document.querySelector('form');

			hiddenInput.type = 'hidden';
			hiddenInput.name = input.name;
			hiddenInput.value = input.value;
			form && form.appendChild(hiddenInput);
		} else {

			const findedHiddenInput = document.querySelector(`form [name="${input.name}"]`);
			findedHiddenInput && findedHiddenInput.remove();
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
