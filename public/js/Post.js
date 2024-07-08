document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('btnHeart').addEventListener('click', () => {
        let btnHeart = document.getElementById('btnHeart');
        if(btnHeart.classList.contains('bi-heart'))
        {
            btnHeart.classList.remove('bi-heart');
            btnHeart.classList.add('bi-heart-fill');
        }
        else
        {
            btnHeart.classList.remove('bi-heart-fill');
            btnHeart.classList.add('bi-heart');
        }
    });
});
