document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('btnFollow').addEventListener('click', function() {
        const followers = document.getElementById('followers');
        if(this.classList.contains('btn-secondary'))
        {
            this.classList.remove('btn-secondary');
            this.classList.add('btn-outline-danger');
            this.innerHTML = 'Following';
            followers.innerHTML++;
        }
        else
        {
            this.classList.remove('btn-outline-danger');
            this.classList.add('btn-secondary');
            this.innerHTML = 'Follow';
            followers.innerHTML--;
        }
    });
    document.getElementById('profileMenuDots').addEventListener('click', function() {
        let profileMenu = document.getElementById('profileMenu');
        if(profileMenu.classList.contains('hidden'))
        {
            profileMenu.classList.remove('hidden');
            profileMenu.classList.add('visible');
        }
        else if(profileMenu.classList.contains('visible'))
        {
            profileMenu.classList.remove('visible');
            profileMenu.classList.add('hidden');
        }
    });
});