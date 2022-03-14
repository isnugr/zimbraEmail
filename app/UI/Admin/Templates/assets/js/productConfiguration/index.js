//replace url wrapper
var mgUrlParser = {
    oldMgUrlParser: mgUrlParser,

    getCurrentUrl: function(){
        var url = this.oldMgUrlParser.getCurrentUrl();
        return url.replace("action=edit", "action=module-settings").replace("&success=true", "");
    }
};

$( document ).ready(function() {

    triggSwitcherAction();
});


function redirectToPage(tabNumber)
{
    var windowAddress = String(window.location);
    var hashTab = windowAddress.indexOf('#tab=');
    var andTab = windowAddress.indexOf('&tab=');
    if (hashTab > 0 && andTab > 0) {
        var count = Math.min(hashTab, andTab);
    } else {
        var count = Math.max(hashTab, andTab);
    }

    var redirectTo = (count > 0) ? windowAddress.substring(0, count) : windowAddress;
    window.location = redirectTo + '&tab=' + tabNumber;
}

function redirectToConfigurableOptionsTab()
{
    redirectToPage(5);
}

function redirectToCustomFieldsTab()
{
    redirectToPage(4);

}

function productConfigurationSelect(event)
{
    productConfigurationSettings(event, event.target.value);
}

function productConfigurationSettings(event, packageName)
{
    // const formFields        = $(event.target).parents().find('.lu-form-group , .lu-form-check');
    // const protectedFields = ['mgpci[package]','mgpci[dedicated_ip]','mgpci[reseller_ip]','mgpci[suspend_at_limit]'];
    // formFields.each(function(key, item){
    //     let name = $(item).find('input')[0].name;
    //     if (!name)
    //     {
    //         name = $(item).find('select')[0].name;
    //     }
    //     if (protectedFields.indexOf(name) === -1)
    //     {
    //         if (packageName === 'custom'){
    //             $(item).show();
    //         }
    //         else{
    //             $(item).hide();
    //         }
    //     }
    // });
}

function hiddeSections(event)
{
    /**
     * all sections name
     * @type {string[]}
     */
    var sections = [
        'calendarFeatures',
        'classOfServiceFeatures',
        'contactFeatures',
        'essentialFeatures',
        'generalFeatures',
        'mailServiceFeatures',
        'mimeFeatures',
        'searchFeatures',
    ];

    var availableSections = [];

    /**
     * set which section should be displayed
     */
    if(event.target.value == 'customMGzimbra')
    {
        availableSections = [
            'calendarFeatures',
            'contactFeatures',
            'essentialFeatures',
            'generalFeatures',
            'mailServiceFeatures',
            'mimeFeatures',
            'searchFeatures',
        ];
    }else if(event.target.value == 'zimbraConfigurableOptions'){
        availableSections = [];
    }else if(event.target.value == 'cosQuota'){
        availableSections = [
            'classOfServiceFeatures'
        ];
    }
    /**
     * hide or show sections
     */
    hideSecction(sections, availableSections);
}

/**
 * hide or display section
 * @param sections
 * @param availableSections
 */
function hideSecction(sections, availableSections)
{

    sections.forEach(function(entry, key, each){
        if(availableSections.includes(entry) === true)
        {
            document.getElementById(entry).style.display="";
        }else{
            document.getElementById(entry).style.display="none";
        }
    })
}

$(document).ready(function(){


})

$('#ProductConfigurationPage').ready(function()
{
    /**
     * trigg change select
     */
    $("[name=cos_name]").trigger("change");

    // var packageName = $('select[name="mgpci[package]"]').val()
    //
    // if(packageName !== "custom")
    // {
    //
    //     var protectedArrayFields = ['mgpci[package]','mgpci[dedicated_ip]','mgpci[reseller_ip]','mgpci[suspend_at_limit]'];
    //     var fields = $('#layers').find('.lu-form-group , .lu-form-check')
    //
    //     fields.each(function(){
    //         var fieldName = $(this).find('input').attr('name')
    //
    //         if(typeof fieldName === "undefined"){
    //             fieldName = $(this).find('select').attr('name')
    //         }
    //         if (protectedArrayFields.indexOf(fieldName) === -1)
    //         {
    //             $(this).hide();
    //         }
    //     })
    //
    //
    // }

})

/**
 *
 * @description trigg switcher change event action
 * @returns {undefined}
 */
function triggSwitcherAction()
{
    $('.configSelectAllButton').each(function (key, selectAllButton) {

        let section = $('#' + selectAllButton.parentElement.parentElement.parentElement.parentElement.id);
        let inputs = section.find('input');

        checkAndSetMainSwitcher(inputs);
    });
}


function checkSection(vueControler, params, event)
{
    if(!event.currentTarget)
    {
        return;
    }

    var div = event.currentTarget.parentElement.parentElement.parentElement.parentElement;
    let selectAllSwitcher = $(div).find('input')[0];
    let inputs = $(div).find('input');
    for (const input of inputs) {
        input.checked =  selectAllSwitcher.checked;
    };
}

function checkOptionUnderSection(event)
{
    if(!event.currentTarget)
    {
        return;
    }

    var allInputs  = $(event.currentTarget.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement).find('input');
    var inputsToCheck = $(event.currentTarget.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement).find('input');

    for (const input of inputsToCheck) {
        if(input.checked == false)
        {
            allInputs[0].checked = false;

            return;
        }
    }

    allInputs[0].checked = true;

}


function checkAndSetMainSwitcher(inputs)
{
    var checked = true;

    inputs.each(function(key,input){
        if(input.checked == false && key !== 0)
        {
            checked = false;
        }
    });

    checked == false ? $(inputs[0]).removeAttr('checked') : $(inputs[0]).attr('checked', 'true');
}
