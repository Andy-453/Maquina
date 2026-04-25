document.documentElement.classList.add('js');

document.addEventListener('click', (event) => {
    const closeButton = event.target.closest('.answer-modal-close');

    if (closeButton) {
        closeButton.closest('.answer-modal')?.remove();
        return;
    }

    if (event.target.classList.contains('answer-modal')) {
        event.target.remove();
    }
});

document.addEventListener('keydown', (event) => {
    if (event.key !== 'Escape') {
        return;
    }

    document.querySelector('.answer-modal')?.remove();
});
