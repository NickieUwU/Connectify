document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.btnHeart').forEach(button => {
        button.addEventListener('click', function() {
            if(this.classList.contains('bi-heart'))
            {
                this.classList.remove('bi-heart');
                this.classList.add('bi-heart-fill');
            }
            else
            {
                this.classList.remove('bi-heart-fill');
                this.classList.add('bi-heart');
            }
        });
    });
});