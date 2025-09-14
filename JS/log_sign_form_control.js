
const form_log = document.getElementById('log-form-container');
const form_sign = document.getElementById('sign-form-container');
const form_member = document.getElementById('member-form-container');



(function(){
    if (f === 'log'){
        form_log.setAttribute('style','display: block;')
        form_member.setAttribute('style','display: none;')
    }
    else {
            form_log.setAttribute('style','display: none;')
            form_member.setAttribute('style','display: block;')
        }
})();