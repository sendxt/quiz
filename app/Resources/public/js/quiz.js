$(document).ready(function () {
    $('.questions-collection').collection(
        {
            allow_up: true,
            allow_down: true,
            fade_in: false,
            fade_out: false,
            min: 1,
            prefix: 'questions-collection',
            children: [{
                selector: '.answers-collection',
                allow_up: true,
                allow_down: true,
                min: 2,
                prefix: 'answers-collection'
            }]

        }
    );

});