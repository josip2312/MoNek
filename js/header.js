const menu = document.querySelector('.hamburger-menu');
const navigation = document.querySelector('.nav-items');

menu.addEventListener('click', (e) => {
	if (navigation.classList.contains('open')) {
		navigation.classList.remove('open');
	} else {
		navigation.classList.add('open');
	}
});

document.addEventListener('click', (e) => {
	const sidebar = document.querySelector('ul');

	if (e.target !== sidebar && e.target !== menu) {
		sidebar.classList.remove('open');
	}
});
