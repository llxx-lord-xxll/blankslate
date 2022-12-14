jQuery(document).ready(function($){
    // jQuery methods go here...
    $(document).on('click','a.paginate-next',function (e){
        e.preventDefault();
        var thisData = $(this);
        $.ajax({
            type : "POST",
            dataType : "json",
            url : $("meta[name='wp-ajax']").attr("content"),
            data : {action: "get_next_post", query: thisData.attr('data-current-query')},
            success: function (response, textStatus, XmlHttpRequest) {
                if (response.end){
                    thisData.css('display','none');
                    thisData.parent().append('<p>That\'s all for now!</p>')
                }
                thisData.attr('data-current-query',response.query)
                response.posts.forEach(function(post, index, arr){
                    var post_block = '<div class="grid">\n' +
                        '                    <div class="card">\n' +
                        '                        <div class="card__image">' +
                        '                           <img src="' + post.thumb + '" alt="">' +
                        '                            <div class="card__overlay card__overlay--dark">\n' +
                        '                                <div class="card__overlay-content">\n' +
                        '                                    <ul class="card__meta">' +
                        '                                       '  + post.cats +
                        '                                    </ul>' +
                        '                                    <a href="'+ post.permalink + '" class="card__title">'+ post.title + '</a>' +
                        '                                    <ul class="card__meta card__meta--last">' +
                        '                                       <li><a href="">' + post.reading + '</a></li>' +
                        '                                    <li><a href="'+ post.permalink + '"> Read more</a></li>' +
                        '                                     </ul>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                        </div>\n' +
                        '                    </div>\n' +
                        '                </div>';
                    thisData.parent().parent().find('.post-grid').append(post_block);

                });

            }
        });
    })

    jQuery.each( $('.post-grid .grid .card .card__overlay'), function (index, card_overlay){
        $(card_overlay).css('border-color',$(card_overlay).attr('data-cat-color'))
    } )
    $(document).on('mouseenter','.post-grid .grid .card .card__overlay',function (e){
        $(this).attr('data-original-bg',$(this).css('background-image'));
        $(this).css('background-image','linear-gradient(to bottom, ' + $(this).attr('data-cat-color') + '66, ' + $(this).attr('data-cat-color') + '99)')
    });
    $(document).on('mouseleave','.post-grid .grid .card .card__overlay',function (e){
        $(this).css('background-image','');
    });
});
