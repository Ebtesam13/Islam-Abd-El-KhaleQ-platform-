$(document).ready(function () {

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    setProgressBar(current);

    $(".next").click(function () {

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({ 'opacity': opacity });
            },
            duration: 500
        });
        setProgressBar(++current);
    });

    $(".previous").click(function () {

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({ 'opacity': opacity });
            },
            duration: 500
        });
        setProgressBar(--current);
    });

    function setProgressBar(curStep) {
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
            .css("width", percent + "%")
    }

    $(".submit").click(function () {
        // return false;
    });

    $('#user_type').on('change', function () {
        let userType = this.value;
        $('.user_type_info').fadeOut();
        $('#' + userType + '_info').fadeIn();
    });
    // var conceptName = $('#aioConceptName').find(":selected").val();

    $('#select-city').change(function () {
        let areasRoute = $('#areas_route').val();
        // console.log('----areasRoute----', areasRoute);

        // Check if areasRoute is valid
        if (!areasRoute) {
            // console.error('areasRoute is empty or invalid');
            return; // Exit the function if areasRoute is invalid
        }

        // Declare newRoute outside the if-else block
        let areasPath = new URL(areasRoute).pathname;

        // Use areasPath instead of areasRoute for manipulation
        let lastRouteSegment = /[^/]*$/.exec(areasPath)[0];
        let newPath;

        if (!isNaN(lastRouteSegment)) {
            newPath = areasPath.replace(lastRouteSegment, this.value);
        } else {
            newPath = areasPath.endsWith('/') ? areasPath + this.value : areasPath + '/' + this.value;
        }

        // Check if newRoute is valid
        if (!newPath || typeof newPath !== 'string') {
            // console.error('newPath is empty or invalid');
            return; // Exit the function if newPath is invalid
        }

        // Update the input value
        $('#areas_route').val(window.location.origin + newPath);

        // Perform the AJAX request
        $.ajax({
            url: window.location.origin + newPath,
            data: {
                "value": $("#artist").val()
            },
            type: "get",
            success: function (response) {
                $('#select-area').find('option').remove();
                $('#select-area').append('<option selected disabled>choose</option>');
                $.each(response, function (key, data) {
                    $('#select-area').append('<option value="' + data.id + '">' + data.area_name_ar + ' - ' + data.area_name_en + '</option>');
                });
            },
            error: function (error) {
                console.log('-----err---------', error);
            }
        });
    });
});
