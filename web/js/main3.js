/**
 * main3.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2014, Codrops
 * http://www.codrops.com
 */
(function () {

    new WOW().init();
    $('#conn').bind('scroll', function ()
    {
        if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight)
        {
            $('#footer').fadeIn("1000");
        } else if ($(this).scrollTop() === 0) {
//            alert("inicio");
        } else {
            $('#footer').fadeOut();
        }
    });

    $(document).ready(function () {
        var inProgress = false;
//        var anim = 'la-anim-1';
        animEl = document.querySelector('.la-anim-1');
        if (inProgress)
            return false;
        inProgress = true;
        classie.add(animEl, 'la-animate');
        setTimeout(function () {
            classie.remove(animEl, 'la-animate');
            inProgress = false;
        }, 3000);
    });

    var bodyEl = document.body,
            content = document.querySelector('.content-wrap'),
            openbtn = document.getElementById('open-button'),
            closebtn = document.getElementById('close-button'),
            isOpen = false,
            morphEl = document.getElementById('morph-shape'),
            s = Snap(morphEl.querySelector('svg'));
    path = s.select('path');
    initialPath = this.path.attr('d'),
            pathOpen = morphEl.getAttribute('data-morph-open'),
            isAnimating = false;
    function init() {
        initEvents();
    }

    function initEvents() {
        openbtn.addEventListener('click', toggleMenu);
        if (closebtn) {
            closebtn.addEventListener('click', toggleMenu);
        }

// close the menu element if the target it´s not the menu element or one of its descendants..
        content.addEventListener('click', function (ev) {
            var target = ev.target;
            if (isOpen && target !== openbtn) {
                toggleMenu();
            }
        });
    }

    function toggleMenu() {
        if (isAnimating)
            return false;
        isAnimating = true;
        if (isOpen) {
            classie.remove(bodyEl, 'show-menu');
            // animate path
            setTimeout(function () {
                // reset path
                path.attr('d', initialPath);
                isAnimating = false;
            }, 300);
        }
        else {
            classie.add(bodyEl, 'show-menu');
            // animate path
            path.animate({'path': pathOpen}, 400, mina.easeinout, function () {
                isAnimating = false;
            });
        }
        isOpen = !isOpen;
    }
    init();
})();
