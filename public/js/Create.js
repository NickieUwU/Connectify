function updateCounter() 
{
    var textarea = document.getElementById('IDcontent');
    var counter = document.getElementById('chars');
    counter.innerText = textarea.value.length + "/500";
}