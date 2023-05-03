$(document).ready(function() {
    // Mengambil semua foto dan menyimpannya ke dalam array
    var images = [];
    images.push({
        src: "{{ asset('storage/images/mobile_image/' . basename($block->mobile_image)) }}",
        opts: {
        caption: 'Mobile Image'
        }
    });
    images.push({
        src: "{{ asset('storage/images/sample_image_1/' . basename($block->sample_image_1)) }}",
        opts: {
        caption: 'Sample Image 1'
        }
    });
    images.push({
        src: "{{ asset('storage/images/sample_image_2/' . basename($block->sample_image_2)) }}",
        opts: {
        caption: 'Sample Image 2'
        }
    });

    // Menambahkan fancybox pada foto lainnya
    $.each(images, function(index, value) {
        $('a.fancybox-thumb').eq(index).fancybox(value.opts);
    });
    
    // Menambahkan fancybox pada main image
    $('a.main-image').fancybox({
        type: 'image',
        caption: function(instance, item) {
        return $(this).find('img').attr('alt');
        }
    });
    });