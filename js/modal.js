const modal = document.querySelector('.modal');
const modalClose = document.querySelector('.modal-close');

modalClose.addEventListener('click', (e) => {
	console.log('click');
	modal.style.opacity = '0';
	modal.style.pointerEvents = 'none';
});
