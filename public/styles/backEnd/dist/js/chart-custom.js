var chart = c3.generate({
    bindto: '#season_mission',
    size: {
        height: 280,
        width: 250
    },
    data: {
        xFormat: '%',
        columns: [
            ['تم', 60],
            ['تم الالغاء', 30],
            ['متأخر', 10],
        ],
        type: 'pie',
        colors: {
            "تم": '#58b82a',
            "تم الالغاء": '#ffc107',
            "متأخر": '#ee0102'
        },
    }
});

var chart = c3.generate({
    bindto: '#store-chart',
    size: {
        height: 250,
        // width: 440
    },
    bar: {
        width: 50
    },
    data: {
        columns: [
            ['تم تلبية الطلب', 30, 300, 400],
            ['في الانتظار', 130, 300, 200],
        ],
        type: 'bar',
        axes: {
            sample1: 'y',
            sample2: 'y2'
        },
        groups: [
            ['تم تلبية الطلب', 'في الانتظار']
        ],
        colors: {
            'تم تلبية الطلب': '#58b82a',
            'في الانتظار': '#ffc107',
        },
    },
    axis: {
        x: {
            type: 'category',
            categories: ['حفار', 'سماد', 'محصول'],

        },
        y: {
            tick: {

              values: [100 , 200,300,400,500,600,700,800,900]
            },
            label: {
                text: 'الكميه المطلوبه',
                position: 'inner-middle'
                
              },
           
          }
      },

      
  
});