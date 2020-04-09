function addAction(selectorCSS, eventName, callbackFunction, extraCallback=null)
{
    var listSelection = document.querySelectorAll(selectorCSS);
    listSelection.forEach(function(item) {
        item.addEventListener(eventName, callbackFunction);
        if (extraCallback)
            item.extraCallback = extraCallback;
    });
}

function submitAjax (event)
{
    // FIXME 
    // PB WITH VUEJS... LOST this ?!
    // PATCH WITH LOCAL VARIABLE...
    var myExtraCB = event.target.extraCallback;
    // console.log(event.target.extraCallback);

    if (event.preventDefault)
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
    .then((jsonObject) => {
        // DEBUG
        console.log(jsonObject);

        if ('confirmation' in jsonObject)
        {
            var confirmation = event.target.querySelector('.confirmation');
            // console.log(confirmation);
            if (confirmation) confirmation.innerHTML = jsonObject.confirmation;
        }
        
        // FIXME
        // console.log(myExtraCB);
        if (myExtraCB) myExtraCB(jsonObject);
    });
    
}

function addAjaxForm(extraCallback=null)
{
    addAction("form.ajax", "submit", submitAjax, extraCallback);
}
