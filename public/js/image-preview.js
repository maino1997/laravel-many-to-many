const
    def = 'http://www.asdalcione.it/wp-content/uploads/2016/08/jk-placeholder-image-1.jpg';
const prevInput = document.getElementById('image-input');
const prevImg = document.getElementById('image-src');

prevInput.addEventListener('change', function () {
    const url = this.value;
    if (url) prevImg.setAttribute('src', url);
    else prevImg.setAttribute('src',
        def);
})