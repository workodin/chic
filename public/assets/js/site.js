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

function addAction(selectorCSS, eventName, callbackFunction, itemProcess=null)
{
    var listSelection = document.querySelectorAll(selectorCSS);
    for(var item of listSelection)
    {
        item.addEventListener(eventName, callbackFunction);
        if(itemProcess != null)
            itemProcess(item);
    }
}

function submitAjax (event)
{
    if (event.preventDefault)
        event.preventDefault();

    // get form data
    var formData = new FormData(event.target);

    // add extra formData
    for(cle in chic.extraFormData)
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
                    // ADD event IN jsonObject
                    var data = {};
                    data.json = jsonObject;
                    data.event = event;
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

function addAjaxForm()
{
    addAction("form.ajax", "submit", submitAjax, function(form){
        form.classList.remove("ajax");
        form.classList.add("ajaxReady");
    });
}
