$(document).ready(function() {
    var images = [];
    images.push({
        src: "{{ asset('storage/images/mobile_image/' . basename($block->mobile_image)) }}",
        opts: {
        caption: 'mobile_image'
        }
    });
    images.push({
        src: "{{ asset('storage/images/sample_image_1/' . basename($block->sample_image_1)) }}",
        opts: {
        caption: 'sample_image_1'
        }
    });
    images.push({
        src: "{{ asset('storage/images/sample_image_2/' . basename($block->sample_image_2)) }}",
        opts: {
        caption: 'sample_image_2'
        }
    });
    
    $.each(images, function(index, value) {
        $('a.fancybox-thumb').eq(index).fancybox(value.opts);
    });
    
    $('a.main-image').fancybox({
        type: 'image',
        caption: function(instance, item) {
        return $(this).find('img').attr('alt');
        }
    });
    });