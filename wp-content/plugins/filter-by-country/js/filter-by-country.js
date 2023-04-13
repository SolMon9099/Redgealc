jQuery(document).ready(function($) {
    $(window).on('load', function() {
        setTimeout(() => {
            var intervalId = setInterval(function() {
                if ( $('#editor .components-panel__body').length ) {
                    $('#editor .components-panel__body').each(function() {
                        var title = $(this).find('.components-panel__body-title').text().trim();
                        if ( title == 'Países' ) {
                            $(this).hide();
                        }
                    });
                    clearInterval(intervalId);
                }
            }, 100);

            $('.edit-post-sidebar__panel-tab').click(function() {
                setTimeout(() => {
                    var intervalId = setInterval(function() {
                        if ( $('#editor .components-panel__body').length ) {
                            $('#editor .components-panel__body').each(function() {
                                var title = $(this).find('.components-panel__body-title').text().trim();
                                if ( title == 'Países' ) {
                                    $(this).hide();
                                }
                            });
                            clearInterval(intervalId);
                        }
                    }, 100);
                }, 200);
            })
        }, 1500);
    });
});