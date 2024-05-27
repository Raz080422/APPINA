function showFlashAlert(type='info', message='')
{
    $('#flash_msg').slideUp();
    $('#flash_msg').find("div[class*='alert-']").removeClass (function (index, css) {
       return (css.match (/(^|\s)alert\S+/g) || []).join(' ');
    });
    $('#flash_msg').find('.alert').addClass(alertType(type).class);
    $('#flash_msg').find('#alert-title').html(alertType(type).title);
    $('#flash_msg').find('#alert-message').html(message);
    $('#flash_msg').slideDown();
    setTimeout(function() {
        $("#flash_msg").slideUp()
    }, 10000);
}
function closeFlashAlert()
{
    $('#flash_msg').fadeOut('slow');
}
function alertType(type)
{
    switch(type) {
        case 'default':
            var alert = {class: 'alert-default', title: 'Info'};
            break;
        case 'primary':
            var alert = {class: 'alert-primary', title: 'Info'};
            break;
        case 'secondary':
            var alert = {class: 'alert-secondary', title: 'Info'};
            break;
        case 'info':
            var alert = {class: 'alert-info', title: 'Info'};
            break;
        case 'success':
            var alert = {class: 'alert-success', title: 'Success'};
            break;
        case 'error':
            var alert = {class: 'alert-danger', title: 'Error'};
            break;
        case 'warning':
            var alert = {class: 'alert-warning', title: 'Warning'};
            break;
        default:
            var alert = {class: 'alert-default', title: 'Info'};
    }

    return alert;
}