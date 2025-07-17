$(document).ready(function(){

    // document.querySelector('video').addEventListener('play', function() {
    let route = $('#homework-route').val();
    // Send an AJAX request to mark the homework as viewed
    fetch(route, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({})
    }).then(response => response.json()).then(data => {
        console.log(data);
    }).catch(error => {
        console.error('Error marking homework as viewed:', error);
    });
    // });
    $('#select-stage').change(function(){
        let units_route = $('#units_route').val();
        //change the id of the route
        let lastRouteSegment = /[^/]*$/.exec(units_route)[0];
        let newRoute =  units_route.replace(lastRouteSegment, this.value);
        $('#units_route').val(newRoute);
        $.ajax({
            url: newRoute,
            type: "get",
            success: function(response){
                $('#select-unit').find('option').remove();
                $('#select-unit').append('<option selected disabled>choose</option>');
                $.each(response, function (key, data) {
                    $('#select-unit').append('<option value="'+ data.id+'">'+ data.name +'</option>');
                });
            },
            error: function(error){
                console.log('-----err---------',error);
            }
        });
    });
    $('#select-unit').change(function(){
        let lessons_route = $('#lessons_route').val();
        //change the id of the route
        let lastRouteSegment = /[^/]*$/.exec(lessons_route)[0];
        let newRoute =  lessons_route.replace(lastRouteSegment, this.value);
        $('#lessons_route').val(newRoute);
        $.ajax({
            url: newRoute,
            type: "get",
            success: function(response){
                $('#select-lesson').find('option').remove();
                $('#select-lesson').append('<option selected disabled>choose</option>');
                $.each(response, function (key, data) {
                    $('#select-lesson').append('<option value="'+ data.id+'">'+ data.name +'</option>');
                });
            },
            error: function(error){
                console.log('-----err---------',error);
            }
        });
    });
    $('#select-lesson').change(function(){
        let homework_route = $('#homework_route').val();
        //change the id of the route
        let lastRouteSegment = /[^/]*$/.exec(homework_route)[0];
        let newRoute =  homework_route.replace(lastRouteSegment, this.value);

        let old_homework_route = $('#new_homework_input').val();
        console.log('-==-=-=-',old_homework_route);
        //change the id of the route
        let lastNewRouteSegment = /[^/]*$/.exec(old_homework_route)[0];
        console.log('-==-lastNewRouteSegment=-=-',lastNewRouteSegment);
        let new_homeworkRoute =  old_homework_route.replace(lastNewRouteSegment, this.value);
        console.log('-==-new_homeworkRoute=-=-',new_homeworkRoute);
        $('#new_homework').removeClass('d-none');
        $('#new_homework').attr('href', new_homeworkRoute);
        $.ajax({
            url: newRoute,
            type: "get",
            success: function(response){
                $.each(response, function (key, data) {
                    let homework_show_route = $('#homework_show_route').val();
                    //change the id of the route
                    let lastRouteSegment = /[^/]*$/.exec(homework_show_route)[0];
                    let newRoute =  homework_show_route.replace(lastRouteSegment, data.id);
                    $('.homework-list').append('<a class="btn btn-primary py-3 px-5 mt-2" href="' +newRoute+ '">'+ data.name + '</a><br><br>');
                });
            },
            error: function(error){
                console.log('-----err---------',error);
            }
        });
    });

});
