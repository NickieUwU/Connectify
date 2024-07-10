document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('tableMenu').addEventListener('click', function(){
        let togle = document.getElementById('menu');
        if(togle.classList.contains('invisible'))
        {
            togle.classList.remove('invisible');
            togle.classList.add('visible');
        }
        else
        {
            togle.classList.remove('visible');
            togle.classList.add('invisible');
        }
    });
});