$(function(){
    // Smooth scroll for anchor links
    $('a.nav-link, a[href^="#"]').on('click', function(e){
        var target = $(this).attr('href');
        if(target.startsWith('#')){
            e.preventDefault();
            var $t = $(target);
            if($t.length){
                $('html,body').animate({scrollTop: $t.offset().top - 70}, 600);
            }
        }
    });

    // Active menu on scroll
    var sections = $('section[id]');
    $(window).on('scroll resize', function(){
        var scrollPos = $(document).scrollTop() + 80;
        sections.each(function(){
            var top = $(this).offset().top;
            var id = $(this).attr('id');
            if(scrollPos >= top){
                $('.nav-link, .bn-item').removeClass('active');
                $('.nav-link[href="#'+id+'"], .bn-item[href="#'+id+'"]').addClass('active');
            }
        });
    }).trigger('scroll');

    // Fade-in on scroll
    function showOnScroll(){
        $('.fade-in').each(function(){
            var top = $(this).offset().top;
            var winTop = $(window).scrollTop() + $(window).height() - 100;
            if(winTop > top){ $(this).addClass('show'); }
        });
    }
    $(window).on('scroll', showOnScroll);
    showOnScroll();

    // Navbar shrink on scroll
    function navbarShrink(){
        if($(window).scrollTop() > 60){
            $('.navbar').addClass('scrolled');
        } else { $('.navbar').removeClass('scrolled'); }
    }
    $(window).on('scroll', navbarShrink); navbarShrink();

    // Bootstrap ScrollSpy (init)
    try{ var bs = new bootstrap.ScrollSpy(document.body, { target: '#navbarNav', offset: 90 }); }catch(e){}

    // Init blog carousel with smooth options
    try{
        var blogCarouselEl = document.getElementById('blogCarousel');
        if(blogCarouselEl){
            var bc = new bootstrap.Carousel(blogCarouselEl, { interval: 5000, ride: 'carousel', pause: 'hover', wrap: true });
        }
    }catch(e){}

    // Lazy-load images (IntersectionObserver + carousel preloader)
    function loadImage(img){
        if(!img) return;
        var src = img.getAttribute('data-src');
        if(!src) return;
        // handle srcset if provided
        var srcset = img.getAttribute('data-srcset');
        if(srcset){ img.setAttribute('srcset', srcset); }
        img.src = src;
        img.addEventListener('load', function(){ img.classList.remove('lazyload'); img.classList.add('loaded'); });
        img.removeAttribute('data-src');
    }

    var lazyImages = [].slice.call(document.querySelectorAll('img.lazyload'));
    if('IntersectionObserver' in window){
        let lazyObserver = new IntersectionObserver(function(entries, observer){
            entries.forEach(function(entry){
                if(entry.isIntersecting){
                    loadImage(entry.target);
                    lazyObserver.unobserve(entry.target);
                }
            });
        }, {rootMargin: '200px 0px'});
        lazyImages.forEach(function(img){ lazyObserver.observe(img); });
    } else {
        // fallback: load all
        lazyImages.forEach(function(img){ loadImage(img); });
    }

    // For carousel, preload next slide image on slide event
    if(blogCarouselEl){
        blogCarouselEl.addEventListener('slid.bs.carousel', function(e){
            var next = e.relatedTarget.nextElementSibling || blogCarouselEl.querySelector('.carousel-item');
            if(next){
                var imgs = next.querySelectorAll('img.lazyload');
                imgs.forEach(function(i){ loadImage(i); });
            }
        });
        // also ensure active slide image loads immediately
        var activeImgs = blogCarouselEl.querySelectorAll('.carousel-item.active img.lazyload');
        activeImgs.forEach(function(i){ loadImage(i); });
    }

    // Back to top
    var $back = $('#backToTop');
    $(window).on('scroll', function(){
        $back.toggleClass('show', $(window).scrollTop() > 300);
    });
    $back.on('click', function(){ $('html,body').animate({scrollTop:0},600); });

    // Auto-close mobile nav after tapping a link
    var $navCollapse = $('#navbarNav');
    $navCollapse.on('click', 'a.nav-link, a.btn-nav-cta', function(){
        if($navCollapse.hasClass('show')){
            bootstrap.Collapse.getOrCreateInstance($navCollapse[0]).hide();
        }
    });

    // Simple form validation bootstrap
    (function(){
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function(form){
            form.addEventListener('submit', function(event){
                if(!form.checkValidity()){
                    event.preventDefault(); event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false)
        })
    })();
});
