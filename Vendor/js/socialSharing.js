'use strict';

$.fn.socialSharingPlugin = function(options){
    let settings = $.extend({
            title: '',
            description: '',
            img: '',
            url: '',
            btnClass: '',
            enable: null,
            responsive: false,
            mobilePosition: 'left',
            copyMessage: 'Copied to clipboard',
            copyTooltipPosition: 'center-bottom'
        }, options),
        defaults = {
            popupWidth: 640,
            popupHeight: 528,
            copyTop: 0,
            copyLeft: 0,
            copyTxt: '',
            copyTimeout: 5000,
            appName: 'SocialJS:'
        },
        urls = {
            copy: {
                icon: 'fas fa-copy',
                color: '#b9b9b9',
                url: 'copy:[post-title]\r\n[post-url]'
            },
            facebook: {
                icon: 'fab fa-facebook',
                color: '#4267B2',
                url: 'https://www.facebook.com/sharer.php?u=[post-url]'
            },
            twitter: {
                icon: 'fab fa-twitter',
                color: '#00acee',
                url: 'https://twitter.com/share?url=[post-url]&text=[post-desc]'
            },
            pinterest: {
                icon: 'fab fa-pinterest',
                color: '#E60023',
                url: 'https://pinterest.com/pin/create/bookmarklet/?media=[post-img]&url=[post-url]&description=[post-title]'
            },
            linkedin: {
                icon: 'fab fa-linkedin',
                color: '#0072b1',
                url: 'https://www.linkedin.com/shareArticle?url=[post-url]&title=[post-title]'
            },
            reddit: {
                icon: 'fab fa-reddit',
                color: '#FF5700',
                url: 'https://reddit.com/submit?url=[post-url]&title=[post-title]'
            },
            stumbleupon:{
                icon: 'fab fa-stumbleupon',
                color: '#f74425',
                url: 'https://www.stumbleupon.com/submit?url=[post-url]&title=[post-title]'
            },
            pocket:{
                icon: 'fab fa-get-pocket',
                color: '#E60023',
                url: 'https://getpocket.com/save?url=[post-url]&title=[post-title]'
            },
            email:{
                icon: 'fas fa-envelope',
                color: '#5522a4',
                url: 'mailto:?subject=[post-title]&body=Check out this site: [post-url]'
            },
            whatsapp:{
                icon: 'fab fa-whatsapp',
                color: '#1e7d34',
                url: 'https://wa.me/?text=[post-title]+[post-url]'
            }
        },
        copyToClipboard = function(text) {
            let sampleTextarea = document.createElement("textarea");
            document.body.appendChild(sampleTextarea);
            sampleTextarea.value = text;
            sampleTextarea.select();
            document.execCommand("copy");
            document.body.removeChild(sampleTextarea);
        },
        copyTrigger = function(text){
            let tooltip = $('<div class="socialJS-custom-tooltip ' + settings.copyTooltipPosition + '"><i class="fas fa-share text-warning"></i> ' + settings.copyMessage + '</div>');
            $.each($(document).find('.socialJS-custom-tooltip'), function () {
                $(this).remove();
            });
            $('body').append(tooltip);
            tooltip.animate({
                opacity: 1
            }, 300);
            setTimeout(function () {
                tooltip.animate({
                    opacity: 0
                }, 300);
                setTimeout(function () {
                    tooltip.remove()
                }, 300);
            }, defaults.copyTimeout);
            copyToClipboard(text);
        },
        build = function (e) {
            if(!$.isArray(settings.enable))
            {
                console.error(defaults.appName + ' You must enable at least 1 social link');
                return;
            }
            let $splugin = $('<div class="socialJS">');
            if(settings.responsive)
            {
                $splugin.addClass('responsive');
                $splugin.addClass(settings.mobilePosition);
            }

            $.each(settings.enable, function (k, v) {
                if(!urls[v])
                {
                    console.error(defaults.appName + ' ' + v + ' is not a valid url');
                    return;
                }
                let $element = $('<a>');

                let link = urls[v].url
                    .replace('[post-title]', encodeURIComponent(settings.title))
                    .replace('[post-url]', encodeURIComponent(settings.url))
                    .replace('[post-img]', encodeURIComponent(settings.img))
                    .replace('[post-desc]', encodeURIComponent(settings.description));
                $element.addClass(settings.btnClass);
                $element.attr('data-action', 'social-share');
                $element.attr('href', link);
                $element.html('<i class="' + urls[v].icon + '" style="color:' + urls[v].color + '"></i>');
                $splugin.append($element);
            });
            e.append($splugin);

            $(document).on('click', '[data-action="social-share"]', function (ele) {
                ele.preventDefault();
                if($(this).attr('href').startsWith('copy:')){
                    defaults.copyTop = e.pageY + 25;
                    defaults.copyLeft = e.pageX - 15;
                    copyTrigger(decodeURIComponent($(this).attr('href').replace('copy:', '')));
                } else {
                    let top = (screen.height / 2) - (defaults.popupHeight / 2),
                        left = (screen.width / 2) - (defaults.popupWidth / 2);
                    window.open($(this).data('href') || $(this).attr('href'), 't', 'toolbar=0,resizable=1,status=0,copyhistory=no,width=' + defaults.popupWidth + ',height=' + defaults.popupHeight + ',top=' + top + ',left=' + left);
                }
            });

            $(document).on('click', '.socialJS-custom-tooltip', function () {
                $(this).remove();
            })
        };

    return this.each(function() {
        return new build($(this));
    });
};
