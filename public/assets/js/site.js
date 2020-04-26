var chic            = {};
chic.extraFormData  = {};
chic.userCB         = {};
chic.userCB.confirm = function (data) 
{
    var jsonObject = data.json;
    if ('confirmation' in jsonObject)
    {
        var confirmation = data.event.target.querySelector('.confirmation');
        // console.log(confirmation);
        if (confirmation) confirmation.innerHTML = jsonObject.confirmation;
    }
};

chic.addAction = function (selectorCSS, eventName, callbackFunction, itemProcess=null)
{
    var listSelection = document.querySelectorAll(selectorCSS);
    for(var item of listSelection)
    {
        item.addEventListener(eventName, callbackFunction);
        if(itemProcess != null)
            itemProcess(item);
    }
}

chic.submitAjax = function (event)
{
    if (event.preventDefault)
        event.preventDefault();

    // get form data
    var formData = new FormData(event.target);

    // add extra formData
    for(var cle in chic.extraFormData)
    {
        formData.append(cle, chic.extraFormData[cle]);
    }

    // launch AJAX request
    fetch('api', {
        method: 'POST',
        body: formData
    })
    .then((serverResponse) => {
        // console.log(serverResponse);
        return serverResponse
                .json()
                .then((jsonObject) => {
                    // WORKAROUND
                    // ADD event IN data
                    var data    = {};
                    data.json   = jsonObject;
                    data.event  = event;
                    data.serverResponse = serverResponse;

                    // DEBUG
                    console.log(data);
                    // CALL LIST OF CALLBACK IN OBJECT   
                    for (var cb in chic.userCB)
                    {
                        var curcb = chic.userCB[cb];
                        if (curcb) curcb(data);
                    }
                });
    });
    
}

chic.addAjaxForm = function ()
{
    chic.addAction("form.ajax", "submit", chic.submitAjax, function(form){
        form.classList.remove("ajax");
        form.classList.add("ajaxReady");
    });
}
