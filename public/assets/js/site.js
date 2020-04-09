function addAction(selectorCSS, eventName, callbackFunction)
{
    var listSelection = document.querySelectorAll(selectorCSS);
    listSelection.forEach(function(item) {
        item.addEventListener(eventName, callbackFunction);
    });
}
function addAjaxForm(extraCallback=null)
{
    addAction("form.ajax", "submit", function(event){
        event.preventDefault();
        // DEBUG 
        // console.log(event);
    
        // get form data
        var formData = new FormData(event.target);
    
        // launch AJAX request
        fetch('api', {
            method: 'POST',
            body: formData
        })
        .then(function (serverResponse) {
            // console.log(serverResponse);
            return serverResponse.json();
        })
        .then(function(jsonObject){
            // DEBUG
            console.log(jsonObject);
    
            if ('confirmation' in jsonObject)
            {
                var confirmation = event.target.querySelector('.confirmation');
                // console.log(confirmation);
                if (confirmation) confirmation.innerHTML = jsonObject.confirmation;
            }
            
            if(extraCallback) extraCallback(jsonObject);
        });
    
    });
    
}
