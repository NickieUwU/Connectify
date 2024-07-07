document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('btnFollow').addEventListener('click', function() {
        if(this.classList.contains('btn-secondary'))
        {
            this.classList.remove('btn-secondary');
            this.classList.add('btn-outline-danger');
            this.innerHTML = 'Following';
        }
        else
        {
            this.classList.remove('btn-outline-danger');
            this.classList.add('btn-secondary');
            this.innerHTML = 'Follow';
        }
    });
});