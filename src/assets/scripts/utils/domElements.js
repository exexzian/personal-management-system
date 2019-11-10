export default (function () {

    if (typeof utils === 'undefined') {
        window.utils = {}
    }

    utils.domElements = {
        /**
         * This function is a find() decorator but it will throw exception if element was not found
         * This is needed as some functionality MUST be executed so missing child element is a bug
         * @param element
         * @param selector
         * @returns {boolean}
         */
        findChild: function (element, selector) {

            let childElement = $(element).find(selector);

            if( 0 === $(childElement).length)
            {
                throw({
                    "message"        : "Could not find the selector for element.",
                    "element"        : element,
                    "selectorToFind" : selector
                })
            }

            return childElement;
        },
        /**
         * Fetches the form view for given form name and appends it to the targetSelector
         * @param formName
         * @param targetSelector
         */
        appendFormView: function(formName, targetSelector){

            let $targetElement = $(targetSelector);

            if( 0 === $targetElement.length ){
                throw ({
                    "message"   : "No element with given selector was found",
                    "selector"  : targetSelector
                })
            }

            try{
                var namespace = dataProcessors.forms[formName].getFormNamespace();
            }catch(Exception){
                throw({
                    'message'   : "Could not load form namespace from data processors.",
                    'formName'  : formName
                })
            }

            let callback = function(formView){
                $targetElement.append(formView)
            };

            ui.ajax.getFormViewByNamespace(namespace, callback);
        }
    };

    // build subform based on namespace\class
    // [+] will add the same form below
    // use ui/ajax to implement form fetching
    // handle [+] here

}());