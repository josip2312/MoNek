const menu = document.querySelector('.hamburger-menu');
const navigation = document.querySelector('.nav-items');

menu.addEventListener('click', (e) => {
	if (navigation.classList.contains('open')) {
		navigation.classList.remove('open');
	} else {
		navigation.classList.add('open');
	}
});
