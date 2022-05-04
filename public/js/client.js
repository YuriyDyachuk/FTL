$(() => {
    $(document).on('click', '.fabula_btn', function () {
        $('.fabula').toggle('slow');
    });

    $(document).on('click', '.reglament_btn', function () {
        $('.reglament').toggle('slow');
    });

    $(document).on('click', '.contacts_btn', function () {
        $('.contacts').toggle('slow');
    });

    $(document).on('click', '.requisites_btn', function () {
        $('.requisites').toggle('slow');
    });
});
