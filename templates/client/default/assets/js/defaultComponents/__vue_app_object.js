/*
* Core js fw functions
* Do not edit this file 
*/

/* 
 * Default Vue App object
 */
var mgDefauleVueObject = {
            el: null,//'#'+controlerId,
            data: {
                targetId : null,//controlerId,
                targetUrl : null, //mgUrlParser.getCurrentUrl(),
                pageLoading : false,
                returnedData : null,
                loading : false,
                loaderComponent : '<div class="row"><i class="dataTables_processing"></i></div>',
                sSearch : null,
                showModal : false,
                htmlContent : '',
                modalBodyContainer : 'mg-modal-body',
                refreshingState : [],
                massActionIds : null,
                massActionTargetCont : null,
                pagePreLoader : null,
                
                
                destroyComponent: false,
                modalInstance : null,
                
                mgNewModalContainerName: 'mg-component-body-empty-modal',
                mgNewModalJsObj: null,
                mgNewModalvIf: false,
                appActionBlockingState: false,
                modalState: {
                    navLinks: []
                }

            },
            created: function () {
                var self = this;
                self.$on('restartRefreshingState', self.cleanRefreshActionsState());
                self.$nextTick(function(){
                    initContainerSelects('layers');
                });
                mgEventHandler.runCallback('AppCreated', self.targetId, {instance: self});
            },
            methods: {
                selectChangeAction : function($event) {
                    mgEventHandler.runCallback('SelectFieldValueChanged', $event.target.name, {data: $event.target});
                },
                rendKey: function (lenth) {
                    if (!lenth) {
                        lenth = 6;
                    }
                    var randKey = "";
                    var avChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

                    for (var i = 0; i < lenth; i++) {
                      randKey += avChars.charAt(Math.floor(Math.random() * avChars.length));
                    }
                    
                    return randKey;
                },
                vloadData : function (params, forceRawData) {
                    var self = this;
                    var returnType = forceRawData ? 'text' : 'json';
                    self.refreshUrl();
                    for(var propertyName in params) {
                        self.addUrlComponent(propertyName, params[propertyName]);
                    }
                    self.addUrlComponent('ajax', '1');
                    return $.get(self.targetUrl, function(data){
                        if (!forceRawData) {
                            data = data.data;
                            if (data.callBackFunction && typeof window[data.callBackFunction] === "function") {
                                window[data.callBackFunction](data);
                            }
                        }
                    }, returnType).fail(function(jqXHR, textStatus, errorThrown) {
                        //self.addAlert('danger', 'Action Failed');
                        console.log('Action Failed');
                    });
                },
                addUrlComponent : function($name, $value) {
                    var self = this;
                    if (typeof $value === 'object') {
                        for (var key in $value) {
                            if (!$value.hasOwnProperty(key)) {
                                continue;
                            }
                            self.targetUrl += (self.targetUrl.indexOf('?') !== -1 ? '&' : '?') + $name + '[' + key + ']' + '=' + encodeURIComponent($value[key]);
                        }
                    } else{
                        self.targetUrl += (self.targetUrl.indexOf('?') !== -1 ? '&' : '?') + $name + '=' + encodeURIComponent($value);
                    }
                },
                updateUrlParam : function(key, value, event){
                    var self = this;
                    value = self.updateValueByAttrs(key, value, event);
                    if(self.targetUrl.indexOf(key) === -1){
                        self.addUrlComponent(key, value);
                    } else {
                        var baseUrlParts = self.targetUrl.split('?');
                        var currentUrlParams = baseUrlParts[1].split('&');
                        for(i=0; i < currentUrlParams.length; i++){
                            if(currentUrlParams[i].indexOf(key) === 0){
                                if(value === ''){
                                    currentUrlParams.splice(i, 1);
                                } else {
                                    currentUrlParams[i] = key + '=' + value;
                                }
                            }
                        }
                        var updatedUrlParams = currentUrlParams.join('&');
                        self.targetUrl = baseUrlParts[0] + '?' + updatedUrlParams;
                    }
                },
                updateValueByAttrs : function(key, value, event){
                    if(value.indexOf(':') !== 0){
                        return value;
                    } else {
                        if($(event.target).attr('data-' + key)) {
                            return $(event.target).attr('data-' + key);
                        } else if( $(event.target).parents('a').first().attr('data-' + key)) {
                            return $(event.target).parents('a').first().attr('data-' + key);
                        } else if( $(event.target).parents('button').first().attr('data-' + key)) {
                            return $(event.target).parents('button').first().attr('data-' + key);
                        } else {
                            return value;
                        }
                    }
                },
                refreshUrl : function() {
                    var self = this;
                    self.targetUrl = mgUrlParser.getCurrentUrl();
                    if(self.targetUrl.indexOf('#') > 0) {
                        self.targetUrl = self.targetUrl.substr(0, self.targetUrl.indexOf('#'));
                    }
                },
                loadModal : function(event, targetId, namespace, index, params, addSpinner){
                    event.preventDefault();
                    event.stopImmediatePropagation();
                    var self = this;
                    if (self.appActionBlockingState) {
                        return true;
                    }
                    self.appActionBlockingState = true;
                    self.htmlContent = '<div></div>';
                    if (addSpinner) {
                        self.showSpinner(event);
                    }
                    self.refreshUrl();
                    self.initRefreshActions(event, targetId);
                    self.initMassActions(event);
                    self.addUrlComponent('loadData', targetId);
                    self.addUrlComponent('namespace', namespace);
                    if (params && params.length > 0)
                    {
                        for (i = 0; i < params.length; i++) {
                            self.addUrlComponent(params[i].name, params[i].value);
                        }
                    }
                    self.addUrlComponent('index', index);
                    self.addUrlComponent('mgformtype', 'read');
                    self.getActionId(event);
                    self.addUrlComponent('ajax', '1');
                    var request = $.get(self.targetUrl, function(data){
                        data = data.data;
                        if(data.status === 'success'){
                            self.htmlContent = data.rawData.htmlData;
                            mgPageControler.initModal(targetId, namespace, index, event, data.rawData);
                        } else {
                            self.handleErrorMessage(data);
                            mgEventHandler.runCallback('ModalLoadFailed', targetId, {respData: data});
                        }
                        self.$nextTick(function() {
                           if (data.callBackFunction && typeof window[data.callBackFunction] === "function") {
                                window[data.callBackFunction](data, targetId, event);
                            }
                        });
                        if (addSpinner) {
                            self.hideSpinner(event);
                        }
                        self.appActionBlockingState = false;
                    }, 'json').fail(function(jqXHR, textStatus, errorThrown) {
                        if (addSpinner) {
                            self.hideSpinner(event);
                        }
                        self.appActionBlockingState = false;
                        self.handleServerError(jqXHR, textStatus, errorThrown);
                        mgEventHandler.runCallback('ModalLoadFailed', targetId, {jqXHR : jqXHR, textStatus: textStatus, errorThrown: errorThrown});
                    });
                    self.refreshUrl();

                    return request;
                },
                showSpinner : function(event) {
                    var self = this;
                    var spinnerTarget = self.getSpinerTarget(event);
                    if (spinnerTarget && spinnerTarget.length > 0 || $(spinnerTarget).tagName === 'I') {
                        var isBtnIcon = $(spinnerTarget).hasClass('lu-btn__icon');
                        $(spinnerTarget).attr('originall-button-icon', $(spinnerTarget).attr('class'));
                        $(spinnerTarget).removeAttr('class');
                        $(spinnerTarget).attr('class', (isBtnIcon ? 'lu-btn__icon ' : '') + 'lu-btn__icon lu-preloader lu-preloader--sm');
                    } else {
                        self.addSpinner(event);
                    }
                },
                reloadModalContent: function(event, targetId, namespace, index, params, addSpinner) {
                    var self = this;
                    $('#mgModalContainer').append('<div class="preloader-container preloader-container--full-screen preloader-container--overlay" v-show="loading"><div class="preloader preloader--sm"></div></div>');
                    self.refreshUrl();
                    self.initRefreshActions(event, targetId);
                    self.initMassActions(targetId);
                    self.addUrlComponent('loadData', targetId);
                    self.addUrlComponent('namespace', namespace);
                    self.addUrlComponent('index', index);
                    self.addUrlComponent('mgformtype', 'reload');
                    self.getActionId(event);
                    self.addUrlComponent('ajax', '1');
                    self.storeModelContentState(targetId);
                    var formData =[];
                    if($('#mgModalContainer').find('form').length > 0) {
                        var formTargetId = $('#mgModalContainer').find('form').first().attr('id');
                        var formCont = new mgFormControler(formTargetId);
                        var formData = formCont.getFieldsData();
                    }
                    $.ajax({
                        type: "POST",
                        url: self.targetUrl,
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json'})
                        .done(function (data) {

                            data = data.data;
                        if(data.status === 'success'){
                           self.htmlContent = data.rawData.htmlData;
                           self.destroyComponent = true;
                           
                           mgPageControler.initModal(targetId, namespace, index, event, data.rawData);
                        } else {
                            self.handleErrorMessage(data);
                            $('#mgModalContainer #mg-full-modal-wrapper').remove();
                        }
                        self.$nextTick(function() {
                            if (data.callBackFunction && typeof window[data.callBackFunction] === "function") {
                                window[data.callBackFunction](data, targetId, event);
                            }
                            self.restoreModelContentState();
                        });
                        }, 'json').fail(function() {
                        //self.addAlert('danger', 'Action Failed');
                        console.log('Action Failed');
                    });
                    self.refreshUrl();
                },
                storeModelContentState: function(targetId){
                    var targetIndex = $('#confirmationModal').attr('index');
                    var navLinks = $('[index='+targetIndex+'] .lu-nav__item.is-active .lu-nav__link');
                    var self = this;

                    navLinks.each(function () {
                        self.modalState.navLinks.push($(this).attr('href'));
                    });

                },
                restoreModelContentState: function(){
                    $(this.modalState.navLinks).each(function(){
                        $('[href="'+this+'"]').each(function() {
                            this.click();
                        });
                    });
                },
                hideSpinner : function(event) {
                    var self = this;
                    var spinnerTarget = self.getSpinerTarget(event);
                    if ($(event.target).attr('originall-button-content')) {
                        self.removeSpinner(event);
                    } else if (spinnerTarget && spinnerTarget.length > 0 || $(spinnerTarget).tagName === 'I') {
                        $(spinnerTarget).removeAttr('class');
                        $(spinnerTarget).attr('class', $(spinnerTarget).attr('originall-button-icon'));
                        $(spinnerTarget).removeAttr('originall-button-icon');
                    }
                },
                removeSpinner : function(event) {
                    $(event.target).html($(event.target).attr('originall-button-content'));
                    $(event.target).removeAttr('originall-button-content');
                },
                addSpinner : function(event) {
                    var elWidth = $(event.target).width();
                    var spinnerClass = $(event.target).hasClass('lu-btn--success') ? 'lu-preloader-success' : ($(event.target).hasClass('lu-btn--danger') ? 'lu-preloader-danger' : '');
                    $(event.target).attr('originall-button-content', $(event.target).html());
                    $(event.target).html('<span class="lu-btn__icon lu-temp-button-loader" style="margin: 0 0 0 0 !important; width: ' + elWidth + 'px;"><i class="lu-btn__icon lu-preloader lu-preloader--sm ' + spinnerClass + '"></i></span>');
                },
                getSpinerParent : function(event) {
                    if($(event.target)[0].tagName === 'A' || $(event.target)[0].tagName === 'BUTTON'){
                        return $(event.target)[0];
                    } else if($(event.target)[0].parents('button').first()){
                        return $(event.target)[0].parents('button').first();
                    } else if($(event.target)[0].parents('a').first()){
                        return $(event.target)[0].parents('a').first();
                    } else {
                        return null;
                    }
                },
                getSpinerTarget : function(event) {
                    if($(event.target)[0].tagName === 'I'){
                        return $(event.target);
                    } else if($(event.target)[0].tagName === 'SPAN'){
                        var aParents = $(event.target).parents('a');
                        return aParents.length === 0 ? $(event.target).parents('button').first().find('i').first() : $(event.target).parents('a').first().find('i').first();
                    } else if($(event.target)[0].tagName === 'A'){
                        return $(event.target).find('i').first();
                    } else if($(event.target)[0].tagName === 'BUTTON'){
                        return $(event.target).find('i').first();
                    } else {
                        return null;
                    }
                },
                initMassActions : function(event){
                    var self = this;
                    self.cleanMassActions();
                    if($(event.target).parents('.lu-t-c__mass-actions').length === 0)
                    {
                        return;
                    }
                    self.addUrlComponent('isMassAction', '1');
                    var tableContainer = $(event.target).parents('.vueDatatableTable').first().attr('id');
                    self.massActionTargetCont = tableContainer;
                    self.massActionIds = collectTableMassActionsData(tableContainer);
                },
                addMassActionsToData : function (formData){
                    var self = this;
                    if(self.massActionIds){
                        for (var key in self.massActionIds) {
                            if (!self.massActionIds.hasOwnProperty(key)) {
                                continue;
                            }
                            formData.set('massActions[' + key + ']', self.massActionIds[key]);
                        }
                        return formData;
                    }else{
                        return formData;
                    }
                },
                cleanMassActions : function(){
                    var self = this;
                    if(self.massActionIds || self.massActionTargetCont){
                        self.massActionIds = null;
                        //uncheckSelectAllCheck(self.massActionTargetCont);
                        self.$nextTick(function() {
                            self.massActionTargetCont = null;
                        });
                    }
                },
                addRefreshActions: function (targetId) {
                    var self = this;
                    self.refreshingState.push(targetId);
                },
                initRefreshActions : function(event, targetId) {
                    var self = this;
                    var menuReloading = ['addGroupButton', 'editGroupButton', 'deleteGroupButton'];
                    if(menuReloading.indexOf(targetId) > -1)
                    {
                        self.refreshingState = ['mg-category-menu'];
                        return;
                    }
                    var tableContainer = $(event.target).parents('.vueDatatableTable').first();
                    self.refreshingState = [$(tableContainer).attr('id')];
                },
                runRefreshActions : function(ids, data) {
                    var self = this;
                    var rfIds = (ids && ids.length > 0) ? ids : self.refreshingState;
                    var customParams = (data && typeof data.customParams !== undefined) ? data.customParams : null;
                    if(rfIds && rfIds.length > 0){
                        $.each(rfIds, function (index, Id) {
                            var targetId = Id;
                            self.$nextTick(function() {
                                self.$emit('reloadMgData', targetId, customParams);
                            });
                        });
                    }
                },
                cleanRefreshActionsState : function() {
                    var self = this;
                    self.refreshingState = [];
                },                  
                getActionId : function(event) {
                    var self = this;
                    var tableActions = $(event.target).parents("td.mgTableActions");
                    var widgetActionComponent = $(event.target).parents("div.widgetActionComponent");
                    if($(tableActions).length  === 1){
                        var row = $(tableActions[0]).parent('tr');
                        var actionElementId = $(row).attr("actionid");
                        if(actionElementId){
                            self.addUrlComponent('actionElementId', actionElementId);
                        }
                    } else if(widgetActionComponent.length  === 1){
                        var actionElementId = widgetActionComponent.first().attr("actionid");
                        if(actionElementId){
                            self.addUrlComponent('actionElementId', actionElementId);
                        }                        
                    }                    
                },
                submitForm : function(targetId, event) {
                    event.preventDefault();
                    var self = this;
                    if (self.appActionBlockingState) {
                        return true;
                    }
                    self.appActionBlockingState = true;
                    var formTargetId = ($('#'+targetId)[0].tagName === 'FORM') ? targetId : $('#'+targetId).find('form').attr('id');
                    if(formTargetId){
                        self.showSpinner(event);
                        var formCont = new mgFormControler(formTargetId);
                        var formData = formCont.getFieldsData();
                        formData = self.addMassActionsToData(formData);
                        self.refreshUrl();
                        self.addUrlComponent('loadData', formTargetId);
                        self.addUrlComponent('namespace', getItemNamespace(formTargetId));
                        self.addUrlComponent('index', getItemIndex(formTargetId));
                        self.addUrlComponent('ajax', '1');
                        self.addUrlComponent('mgformtype', $('#'+formTargetId).attr('mgformtype'));
                        $.ajax({
                            type: "POST",
                            url: self.targetUrl,
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json'
                        })
                        .done(function( data ) {
                            data = data.data;
                            self.hideSpinner(event);
                            self.$nextTick(function() {
                                if (data.callBackFunction && typeof window[data.callBackFunction] === "function") {
                                    window[data.callBackFunction](data, targetId, event);
                                }
                            });
                            if(data.status === 'success'){
                                self.showModal = false;
                                self.runRefreshActions((data && typeof data.refreshIds !== undefined) ? data.refreshIds : null, data);
                                self.cleanMassActions();
                                self.addAlert(data.status, data.message);
                                formCont.updateFieldsValidationMessages([]);
                            } else if (data.rawData !== undefined && data.rawData.FormValidationErrors !== undefined) {
                                formCont.updateFieldsValidationMessages(data.rawData.FormValidationErrors);
                            } else {
                                formCont.updateFieldsValidationMessages([]);
                                self.handleErrorMessage(data);
                            }
                            self.appActionBlockingState = false;
                        }).fail(function(jqXHR, textStatus, errorThrown) {
                            self.hideSpinner(event);
                            self.handleServerError(jqXHR, textStatus, errorThrown);
                            self.appActionBlockingState = false;
                        });
                    }
                    else {
                        //todo error reporting
                    }
                },
                handleErrorMessage: function(data) {
                    var self = this;
                    self.addAlert(data.status,(data.message ? data.message : (typeof data.data !== 'undefined' ?
                            ((typeof data.data.errorCode !== 'undefined' ? 'Error Code: ' + data.data.errorCode + ' <br> ' : '')
                                + (typeof data.data.errorToken !== 'undefined' ? 'Error Token: ' + data.data.errorToken + ' <br> ' : '')
                                + (typeof data.data.errorTime !== 'undefined' ? 'Error Time: ' + data.data.errorTime + ' <br> ' : '')
                                + (typeof data.data.errorMessage !== 'undefined' ? 'Message: ' + data.data.errorMessage : '')) : '')
                    ));

                    if ((typeof data.data !== 'undefined') && (typeof data.data.errorCode !== 'undefined'))
                    {
                        console.log(data.data);
                    }
                },
                handleServerError: function(jqXHR, textStatus, errorThrown) {
                    var self = this;
                    if (jqXHR.responseText.indexOf('id="mg-sh-h-492318-64534" value="') > 0){
                        var errTokenStart = jqXHR.responseText.indexOf('mg-sh-h-492318-64534') + 20;
                        var errTokenEnd = jqXHR.responseText.indexOf('mg-sh-h-492318-64534-end');
                        var errToken = jqXHR.responseText.substr(errTokenStart, (errTokenEnd - errTokenStart));
                        errToken = errToken.replace('value=', '').replace(/\"/g, '').replace(/\s/g, '');
                        self.addAlert('error', 'Unexpected Error. <br>Error Token: ' + errToken);
                        console.log('Action Failed. Error Token: ' + errToken);
                    } else {
                        console.log('Action Failed');
                    }
                },
                ajaxAction : function(event, targetId, namespace, index, postData) {
                    var self = this;
                    self.refreshUrl();
                    self.initRefreshActions(event, targetId);
                    self.addUrlComponent('loadData', targetId);
                    self.addUrlComponent('namespace', namespace);
                    self.addUrlComponent('index', index);
                    self.getActionId(event);
                    self.addUrlComponent('ajax', '1');
                    $.post(self.targetUrl, postData, {},'json')
                        .done(function( data ) {
                            data = data.data;
                            self.addAlert(data.status, data.message);
                            self.$nextTick(function() {
                                if (data.callBackFunction && typeof window[data.callBackFunction] === "function") {
                                    window[data.callBackFunction](data, targetId, event);
                                }
                            });
                            if(data.status === 'success'){

                            }
                    }, 'json');
                    self.refreshUrl();               
                },                
                updateSorting : function(order, loadData, namespace) 
                {
                    var self = this;
                    
                    self.refreshUrl();
                    self.addUrlComponent('loadData', loadData);
                    self.addUrlComponent('namespace', namespace);
                    self.addUrlComponent('ajax', '1');
                    self.addUrlComponent('mgformtype', "reorder");     
                    
                    var formData = {order : order}
                    $.post(self.targetUrl, {formData: formData}, {},'json').done(function( data )
                    {
                        data = data.data;
                        self.addAlert(data.status, data.message);
                        self.pageLoading = false;
                        self.$nextTick(function() {
                            if (data.callBackFunction && typeof window[data.callBackFunction] === "function") {
                                window[data.callBackFunction](data, loadData);
                            }
                        });
                        if(data.status === 'success')
                        {
                            //Dispaly alert?
                        }
                        else  
                        {
                            //TODO: Dispaly alert
                        }
                    });                 
                },
                addAlert : function(type, message){
                    type = (type === 'error') ? 'danger' : type;
                    layers.alert.create({
                        $alertPosition: 'right-top', 
                        $alertStatus: type, 
                        $alertBody: message,
                        $alertTimeout: 10000 
                    });                    
                },
                makeCustomAction : function(functionName, params, event, namespace, index) {
                    var self = this;
                    if (functionName && typeof mgPageControler.vueLoader[functionName] === "function") {
                        mgPageControler.vueLoader[functionName](self, params, event, namespace, index);
                    } else if (functionName && typeof window[functionName] === "function") {
                        window[functionName](self, params, event, namespace, index);
                    }
                },
                redirect : function (event, params, targetBlank) {
                    var self = this;
                    var tempUrl = self.targetUrl;
                    if(params.rawUrl !== undefined){
                        self.targetUrl = params.rawUrl;
                    }
                    if(params.actionElementId !== undefined) {
                        self.getActionId(event);
                    }
                    $.each(params, function(key, value){
                        if(key === 'rawUrl' || key === 'actionElementId'){
                            return false;
                        } else {
                            self.updateUrlParam(key.replace('__', '-'), value, event);
                        }
                    });
                    if (targetBlank) {
                        window.open(self.targetUrl, '_blank');
                    } else {
                        window.location = self.targetUrl;
                    }
                },
                submitFormByEvent : function(event){
                    var self = this;
                    self.submitForm($(event.target).parents("form").first().attr('id'), event);
                },
                submitFormByField: function(event) {

                }
            }
        };