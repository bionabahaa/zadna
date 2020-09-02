var mission_chart = c3.generate({
    bindto: '#mission_chart',
    size: {
        height: 280,
        width: 250

    },
    data: {
        columns: [
            ['لم يتم', task_not_done],
            ['متاخر', task_wait],
            ['تم', task_done],
        ],
        type: 'donut',
        labels: false,
        colors: {
            data1: '#EE0102',
            data2: '#E8AC37',
            data3: '#0CDB10'
        },
        onclick: function(d, i) { console.log("onclick", d, i); },
        onmouseover: function(d, i) { console.log("onmouseover", d, i); },
        onmouseout: function(d, i) { console.log("onmouseout", d, i); }
    },
    // donut: {
    //     title: "المهام"
    // }
    donut: { width: 35 }
});



var crew_chart = c3.generate({
    bindto: '#crew_chart',
    size: {
        height: 280,
        width: 250

    },
    data: {
        columns: [
            ['data2', worker_permanent],
            ['data1', worker_temporary],


        ],
        type: 'donut',
        colors: {
            data2: '#EDECFE',
            data1: '#A3A1FB'

        },
        onclick: function(d, i) { console.log("onclick", d, i); },
        onmouseover: function(d, i) { console.log("onmouseover", d, i); },
        onmouseout: function(d, i) { console.log("onmouseout", d, i); }
    },


    donut: {
        title: "طاقم العمل",
        width: 25

    }

});


if ($(window).width() < 1329) {

    mission_chart.resize({ height: 280, width: 200 });
    crew_chart.resize({ height: 280, width: 200 })

}