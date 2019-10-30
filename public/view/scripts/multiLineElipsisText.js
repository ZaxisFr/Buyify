function multiLineElipsisText(){
    const containers = document.querySelectorAll('.text-multiline-elipsis');
    Array.prototype.forEach.call(containers, (container) => {  // Loop through each container
        var divh = container.clientHeight;
        container.textContent = container.getAttribute("backupContent");
        while (container.scrollHeight-5> divh) { // Check if the paragraph's height is taller than the container's height. If it is:
            container.textContent = container.textContent.replace(/\W*\s(\S)*$/, '...'); // add an ellipsis at the last shown space
        }
    })
}
function setupLineElipsisText(){
    const containers = document.querySelectorAll('.text-multiline-elipsis');
    Array.prototype.forEach.call(containers, (container) => {  // Loop through each container
        container.setAttribute("backupContent",container.textContent);
    })
}
setupLineElipsisText();
multiLineElipsisText();
window.addEventListener('resize',multiLineElipsisText,true)