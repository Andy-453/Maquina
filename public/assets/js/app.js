document.documentElement.classList.add('js');

document.addEventListener('click', (event) => {
    if (!(event.target instanceof Element)) {
        return;
    }

    const closeButton = event.target.closest('.answer-modal-close');

    if (closeButton) {
        const modal = closeButton.closest('.answer-modal');

        if (modal) {
            modal.remove();
        }

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

    const modal = document.querySelector('.answer-modal');

    if (modal) {
        modal.remove();
    }
});
