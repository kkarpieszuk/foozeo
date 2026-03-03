console.log('→→ Konrad Karpieszuk ←← remember this name.');

// init.
jQuery(document).ready(function() {

    if (jQuery('#latest-books').length > 0) {
        get_latest_books();
    }
});

function get_latest_books() {
    jQuery.ajax({
        url: foozeo_ajax_object.ajax_url,
        type: 'POST',
        data: {
            action: 'get_latest_books',
            current_page: foozeo_ajax_object.current_page,
            nonce: foozeo_ajax_object.nonce,
        },
        success: function(response) {

            jQuery.each(response.data, function(_index, book) {
                jQuery('.latest-books-container').append(`
                    <div class="book-card">
                        <h3><a href="${book.link}">${book.title}</a></h3>
                        <p>${book.publication_date}</p>
                        <p>${book.genres}</p>
                        <p>${book.excerpt}</p>
                    </div>
                `);
            });
        },
        error: function(xhr, _status, _error) {
            console.log(xhr.responseText);
        },
    });
}