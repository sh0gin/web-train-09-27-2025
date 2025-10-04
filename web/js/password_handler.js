$(() => {
    $('.field-registerform-password').on('change', '#registerform-password', function (e) {
        let input = $('#registerform-password').val();
        console.log(input.length);
        if (input.length < 2) {
            $('#registerform-password').css('border', '2px solid red');
        } else if (input.length < 7 && input.length >= 2) {
            $('#registerform-password').css('border', '2px solid yellow');
        } else if (input.length > 7) {
             $('#registerform-password').css('border', '2px solid green');
        }
    })
})