const fileInput = document.querySelector('#photo');
const files = document.querySelector('.files');

const clickEvent = new Event('click');

const dropzone = document.querySelector('.dropzone');
dropzone.addEventListener('click', (e) => {
	fileInput.click();
});

fileInput.addEventListener('change', (e) => {
	const p = document.createElement('p');
	p.innerText = `Filename: ${fileInput.files[0].name}`;
	files.appendChild(p);
});
