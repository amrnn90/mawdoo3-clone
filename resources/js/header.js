$(document).on('click', '.page-header__toggle', (e) => {
    const header = document.querySelector('.page-header');
    header.classList.toggle('page-header--open');
    $(header).find('.page-header__toggle').toggleClass('is-active');
});