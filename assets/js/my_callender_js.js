$(document).ready(function () {

    $('#calendar').fullCalendar({
        theme: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
//        defaultDate: '1/12/2016',
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: [
            {
                title: 'All Day Event',
                url: 'http://localhost/lima/public/employee/index.php?content=view',
                start: '2016-04-01'
            },
            {
                title: 'Special Event',
                url: 'http://localhost/lima/public/employee/index.php?content=view',
                start: '2016-04-01T17:09',
                end: '2016-04-03T12:52'
            },
            {
                title: 'Training on Safety',
                url: 'http://localhost/lima/public/employee/index.php?content=view',
                start: '2016-04-07',
                end: '2016-04-10'
            },
            {
                id: 999,
                title: 'Goods Handling',
                url: 'http://localhost/lima/public/employee/index.php?content=view',
                start: '2016-04-09T16:00:00'
            },
            {
                id: 999,
                title: 'Checking Day',
                url: 'http://localhost/lima/public/employee/index.php?content=view',
                start: '2016-04-16T16:00:00'
            },
            {
                title: 'Conference',
                url: 'http://localhost/lima/public/employee/index.php?content=view',
                start: '2016-04-11',
                end: '2016-04-13'
            },
            {
                title: 'Safety Day',
                start: '2016-04-12T10:30:00',
                end: '2016-04-12T12:30:00'
            },
            {
                title: 'All clients Meeting',
                url: 'http://localhost/lima/public/employee/index.php?content=view',
                start: '2016-04-12T12:00:00'
            },
            {
                title: 'Staff Meeting',
                url: 'http://localhost/lima/public/employee/index.php?content=view',
                start: '2016-04-12T14:30:00'
            },
            {
                title: 'Happy Hour',
                url: 'http://localhost/lima/public/employee/index.php?content=view',
                start: '2016-04-12T17:30:00'
            },
            {
                title: 'Tocken Giving',
                url: 'http://localhost/lima/public/employee/index.php?content=view',
                start: '2016-04-12T20:00:00'
            },
            {
                title: 'Employee Party',
                url: 'http://localhost/lima/public/employee/index.php?content=view',
                start: '2016-04-13T07:00:00'
            },
            {
                title: 'Recruitment Day',
                url: 'http://localhost/lima/public/employee/index.php?content=view',
                start: '2016-04-28'
            }
        ]
    });

});
