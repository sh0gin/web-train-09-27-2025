$(() => {
    $('#nav').on('click', 'a.nav-link', function(e) {
        e.preventDefault()
        // $('#modal').data('url', $(this).attr('href'));
        $('#title').html($(this).html())
        $.pjax.reload({
            container:'#pjax-modal',
            url:$(this).attr('href'),
            replace:false,
            push:false,
            timeout:5000,
        })

        
    })

    $('#pjax-modal').on('pjax:end', function (e) {
        $('#modal').modal('show');

    })

    
})


