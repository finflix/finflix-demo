'use strict';

$.fn.socialSharingPlugin = function(options){
    let settings = $.extend({
        urlShare: '',
        btnTarget: '_blank',
        btnTitle: 'Share on',
        title: '',
        description: '',
        via:'',
        hashtags: '',
        img: '',
        isVideo: 'false',
        buttonClass: 'btn btn-light',
        applyDefaultButtonStyle: true
    }, options);

    let urls = {
        facebook: {
            icon: 'fab fa-facebook fa-2x',
            color: '#4267B2',
            url: 'https://www.facebook.com/sharer.php?u=[post-url]'
        },
        twitter: {
            icon: 'fab fa-twitter fa-2x',
            color: '#00acee',
            url: 'https://twitter.com/share?url=[post-url]&text=[post-title]&via=[via]&hashtags=[hashtags]'
        },
        pinterest: {
            icon: 'fab fa-pinterest fa-2x',
            color: '#E60023',
            url: 'https://pinterest.com/pin/create/bookmarklet/?media=[post-img]&url=[post-url]&is_video=[is_video]&description=[post-title]'
        },
        linkedin: {
            icon: 'fab fa-linkedin fa-2x',
            color: '#0072b1',
            url: 'https://www.linkedin.com/shareArticle?url=[post-url]&title=[post-title]'
        },
        reddit: {
            icon: 'fab fa-reddit fa-2x',
            color: '#FF5700',
            url: 'https://reddit.com/submit?url=[post-url]&title=[post-title]'
        },
        pocket:{
            icon: 'fab fa-get-pocket fa-2x',
            color: '#E60023',
            url: 'https://getpocket.com/save?url=[post-url]&title=[post-title]'
        },
        email:{
            icon: 'fas fa-envelope fa-2x',
            color: '#5522a4',
            url: 'mailto:?subject=[post-title]&body=Check out this site: [post-url]'
        },
        whatsapp:{
            icon: 'fab fa-whatsapp fa-2x',
            color: '#1e7d34',
            url: 'https://wa.me/?text=[post-title]+[post-url]'
        }
    };

    let build = function (e) {
        console.log(settings);
        $.each(urls, function (k, v) {
            let link = v.url
                .replace('[post-title]', encodeURIComponent(settings.title))
                .replace('[post-url]', encodeURIComponent(settings.urlShare))
                .replace('[post-desc]', encodeURIComponent(settings.description))
                .replace('[post-img]', encodeURIComponent(settings.img))
                .replace('[is_video]', encodeURIComponent(settings.isVideo))
                .replace('[hashtags]', encodeURIComponent(settings.hashtags))
                .replace('[via]', encodeURIComponent(settings.via));

            let btn = $('<a></a>');
            btn.attr('class', settings.buttonClass);
            btn.attr('href', link);
            btn.attr('target', settings.btnTarget);
            btn.attr('title', settings.btnTitle + ' ' + k);

            let icon = $('<i></i>');
            icon.attr('class', v.icon);
            if(settings.applyDefaultButtonStyle)
                icon.css({color:v.color});
            btn.append(icon);
            e.append(btn);
        });
    };

    return this.each(function() {
        return new build($(this));
    });
};
