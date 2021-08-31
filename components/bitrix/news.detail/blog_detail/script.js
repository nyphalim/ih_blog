Share = {
    vkontakte: function(purl, ptitle, pimg, iblock, id, prop) {
        url  = 'http://vkontakte.ru/share.php?';
        url += 'url='          + encodeURIComponent(purl);
        url += '&title='       + encodeURIComponent(ptitle);
        url += '&image='       + encodeURIComponent(pimg);
        url += '&noparse=true';
        Share.popup(url, iblock, id, prop, purl);
    },
    facebook: function(purl, iblock, id, prop) {
        let url = 'https://www.facebook.com/sharer/sharer.php?';
        url += 'u=' + encodeURIComponent(purl);
        Share.popup(url, iblock, id, prop, purl);
    },
    twitter: function(purl, ptitle, iblock, id, prop) {
        url  = 'http://twitter.com/share?';
        url += 'text='      + encodeURIComponent(ptitle);
        url += '&url='      + encodeURIComponent(purl);
        url += '&counturl=' + encodeURIComponent(purl);
        Share.popup(url, iblock, id, prop, purl);
    },
    popup: function(url, iblock, id, prop, purl) {
        window.open(url,'','toolbar=0,status=0,width=626,height=436');
        yaCounter17951839.reachGoal('share');
        $.post('/include/ajax-social-like.php', {purl:purl, iblock:iblock, id:id, prop:prop}, function (data){});
    }
};