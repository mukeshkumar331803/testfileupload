$(document).ready(function() {
    // Documents uploaderss form submission
    $('#uploadForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "/upload",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    alert(response.success);
                    $('#uploadForm')[0].reset();
                }
                $('.text-danger').remove();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $('.text-danger').remove();
                    $.each(errors, function(key, value) {
                        $('[name="' + key + '"]').after('<span class="text-danger">' + value[0] + '</span>');
                    });
                } else {
                    console.log(xhr.responseText);
                }
            }
        });
    });

    $('#searchForm').submit(function(e) {
        e.preventDefault();

        var keyword = $('#searchKeyword').val();
        if (keyword.trim() === '') {
            alert('Please enter a valid keyword to search.');
            return;
        }
        $.ajax({
            type: "GET",
            url: "/search",
            data: { keyword: keyword },
            success: function(response) {
                var results = response.results;
                var output = '';

                if (results.length > 0) {
                    output += '<h6>Search results for: ' + keyword + '</h6>';

                    for (var i = 0; i < results.length; i++) {
                        var filePath = assetBaseUrl + results[i].file_path;
                        output += '<div class="result-container">';
                        output += '<h6>' + results[i].title.toUpperCase() + '<span class="correct-sign">✔</span></h6>';
                        output += '</div>';
                        output += '<a href="' + filePath + '" class="file-link" target="_blank">' + filePath + '</a>';
                    }
                } else {
                    output += '<p>No results found</p>';
                }
                $('#searchResults').html(output);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});
