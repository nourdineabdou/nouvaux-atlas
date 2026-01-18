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
                $('.nav-link').removeClass('active');
                $('.nav-link[href="#'+id+'"]').addClass('active');
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
        if($(window).scrollTop() > 300) $back.fadeIn(); else $back.fadeOut();
    });
    $back.on('click', function(){ $('html,body').animate({scrollTop:0},600); });

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
    // Admin AJAX handlers: load edit form, submit edit, delete image
    $(function(){
        // Set CSRF header for all AJAX
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content') }
        });

        // Open edit modal and load form
        $(document).on('click', '.img-edit-btn', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('#adminModalBody').html('<div class="text-center p-4">Loading…</div>');

            // show only the section row that contains this image to focus the admin view
            try{
                var section = $('#img-card-' + id).data('section');
                if(section){
                    // hide all section rows and their preceding headers, then show only target
                    $('div[id^="section-"]').hide();
                    $('div[id^="section-"]').each(function(){ $(this).prev('h5').hide(); });
                    var $targetRow = $('#section-' + section + '-row');
                    $targetRow.show();
                    $targetRow.prev('h5').show();
                }
            }catch(ex){ /* ignore if DOM not structured as expected */ }

            $('#adminModal').modal('show');
            $.get('/admin/images/'+id+'/edit', function(html){
                $('#adminModalBody').html(html);
            }).fail(function(){
                $('#adminModalBody').html('<div class="alert alert-danger">Failed to load form.</div>');
            });
        });

        // restore section rows when modal closes
        $('#adminModal').on('hidden.bs.modal', function(){
            $('div[id^="section-"]').show();
            $('div[id^="section-"]').each(function(){ $(this).prev('h5').show(); });
            $('#adminModalBody').html('');
        });

        // Submit edit form via AJAX (delegated because form is loaded dynamically)
        $(document).on('submit', '#image-edit-form', function(e){
            e.preventDefault();
            var $form = $(this);
            var action = $form.attr('action');
            var method = $form.find('input[name=_method]').val() || 'POST';
            var formData = new FormData(this);
            $.ajax({
                url: action,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
                        success: function(res){
                            if(res && res.success){
                                var id = res.id;
                                var newSection = res.section;
                                var cardHtml = res.card_html;
                                var $old = $('#img-card-' + id);
                                if($old.length){
                                    $old.replaceWith(cardHtml);
                                } else {
                                    var $row = $('#section-' + newSection + '-row');
                                    if($row.length){
                                        $row.prepend(cardHtml);
                                    } else {
                                        location.reload();
                                    }
                                }
                                $('#adminModal').modal('hide');
                            } else {
                                var msg = (res && res.message) ? res.message : 'Update failed.';
                                alert(msg);
                            }
                        },
                error: function(xhr){
                    var msg = 'Update failed.';
                    if(xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                    alert(msg);
                }
            });
        });

        // Delete image via AJAX
        $(document).on('click', '.img-delete-btn', function(e){
            e.preventDefault();
            if(!confirm('Delete this image?')) return;
            var id = $(this).data('id');
            $.ajax({
                url: '/admin/images/'+id,
                type: 'POST',
                data: { _method: 'DELETE' },
                success: function(){
                    // remove card
                    $('#img-card-'+id).fadeOut(300, function(){ $(this).remove(); });
                },
                error: function(){
                    alert('Failed to delete image.');
                }
            });
        });
    });
